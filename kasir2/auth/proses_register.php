<?php
include "../config/koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);
$role     = $_POST['role'];

$query = mysqli_query($koneksi,
    "INSERT INTO users (username, password, role)
     VALUES ('$username', '$password', '$role')");

if ($query) {
    echo "Register berhasil <a href='login.php'>Login</a>";
} else {
    echo "Register gagal";
}
?>
