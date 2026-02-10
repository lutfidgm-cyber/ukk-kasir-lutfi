<?php
session_start();
include "../config/koneksi.php";

$id_user = $_SESSION['id_user'];
$total   = 0;

foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['harga'] * $item['jumlah'];
}

mysqli_query($koneksi,
    "INSERT INTO penjualan (id_user, tanggal, total)
     VALUES ('$id_user', NOW(), '$total')"
);

$id_penjualan = mysqli_insert_id($koneksi);

foreach ($_SESSION['keranjang'] as $id_produk => $item) {
    $subtotal = $item['harga'] * $item['jumlah'];

    mysqli_query($koneksi,
        "INSERT INTO detail_penjualan 
        (id_penjualan, id_produk, jumlah, harga, subtotal)
        VALUES 
        ('$id_penjualan','$id_produk','{$item['jumlah']}','{$item['harga']}','$subtotal')"
    );

    mysqli_query($koneksi,
        "UPDATE produk SET stok = stok - {$item['jumlah']}
         WHERE id_produk='$id_produk'"
    );
}

unset($_SESSION['keranjang']);
echo "Transaksi berhasil <a href='transaksi.php'>Kembali</a>";
