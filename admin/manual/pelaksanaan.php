<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Audit</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" style="padding: 20px;">
        <h2>Tambah Jadwal Pelaksanaan Audit</h2>
        <hr>

        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "web_spmi";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Tambah Data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_data'])) {
            $fakultas = $_POST['fakultas'];
            $prodi = $_POST['prodi'];
            $auditor = $_POST['auditor'];
            $tahun = $_POST['tahun'];
            $keterangan = $_POST['keterangan'];

            $stmt = $conn->prepare("INSERT INTO pelaksanaan (fakultas, prodi, auditor, keterangan, tahun) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $fakultas, $prodi, $auditor, $keterangan, $tahun);

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

        // Edit Data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_data'])) {
            $id_pelaksanaan = $_POST['edit_id_pelaksanaan'];
            $fakultas = $_POST['edit_fakultas'];
            $prodi = $_POST['edit_prodi'];
            $auditor = $_POST['edit_auditor'];
            $keterangan = $_POST['edit_keterangan'];

            $stmt = $conn->prepare("UPDATE pelaksanaan SET fakultas=?, prodi=?, auditor=?, keterangan=? WHERE id_pelaksanaan=?");
            $stmt->bind_param("ssssi", $fakultas, $prodi, $auditor, $keterangan, $id_pelaksanaan);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Data berhasil diupdate</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }

        // Hapus Data
        if (isset($_POST["hapus_data"])) {
            $id_pelaksanaan = $_POST['hapus_id_pelaksanaan'];

            $stmt = $conn->prepare("DELETE FROM pelaksanaan WHERE id_pelaksanaan=?");
            $stmt->bind_param("i", $id_pelaksanaan);

            if ($stmt->execute()) {
                // Mengatur ulang auto-increment setelah data dihapus
                $conn->query("ALTER TABLE pelaksanaan AUTO_INCREMENT = 1");
                echo "<div class='alert alert-success'>Data berhasil dihapus</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }
        ?>

        <!-- Form Tambah Data -->
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
                <input type="number" class="form-control" id="tahun" name="tahun" required>
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
            <a href="http://localhost/web_spmi/admin/#"><input type="button" value="Kembali"></a>
        </form>

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
                    <th>Penilaian</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pelaksanaan";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_pelaksanaan"] . "</td>";
                        echo "<td>" . $row["fakultas"] . "</td>";
                        echo "<td>" . $row["prodi"] . "</td>";
                        echo "<td>" . $row["auditor"] . "</td>";
                        echo "<td>" . $row["keterangan"] . "</td>";
                        echo "<td>" . $row["tahun"] . "</td>";
                        echo "<td><a href='penilaian.php?tahun=" . $row['tahun'] . "&prodi=" . urlencode($row['prodi']) . "' class='btn btn-info btn-sm'>Penilaian</a></td>";
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
                            <input type="text" class="form-control" id="edit_fakultas" name="edit_fakultas" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_prodi">Program Studi:</label>
                            <select class="form-control" id="edit_prodi" name="edit_prodi" required>
                                <option value="Farmasi">Farmasi</option>
                                <option value="Analisis Kesehatan">Analisis Kesehatan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tahun">Tahun:</label>
                            <input type="number" class="form-control" id="tahun" name="tahun" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_auditor">Nama Auditor:</label>
                            <input type="text" class="form-control" id="edit_auditor" name="edit_auditor" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_keterangan">Keterangan:</label>
                            <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3"
                                required></textarea>
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

    <!-- Modal Delete Data -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="post" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="hapus_data" value="true">
                        <input type="hidden" id="hapus_id_pelaksanaan" name="hapus_id_pelaksanaan">
                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Edit button
        $(".editBtn").click(function() {
            var id = $(this).data('id');
            var fakultas = $(this).data('fakultas');
            var prodi = $(this).data('prodi');
            var auditor = $(this).data('auditor');
            var keterangan = $(this).data('keterangan');

            $("#edit_id_pelaksanaan").val(id);
            $("#edit_fakultas").val(fakultas);
            $("#edit_prodi").val(prodi);
            $("#edit_auditor").val(auditor);
            $("#edit_keterangan").val(keterangan);

            $("#editModal").modal('show');
        });

        // Delete button
        $(".deleteBtn").click(function() {
            var id = $(this).data('id');
            $("#hapus_id_pelaksanaan").val(id);
            $("#deleteModal").modal('show');
        });
    </script>
</body>

</html>