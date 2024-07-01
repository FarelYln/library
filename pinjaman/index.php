<?php
require_once __DIR__ . "/../navbar.php";

$data = mysqli_query(
    $koneksi,
    "SELECT pinjaman.id, user.nama AS nama_peminjam, buku.nama_buku, pinjaman.tgl_pinjam, pinjaman.tgl_kembali
            FROM pinjaman
            LEFT JOIN user ON pinjaman.nama_peminjam = user.id
            LEFT JOIN buku ON pinjaman.buku_dipinjam = buku.id"
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h3 class="text-center mt-4">Data Pinjaman</h3>
        <a href="create.php" class="btn btn-primary mt-2">Pinjam Buku</a>
        <table class="table table-bordered table-hover text-center mt-2">
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Nama Peminjam</th>
                    <th>Buku yang di Pinjam</th>
                    <th>Tanggal Meminjam</th>
                    <th>Tanggal di Kembalikan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($d = mysqli_fetch_array($data)) { ?>
                    <tr>
                        <td><?= $d['id']; ?></td>
                        <td><?= $d['nama_peminjam']; ?></td>
                        <td><?= $d['nama_buku']; ?></td>
                        <td><?= $d['tgl_pinjam']; ?></td>
                        <td><?= $d['tgl_kembali']; ?></td>
                        <td>
                            <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-success">Edit</a>
                            <a href="delete.php?id=<?= $d['id']; ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>