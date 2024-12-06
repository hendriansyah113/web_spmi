<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data NIS yang dikirim oleh index.php melalui URL
$id = $_GET['id'];

$sql = $pdo->prepare("DELETE FROM kebijakan WHERE id=:id");
$sql->bindParam(':id', $id);
$execute = $sql->execute(); // Eksekusi / Jalankan query
if($execute){ // Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: index.php"); // Redirect ke halaman index.php

// Jika Gagal, Lakukan :
echo "Data gagal dihapus. <a href='index.php'>Kembali</a>";
}
?>