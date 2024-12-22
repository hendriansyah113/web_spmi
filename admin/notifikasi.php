<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_spmi';

$conn = new mysqli($host, $username, $password, $database);

// Ambil data dari permintaan
$data = json_decode(file_get_contents('php://input'), true);
$notification_id = $data['id'];

// Perbarui status notifikasi
$query = "UPDATE notifications SET is_read = 1 WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $notification_id);

if ($stmt->execute()) {
    http_response_code(200); // Berhasil
} else {
    http_response_code(500); // Gagal
}
