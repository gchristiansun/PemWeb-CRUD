<?php
include 'config.php';
global $conn;

$keyword = $conn->real_escape_string($_GET['keyword'] ?? '');

$sql = "SELECT nama FROM buah WHERE nama LIKE '%$keyword%' LIMIT 10";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<p>" . htmlspecialchars($row['nama']) . "</p>";
    }
} else {
    echo "<p>Tidak ditemukan.</p>";
}

$conn->close();
?>