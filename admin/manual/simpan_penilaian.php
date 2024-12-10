<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_spmi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah data penilaian diterima
if (isset($_POST['penilaian']) && is_array($_POST['penilaian'])) {
    $penilaian = $_POST['penilaian'];

    $prodi = $_POST['prodi'];  // Ambil prodi yang diterima dari AJAX

    // Tentukan kolom skor berdasarkan prodi
    $kolom_skor = ($prodi === 'Farmasi') ? 'indikator.skor_farmasi' : 'indikator.skor_analisis_kesehatan';


    // Siapkan query untuk update penilaian berdasarkan indikator_id dan prodi
    $stmt = $conn->prepare("
        UPDATE indikator 
        SET $kolom_skor = ? 
        WHERE id = ? 
    ");

    // Cek jika prepare gagal
    if ($stmt === false) {
        die("Error preparing the statement: " . mysqli_error($conn));
    }

    // Loop melalui data penilaian dan update data berdasarkan indikator_id
    foreach ($penilaian as $data) {
        $indikator_id = $data['soal_id']; // ID indikator
        $poin = $data['poin']; // Poin penilaian

        // Bind dan execute query
        if (!$stmt->bind_param("ii", $poin, $indikator_id)) {
            die("Error binding parameters: " . $stmt->error);
        }

        if (!$stmt->execute()) {
            die("Error executing statement: " . $stmt->error);
        }
    }

    echo "Penilaian berhasil diperbarui!";
} else {
    echo "Tidak ada data penilaian yang diterima.";
}

// Tutup koneksi
$stmt->close();
mysqli_close($conn);
