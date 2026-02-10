<?php
session_start();
if ($_SESSION['role'] != 'kasir') {
    header("Location: ../auth/login.php");
}
include "../config/koneksi.php";

if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = [];
}
?>

<h2>Transaksi Penjualan</h2>

<form action="tambah_keranjang.php" method="post">
    Produk <br>
    <select name="id_produk" required>
        <option value="">-- Pilih Produk --</option>
        <?php
        $produk = mysqli_query($koneksi, "SELECT * FROM produk WHERE stok > 0");
        while ($p = mysqli_fetch_assoc($produk)) {
            echo "<option value='{$p['id_produk']}'>{$p['nama_produk']} - {$p['harga']}</option>";
        }
        ?>
    </select><br><br>

    Jumlah <br>
    <input type="number" name="jumlah" min="1" required><br><br>

    <button type="submit">Tambah</button>
</form>

<hr>

<h3>Keranjang</h3>
<table border="1" cellpadding="10">
<tr>
    <th>Produk</th>
    <th>Harga</th>
    <th>Jumlah</th>
    <th>Subtotal</th>
    <th>Aksi</th>
</tr>

<?php
$total = 0;
foreach ($_SESSION['keranjang'] as $id => $item) {
    $subtotal = $item['harga'] * $item['jumlah'];
    $total += $subtotal;
?>
<tr>
    <td><?= $item['nama'] ?></td>
    <td><?= $item['harga'] ?></td>
    <td><?= $item['jumlah'] ?></td>
    <td><?= $subtotal ?></td>
    <td><a href="hapus_keranjang.php?id=<?= $id ?>">Hapus</a></td>
</tr>
<?php } ?>

<tr>
    <td colspan="3"><b>Total</b></td>
    <td colspan="2"><b><?= $total ?></b></td>
</tr>
</table>

<br>
<a href="simpan_transaksi.php">Simpan Transaksi</a>
<a href="dashboard.php">kembali</a>