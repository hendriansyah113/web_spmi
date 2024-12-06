<?php
// Include / load file koneksi.php
include "koneksi.php";

// Ambil data yang dikirim dari formulir
$id = $_POST['id']; // Ambil data id dan masukkan ke dalam variabel id
$judul = $_POST['judul']; // Ambil data judul dan masukkan ke dalam variabel judul
$deskripsi = $_POST['deskripsi']; // Ambil data deskripsi dan masukkan ke dalam variabel deskripsi
$tanggal_dibuat = $_POST['tanggal_dibuat']; // Ambil data tanggal_dibuat dan masukkan ke dalam variabel tanggal_dibuat

// Proses simpan ke Database
$sql = $pdo->prepare("INSERT INTO kebijakan (id, judul, deskripsi, tanggal_dibuat, file_path) VALUES(:id, :judul, :deskripsi, :tanggal_dibuat, :file_path)");

$index = 0; // Set indeks awal array ke 0

foreach ($id as $dataid) {
    // Penanganan file upload
    $file_name = $_FILES['file_path']['name'][$index];
    $file_tmp = $_FILES['file_path']['tmp_name'][$index];
    $target_directory = "uploads/"; // Tentukan folder tujuan penyimpanan file
    $target_file = $target_directory . basename($file_name);

    // Pindahkan file yang diunggah ke folder tujuan
    if (move_uploaded_file($file_tmp, $target_file)) {
        // Konversi tanggal_dibuat ke format yang benar (YYYY-MM-DD)
        $formatted_date = date("Y-m-d", strtotime($tanggal_dibuat[$index]));

        // Bind parameters
        $sql->bindParam(':id', $dataid);
        $sql->bindParam(':judul', $judul[$index]);
        $sql->bindParam(':deskripsi', $deskripsi[$index]);
        $sql->bindParam(':tanggal_dibuat', $formatted_date);
        $sql->bindParam(':file_path', $target_file);

        $sql->execute(); // Eksekusi query insert
    } else {
        echo "<script>alert('Gagal mengupload file: {$file_name}');window.location = 'index.php';</script>";
        exit; // Jika file gagal diupload, hentikan eksekusi
    }

    $index++; // Tambah 1 setiap kali perulangan
}

// Buat sebuah alert sukses, dan redirect ke halaman awal (index.php)
echo "<script>alert('Data berhasil disimpan');window.location = 'index.php';</script>";
?>
