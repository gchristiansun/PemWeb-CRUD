<?php
require 'config.php';

function registrasi($data) {
    global $conn;

    $name = ucwords(strtolower(stripslashes($data["name"])));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $konfirmasipassword = mysqli_real_escape_string($conn, $data["konfirmasipassword"]);
    $email = $data["email"];

    // Cek username
    $result = mysqli_query($conn, "SELECT name FROM users WHERE name = '$name'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Nama pengguna sudah pernah terdaftar!')</script>";

        return false;
    }

    // Konfirmasi password
    if($password !== $konfirmasipassword) {
        echo "<script>
                alert('Konfirmasi password tidak sesuai!')
             </script>";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert kedalam database
    mysqli_query($conn, "INSERT INTO users VALUES ('', '$name', '$password', '$email')");

    return mysqli_affected_rows($conn);
}


















?>