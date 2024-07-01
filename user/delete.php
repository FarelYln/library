<?php 

require_once __DIR__ ."/../koneksi.php";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $query = mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id'");

    
    if ($query) {
        header('Location: index.php');
    } else {
        echo "Gagal menghapus user.";
    }
}