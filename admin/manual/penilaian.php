<?php
include '../../config.php';
$tahun = $_GET['tahun'];
$prodi = $_GET['prodi'];
$id_pelaksana = $_GET['id_pelaksanaan'];

// Tentukan kolom skor berdasarkan prodi
$kolom_skor = ($prodi === 'Farmasi') ? 'skor_farmasi' : 'skor_analisis_kesehatan';

// Query untuk menghitung total indikator
$query_total_indikator = "
    SELECT COUNT(indikator.id) AS total_indikator
    FROM indikator
    INNER JOIN sub_standar ON indikator.sub_standar_id = sub_standar.id
    INNER JOIN standar ON sub_standar.standar_id = standar.id
    WHERE indikator.nama IS NOT NULL AND standar.tahun = '$tahun'
";
$result_total_indikator = mysqli_query($conn, $query_total_indikator);
$total_indikator_tfoot = 0;
if ($row = mysqli_fetch_assoc($result_total_indikator)) {
    $total_indikator_tfoot = $row['total_indikator'];
}

// Query untuk menghitung total skor
$query_total_skor = "
    SELECT SUM($kolom_skor) AS total_skor
    FROM indikator
    INNER JOIN sub_standar ON indikator.sub_standar_id = sub_standar.id
    INNER JOIN standar ON sub_standar.standar_id = standar.id
    WHERE indikator.nama IS NOT NULL 
      AND standar.tahun = '$tahun'
";
$result_total_skor = mysqli_query($conn, $query_total_skor);
$total_skor = 0;
if ($row = mysqli_fetch_assoc($result_total_skor)) {
    $total_skor = intval($row['total_skor']);
}

// Ambil data standar dari database
$standarQuery = "SELECT * FROM standar WHERE tahun = '$tahun'";
$standarResult = mysqli_query($conn, $standarQuery);
$standarData = [];
while ($row = mysqli_fetch_assoc($standarResult)) {
    $standarData[] = $row;
}

// Query untuk mengambil data pelaksanaan
$query_pelaksanaan = "
    SELECT status
    FROM pelaksanaan
    WHERE id_pelaksanaan = '$id_pelaksana'
";
$result_pelaksanaan = mysqli_query($conn, $query_pelaksanaan);
$status_pelaksanaan = '';
if ($row = mysqli_fetch_assoc($result_pelaksanaan)) {
    $status_pelaksanaan = $row['status'];
}

// Cek apakah status pelaksanaan ditutup
$aksi_visible = ($status_pelaksanaan !== 'Ditutup');

