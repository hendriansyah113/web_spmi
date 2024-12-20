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
        <h2>Tambah Jadwal Audit</h2><hr>

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
            $nama_auditor = $_POST['nama_auditor'];
            $fakultas = $_POST['fakultas'];
            $prodi = $_POST['prodi'];
            $keterangan = $_POST['keterangan'];

            $stmt = $conn->prepare("INSERT INTO jadwal_ami (nama_auditor, fakultas, prodi, keterangan) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $nama_auditor, $fakultas, $prodi, $keterangan);

            if ($stmt->execute()) {
                // Mengatur ulang auto-increment
                $conn->query("ALTER TABLE jadwal_ami AUTO_INCREMENT = 1");
                echo "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }

        // Edit Data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_data'])) {
            $id_jadwal = $_POST['edit_id_jadwal'];
            $nama_auditor = $_POST['edit_nama_auditor'];
            $fakultas = $_POST['edit_fakultas'];
            $prodi = $_POST['edit_prodi'];
            $keterangan = $_POST['edit_keterangan'];

            $stmt = $conn->prepare("UPDATE jadwal_ami SET nama_auditor=?, fakultas=?, prodi=?, keterangan=? WHERE id_jadwal=?");
            $stmt->bind_param("ssssi", $nama_auditor, $fakultas, $prodi, $keterangan, $id_jadwal);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Data berhasil diupdate</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }

        // Hapus Data
        if (isset($_POST["hapus_data"])) {
            $id_jadwal = $_POST['hapus_id_jadwal'];

            $stmt = $conn->prepare("DELETE FROM jadwal_ami WHERE id_jadwal=?");
            $stmt->bind_param("i", $id_jadwal);

            if ($stmt->execute()) {
                // Mengatur ulang auto-increment setelah data dihapus
                $conn->query("ALTER TABLE jadwal_ami AUTO_INCREMENT = 1");
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
                <label for="nama_auditor">Nama Auditor:</label>
                <input type="text" class="form-control" id="nama_auditor" name="nama_auditor" required>
            </div>
            <div class="form-group">
                <label for="fakultas">Fakultas:</label>
                <input type="text" class="form-control" id="fakultas" name="fakultas" required>
            </div>
            <div class="form-group">
                <label for="prodi">Program Studi:</label>
                <input type="text" class="form-control" id="prodi" name="prodi" required>
            </div>
            <div class="form-group">
                <label for="keterangan">Keterangan:</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="http://localhost/web_spmi/admin/#"><input type="button" value="Kembali"></a>
        </form>

        <br><hr>
        <h3>Data Jadwal AMI</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Auditor</th>
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM jadwal_ami";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_jadwal"] . "</td>";
                        echo "<td>" . $row["nama_auditor"] . "</td>";
                        echo "<td>" . $row["fakultas"] . "</td>";
                        echo "<td>" . $row["prodi"] . "</td>";
                        echo "<td>" . $row["keterangan"] . "</td>";
                        echo "<td>
                                <button class='btn btn-warning btn-sm editBtn' 
                                        data-id='" . $row["id_jadwal"] . "' 
                                        data-nama_auditor='" . $row["nama_auditor"] . "' 
                                        data-fakultas='" . $row["fakultas"] . "' 
                                        data-prodi='" . $row["prodi"] . "' 
                                        data-keterangan='" . $row["keterangan"] . "'>
                                    Edit
                                </button>
                                <button class='btn btn-danger btn-sm deleteBtn' 
                                        data-id='" . $row["id_jadwal"] . "'>Hapus
                                </button>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Edit Data -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="edit_id_jadwal" name="edit_id_jadwal">
                        <div class="form-group">
                            <label for="edit_nama_auditor">Nama Auditor:</label>
                            <input type="text" class="form-control" id="edit_nama_auditor" name="edit_nama_auditor" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_fakultas">Fakultas:</label>
                            <input type="text" class="form-control" id="edit_fakultas" name="edit_fakultas" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_prodi">Program Studi:</label>
                            <input type="text" class="form-control" id="edit_prodi" name="edit_prodi" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_keterangan">Keterangan:</label>
                            <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Data -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
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
                        <input type="hidden" id="hapus_id_jadwal" name="hapus_id_jadwal">
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).on("click", ".editBtn", function() {
            var id_jadwal = $(this).data("id");
            var nama_auditor = $(this).data("nama_auditor");
            var fakultas = $(this).data("fakultas");
            var prodi = $(this).data("prodi");
            var keterangan = $(this).data("keterangan");

            $("#edit_id_jadwal").val(id_jadwal);
            $("#edit_nama_auditor").val(nama_auditor);
            $("#edit_fakultas").val(fakultas);
            $("#edit_prodi").val(prodi);
            $("#edit_keterangan").val(keterangan);
            $("#editModal").modal("show");
        });

        $(document).on("click", ".deleteBtn", function() {
            var id_jadwal = $(this).data("id");
            $("#hapus_id_jadwal").val(id_jadwal);
            $("#deleteModal").modal("show");
        });
    </script>
</body>
</html>
