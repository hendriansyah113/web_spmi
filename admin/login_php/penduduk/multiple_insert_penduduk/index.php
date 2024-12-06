<html>
<head>
	<title>Multiple Insert</title>
</head>
<body>
	<h1>Multiple Insert Penduduk</h1>
	<a href="form.php">Tambah Data</a><br><br>
	<a href="multiple_delete_penduduk" button type="submit" name="filter" value="true" class="btn btn-primary">Hapus Data</button></a><br></br>
	<a href="http://localhost/coba_kelurahan/login_php/Penduduk" class="btn btn-search">Kembali</a>
	
	<table border="1" cellpadding="5">
		<tr>
			<th>ID</th>
			<th>NIK</th>
			<th>NAMA</th>
			<th>TANGGAL LAHIR</th>
			<th>JENIS KELAMIN</th>
			<th>TELP</th>
			<th>ALAMAT</th>
			<th>AGAMA</th>
			<th>PEKERJAAN</th>
		</tr>
		<?php
		// Load file koneksi.php
		include "koneksi.php";
		
		// Buat query untuk menampilkan semua data siswa
		$sql = $pdo->prepare("SELECT * FROM ilkomfitria4 ORDER BY id");
		$sql->execute(); // Eksekusi querynya
		
		$no = 1; // Untuk penomoran tabel, di awal set dengan 1
		while($data = $sql->fetch()){ // Ambil semua data dari hasil eksekusi $sql
		 echo "<tr>";
		 echo "<td>".$data['id']."</td>";
         echo "<td>".$data['nik']."</td>";
         echo "<td>".$data['nama']."</td>";
         echo "<td>".$data['tanggal_lahir']."</td>";
         echo "<td>".$data['jenis_kelamin']."</td>";
         echo "<td>".$data['telp']."</td>";
         echo "<td>".$data['alamat']."</td>";
         echo "<td>".$data['agama']."</td>";
         echo "<td>".$data['pekerjaan']."</td>";
			echo "</tr>";
			
			$no++; // Tambah 1 setiap kali looping
		}
		?>
	</table>
</body>
</html>
