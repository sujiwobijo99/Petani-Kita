<?php
session_start();
include 'conn_db.php';

$id = $_SESSION['id'];
$page = $_GET['page'];
$role = $_SESSION['role'];
$id_input = $_GET['id'];

echo $id_plant;

mysqli_query($host, "DELETE FROM `data-input` WHERE `id` = $id_input") or die(mysqli_error($host));

if ($page == 1) {
    header("location:manajemen-input.php?pesan=3");
} else {
    header("location:user-input.php?pesan=3");
}
