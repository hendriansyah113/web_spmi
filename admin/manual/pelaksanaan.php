<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Audit</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
        <?php
        include '../../config.php';
        include '../../sidebar.php';
        ob_start(); // Mulai output buffering

        // Periksa apakah pengguna adalah admin
        $is_admin = ($_SESSION['role'] === 'admin');

        // Logika untuk mengubah status
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change_status'])) {
            $id = $_POST['id'];
            $status = $_POST['status'];

            $stmt = $conn->prepare("UPDATE pelaksanaan SET status = ? WHERE id_pelaksanaan = ?");
            $stmt->bind_param("si", $status, $id);

            if ($stmt->execute()) {
                echo "<script>alert('Status berhasil diubah'); window.location.href='pelaksanaan.php';</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "'); window.location.href='pelaksanaan.php';</script>";
            }
            $stmt->close();
            exit;
        }
        ?>
        <div class="content" style="padding: 20px;">
            <h2>Tambah Jadwal Pelaksanaan Audit</h2>
            <hr>

            <?php
            // Tambah Data
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_data'])) {
                $fakultas = $_POST['fakultas'];
                $prodi = $_POST['prodi'];
                $auditor = $_POST['auditor'];
                $tahun = $_POST['tahun'];
                $keterangan = $_POST['keterangan'];
                $status = 'Ditutup'; // Tambahkan variabel status

                $stmt = $conn->prepare("INSERT INTO pelaksanaan (fakultas, prodi, auditor, keterangan, tahun, status) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssss", $fakultas, $prodi, $auditor, $keterangan, $tahun, $status);

                if ($stmt->execute()) {
                    // Mengatur ulang auto-increment
                    $conn->query("ALTER TABLE pelaksanaan AUTO_INCREMENT = 1");
                    echo "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
                    // Clear form after insertion
                    $_POST['fakultas'] = '';
                    $_POST['prodi'] = '';
                    $_POST['auditor'] = '';
                    $_POST['tahun'] = '';
                    $_POST['keterangan'] = '';
                } else {
                    echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                }
                $stmt->close();
            }

            // Tangani permintaan edit
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_data'])) {
                $id_pelaksanaan = $_POST['edit_id_pelaksanaan'];
                $fakultas = $_POST['edit_fakultas'];
                $prodi = $_POST['edit_prodi'];
                $auditor = $_POST['edit_auditor'];
                $keterangan = $_POST['edit_keterangan'];
                $tahun = $_POST['edit_tahun'];
                // Tambahkan query untuk memperbarui data di database
                $query = "UPDATE pelaksanaan SET fakultas = ?, prodi = ?, auditor = ?, keterangan = ?, tahun = ? WHERE id_pelaksanaan = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("sssssi", $fakultas, $prodi, $auditor, $keterangan, $tahun, $id_pelaksanaan);
                if ($stmt->execute()) {
                    echo "<script>alert('Data Berhasil Diedit'); window.location.href='pelaksanaan.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "'); window.location.href='pelaksanaan.php';</script>";
                }
            }

            // Tangani permintaan hapus
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_data'])) {
                $id_pelaksanaan = $_POST['delete_id_pelaksanaan'];
                // Tambahkan query untuk menghapus data dari database
                $query = "DELETE FROM pelaksanaan WHERE id_pelaksanaan = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $id_pelaksanaan);
                if ($stmt->execute()) {
                    echo "<script>alert('Data Berhasil Dihapus'); window.location.href='pelaksanaan.php';</script>";
                } else {
                    echo "<script>alert('Error: " . $conn->error . "'); window.location.href='pelaksanaan.php';</script>";
                }
            }
            ?>

            <!-- Form Tambah Data -->
            <?php if ($is_admin): ?>
                <form method="post" action="">
                    <input type="hidden" name="tambah_data" value="true">
                    <div class="form-group">
                        <label for="fakultas">Fakultas:</label>
                        <input type="text" class="form-control" id="fakultas" name="fakultas"
                            value="<?php echo isset($_POST['fakultas']) ? $_POST['fakultas'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi:</label>
                        <select class="form-control" id="prodi" name="prodi" required>
                            <option value="Farmasi">Farmasi</option>
                            <option value="Analisis Kesehatan">Analisis Kesehatan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tahun">Tahun:</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" required>
                    </div>
                    <div class="form-group">
                        <label for="auditor">Nama Auditor:</label>
                        <input type="text" class="form-control" id="auditor" name="auditor"
                            value="<?php echo isset($_POST['auditor']) ? $_POST['auditor'] : ''; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" id="keterangan" name="keterangan"
                            rows="3"><?php echo isset($_POST['keterangan']) ? $_POST['keterangan'] : ''; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            <?php endif; ?>

            <br>
            <hr>
            <h3>Data Pelaksanaan Audit</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fakultas</th>
                        <th>Program Studi</th>
                        <th>Auditor</th>
                        <th>Keterangan</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <?php if ($is_admin): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                        <th>Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM pelaksanaan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $no = 1; // Inisialisasi nomor urut
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>"; // Tampilkan nomor urut
                            echo "<td>" . $row["fakultas"] . "</td>";
                            echo "<td>" . $row["prodi"] . "</td>";
                            echo "<td>" . $row["auditor"] . "</td>";
                            echo "<td>" . $row["keterangan"] . "</td>";
                            echo "<td>" . $row["tahun"] . "</td>";
                            echo "<td>";
                            if ($row["status"] == "Ditutup") {
                                echo "<span class='badge bg-danger'>Ditutup</span>";
                            } else {
                                echo "<span class='badge bg-success'>Dibuka</span>";
                            }
                            echo "</td>";
                            if ($is_admin) {
                                echo "<td>";
                                echo "<form method='post' action='' style='display:inline-block; margin-right: 5px;'>";
                                echo "<input type='hidden' name='id' value='" . $row['id_pelaksanaan'] . "'>";
                                if ($row["status"] == "Ditutup") {
                                    echo "<input type='hidden' name='status' value='Dibuka'>";
                                    echo "<button type='submit' name='change_status' class='btn btn-primary btn-sm'>Ubah ke Dibuka</button>";
                                } else {
                                    echo "<input type='hidden' name='status' value='Ditutup'>";
                                    echo "<button type='submit' name='change_status' class='btn btn-danger btn-sm'>Ubah ke Ditutup</button>";
                                }
                                echo "</form>";
                                echo "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#editModal' data-id='" . $row['id_pelaksanaan'] . "' data-fakultas='" . $row['fakultas'] . "' data-prodi='" . $row['prodi'] . "' data-auditor='" . $row['auditor'] . "' data-keterangan='" . $row['keterangan'] . "' data-tahun='" . $row['tahun'] . "'>Edit</button>";
                                echo "<form method='post' action='' style='display:inline-block; margin-right: 5px;' onsubmit='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>";
                                echo "<input type='hidden' name='delete_id_pelaksanaan' value='" . $row['id_pelaksanaan'] . "'>";
                                echo "<button type='submit' name='delete_data' class='btn btn-danger btn-sm'>Hapus</button>";
                                echo "</form>";
                                echo "</td>";
                            }
                            echo "<td><a href='penilaian.php?id_pelaksanaan=" . $row['id_pelaksanaan'] . "&tahun=" . $row['tahun'] . "&prodi=" . urlencode($row['prodi']) . "' class='btn btn-info btn-sm'>Penilaian</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Tidak ada data</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal Edit Data -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="post" action="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="edit_data" value="true">
                            <input type="hidden" id="edit_id_pelaksanaan" name="edit_id_pelaksanaan">
                            <div class="form-group">
                                <label for="edit_fakultas">Fakultas:</label>
                                <input type="text" class="form-control" id="edit_fakultas" name="edit_fakultas"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="edit_prodi">Prodi:</label>
                                <select class="form-control" id="edit_prodi" name="edit_prodi" required>
                                    <option value="Farmasi">Farmasi</option>
                                    <option value="Analisis Kesehatan">Analisis Kesehatan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="edit_auditor">Nama Auditor:</label>
                                <input type="text" class="form-control" id="edit_auditor" name="edit_auditor" required>
                            </div>
                            <div class="form-group">
                                <label for="edit_keterangan">Keterangan:</label>
                                <textarea class="form-control" id="edit_keterangan" name="edit_keterangan"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="edit_tahun">Tahun:</label>
                                <input type="text" class="form-control" id="edit_tahun" name="edit_tahun" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var fakultas = button.data('fakultas');
            var prodi = button.data('prodi');
            var auditor = button.data('auditor');
            var keterangan = button.data('keterangan');
            var tahun = button.data('tahun');
            var modal = $(this);
            modal.find('#edit_id_pelaksanaan').val(id);
            modal.find('#edit_fakultas').val(fakultas);
            modal.find('#edit_prodi').val(prodi);
            modal.find('#edit_auditor').val(auditor);
            modal.find('#edit_keterangan').val(keterangan);
            modal.find('#edit_tahun').val(tahun);
        });
    </script>
</body>

</html>