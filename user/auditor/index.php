<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal AMI</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f8ff;
            color: #333;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        h2, h3 {
            color: #007bff;
        }
        .table thead {
            background-color: #007bff;
            color: #fff;
        }
        .table tbody tr:nth-child(even) {
            background-color: #e9f7ff;
        }
        .btn-warning {
            background-color: #ffbb33;
            border-color: #ffbb33;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Tombol Kembali -->
        <button type="button" class="btn btn-warning mb-4" onclick="window.location.href='http://localhost/web_spmi/user/';">Kembali</button>

        <h2 class="text-center">Jadwal Audit Mutu Internal (AMI)</h2><hr>

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
        ?>

        <br><hr>
        <h3>Data Jadwal AMI</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Jadwal</th>
                    <th>Tanggal Jadwal</th>
                    <th>Fakultas</th>
                    <th>Program Studi</th>
                    <th>Waktu</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM jadwal_ami ORDER BY tgl_jadwal DESC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_jadwal"] . "</td>";
                        echo "<td>" . $row["tgl_jadwal"] . "</td>";
                        echo "<td>" . $row["fakultas"] . "</td>";
                        echo "<td>" . $row["prodi"] . "</td>";
                        echo "<td>" . $row["waktu"] . "</td>";
                        echo "<td>" . $row["keterangan"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
