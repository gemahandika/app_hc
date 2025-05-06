<?php
session_name("hc_session");
session_start();
if (!in_array("admin", $_SESSION['admin_akses']) && !in_array("super_admin", $_SESSION['admin_akses'])) {
    echo "Ooopss!! Kamu Tidak Punya Akses";
    exit();
}
include '../../header.php';
require '../../../../vendor/autoload.php';
require '../../../app/config/koneksi.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if (isset($_POST['submit'])) {
    $file = $_FILES['excel_file']['tmp_name'];

    $spreadsheet = IOFactory::load($file);
    $sheet = $spreadsheet->getActiveSheet();
    $rows = $sheet->toArray();

    $isHeader = true;
    $inserted = 0;
    foreach ($rows as $row) {
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        $kategori = $koneksi->real_escape_string($row[1]);
        $branch = $koneksi->real_escape_string($row[2]);
        $kcu_agen = $koneksi->real_escape_string($row[3]);
        $nik_jne = $koneksi->real_escape_string($row[4]);
        $nik_vendor = $koneksi->real_escape_string($row[5]);
        $nama_karyawan = $koneksi->real_escape_string($row[6]);
        $vendor = $koneksi->real_escape_string($row[7]);
        $phone = $koneksi->real_escape_string($row[8]);
        $id_finger = $koneksi->real_escape_string($row[9]);
        $join_date = $koneksi->real_escape_string($row[10]);
        $status_karyawan = $koneksi->real_escape_string($row[11]);
        $jabatan  = $koneksi->real_escape_string($row[12]);
        $posisi = $koneksi->real_escape_string($row[13]);
        $unit = $koneksi->real_escape_string($row[14]);
        $section  = $koneksi->real_escape_string($row[15]);
        $birth_date = $koneksi->real_escape_string($row[16]);
        $gen = $koneksi->real_escape_string($row[17]);
        $gender  = $koneksi->real_escape_string($row[18]);
        $lokasi_kerja = $koneksi->real_escape_string($row[19]);
        $pendidikan_terakhir = $koneksi->real_escape_string($row[20]);
        $jurusan  = $koneksi->real_escape_string($row[21]);
        $alamat = $koneksi->real_escape_string($row[22]);
        $kecamatan = $koneksi->real_escape_string($row[23]);
        $bpjs_kesehatan  = $koneksi->real_escape_string($row[24]);
        $bpjs_ketenagakerjaan  = $koneksi->real_escape_string($row[25]);
        $perusahaan_mitra = $koneksi->real_escape_string($row[26]);
        $status_pekerjaan = $koneksi->real_escape_string($row[27]);
        $status_pernikahan  = $koneksi->real_escape_string($row[28]);
        $ket_induction = $koneksi->real_escape_string($row[29]);
        $service_byheart = $koneksi->real_escape_string($row[30]);
        $code_ofconduct  = $koneksi->real_escape_string($row[31]);
        $visimisi_oflife = $koneksi->real_escape_string($row[32]);
        $training_sco = $koneksi->real_escape_string($row[33]);
        $training_sales  = $koneksi->real_escape_string($row[34]);
        $kurir_program = $koneksi->real_escape_string($row[35]);
        $id_card = $koneksi->real_escape_string($row[36]);
        $seragam  = $koneksi->real_escape_string($row[37]);
        $status_resign  = $koneksi->real_escape_string($row[38]);

        $sql = "INSERT INTO tb_karyawan (kategori, branch, kcu_agen, nik_jne, nik_vendor, nama_karyawan, vendor, phone, id_finger, join_date,
        status_karyawan, jabatan, posisi, unit, section, birth_date, gen, gender, lokasi_kerja, pendidikan_terakhir, jurusan, alamat, kecamatan,
        bpjs_kesehatan, bpjs_ketenagakerjaan, perusahaan_mitra, status_pekerjaan, status_pernikahan, ket_induction, service_byheart, code_ofconduct,
        visimisi_oflife, training_sco, training_sales, kurir_program, id_card, seragam, status_resign)
                VALUES ('$kategori', '$branch', '$kcu_agen', '$nik_jne', '$nik_vendor', '$nama_karyawan', '$vendor', '$phone', '$id_finger', '$join_date',
                '$status_karyawan', '$jabatan', '$posisi', '$unit', '$section', '$birth_date', '$gen', '$gender', '$lokasi_kerja', '$pendidikan_terakhir',
                '$jurusan', '$alamat', '$kecamatan', '$bpjs_kesehatan', '$bpjs_ketenagakerjaan', '$perusahaan_mitra', '$status_pekerjaan', '$status_pernikahan',
                '$ket_induction', '$service_byheart', '$code_ofconduct', '$visimisi_oflife', '$training_sco', '$training_sales', '$kurir_program', '$id_card',
                '$seragam', '$status_resign')";

        if ($koneksi->query($sql)) {
            $inserted++;
        }
    }

    echo "Berhasil insert $inserted data dari Excel!";
}
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-body">

                <h2>Upload Excel (.xlsx) untuk Insert Data</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="excel_file" accept=".xlsx" required>
                    <button type="submit" name="submit">Upload dan Insert</button>
                </form>

            </div>
        </div>
    </div>
</main>

<?php
include '../../footer.php';
?>