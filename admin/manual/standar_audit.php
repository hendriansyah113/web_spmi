<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_spmi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mendapatkan tahun saat ini
$currentYear = date('Y');

// Cek apakah user memilih tahun, jika tidak gunakan tahun saat ini
$tahun = isset($_GET['tahun']) ? $_GET['tahun'] : $currentYear;

// Tambah data Standar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_standar_audit'])) {
    $nama = $_POST['nama_standar_audit'];
    $query = "INSERT INTO standar_audit (nama_standar, tahun) VALUES ('$nama', '$tahun')";
    mysqli_query($conn, $query);
}

// Edit data Standar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_standar_audit'])) {
    $id = $_POST['id_standar'];
    $nama = $_POST['edit_nama_standar_audit'];
    $query = "UPDATE standar_audit SET nama_standar = '$nama' WHERE id = $id";
    mysqli_query($conn, $query);
}

// Hapus data Standar
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];  // Sesuaikan dengan parameter URL 'hapus'
    $query = "DELETE FROM standar_audit WHERE id = $id";
    mysqli_query($conn, $query);
}

// Ambil data Standar berdasarkan tahun
$result = mysqli_query($conn, "SELECT * FROM standar_audit WHERE tahun = '$tahun' ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Standar, Sub-Standar, dan Indikator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" />
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
        <div class="sidebar">
            <h3>Sistem Informasi Audit Mutu Internal (SIAMI)</h3>
            <p>Universitas Muhammadiyah Palangkaraya</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home"></i>&nbsp; Dashboard
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-users"></i>&nbsp; User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="auditor/index.php">Auditor</a></li>
                        <li><a class="dropdown-item" href="auditee/index.php">Auditee</a></li>
                    </ul>
                </li>
                <div class="divider"></div>
                <!-- New Menu Item: Audit Mutu Internal -->
                <li class="nav-item">
                    <a class="nav-link" href="manual/pelaksanaan.php">
                        <i class="fas fa-chart-line"></i>&nbsp; Audit Mutu Internal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manual/standar.php">
                        <i class="fas fa-chart-line"></i>&nbsp; Kelola Indikator
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/web_spmi/login.html">
                        <i class="fas fa-sign-out-alt"></i>&nbsp; Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="content">
            <h1>Data Standar Audit</h1>
            <!-- Pilihan Tahun -->
            <form method="GET" class="mb-3">
                <label for="tahun" class="form-label">Pilih Tahun</label>
                <select name="tahun" id="tahun" class="form-select" onchange="this.form.submit()">
                    <?php
                    for ($i = $currentYear; $i >= $currentYear - 10; $i--): ?>
                        <option value="<?= $i; ?>" <?= ($i == $tahun) ? 'selected' : ''; ?>><?= $i; ?></option>
                    <?php endfor; ?>
                </select>
            </form>
            <!-- Form Tambah Standar -->
            <form method="POST" class="mb-3">
                <div class="input-group">
                    <input type="text" name="nama_standar_audit" class="form-control" placeholder="Nama Standar"
                        required>
                    <button type="submit" name="add_standar_audit" class="btn btn-primary">Tambah</button>
                </div>
            </form>

            <!-- Tabel Standar -->
            <!-- Tabel Standar -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Standar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_standar']; ?></td>
                            <td>
                                <a href="uraian.php?standar_id=<?= $row['id']; ?>&tahun=<?= $row['tahun']; ?>"
                                    class="btn btn-info btn-sm">Lihat Uraian</a>
                                <!-- Tombol Edit -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama_standar']; ?>">Edit</button>

                                <!-- Tombol Hapus -->
                                <a href="javascript:void(0);" onclick="hapusData(<?= $row['id']; ?>)"
                                    class="btn btn-danger btn-sm">Hapus</a>

                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Standar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="id_standar" id="edit_id_standar">
                        <div class="mb-3">
                            <label for="edit_nama_standar_audit" class="form-label">Nama Standar</label>
                            <input type="text" name="edit_nama_standar_audit" class="form-control"
                                id="edit_nama_standar_audit" required>
                        </div>
                        <button type="submit" name="edit_standar_audit" class="btn btn-primary">Simpan
                            Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mengisi data modal edit
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang dipilih
            var id = button.data('id');
            var nama = button.data('nama');

            // Isi form dengan data yang dipilih
            $('#edit_id_standar').val(id);
            $('#edit_nama_standar_audit').val(nama);
        });

        function hapusData(id) {
            if (confirm('Yakin ingin menghapus data ini?')) {
                // Lakukan request ke PHP untuk menghapus data
                window.location.href = "?hapus=" + id + "&tahun=" + <?= $tahun ?>;
            }
        }
    </script>
</body>

</html>