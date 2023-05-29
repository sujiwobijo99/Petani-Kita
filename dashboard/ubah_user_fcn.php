<?php
session_start();
include 'conn_db.php';

$id = $_POST['id'];
$role = $_POST['role'];
$phone = $_POST['phone'];
$pass = $_POST['pass'];
$email = $_POST['email'];
$name = $_POST['name'];
$gender = $_POST['gender'];

$targetfolder = "assets/img/foto/";

$targetfolder = $targetfolder . basename($_FILES['file']['name']);
if ($_FILES['file']['name'] != NULL) {
    if (move_uploaded_file($_FILES['file']['tmp_name'], $targetfolder)) {

        echo "The file " . basename($_FILES['file']['name']) . " is uploaded";
        $file_name = $_FILES['file']['name'];
    } else {

        echo "Problem uploading file";
        $file_name = "";
    }


    mysqli_query($host, "UPDATE `user` SET `name` = '$name', `email` = '$email', `pass` = '$pass', `phone` = '$phone', `gender` = '$gender', `foto` =  '$file_name' WHERE `user`.`id` = $id;") or die(mysqli_error($host));

    header("location:manajemen-user.php?pesan=2");
} else {

    mysqli_query($host, "UPDATE `user` SET `name` = '$name', `email` = '$email', `pass` = '$pass', `phone` = '$phone', `gender` = '$gender' WHERE `user`.`id` = $id;") or die(mysqli_error($host));

    header("location:manajemen-user.php?pesan=2");
}
