<?php
// Include / load file koneksi.php
include "koneksi.php";

// Ambil data yang dikirim dari formulir
$id = $_POST['id']; // Ambil data id dan masukkan ke dalam variabel id
$nik = $_POST['nik']; // Ambil data nik dan masukkan ke dalam variabel nik
$nama = $_POST['nama']; // Ambil data nama dan masukkan ke dalam variabel nama
$tanggal_lahir = $_POST['tanggal_lahir']; // Ambil data tanggal_lahir dan masukkan ke dalam variabel tanggal_lahir
$jenis_kelamin = $_POST['jenis_kelamin']; // Ambil data jenis_kelamin dan masukkan ke dalam variabel jenis_kelamin
$telp = $_POST['telp']; // Ambil data telp dan masukkan ke dalam variabel telp
$alamat = $_POST['alamat']; // Ambil data alamat dan masukkan ke dalam variabel alamat
$agama = $_POST['agama']; // Ambil data agama dan masukkan ke dalam variabel agama
$pekerjaan = $_POST['pekerjaan']; // Ambil data pekerjaan dan masukkan ke dalam variabel pekerjaan

// Proses simpan ke Database
$sql = $pdo->prepare("INSERT INTO ilkomfitria4 (id, nik, nama, tanggal_lahir, jenis_kelamin, telp, alamat, agama, pekerjaan) VALUES(:id, :nik, :nama, :tanggal_lahir, :jenis_kelamin, :telp, :alamat, :agama, :pekerjaan)");

$index = 0; // Set indeks awal array ke 0

foreach ($id as $dataid) {
    // Konversi tanggal_lahir ke format yang benar (YYYY-MM-DD)
    $formatted_date = date("Y-m-d", strtotime($tanggal_lahir[$index]));

    // Bind parameters
    $sql->bindParam(':id', $dataid);
    $sql->bindParam(':nik', $nik[$index]);
    $sql->bindParam(':nama', $nama[$index]);
    $sql->bindParam(':tanggal_lahir', $formatted_date);
    $sql->bindParam(':jenis_kelamin', $jenis_kelamin[$index]);
    $sql->bindParam(':telp', $telp[$index]);
    $sql->bindParam(':alamat', $alamat[$index]);
    $sql->bindParam(':agama', $agama[$index]);
    $sql->bindParam(':pekerjaan', $pekerjaan[$index]);

    $sql->execute(); // Eksekusi query insert

    $index++; // Tambah 1 setiap kali perulangan
}

// Buat sebuah alert sukses, dan redirect ke halaman awal (index.php)
echo "<script>alert('Data berhasil disimpan');window.location = 'index.php';</script>";
?>
