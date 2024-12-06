<html>
<head>
	<title>Multiple Insert Kebijakan</title>
	
	<!-- Load plugin jquery nya -->
	<script src="jquery.min.js" type="text/javascript"></script>
</head>
<body>
	<h1>Multiple Insert Kebijakan</h1>
	
	<form method="post" action="proses_kebijakan.php" enctype="multipart/form-data">
		<!-- Buat tombol untuk menambah form data -->
		<button type="button" id="btn-tambah-form">Tambah Data Form</button>
		<button type="button" id="btn-reset-form">Reset Form</button><br><br>
		
		<b>Data ke 1 :</b>
		<table>
			<tr>
				<td>Judul</td>
				<td><input type="text" name="judul[]" required></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><textarea name="deskripsi[]" required></textarea></td>
			</tr>
			<tr>
				<td>Tanggal Dibuat</td>
				<td><input type="date" name="tanggal_dibuat[]" required></td>
			</tr>
			<tr>
				<td>Upload File</td>
				<td><input type="file" name="file_path[]" required></td>
			</tr>
		</table>
		<br><br>

		<div id="insert-form"></div>
		
		<hr>
		<input type="submit" value="Simpan">
	</form>
	
	<!-- Textbox untuk menampung jumlah data form -->
	<input type="hidden" id="jumlah-form" value="1">
	
	<script>
	$(document).ready(function(){ // Ketika halaman sudah diload dan siap
		$("#btn-tambah-form").click(function(){ // Ketika tombol Tambah Data Form di klik
			var jumlah = parseInt($("#jumlah-form").val()); // Ambil jumlah data form pada textbox jumlah-form
			var nextform = jumlah + 1; // Tambah 1 untuk jumlah form nya
			
			// Tambahkan form dengan menggunakan append pada div insert-form
			$("#insert-form").append("<b>Data ke " + nextform + " :</b>" +
				"<table>" +
				"<tr>" +
				"<td>Judul</td>" +
				"<td><input type='text' name='judul[]' required></td>" +
				"</tr>" +
				"<tr>" +
				"<td>Deskripsi</td>" +
				"<td><textarea name='deskripsi[]' required></textarea></td>" +
				"</tr>" +
				"<tr>" +
				"<td>Tanggal Dibuat</td>" +
				"<td><input type='date' name='tanggal_dibuat[]' required></td>" +
				"</tr>" +
				"<tr>" +
				"<td>Upload File</td>" +
				"<td><input type='file' name='file_path[]' required></td>" +
				"</tr>" +
				"</table>" +
				"<br><br>");
			
			$("#jumlah-form").val(nextform); // Ubah value textbox jumlah-form dengan variabel nextform
		});
		
		// Fungsi untuk mereset form ke semula
		$("#btn-reset-form").click(function(){
			$("#insert-form").html(""); // Kosongkan isi dari div insert-form
			$("#jumlah-form").val("1"); // Ubah kembali value jumlah form menjadi 1
		});
	});
	</script>
</body>
</html>
