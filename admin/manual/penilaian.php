<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'web_spmi';
$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$tahun = $_GET['tahun'];
$prodi = $_GET['prodi'];

// Tentukan kolom skor berdasarkan prodi
$kolom_skor = ($prodi === 'Farmasi') ? 'indikator.skor_farmasi' : 'indikator.skor_analisis_kesehatan';

// Query untuk mengambil data standar, sub-standar, dan indikator
$query = "
   SELECT 
        standar.id AS standar_id, 
        standar.nama AS standar_nama, 
        sub_standar.id AS sub_standar_id, 
        sub_standar.nama AS sub_standar_nama,
        indikator.id AS indikator_id,
        indikator.nama AS indikator_nama,
        $kolom_skor AS indikator_skor
    FROM standar
    LEFT JOIN sub_standar ON standar.id = sub_standar.standar_id
    LEFT JOIN indikator ON sub_standar.id = indikator.sub_standar_id
    WHERE standar.tahun = '$tahun'
    ORDER BY standar.id, sub_standar.id, indikator.id
";
$result = mysqli_query($conn, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    // Cek nilai NULL dan gantikan dengan string kosong ('')
    $standar_nama = $row['standar_nama'] ?: '';
    $sub_standar_nama = $row['sub_standar_nama'] ?: '';
    $indikator_nama = $row['indikator_nama'] ?: '';
    $indikator_skor = $row['indikator_skor'] ?: 0;

    $data[$row['standar_id']]['nama'] = $standar_nama;
    $data[$row['standar_id']]['sub_standar'][$row['sub_standar_id']]['nama'] = $sub_standar_nama;
    $data[$row['standar_id']]['sub_standar'][$row['sub_standar_id']]['indikator'][] = [
        'id' => $row['indikator_id'],
        'nama' => $indikator_nama,
        'skor' => $indikator_skor
    ];
}

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

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Standar, Sub-Standar, dan Indikator</title>
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
        <div class="sidebar">
            <h3>Sistem Informasi Audit Mutu Internal (SIAMI)</h3>
            <p>Universitas Muhammadiyah Palangkaraya</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="fas fa-home"></i>&nbsp; Dashboard
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-users"></i>&nbsp; User
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="auditor/index.php">Auditor</a></li>
                        <li><a class="dropdown-item" href="auditee/index.php">Auditee</a></li>
                    </ul>
                </li>
                <div class="divider"></div>
                <!-- New Menu Item: Audit Mutu Internal -->
                <li class="nav-item">
                    <a class="nav-link" href="manual/pelaksanaan.php">
                        <i class="fas fa-chart-line"></i>&nbsp; Audit Mutu Internal
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manual/standar.php">
                        <i class="fas fa-chart-line"></i>&nbsp; Kelola Indikator
                    </a>
                </li>
                <div class="divider"></div>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/web_spmi/login.html">
                        <i class="fas fa-sign-out-alt"></i>&nbsp; Logout
                    </a>
                </li>
            </ul>
        </div>
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
            <table>
                <thead>
                    <tr>
                        <th>Standar</th>
                        <th>Sub Standar</th>
                        <th>Indikator</th>
                        <th>Skor</th>
                        <th>Penilaian</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop untuk menampilkan data Standar, Sub-Standar, dan Indikator
                    foreach ($data as $standar):
                        $total_indikator = 0; // Variabel untuk menghitung total indikator per standar
                        foreach ($standar['sub_standar'] as $sub_standar) {
                            $total_indikator += count($sub_standar['indikator']);
                        }
                        $first_sub_standar = true; // Penanda untuk pertama kali sub-standar
                        foreach ($standar['sub_standar'] as $sub_standar): ?>
                            <tr>
                                <!-- Menampilkan standar hanya sekali per grup, menghitung total indikator -->
                                <?php if ($first_sub_standar): ?>
                                    <td rowspan="<?= $total_indikator; ?>">
                                        <?= $standar['nama']; ?>
                                    </td>
                                <?php $first_sub_standar = false;
                                endif; ?>

                                <!-- Menampilkan sub-standar hanya sekali per grup dengan rowspan sesuai indikator -->
                                <td class="vertical" rowspan="<?= count($sub_standar['indikator']); ?>">
                                    <?= $sub_standar['nama']; ?>
                                </td>

                                <!-- Menampilkan indikator untuk sub-standar -->
                                <td><?= $sub_standar['indikator'][0]['nama']; ?></td>
                                <td><?= isset($sub_standar['indikator'][0]['skor']) ? $sub_standar['indikator'][0]['skor'] : 'Tidak ada skor'; ?>
                                </td>

                                <!-- Kolom Penilaian, tombol untuk membuka modal -->
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#penilaianModal"
                                        data-indikator-id="<?= $sub_standar['indikator'][0]['id']; ?>">
                                        Penilaian
                                    </button>
                                </td>
                            </tr>
                            <!-- Tampilkan indikator lainnya jika ada -->
                            <?php for ($i = 1; $i < count($sub_standar['indikator']); $i++): ?>
                                <tr>
                                    <td><?= $sub_standar['indikator'][$i]['nama']; ?></td>
                                    <td><?= isset($sub_standar['indikator'][$i]['skor']) ? $sub_standar['indikator'][$i]['skor'] : 'Tidak ada skor'; ?>
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#penilaianModal"
                                            data-indikator-id="<?= $sub_standar['indikator'][$i]['id']; ?>">
                                            Penilaian
                                        </button>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2">Jumlah Indikator</th>
                        <th><?= $total_indikator_tfoot; ?></th>
                        <th colspan="2"><?= $total_skor; ?> Skor</th>
                    </tr>
                </tfoot>

            </table>
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