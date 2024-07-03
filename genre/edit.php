<?php
require_once __DIR__ ."/../navbar.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM genres WHERE id = '$id'");
    $genre = mysqli_fetch_assoc($query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_genre = mysqli_real_escape_string($koneksi, $_POST['nama_genre']);
    
    $query = "UPDATE genres SET nama_genre = '$nama_genre' WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        $pesan = "Data berhasil diperbarui.";
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
    
    echo "<script>alert('Genre berhasil diubah!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Genre</title>
</head>
<body>
    <div class="container">
<h2 class="mt-2">Edit Genre</h2>
<?php if(isset($genre)): ?>
    <form action="edit.php" method="POST" id="form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($genre['id']); ?>">
    <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="nama_genre" value="<?= htmlspecialchars($genre['nama_genre']); ?>">
                        <label for="nama_genre">Nama:</label>
                    </div>
                </div>
            </div>
        <br>
        <a href="index.php" class="btn btn-secondary">&#x276E;&#x276E;Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
<?php else: ?>
    <p>Genre tidak ditemukan.</p>
<?php endif; ?>

    </div>
</body>
</html>