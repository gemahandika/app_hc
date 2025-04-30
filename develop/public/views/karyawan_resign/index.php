<?php
session_name("hc_session");
session_start();
include '../../header.php';
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data Karyawan Resign</h3>
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-danger text-white">
                            <th style="font-size: 0.75rem;">NO</th>
                            <th style="font-size: 0.75rem;">KATEGORI</th>
                            <th style="font-size: 0.75rem;">BRANCH</th>
                            <th style="font-size: 0.75rem;">KCU / AGEN</th>
                            <th style="font-size: 0.75rem;">NIK JNE</th>
                            <th style="font-size: 0.75rem;">NIK VENDOR</th>
                            <th style="font-size: 0.75rem;">NAMA KARYAWAN</th>
                            <th style="font-size: 0.75rem;">VENDOR</th>
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
                            <th style="font-size: 0.75rem;">STATUS RESIGN</th>
                            <th style="font-size: 0.75rem;">TGL RESIGN</th>
                            <th style="font-size: 0.75rem;">KET RESIGN</th>
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
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE status_resign = 'YES' ORDER BY id_karyawan ASC") or die(mysqli_error($koneksi));
                    $result = array();
                    while ($data = mysqli_fetch_array($sql)) {
                        $result[] = $data;
                    }
                    foreach ($result as $data) {
                        $no++;
                    ?>
                        <tr>
                            <th class="kecil-normal"><?= $no ?></th>
                            <th class="kecil-normal"><?= $data['kategori'] ?></th>
                            <th class="kecil-normal"><?= $data['branch'] ?></th>
                            <th class="kecil-normal"><?= $data['kcu_agen'] ?></th>
                            <th class="kecil-normal"><?= $data['nik_jne'] ?></th>
                            <th class="kecil-normal"><?= $data['nik_vendor'] ?></th>
                            <th class="kecil-normal"><?= $data['nama_karyawan'] ?></th>
                            <th class="kecil-normal"><?= $data['vendor'] ?></th>
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
                            <th class="kecil-normal"><?= $data['status_resign'] ?></th>
                            <th class="kecil-normal"><?= $data['tgl_resign'] ?></th>
                            <th class="kecil-normal"><?= $data['ket_resign'] ?></th>
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
            </div>
        </div>
    </div>
</main>

<?php
include '../../footer.php';
?>