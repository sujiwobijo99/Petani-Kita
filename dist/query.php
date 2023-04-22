<?php
include 'conn_db.php';
$id = $_GET['id'];
$role = $_GET['role'];


$query_mysql = mysqli_query($host, "SELECT * FROM `user` WHERE `id` LIKE '$id'") or die(mysqli_error($host));

$data = mysqli_fetch_array($query_mysql);

$id = $data['id'];
$role = $data['role'];
$nama = $data['name'];
$email = $data['email'];
$phone = $data['phone'];
if ($data['foto'] != NULL) {
    $foto = $data['foto'];
} else {
    $foto = "user.PNG";
}
// $foto = $data['foto'];
$gender = $data['gender'];
