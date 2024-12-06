<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil Data yang Dikirim dari Form
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$tanggal_dibuat = $_POST['tanggal_dibuat'];
$file_path = $_POST['file_path'];

$sql = $pdo->prepare("INSERT INTO kebijakan(judul, deskripsi, tanggal_dibuat, file_path)
VALUES(:judul, :deskripsi, :tanggal_dibuat, :file_path)");

$sql->bindParam(':judul', $judul);
$sql->bindParam(':deskripsi', $deskripsi);
$sql->bindParam(':tanggal_dibuat', $tanggal_dibuat);
$sql->bindParam(':file_path', $file_path);

$sql->execute(); // Eksekusi query insert

if($sql){ 
    // Jika Sukses, Lakukan :
    header("location: index.php"); // Redirect ke halaman index.php
} else {
    // Jika Gagal, Lakukan :
    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
    echo "<br><a href='form_simpan.php'>Kembali Ke Form</a>";
}
?>
