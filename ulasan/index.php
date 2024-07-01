<?php 
require_once __DIR__ ."/../navbar.php";

$data = mysqli_query($koneksi, 
    "SELECT ulasan.id, ulasan.rating, user.nama AS nama_pengulas, buku.nama_buku AS buku_diulas
    FROM ulasan
    JOIN user ON ulasan.nama_pengulas = user.id
    JOIN buku ON ulasan.buku_diulas = buku.id"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">
            Ulasan Dari User
        </h3>
        <table class="table table-bordered table-hover text-center mt-2">
            <a href="create.php" class="btn btn-primary mt-2">Tambah Ulasan</a>
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>Rating</th>
                    <th>Pengulas</th>
                    <th>Buku yang di ulas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                
            <?php 
            $no = 1;
            while ($d = mysqli_fetch_assoc($data)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['rating'] ?>/10</td>
                    <td><?= $d['nama_pengulas'] ?></td>
                    <td><?= $d['buku_diulas'] ?></td>
                    <td>
                         <a href="edit.php?id=<?= $d['id'] ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?= $d['id'] ?>" onclick="return confirm('Apakah Anda Yakin?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>