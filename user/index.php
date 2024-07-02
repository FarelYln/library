<?php 
require_once __DIR__ ."/../navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library | User</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">Ini Halaman User</h3>

        <table class="table table-bordered tale-hover mt-2 text-center">
            <a href="create.php" class="btn btn-primary mt-2">Tambah User</a>
            <thead class="table-secondary">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>NO Hp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM user");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?=$d['nama'] ?></td>
                    <td><?= $d['no_hp']?></td>
                    <td>
                        <a href="edit.php?id=<?=  $d['id'] ?>" class="btn btn-success">Edit</a>

                        <a href="delete.php?id=<?= $d['id']; ?>" onclick="return confirm('Apakah Anda yakin?&#x2639;')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php 
        }
         ?>
            </tbody>
        </table>
    </div>
</body>
</html>