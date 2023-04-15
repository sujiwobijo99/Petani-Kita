<?php
include 'conn_db.php';

$id = $_POST['id'];
$role = $_POST['role'];
$nama = $_POST['nama'];
$felp = $_POST['felp'];
$febp = $_POST['febp'];

mysqli_query($host, "INSERT INTO `plant` (`id`, `nama`, `felp`, `febp`) VALUES (NULL, '$nama', '$felp', '$febp')") or die(mysqli_error($host));

header("location:data-tanaman.php?id=$id&role=$role&pesan=1");
