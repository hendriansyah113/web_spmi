<?php
// Include koneksi database
include '../config.php';

$id = $_SESSION['id']; // Pastikan $_SESSION['id'] di-set saat login

$query = "SELECT * FROM login WHERE id = $id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle update profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jabatan = $_POST['jabatan'];
    $unit_kerja = $_POST['unit_kerja'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash password jika diisi
    $password_update = "";
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $password_update = ", password = '$hashed_password'";
    }

    $update_query = "UPDATE login SET 
                        nama = '$nama',
                        nik = '$nik',
                        jabatan = '$jabatan',
                        unit_kerja = '$unit_kerja',
                        no_hp = '$no_hp',
                        email = '$email'
                        $password_update
                     WHERE id = $id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profil berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui profil!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4 shadow-lg" style="width: 400px;">
            <h3 class="text-center mb-3">Edit Profil</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="number" class="form-control" id="nik" name="nik" value="<?php echo $user['nik']; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="jabatan" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="jabatan" name="jabatan"
                        value="<?php echo $user['jabatan']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="unit_kerja" class="form-label">Unit Kerja</label>
                    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja"
                        value="<?php echo $user['unit_kerja']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="no_hp" class="form-label">No. HP</label>
                    <input type="text" class="form-control" id="no_hp" name="no_hp"
                        value="<?php echo $user['no_hp']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="<?php echo $user['email']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi (Opsional)</label>
                    <input type="password" class="form-control" id="password" name="password"
                        placeholder="Masukkan kata sandi baru">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>