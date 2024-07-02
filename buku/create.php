<?php 
require_once __DIR__ ."/../navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_buku = mysqli_real_escape_string($koneksi, $_POST['nama_buku']);
    $genre_buku = mysqli_real_escape_string($koneksi, $_POST['genre_buku']);
    $penerbit = mysqli_real_escape_string($koneksi, $_POST['penerbit']);
    $tanggal_terbit = mysqli_real_escape_string($koneksi, $_POST['tanggal_terbit']);
    $story = mysqli_real_escape_string($koneksi, $_POST['story']);
    
    $query = "INSERT INTO buku (nama_buku, genre_buku, penerbit, tanggal_terbit, story) VALUES ('$nama_buku', '$genre_buku', '$penerbit', '$tanggal_terbit', '$story')";
    if (mysqli_query($koneksi, $query)) {
        header('location: index.php');
        exit();
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

$query_genre = "SELECT * FROM genres";
$result_genre = mysqli_query($koneksi, $query_genre);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Tambah Buku Baru</h2>
    <form action="create.php" method="POST" id="form">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nama_buku" name="nama_buku" required>
                    <label for="nama_buku">Nama Buku</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-select" id="genre_buku" name="genre_buku" required>
                        <option value="" selected disabled>Pilih Genre</option>
                        <?php while($row = mysqli_fetch_assoc($result_genre)): ?>
                            <option value="<?= $row['id']; ?>"><?= $row['nama_genre']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="genre_buku">Genre Buku</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="penerbit" name="penerbit" required>
                    <label for="penerbit">Penerbit</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tanggal_terbit" name="tanggal_terbit" required>
                    <label for="tanggal_terbit">Tanggal Terbit</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="story" name="story" required>
                    <label for="story">Cerita</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tambah Buku</button>
    </form>
</div>
</body>
</html>