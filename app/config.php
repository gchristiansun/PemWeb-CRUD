<?php
$conn = mysqli_connect("localhost", "root", "", "belajarphp");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>