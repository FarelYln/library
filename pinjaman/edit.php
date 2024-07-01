<?php
require_once __DIR__ . "/../navbar.php";

// Fetch the review details if an ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT ulasan.*, user.nama AS nama_pengulas, buku.nama_buku AS buku_diulas FROM ulasan
                                     LEFT JOIN user ON ulasan.nama_pengulas = user.id
                                     LEFT JOIN buku ON ulasan.buku_diulas = buku.id
                                     WHERE ulasan.id = '$id'");
    $ulasan = mysqli_fetch_assoc($query);
}

// Fetch user for the dropdown (assuming 'user' table holds reviewers)
$user_query = mysqli_query($koneksi, "SELECT * FROM user");

// Fetch buku for the dropdown (assuming 'buku' table holds buku)
$buku_query = mysqli_query($koneksi, "SELECT * FROM buku");

// Update the review details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
    $nama_pengulas = mysqli_real_escape_string($koneksi, $_POST['nama_pengulas']);
    $buku_diulas = mysqli_real_escape_string($koneksi, $_POST['buku_diulas']);

    // Query to update the review
    $query_update = "UPDATE ulasan SET 
                    rating = '$rating',
                    nama_pengulas = '$nama_pengulas',
                    buku_diulas = '$buku_diulas'
                    WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query_update)) {
        $pesan = "Data berhasil diperbarui.";
    } else {
        $pesan = "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
    }

    header("Location: index.php?pesan=" . urlencode($pesan));
    exit;
}
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
        <h2 class="mt-2">Edit Ulasan</h2>
        <form action="edit.php" method="POST" id="form">
            <input type="hidden" name="id" value="<?= $ulasan['id']; ?>">
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="number" class="form-control" id="rating" name="rating" value="<?= htmlspecialchars($ulasan['rating']); ?>" required>
                        <label for="rating">Rating</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-control" id="nama_pengulas" name="nama_pengulas" required>
                            <?php while ($user = mysqli_fetch_assoc($user_query)): ?>
                                <option value="<?= $user['id']; ?>" <?= ($user['id'] == $ulasan['genre_buku']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($user['nama']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <label for="nama_pengulas">Nama Pengulas</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-control" id="buku_diulas" name="buku_diulas" required>
                            <?php mysqli_data_seek($user_query, 0); // Reset user pointer ?>
                            <?php while ($buku = mysqli_fetch_assoc($buku_query)): ?>
                                <option value="<?= $buku['id']; ?>" <?= ($buku['id'] == $ulasan['buku_diulas']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($buku['nama_buku']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <label for="buku_diulas">Buku yang Diulas</label>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
