<?php
include '../app/config.php';
include '../app/session.php';
include '../app/configpage.php';

if (!isset($_SESSION["login"])) {
    header("Location: loginregister.php");
    exit;
}

// Jika request dari AJAX (search)
if (isset($_GET['ajax']) && $_GET['ajax'] === 'search') {
    $keyword = trim($_GET['keyword']);

    $query = "SELECT * FROM mahasiswa 
              WHERE nama LIKE '%$keyword%' 
                 OR nim LIKE '%$keyword%' 
                 OR email LIKE '%$keyword%' 
                 OR jk LIKE '%$keyword%' 
                 OR telepon LIKE '%$keyword%'
                 LIMIT $dataAwal, $jumlahDataPerHalaman";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['nim']}</td>
        <td>{$row['nama']}</td>
        <td>{$row['email']}</td>
        <td>{$row['jk']}</td>
        <td>{$row['telepon']}</td>
        <td class='action-buttons'>
          <div class='container-button'>
            <button class='edit-btn' onclick=\"window.location.href='edit.php?id={$row['id']}'\">
              <span class='material-symbols-outlined icon-style'>edit</span>
              Edit
            </button>
            <button class='delete-btn' onclick=\"window.location.href='../app/proseshapus.php?id={$row['id']}'\">
              <span class='material-symbols-outlined icon-style'>delete</span>  
              Hapus
            </button>
          </div>
        </td>
      </tr>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard CRUD</title>
  <link rel="stylesheet" href="../style/dashboard.css">
  <script src="../script/search.js"></script>
  <!-- <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"> -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>
<body>

  <header>
    <div class="user-header">
        <h1>Dashboard </h1>
        <p><?= htmlspecialchars($_SESSION["username"]);?></p>
    </div>

    <div class="container-button">
        <input type="text" id="searchInput" placeholder="Cari mahasiswa..." autocomplete="off" autofocus>
        <button class="btn" onclick="window.location.href='tambah.php'">
          <span class="material-symbols-outlined icon-style">
            add
          </span>
          Tambah
        </button>
        <button class="btn" onclick="window.location.href='../app/logout.php'">
        <span class="material-symbols-outlined icon-style">
          logout
        </span>
          Keluar
        </button>
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
      <tbody id="mahasiswaTable">
        <?php
          include '../app/config.php';
          include '../app/configpage.php';

          $result = mysqli_query($conn, "SELECT * FROM mahasiswa LIMIT $dataAwal, $jumlahDataPerHalaman");

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
            <div class="container-button">
              <button class="edit-btn" onclick="window.location.href='edit.php?id=<?=$row['id']?>'">
                <span class="material-symbols-outlined icon-style">
                  edit
                </span>
                Edit
              </button>
              <button class="delete-btn" onclick="window.location.href='../app/proseshapus.php?id=<?=$row['id']?>'">
                <span class="material-symbols-outlined icon-style">
                  delete
                </span>  
                Hapus
              </button>
            </div>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>

    <div class="container-navigation-page">
      <?php if ($halamanAktif > 1) :?>
        <a href="?page=<?= $halamanAktif - 1;?>" class="navigation-page navigation-page-aktif">&laquo;</a>
      <?php endif; ?>

      <?php for($i = 1; $i <= $jumlahHalaman; $i ++) : ?>
        <?php if($i == $halamanAktif) : ?>
          <a href="?page=<?= $i; ?>" class="navigation-page navigation-page-aktif"><?= $i; ?></a>
        <?php else : ?>
          <a href="?page=<?= $i; ?>" class="navigation-page"><?= $i; ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($halamanAktif < $jumlahHalaman) :?>
        <a href="?page=<?= $halamanAktif + 1;?>" class="navigation-page navigation-page-aktif">&raquo;</a>
      <?php endif; ?>
    </div>
  </div>

</body>
</html>
