<?php
include 'conn_db.php';
$nama = $_POST['nama'];
// $nama = $_POST['name'];
$phone = $_POST['phone'];
$password = $_POST['password'];


mysqli_query($host, "INSERT INTO `user` (`id`, `name`, `phone`, `pass`, `role`) VALUES (NULL, '$nama', '$phone', '$password', '2')") or die(mysqli_error($host));

header("location:login.php?pesan=2");
