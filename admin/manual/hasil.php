<?php
include '../../config.php';

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
    </style>
</head>


<body>
    <div class="d-flex">
        <?php include '../../sidebar.php'; ?>
        <div class="content">
            <div class="dashboard-header text-center">
                <h4>Hasil Audit Mutu Internal (AMI)</h4>
                <h4>Program Studi <?= $prodi ?></h4>
                <h4>Universitas Muhammadiyah Palangka Raya</h4>
            </div>
            <table>
                <thead>
                    <tr>
                        <th rowspan="2">STANDAR</th>
                        <th rowspan="2">KOMPONEN</th>
                        <th rowspan="2">INDIKATOR</th>
                        <th rowspan="2">SESUAI</th>
                        <th colspan="3">KETIDAK SESUAIAN</th>
                        <th rowspan="2">KETERANGAN/KESIMPULAN</th>
                    </tr>
                    <tr>
                        <!-- Tambahkan kolom untuk baris di bawah KETIDAK SESUAIAN -->
                        <th>Mayor</th>
                        <th>Minor</th>
                        <th>Observasi</th>
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
                                <td rowspan="<?= count($sub_standar['indikator']); ?>">
                                    <?= $sub_standar['nama']; ?>
                                </td>

                                <!-- Menampilkan indikator untuk sub-standar -->
                                <td><?= $sub_standar['indikator'][0]['nama']; ?></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <!-- Tampilkan indikator lainnya jika ada -->
                            <?php for ($i = 1; $i < count($sub_standar['indikator']); $i++): ?>
                                <tr>
                                    <td><?= $sub_standar['indikator'][$i]['nama']; ?></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                        <th colspan="5"></th>
                    </tr>
                </tfoot>

            </table>
            <br>
            <a href="penilaian.php?tahun=<?= $tahun ?>&prodi=<?= $prodi ?>" class="btn btn-secondary">Kembali</a>
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