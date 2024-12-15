<?php
// Memulai sesi
session_start();

// Menghapus semua data session
$_SESSION = array();

// Menghancurkan session
session_destroy();

// Redirect ke halaman login setelah logout
header('Location: login.php');
exit(); // Pastikan skrip tidak melanjutkan eksekusi setelah redirect