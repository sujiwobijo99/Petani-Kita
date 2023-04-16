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
include "query.php";
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
                    <div class="card-body">Primary Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-warning text-white mb-4">
                    <div class="card-body">Warning Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-success text-white mb-4">
                    <div class="card-body">Success Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card bg-danger text-white mb-4">
                    <div class="card-body">Danger Card</div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="#">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-1"></i>
                        Area Chart Example
                    </div>
                    <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-bar me-1"></i>
                        Bar Chart Example
                    </div>
                    <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
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

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include "template/footer.php"
?>