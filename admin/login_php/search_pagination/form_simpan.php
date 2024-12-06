<html>
<head>
<title>Data Kelahiran Kelurahan Pahandut</title>
</head>
<body>
<h1>Tambah Data Kelahiran</h1>
<form method="post" action="proses_simpan.php" enctype="multipart/form-data">
<table cellpadding="8">
<tr>
<td>Id</td>
<td><input type="text" name="id"></td>
</tr>
<tr>
<td>Tanggal Lahir</td>
<td><input type="date" name="tanggal_lahir"></td>
</tr>
<tr>
<td>Jumlah Kelahiran</td>
<td><input type="text" name="jumlah_kelahiran"></td>
</tr>
</table>
<hr>
<input type="submit" value="Simpan">
<a href="index.php"><input type="button" value="Batal"></a>
</form>
</body>
</html>