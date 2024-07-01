<?php
require_once __DIR__ . "/../koneksi.php";


$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM pinjaman WHERE id = '$id'");

    header('Location: index.php');
