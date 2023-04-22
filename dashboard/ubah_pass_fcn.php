<?php
include 'conn_db.php';

$id = $_POST['id'];
$role = $_POST['role'];
$new_password = $_POST['new_password'];


echo "ID:  $id </br>";
echo "Role:$role </br>";
echo "New Pass: $new_password </br>";
