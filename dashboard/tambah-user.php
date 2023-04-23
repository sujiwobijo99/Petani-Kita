<?php
session_start();
include 'conn_db.php';

$id = $_SESSION['id'];
$role = $_SESSION['role'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$name = $_POST['nama'];
$gender = $_POST['gender'];

$targetfolder = "assets/img/foto/";

$targetfolder = $targetfolder . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {

    echo "The file " . basename($_FILES['file']['name']) . " is uploaded";
    $file_name = $_FILES['file']['name'];
} else {

    echo "Problem uploading file";
    $file_name = "";
}

mysqli_query($host, "INSERT INTO `user`(`id`, `role`, `name`, `email`, `phone`, `pass`, `foto`, `gender`) VALUES (NULL,2,'$name','$email','$phone','$pass','$file_name','$gender')") or die(mysqli_error($host));

header("location:manajemen-user.php?pesan=1");
