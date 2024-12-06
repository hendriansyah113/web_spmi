<?php
require 'export_phpspreadsheet_date/vendor/autoload.php'; // Sesuaikan dengan lokasi file autoload di proyek Anda

// Load file koneksi.php
include "koneksi_export.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Panggil class Spreadsheet
$spreadsheet = new Spreadsheet();

// Settingan awal file excel
$spreadsheet->getProperties()
    ->setCreator('My Notes Code')
    ->setLastModifiedBy('My Notes Code')
    ->setTitle("Data Penduduk")
    ->setSubject("Penduduk")
    ->setDescription("Laporan Semua Data Penduduk")
    ->setKeywords("Data Penduduk");

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$styleHeader = [
    'font' => ['bold' => true], // Set font nya jadi bold
    'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER], // Set text jadi di tengah secara vertikal (middle)
    'borders' => [
        'top' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$styleRow = [
    'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER], // Set text jadi di tengah secara vertikal (middle)
    'borders' => [
        'top' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
        'right' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
        'bottom' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
        'left' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    ]
];

if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $filter = $_GET['filter']; // Ambil data filter yang dipilih user

    if ($filter == '1') { // Jika filter nya 1 (per tanggal)
        $tgl = date('d-m-y', strtotime($_GET['tanggal']));
        $label = 'Data Penduduk Tanggal ' . $tgl;

        $query = "SELECT * FROM ilkomfitria4 WHERE DATE(tanggal_lahir)='" . $_GET['tanggal'] . "'"; // Ubah 'tgl' menjadi 'tanggal_lahir'
    } elseif ($filter == '2') { // Jika filter nya 2 (per bulan)
        $nama_bulan = array('', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
        $label = 'Data Penduduk Bulan ' . $nama_bulan[$_GET['bulan']] . ' ' . $_GET['tahun'];

        $query = "SELECT * FROM ilkomfitria4 WHERE MONTH(tanggal_lahir)='" . $_GET['bulan'] . "' AND YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'";
    } else { // Jika filter nya 3 (per tahun)
        $label = 'Data Penduduk Tahun ' . $_GET['tahun'];

        $query = "SELECT * FROM ilkomfitria4 WHERE YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'";
    }
} else { // Jika user tidak memilih filter
    $label = 'Semua Data Penduduk';

    $query = "SELECT * FROM ilkomfitria4 ORDER BY tanggal_lahir"; // Ubah 'tgl' menjadi 'tanggal_lahir'
}

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', "DATA PENDUDUK"); // Set kolom A1 dengan tulisan "DATA PENDUDUK"
$sheet->mergeCells('A1:I1'); // Set Merge Cell pada kolom A1 sampai I1
$sheet->getStyle('A1')->applyFromArray($styleHeader); // Set style header ke kolom A1

$sheet->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
$sheet->mergeCells('A2:I2'); // Set Merge Cell pada kolom A2 sampai I2
$sheet->getStyle('A2')->applyFromArray($styleHeader); // Set style header ke kolom A2

// Buat header tabel pada baris ke-4
$sheet->setCellValue('A4', "No"); // Set kolom A4 dengan tulisan "No"
$sheet->setCellValue('B4', "NIK"); // Set kolom B4 dengan tulisan "NIK"
$sheet->setCellValue('C4', "Nama"); // Set kolom C4 dengan tulisan "Nama"
$sheet->setCellValue('D4', "Tanggal Lahir"); // Set kolom D4 dengan tulisan "Tanggal Lahir"
$sheet->setCellValue('E4', "Jenis Kelamin"); // Set kolom E4 dengan tulisan "Jenis Kelamin"
$sheet->setCellValue('F4', "Telp"); // Set kolom F4 dengan tulisan "Telp"
$sheet->setCellValue('G4', "Alamat"); // Set kolom G4 dengan tulisan "Alamat"
$sheet->setCellValue('H4', "Agama"); // Set kolom H4 dengan tulisan "Agama"
$sheet->setCellValue('I4', "Pekerjaan"); // Set kolom I4 dengan tulisan "Pekerjaan"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$sheet->getStyle('A4:I4')->applyFromArray($styleHeader);

// Set tinggi baris ke-1, 2, 3, dan 4
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);
$sheet->getRowDimension('4')->setRowHeight(20);

$sql = $pdo->prepare($query); // Eksekusi/Jalankan query dari variabel $query
$sql->execute(); // Ambil jumlah data dari hasil eksekusi $sql
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke-5

while ($data = $sql->fetch()) { // Ambil semua data dari hasil eksekusi $sql
    $tgl_lahir = date('d-m-Y', strtotime($data['tanggal_lahir'])); // Ubah format tanggal jadi dd-mm-yyyy

    $sheet->setCellValue('A' . $numrow, $no);
    $sheet->setCellValue('B' . $numrow, $data['nik']);
    $sheet->setCellValue('C' . $numrow, $data['nama']);
    $sheet->setCellValue('D' . $numrow, $tgl_lahir);
    $sheet->setCellValue('E' . $numrow, $data['jenis_kelamin']);
    $sheet->setCellValue('F' . $numrow, $data['telp']);
    $sheet->setCellValue('G' . $numrow, $data['alamat']);
    $sheet->setCellValue('H' . $numrow, $data['agama']);
    $sheet->setCellValue('I' . $numrow, $data['pekerjaan']);

    // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
    $sheet->getStyle('A' . $numrow . ':I' . $numrow)->applyFromArray($styleRow);

    // Set tinggi baris isi tabel
    $sheet->getRowDimension($numrow)->setRowHeight(20);

    $no++; // Tambah 1 setiap kali looping
    $numrow++; // Tambah 1 setiap kali looping
}

// Set lebar kolom
$sheet->getColumnDimension('A')->setWidth(5); // Set lebar kolom A
$sheet->getColumnDimension('B')->setWidth(18); // Set lebar kolom B
$sheet->getColumnDimension('C')->setWidth(25); // Set lebar kolom C
$sheet->getColumnDimension('D')->setWidth(15); // Set lebar kolom D
$sheet->getColumnDimension('E')->setWidth(15); // Set lebar kolom E
$sheet->getColumnDimension('F')->setWidth(15); // Set lebar kolom F
$sheet->getColumnDimension('G')->setWidth(30); // Set lebar kolom G
$sheet->getColumnDimension('H')->setWidth(15); // Set lebar kolom H
$sheet->getColumnDimension('I')->setWidth(20); // Set lebar kolom I

// Set orientasi kertas jadi LANDSCAPE
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$sheet->setTitle("Laporan Data Penduduk");

// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Penduduk.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
