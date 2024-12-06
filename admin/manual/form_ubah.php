<html>
<head>
    <title>Ubah Data Kebijakan</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <h1>Ubah Data Kebijakan</h1>
    <?php
    // Load file koneksi.php
    include "koneksi.php";
    // Ambil data ID yang dikirim oleh index.php melalui URL
    $id = $_GET['id'];
    // Query untuk menampilkan data kebijakan berdasarkan ID yang dikirim
    $sql = $pdo->prepare("SELECT * FROM kebijakan WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute(); // Eksekusi query
    $data = $sql->fetch(); // Ambil semua data dari hasil eksekusi $sql
    ?>
    <form method="post" action="proses_ubah.php?id=<?php echo $id; ?>" enctype="multipart/form-data">
        <table cellpadding="8">
            <tr>
                <td>Judul</td>
                <td><input type="text" name="judul" value="<?php echo $data['judul']; ?>"></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><textarea name="deskripsi"><?php echo $data['deskripsi']; ?></textarea></td>
            </tr>
            <tr>
                <td>Tanggal Dibuat</td>
                <td><input type="date" name="tanggal_dibuat" value="<?php echo $data['tanggal_dibuat']; ?>"></td>
            </tr>
            <tr>
                <td>File Dokumen</td>
                <td>
                    <input type="file" name="file_dokumen">
                    <?php if ($data['file_path']) { ?>
                        <p>File saat ini: <a href="<?php echo $data['file_path']; ?>" target="_blank">Lihat Dokumen</a></p>
                    <?php } ?>
                </td>
            </tr>
        </table>
        <hr>
        <input type="submit" value="Ubah">
        <a href="index.php"><input type="button" value="Batal"></a>
    </form>
</body>
</html>
