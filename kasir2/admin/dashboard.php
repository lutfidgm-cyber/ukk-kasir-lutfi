<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/koneksi.php";

// hitung data
$jumlahProduk = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM produk"));
$jumlahUser   = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM users"));
$jumlahTransaksi = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM penjualan"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>

<h2>Dashboard Admin</h2>
<p>Halo, <b><?= $_SESSION['username']; ?></b></p>

<hr>

<ul>
    <li><a href="produk.php">📦 Kelola Produk</a></li>
    <li><a href="laporan.php">📊 Laporan Penjualan</a></li>
    <li><a href="../auth/logout.php">🚪 Logout</a></li>
</ul>

<hr>

<h3>Ringkasan Data</h3>
<table border="1" cellpadding="10">
    <tr>
        <th>Total Produk</th>
        <th>Total User</th>
        <th>Total Transaksi</th>
    </tr>
    <tr>
        <td><?= $jumlahProduk ?></td>
        <td><?= $jumlahUser ?></td>
        <td><?= $jumlahTransaksi ?></td>
    </tr>
</table>

</body>
</html>
