<?php 
require_once __DIR__ ."/../navbar.php";
require_once __DIR__ ."/../koneksi.php"; // Ensure you have the database connection here

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = mysqli_real_escape_string($koneksi, $_POST['nama_peminjam']);
    $buku_dipinjam = mysqli_real_escape_string($koneksi, $_POST['buku_dipinjam']);
    $tgl_pinjam = mysqli_real_escape_string($koneksi, $_POST['tgl_pinjam']);
    $tgl_kembali = mysqli_real_escape_string($koneksi, $_POST['tgl_kembali']);

    if($tgl_kembali <= $tgl_pinjam ){
        echo "<script>alert('Tanggal kembali tidak boleh kurang dari tanggal pinjam');window.location.href='create.php'</script>";
        exit();
    }
    
    $query = "INSERT INTO pinjaman (nama_peminjam, buku_dipinjam, tgl_pinjam, tgl_kembali) VALUES ('$user_id', '$buku_dipinjam', '$tgl_pinjam', '$tgl_kembali')";
    if (mysqli_query($koneksi, $query)) {
        if($query){
            echo "<script>alert('Data Berhasil Ditambahkan');window.location.href='index.php'</script>";
        }
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

$query_buku = "SELECT * FROM buku";
$result_buku = mysqli_query($koneksi, $query_buku);

$query_user = "SELECT * FROM user";
$result_user = mysqli_query($koneksi, $query_user);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pinjam Buku</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Pinjam Buku</h2>
    <form action="create.php" method="POST" id="form">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                        <?php while($row = mysqli_fetch_assoc($result_user)): ?>
                            <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama']); ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="nama_peminjam">User</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-control" id="buku_dipinjam" name="buku_dipinjam" required>
                        <?php while($row = mysqli_fetch_assoc($result_buku)): ?>
                            <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama_buku']); ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="buku_dipinjam">Buku Dipinjam</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" required>
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
                    <label for="tgl_kembali">Tanggal di Kembalikan</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tambah Buku</button>
    </form>
</div>
</body>
</html>
