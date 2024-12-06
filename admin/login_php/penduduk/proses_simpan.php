<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$id = $_POST['nik'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$telp = $_POST['telp'];
$alamat = $_POST['alamat'];
$agama = $_POST['agama'];
$pekerjaan = $_POST['pekerjaan'];
$sql = $pdo->prepare("INSERT INTO ilkomfitria4(id, nik, nama, tanggal_lahir, jenis_kelamin, telp, alamat, agama, pekerjaan)
VALUES(:nik, :nik, :nama, :tanggal_lahir, :jk, :telp, :alamat, :agama, :pekerjaan)");
$sql->bindParam(':nik', $id);
$sql->bindParam(':nama', $nama);
$sql->bindParam(':tanggal_lahir', $tanggal_lahir);
$sql->bindParam(':jk', $jenis_kelamin);
$sql->bindParam(':telp', $telp);
$sql->bindParam(':alamat', $alamat);
$sql->bindParam(':agama', $agama);
$sql->bindParam(':pekerjaan', $pekerjaan);
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