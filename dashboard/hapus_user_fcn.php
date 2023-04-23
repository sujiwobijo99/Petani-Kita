<?php
session_start();
include 'conn_db.php';

$id = $_SESSION['id'];
$role = $_SESSION['role'];
$id_user = $_GET['id'];

echo $id_user;

mysqli_query($host, "DELETE FROM `user` WHERE `id` = $id_user") or die(mysqli_error($host));

header("location:manajemen-user.php?pesan=3");
