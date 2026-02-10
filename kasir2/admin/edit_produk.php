<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id'")
);

if (isset($_POST['update'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi,
        "UPDATE produk SET 
         nama_produk='$nama',
         harga='$harga',
         stok='$stok'
         WHERE id_produk='$id'");

    header("Location: produk.php");
}
?>

<h2>Edit Produk</h2>

<form method="post">
    Nama Produk <br>
    <input type="text" name="nama" value="<?= $data['nama_produk'] ?>"><br><br>

    Harga <br>
    <input type="number" name="harga" value="<?= $data['harga'] ?>"><br><br>

    Stok <br>
    <input type="number" name="stok" value="<?= $data['stok'] ?>"><br><br>

    <button type="submit" name="update">Update</button>
</form>
