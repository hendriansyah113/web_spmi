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

// Ambil ID Sub-Standar
$sub_standar_id = $_GET['sub_standar_id'];

// Tambah data Indikator
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_indikator'])) {
    $nama = $_POST['nama_indikator'];
    $query = "INSERT INTO indikator (sub_standar_id, nama) VALUES ($sub_standar_id, '$nama')";
    mysqli_query($conn, $query);
}

// Edit data Indikator
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_indikator'])) {
    $indikator_id = $_POST['indikator_id'];
    $nama = $_POST['nama_indikator'];
    $query = "UPDATE indikator SET nama = '$nama' WHERE id = $indikator_id";
    mysqli_query($conn, $query);
}

// Hapus data Indikator
if (isset($_GET['delete_indikator_id'])) {
    $indikator_id = $_GET['delete_indikator_id'];
    $query = "DELETE FROM indikator WHERE id = $indikator_id";
    mysqli_query($conn, $query);
    // Redirect back to the current page to refresh the data
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit; // Ensure no further code is executed after the redirect
}

// Ambil data Sub-Standar
$sub_standar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM sub_standar WHERE id = $sub_standar_id"));

// Ambil data Indikator
$result = mysqli_query($conn, "SELECT * FROM indikator WHERE sub_standar_id = $sub_standar_id");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Indikator untuk Sub-Standar: <?= $sub_standar['nama']; ?></title>
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
            <h1>Data Indikator untuk Sub-Standar: <?= $sub_standar['nama']; ?></h1>
            <!-- Form Tambah Indikator -->
            <form method="POST" class="mb-3">
                <div class="input-group">
                    <input type="text" name="nama_indikator" class="form-control" placeholder="Nama Indikator" required>
                    <button type="submit" name="add_indikator" class="btn btn-primary">Tambah</button>
                </div>
            </form>

            <!-- Tabel Indikator -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Indikator</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td>
                            <a href="nilai_indikator.php?id_indikator=<?= $row['id']; ?>&tahun=<?= $_GET['tahun'] ?>"
                                class="btn btn-info btn-sm">Lihat
                                Nilai Indikator</a>
                            <!-- Edit Indikator -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>">Edit</button>

                            <!-- Hapus Indikator -->
                            <a href="?delete_indikator_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="sub_standar.php?standar_id=<?= $sub_standar['standar_id'] ?>&tahun=<?= $_GET['tahun'] ?>"
                class="btn btn-secondary">Kembali ke
                Sub-Standar</a>
        </div>
    </div>

    <!-- Modal Edit Indikator -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Indikator</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="indikator_id" id="indikator_id">
                        <div class="form-group">
                            <label for="nama_indikator">Nama Indikator</label>
                            <input type="text" name="nama_indikator" class="form-control" id="nama_indikator" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit_indikator" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    // Memasukkan data ke dalam modal edit
    $('#editModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol yang mengklik
        var indikatorId = button.data('id');
        var namaIndikator = button.data('nama');

        var modal = $(this);
        modal.find('#indikator_id').val(indikatorId);
        modal.find('#nama_indikator').val(namaIndikator);
    });
    </script>
</body>

</html>