<?php
require 'export_phpspreadsheet_date/vendor/autoload.php'; // Adjust with the location of the autoload file in your project

// Load the connection file
include "koneksi_export.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// Create a new Spreadsheet
$excel = new Spreadsheet();

// Set initial properties for the Excel file
$excel->getProperties()->setCreator('My Notes Code')
                       ->setLastModifiedBy('My Notes Code')
                       ->setTitle("Data Kelahiran")
                       ->setSubject("Laporan Semua Data Kelahiran")
                       ->setDescription("Laporan Data Kelahiran")
                       ->setKeywords("Data Kelahiran");

// Define styles for header and rows
$style_col = [
    'font' => ['bold' => true],
    'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
    'borders' => [
        'top' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
    ]
];

$style_row = [
    'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER],
    'borders' => [
        'top' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'right' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'bottom' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        'left' => ['style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
    ]
];

// Initialize query
$query = "SELECT * FROM ilkomfitria3";

if (isset($_GET['filter']) && !empty($_GET['filter'])) {
    $filter = $_GET['filter'];

    if ($filter == '1') {
        $tgl = date('Y-m-d', strtotime($_GET['tanggal']));
        $label = 'Data Kelahiran Tanggal ' . $tgl;
        $query .= " WHERE DATE(tanggal_lahir)='" . $_GET['tanggal'] . "'";
    } else if ($filter == '2') {
        $label = 'Data Kelahiran Bulan ' . $_GET['bulan'] . ' ' . $_GET['tahun'];
        $query .= " WHERE MONTH(tanggal_lahir)='" . $_GET['bulan'] . "' AND YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'";
    } else {
        $label = 'Data Kelahiran Tahun ' . $_GET['tahun'];
        $query .= " WHERE YEAR(tanggal_lahir)='" . $_GET['tahun'] . "'";
    }
}

$query .= " ORDER BY tanggal_lahir"; // Change 'tgl' to 'tanggal_lahir'

$excel->setActiveSheetIndex(0);
$excel->getActiveSheet()->setCellValue('A1', "DATA KELAHIRAN");
$excel->getActiveSheet()->mergeCells('A1:C1');
$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);

$excel->getActiveSheet()->setCellValue('A2', $label);
$excel->getActiveSheet()->mergeCells('A2:C2');
$excel->getActiveSheet()->getStyle('A2')->applyFromArray($style_col);

$excel->getActiveSheet()->setCellValue('A4', "Id");
$excel->getActiveSheet()->setCellValue('B4', "Tanggal Lahir");
$excel->getActiveSheet()->setCellValue('C4', "Jumlah Kelahiran");

$excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);

$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);

// Handle SQL execution errors
$sql = $pdo->prepare($query);
if ($sql->execute()) {
    $numrow = 5;

    while ($data = $sql->fetch()) {
        $tgl_lahir = date('d-m-Y', strtotime($data['tanggal_lahir']));

        $excel->getActiveSheet()->setCellValue('A' . $numrow, $data['id']);
        $excel->getActiveSheet()->setCellValue('B' . $numrow, $tgl_lahir);
        $excel->getActiveSheet()->setCellValue('C' . $numrow, $data['jumlah_kelahiran']);

        $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_row);
        $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_row);

        $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);

        $numrow++;
    }

    // Set column width
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
}

// Set paper orientation to LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);

// Set the title of the Excel file
$excel->getActiveSheet()->setTitle("Laporan Data Kelahiran");

// Ensure no output before header
ob_end_clean();

// Process the Excel file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Data Kelahiran.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($excel, 'Xlsx');
$writer->save('php://output');
?>
