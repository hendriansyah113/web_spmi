<?php ob_start(); ?>
<html>
<head>

	<title>Cetak PDF</title>
	<style>
	.table {
		border-collapse: collapse;
		table-layout: fixed;
		width: 630px;
	}
	.table th {
		padding: 5px;
	}
	.table td {
		word-wrap: break-word;
		width: 20%;
		padding: 5px;
	}
	.kop-surat {
		text-align: left; /* Mengatur teks ke kiri */
		margin-bottom: 20px;
		display: flex; /* Menambahkan display flex untuk mengatur item */
		align-items: center; /* Menyusun item secara vertikal di tengah */
		position: relative; /* Menjadikan posisi relative */
	}

	.kop-surat img {
		max-width: 50px;
		margin-right: 10px; /* Menurunkan margin untuk jarak antara logo dan teks */
		float: left; /* Meletakkan gambar di sebelah kiri */
	}

	.kop-surat div {
		flex: 1; /* Menyesuaikan lebar div secara otomatis */
	}

	.kop-surat h3 {
		margin: 0; /* Menghilangkan margin atas dan bawah */
		font-size: 24px; /* Menyesuaikan ukuran font */
	}

	.kop-surat p {
		margin: 0;
	}

	.kop-surat hr {
		border-top: 2px solid #000;
		position: absolute; /* Menjadikan posisi absolute */
		width: 100%; /* Lebar garis menjadi 100% dari parent */
		bottom: 0; /* Menempatkan garis di bagian bawah parent */
	}
</style>

</head>
<body>
	<!-- Kop Surat -->
	<div class="kop-surat">
		<img src="images/logo.jpg" alt="Logo">
		<div>
			<h3>PEMERINTAH KOTA PALANGKA RAYA</h3>
			<p>KECAMATAN JEKAN RAYA</p>
			<p>KELURAHAN PAHANDUT</p>
			<p>Alamat : Jl. K. H. Ahmad Dahlan, Pahandut, Kec. Pahandut, Kota Palangka Raya, Kalimantan Tengah 74874</p>
			<hr>
		</div>
	</div>
	<?php
	// Load file koneksi.php
	include "koneksi.php";

	$tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
	$tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

	if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
		// Buat query untuk menampilkan semua data transaksi
		$query = "SELECT * FROM ilkomfitria3";

		$label = "Semua Data Kelahiran";
	} else { // Jika terisi
		// Buat query untuk menampilkan data transaksi sesuai periode
		$tgl_awal = date('Y-m-d', strtotime($tgl_awal)); // Ubah format tanggal jadi yyyy-mm-dd
		$tgl_akhir = date('Y-m-d', strtotime($tgl_akhir)); // Ubah format tanggal jadi yyyy-mm-dd
		$label = 'Periode Tanggal Lahir ' . $tgl_awal . ' s/d ' . $tgl_akhir;
		$query = "SELECT * FROM ilkomfitria3 WHERE (tanggal_lahir BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
	}
	?>
	<h4 style="margin-bottom: 5px;">Data Kelahiran</h4>
	<?php echo $label ?>
	<table class="table" border="1" width="100%" style="margin-top: 10px;">
		<tr>
			<th>Id</th>
			<th>Tanggal Lahir</th>
			<th>Jumlah kelahiran</th>
		</tr>

		<?php
		$sql = $pdo->prepare($query); // Eksekusi/Jalankan query dari variabel $query
		$sql->execute(); // Ambil jumlah data dari hasil eksekusi $sql
		$row = $sql->rowCount(); // Ambil jumlah data dari hasil eksekusi $sql

		if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
			while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql
				($data['tanggal_lahir']); // Ubah format tanggal jadi dd-mm-yyyy

				echo "<tr>";
				echo "<td>" . $data['id'] . "</td>";
				echo "<td>" . $data['tanggal_lahir'] . "</td>";
				echo "<td>" . $data['jumlah_kelahiran'] . "</td>";
				echo "</tr>";
			}
		} else { // Jika data tidak ada
			echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
		}
		?>
	</table>
</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require 'libraries/html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P', 'A4', 'en');
$pdf->WriteHTML($html);
$pdf->Output('Data Kelahiran.pdf', 'D');
?>