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
    'ID FINGER',
    'JOINDATE',
    'MASA KERJA',
    'STATUS KARYAWAN',
    'JABATAN',
    'POSISI',
    'UNIT',
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
    'STATUS PERNIKAHAN'
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
    $sheet->setCellValue('I' . $row, $data['id_finger']);
    $sheet->setCellValue('J' . $row, $data['join_date']);
    $sheet->setCellValue('K' . $row, $data['masa_kerja']);
    $sheet->setCellValue('L' . $row, $data['status_karyawan']);
    $sheet->setCellValue('M' . $row, $data['jabatan']);
    $sheet->setCellValue('N' . $row, $data['posisi']);
    $sheet->setCellValue('O' . $row, $data['unit']);
    $sheet->setCellValue('P' . $row, $data['birth_date']);
    $sheet->setCellValue('Q' . $row, $data['usia']);
    $sheet->setCellValue('R' . $row, $data['gen']);
    $sheet->setCellValue('S' . $row, $data['gender']);
    $sheet->setCellValue('T' . $row, $data['lokasi_kerja']);
    $sheet->setCellValue('U' . $row, $data['pendidikan_terakhir']);
    $sheet->setCellValue('V' . $row, $data['jurusan']);
    $sheet->setCellValue('W' . $row, $data['alamat']);
    $sheet->setCellValue('X' . $row, $data['kecamatan']);
    $sheet->setCellValue('Y' . $row, $data['bpjs_kesehatan']);
    $sheet->setCellValue('Z' . $row, $data['bpjs_ketenagakerjaan']);
    $sheet->setCellValue('AA' . $row, $data['perusahaan_mitra']);
    $sheet->setCellValue('AB' . $row, $data['status_pekerjaan']);
    $sheet->setCellValue('AC' . $row, $data['status_pernikahan']);
    $row++;
}

// Output sebagai file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_karyawan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
