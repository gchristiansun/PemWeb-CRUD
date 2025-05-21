<?php
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: loginregister.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard CRUD</title>
  <link rel="stylesheet" href="../style/dashboard.css">
</head>
<body>

  <header>
    <div class="user-header">
        <h1>Dashboard </h1>
        <p><?= htmlspecialchars($_SESSION["username"]);?></p>
    </div>

    <div>
        <button class="btn" onclick="window.location.href='tambah.php'">Tambah Data</button>
        <button class="btn" onclick="window.location.href='logout.php'">Keluar</button>
    </div>
  </header>

  <div class="container">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Jenis kelamin</th>
          <th>Telepon</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include '../app/config.php';

          $result = mysqli_query($conn, "SELECT * FROM mahasiswa");

          while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
          <td><?= $row['id']?></td>
          <td><?= $row['nim']?></td>
          <td><?= $row['nama']?></td>
          <td><?= $row['email']?></td>
          <td><?= $row['jk']?></td>
          <td><?= $row['telepon']?></td>
          <td class="action-buttons">
            <button class="edit-btn" onclick="window.location.href='edit.php?id=<?=$row['id']?>'">Edit</button>
            <button class="delete-btn" onclick="window.location.href='../app/proseshapus.php?id=<?=$row['id']?>'">Hapus</button>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

</body>
</html>
