<?php 
require_once __DIR__ ."/../navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <title>Library | Buku</title>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4">
            Halaman buku
        </h3>

        <table class="table table-bordered table-hover text-center " class="mt-2" id="datatable">
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
            <tbody class="table-warning-subtle">
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
                        <a href="cerita.php?id=<?= $d['id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-book" viewBox="0 0 16 16">
  <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783"/>
</svg></a>&nbsp;
                        <a href="edit.php?id=<?= $d['id']; ?>" class="btn btn-success">Edit</a>
                        <a href="delete.php?id=<?= $d['id']; ?>" onclick="return confirm('Apakah Anda yakin?&#x2639;')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        });
    </script>
</body>
</html>
