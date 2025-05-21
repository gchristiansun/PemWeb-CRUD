<?php
include 'config.php';

$nim = $_POST["nim"];
$nama = $_POST["nama"];
$email = $_POST["email"];
$jk = $_POST["jk"];
$telepon = $_POST["telepon"];

// Memasukan data kedalam database
$query = "INSERT INTO mahasiswa (nim, nama, email, jk, telepon) VALUES ('$nim', '$nama', '$email', '$jk', '$telepon')";

$result = mysqli_query($conn, $query);

if ($result) {
    header("Location: ../page/index.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}


?>