<?php
session_start();
include "query.php";
if (!isset($_SESSION['admin'])) {
    if (!isset($_SESSION['login'])) {
        header("Location: login.php");
        exit;
    } else {
        header("location:profil.php?id=$id&role=$role");
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link rel="icon" href="assets/img/rose.png">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
</head>

<?php
include "template/sidebar.php"
?>


<main>
    <div class="container-fluid px-4">
        <h3 class="mx-4" align="right"></h3>
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Jumlah Pengguna</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>
                            <?php
                            $query_mysql = mysqli_query($host, "SELECT COUNT(*) FROM `user`");
                            $data = mysqli_fetch_array($query_mysql);
                            echo $data['COUNT(*)']
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Jumlah Tanaman</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>
                            <?php
                            $query_mysql = mysqli_query($host, "SELECT COUNT(*) FROM `user`");
                            $data = mysqli_fetch_array($query_mysql);
                            echo $data['COUNT(*)']
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Jumlah Data Input</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>
                            <?php
                            $query_mysql = mysqli_query($host, "SELECT COUNT(*) FROM `data-input`");
                            $data = mysqli_fetch_array($query_mysql);
                            echo $data['COUNT(*)']
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Pengguna Terbaik Minggu Ini</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <h2>
                            <?php

                            $today = date('Y-m-d'); // Tanggal saat ini
                            $dayOfWeek = date('N', strtotime($today)); // Mendapatkan hari dalam format angka (1 untuk Senin, 2 untuk Selasa, dan seterusnya)
                            $diff = $dayOfWeek - 1; // Menghitung selisih hari dari hari pertama pekan (Senin)
                            $firstDayOfWeek = date('Y-m-d', strtotime("-$diff days", strtotime($today))); // Mendapatkan tanggal hari pertama di pekan ini

                            // echo $firstDayOfWeek; // Output: 2023-04-17 (contoh)

                            $query_mysql = mysqli_query($host, "SELECT `id_user`, SUM(`jmlh_bibit`) AS `total_bibit` FROM `data-input` WHERE `tgl_tanam` BETWEEN '$firstDayOfWeek' AND '$today' GROUP BY `id_user` ORDER BY `total_bibit` DESC LIMIT 1;");
                            $data = mysqli_fetch_array($query_mysql);
                            if ($data != NULL) {
                                $id_user = $data['id_user'];
                                $query_user = mysqli_query($host, "SELECT * FROM `user` WHERE `id` LIKE '$id_user'") or die(mysqli_error($host));
                                $user = mysqli_fetch_array($query_user);
                                echo $user["name"];
                            } else {
                                echo "-";
                            }
                            ?>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $query_persentase = mysqli_query(
            $host,
            "SELECT id_tanaman, SUM(jmlh_bibit) as total_bibit, 
            ROUND(SUM(jmlh_bibit) / (SELECT SUM(jmlh_bibit) FROM `data-input`), 2) * 100 as presentase
            FROM `data-input`
            GROUP BY id_tanaman
            ORDER BY total_bibit DESC
            LIMIT 5;
"
        );
        $id_buah = [];
        $presentase_buah = [];
        while ($row = mysqli_fetch_assoc($query_persentase)) {
            $id = $row['id_tanaman'];
            $presentase = $row['presentase'];
            $id_tanaman = $id;
            $queryNamaTanaman = mysqli_query($host, "SELECT * FROM `plant` WHERE `id` LIKE $id_tanaman") or die(mysqli_error($host));
            $tanaman = mysqli_fetch_array($queryNamaTanaman);
            $nama_buah[] =  $tanaman['nama'];
            $presentase_buah[] =  (float) $presentase;
        }
        $buah = array(
            "labels" => $nama_buah,
            "datasets" => array(
                array(
                    'data' => $presentase_buah,
                    'backgroundColor' => ['#007bff', '#dc3545', '#ffc107', '#28a745']
                )
            )
        );
        $json_pie = json_encode($buah);
        // echo $json_pie;

        ?>
        <?php
        $query_mysql = mysqli_query(
            $host,
            "SELECT WEEK(`tgl_tanam`) AS `minggu_ke`, SUM(`jmlh_bibit`) AS `total_bibit` FROM `data-input`GROUP BY `minggu_ke`LIMIT 8;"
        );

        $labels = [];
        $data = [];

        while ($row = mysqli_fetch_assoc($query_mysql)) {
            $date = $row['minggu_ke'];
            $data = $row['total_bibit'];
            $labels[] = "Pekan "   . $date;
            $jumlah_bibit[] = $data;
        }
        $max_bibit = max($jumlah_bibit);

        $data = array(
            "labels" => $labels,
            "datasets" => array(
                array(
                    "label" => "Jumlah BIbit",
                    "lineTension" => 0,
                    "backgroundColor" => "rgba(2,117,216,0.2)",
                    "borderColor" => "rgba(2,117,216,1)",
                    "pointRadius" => 5,
                    "pointBackgroundColor" => "rgba(2,117,216,1)",
                    "pointBorderColor" => "rgba(255,255,255,0.8)",
                    "pointHoverRadius" => 5,
                    "pointHoverBackgroundColor" => "rgba(2,117,216,1)",
                    "pointHitRadius" => 50,
                    "pointBorderWidth" => 2,
                    "data" => $jumlah_bibit
                )
            )
        );

        $json_data = json_encode($data);

        // var_dump($labels);
        // var_dump($data);
        // echo $json_data;
        ?>
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Data Bibit Mingguan
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-pie me-1"></i>
                        Data Sebaran Jenis Tanaman
                    </div>
                    <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data Input
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Pengguna</th>
                            <th>Tanaman</th>
                            <th>Daerah Tanam</th>
                            <th>Waktu Tanam</th>
                            <th>Luas Area Tanam</th>
                            <th>Estimasi Waktu Panen</th>
                            <th>Estimasi Hasil Panen</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Nomor</th>
                            <th>Nama Penguna</th>
                            <th>Tanaman</th>
                            <th>Daerah Tanam</th>
                            <th>Waktu Tanam</th>
                            <th>Jumlah Bibit Tanam</th>
                            <th>Estimasi Waktu Panen</th>
                            <th>Estimasi Hasil Panen</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $query_mysql = mysqli_query($host, "SELECT * FROM `data-input`") or die(mysqli_error($host));
                        $nomor = 1;
                        while ($data = mysqli_fetch_array($query_mysql)) {
                        ?>
                            <tr>
                                <td><?php echo $nomor++; ?></td>
                                <td>
                                    <?php
                                    $id_user = $data['id_user'];
                                    $queryNamaUser = mysqli_query($host, "SELECT * FROM `user` WHERE `id` LIKE $id_user") or die(mysqli_error($host));
                                    $user = mysqli_fetch_array($queryNamaUser);
                                    echo $user['name']
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    $id_tanaman = $data['id_tanaman'];
                                    $queryNamaTanaman = mysqli_query($host, "SELECT * FROM `plant` WHERE `id` LIKE $id_tanaman") or die(mysqli_error($host));
                                    $tanaman = mysqli_fetch_array($queryNamaTanaman);
                                    echo $tanaman['nama']
                                    ?>
                                </td>
                                <td><?php echo $data['daerah']; ?></td>
                                <td><?php echo $data['tgl_tanam']; ?></td>
                                <td><?php echo $data['jmlh_bibit']; ?></td>
                                <td><?php echo $data['est_panen']; ?></td>
                                <td><?php echo $data['est_bobot']; ?></td>
                                <td>
                                    <?php
                                    $tgl_panen = $data['est_panen'];
                                    $todayDate = date("Y-m-d");
                                    $panenDateTime = new DateTime($tgl_panen);
                                    $todayDateTime = new DateTime($todayDate);
                                    $selisih = $todayDateTime->diff($panenDateTime);
                                    $selisihHari =  $selisih->format("%r%a");
                                    if ($selisihHari > 0) {
                                        echo "<button class='btn btn-warning'>Panen: <strong>$selisihHari</strong> Hari Lagi</button>";
                                    } else if ($selisihHari == 0) {
                                        echo "<button class='btn btn-primary'><strong>Siap Panen</strong></button>";
                                    } else {
                                        echo "<button class='btn btn-success'><strong>Selesai Panen</strong></button>";
                                    }
                                    ?>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';



    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Area Chart Example
    var ctx = document.getElementById("myAreaChart");

    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: <?php echo $json_data; ?>,
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'week'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 7
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: <?php echo round($max_bibit + ($max_bibit * 0.1)) ?>,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        color: "rgba(0, 0, 0, .125)",
                    }
                }],
            },
            legend: {
                display: false
            }
        }
    });
</script>


<!-- Pie Chart -->
<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Pie Chart Example
    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: <?php echo $json_pie ?>,
    });
</script>


<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Petani Kita <script>
                    document.write(new Date().getFullYear())
                </script>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- <script src="assets/demo/chart-area-demo.js"></script> -->
<!-- <script src="assets/demo/chart-bar-demo.js"></script> -->
<!-- <script src="assets/demo/chart-pie-demo.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>