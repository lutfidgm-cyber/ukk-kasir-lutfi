<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include "../config/koneksi.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Penjualan</title>
</head>
<body>

<h2>Laporan Penjualan</h2>
<a href="dashboard.php">⬅ Kembali ke Dashboard</a>
<hr>

<table border="1" cellpadding="10">
    <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Kasir</th>
        <th>Total</th>
        <th>Detail</th>
    </tr>

<?php
$no = 1;
$query = mysqli_query($koneksi, "
    SELECT penjualan.*, users.username 
    FROM penjualan
    JOIN users ON penjualan.id_user = users.id_user
    ORDER BY penjualan.tanggal DESC
");

$grandTotal = 0;

while ($p = mysqli_fetch_assoc($query)) {
    $grandTotal += $p['total'];
?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $p['tanggal'] ?></td>
    <td><?= $p['username'] ?></td>
    <td><?= number_format($p['total']) ?></td>
    <td>
        <a href="detail_laporan.php?id=<?= $p['id_penjualan'] ?>">
            Lihat
        </a>
    </td>
</tr>
<?php } ?>

<tr>
    <td colspan="3"><b>Grand Total</b></td>
    <td colspan="2"><b><?= number_format($grandTotal) ?></b></td>
</tr>
</table>

</body>
</html>
