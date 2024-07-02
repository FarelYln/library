<?php 
require_once __DIR__ ."/../navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    
    $query = "INSERT INTO user (nama, no_hp) VALUES ('$nama', '$no_hp')";
    if (mysqli_query($koneksi, $query)) {
        if($query){
        header('location: index.php');
        exit();
        }
    } else {
        $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}
$query = "SELECT * FROM user";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah user</title>
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
    <h2>Tambah user</h2>
    <form action="create.php" method="POST" id="form" onsubmit="return validateForm()">
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                    <label for="floatingInputGrid">Nama User</label>
                </div>
            </div>
        </div>
        <div class="row g-2 mt-3">
            <div class="col-md">
                <div class="form-floating">
                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                    <label for="floatingInputGrid">Nomor HP</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Tambah</button>
    </form>
</div>
</body>
</html>
