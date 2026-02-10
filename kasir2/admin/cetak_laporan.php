<?php
include "../config/koneksi.php";

$id = $_GET['id'];

/* ambil data transaksi */
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
    <title>Cetak Struk</title>

    <style>
        body {
            font-family: Arial;
            width: 300px;
        }
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        .center {
            text-align: center;
        }
        table {
            width: 100%;
            font-size: 12px;
        }
        hr {
            border: 1px dashed #000;
        }

        @media print {
            button {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

<h3>KASIR2 MART</h3>
<p class="center">
    Jl. Contoh No. 123<br>
    Telp: 08xxxxxxxx
</p>

<hr>

<table>
    <tr>
        <td>ID</td>
        <td>: <?= $trx['id_penjualan'] ?></td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td>: <?= date('d-m-Y H:i', strtotime($trx['tanggal'])) ?></td>
    </tr>
    <tr>
        <td>Kasir</td>
        <td>: <?= $trx['username'] ?></td>
    </tr>
</table>

<hr>

<table>
<?php
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
    <td><?= $d['nama_produk'] ?></td>
    <td align="right"><?= $d['jumlah'] ?> x <?= number_format($d['harga']) ?></td>
</tr>
<?php } ?>
</table>

<hr>

<table>
    <tr>
        <td><b>TOTAL</b></td>
        <td align="right"><b><?= number_format($total) ?></b></td>
    </tr>
</table>

<hr>

<p class="center">
    Terima kasih 🙏<br>
    Barang yang sudah dibeli<br>
    tidak dapat dikembalikan
</p>

<button onclick="window.print()">Cetak</button>

</body>
</html>
