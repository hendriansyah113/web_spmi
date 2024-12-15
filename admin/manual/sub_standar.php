<?php
include '../../config.php';
// Ambil ID Standar
$standar_id = $_GET['standar_id'];

// Tambah data Sub-Standar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_sub_standar'])) {
    $nama = $_POST['nama_sub_standar'];
    $query = "INSERT INTO sub_standar (standar_id, nama) VALUES ($standar_id, '$nama')";
    mysqli_query($conn, $query);
}

// Edit data Sub-Standar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_sub_standar'])) {
    $sub_standar_id = $_POST['sub_standar_id'];
    $nama = $_POST['nama_sub_standar'];
    $query = "UPDATE sub_standar SET nama = '$nama' WHERE id = $sub_standar_id";
    mysqli_query($conn, $query);
}

// Hapus data Sub-Standar
if (isset($_GET['delete_sub_standar_id'])) {
    $sub_standar_id = $_GET['delete_sub_standar_id'];
    $query = "DELETE FROM sub_standar WHERE id = $sub_standar_id";
    mysqli_query($conn, $query);
    // Redirect back to the current page to refresh the data
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit; // Ensure no further code is executed after the redirect
}

// Ambil data Standar
$standar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM standar WHERE id = $standar_id"));

// Ambil data Sub-Standar
$result = mysqli_query($conn, "SELECT * FROM sub_standar WHERE standar_id = $standar_id");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Standar, Sub-Standar, dan Indikator</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
        <?php include '../../sidebar.php'; ?>
        <div class="content">
            <h1>Data Sub-Standar untuk Standar: <?= $standar['nama']; ?></h1>
            <!-- Form Tambah Sub-Standar -->
            <form method="POST" class="mb-3">
                <div class="input-group">
                    <input type="text" name="nama_sub_standar" class="form-control" placeholder="Nama Sub-Standar"
                        required>
                    <button type="submit" name="add_sub_standar" class="btn btn-primary">Tambah</button>
                </div>
            </form>

            <!-- Tabel Sub-Standar -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sub-Standar</th>
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
                                <a href="indikator.php?sub_standar_id=<?= $row['id']; ?>&tahun=<?= $_GET['tahun']; ?>"
                                    class="btn btn-info btn-sm">Lihat
                                    Indikator</a>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="<?= $row['id']; ?>" data-nama="<?= $row['nama']; ?>">Edit</button>

                                <!-- Hapus Sub-Standar -->
                                <a href="?delete_sub_standar_id=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="standar.php?tahun=<?= $_GET['tahun'] ?>" class="btn btn-secondary">Kembali ke Standar</a>
        </div>
    </div>
    <!-- Modal Edit Sub-Standar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Sub-Standar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="sub_standar_id" id="sub_standar_id">
                        <div class="form-group">
                            <label for="nama_sub_standar">Nama Sub-Standar</label>
                            <input type="text" name="nama_sub_standar" class="form-control" id="nama_sub_standar"
                                required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" name="edit_sub_standar" class="btn btn-primary">Simpan</button>
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
            var subStandarId = button.data('id');
            var namaSubStandar = button.data('nama');

            var modal = $(this);
            modal.find('#sub_standar_id').val(subStandarId);
            modal.find('#nama_sub_standar').val(namaSubStandar);
        });

        // Check if the page has reloaded after deletion
        window.onload = function() {
            if (<?php echo isset($_SESSION['deleted']) ? 'true' : 'false'; ?>) {
                alert('Sub-Standar has been deleted successfully');
                <?php unset($_SESSION['deleted']); ?> // Unset the flag after showing the message
            }
        };
    </script>
</body>