<?php
include '../config.php';

// Ambil data fakultas dan prodi
$fakultas_query = "SELECT * FROM fakultas";
$fakultas_result = mysqli_query($conn, $fakultas_query);

// Handle Tambah Fakultas
if (isset($_POST['tambah_fakultas'])) {
    $nama_fakultas = $_POST['nama_fakultas'];
    $insert_fakultas = "INSERT INTO fakultas (nama_fakultas) VALUES ('$nama_fakultas')";
    mysqli_query($conn, $insert_fakultas);
    header('Location: fakultas.php');
}

// Handle Edit Fakultas
if (isset($_POST['edit_fakultas'])) {
    $id_fakultas = $_POST['id_fakultas'];
    $nama_fakultas = $_POST['nama_fakultas'];
    $update_fakultas = "UPDATE fakultas SET nama_fakultas = '$nama_fakultas' WHERE id_fakultas = $id_fakultas";
    mysqli_query($conn, $update_fakultas);
    header('Location: fakultas.php');
}

// Handle Tambah Prodi
if (isset($_POST['tambah_prodi'])) {
    $id_fakultas = $_POST['id_fakultas'];
    $nama_prodi = $_POST['nama_prodi'];
    $akreditasi = $_POST['akreditasi'];
    $insert_prodi = "INSERT INTO prodi (id_fakultas, nama_prodi, akreditasi) VALUES ($id_fakultas, '$nama_prodi', '$akreditasi')";
    mysqli_query($conn, $insert_prodi);
    header('Location: fakultas.php');
}

// Handle Edit Prodi
if (isset($_POST['edit_prodi'])) {
    $id_prodi = $_POST['id_prodi'];
    $id_fakultas = $_POST['id_fakultas'];
    $nama_prodi = $_POST['nama_prodi'];
    $akreditasi = $_POST['akreditasi'];
    $update_prodi = "UPDATE prodi SET id_fakultas = $id_fakultas, nama_prodi = '$nama_prodi', akreditasi = '$akreditasi' WHERE id_prodi = $id_prodi";
    mysqli_query($conn, $update_prodi);
    header('Location: fakultas.php');
}

// Handle Hapus Fakultas
if (isset($_GET['hapus_fakultas'])) {
    $id_fakultas = $_GET['hapus_fakultas'];
    $delete_fakultas = "DELETE FROM fakultas WHERE id_fakultas = $id_fakultas";
    mysqli_query($conn, $delete_fakultas);
    header('Location: fakultas.php');
}

