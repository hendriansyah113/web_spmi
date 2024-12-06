<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];
// Ambil Data yang Dikirim dari Form
$tanggal_lahir = $_POST['tanggal_lahir'];
$jumlah_kelahiran = $_POST['jumlah_kelahiran'];
// Proses ubah data ke Database
$sql = $pdo->prepare("UPDATE ilkomfitria3 SET id=:id, tanggal_lahir=:tanggal_lahir, jumlah_kelahiran=:jumlah_kelahiran WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->bindParam(':tanggal_lahir', $tanggal_lahir);
$sql->bindParam(':jumlah_kelahiran', $jumlah_kelahiran);
$sql->bindParam(':id', $id);
$execute = $sql->execute(); // Eksekusi / Jalankan query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: index.php"); // Redirect ke halaman index.php
}else{
// Jika Gagal, Lakukan :
echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
}
// Hapus file foto sebelumnya yang ada di folder images
// Proses ubah data ke Database
$sql = $pdo->prepare("UPDATE ilkomfitria3 SET id=:id, tanggal_lahir=:tanggal_lahir, jumlah_kelahiran=:jumlah_kelahiran WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->bindParam(':tanggal_lahir', $tanggal_lahir);
$sql->bindParam(':jumlah_kelahiran', $jumlah_kelahiran);
$sql->bindParam(':id', $id);
$execute = $sql->execute(); // Eksekusi / Jalankan query
if($sql){ // Cek jika proses simpan ke database sukses atau tidak
// Jika Sukses, Lakukan :
header("location: index.php"); // Redirect ke halaman index.php

// Jika Gagal, Lakukan :
echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";

// Jika gambar gagal diupload, Lakukan :
echo "Maaf, Gambar gagal untuk diupload.";
echo "<br><a href='form_ubah.php'>Kembali Ke Form</a>";
}
?>