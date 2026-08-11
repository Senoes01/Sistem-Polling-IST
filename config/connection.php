<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'db_polling'; // Pastikan nama database ini sudah sesuai di Laragon Anda

// Menggunakan MySQLi sesuai dengan kode login.php
$con = mysqli_connect($host, $user, $pass, $db);

// Cek koneksi, jika gagal akan memunculkan error
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
    exit();
}

// Tulisan "Koneksi berhasil" sengaja dihilangkan agar tidak merusak tampilan form login
?>

