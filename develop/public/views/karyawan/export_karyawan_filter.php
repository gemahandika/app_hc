<?php
require '../../../app/config/koneksi.php'; // Pastikan ini mengarah ke koneksi database kamu


header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=data_karyawan.csv');

// Ambil filter dari GET
$filter_section = isset($_GET['filter_section']) ? $_GET['filter_section'] : '';
$filter_gen     = isset($_GET['filter_gen']) ? $_GET['filter_gen'] : '';
$filter_usia    = isset($_GET['filter_usia']) ? $_GET['filter_usia'] : '';

$query = "SELECT * FROM tb_karyawan WHERE status_resign = 'NO'";
if (!empty($filter_section)) {
    $query .= " AND section = '" . mysqli_real_escape_string($koneksi, $filter_section) . "'";
}
if (!empty($filter_gen)) {
    $query .= " AND gen = '" . mysqli_real_escape_string($koneksi, $filter_gen) . "'";
}
if (!empty($filter_usia)) {
    $filter_usia = mysqli_real_escape_string($koneksi, $filter_usia);
    $query .= " AND usia LIKE '{$filter_usia} TAHUN%'";
}

$query .= " ORDER BY id_karyawan DESC";

$result = mysqli_query($koneksi, $query);

// Siapkan output ke CSV
$output = fopen('php://output', 'w');

// Tulis header kolom CSV
fputcsv($output, [
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
    'PENDIDIKAN TERAKHIR',
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
    'VISION & STRATEGY',
    'TRAINING SCO',
    'TRAINING SALES',
    'JSC PROGRAM',
    'ID CARD',
    'SERAGAM'
]);

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, [
        $no++,
        $row['kategori'],
        $row['branch'],
        $row['kcu_agen'],
        $row['nik_jne'],
        $row['nik_vendor'],
        $row['nama_karyawan'],
        $row['vendor'],
        $row['phone'],
        $row['id_finger'],
        $row['join_date'],
        $row['masa_kerja'],
        $row['status_karyawan'],
        $row['jabatan'],
        $row['posisi'],
        $row['unit'],
        $row['section'],
        $row['birth_date'],
        $row['usia'],
        $row['gen'],
        $row['gender'],
        $row['lokasi_kerja'],
        $row['pendidikan_terakhir'],
        $row['jurusan'],
        $row['alamat'],
        $row['kecamatan'],
        $row['bpjs_kesehatan'],
        $row['bpjs_ketenagakerjaan'],
        $row['perusahaan_mitra'],
        $row['status_pekerjaan'],
        $row['status_pernikahan'],
        $row['ket_induction'],
        $row['service_byheart'],
        $row['code_ofconduct'],
        $row['visimisi_oflife'],
        $row['training_sco'],
        $row['training_sales'],
        $row['kurir_program'],
        $row['id_card'],
        $row['seragam']
    ]);
}

fclose($output);
exit;
