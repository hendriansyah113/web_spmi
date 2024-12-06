<?php
// Include / load file koneksi.php
include "koneksi.php";

// Ambil data yang dikirim dari form
$id = $_POST['id']; // Ambil data nis dan masukkan ke variabel nis
$tanggal_lahir = $_POST['tanggal_lahir']; // Ambil data nama dan masukkan ke variabel nama
$jumlah_kelahiran = $_POST['jumlah_kelahiran']; // Ambil data telp dan masukkan ke variabel telp

// Proses simpan ke Database
$sql = $pdo->prepare("INSERT INTO ilkomfitria3 VALUES(:id, :tanggal_lahir, :jumlah_kelahiran)");

$index = 0; // Set index array awal dengan 0
foreach($id as $dataid) { // Kita buat perulangan berdasarkan nis sampai data terakhir
    $tanggal_lahir_db = date('Y-m-d', strtotime($tanggal_lahir[$index])); // Konversi tanggal ke format 'YYYY-MM-DD'
    
    $sql->bindParam(':id', $dataid); // Set data nis
    $sql->bindParam(':tanggal_lahir', $tanggal_lahir_db); // Ambil dan set data nama sesuai index array dari $index
    $sql->bindParam(':jumlah_kelahiran', $jumlah_kelahiran[$index]); // Ambil dan set data telepon sesuai index array dari $index
    $sql->execute(); // Eksekusi query insert
    
    $index++; // Tambah 1 setiap kali looping
}

// Buat sebuah alert sukses, dan redirect ke halaman awal (index.php)
echo "<script>alert('Data berhasil disimpan');window.location = 'index.php';</script>";
?>
