<?php
include '../config.php';

// Hashing password menggunakan password_hash
function hashPassword($password)
{
    return password_hash($password, PASSWORD_DEFAULT);
}

// Handle Tambah User
if (isset($_POST['action']) && $_POST['action'] === 'add') {
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jabatan = $_POST['jabatan'];
    $unit_kerja = $_POST['unit_kerja'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $password = hashPassword($_POST['password']);
    $role = $_POST['role'];

    $query = "INSERT INTO login (nama, nik, jabatan, unit_kerja, no_hp, email, password, role) 
              VALUES ('$nama', '$nik', '$jabatan', '$unit_kerja', '$no_hp', '$email', '$password', '$role')";
    mysqli_query($conn, $query);
    header("Location: " . $_SERVER['PHP_SELF']);
}

// Handle Edit User
if (isset($_POST['action']) && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nik = $_POST['nik'];
    $jabatan = $_POST['jabatan'];
    $unit_kerja = $_POST['unit_kerja'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $update_password = "";
    if (!empty($_POST['password'])) {
        $password = hashPassword($_POST['password']);
        $update_password = ", password='$password'";
    }

    $query = "UPDATE login SET 
              nama='$nama', nik='$nik', jabatan='$jabatan', 
              unit_kerja='$unit_kerja', no_hp='$no_hp', email='$email' 
              $update_password, role='$role' WHERE id=$id";
    mysqli_query($conn, $query);
    header("Location: " . $_SERVER['PHP_SELF']);
}

// Handle Hapus User
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $id = $_GET['id'];

    // Query untuk menghapus data user berdasarkan ID
    $query = "DELETE FROM login WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil dihapus!'); window.location.href='$_SERVER[PHP_SELF]';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Standar, Sub-Standar, dan Indikator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #343a40;
            color: white;
            min-height: 100vh;
            padding: 15px;
            width: 300px;
            position: fixed;
        }

        .sidebar h3 {
            color: #007bff;
        }

        .sidebar .nav-link {
            color: #dcdcdc;
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar .nav-link.active {
            color: white;
            background-color: #007bff;
        }

        .sidebar .nav-link:hover {
            color: white;
            background-color: #007bff;
        }

        .sidebar .submenu {
            margin-left: 20px;
            font-size: 0.9em;
        }

        .divider {
            border-bottom: 1px solid #495057;
            margin: 15px 0;
        }

        .content {
            padding: 20px;
            margin-left: 320px;
            background-color: #ffffff;
            width: calc(100% - 320px);
        }

        .dashboard-header h2 {
            font-size: 2rem;
            font-weight: bold;
            color: #343a40;
        }

        .menu-container {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }

        .menu-item {
            flex: 1;
            padding: 20px;
            color: #fff;
            text-align: center;
            margin: 0 10px;
            border-radius: 5px;
        }

        .menu-item a {
            display: block;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .vertical {
            writing-mode: vertical-rl;
            text-orientation: mixed;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <?php include '../sidebar.php'; ?>
        <div class="content">
            <h1>Kelola User</h1>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">Tambah User</button>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>No HP</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM login"; // Sesuaikan nama tabel
                    $result = mysqli_query($conn, $query); // Pastikan koneksi database ($conn) sudah benar
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['jabatan'] . "</td>";
                        echo "<td>" . $row['unit_kerja'] . "</td>";
                        echo "<td>" . $row['no_hp'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['role'] . "</td>";
                        echo "<td><button class='btn btn-primary btn-sm edit-btn' data-id='" . $row['id'] . "' data-nama='" . $row['nama'] . "' data-nik='" . $row['nik'] . "' data-jabatan='" . $row['jabatan'] . "' data-unit_kerja='" . $row['unit_kerja'] . "' data-no_hp='" . $row['no_hp'] . "' data-email='" . $row['email'] . "' data-role='" . $row['role'] . "' data-bs-toggle='modal' data-bs-target='#editModal'>Edit</button><a href='?action=delete&id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Anda yakin ingin menghapus data ini?\")'>Hapus</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal Tambah -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>NIK</label>
                            <input type="text" name="nik" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Unit Kerja</label>
                            <input type="text" name="unit_kerja" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="audite">Audite</option>
                                <option value="auditor">Auditor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>No HP</label>
                            <input type="number" name="no_hp" class="form-control">
                            <small class="form-text text-muted">Nomor HP harus dimulai dengan format 08.</small>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="nama" id="edit-nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>NIK</label>
                            <input type="text" name="nik" id="edit-nik" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Jabatan</label>
                            <input type="text" name="jabatan" id="edit-jabatan" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Unit Kerja</label>
                            <input type="text" name="unit_kerja" id="edit-unit_kerja" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" id="edit-role" class="form-control" required>
                                <option value="admin">Admin</option>
                                <option value="auditee">Auditee</option>
                                <option value="auditor">Auditor</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>No HP</label>
                            <input type="number" name="no_hp" id="edit-no_hp" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" id="edit-email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Password (optional)</label>
                            <input type="password" name="password" id="edit-password" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.edit-btn').on('click', function() {
                var userData = $(this).data();
                $('#edit-id').val(userData.id);
                $('#edit-nama').val(userData.nama);
                $('#edit-nik').val(userData.nik);
                $('#edit-jabatan').val(userData.jabatan);
                $('#edit-unit_kerja').val(userData.unit_kerja);
                $('#edit-no_hp').val(userData.no_hp);
                $('#edit-email').val(userData.email);
                $('#edit-role').val(userData.role);
            });
        });
    </script>

</body>


</html>