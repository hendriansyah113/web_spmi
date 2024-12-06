<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gugus Kendali Mutu UMPR</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container" style="padding: 20px;">
        <h2>Data Gugus Kendali Mutu UMPR</h2><hr>

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

        // Proses penyimpanan data jika form disubmit
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_data'])) {
            $nidn = $_POST['nidn'];
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $email = $_POST['email'];

            // Mengambil file foto dan menyimpannya
            $target_dir = "uploads/"; // Direktori tempat menyimpan file
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Cek apakah file gambar sebenarnya atau palsu
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["foto"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "<div class='alert alert-danger'>File bukan gambar!</div>";
                    $uploadOk = 0;
                }
            }

            // Cek jika file sudah ada
            if (file_exists($target_file)) {
                echo "<div class='alert alert-danger'>File sudah ada!</div>";
                $uploadOk = 0;
            }

            // Batasi ukuran file
            if ($_FILES["foto"]["size"] > 500000) {
                echo "<div class='alert alert-danger'>File terlalu besar!</div>";
                $uploadOk = 0;
            }

            // Izinkan hanya format gambar tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "<div class='alert alert-danger'>Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan!</div>";
                $uploadOk = 0;
            }

            // Jika $uploadOk 0, maka tidak akan diupload
            if ($uploadOk == 0) {
                echo "<div class='alert alert-danger'>File tidak dapat diupload.</div>";
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $foto = basename($_FILES["foto"]["name"]);

                    // Menyimpan data ke database
                    $stmt = $conn->prepare("INSERT INTO gkm_ami (nidn, nama, jabatan, email, foto) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $nidn, $nama, $jabatan, $email, $foto);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Data berhasil ditambahkan</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
                    }
                    $stmt->close();
                } else {
                    echo "<div class='alert alert-danger'>Terjadi kesalahan saat mengupload file.</div>";
                }
            }
        }

        // Edit data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_data'])) {
            $nidn = $_POST['edit_nidn'];
            $nama = $_POST['edit_nama'];
            $jabatan = $_POST['edit_jabatan'];
            $email = $_POST['edit_email'];
            $foto = $_POST['edit_foto'];

            $stmt = $conn->prepare("UPDATE gkm_ami SET nama=?, jabatan=?, email=?, foto=? WHERE nidn=?");
            $stmt->bind_param("ssssi", $nama, $jabatan, $email, $foto, $nidn);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Data berhasil diupdate</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }

        // Hapus data
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_data'])) {
            $nidn = $_POST['hapus_nidn'];

            $stmt = $conn->prepare("DELETE FROM gkm_ami WHERE nidn=?");
            $stmt->bind_param("i", $nidn);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Data berhasil dihapus</div>";
            } else {
                echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
            }
            $stmt->close();
        }
        ?>

        <!-- Form Tambah Data -->
        <form method="post" action="" enctype="multipart/form-data">
            <input type="hidden" name="tambah_data" value="true">
            <div class="form-group">
                <label for="nidn">NIDN:</label>
                <input type="text" class="form-control" id="nidn" name="nidn" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="jabatan">Jabatan:</label>
                <input type="text" class="form-control" id="jabatan" name="jabatan" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="foto">Foto:</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-warning" onclick="window.location.href='http://localhost/web_spmi/user/';">Kembali</button>
        </form>

        <br><hr>
        <h3>Data GKM AMI</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM gkm_ami ORDER BY nidn ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["nidn"] . "</td>";
                        echo "<td>" . $row["nama"] . "</td>";
                        echo "<td>" . $row["jabatan"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td><img src='uploads/" . $row["foto"] . "' alt='Foto' width='50'></td>";
                        echo "<td>
                                <button class='btn btn-warning btn-sm editBtn' data-id='" . $row["nidn"] . "'>Edit</button>
                                <button class='btn btn-danger btn-sm deleteBtn' data-id='" . $row["nidn"] . "'>Hapus</button>
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
    <!-- Modal Hapus Data -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
