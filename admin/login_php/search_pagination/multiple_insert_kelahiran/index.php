<html>
<head>
	<title>Multiple Insert Kelahiran</title>
</head>
<body>
	<h1>Multiple Insert</h1>
	<a href="form.php">Tambah Data Kelahiran</a><br><br>
	<a href="multiple_delete_kelahiran" button type="submit" name="filter" value="true" class="btn btn-primary">Hapus Data</button></a><br></br>
	<a href="http://localhost/coba_kelurahan/login_php/search_pagination" class="btn btn-search">Kembali</a>

	
	<table border="1" cellpadding="5">
		<tr>
			<th>ID</th>
			<th>Tanggal Lahir</th>
			<th>Jumlah Kelahiran</th>
		</tr>
		<?php
		// Load file koneksi.php
		include "koneksi.php";
		
		// Buat query untuk menampilkan semua data siswa
		$sql = $pdo->prepare("SELECT * FROM ilkomfitria3 ORDER BY id");
		$sql->execute(); // Eksekusi querynya
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
			echo "<tr>";
			echo "<td>".$data['id']."</td>";
			echo "<td>".$data['tanggal_lahir']."</td>";
			echo "<td>".$data['jumlah_kelahiran']."</td>";
			echo "</tr>";
			
			$no++; // Tambah 1 setiap kali looping
		}
		?>
	</table>
</body>
</html>
