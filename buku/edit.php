<?php
require_once __DIR__ . "/../navbar.php";

// Initialize variables
$buku = []; // Initialize $buku array to avoid undefined variable error

// Fetch the book details if an ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM buku WHERE id = '$id'");
    $buku = mysqli_fetch_assoc($query);
}

// Fetch genres for the dropdown
$genres_query = mysqli_query($koneksi, "SELECT * FROM genres");

// Update the book details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_buku = mysqli_real_escape_string($koneksi, $_POST['nama_buku']);
    $genre_buku = mysqli_real_escape_string($koneksi, $_POST['genre_buku']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tanggal_terbit = mysqli_real_escape_string($koneksi, $_POST['tanggal_terbit']);
    $story = mysqli_real_escape_string($koneksi, $_POST['story']);

    $tanggal_hari_ini = date("Y-m-d");
    if ($tanggal_terbit > $tanggal_hari_ini) {
        echo "<script>alert('Tanggal tidak valid');history.back();</script>";
        exit();
    }
    
    $query = "UPDATE buku SET 
              nama_buku = '$nama_buku', 
              genre_buku = '$genre_buku', 
              penerbit = '$penerbit', 
              tanggal_terbit = '$tanggal_terbit', 
              story = '$story' 
              WHERE id = '$id'";

    if (mysqli_query($koneksi, $query)) {
        $pesan = "Data berhasil diperbarui.";
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    echo "<script>alert('Buku berhasil diubah!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-2">Edit Buku</h2>
        <form action="edit.php" method="POST" id="form">
            <input type="hidden" name="id" value="<?= htmlspecialchars($buku['id'] ?? ''); ?>">
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?= htmlspecialchars($buku['nama_buku'] ?? ''); ?>" required>
                        <label for="nama_buku">Nama Buku</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <select class="form-control" id="genre_buku" name="genre_buku" required>
                            <?php while ($genre = mysqli_fetch_assoc($genres_query)): ?>
                                <option value="<?= $genre['id']; ?>" <?= ($genre['id'] == $buku['genre_buku']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($genre['nama_genre']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <label for="genre_buku">Genre Buku</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= htmlspecialchars($buku['penerbit'] ?? ''); ?>" required>
                        <label for="penerbit">Penerbit</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" value="<?= htmlspecialchars($buku['tanggal_terbit'] ?? ''); ?>" required>
                        <label for="tanggal_terbit">Tanggal Terbit</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="story" name="story" value="<?= htmlspecialchars($buku['story'] ?? ''); ?>" required>
                        <label for="story">Cerita</label>
                    </div>
                </div>
            </div>
            <br>
            <a href="index.php" class="btn btn-secondary">&#x276E;&#x276E;Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
