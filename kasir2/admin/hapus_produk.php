<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID produk tidak ditemukan");
}

$id = $_GET['id'];

// SOFT DELETE (NONAKTIFKAN PRODUK)
mysqli_query($koneksi,
    "UPDATE produk SET status='nonaktif' WHERE id_produk='$id'"
);

// kembali ke halaman produk
header("Location: produk.php");
exit;
