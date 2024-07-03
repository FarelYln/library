<?php 
require_once __DIR__ ."/../navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nama_genre'])) {
        $nama_genre = mysqli_real_escape_string($koneksi, $_POST['nama_genre']);

        // Check if the genre already exists
        $check_query = "SELECT * FROM genres WHERE nama_genre = '$nama_genre'";
        $check_result = mysqli_query($koneksi, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo "<script>alert('Genre sudah ada');window.location.href='create.php'</script>";
        } else {
            $query = "INSERT INTO genres (nama_genre) VALUES ('$nama_genre')";
            if (mysqli_query($koneksi, $query)) {
                echo "<script>alert('Data Berhasil Ditambahkan');window.location.href='index.php'</script>";
            } else {
                $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
            }
        }
    } else {
        $pesan = "Nama genre tidak diisi.";
    }
}
$query = "SELECT * FROM genres";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah genres</title>
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Tambah Genre Baru</h2>
        <form action="create.php" method="POST">
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama_genre" name="nama_genre" >
                        <label for="floatingInputGrid">Genre: </label>
                        <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
