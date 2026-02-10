<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";

if (!isset($_GET['id'])) {
    die("ID transaksi tidak ditemukan");
}

$id = $_GET['id'];

/* ambil info utama transaksi */
$trx = mysqli_fetch_assoc(mysqli_query($koneksi, "
    SELECT penjualan.*, users.username
    FROM penjualan
    JOIN users ON penjualan.id_user = users.id_user
    WHERE penjualan.id_penjualan = '$id'
"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Penjualan</title>
</head>
<body>

<h2>Detail Penjualan</h2>
<a href="laporan.php">⬅ Kembali ke Laporan</a>

<hr>

<table cellpadding="5">
    <tr>
        <td><b>ID Transaksi</b></td>
        <td>: <?= $trx['id_penjualan'] ?></td>
    </tr>
    <tr>
        <td><b>Tanggal</b></td>
        <td>: <?= date('d-m-Y H:i:s', strtotime($trx['tanggal'])) ?></td>
    </tr>
    <tr>
        <td><b>Kasir</b></td>
        <td>: <?= $trx['username'] ?></td>
    </tr>
    <tr>
        <td><b>Total</b></td>
        <td>: <b><?= number_format($trx['total']) ?></b></td>
    </tr>
</table>

<hr>

<h3>Detail Produk</h3>

<table border="1" cellpadding="10">
<tr>
    <th>No</th>
    <th>Produk</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
</tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "
    SELECT detail_penjualan.*, produk.nama_produk
    FROM detail_penjualan
    JOIN produk ON detail_penjualan.id_produk = produk.id_produk
    WHERE detail_penjualan.id_penjualan = '$id'
");

$total = 0;
while ($d = mysqli_fetch_assoc($query)) {
    $total += $d['subtotal'];
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $d['nama_produk'] ?></td>
    <td><?= number_format($d['harga']) ?></td>
    <td><?= $d['jumlah'] ?></td>
    <td><?= number_format($d['subtotal']) ?></td>
</tr>
<?php } ?>

<tr>
    <td colspan="4"><b>Total</b></td>
    <td><b><?= number_format($total) ?></b></td>
</tr>
</table>
<a href="cetak_laporan.php?id=<?= $trx['id_penjualan'] ?>" target="_blank">
    🖨 Cetak Struk
</a>


</body>
</html>
