<html>
<head>
    <title>Multiple Insert Kebijakan</title>
</head>
<body>
    <h1>Multiple Insert Kebijakan</h1>
    <!-- Tombol untuk menambah data -->
    <a href="form.php">Tambah Data</a><br><br>
    
    <!-- Tombol untuk menghapus data -->
    <a href="multiple_delete_kebijakan.php">
        <button type="button" class="btn btn-primary">Hapus Data</button>
    </a><br><br>

    <!-- Tombol untuk kembali -->
    <a href="http://localhost/web_spmi/admin" class="btn btn-search">Kembali</a>
    
    <br><br>
    <!-- Tabel untuk menampilkan data kebijakan -->
    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <th>JUDUL DOKUMEN</th>
            <th>DESKRIPSI</th>
            <th>TANGGAL DIBUAT</th>
            <th>FILE DOKUMEN</th>
        </tr>
        <?php
        // Load file koneksi.php
        include "koneksi.php";
        
        // Buat query untuk menampilkan semua data dari tabel kebijakan
        $sql = $pdo->prepare("SELECT * FROM kebijakan ORDER BY id");
        $sql->execute(); // Eksekusi query
        
        // Tampilkan data ke dalam tabel
        while($data = $sql->fetch()){ 
            echo "<tr>";
            echo "<td>".$data['id']."</td>";
            echo "<td>".$data['judul']."</td>";
            echo "<td>".$data['deskripsi']."</td>";
            echo "<td>".$data['tanggal_dibuat']."</td>";
            echo "<td><a href='".$data['file_path']."' target='_blank'>Lihat File</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
