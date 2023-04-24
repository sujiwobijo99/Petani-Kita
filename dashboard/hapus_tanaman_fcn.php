<?php
session_start();
include 'conn_db.php';

$id = $_SESSION['id'];
$role = $_SESSION['role'];
$id_plant = $_GET['id'];

echo $id_plant;

mysqli_query($host, "DELETE FROM `plant` WHERE `id` = $id_plant") or die(mysqli_error($host));

header("location:data-tanaman.php?pesan=3");
