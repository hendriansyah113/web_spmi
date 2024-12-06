<?php
// Load file koneksi.php
include "koneksi.php";

if (isset($_POST['import'])) { // Jika user mengklik tombol Import
    $nama_file_baru = 'data.xlsx';

    // Load librari PHPExcel nya
    require_once 'PHPExcel/PHPExcel.php';

    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('tmp/' . $nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

    $numrow = 1;
    foreach ($sheet as $row) {
        // Ambil data pada excel sesuai Kolom
        $id = $row['A']; // Ambil data NIS
        $tanggal_lahir = $row['B']; // Ambil data nama
        $jumlah_kelahiran = $row['C']; // Ambil data jenis kelamin

        // Cek jika semua data tidak diisi
        if ($id == "" && $tanggal_lahir == "" && $jumlah_kelahiran == "")
            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if ($numrow > 1) {
            // Format the date before inserting into the database
            $formatted_date = date('Y-m-d', strtotime($tanggal_lahir));

            // Buat query Insert
            $query = "INSERT INTO ilkomfitria3 VALUES('" . $id . "','" . $formatted_date . "','" . $jumlah_kelahiran . "')";

            // Eksekusi $query
            mysqli_query($connect, $query);
        }

        $numrow++; // Tambah 1 setiap kali looping
    }
}

header('location: index.php'); // Redirect ke halaman awal
?>