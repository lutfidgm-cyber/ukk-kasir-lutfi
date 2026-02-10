<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/koneksi.php";

if (isset($_POST['simpan'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi,
        "INSERT INTO produk (nama_produk, harga, stok)
         VALUES ('$nama', '$harga', '$stok')");

    header("Location: produk.php");
}
?>

<h2>Tambah Produk</h2>

<form method="post">
    Nama Produk <br>
    <input type="text" name="nama" required><br><br>

    Harga <br>
    <input type="number" name="harga" required><br><br>

    Stok <br>
    <input type="number" name="stok" required><br><br>

    <button type="submit" name="simpan">Simpan</button>
</form>

