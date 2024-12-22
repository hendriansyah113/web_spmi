<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'web_spmi';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("<script>alert('Koneksi gagal: " . $conn->connect_error . "'); window.history.back();</script>");
}

// Menangani upload dokumen
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['upload_dokumen'])) {
    $uploadDir = 'uploads/';
    $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'png', 'jpeg'];

    $fileName = basename($_FILES['upload_dokumen']['name']);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Validasi file
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        echo "<script>alert('Format file tidak didukung. Hanya file PDF, DOC, DOCX, JPG, PNG, dan JPEG yang diperbolehkan.'); window.history.back();</script>";
        exit();
    }

    // Membuat nama file unik
    $uniqueId = uniqid();
    $uploadedFile = $uniqueId . '_' . time() . '.' . $fileExtension; // Nama file unik
    $uploadFile = $uploadDir . $uploadedFile;

    // Mengambil prodi dan sub_audit_id dari form input
    $prodi = isset($_POST['prodi']) ? $_POST['prodi'] : '';
    $sub_audit_id = isset($_POST['sub_audit_id']) ? $_POST['sub_audit_id'] : '';
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';

    // Tentukan kolom yang akan diupdate berdasarkan prodi
    if ($prodi === 'Farmasi') {
        $kolomUpload = 'upload_dokumen_farmasi';
    } else {
        $kolomUpload = 'upload_dokumen_ak';
    }

    // Proses upload file
    if (move_uploaded_file($_FILES['upload_dokumen']['tmp_name'], $uploadFile)) {
        if (isset($_POST['audit_id'])) {
            $audit_id = $_POST['audit_id'];
            $stmt = $conn->prepare("UPDATE audit_dokumen SET $kolomUpload = ? WHERE id = ?");

            $stmt->bind_param("si", $uploadedFile, $audit_id);

            // Query untuk mengambil nama standar
            $queryNama = $conn->prepare("SELECT * FROM audit_dokumen WHERE id = ?");
            $queryNama->bind_param("i", $audit_id);
            $queryNama->execute();
            $result = $queryNama->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $uraian = $row['uraian'];
            }
        } elseif (isset($_POST['sub_audit_id'])) {
            $sub_audit_id = $_POST['sub_audit_id'];
            $stmt = $conn->prepare("UPDATE audit_soal SET $kolomUpload = ? WHERE id = ?");
            $stmt->bind_param("si", $uploadedFile, $sub_audit_id);

            // Query untuk mengambil nama standar
            $queryNama = $conn->prepare("SELECT uraian FROM audit_soal WHERE id = ?");
            $queryNama->bind_param("i", $sub_audit_id);
            $queryNama->execute();
            $result = $queryNama->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $uraian = $row['uraian'];
            }
        }
        if (isset($stmt) && $stmt->execute()) {
            // Tambahkan notifikasi ke tabel `notifications`
            $formLink = $_SERVER['HTTP_REFERER']; // Link form
            $message = "Auditee telah mengunggah dokumen untuk standar \"$uraian\" pada prodi $prodi tahun $tahun. <a href='$formLink'>Lihat dokumen</a>";
            $audite_id = $_SESSION['audite_id']; // ID penerima notifikasi
            $role = "auditee"; // Sesuaikan dengan role pengguna

            $notifStmt = $conn->prepare("INSERT INTO notifications (role, message, form_link) VALUES ('auditor', ?, ?)");
            $notifStmt->bind_param("ss", $message, $formLink);
            $notifStmt->execute();
            echo "<script>
                alert('Dokumen berhasil diunggah.');
                window.location.href = document.referrer;
            </script>";
        } else {
            error_log("Error: " . $conn->error);
            echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File upload gagal.'); window.history.back();</script>";
    }
}

$conn->close();
