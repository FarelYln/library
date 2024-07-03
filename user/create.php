<?php 
require_once __DIR__ ."/../navbar.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $no_hp = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    
    // Check if nama or no_hp already exists
    $checkQuery = "SELECT * FROM user WHERE nama = '$nama' OR no_hp = '$no_hp'";
    $checkResult = mysqli_query($koneksi, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $pesan = "Nama atau Nomor HP sudah ada. Gunakan yang lain.";
    } else {
        $query = "INSERT INTO user (nama, no_hp) VALUES ('$nama', '$no_hp')";
        if (mysqli_query($koneksi, $query)) {
            if($query){
                echo "<script>alert('Data Berhasil Ditambahkan');window.location.href='index.php'</script>";
            }
            exit();
        } else {
            $pesan = "Error: " . $query . "<br>" . mysqli_error($koneksi);
        }
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
    <?php if (isset($pesan)): ?>
        <div class="alert alert-danger">
            <?php echo $pesan; ?>
        </div>
    <?php endif; ?>
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
