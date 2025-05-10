<?php
session_name("hc_session");
session_start();
include '../../header.php';

include 'modal_date.php';
include 'add_modal.php';
// Ambil opsi unik dari database
$sectionOptions = mysqli_query($koneksi, "SELECT DISTINCT section FROM tb_karyawan WHERE status_resign = 'NO' AND section IS NOT NULL AND section != '' ORDER BY section");
$genOptions     = mysqli_query($koneksi, "SELECT DISTINCT gen FROM tb_karyawan WHERE status_resign = 'NO' AND gen IS NOT NULL AND gen != '' ORDER BY gen");
$usiaOptions    = mysqli_query($koneksi, "SELECT DISTINCT usia FROM tb_karyawan WHERE status_resign = 'NO' AND usia IS NOT NULL AND usia != '' ORDER BY usia");


?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4" style="border-bottom: 1px solid black;">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                    + Tambah Karyawan
                </button>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg1">
                        Syncrone Data
                    </button>
                    <a href="export_karyawan_filter.php?filter_section=<?= $_GET['filter_section'] ?? '' ?>&filter_gen=<?= $_GET['filter_gen'] ?? '' ?>&filter_usia=<?= $_GET['filter_usia'] ?? '' ?>" class="btn btn-success btn-sm">Download Data</a>
                    <a href="bulk_insert_karyawan.php" class="btn btn-warning btn-sm text-primary"> Upload Data</a>
                    <?php if (in_array("super_admin", $_SESSION['admin_akses'])) { ?>
                        <a href="bulk_update_karyawan.php" class="btn btn-primary btn-sm text-white">Update Data</a>
                    <?php } ?>
                </div>
            </div>

            <form method="GET" action="" class="row card-header g-3 mb-2 gap-2">
                <div class="col-md-3">
                    <label for="filter_section" class="form-label">Filter Section</label>
                    <select class="form-select select2" id="filter_section" name="filter_section">
                        <option value="">-- Pilih Data --</option>
                        <?php while ($row = mysqli_fetch_assoc($sectionOptions)) : ?>
                            <option value="<?= $row['section'] ?>" <?= (isset($_GET['filter_section']) && $_GET['filter_section'] == $row['section']) ? 'selected' : '' ?>>
                                <?= $row['section'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>

                </div>

                <div class="col-md-3">
                    <label for="filter_gen" class="form-label">Filter Gen</label>
                    <select class="form-select select2" id="filter_gen" name="filter_gen">
                        <option value="">-- Pilih Data --</option>
                        <?php while ($row = mysqli_fetch_assoc($genOptions)) : ?>
                            <option value="<?= $row['gen'] ?>" <?= (isset($_GET['filter_gen']) && $_GET['filter_gen'] == $row['gen']) ? 'selected' : '' ?>>
                                <?= $row['gen'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filter_usia" class="form-label">Filter Usia</label>
                    <select class="form-select select2" id="filter_usia" name="filter_usia">
                        <option value="">-- Pilih Data --</option>
                        <?php
                        // Ambil ulang pointer data jika sudah dibaca sebelumnya
                        mysqli_data_seek($usiaOptions, 0);

                        $tahun_unik = [];

                        while ($row = mysqli_fetch_assoc($usiaOptions)) {
                            // Contoh isi $row['usia'] = "18 TAHUN 11 BULAN"
                            if (preg_match('/^(\d+)\s*TAHUN/', strtoupper($row['usia']), $matches)) {
                                $tahun = $matches[1];
                                if (!in_array($tahun, $tahun_unik)) {
                                    $tahun_unik[] = $tahun;
                                    $selected = (isset($_GET['filter_usia']) && $_GET['filter_usia'] == $tahun) ? 'selected' : '';
                                    echo "<option value=\"$tahun\" $selected>$tahun TAHUN</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>



                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>


            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-success text-white">
                            <th style="font-size: 0.75rem;">ACTION</th>
                            <th style="font-size: 0.75rem;">NO</th>
                            <th style="font-size: 0.75rem;">KATEGORI</th>
                            <th style="font-size: 0.75rem;">BRANCH</th>
                            <th style="font-size: 0.75rem;">KCU / AGEN</th>
                            <th style="font-size: 0.75rem;">NIK JNE</th>
                            <th style="font-size: 0.75rem;">NIK VENDOR</th>
                            <th style="font-size: 0.75rem;">NAMA KARYAWAN</th>
                            <th style="font-size: 0.75rem;">VENDOR</th>
                            <th style="font-size: 0.75rem;">HANDPHONE</th>
                            <th style="font-size: 0.75rem;">ID FINGER</th>
                            <th style="font-size: 0.75rem;">JOINDATE</th>
                            <th style="font-size: 0.75rem;">MASA KERJA</th>
                            <th style="font-size: 0.75rem;">STATUS KARYAWAN</th>
                            <th style="font-size: 0.75rem;">JABATAN</th>
                            <th style="font-size: 0.75rem;">POSISI</th>
                            <th style="font-size: 0.75rem;">UNIT</th>
                            <th style="font-size: 0.75rem;">SECTION</th>
                            <th style="font-size: 0.75rem;">BIRTHDATE</th>
                            <th style="font-size: 0.75rem;">USIA</th>
                            <th style="font-size: 0.75rem;">GEN</th>
                            <th style="font-size: 0.75rem;">GENDER</th>
                            <th style="font-size: 0.75rem;">LOKASI KERJA</th>
                            <th style="font-size: 0.75rem;">LEVEL PENDIDIKAN TERAKHIR</th>
                            <th style="font-size: 0.75rem;">JURUSAN</th>
                            <th style="font-size: 0.75rem;">ALAMAT</th>
                            <th style="font-size: 0.75rem;">KECAMATAN</th>
                            <th style="font-size: 0.75rem;">BPJS KESEHATAN</th>
                            <th style="font-size: 0.75rem;">BPJS KETENAGAKERJAAN</th>
                            <th style="font-size: 0.75rem;">NAMA CV/PERUSAHAAN MITRA</th>
                            <th style="font-size: 0.75rem;">STATUS PEKERJAAN</th>
                            <th style="font-size: 0.75rem;">STATUS PERNIKAHAN</th>
                            <th style="font-size: 0.75rem;">KET INDUCTION</th>
                            <th style="font-size: 0.75rem;">SERVICE BY HEART</th>
                            <th style="font-size: 0.75rem;">CODE OF CONDUCT</th>
                            <th style="font-size: 0.75rem;">CREAT VISION, MISSION,TARGET & STRATGY OF LIFE</th>
                            <th style="font-size: 0.75rem;">TRAINING PROFESI SCO</th>
                            <th style="font-size: 0.75rem;">TRAINING PROFESI SALES</th>
                            <th style="font-size: 0.75rem;">JSC (KURIR DEV PROGRAM)</th>
                            <th style="font-size: 0.75rem;">ID CARD</th>
                            <th style="font-size: 0.75rem;">SERAGAM</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $filter_section = isset($_GET['filter_section']) ? $_GET['filter_section'] : '';
                    $filter_gen     = isset($_GET['filter_gen']) ? $_GET['filter_gen'] : '';
                    $filter_usia    = isset($_GET['filter_usia']) ? $_GET['filter_usia'] : '';

                    $query = "SELECT * FROM tb_karyawan WHERE status_resign = 'NO'";

                    // Tambahkan filter jika diisi
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

                    $sql = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
                    $result = array();
                    while ($data = mysqli_fetch_array($sql)) {
                        $result[] = $data;
                    }
                    foreach ($result as $data) {
                        $no++;
                    ?>
                        <tr>
                            <th class="d-flex p-2">
                                <button
                                    type="button"
                                    class="btn btn-success btn-sm me-2 text-white openModalButton"
                                    data-id_karyawan="<?= $data['id_karyawan']; ?>"
                                    data-mode="edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm openModalButton"
                                    data-id_karyawan="<?= $data['id_karyawan']; ?>"
                                    data-mode="resign"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Resign
                                </button>
                            </th>
                            <th class="kecil-normal"><?= $no ?></th>
                            <th class="kecil-normal"><?= $data['kategori'] ?></th>
                            <th class="kecil-normal"><?= $data['branch'] ?></th>
                            <th class="kecil-normal"><?= $data['kcu_agen'] ?></th>
                            <th class="kecil-normal"><?= $data['nik_jne'] ?></th>
                            <th class="kecil-normal"><?= $data['nik_vendor'] ?></th>
                            <th class="kecil-normal"><?= $data['nama_karyawan'] ?></th>
                            <th class="kecil-normal"><?= $data['vendor'] ?></th>
                            <th class="kecil-normal"><?= $data['phone'] ?></th>
                            <th class="kecil-normal"><?= $data['id_finger'] ?></th>
                            <th class="kecil-normal"><?= $data['join_date'] ?></th>
                            <th class="kecil-normal"><?= $data['masa_kerja'] ?></th>
                            <th class="kecil-normal"><?= $data['status_karyawan'] ?></th>
                            <th class="kecil-normal"><?= $data['jabatan'] ?></th>
                            <th class="kecil-normal"><?= $data['posisi'] ?></th>
                            <th class="kecil-normal"><?= $data['unit'] ?></th>
                            <th class="kecil-normal"><?= $data['section'] ?></th>
                            <th class="kecil-normal"><?= $data['birth_date'] ?></th>
                            <th class="kecil-normal"><?= $data['usia'] ?></th>
                            <th class="kecil-normal"><?= $data['gen'] ?></th>
                            <th class="kecil-normal"><?= $data['gender'] ?></th>
                            <th class="kecil-normal"><?= $data['lokasi_kerja'] ?></th>
                            <th class="kecil-normal"><?= $data['pendidikan_terakhir'] ?></th>
                            <th class="kecil-normal"><?= $data['jurusan'] ?></th>
                            <th class="kecil-normal"><?= $data['alamat'] ?></th>
                            <th class="kecil-normal"><?= $data['kecamatan'] ?></th>
                            <th class="kecil-normal"><?= $data['bpjs_kesehatan'] ?></th>
                            <th class="kecil-normal"><?= $data['bpjs_ketenagakerjaan'] ?></th>
                            <th class="kecil-normal"><?= $data['perusahaan_mitra'] ?></th>
                            <th class="kecil-normal"><?= $data['status_pekerjaan'] ?></th>
                            <th class="kecil-normal"><?= $data['status_pernikahan'] ?></th>
                            <th class="kecil-normal"><?= $data['ket_induction'] ?></th>
                            <th class="kecil-normal"><?= $data['service_byheart'] ?></th>
                            <th class="kecil-normal"><?= $data['code_ofconduct'] ?></th>
                            <th class="kecil-normal"><?= $data['visimisi_oflife'] ?></th>
                            <th class="kecil-normal"><?= $data['training_sco'] ?></th>
                            <th class="kecil-normal"><?= $data['training_sales'] ?></th>
                            <th class="kecil-normal"><?= $data['kurir_program'] ?></th>
                            <th class="kecil-normal"><?= $data['id_card'] ?></th>
                            <th class="kecil-normal"><?= $data['seragam'] ?></th>
                        </tr>
                    <?php } ?>
                </table>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" role="dialog" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content" id="modalEditContent">
                            <!-- isi form akan di-load lewat Ajax -->
                        </div>
                    </div>
                </div>

                <!-- jQuery harus ada -->


            </div>
        </div>
    </div>
</main>



<?php
include '../../footer.php';
?>