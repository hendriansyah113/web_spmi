<html>
<head>
<title>Data Kelahiran Kelurahan Pahandut</title>
</head>
<body>
<h1>Ubah Data Kelahiran</h1>
<?php
// Load file koneksi.php
include "koneksi.php";
// Ambil data NIM yang dikirim oleh index.php melalui URL
$id = $_GET['id'];
// Query untuk menampilkan data siswa berdasarkan ID yang dikirim
$sql = $pdo->prepare("SELECT * FROM ilkomfitria3 WHERE id=:id");
$sql->bindParam(':id', $id);
$sql->execute(); // Eksekusi query insert
$data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
?>
<form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
<table cellpadding="8">
<tr>
<td>tanggal lahir</td>
<td><input type="date" name="tanggal_lahir" value="<?php echo $data['tanggal_lahir']; ?>"></td>
</tr>
<tr>
<td>jumlah kelahiran</td>
<td><input type="text" name="jumlah_kelahiran" value="<?php echo $data['jumlah_kelahiran']; ?>"></td>
</tr>
</table>
<hr>
<input type="submit" value="Ubah">
<a href="index.php"><input type="button" value="Batal"></a>
</form>
</body>
</html>