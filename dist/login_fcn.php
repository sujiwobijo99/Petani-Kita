<?php
include 'conn_db.php';
$phone = $_POST['phone'];
$password = $_POST['password'];

$query_mysql = mysqli_query($host, "SELECT * FROM `user` WHERE `phone` LIKE '$phone' AND `pass` LIKE '$password'") or die(mysqli_error($host));

$data = mysqli_fetch_array($query_mysql);
$id = $data['id'];
$role = $data['role'];

if (isset($id)) {
    if ($id == 1) {
        header("location:index.html?id=$id&role=$role");
    } else {
        header("location:index.html?id=$id&role=$role");
    }
} else {
    header("location:login.php?pesan=1");
}
