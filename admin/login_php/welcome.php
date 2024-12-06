<?php
session_start(); // Start session nya
// Kita cek apakah user sudah login atau belum
// Cek nya dengan cara cek apakah terdapat session username atau tidak
if( ! isset($_SESSION['username'])){ // Jika tidak ada session username berarti dia belum login
header("location: index.php"); // Kita Redirect ke halaman index.php karena belum login
}
?>
<html>
<head>
<title>Halaman Setelah Login</title>
</head>
<body>
	<div class="center-text">
<h1>Selamat datang <?php echo $_SESSION['nama']; ?></h1>
<h4>Anda berhasil login ke dalam Website Kelurahan Pahandut</h4>
<h4><p class=><a href="penduduk">Edit Data Penduduk</a> </p><h4>
<p class=><a href="search_pagination">Edit Data Kelahiran</a> </p>
<a href="logout.php">Logout</a>
</body>
</html>