<?php
include 'config.php';

$id = $_GET['id'];
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$email = $_POST['email'];
// $jk = $_POST['jk'];
$telepon = $_POST['telepon'];

$query = "UPDATE mahasiswa SET 
            nim = '$nim',
            nama = '$nama',
            email = '$email',
            telepon = '$telepon'
            WHERE id = $id";

$result = mysqli_query($conn, $query);

if ($result) {
    echo "<script>
            alert('Data berhasil diupdate!');
            window.location.href = '../page/index.php'
        </script>";
    exit();
} else {
    echo "Update gagal: " . mysqli_error($conn);
}
?>
