<?php
require_once __DIR__ . "/../koneksi.php";


$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM ulasan WHERE id = '$id'");

echo "<script>alert('Data Berhasil Dihapus');window.location.href='index.php'</script>";
