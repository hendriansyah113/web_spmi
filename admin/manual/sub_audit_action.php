<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root'; // Ganti dengan username MySQL Anda
$password = ''; // Ganti dengan password MySQL Anda
$database = 'web_spmi'; // Nama database

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $database);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sub_audit_id = $_POST['sub_audit_id'];
    $kelengkapan_dokumen = $_POST['kelengkapan_dokumen'];
    $catatan = $_POST['catatan'];
    $prodi = $_POST['prodi']; // Menangkap prodi
    $id_pelaksanaan = $_POST['id_pelaksanaan']; // Menangkap ID pelaksanaan
    $tahun = $_POST['tahun']; // Menangkap tahun

    // Menentukan kolom yang digunakan untuk kelengkapan dokumen berdasarkan prodi
    if ($prodi === 'Farmasi') {
        $kolom_kel_dokumen = 'kelengkapan_dokumen_farmasi';
        $kolom_catatan = 'catatan_farmasi';
    } else {
        $kolom_kel_dokumen = 'kelengkapan_dokumen_ak';
        $kolom_catatan = 'catatan_ak';
    }

    // Ambil nama standar berdasarkan sub_audit_id
    $query_standar = "SELECT * FROM audit_soal WHERE id = $sub_audit_id";
    $result_standar = $conn->query($query_standar);

    if ($result_standar->num_rows > 0) {
        $row = $result_standar->fetch_assoc();
        $nama_standar = $row['uraian'];
    } else {
        echo "<script>alert('Nama standar tidak ditemukan.'); window.history.back();</script>";
        exit;
    }


    $query = "UPDATE audit_soal SET $kolom_kel_dokumen = ?, $kolom_catatan = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssi', $kelengkapan_dokumen, $catatan, $sub_audit_id);

    if ($stmt->execute()) {
        // Membuat pesan notifikasi
        $form_link = "http://localhost/web_spmi/admin/manual/penilaian.php?id_pelaksanaan=$id_pelaksanaan&tahun=$tahun&prodi=$prodi"; // Link ke form
        $message = ($kelengkapan_dokumen === 'Lengkap')
            ? "Form audit Anda untuk standar '$nama_standar' di $prodi tahun $tahun telah diterima. Klik link berikut untuk melihat detail: <a href='$form_link'>Lihat Form</a>"
            : "Form audit Anda untuk standar '$nama_standar' di $prodi tahun $tahun telah ditolak. Catatan: $catatan. Klik link berikut untuk melihat detail: <a href='$form_link'>Lihat Form</a>";

        // Query untuk menyimpan notifikasi
        $notifikasi_query = "INSERT INTO notifications (role, message, form_link) VALUES ('auditee', ?, ?)";
        $notif_stmt = $conn->prepare($notifikasi_query);
        $notif_stmt->bind_param('ss', $message, $form_link);
        $notif_stmt->execute();
        echo "<script>
        alert('Berhasil Verifikasi.');
        window.location.href = document.referrer;
    </script>";
    } else {
        error_log("Error: " . $conn->error);
        echo "<script>alert('Terjadi kesalahan saat menyimpan data ke database.'); window.history.back();</script>";
    }
}
