<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda
$database = 'web_spmi'; // Nama database

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $audit_id = $_POST['audit_id'];
    $kelengkapan_dokumen = $_POST['kelengkapan_dokumen'];
    $catatan = $_POST['catatan'];
    $prodi = $_POST['prodi']; // Menangkap prodi

    // Menentukan kolom yang digunakan untuk kelengkapan dokumen berdasarkan prodi
    if ($prodi === 'Farmasi') {
        $kolom_kel_dokumen = 'kelengkapan_dokumen_farmasi';
        $kolom_catatan = 'catatan_farmasi';
    } else {
        $kolom_kel_dokumen = 'kelengkapan_dokumen_ak';
        $kolom_catatan = 'catatan_ak';
    }

    $query = "UPDATE audit_dokumen SET $kolom_kel_dokumen = ?, $kolom_catatan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $kelengkapan_dokumen, $catatan, $audit_id);

    if ($stmt->execute()) {
        echo "<script>
        alert('Berhasil Verifikasi.');
        window.location.href = document.referrer;
    </script>";
    } else {
        error_log("Error: " . $conn->error);
        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.'); window.history.back();</script>";
    }
}
