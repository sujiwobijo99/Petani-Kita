<?php
include 'conn_db.php';

$id = $_POST['id'];
$role = $_POST['role'];
$id_tanaman = $_POST['id_tanaman'];
$jmlh_bibit = $_POST['jmlh_bibit'];
$daerah = $_POST['daerah'];
$tgl_tanam = $_POST['tgl_tanam'];
$luas = $_POST['luas'];


$query_faktor = mysqli_query($host, "SELECT * FROM `plant` WHERE `id` LIKE '$id_tanaman'") or die(mysqli_error($host));

$calculate_factor = mysqli_fetch_array($query_faktor);
$est_bobot = $jmlh_bibit * $calculate_factor['febp'];
$est_panen = date('Y-m-d', strtotime($tgl_tanam . ' +' . $calculate_factor['felp'] . ' days'));

mysqli_query($host, "INSERT INTO `data-input` (`id`, `id_user`, `id_tanaman`, `jmlh_bibit`, `tgl_tanam`, `est_panen`, `est_bobot`, `daerah`, `luas`) VALUES (NULL, '$id', $id_tanaman, '$jmlh_bibit', '$tgl_tanam', '$est_panen', '$est_bobot', '$daerah', '$luas')") or die(mysqli_error($host));

header("location:manajemen-input.php?id=$id&role=$role&pesan=1");
