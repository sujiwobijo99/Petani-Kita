<?php
session_start();
include "query.php";
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
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
            <div class="col-xl-12 col-md-6">
                <div class="card bg-light text-black mb-4 bg-white">
                    <div class="card-footer align-items-center justify-content-between bg-transparent">
                        <div>
                            <h2>Cuaca Hari Ini</h2>
                        </div>
                        <h2>
                            <?php
                            // $ip_address = $_SERVER['REMOTE_ADDR']; // dapatkan alamat IP pengguna
                            $ip_address = '180.252.115.97'; // dapatkan alamat IP pengguna
                            // echo $ip_address;
                            $url = "https://ipgeolocation.abstractapi.com/v1/?api_key=9f8dab62b2884e19bb41f6ef0604a55a&ip_address=$ip_address"; // ganti YOUR_API_KEY dengan API key Anda
                            $pos = json_decode(file_get_contents($url), true); // ambil data JSON dari API
                            $lat = $pos['latitude'];
                            $lng = $pos['longitude'];


                            // API endpoint dan kunci akses
                            $api_endpoint = "http://api.openweathermap.org/data/2.5/weather";
                            $api_key = "9aad5218ffc81325e4fae45350390bbc";

                            // membuat URL untuk melakukan panggilan API
                            $url = $api_endpoint . "?lat=" . $lat . "&lon=" . $lng . "&appid=" . $api_key;

                            // melakukan panggilan API menggunakan curl
                            $ch = curl_init();
                            curl_setopt($ch, CURLOPT_URL, $url);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $response = curl_exec($ch);
                            curl_close($ch);

                            // mengurai respon JSON
                            $data = json_decode($response);
                            // var_dump($data);
                            ?>
                            <img src="assets/img/weather/<?php echo $data->weather[0]->icon ?>@2x.png" alt="">
                            <?php

                            // menampilkan informasi cuaca saat ini
                            echo $data->main->temp - 273.1 . " &#x2103;|&#x2109; Kelembaban " . $data->main->humidity . "%, Kecepatan Angin " . $data->wind->speed . " m/s. " . $data->weather[0]->description;
                            ?>



                        </h2>
                    </div>
                </div>
            </div>
            <?php
            $id_user = $_SESSION['id'];
            $query_persentase = mysqli_query(
                $host,
                "SELECT id_tanaman, SUM(jmlh_bibit) as total_bibit, 
            ROUND(SUM(jmlh_bibit) / (SELECT SUM(jmlh_bibit) FROM `data-input` WHERE `id_user` = $id_user), 2) * 100 as presentase
            FROM `data-input`
            WHERE `id_user` = $id_user
            GROUP BY id_tanaman
            ORDER BY total_bibit DESC
            LIMIT 5;
"
            );
            $id_buah = [];
            $presentase_buah = [];
            if (mysqli_fetch_assoc($query_persentase) != NULL) {
                while ($row = mysqli_fetch_assoc($query_persentase)) {
                    $id_plant = $row['id_tanaman'];
                    $presentase = $row['presentase'];
                    $id_tanaman = $id_plant;
                    $queryNamaTanaman = mysqli_query($host, "SELECT * FROM `plant` WHERE `id` LIKE $id_tanaman") or die(mysqli_error($host));
                    $tanaman = mysqli_fetch_array($queryNamaTanaman);
                    $nama_buah[] =  $tanaman['nama'];
                    $presentase_buah[] =  (float) $presentase;
                }
            } else {
                $nama_buah[] =  $id_buah;
                $presentase_buah[] =  $presentase_buah;
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
                "SELECT YEARWEEK(`tgl_tanam`) AS `minggu_ke`, SUM(`jmlh_bibit`) AS `total_bibit` FROM `data-input` WHERE `id_user` = '$id' GROUP BY `minggu_ke`;"
            );

            $labels = [];
            $data = [];
            if (mysqli_fetch_assoc($query_mysql) != NULL) {
                while ($row = mysqli_fetch_assoc($query_mysql)) {
                    $date = $row['minggu_ke'];
                    $data = $row['total_bibit'];
                    $labels[] = $date;
                    $jumlah_bibit[] = $data;
                }
                $max_bibit = max($jumlah_bibit);
                $treshold = round($max_bibit + ($max_bibit * 0.1));
            } else {
                $labels = [];
                $jumlah_bibit = [];
                $treshold = 10;
            }


            $data = array(
                "labels" => $labels,
                "datasets" => array(
                    array(
                        "label" => "Jumlah Bibit",
                        "backgroundColor" => "rgba(2,117,216,1)",
                        "borderColor" => "rgba(2,117,216,1)",
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
                            <i class="fas fa-chart-bar me-1"></i>
                            Data Bibit Mingguan
                        </div>
                        <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
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

        </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<script>
    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    // Bar Chart Example
    var ctx = document.getElementById("myBarChart");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: <?php echo $json_data; ?>,
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: false
                    },
                    ticks: {
                        maxTicksLimit: 6
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: <?php echo $treshold ?>,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
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