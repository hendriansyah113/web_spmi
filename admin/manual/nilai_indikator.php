<?php
include '../../config.php';
// Ambil ID Sub-Standar
$id_indikator = $_GET['id_indikator'];

// Tambah data Indikator
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_nilai_indikator'])) {
    $nama = $_POST['nama_nilai_indikator'];
    $poin = $_POST['poin'];
    $query = "INSERT INTO nilai_indikator (id_indikator, poin, nama_nilai_indikator) VALUES ($id_indikator, '$poin' ,'$nama')";
    mysqli_query($conn, $query);
}

// Edit data Indikator
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_indikator'])) {
    $id_indikator_edit = $_POST['id_indikator'];
    $nama = $_POST['nama_nilai_indikator'];
    $query = "UPDATE nilai_indikator SET nama_nilai_indikator = '$nama' WHERE id = $id_indikator_edit";
    mysqli_query($conn, $query);
}

// Hapus data Indikator
if (isset($_GET['delete_id_indikator'])) {
    $id_indikator_hapus = $_GET['delete_id_indikator'];
    $query = "DELETE FROM nilai_indikator WHERE id = $id_indikator_hapus";
    mysqli_query($conn, $query);
    // Redirect back to the current page to refresh the data
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit; // Ensure no further code is executed after the redirect
}



// Ambil data Sub-Standar
$indikator = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM indikator WHERE id = $id_indikator"));

// Ambil data Indikator
$result = mysqli_query($conn, "SELECT * FROM nilai_indikator WHERE id_indikator = $id_indikator");
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Indikator untuk Sub-Standar: <?= $indikator['nama']; ?></title>
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
            <h1>Data Indikator untuk Sub-Standar: <?= $indikator['nama']; ?></h1>
            <!-- Form Tambah Indikator -->
            <form method="POST" class="mb-3">
                <div class="input-group mb-2">
                    <input type="text" name="nama_nilai_indikator" class="form-control" placeholder="Nama Indikator"
                        required>
                </div>
                <div class="input-group mb-3">
                    <select name="poin" class="form-select" required>
                        <option value="" disabled selected>Pilih Poin</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>
                <button type="submit" name="add_nilai_indikator" class="btn btn-primary">Tambah</button>
            </form>

            <!-- Tabel Indikator -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Indikator</th>
                        <th>Poin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_nilai_indikator']; ?></td>
                            <td><?= $row['poin']; ?></td>
                            <td>
                                <!-- Edit Indikator -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                    data-id="<?= $row['id']; ?>"
                                    data-nama="<?= $row['nama_nilai_indikator']; ?>">Edit</button>

                                <!-- Hapus Indikator -->
                                <a href="?delete_id_indikator=<?= $row['id']; ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <a href="indikator.php?sub_standar_id=<?= $indikator['sub_standar_id'] ?>&tahun=<?= $_GET['tahun'] ?>"
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
                        <input type="hidden" name="id_indikator" id="id_indikator">
                        <div class="form-group">
                            <label for="nama_nilai_indikator">Nama Indikator</label>
                            <input type="text" name="nama_nilai_indikator" class="form-control"
                                id="nama_nilai_indikator" required>
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
            modal.find('#id_indikator').val(indikatorId);
            modal.find('#nama_nilai_indikator').val(namaIndikator);
        });
    </script>
</body>

</html>