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

        // Menampilkan pesan kesalahan jika ada
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['error_message'])) {
            echo "<div class='alert alert-danger'>" . $_POST['error_message'] . "</div>";
        }

        // Menangani upload file foto
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['foto'])) {
            $nidn = $_POST['nidn'];
            $nama = $_POST['nama'];
            $jabatan = $_POST['jabatan'];
            $email = $_POST['email'];
            
            // Menangani upload file foto
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Cek jika file gambar valid
            if (getimagesize($_FILES["foto"]["tmp_name"]) === false) {
                echo "File bukan gambar.";
                $uploadOk = 0;
            }

            // Cek apakah file sudah ada
            if (file_exists($target_file)) {
                echo "File sudah ada.";
                $uploadOk = 0;
            }

            // Cek ukuran file
            if ($_FILES["foto"]["size"] > 500000) {
                echo "Ukuran file terlalu besar.";
                $uploadOk = 0;
            }

            // Hanya izinkan format gambar tertentu
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
                $uploadOk = 0;
            }

            // Cek jika upload berhasil
            if ($uploadOk == 0) {
                echo "Foto tidak dapat diupload.";
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    // Menyimpan data ke database
                    $sql = "INSERT INTO gkm_ami (nidn, nama, jabatan, email, foto) VALUES ('$nidn', '$nama', '$jabatan', '$email', '" . basename($_FILES["foto"]["name"]) . "')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Data berhasil disimpan!";
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    echo "Terjadi kesalahan saat mengupload foto.";
                }
            }
        }
        ?>

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
                        
                        // Perbaikan: path foto yang diupload
                        echo "<td><img src='uploads/" . $row["foto"] . "' alt='Foto' width='50'></td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <button type="button" class="btn btn-warning" onclick="window.location.href='http://localhost/web_spmi/admin/';">Kembali</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
