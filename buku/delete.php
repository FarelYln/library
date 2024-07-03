<?php
require_once __DIR__ ."/../koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    try {
        $query = mysqli_query($koneksi, "DELETE FROM buku WHERE id = '$id'");

        if ($query) {
            echo "<script>alert('Data Berhasil Dihapus');window.location.href='index.php'</script>";
        } else {
            throw new Exception("Gagal menghapus buku: " . mysqli_error($koneksi));
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Buku Sedang di gunakan');window.location.href='index.php'</script>";
    } catch (Exception $e) {
        echo "<script>alert('Kesalahan: " . $e->getMessage() . "');window.location.href='index.php'</script>";
    }
}
?>
