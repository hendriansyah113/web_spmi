<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data ID yang dikirim oleh form_ubah.php melalui URL
$id = $_GET['id'];
// Ambil Data yang Dikirim dari Form
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$tanggal_dibuat = $_POST['tanggal_dibuat'];

// Ambil data file yang dipilih dari form
$file_dokumen = $_FILES['file_dokumen']['name'];
$tmp = $_FILES['file_dokumen']['tmp_name'];

// Cek apakah user ingin mengubah file dokumen atau tidak
if(empty($file_dokumen)){ // Jika user tidak memilih file dokumen pada form
    // Lakukan proses update tanpa mengubah file dokumennya
    // Proses ubah data ke Database
    $sql = $pdo->prepare("UPDATE kebijakan SET judul=:judul, deskripsi=:deskripsi, tanggal_dibuat=:tanggal_dibuat WHERE id=:id");
    $sql->bindParam(':judul', $judul);
    $sql->bindParam(':deskripsi', $deskripsi);
    $sql->bindParam(':tanggal_dibuat', $tanggal_dibuat);
    $sql->bindParam(':id', $id);
    $execute = $sql->execute(); // Eksekusi / Jalankan query
    if($execute){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header("location: index.php"); // Redirect ke halaman index.php
    } else {
        // Jika Gagal, Lakukan :
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
        echo "<br><a href='form_ubah.php?id=$id'>Kembali Ke Form</a>";
    }
} else { // Jika user memilih file dokumen pada form
    // Lakukan proses update termasuk mengganti file dokumen sebelumnya
    // Rename nama file dokumennya dengan menambahkan tanggal dan jam upload
    $file_baru = date('dmYHis').$file_dokumen;
    // Set path folder tempat menyimpan file dokumennya
    $path = "dokumen/".$file_baru;
    // Proses upload
    if(move_uploaded_file($tmp, $path)){ // Cek apakah file berhasil diupload atau tidak
        // Query untuk menampilkan data kebijakan berdasarkan ID yang dikirim
        $sql = $pdo->prepare("SELECT file_path FROM kebijakan WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->execute(); // Eksekusi query
        $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
        // Cek apakah file dokumen sebelumnya ada di folder dokumen
        if(is_file("dokumen/".$data['file_path'])) { // Jika file ada
            unlink("dokumen/".$data['file_path']); // Hapus file dokumen sebelumnya yang ada di folder dokumen
        }
        // Proses ubah data ke Database
        $sql = $pdo->prepare("UPDATE kebijakan SET judul=:judul, deskripsi=:deskripsi, tanggal_dibuat=:tanggal_dibuat, file_path=:file_path WHERE id=:id");
        $sql->bindParam(':judul', $judul);
        $sql->bindParam(':deskripsi', $deskripsi);
        $sql->bindParam(':tanggal_dibuat', $tanggal_dibuat);
        $sql->bindParam(':file_path', $file_baru);
        $sql->bindParam(':id', $id);
        $execute = $sql->execute(); // Eksekusi / Jalankan query
        if($execute){ // Cek jika proses simpan ke database sukses atau tidak
            // Jika Sukses, Lakukan :
            header("location: index.php"); // Redirect ke halaman index.php
        } else {
            // Jika Gagal, Lakukan :
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<br><a href='form_ubah.php?id=$id'>Kembali Ke Form</a>";
        }
    } else {
        // Jika file gagal diupload, Lakukan :
        echo "Maaf, File gagal untuk diupload.";
        echo "<br><a href='form_ubah.php?id=$id'>Kembali Ke Form</a>";
    }
}
?>
