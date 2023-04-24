<?php
session_start();
include 'conn_db.php';

$id_plant = $_POST['id'];
$nama = $_POST['nama'];
$felp = $_POST['felp'];
$febp = $_POST['febp'];


mysqli_query($host, "UPDATE `plant` SET `nama`='$nama',`felp`='$felp',`febp`='$febp' WHERE `id` = $id_plant") or die(mysqli_error($host));

header("location:data-tanaman.php?pesan=2");
