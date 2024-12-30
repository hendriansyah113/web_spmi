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

// Query untuk mengambil data program studi
$sql = "SELECT * FROM prodi";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Program Studi</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="padding: 20px;">
        <h2>Daftar Program Studi</h2>
        <hr>

        <!-- Tabel Data Program Studi -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Program Studi</th>
                    <th>Nama Program Studi</th>
                    <th>Fakultas</th>
                    <th>Nama Kepala Prodi</th>
                    <th>Akreditasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Menampilkan data dari tabel prodi
                if ($result->num_rows > 0) {
                    $no = 0;
                    // Output data untuk setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . $row["prodi"] . "</td>
                                <td>" . $row["fakultas"] . "</td>
                                <td>" . $row["kaprodi"] . "</td>
                                <td>" . $row["akreditasi"] . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data ditemukan</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tombol untuk kembali -->
        <a href="http://localhost/web_spmi/admin/#" class="btn btn-secondary">Kembali</a>
    </div>

    <!-- Tambahkan Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi
$conn->close();
?>