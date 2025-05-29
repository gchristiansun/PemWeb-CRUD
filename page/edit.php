<?php
include '../app/session.php';
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
        <button class="btn" onclick="window.location.href='index.php'">Kembali</button>
    </div>
  </header>

  <div class="container">
    <?php 
        include '../app/config.php';
        $id = $_GET['id'];
        $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id = $id");
        $row = mysqli_fetch_assoc($result);
    ?>
    <form action="../app/prosesedit.php?id=<?=$id?>" method="post">
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
                <tr>
                    <td><?= $id?></td>
                    <td>
                        <input type="text" name="nim" id="nim" value="<?= $row['nim'] ?>" placeholder="<?= $row['nim'] ?>">
                    </td>
                    <td>
                        <input type="text" name="nama" id="nama" value="<?= $row['nama'] ?>" placeholder="<?= $row['nama'] ?>">
                    </td>
                    <td>
                        <input type="email" name="email" id="email" value="<?= $row['email'] ?>" placeholder="<?= $row['email'] ?>">
                    </td>
                    <td><?= $row['jk']?></td>
                    <td>
                        <input type="text" name="telepon" id="telepon" value="<?= $row['telepon'] ?>" placeholder="<?= $row['telepon'] ?>">
                    </td>
                    <td class="action-buttons">
                        <button class="simpan-btn" type="submit">Simpan</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    
  </div>

</body>
</html>
