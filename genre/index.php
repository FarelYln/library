<?php 
require_once __DIR__ ."/../navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library | Genre</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">
            Genre yang Tersedia
        </h3>
        <table class=" table-bordered text-center table table-hover mt-2">
            <a href="create.php" class="btn btn-primary mt-2">Tambah genre</a>
            <thead class="table-secondary">
                <tr>
                    <th>Id</th>
                    <th>Genre</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $no = 1;
            $data = mysqli_query($koneksi, "SELECT * FROM genres");
            while ($d = mysqli_fetch_array($data)) {
            ?>
                <tr>
                    <td><?=  $no++; ?></td>

                    <td><?= $d['nama_genre']?></td>
                    <td>
                        <a href="edit.php?id=<?= $d['id']?>" class="btn btn-success">Edit</a>
                        <a href="delete.php?id=<?=  $d['id']?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin?&#x2639;')">Delete</a>

                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
    </div>
</body>
</html>