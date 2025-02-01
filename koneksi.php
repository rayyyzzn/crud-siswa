<?php
// Ganti dengan konfigurasi yang sesuai dengan server dan database kamu
$host = "localhost"; // atau IP server
$user = "root"; // username MySQL
$password = ""; // password MySQL
$dbname = "crud"; // ganti dengan nama database kamu

// Koneksi ke database
$kon = mysqli_connect($host, $user, $password, $dbname);

// Cek apakah koneksi berhasil
if (!$kon) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
