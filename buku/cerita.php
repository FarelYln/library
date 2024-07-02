<?php
require_once __DIR__ . "/../navbar.php";

// Inisialisasi variabel $buku untuk menghindari undefined variable notice
$buku = [];

// Fetch the book details if an ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
    $buku = mysqli_fetch_assoc($query);

    // Menggunakan nl2br untuk konversi newline ke tag <br>
    $buku['story'] = nl2br($buku['story']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library | Cerita</title>
</head>
<body>
    
    <div class="container">
        <h2 class="mt-4"><?= htmlspecialchars($buku['nama_buku'] ?? ''); ?></h2>
        <p><?= htmlspecialchars($buku['story'] ?? ''); ?></p>
        <a class="mt-2" href="index.php">&#x276E; Kembali ke Daftar Buku</a>
    </div>
</body>
</html>
