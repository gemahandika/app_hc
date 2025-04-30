<?php
session_name("hc_session");
session_start();
if (!in_array("super_admin", $_SESSION['admin_akses'])) {
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
    foreach ($rows as $row) {
        if ($isHeader) {
            $isHeader = false;
            continue;
        }

        $id     = intval($row[0]);
        $status_resign = $koneksi->real_escape_string($row[1]);


        $sql = "UPDATE tb_karyawan SET status_resign='$status_resign' WHERE id_karyawan=$id";
        $koneksi->query($sql);
    }

    echo "Data berhasil diupdate dari Excel!";
}
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-body">

                <h2>Upload Excel (.xlsx) untuk Update Data</h2>
                <form method="POST" enctype="multipart/form-data">
                    <input type="file" name="excel_file" accept=".xlsx" required>
                    <button type="submit" name="submit">Upload dan Update</button>
                </form>

            </div>
        </div>
    </div>
</main>

<?php
include '../../footer.php';
?>