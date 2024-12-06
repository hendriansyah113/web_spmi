<?php
// Load file koneksi.php
include "koneksi.php";

// Load file autoload.php
require 'vendor/autoload.php';

// Include librari PhpSpreadsheet
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
$style_col = [
	'font' => ['bold' => true], // Set font nya jadi bold
	'alignment' => [
		'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	],
	'borders' => [
		'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
		'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
		'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
		'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	]
];

// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
$style_row = [
	'alignment' => [
		'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
	],
	'borders' => [
		'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
		'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
		'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
		'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
	]
];

if(isset($_GET['filter']) && ! empty($_GET['filter'])){ // Cek apakah user telah memilih filter
	$filter = $_GET['filter']; // Ambil data filder yang dipilih user

	if($filter == '1'){ // Jika filter nya 1 (per tanggal)
		$tgl = date('d-m-y', strtotime($_GET['tanggal']));
		$label = 'Data Transaksi Tanggal '.$tgl;

		$query = "SELECT * FROM transaksi WHERE DATE(tgl)='".$_GET['tanggal']."'"; // Tampilkan data transaksi sesuai tanggal yang diinput oleh user pada filter
	}else if($filter == '2'){ // Jika filter nya 2 (per bulan)
		$nama_bulan = array('', 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$label = 'Data Transaksi Bulan '.$nama_bulan[$_GET['bulan']].' '.$_GET['tahun'];

		$query = "SELECT * FROM transaksi WHERE MONTH(tgl)='".$_GET['bulan']."' AND YEAR(tgl)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai bulan dan tahun yang diinput oleh user pada filter
	}else{ // Jika filter nya 3 (per tahun)
		$label = 'Data Transaksi Tahun '.$_GET['tahun'];

		$query = "SELECT * FROM transaksi WHERE YEAR(tgl)='".$_GET['tahun']."'"; // Tampilkan data transaksi sesuai tahun yang diinput oleh user pada filter
	}
}else{ // Jika user tidak memilih filter
	$label = 'Semua Data Transaksi';

	$query = "SELECT * FROM transaksi ORDER BY tgl"; // Tampilkan semua data transaksi diurutkan berdasarkan tanggal
}

$sheet->setCellValue('A1', "DATA TRANSAKSI"); // Set kolom A1 dengan tulisan "DATA SISWA"
$sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
$sheet->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1

$sheet->setCellValue('A2', $label); // Set kolom A2 sesuai dengan yang pada variabel $label
$sheet->mergeCells('A2:E2'); // Set Merge Cell pada kolom A2 sampai E2

// Buat header tabel nya pada baris ke 4
$sheet->setCellValue('A4', "Tanggal"); // Set kolom A4 dengan tulisan "Tanggal"
$sheet->setCellValue('B4', "Kode Transaksi"); // Set kolom B4 dengan tulisan "Kode Transaksi"
$sheet->setCellValue('C4', "Barang"); // Set kolom C4 dengan tulisan "Barang"
$sheet->setCellValue('D4', "Jumlah"); // Set kolom D4 dengan tulisan "Jumlah"
$sheet->setCellValue('E4', "Total Harga"); // Set kolom E4 dengan tulisan "Total Harga"

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$sheet->getStyle('A4')->applyFromArray($style_col);
$sheet->getStyle('B4')->applyFromArray($style_col);
$sheet->getStyle('C4')->applyFromArray($style_col);
$sheet->getStyle('D4')->applyFromArray($style_col);
$sheet->getStyle('E4')->applyFromArray($style_col);

// Set height baris ke 1, 2, 3 dan 4
$sheet->getRowDimension('1')->setRowHeight(20);
$sheet->getRowDimension('2')->setRowHeight(20);
$sheet->getRowDimension('3')->setRowHeight(20);
$sheet->getRowDimension('4')->setRowHeight(20);

$sql = mysqli_query($connect, $query); // Eksekusi/Jalankan query dari variabel $query
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 5

while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
	$tgl = date('d-m-Y', strtotime($data['tgl'])); // Ubah format tanggal jadi dd-mm-yyyy

	$sheet->setCellValue('A'.$numrow, $tgl);
	$sheet->setCellValue('B'.$numrow, $data['kode']);
	$sheet->setCellValue('C'.$numrow, $data['barang']);
	$sheet->setCellValue('D'.$numrow, $data['jumlah']);
	$sheet->setCellValue('E'.$numrow, $data['total_harga']);

	// Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
	$sheet->getStyle('A'.$numrow)->applyFromArray($style_row);
	$sheet->getStyle('B'.$numrow)->applyFromArray($style_row);
	$sheet->getStyle('C'.$numrow)->applyFromArray($style_row);
	$sheet->getStyle('D'.$numrow)->applyFromArray($style_row);
	$sheet->getStyle('E'.$numrow)->applyFromArray($style_row);

	$sheet->getRowDimension($numrow)->setRowHeight(20);

	$no++; // Tambah 1 setiap kali looping
	$numrow++; // Tambah 1 setiap kali looping
}

// Set width kolom
$sheet->getColumnDimension('A')->setWidth(15); // Set width kolom A
$sheet->getColumnDimension('B')->setWidth(18); // Set width kolom B
$sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
$sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
$sheet->getColumnDimension('E')->setWidth(20); // Set width kolom E

// Set orientasi kertas jadi LANDSCAPE
$sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file sheet nya
$sheet->setTitle("Laporan Data Transaksi");
$sheet;

// Proses file sheet
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Transaksi.xlsx"'); // Set nama file sheet nya
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
?>
