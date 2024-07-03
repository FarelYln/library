<?php
require_once __DIR__ . "/../navbar.php";

// Fetch the loan details if an ID is provided
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM pinjaman
                                     INNER JOIN user ON pinjaman.nama_peminjam = user.id
                                     INNER JOIN buku ON pinjaman.buku_dipinjam = buku.id
                                     WHERE pinjaman.id = '$id'");
    $pinjaman = mysqli_fetch_assoc($query);
}

// Fetch users for the dropdown
$user_query = mysqli_query($koneksi, "SELECT * FROM user");

// Fetch books for the dropdown
$buku_query = mysqli_query($koneksi, "SELECT * FROM buku");

// Update the loan details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama_peminjam = mysqli_real_escape_string($koneksi, $_POST['nama_peminjam']);
    $buku_dipinjam = mysqli_real_escape_string($koneksi, $_POST['buku_dipinjam']);
    $tgl_pinjam = mysqli_real_escape_string($koneksi, $_POST['tgl_pinjam']);
    $tgl_kembali = mysqli_real_escape_string($koneksi, $_POST['tgl_kembali']);
    if($tgl_kembali <= $tgl_pinjam ){
        echo "<script>alert('Tanggal kembali tidak boleh kurang dari tanggal pinjam');history.back()</script>";
        exit();
    }
// UPDATE pinjaman SET nama_peminjam = '1', buku_dipinjam = '2' WHERE pinjaman.id = '3'
    // Query to update the loan
    $query_update = "UPDATE pinjaman SET 
                    nama_peminjam = '$nama_peminjam',
                    buku_dipinjam = '$buku_dipinjam',
                    tgl_pinjam = '$tgl_pinjam',
                    tgl_kembali = '$tgl_kembali'
                    WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $query_update)) {
        $pesan = "Data berhasil diperbarui.";
    } else {
        $pesan = "Error: " . $query_update . "<br>" . mysqli_error($koneksi);
    }

    echo "<script>alert('Pinjaman berhasil diubah!'); window.location.href='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pinjaman Buku</title>
</head>
<body>
<div class="container">
    <h2 class="mt-4">Edit Pinjaman Buku</h2>
    <form action="edit.php" method="POST" id="form">
        <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']); ?>">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-control" id="nama_peminjam" name="nama_peminjam" required>
                        <?php while($row = mysqli_fetch_assoc($user_query)): ?>
                            <option value="<?= htmlspecialchars($row['id']); ?>" <?= ($row['id'] == $pinjaman['nama_peminjam']) ? 'selected' : '' ?>><?= htmlspecialchars($row['nama']); ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="nama_peminjam">Nama Peminjam</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <select class="form-control" id="buku_dipinjam" name="buku_dipinjam" required>
                        <?php while($row = mysqli_fetch_assoc($buku_query)): ?>
                            <option value="<?= htmlspecialchars($row['id']); ?>" <?= ($row['id'] == $pinjaman['buku_dipinjam']) ? 'selected' : '' ?>><?= htmlspecialchars($row['nama_buku']); ?></option>
                        <?php endwhile; ?>
                    </select>
                    <label for="buku_dipinjam">Buku Dipinjam</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tgl_pinjam" name="tgl_pinjam" value="<?= htmlspecialchars($pinjaman['tgl_pinjam']); ?>" required>
                    <label for="tgl_pinjam">Tanggal Pinjam</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" value="<?= htmlspecialchars($pinjaman['tgl_kembali']); ?>" required>
                    <label for="tgl_kembali">Tanggal Kembali</label>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-secondary">&#x276E;&#x276E;Kembali</a>
        <button type="submit" class="btn btn-primary mt-2">Simpan Perubahan</button>
    </form>
</div>
</body>
</html>
