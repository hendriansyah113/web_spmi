<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$id = $_POST['id'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jumlah_kelahiran = $_POST['jumlah_kelahiran'];
$sql = $pdo->prepare("INSERT INTO ilkomfitria3(id, tanggal_lahir, jumlah_kelahiran)
VALUES(:id, :tanggal_lahir, :jumlah_kelahiran)");
$sql->bindParam(':id', $id);
$sql->bindParam(':tanggal_lahir', $tanggal_lahir);
$sql->bindParam(':jumlah_kelahiran', $jumlah_kelahiran);
$sql->execute(); // Eksekusi query insert
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: index.php"); // Redirect ke halaman index.php

// Jika Gagal, Lakukan :
echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";

// Jika gambar gagal diupload, Lakukan :
echo "Maaf, Gambar gagal untuk diupload.";
echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
?>