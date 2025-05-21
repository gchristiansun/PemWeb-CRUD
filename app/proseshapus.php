<?php
include 'config.php';

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM mahasiswa Where id = '$id'");
header("Location: ../page/index.php");




?>