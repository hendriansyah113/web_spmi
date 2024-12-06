<?php
// Koneksi ke database
$servername = "localhost"; // Ganti dengan host Anda
$username = "root";        // Ganti dengan username database Anda
$password = "";            // Ganti dengan password database Anda
$dbname = "web_spmi";      // Ganti dengan nama database Anda

// Membuat koneksi ke MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Proses ketika form disubmit untuk tambah data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mengambil data dari form dan menghindari SQL injection
    $prodi = $conn->real_escape_string($_POST['prodi']);
    $fakultas = $conn->real_escape_string($_POST['fakultas']);
    $kaprodi = $conn->real_escape_string($_POST['kaprodi']);
    $akreditasi = $conn->real_escape_string($_POST['akreditasi']);

    // Query untuk menyimpan data
    $sql = "INSERT INTO prodi (prodi, fakultas, kaprodi, akreditasi) 
            VALUES ('$prodi', '$fakultas', '$kaprodi', '$akreditasi')";

    // Mengeksekusi query dan memberikan feedback
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Proses untuk menghapus data dan mengatur ulang ID
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Menghapus data berdasarkan ID
    $sql_delete = "DELETE FROM prodi WHERE id_prodi = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        // Reset ID AUTO_INCREMENT setelah penghapusan data
        // Periksa jumlah data yang tersisa di tabel
        $result = $conn->query("SELECT COUNT(*) AS count FROM prodi");
        $row = $result->fetch_assoc();
        $count = $row['count'];
        
        // Set ulang nilai AUTO_INCREMENT jika data sudah dihapus
        $reset_auto_increment = "ALTER TABLE prodi AUTO_INCREMENT = " . ($count + 1);
        $conn->query($reset_auto_increment);

        echo "<script>alert('Data berhasil dihapus dan ID direset!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Tambah Program Studi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="padding: 20px;">
        <h2>Formulir Tambah Program Studi</h2><hr>

        <!-- Formulir Tambah Data Program Studi -->
        <form method="post" action="">
            <div class="form-group">
                <label for="prodi">Nama Program Studi:</label>
                <select class="form-control" id="prodi" name="prodi" required>
                    <option value="">Pilih Program Studi</option>
                    <option value="D3 Farmasi">D3 Farmasi</option>
                    <option value="D3 Analis Kesehatan">D3 Analis Kesehatan</option>
                    <option value="S1 Ilmu Komputer">S1 Ilmu Komputer</option>
                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                    <option value="S1 Manajemen">S1 Manajemen</option>
                    <option value="S1 Bisnis Digital">S1 Bisnis Digital</option>
                </select>
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas:</label>
                <select class="form-control" id="fakultas" name="fakultas" required>
                    <option value="">Pilih Fakultas</option>
                    <option value="FIKES">FIKES</option>
                    <option value="FBI">FBI</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kaprodi">Nama Kepala Program Studi:</label>
                <input type="text" class="form-control" id="kaprodi" name="kaprodi" required>
            </div>
            <div class="form-group">
                <label for="akreditasi">Akreditasi:</label>
                <input type="text" class="form-control" id="akreditasi" name="akreditasi" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="http://localhost/web_spmi/user/#" class="btn btn-primary">Kembali</a>
        </form>

        <!-- Menampilkan daftar program studi dengan opsi hapus -->
        <hr>
        <h3>Daftar Program Studi</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Prodi</th>
                    <th>Fakultas</th>
                    <th>Kepala Prodi</th>
                    <th>Akreditasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Koneksi ulang untuk mengambil data program studi
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Query untuk menampilkan data program studi
                $result = $conn->query("SELECT * FROM prodi");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_prodi']}</td>
                            <td>{$row['prodi']}</td>
                            <td>{$row['fakultas']}</td>
                            <td>{$row['kaprodi']}</td>
                            <td>{$row['akreditasi']}</td>
                            <td><a href='?delete_id={$row['id_prodi']}' class='btn btn-danger'>Hapus</a></td>
                          </tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Tambahkan Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
