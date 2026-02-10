<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
}
include "../config/koneksi.php";
?>

<h2>Data Produk</h2>
<a href="tambah_produk.php">+ Tambah Produk</a>
<br><br>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Nama Produk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "SELECT * FROM produk WHERE status='aktif'");
while ($data = mysqli_fetch_assoc($query)) {
?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= $data['nama_produk'] ?></td>
        <td><?= $data['harga'] ?></td>
        <td><?= $data['stok'] ?></td>
        <td>
            <a href="edit_produk.php?id=<?= $data['id_produk'] ?>">Edit</a> |
            <a href="hapus_produk.php?id=<?= $data['id_produk'] ?>" 
               onclick="return confirm('Hapus produk?')">Hapus</a>
        </td>
    </tr>
<?php } ?>
</table>

<br>
<a href="dashboard.php">Kembali</a>
