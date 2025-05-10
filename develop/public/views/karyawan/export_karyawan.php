<?php
require '../../../../vendor/autoload.php';
require '../../../app/config/koneksi.php'; // Pastikan ini mengarah ke koneksi database kamu

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = [
    'NO',
    'KATEGORI',
    'BRANCH',
    'KCU / AGEN',
    'NIK JNE',
    'NIK VENDOR',
    'NAMA KARYAWAN',
    'VENDOR',
    'HANDPHONE',
    'ID FINGER',
    'JOINDATE',
    'MASA KERJA',
    'STATUS KARYAWAN',
    'JABATAN',
    'POSISI',
    'UNIT',
    'SECTION',
    'BIRTHDATE',
    'USIA',
    'GEN',
    'GENDER',
    'LOKASI KERJA',
    'LEVEL PENDIDIKAN TERAKHIR',
    'JURUSAN',
    'ALAMAT',
    'KECAMATAN',
    'BPJS KESEHATAN',
    'BPJS KETENAGAKERJAAN',
    'NAMA CV/PERUSAHAAN MITRA',
    'STATUS PEKERJAAN',
    'STATUS PERNIKAHAN',
    'KET INDUCTION',
    'SERVICE BY HEART',
    'CODE OF CONDUCT',
    'CREAT VISION, MISSION,TARGET & STRATGY OF LIFE',
    'TRAINING PROFESI SCO',
    'TRAINING PROFESI SALES',
    'JSC (KURIR DEV PROGRAM)',
    'ID CARD',
    'SERAGAM'
];

$sheet->fromArray($headers, null, 'A1');

// Ambil data dari database
$sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE status_resign = 'NO' ORDER BY id_karyawan ASC");
$row = 2;
$no = 1;

while ($data = mysqli_fetch_assoc($sql)) {
    $sheet->setCellValue('A' . $row, $no++);
    $sheet->setCellValue('B' . $row, $data['kategori']);
    $sheet->setCellValue('C' . $row, $data['branch']);
    $sheet->setCellValue('D' . $row, $data['kcu_agen']);
    $sheet->setCellValue('E' . $row, $data['nik_jne']);
    $sheet->setCellValue('F' . $row, $data['nik_vendor']);
    $sheet->setCellValue('G' . $row, $data['nama_karyawan']);
    $sheet->setCellValue('H' . $row, $data['vendor']);
    $sheet->setCellValue('I' . $row, $data['phone']);
    $sheet->setCellValue('J' . $row, $data['id_finger']);
    $sheet->setCellValue('K' . $row, $data['join_date']);
    $sheet->setCellValue('L' . $row, $data['masa_kerja']);
    $sheet->setCellValue('M' . $row, $data['status_karyawan']);
    $sheet->setCellValue('N' . $row, $data['jabatan']);
    $sheet->setCellValue('O' . $row, $data['posisi']);
    $sheet->setCellValue('P' . $row, $data['unit']);
    $sheet->setCellValue('Q' . $row, $data['section']);
    $sheet->setCellValue('R' . $row, $data['birth_date']);
    $sheet->setCellValue('S' . $row, $data['usia']);
    $sheet->setCellValue('T' . $row, $data['gen']);
    $sheet->setCellValue('U' . $row, $data['gender']);
    $sheet->setCellValue('V' . $row, $data['lokasi_kerja']);
    $sheet->setCellValue('W' . $row, $data['pendidikan_terakhir']);
    $sheet->setCellValue('X' . $row, $data['jurusan']);
    $sheet->setCellValue('Y' . $row, $data['alamat']);
    $sheet->setCellValue('Z' . $row, $data['kecamatan']);
    $sheet->setCellValue('AA' . $row, $data['bpjs_kesehatan']);
    $sheet->setCellValue('AB' . $row, $data['bpjs_ketenagakerjaan']);
    $sheet->setCellValue('AC' . $row, $data['perusahaan_mitra']);
    $sheet->setCellValue('AD' . $row, $data['status_pekerjaan']);
    $sheet->setCellValue('AE' . $row, $data['status_pernikahan']);

    $sheet->setCellValue('AF' . $row, $data['ket_induction']);
    $sheet->setCellValue('AG' . $row, $data['service_byheart']);
    $sheet->setCellValue('AH' . $row, $data['code_ofconduct']);
    $sheet->setCellValue('AI' . $row, $data['visimisi_oflife']);
    $sheet->setCellValue('AJ' . $row, $data['training_sco']);
    $sheet->setCellValue('AK' . $row, $data['training_sales']);
    $sheet->setCellValue('AL' . $row, $data['kurir_program']);
    $sheet->setCellValue('AM' . $row, $data['id_card']);
    $sheet->setCellValue('AN' . $row, $data['seragam']);
    $row++;
}

// Output sebagai file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_karyawan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
