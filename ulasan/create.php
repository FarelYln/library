<?php 
require_once __DIR__ ."/../navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
    $nama_pengulas = mysqli_real_escape_string($koneksi, $_POST['nama_pengulas']);
    $buku_diulas = mysqli_real_escape_string($koneksi, $_POST['buku_diulas']);

    $query = "INSERT INTO ulasan (rating, nama_pengulas, buku_diulas) 
              VALUES ('$rating', '$nama_pengulas', '$buku_diulas')";
    
    if (mysqli_query($koneksi, $query)) {
        header('location: index.php');
        exit();
    }
}


// Query untuk mengambil data yang diperlukan untuk dropdown, seperti nama_pengulas dan buku_diulas
$query_pengulas = "SELECT * FROM user"; // Misalnya 'user' adalah tabel yang berisi informasi pengulas
$result_pengulas = mysqli_query($koneksi, $query_pengulas);

$query_buku = "SELECT * FROM buku"; // Misalnya 'buku' adalah tabel yang berisi informasi buku yang diulas
$result_buku = mysqli_query($koneksi, $query_buku);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ulasan</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Tambah Ulasan Baru</h2>
    <form action="create.php" method="POST" id="form">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="number" class="form-control" id="rating" name="rating" required>
                    <label for="rating">Rating</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="nama_pengulas" name="nama_pengulas" required>
                        <option value="" selected disabled>Pilih Pengulas</option>
                        <?php while($row = mysqli_fetch_assoc($result_pengulas)): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['nama']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="nama_pengulas">Nama Pengulas</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="buku_diulas" name="buku_diulas" required>
                        <option value="" selected disabled>Pilih Buku yang Diulas</option>
                        <?php while($row = mysqli_fetch_assoc($result_buku)): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['nama_buku']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="buku_diulas">Buku yang Diulas</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tambah Ulasan</button>
    </form>
</div>
</body>
</html>
