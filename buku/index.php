<?php 
require_once __DIR__ ."/../navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">
            Halaman buku
        </h3>

        <table class="table table-bordered table-hover text-center " class="mt-2">
            <a href="create.php" class="btn btn-primary mt-2 mb-2">Tambah Buku</a>
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Nama Buku</th>
                    <th>Genre</th>
                    <th>Penerbit</th>
                    <th>Tanggal Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            
            $query =
            "
                SELECT buku.id, buku.nama_buku, genres.nama_genre, buku.penerbit, buku.tanggal_terbit 
                FROM buku 
                INNER JOIN genres ON buku.genre_buku = genres.id
            ";
            $data = mysqli_query($koneksi, $query);
            $no = 1;
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($d['nama_buku']); ?></td>
                    <td><?= htmlspecialchars($d['nama_genre']); ?></td>
                    <td><?= htmlspecialchars($d['penerbit']); ?></td>
                    <td><?= htmlspecialchars($d['tanggal_terbit']); ?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-success">Edit</a>
                        <a href="delete.php?id=<?= $d['id']; ?>" onclick="return confirm('Apakah Anda yakin?')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>
