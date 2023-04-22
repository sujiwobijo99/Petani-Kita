<?php
include 'conn_db.php';

$id = $_POST['id'];
$role = $_POST['role'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$name = $_POST['name'];
$gender = $_POST['gender'];

$targetfolder = "assets/img/foto/";

$targetfolder = $targetfolder . basename($_FILES['file']['name']);

if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {

    echo "The file " . basename($_FILES['file']['name']) . " is uploaded";
} else {

    echo "Problem uploading file";
}
$file_name = $_FILES['file']['name'];

mysqli_query($host, "UPDATE `user` SET `name` = '$name', `email` = '$email', `phone` = '$phone', `gender` = '$gender', `foto` =  '$file_name' WHERE `user`.`id` = $id;") or die(mysqli_error($host));

header("location:profil.php?id=$id&role=$role&pesan=1");