// Handle Hapus Prodi
if (isset($_GET['hapus_prodi'])) {
    $id_prodi = $_GET['hapus_prodi'];
    $delete_prodi = "DELETE FROM prodi WHERE id_prodi = $id_prodi";
    mysqli_query($conn, $delete_prodi);
    header('Location: fakultas.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Fakultas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .list-group-item {
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item a {
            text-decoration: none;
            color: inherit;
            padding-right: 10px;
            /* Memberi jarak ke tombol */
            flex: 1;
            /* Mengisi ruang yang tersedia */
        }

        .list-group-item a:hover {
            text-decoration: underline;
            /* Efek hover untuk klik */
        }

        .list-group-item .btn-group {
            gap: 5px;
            /* Jarak antar tombol */
        }

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
        <?php
        include '../sidebar.php';
        ?>
        <div class="content">
            <h2 class="text-center">Manajemen Fakultas dan Prodi</h2>
            <div class="row">
                <!-- Sidebar Fakultas -->
                <div class="col-4">
                    <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalTambahFakultas">Tambah Fakultas</button>
                    <div class="list-group">
                        <?php while ($fakultas = mysqli_fetch_assoc($fakultas_result)): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="?id_fakultas=<?= $fakultas['id_fakultas'] ?>"
                                    class="text-decoration-none text-dark flex-grow-1">
                                    <?= $fakultas['nama_fakultas'] ?>
                                </a>
                                <div class="btn-group">
                                    <a href="#" class="btn btn-sm btn-warning text-light btn-edit"
                                        data-id="<?= $fakultas['id_fakultas'] ?>"
                                        data-nama="<?= $fakultas['nama_fakultas'] ?>">
                                        Edit
                                    </a>
                                    <a href="?hapus_fakultas=<?= $fakultas['id_fakultas'] ?>"
                                        class="btn btn-sm btn-danger text-light"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus fakultas ini?')">
                                        Hapus
                                    </a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>


                </div>

                <!-- Content Prodi -->
                <div class="col-8">
                    <?php
                    if (isset($_GET['id_fakultas'])) {
                        $id_fakultas = $_GET['id_fakultas'];
                        $prodi_query = "SELECT * FROM prodi WHERE id_fakultas = $id_fakultas";
                        $prodi_result = mysqli_query($conn, $prodi_query);

                        $fakultas_name_query = "SELECT nama_fakultas FROM fakultas WHERE id_fakultas = $id_fakultas";
                        $fakultas_name_result = mysqli_query($conn, $fakultas_name_query);
                        $fakultas_name = mysqli_fetch_assoc($fakultas_name_result)['nama_fakultas'];
                    ?>
                        <h4>Prodi di <?= $fakultas_name ?></h4>
                        <button class="btn btn-success mb-3" data-bs-toggle="modal"
                            data-bs-target="#modalTambahProdi">Tambah
                            Prodi</button>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Prodi</th>
                                    <th>Akreditasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($prodi = mysqli_fetch_assoc($prodi_result)): ?>
                                    <tr>
                                        <td><?= $prodi['nama_prodi'] ?></td>
                                        <td><?= $prodi['akreditasi'] ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning text-light btn-edit-prodi"
                                                data-id="<?= $prodi['id_prodi'] ?>" data-nama="<?= $prodi['nama_prodi'] ?>"
                                                data-akreditasi="<?= $prodi['akreditasi'] ?>"
                                                data-fakultas-id="<?= $prodi['id_fakultas'] ?>">Edit</button>
                                            <a href="?hapus_prodi=<?= $prodi['id_prodi'] ?>"
                                                class="btn btn-sm btn-danger text-light"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus prodi ini?')">Hapus</a>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php } else { ?>
                        <p>Pilih fakultas untuk melihat prodi.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Fakultas -->
    <div class="modal fade" id="modalTambahFakultas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Fakultas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                            <input type="text" class="form-control" id="nama_fakultas" name="nama_fakultas" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambah_fakultas" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Tambah Prodi -->
    <div class="modal fade" id="modalTambahProdi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="id_fakultas" class="form-label">Fakultas</label>
                            <select class="form-select" id="id_fakultas" name="id_fakultas" required>
                                <?php
                                $fakultas_result = mysqli_query($conn, "SELECT * FROM fakultas");
                                while ($fakultas = mysqli_fetch_assoc($fakultas_result)) {
                                    echo "<option value='{$fakultas['id_fakultas']}'>{$fakultas['nama_fakultas']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_prodi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                        </div>
                        <div class="mb-3">
                            <label for="akreditasi" class="form-label">Akreditasi</label>
                            <input type="text" class="form-control" id="akreditasi" name="akreditasi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="tambah_prodi" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Fakultas -->
    <div class="modal fade" id="modalEditFakultas" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Fakultas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_fakultas" name="id_fakultas">
                        <div class="mb-3">
                            <label for="edit_nama_fakultas" class="form-label">Nama Fakultas</label>
                            <input type="text" class="form-control" id="edit_nama_fakultas" name="nama_fakultas"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_fakultas" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Edit Prodi -->
    <div class="modal fade" id="modalEditProdi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="edit_id_prodi" name="id_prodi">
                        <div class="mb-3">
                            <label for="edit_id_fakultas" class="form-label">Fakultas</label>
                            <select class="form-select" id="edit_id_fakultas" name="id_fakultas" required>
                                <?php
                                $fakultas_result = mysqli_query($conn, "SELECT * FROM fakultas");
                                while ($fakultas = mysqli_fetch_assoc($fakultas_result)) {
                                    echo "<option value='{$fakultas['id_fakultas']}'>{$fakultas['nama_fakultas']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_nama_prodi" class="form-label">Nama Prodi</label>
                            <input type="text" class="form-control" id="edit_nama_prodi" name="nama_prodi" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_akreditasi" class="form-label">Akreditasi</label>
                            <input type="text" class="form-control" id="edit_akreditasi" name="akreditasi" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="edit_prodi" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Ketika tombol Edit diklik
            $('.btn-edit').click(function() {
                // Ambil data dari atribut data-*
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                // Isi form dengan data yang diambil
                $('#edit_id_fakultas').val(id);
                $('#edit_nama_fakultas').val(nama);

                // Tampilkan modal edit
                var modalEdit = new bootstrap.Modal(document.getElementById('modalEditFakultas'));
                modalEdit.show();
            });
        });

        // Ketika tombol Edit Prodi diklik
        $('.btn-edit-prodi').click(function() {
            var id_prodi = $(this).data('id');
            var nama_prodi = $(this).data('nama');
            var akreditasi = $(this).data('akreditasi');
            var fakultas_id = $(this).data('fakultas-id');

            // Isi form dengan data yang diambil
            $('#edit_id_prodi').val(id_prodi);
            $('#edit_nama_prodi').val(nama_prodi);
            $('#edit_akreditasi').val(akreditasi);

            // Hapus 'selected' pada semua opsi sebelum memilih yang baru
            $('#edit_id_fakultas option').prop('selected', false);

            // Pilih fakultas_id yang sesuai di dalam select
            $('#edit_id_fakultas option[value="' + fakultas_id + '"]').prop('selected', true);

            // Log untuk memastikan nilai sudah terpilih
            console.log($('#edit_id_fakultas').val()); // Verifikasi

            // Tampilkan modal edit
            var modalEditProdi = new bootstrap.Modal(document.getElementById('modalEditProdi'));
            modalEditProdi.show();
        });
    </script>


</body>

</html>