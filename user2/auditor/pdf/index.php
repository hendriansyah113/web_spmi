<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->
    <title>Laporan Data Penduduk Kelurahan Pahandut</title>

    <!-- Include file CSS Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Include library Bootstrap Datepicker -->
    <link href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">

    <!-- Include library Font Awesome (Dibutuhkan Datepicker) -->
    <link href="libraries/fontawesome/css/all.min.css" rel="stylesheet">

    <!-- Include File jQuery -->
    <script src="js/jquery.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div style="padding: 15px;">
        <h3 style="margin-top: 0;"><b>Laporan Data Penduduk Periode Tanggal Lahir</b></h3>
        <hr />

        <form method="get" action="index.php">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="form-group">
                        <label>Filter Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" name="tgl_awal" value="<?= @$_GET['tgl_awal'] ?>" class="form-control tgl_awal datetimepicker-input" placeholder="Tanggal Awal" data-toggle="datetimepicker" data-target=".tgl_awal" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text">s/d</span>
                            </div>
                            <input type="text" name="tgl_akhir" value="<?= @$_GET['tgl_akhir'] ?>" class="form-control tgl_akhir datetimepicker-input" placeholder="Tanggal Akhir" data-toggle="datetimepicker" data-target=".tgl_akhir" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>

            <?php
            if(isset($_GET['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
            ?>
            <a href="index.php" class="btn btn-default">RESET</a>
            <a href="http://localhost/coba_kelurahan/login_php/Penduduk" class="btn btn-search">Kembali</a>
        </form>

        <?php
        // Load file koneksi.php
        include "koneksi.php";

        $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
        $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

        if(empty($tgl_awal) or empty($tgl_akhir)){ // Cek jika tgl_awal atau tgl_akhir kosong, maka :
            // Buat query untuk menampilkan semua data transaksi
            $query = "SELECT * FROM ilkomfitria4";
            $url_cetak = "print.php";
            $label = "Semua Data Transaksi";
        }else{ // Jika terisi
            // Buat query untuk menampilkan data transaksi sesuai periode tanggal lahir
            $query = "SELECT * FROM ilkomfitria4 WHERE (tanggal_lahir BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')";
            $url_cetak = "print.php?tgl_awal=".$tgl_awal."&tgl_akhir=".$tgl_akhir."&filter=true";
            $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
            $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
            $label = 'Periode Tanggal Lahir '.$tgl_awal.' s/d '.$tgl_akhir;
        }
        ?>
        <hr />
        <h4 style="margin-bottom: 5px;"><b>Data Penduduk</b></h4>
        <?php echo $label ?><br />

        <div style="margin-top: 5px;">
            <a href="<?php echo $url_cetak ?>">CETAK PDF</a>
        </div>

        <div class="table-responsive" style="margin-top: 10px;">
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>NO</th>
            <th>NIK</th>
            <th>NAMA</th>
            <th>TANGGAL LAHIR</th>
            <th>JENIS KELAMIN</th>
            <th>TELP</th>
            <th>ALAMAT</th>
            <th>AGAMA</th>
            <th>PEKERJAAN</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = $pdo->prepare($query);
        $sql->execute();
        $row = $sql->rowCount();

        $nomor_urut = 1; // Variabel untuk nomor urut

        if ($row > 0) {
            while ($data = $sql->fetch()) {
                $tanggal_lahir = date('d-m-Y', strtotime($data['tanggal_lahir']));

                echo "<tr>";
                echo "<td>".$nomor_urut."</td>"; // Tambahkan nomor urut
                echo "<td>".$data['nik']."</td>";
                echo "<td>".$data['nama']."</td>";
                echo "<td>".$tanggal_lahir."</td>";
                echo "<td>".$data['jenis_kelamin']."</td>";
                echo "<td>".$data['telp']."</td>";
                echo "<td>".$data['alamat']."</td>";
                echo "<td>".$data['agama']."</td>";
                echo "<td>".$data['pekerjaan']."</td>";
                echo "</tr>";

                $nomor_urut++; // Increment nomor urut untuk baris selanjutnya
            }
        } else {
            echo "<tr><td colspan='9'>Data tidak ada</td></tr>";
        }
        ?>
    </tbody>
</table>
            
            </table>
        </div>
    </div>

    <!-- Include File JS Bootstrap -->
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Include library Moment (Dibutuhkan untuk Datepicker) -->
    <script src="libraries/moment/moment.min.js"></script>

    <!-- Include library Bootstrap Datepicker -->
    <script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Include File JS Custom (untuk fungsi Datepicker) -->
    <script src="js/custom.js"></script>

    <script>
    $(document).ready(function(){
        setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
    </script>
</body>
</html>