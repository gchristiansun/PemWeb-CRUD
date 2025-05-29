<?php
include '../app/session.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Form Tambah Data</title>
  <link rel="stylesheet" href="../style/form.css">
  <link rel="stylesheet" href="../style/dashboard.css">

</head>
<body>
    <header>
        <div class="user-header">
            <h1>Dashboard </h1>
            <p><?= htmlspecialchars($_SESSION["username"]);?></p>
        </div>
        <button class="btn" onclick="window.location.href='index.php'">Kembali</button>
    </header>

    <div class="container-form">
        <h2>Tambah Data Baru</h2>
        <form method="post" action="../app/prosesinput.php">
            <label for="nim">NIM</label>
            <input type="text" id="nim" name="nim" placeholder="Masukkan nim" />

            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama" />

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Masukkan email" />

            <label for="jk">Jenis Kelamin</label>
            <select id="jk" name="jk">
                <option value="">-- Jenis kelamin --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>

            <label for="telepon">Telepon</label>
            <input type="text" id="telepon" name="telepon" placeholder="08xx xxxx xxxx" />

            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>

</body>
</html>
