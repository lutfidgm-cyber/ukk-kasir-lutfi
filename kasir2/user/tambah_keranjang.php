<?php
session_start();
include "../config/koneksi.php";

$id_produk = $_POST['id_produk'];
$jumlah    = $_POST['jumlah'];

$data = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk='$id_produk'")
);

$_SESSION['keranjang'][$id_produk] = [
    'nama'   => $data['nama_produk'],
    'harga'  => $data['harga'],
    'jumlah' => $jumlah
];

header("Location: transaksi.php");

