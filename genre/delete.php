<?php
require_once __DIR__ ."/../koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $query = mysqli_query($koneksi, "DELETE FROM genres WHERE id = '$id'");

        if ($query) {
            echo "<script>alert('Data Berhasil Dihapus');window.location.href='index.php'</script>";
        } else {
            throw new Exception("Gagal menghapus genre.");
        }
    } catch (mysqli_sql_exception $e) {
        // Check if the error is due to a foreign key constraint
        if ($e->getCode() == 1451) {
            echo "<script>alert('Genre sedang digunakan. Tidak bisa dihapus.');window.location.href='index.php'</script>";
        } else {
            // Log the error or display a generic error message
            echo "<script>alert('Terjadi kesalahan.');window.location.href='index.php'</script>";
        }
    }
}