<?php
session_start();
if ($_SESSION['role'] != 'kasir') {
    header("Location: ../auth/login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Kasir</title>
</head>
<body>

<h2>Dashboard Kasir</h2>
<p>Halo, <b><?= $_SESSION['username']; ?></b></p>

<hr>

<ul>
    <li><a href="transaksi.php">🧾 Transaksi Penjualan</a></li>
    <li><a href="../auth/logout.php">🚪 Logout</a></li>
</ul>

</body>
</html>