function displayData()
{
    // Koneksi ke database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'web_spmi';

    // Koneksi ke database
    $conn = new mysqli($host, $username, $password, $database);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    global $tahun;
    global $prodi;
    global $aksi_visible;
    global $id_pelaksanaan;

    $kolom_upload = ($prodi === 'Farmasi') ? 'upload_dokumen_farmasi' : 'upload_dokumen_ak';
    $kolom_dokumen = ($prodi === 'Farmasi') ? 'kelengkapan_dokumen_farmasi' : 'kelengkapan_dokumen_ak';
    $catatan = ($prodi === 'Farmasi') ? 'catatan_farmasi' : 'catatan_ak';

    // Menampilkan data standar
    $sql = "SELECT * FROM standar_audit WHERE tahun = '$tahun'";
    $result_standar_audit = $conn->query($sql);

    if ($result_standar_audit->num_rows > 0) {
        // Tampilkan standar dalam baris pertama tabel
        echo "<table>
                <thead>
                    <tr>
                        <th>Nomor</th>
                        <th>Uraian</th>
                        <th>Upload Dokumen</th>
                        <th>Kelengkapan Dokumen</th>
                        <th>Catatan</th>";
        // Menampilkan kolom Upload terakhir hanya jika role = 'auditee'
        if ($_SESSION['role'] == 'auditee' && $aksi_visible) {
            echo "<th>Upload</th>";
        }
        // Menampilkan kolom Aksi terakhir hanya jika role = 'auditor'
        if ($_SESSION['role'] == 'auditor' && $aksi_visible) {
            echo "<th>Verifikasi</th>";
        }

        echo "</tr>
                </thead>
                <tbody>";

        // Menampilkan standar pada baris pertama
        while ($row = $result_standar_audit->fetch_assoc()) {
            echo "<tr>
                    <td></td>
                    <td>" . $row['nama_standar'] . "</td>
                    <td></td>
                    <td></td>";
            if ($_SESSION['role'] == 'auditor' || $_SESSION['role'] == 'auditee' && $aksi_visible) {
                echo "<td></td>";
            }
            echo "</tr>";

            // Menampilkan soal audit terkait standar ini
            $standar_id = $row['id'];
            $sql_audit = "SELECT * FROM audit_dokumen WHERE standar_id = $standar_id ORDER BY soal_nomor";
            $result_audit = $conn->query($sql_audit);

            if ($result_audit->num_rows > 0) {
                while ($audit = $result_audit->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $audit['soal_nomor'] . "</td>
                            <td>" . $audit['uraian'] . "</td>
                            <td>";
                    // Cek apakah ada dokumen yang diupload
                    if ($audit[$kolom_upload]) {
                        echo "<a href='uploads/" . $audit[$kolom_upload] . "' target='_blank'>Lihat Dokumen</a>";
                    } else {
                        echo "Tidak ada dokumen";
                    }
                    echo "</td>
                             <td>" . (($audit[$kolom_dokumen] === 'Lengkap') ? '✔' : '✖') . "</td>
                            <td>" . $audit[$catatan] . "</td>";

                    if ($_SESSION['role'] == 'auditee' && $aksi_visible) {
                        echo "<td>
                                <form action='upload.php' method='POST' enctype='multipart/form-data'>
                                    <div class='mb-3'>
                                        <input type='file' name='upload_dokumen' class='form-control' accept='.pdf, .doc, .docx, .jpg, .jpeg, .png' />
                                        <input type='hidden' name='audit_id' value='" . $audit['id'] . "' />
                                        <input type='hidden' name='tahun' value='" . $tahun . "' /> <!-- Tahun pelaksanaan -->
                                           <input type='hidden' name='prodi' value='" . $prodi . "' /> <!-- Menambahkan input prodi -->
                                        <input type='submit' value='Upload' class='btn btn-primary mt-2' />
                                    </div>
                                </form>
                            </td>";
                    }

                    if ($_SESSION['role'] == 'auditor' && $aksi_visible) {
                        echo "<td>
                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAudit" . $audit['id'] . "'>Aksi Audit</button>
            </td>";
                    }

                    echo "</tr>";

                    // Modal untuk audit
                    echo "<div class='modal fade' id='modalAudit" . $audit['id'] . "' tabindex='-1' aria-labelledby='modalLabel" . $audit['id'] . "' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h5 class='modal-title'>Form Audit: " . $audit['uraian'] . "</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <form action='audit_action.php' method='POST'>
                <div class='modal-body'>
                    <input type='hidden' name='audit_id' value='" . $audit['id'] . "' />
                    <input type='hidden' name='prodi' value='" . $prodi . "' /> <!-- Hidden input untuk prodi -->
                      <input type='hidden' name='id_pelaksanaan' value='" . $id_pelaksanaan . "' /> <!-- ID pelaksanaan -->
    <input type='hidden' name='tahun' value='" . $tahun . "' /> <!-- Tahun pelaksanaan -->
                    <div class='mb-3'>
                        <label for='keLan_dokumen' class='form-label'>Kelengkapan Dokumen</label>
                        <select name='kelengkapan_dokumen' class='form-control'>
                            <option value='Lengkap'>Lengkap</option>
                            <option value='Tidak Lengkap'>Tidak Lengkap</option>
                        </select>
                    </div>
                    <div class='mb-3'>
                        <label for='catatan' class='form-label'>Catatan</label>
                        <textarea name='catatan' class='form-control' rows='3'></textarea>
                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                    <button type='submit' class='btn btn-primary'>Simpan</button>
                </div>
            </form>
        </div>
    </div>
  </div>";

                    // Menampilkan soal sub audit terkait soal audit ini
                    $audit_id = $audit['id'];
                    $sql_sub_audit = "SELECT * FROM audit_soal WHERE audit_id = $audit_id";
                    $result_sub_audit = $conn->query($sql_sub_audit);

                    if ($result_sub_audit->num_rows > 0) {
                        while ($sub_audit = $result_sub_audit->fetch_assoc()) {
                            echo "<tr>
                                    <td>" . '' . "</td>
                                    <td>" . $sub_audit['uraian'] . "</td>
                                    <td>";
                            // Cek apakah ada dokumen yang diupload untuk sub audit
                            if ($sub_audit[$kolom_upload]) {
                                echo "<a href='uploads/" . $sub_audit[$kolom_upload] . "' target='_blank'>Lihat Dokumen</a>";
                            } else {
                                echo "Tidak ada dokumen";
                            }
                            echo "</td>
                                    <td>" . (($sub_audit[$kolom_dokumen] === 'Lengkap') ? '✔' : '✖') . "</td>
                                    <td>" . $sub_audit[$catatan] . "</td>";

                            if ($_SESSION['role'] == 'auditee' && $aksi_visible) {
                                echo " <td>
                                        <form action='upload.php' method='POST' enctype='multipart/form-data'>
                                            <div class='mb-3'>
                                                <input type='file' name='upload_dokumen' class='form-control' accept='.pdf, .doc, .docx, .jpg, .jpeg, .png' />
                                                <input type='hidden' name='sub_audit_id' value='" . $sub_audit['id'] . "' />
                                                <input type='hidden' name='tahun' value='" . $tahun . "' /> <!-- Tahun pelaksanaan -->
                                                   <input type='hidden' name='prodi' value='" . $prodi . "' /> <!-- Menambahkan input prodi -->
                                                <input type='submit' value='Upload' class='btn btn-primary mt-2' />
                                            </div>
                                        </form>
                                    </td>";
                            }

                            if ($_SESSION['role'] == 'auditor' && $aksi_visible) {
                                echo "<td>
                    <button class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modalSubAudit" . $sub_audit['id'] . "'>Aksi Sub-Audit</button>
                </td>";
                            }

                            echo  "</tr>";

                            // Modal untuk sub-audit
                            echo "<div class='modal fade' id='modalSubAudit" . $sub_audit['id'] . "' tabindex='-1' aria-labelledby='modalLabel" . $sub_audit['id'] . "' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <h5 class='modal-title'>Form Sub-Audit: " . $sub_audit['uraian'] . "</h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                        </div>
                        <form action='sub_audit_action.php' method='POST'>
                            <div class='modal-body'>
                                <input type='hidden' name='sub_audit_id' value='" . $sub_audit['id'] . "' />
                                <input type='hidden' name='prodi' value='" . $prodi . "' /> <!-- Hidden input untuk prodi -->
                                 <input type='hidden' name='id_pelaksanaan' value='" . $id_pelaksanaan . "' /> <!-- ID pelaksanaan -->
    <input type='hidden' name='tahun' value='" . $tahun . "' /> <!-- Tahun pelaksanaan -->
                                <div class='mb-3'>
                                    <label for='kelengkapan_dokumen' class='form-label'>Kelengkapan Dokumen</label>
                                    <select name='kelengkapan_dokumen' class='form-control'>
                                        <option value='Lengkap'>Lengkap</option>
                                        <option value='Tidak Lengkap'>Tidak Lengkap</option>
                                    </select>
                                </div>
                                <div class='mb-3'>
                                    <label for='catatan' class='form-label'>Catatan</label>
                                    <textarea name='catatan' class='form-control' rows='3'></textarea>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Tutup</button>
                                <button type='submit' class='btn btn-primary'>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
              </div>";
                        }
                    }
                }
            }
        }

        echo "</tbody>
              </table>";
    } else {
        echo "<p>Tidak ada data standar ditemukan.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Standar, Sub-Standar, dan Indikator</title>
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
            <div class="dashboard-header text-center">
                <h4>INSTRUMEN PENILAIAN</h4>
                <h4>AUDIT MUTU INTERNAL PROGRAM STUDI</h4>
                <h4>UNIVERSITAS MUHAMMADIYAH PALANGKARAYA</h4>
                <h4>TAHUN AJARAN <?= $_GET['tahun'] ?></h4>
            </div>
            <div class="dashboard-header">
                <h6>Nama Program Studi : <?= $prodi ?></h6>
                <h6>Hari, Tgl Pelaksanaan :</h6>
                <h6>Jam :</h6>
            </div>
            <div class="row">
                <div class="col-3">
                    <!-- Vertical Tabs for Standar -->
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <?php foreach ($standarData as $index => $standar): ?>
                            <button class="nav-link <?= $index === 0 ? 'active' : '' ?>"
                                id="v-pills-standar<?= $standar['id'] ?>-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-standar<?= $standar['id'] ?>" type="button" role="tab"
                                aria-controls="v-pills-standar<?= $standar['id'] ?>"
                                aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <?= $standar['nama'] ?>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="col-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <?php foreach ($standarData as $index => $standar): ?>
                            <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>"
                                id="v-pills-standar<?= $standar['id'] ?>" role="tabpanel"
                                aria-labelledby="v-pills-standar<?= $standar['id'] ?>-tab">
                                <!-- Konten untuk Standar <?= $standar['nama'] ?> -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Sub Standar</th>
                                            <th>Indikator</th>
                                            <th>Skor</th>
                                            <?php if ($_SESSION['role'] == 'auditor' && $aksi_visible): ?>
                                                <th>Penilaian</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Ambil data sub standar dan indikator berdasarkan standar
                                        $subStandarQuery = "SELECT * FROM sub_standar WHERE standar_id = " . $standar['id'];
                                        $subStandarResult = mysqli_query($conn, $subStandarQuery);
                                        while ($subStandar = mysqli_fetch_assoc($subStandarResult)):
                                            $indikatorQuery = "SELECT * FROM indikator WHERE sub_standar_id = " . $subStandar['id'];
                                            $indikatorResult = mysqli_query($conn, $indikatorQuery);
                                            while ($indikator = mysqli_fetch_assoc($indikatorResult)):

                                        ?>
                                                <tr>
                                                    <td><?= $subStandar['nama'] ?></td>
                                                    <td><?= $indikator['nama'] ?></td>
                                                    <td><?= $indikator[$kolom_skor] ?></td>
                                                    <?php if ($_SESSION['role'] == 'auditor' && $aksi_visible): ?>
                                                        <td>
                                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                                data-bs-target="#penilaianModal"
                                                                data-indikator-id="<?= $indikator['id'] ?>">Nilai</button>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                        <?php
                                            endwhile;
                                        endwhile;
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Indikator</th>
                                            <th><?= $total_indikator_tfoot ?></th>
                                            <th colspan="2"><?= $total_skor; ?> Skor</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="dashboard-header text-center">
                <h4>INSTRUMEN KELENGKAPAN DOKUMEN</h4>
                <h4>AUDIT MUTU INTERNAL TAHUN <?= $_GET['tahun'] ?></h4>
            </div>
            <?php displayData(); ?>
            <br>
            <a href="hasil.php?tahun=<?= $tahun ?>&prodi=<?= $prodi ?>" class="btn btn-secondary">Hasil Audit</a>
        </div>

        <!-- Modal Penilaian -->
        <div class="modal fade" id="penilaianModal" tabindex="-1" aria-labelledby="penilaianModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="penilaianModalLabel">Pilih Soal Penilaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="soal-container">
                            <!-- Soal akan dimuat di sini menggunakan JavaScript -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="button" class="btn btn-primary">Simpan Penilaian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var prodi = "<?php echo $prodi; ?>"; // $prodi adalah variabel PHP yang berisi data prodi
        // Saat tombol "Penilaian" ditekan
        $('#penilaianModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Tombol yang men-trigger modal
            var indikator_id = button.data('indikator-id'); // Ambil indikator_id

            // Kosongkan kontainer soal sebelumnya
            $('#soal-container').html('<p>Memuat soal...</p>');

            // Mengambil soal dengan AJAX berdasarkan indikator_id
            $.ajax({
                url: 'get_indikator.php', // URL PHP yang mengambil soal
                method: 'GET',
                data: {
                    indikator_id: indikator_id
                },
                success: function(response) {
                    var soal = JSON.parse(response); // Parsing data JSON yang dikirim
                    var html = '';
                    if (soal.length > 0) {
                        // Looping untuk menampilkan soal dan radio button
                        $.each(soal, function(index, item) {
                            html += '<div>';
                            html += '<input type="radio" name="soal_' + indikator_id +
                                '" value="' + item.poin + '"> ';
                            html += item.nama_nilai_indikator + ' (Poin: ' + item.poin +
                                ')';
                            html += '</div>';
                        });
                    } else {
                        html = '<p>Soal tidak ditemukan.</p>';
                    }
                    // Masukkan soal ke dalam modal
                    $('#soal-container').html(html);
                },
                error: function(xhr, status, error) {
                    $('#soal-container').html('<p>Terjadi kesalahan saat mengambil soal.</p>');
                }
            });
        });

        // Saat form disubmit untuk menyimpan penilaian
        $('.btn-primary').on('click', function() {
            var soal_data = [];
            $('input[type="radio"]:checked').each(function() {
                var soal_id = $(this).attr('name').split('_')[1]; // Mengambil indikator_id
                var poin = $(this).val(); // Ambil poin yang dipilih
                soal_data.push({
                    soal_id: soal_id,
                    poin: poin
                });
            });

            if (soal_data.length > 0) {
                $.ajax({
                    url: 'simpan_penilaian.php', // URL PHP yang menyimpan penilaian
                    method: 'POST',
                    data: {
                        penilaian: soal_data,
                        prodi: prodi // Menambahkan nilai 'prodi' ke dalam data
                    },
                    success: function(response) {
                        alert('Penilaian berhasil disimpan!');
                        $('#penilaianModal').modal('hide');
                        // Menyegarkan halaman setelah penilaian disimpan
                        window.location.reload(); // Refresh halaman
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menyimpan penilaian.');
                    }
                });
            }
        });
    </script>


</body>

</html>