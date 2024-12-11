<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda
$database = 'audit'; // Nama database

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub_audit_id = $_POST['sub_audit_id'];
    $kelengkapan_dokumen = $_POST['kelengkapan_dokumen'];
    $catatan = $_POST['catatan'];

    $query = "UPDATE audit_soal SET kelengkapan_dokumen = ?, catatan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $kelengkapan_dokumen, $catatan, $sub_audit_id);

    if ($stmt->execute()) {
        header('Location: index.php?success=1');
    } else {
        header('Location: index.php?error=1');
    }
}
