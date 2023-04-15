<?php
include 'conn_db.php';
$id = $_GET['id'];
$id = $_GET['role'];


$query_mysql = mysqli_query($host, "SELECT * FROM `user` WHERE `id` LIKE '$id'") or die(mysqli_error($host));

$data = mysqli_fetch_array($query_mysql);

$id = $data['id'];
$role = $data['role'];
$nama = $data['name'];
$phone = $data['phone'];
