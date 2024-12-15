<?php

session_start();
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_spmi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

define('BASE_URL', 'http://localhost/web_spmi/');

// Mengecek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    // Jika belum login, arahkan ke halaman login
    header('Location: ' . BASE_URL . 'login.php');
    exit(); // Pastikan skrip tidak melanjutkan eksekusi setelah redirect
}
