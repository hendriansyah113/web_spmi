<?php
// Load file koneksi.php
include "koneksi_export.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Export Excel Plus Filter Tanggal</title>

    <link href="css_export/bootstrap.min.css" rel="stylesheet"> <!-- Include file bootstrap.min.css -->
    <link href="libraries/fontawesome/css/all.min.css" rel="stylesheet"> <!-- Include library Font Awesome -->
    <link href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet"> <!-- Include library Datepicker Gijgo -->

    <script src="js_export/jquery.min.js"></script> <!-- Load file jquery -->
</head>
<style>
    .crud-pencarian {
        background-image: linear-gradient(to bottom right, #61ba6d, #82c332);
        padding-left: 25px;
        margin: 10px;
        border-radius: 5px;
        border: solid 1px;
        color: white;
    }

    .mul-a {
        color: white;
    }

    .mul-a:hover {
        color: black;
    }
</style>
<body style="padding: 0 20px;">
<div class="crud-pencarian">
    <h1>Data Kelahiran</h1>
</div>
<hr>

<form method="get" action="">
    <div class="row">
        <div class="col-sm-3 col-md-2">
            <div class="form-group">
                <label>Filter Berdasarkan</label>
                <select name="filter" id="filter" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Per Tanggal Lahir</option>
                    <option value="2">Per Bulan</option>
                    <option value="3">Per Tahun</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row" id="form-tanggal">
        <div class="col-sm-3 col-md-2">
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="text" name="tanggal" class="form-control datepicker datetimepicker-input" data-toggle="datetimepicker"
                       data-target=".datepicker" autocomplete="off"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3 col-md-2" id="form-bulan">
            <div class="form-group">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    <option value="">Pilih</option>
                    <option value="1">Januari</option>
                    <option value="2">Februari</option>
                    <option value="3">Maret</option>
                    <option value="4">April</option>
                    <option value="5">Mei</option>
                    <option value="6">Juni</option>
                    <option value="7">Juli</option>
                    <option value="8">Agustus</option>
                    <option value="9">September</option>
                    <option value="10">Oktober</option>
                    <option value="11">November</option>
                    <option value="12">Desember</option>
                </select>
            </div>
        </div>
        <div class="col-sm-3 col-md-2" id="form-tahun">
            <div class="form-group">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                    <option value="">Pilih</option>
                    <?php
                    $query = "SELECT YEAR(tanggal_lahir) AS tahun FROM ilkomfitria3 GROUP BY YEAR(tanggal_lahir)"; // Tampilkan tahun sesuai di tabel transaksi
                    $sql = $pdo->prepare($query); // Tampilkan tahun sesuai di tabel transaksi
                    $sql->execute(); // Ambil jumlah data dari hasil eksekusi $sql

                    while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql
                        echo '<option value="' . $data['tahun'] . '">' . $data['tahun'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Tampilkan</button>
    <a href="index_export.php" class="btn btn-default">Reset Filter</a>
         <p> <a href="http://localhost/coba_kelurahan/login_php/search_pagination" class="btn btn-default">Kembali</a> </p>
</form>
<hr/>

<?php
if (isset($_GET['filter']) && !empty($_GET['filter'])) { // Cek apakah user telah memilih filter dan klik tombol tampilkan
    $filter = $_GET['filter']; // Ambil data filder yang dipilih user

    if ($filter == '1') { // Jika filter nya 1 (per tanggal)
        $tgl = date('d-m-y', strtotime($_GET['tanggal']));

        echo '<b>Data Kelahiran Tanggal ' . $tgl . '</b><br /><br />';
        echo '<a href="proses_export.php?filter=1&tanggal=' . $_GET['tanggal'] . '" class="btn btn-success btn-sm">Export Excel</a><br /><br />';

        $query = "SELECT * FROM ilkomfitria3 WHERE DATE(tanggal_lahir)='" . $_GET['tanggal'] . "'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
    } else if ($filter == '2') { // Jika filter nya 2 (per bulan)
        $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

        echo '<b>Data Kelahiran Bulan ' . $nama_bulan[$_GET['bulan']] . ' ' . $_GET['tahun'] . '</b><br /><br />';
        echo '<a href="proses_export.php?filter=2&bulan=' . $_GET['bulan'] . '&tahun=' . $_GET['tahun'] . '" class="btn btn-success btn-sm">Export Excel</a><br /><br />';

        $query = "SELECT * FROM ilkomfitria3 WHERE MONTH(tanggal_lahir)='" . $_GET['bulan'] . "' AND YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
    } else { // Jika filter nya 3 (per tahun)
        echo '<b>Data Kelahiran Tahun ' . $_GET['tahun'] . '</b><br /><br />';
        echo '<a href="proses_export.php?filter=3&tahun=' . $_GET['tahun'] . '" class="btn btn-success btn-sm">Export Excel</a><br /><br />';

        $query = "SELECT * FROM ilkomfitria3 WHERE YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
    }
} else { // Jika user tidak mengklik tombol tampilkan
    echo '<b>Semua Data Kelahiran</b><br /><br />';
    echo '<a href="proses_export.php" class="btn btn-success btn-sm">Export Excel</a><br /><br />';

    $query = "SELECT * FROM ilkomfitria3 ORDER BY tanggal_lahir"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
}
?>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>Tanggal Lahir</th>
            <th>Jumlah Kelahiran</th>
        </tr>
        <?php
        $sql = $pdo->prepare($query);
        $sql->execute();

        $row = $sql->rowCount();

        if ($row > 0) {
            while ($data = $sql->fetch()) {
                $tgl = date('d-m-Y', strtotime($data['tanggal_lahir']));

                echo "<tr>";
                echo "<td>" . (isset($data['id']) ? $data['id'] : '') . "</td>";
                echo "<td>" . $tgl . "</td>";
                echo "<td>" . $data['jumlah_kelahiran'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Data tidak ada</td></tr>";
        }
        ?>
    </table>
</div>


<script src="js_export/bootstrap.min.js"></script> <!-- Include file boootstrap.min.js -->
<script src="libraries/moment/moment.min.js"></script> <!-- Include library Moment JS -->
<script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> <!-- Include library Datepicker Gijgo -->
<script>
    $(document).ready(function () { // Ketika halaman selesai di load
        setDatePicker() // Panggil fungsi setDatePicker

        $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya

        $('#filter').change(function () { // Ketika user memilih filter
            if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
                $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
                $('#form-tanggal').show(); // Tampilkan form tanggal
            } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
                $('#form-tanggal').hide(); // Sembunyikan form tanggal
                $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
            } else { // Jika filternya 3 (per tahun)
                $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
                $('#form-tahun').show(); // Tampilkan form tahun
            }

            $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
        })
    })

    function setDatePicker() {
        $(".datepicker").datetimepicker({
            format: "YYYY-MM-DD",
            useCurrent: false
        })
    }
</script>
</body>
</html>