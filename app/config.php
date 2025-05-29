<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "belajarphp";
$conn = mysqli_connect($server, $user, $password, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>