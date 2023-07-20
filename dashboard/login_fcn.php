<?php
session_start();
include 'conn_db.php';
$phone = $_POST['phone'];
$password = $_POST['password'];

$query_mysql = mysqli_query($host, "SELECT * FROM `user` WHERE `phone` LIKE '$phone' AND `pass` LIKE '$password'") or die(mysqli_error($host));

$data = mysqli_fetch_array($query_mysql);
$id = $data['id'];
$role = $data['role'];

if (isset($id)) {
    if ($role == 1) {
        $_SESSION['login'] = true;
        $_SESSION['admin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
        header("location:index.php?id=$id&role=$role");
    } else {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
        header("location:index-user.php?id=$id&role=$role");
    }
} else {
    header("location:login.php?pesan=1&phone=$phone");
}
