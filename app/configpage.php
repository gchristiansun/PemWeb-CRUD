<?php
include 'config.php';

// Pagination
$jumlahDataPerHalaman = 10;
$jumlahData = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM mahasiswa"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = ( isset($_GET['page']) ) ? $_GET['page'] : 1;
$dataAwal = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;


?>