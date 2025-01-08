<?php
// Mulai sesi
session_start();
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_spmi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Proses saat form login dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $password = $_POST['password'];

    // Query untuk mencari user berdasarkan nama
    $query = "SELECT id, nama, password, role FROM login WHERE nama = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nama);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa apakah nama ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Simpan data ke session
            $_SESSION['id'] = $row['id'];
            $_SESSION['nama'] = $row['nama'];
            $_SESSION['role'] = $row['role'];

            header("Location: ./admin/");
            exit();
        } else {
            echo "<script>alert('Kata sandi atau nama Salah!');</script>";
        }
    } else {
        echo "<script>alert('Kata sandi atau nama Salah!');</script>";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta2/css/bootstrap.min.css">
    <style>
    .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 200px;
    }

    .custom-logo {
        width: 150px;
        height: auto;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Selamat Datang</h2>
                <div class="card my-5">
                    <form class="card-body cardbody-color p-lg-5" method="POST" action="login.php">
                        <div class="logo-container">
                            <img src="assets/logo.png" class="custom-logo" alt="logo">
                        </div>

                        <div class="mb-3">
                            <input type="text" class="form-control" name="nama" placeholder="Nama Pengguna" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Kata Sandi"
                                required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-5 mb-5 w-100">Login</button>
                        </div>
                        <div class="form-text text-center mb-5 text-dark">
                            Belum Terdaftar? <a href="#" class="text-dark fw-bold">Buat Akun</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>