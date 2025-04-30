<?php
include '../../../app/config/koneksi.php'; // koneksi database

if (isset($_GET['id_karyawan']) && isset($_GET['mode'])) {
    $id_karyawan = $_GET['id_karyawan'];
    $mode = $_GET['mode'];

    $query = mysqli_query($koneksi, "SELECT * FROM tb_karyawan WHERE id_karyawan = '$id_karyawan'");
    $data = mysqli_fetch_assoc($query);

    if ($mode == "edit") {
?>
        <div class="modal-header bg-success text-white">
            <h6 class="modal-title" id="editModalLabel">Edit Data Karyawan</h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="../../../app/controller/Karyawan_controller.php">
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">

                <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="kategori" class="form-label"><b>KATEGORI</b></label>
                        <select class="form-select form-control" id="kategori" name="kategori">
                            <option value="<?= $data['kategori']; ?>"><?= $data['kategori']; ?></option>
                            <option value="MES 1">MES 1</option>
                            <option value="MES 2">MES 2</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="branch" class="form-label"><b>BRANCH</b></label>
                        <select class="form-select form-control" id="branch" name="branch">
                            <option value="">-- Pilih Cabang --</option>
                            <?php
                            $queryCabang = mysqli_query($koneksi, "SELECT id_cabang, nama_cabang FROM tb_cabang");
                            while ($row = mysqli_fetch_assoc($queryCabang)) { ?>
                                <option value="<?= $row['nama_cabang']; ?>" data-nama="<?= $row['nama_cabang']; ?>">
                                    <?= $row['nama_cabang']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kcu_agen" class="form-label"><b>KCU / AGEN</b></label>
                        <select class="form-select form-control" id="kcu_agen" name="kcu_agen">
                            <option value="">-- Pilih kcu / agen --</option>
                            <option value="KCU">KCU</option>
                            <option value="AGEN">AGEN</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="nik_jne" class="form-label"><b>NIK JNE</b></label>
                        <input type="text" class="form-control" id="nik_jne" name="nik_jne">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="nik_vendor" class="form-label"><b>NIK VENDOR</b></label>
                        <input type="text" class="form-control" id="nik_vendor" name="nik_vendor">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="nama_karyawan" class="form-label"><b>NAMA KARYAWAN</b></label>
                        <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="vendor" class="form-label"><b>VENDOR</b></label>
                        <select class="form-select form-control" id="vendor" name="vendor">
                            <option value="">-- Pilih Vendor --</option>
                            <option value="JNE">JNE</option>
                            <option value="SOS">SOS</option>
                            <option value="PKSS">PKSS</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="id_finger" class="form-label"><b>ID FINGER</b></label>
                        <input type="text" class="form-control" id="id_finger" name="id_finger">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="join_date" class="form-label"><b>JOIN DATE</b></label>
                        <input type="date" class="form-control" id="join_date" name="join_date" value="<?= $date; ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="masa_kerja" class="form-label"><b>MASA KERJA</b></label>
                        <input type="text" class="form-control" id="masa_kerja" name="masa_kerja">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status_karyawan" class="form-label"><b>STATUS KARYAWAN</b></label>
                        <select class="form-select form-control" id="status_karyawan" name="status_karyawan">
                            <option value="">-- Pilih Status Karyawan --</option>
                            <option value="PKWTT">PKWTT</option>
                            <option value="PKWT">PKWT</option>
                            <option value="OUTSOURCING">OUTSOURCING</option>
                            <option value="CROWDSOURCING">CROWDSOURCING</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="jabatan" class="form-label"><b>JABATAN</b></label>
                        <input type="text" class="form-control" id="jabatan" name="jabatan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="posisi" class="form-label"><b>POSISI</b></label>
                        <input type="text" class="form-control" id="posisi" name="posisi">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="unit" class="form-label"><b>UNIT</b></label>
                        <input type="text" class="form-control" id="unit" name="unit">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="birth_date" class="form-label"><b>BIRTH DATE</b></label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="usia" class="form-label"><b>USIA</b></label>
                        <input type="text" class="form-control" id="usia" name="usia">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gen" class="form-label"><b>GEN</b></label>
                        <input type="text" class="form-control" id="gen" name="gen">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="gender" class="form-label"><b>GENDER</b></label>
                        <select class="form-select form-control" id="gender" name="gender">
                            <option value="">-- Pilih Gender --</option>
                            <option value="LAKI-LAKI">LAKI-LAKI</option>
                            <option value="PEREMPUAN">PEREMPUAN</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="lokasi_kerja" class="form-label"><b>LOKASI KERJA</b></label>
                        <input type="text" class="form-control" id="lokasi_kerja" name="lokasi_kerja">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="pendidikan_terakhir" class="form-label"><b>PENDIDIKAN TERAKHIR</b></label>
                        <select class="form-select form-control" id="pendidikan_terakhir" name="pendidikan_terakhir">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="SMA">SMA</option>
                            <option value="D3">D3</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="jurusan" class="form-label"><b>JURUSAN</b></label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="alamat" class="form-label"><b>ALAMAT</b></label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kecamatan" class="form-label"><b>KECAMATAN</b></label>
                        <input type="text" class="form-control" id="kecamatan" name="kecamatan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bpjs_kesehatan" class="form-label"><b>BPJS KESEHATAN</b></label>
                        <input type="text" class="form-control" id="bpjs_kesehatan" name="bpjs_kesehatan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="bpjs_ketenagakerjaan" class="form-label"><b>BPJS KETENAGAKERJAAN</b></label>
                        <input type="text" class="form-control" id="bpjs_ketenagakerjaan" name="bpjs_ketenagakerjaan">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="perusahaan_mitra" class="form-label"><b>NAMA CV/PERUSAHAAN MITRA</b></label>
                        <input type="text" class="form-control" id="perusahaan_mitra" name="perusahaan_mitra">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status_pekerjaan" class="form-label"><b>STATUS PEKERJAAN</b></label>
                        <input type="text" class="form-control" id="status_pekerjaan" name="status_pekerjaan">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="status_pernikahan" class="form-label"><b>STATUS PERNIKAHAN</b></label>
                        <select class="form-select form-control" id="status_pernikahan" name="status_pernikahan">
                            <option value="">-- Pilih Pendidikan --</option>
                            <option value="MENIKAH">MENIKAH</option>
                            <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                        </select>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="ket_induction" class="form-label"><b>KET INDUCTION</b></label>
                        <input type="text" class="form-control" id="ket_induction" name="ket_induction">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="service_byheart" class="form-label"><b>SERVICE BY HEART</b></label>
                        <input type="text" class="form-control" id="service_byheart" name="service_byheart">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="code_ofconduct" class="form-label"><b>CODE OF CONDUCT</b></label>
                        <input type="text" class="form-control" id="code_ofconduct" name="code_ofconduct">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="training_sales" class="form-label"><b>TRAINING PROFESI SALES</b></label>
                        <input type="text" class="form-control" id="training_sales" name="training_sales">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="training_sco" class="form-label"><b>TRAINING PROFESI SCO</b></label>
                        <input type="text" class="form-control" id="training_sco" name="training_sco">
                    </div>

                    <div class="col-md-8 mb-3">
                        <label for="visimisi_oflife" class="form-label"><b>CREAT VISION, MISSION,TARGET & STRATGY OF LIFE</b></label>
                        <input type="text" class="form-control" id="visimisi_oflife" name="visimisi_oflife">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="kurir_program" class="form-label"><b>JSC (KURIR DEV PROGRAM)</b></label>
                        <input type="text" class="form-control" id="kurir_program" name="kurir_program">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="id_card" class="form-label"><b>ID CARD</b></label>
                        <input type="text" class="form-control" id="id_card" name="id_card">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="seragam" class="form-label"><b>SERAGAM</b></label>
                        <input type="text" class="form-control" id="seragam" name="seragam">
                    </div>
                </div>
            </div>
            <!-- Tambahkan field edit lainnya -->
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success" name="edit_karyawan">Simpan</button>
            </div>

        </form>
    <?php
    } elseif ($mode == "resign") {
    ?>
        <div class="modal-header bg-danger text-white">
            <h6 class="modal-title" id="editModalLabel">Form Resign Karyawan </h6>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <form method="POST" action="../../../app/controller/Karyawan_controller.php">
                <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">
                <div class="mb-3">
                    <h6><?= $data['nama_karyawan'] ?></h6>
                </div>
                <div class="mb-3">
                    <label for="tgl_resign" class="form-label">Tanggal Resign</label>
                    <input type="date" class="form-control" name="tgl_resign" id="tgl_resign" value="<?= date('Y-m-d'); ?>">
                </div>
                <div class="mb-3">
                    <label for="ket_resign" class="form-label">Keterangan Resign</label>
                    <textarea class="form-control" name="ket_resign" id="ket_resign"></textarea>
                </div>
                <input type="hidden" name="status_resign" value="YES">
                <button type="submit" class="btn btn-danger" name="resign_karyawan">Submit Resign</button>
            </form>
        </div>
<?php
    } else {
        echo "Mode tidak dikenali.";
    }
} else {
    echo "Data tidak lengkap.";
}
?>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>