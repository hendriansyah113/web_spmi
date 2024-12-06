<?php
// Load file koneksi.php
include "koneksi.php";

if (isset($_POST['import'])) { // Jika user mengklik tombol Import
    $nama_file_baru = 'data.xlsx';

    // Load library PHPExcel nya
    require_once 'PHPExcel/PHPExcel.php';

    $excelreader = new PHPExcel_Reader_Excel2007();
    $loadexcel = $excelreader->load('tmp/' . $nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
    $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);

    $numrow = 1;
    foreach ($sheet as $row) {
        // Ambil data pada excel sesuai Kolom
        $id = $row['A'];
        $nik = $row['B'];
        $nama = $row['C'];
        $tanggal_lahir_excel = $row['D']; // Simpan tanggal lahir dari excel
        $jenis_kelamin = $row['E'];
        $telp = $row['F'];
        $alamat = $row['G'];
        $agama = $row['H'];
        $pekerjaan = $row['I'];

        // Cek jika semua data tidak diisi
        if (empty($id) && empty($nik) && empty($nama) && empty($tanggal_lahir_excel) && empty($jenis_kelamin) && empty($telp) && empty($alamat) && empty($agama) && empty($pekerjaan)) {
            continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
        }

        // Cek $numrow apakah lebih dari 1
        // Artinya karena baris pertama adalah nama-nama kolom
        // Jadi dilewat saja, tidak usah diimport
        if ($numrow > 1) {
            // Format tanggal lahir menjadi format yang sesuai untuk MySQL (YYYY-MM-DD)
            $tanggal_lahir = date('Y-m-d', strtotime($tanggal_lahir_excel));

            // Buat query Insert
            $query = "INSERT INTO ilkomfitria4 (id, nik, nama, tanggal_lahir, telp, jenis_kelamin, alamat, agama, pekerjaan) 
                      VALUES ('$id','$nik','$nama','$tanggal_lahir','$telp','$jenis_kelamin','$alamat','$agama','$pekerjaan')";

            // Eksekusi $query
            $result = mysqli_query($connect, $query);

            if (!$result) {
                die('Error: ' . mysqli_error($connect));
            }
        }

        $numrow++; // Tambah 1 setiap kali looping
    }

    header('location: index.php'); // Redirect ke halaman awal
}
?>
