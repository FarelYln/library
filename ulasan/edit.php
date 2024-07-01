<?php 
require_once __DIR__ ."/../navbar.php";

$id = $_GET['id'];

// Ambil data ulasan yang akan di-edit dari database
$query = "SELECT * FROM ulasan WHERE id = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$ulasan = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai-nilai yang di-post
    $rating = $_POST['rating'];
    $nama_pengulas = $_POST['nama_pengulas'];
    $buku_diulas = $_POST['buku_diulas'];

    // Query untuk update ulasan
    $query_update = "UPDATE ulasan SET 
                    rating = ?,
                    nama_pengulas = ?,
                    buku_diulas = ?
                    WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $query_update);
    mysqli_stmt_bind_param($stmt, "iiii", $rating, $nama_pengulas, $buku_diulas, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        header('Location: index.php');
        exit();
    }
}

// Query untuk mengambil data yang diperlukan untuk dropdown, seperti nama_pengulas dan buku_diulas
$query_pengulas = "SELECT * FROM user";
$stmt = mysqli_prepare($koneksi, $query_pengulas);
mysqli_stmt_execute($stmt);
$result_pengulas = mysqli_stmt_get_result($stmt);

$query_buku = "SELECT * FROM buku";
$stmt = mysqli_prepare($koneksi, $query_buku);
mysqli_stmt_execute($stmt);
$result_buku = mysqli_stmt_get_result($stmt);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ulasan</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Edit Ulasan</h2>
    <form action="edit.php?id=<?= $id ?>" method="POST" id="form">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="number" class="form-control" id="rating" name="rating" value="<?= $ulasan['rating'] ?>"required>
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
                            <option value="<?= $row['id']; ?>" <?= ($row['id'] == $ulasan['nama_pengulas']) ? 'selected' : ''; ?>><?= $row['nama']; ?></option>
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
                        <?php mysqli_data_seek($result_pengulas, 0); // Kembalikan pointer hasil query ?>
                        <?php while($row = mysqli_fetch_assoc($result_buku)): ?>
                            <option value="<?= $row['id']; ?>" <?= ($row['id'] == $ulasan['buku_diulas']) ? 'selected' : ''; ?>><?= $row['nama_buku']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="buku_diulas">Buku yang Diulas</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>
