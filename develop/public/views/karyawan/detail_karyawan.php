<?php
session_name("hc_session");
session_start();
include '../../header.php';


// Ambil parameter
$start_date = mysqli_real_escape_string($koneksi, $_GET['start_date'] ?? '');
$end_date = mysqli_real_escape_string($koneksi, $_GET['end_date'] ?? '');
$branch = mysqli_real_escape_string($koneksi, $_GET['branch'] ?? '');
$type = mysqli_real_escape_string($koneksi, $_GET['type'] ?? '');
$resign = mysqli_real_escape_string($koneksi, $_GET['resign'] ?? '');


$title = ($type === 'kcu') ? "Detail Karyawan KCU" : "Detail Total Karyawan";

// Bangun query dinamis
$where = "status_resign = 'NO'";

if (!empty($start_date) && !empty($end_date)) {
    $where .= " AND join_date BETWEEN '$start_date' AND '$end_date'";
}

if (!empty($branch)) {
    $where .= " AND branch = '$branch'";
}

if ($type === 'kcu') {
    $where .= " AND kcu_agen = '$type'";
}

if ($type === 'agen') {
    $where .= " AND kcu_agen = '$type'";
}

if ($type === 'mitra') {
    $where .= " AND kcu_agen = '$type'";
}

if ($resign === 'YES') {
    $where .= " AND status_resign = '$resign'";
}
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between">
                <h6><span>TANGGAL : </span><?= $start_date ?> - <?= $end_date ?> / BRANCH : <?= $branch ?></h6>
            </div>
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
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE  $where ORDER BY id_karyawan ASC") or die(mysqli_error($koneksi));
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
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                    $(document).on('click', '.openModalButton', function() {
                        var id_karyawan = $(this).data('id_karyawan');
                        var mode = $(this).data('mode');

                        console.log("ID:", id_karyawan, "Mode:", mode); // cek di console

                        $.ajax({
                            url: 'edit_modal.php',
                            type: 'GET',
                            data: {
                                id_karyawan: id_karyawan,
                                mode: mode
                            },
                            success: function(response) {
                                $('#modalEditContent').html(response);
                            },
                            error: function(xhr, status, error) {
                                console.log("AJAX Error: " + xhr.responseText);
                            }
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</main>

<?php
include '../../footer.php';
?>