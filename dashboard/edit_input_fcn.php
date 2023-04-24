<?php
session_start();
include 'conn_db.php';

$id_input = $_POST['id'];
$page = $_GET['page'];
$id_tanaman = $_POST['id_tanaman'];
$jmlh_bibit = $_POST['jmlh_bibit'];
$daerah = $_POST['daerah'];
$luas = $_POST['luas'];
$tgl_tanam = $_POST['tgl_tanam'];

$query_faktor = mysqli_query($host, "SELECT * FROM `plant` WHERE `id` LIKE '$id_tanaman'") or die(mysqli_error($host));

$calculate_factor = mysqli_fetch_array($query_faktor);
$est_bobot = $jmlh_bibit * $calculate_factor['febp'];
$est_panen = date('Y-m-d', strtotime($tgl_tanam . ' +' . $calculate_factor['felp'] . ' days'));


mysqli_query($host, "UPDATE `data-input` SET `id_tanaman`='$id_tanaman',`jmlh_bibit`='$jmlh_bibit',`tgl_tanam`='$tgl_tanam',`est_panen`='$est_panen',`est_bobot`='$est_bobot',`daerah`='$daerah',`luas`='$luas' WHERE `id` = $id_input") or die(mysqli_error($host));

if ($page == 1) {
    header("location:manajemen-input.php?pesan=3");
} else {
    header("location:user-input.php?pesan=3");
}
