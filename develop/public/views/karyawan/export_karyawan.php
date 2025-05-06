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
    $sheet->setCellValue('I' . $row, $data['phone']);
    $sheet->setCellValue('J' . $row, $data['id_finger']);
    $sheet->setCellValue('K' . $row, $data['join_date']);
    $sheet->setCellValue('L' . $row, $data['masa_kerja']);
    $sheet->setCellValue('M' . $row, $data['status_karyawan']);
    $sheet->setCellValue('N' . $row, $data['jabatan']);
    $sheet->setCellValue('O' . $row, $data['posisi']);
    $sheet->setCellValue('P' . $row, $data['unit']);
    $sheet->setCellValue('Q' . $row, $data['birth_date']);
    $sheet->setCellValue('R' . $row, $data['usia']);
    $sheet->setCellValue('S' . $row, $data['gen']);
    $sheet->setCellValue('T' . $row, $data['gender']);
    $sheet->setCellValue('U' . $row, $data['lokasi_kerja']);
    $sheet->setCellValue('V' . $row, $data['pendidikan_terakhir']);
    $sheet->setCellValue('W' . $row, $data['jurusan']);
    $sheet->setCellValue('X' . $row, $data['alamat']);
    $sheet->setCellValue('Y' . $row, $data['kecamatan']);
    $sheet->setCellValue('Z' . $row, $data['bpjs_kesehatan']);
    $sheet->setCellValue('AA' . $row, $data['bpjs_ketenagakerjaan']);
    $sheet->setCellValue('AB' . $row, $data['perusahaan_mitra']);
    $sheet->setCellValue('AC' . $row, $data['status_pekerjaan']);
    $sheet->setCellValue('AD' . $row, $data['status_pernikahan']);
    $row++;
}

// Output sebagai file Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="data_karyawan.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
