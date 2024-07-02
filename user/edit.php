<?php
require_once __DIR__ . "/../navbar.php";

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE id = '$id'");
    $user = mysqli_fetch_assoc($query);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);

    $query = "UPDATE user SET nama = '$nama', no_hp = '$no_hp' WHERE id = '$id'";
    if (mysqli_query($koneksi, $query)) {
        $pesan = "Data berhasil diperbarui.";
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }

    header("Location: index.php?pesan=" . urlencode($pesan));
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script>
        function validateForm() {
            var nama = document.getElementById("nama").value;
            var no_hp = document.getElementById("no_hp").value;
            var namaRegex = /^[a-zA-Z\s]+$/;
            var no_hpRegex = /^[0-9]{1,12}$/;

            if (!namaRegex.test(nama)) {
                alert("Nama tidak boleh mengandung angka.");
                return false;
            }
            if (!no_hpRegex.test(no_hp)) {
                alert("Nomor HP harus berupa angka dan tidak lebih dari 12 digit.");
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <h2 class="mt-2">Edit User</h2>
        <form action="edit.php" method="POST" id="form" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?= $user['id']; ?>">
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?= htmlspecialchars($user['nama']); ?>" required>
                        <label for="nama">Nama User</label>
                    </div>
                </div>
            </div>
            <br>
            <div class="row g-2 mt-3">
                <div class="col-md">
                    <div class="form-floating">
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= htmlspecialchars($user['no_hp']); ?>" required>
                        <label for="no_hp">Nomor HP</label>
                    </div>
                </div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>

</html>
