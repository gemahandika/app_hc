<?php
$date = date('Y-m-d');
$time = date("H:i");
?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title" id="modalAparaturLabel">TAMBAH KARYAWAN BARU</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../../../app/controller/Karyawan_controller.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <?php
                    // Ambil data cabang
                    $queryCabang = mysqli_query($koneksi, "SELECT id_cabang, nama_cabang FROM tb_cabang");
                    ?>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <label for="kategori" class="form-label"><b>KATEGORI</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="kategori" name="kategori" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="MES 1">MES 1</option>
                                <option value="MES 2">MES 2</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="branch" class="form-label"><b>BRANCH</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="branch" name="branch" required>
                                <option value="">-- Pilih Cabang --</option>
                                <?php while ($row = mysqli_fetch_assoc($queryCabang)) { ?>
                                    <option value="<?= $row['nama_cabang']; ?>" data-nama="<?= $row['nama_cabang']; ?>">
                                        <?= $row['nama_cabang']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kcu_agen" class="form-label"><b>KCU / AGEN</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="kcu_agen" name="kcu_agen" required>
                                <option value="">-- Pilih kcu / agen --</option>
                                <option value="KCU">KCU</option>
                                <option value="AGEN">AGEN</option>
                                <option value="MITRA">MITRA</option>
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
                            <label for="nama_karyawan" class="form-label"><b>NAMA KARYAWAN</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="vendor" class="form-label"><b>VENDOR</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="vendor" name="vendor" required>
                                <option value="">-- Pilih Vendor --</option>
                                <option value="JNE">JNE</option>
                                <option value="SOS">SOS</option>
                                <option value="PKSS">PKSS</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="phone" class="form-label"><b>NO. HANDPHONE</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="id_finger" class="form-label"><b>ID FINGER</b></label>
                            <input type="text" class="form-control" id="id_finger" name="id_finger">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="join_date" class="form-label"><b>JOIN DATE</b> <b class="text-danger">*</b></label>
                            <input type="date" class="form-control" id="join_date" name="join_date" value="<?= $date; ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="masa_kerja" class="form-label"><b>MASA KERJA</b></label>
                            <input type="text" class="form-control bg-secondary text-white" id="masa_kerja" name="masa_kerja" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status_karyawan" class="form-label"><b>STATUS KARYAWAN</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="status_karyawan" name="status_karyawan" required>
                                <option value="">-- Pilih Status Karyawan --</option>
                                <option value="PKWTT">PKWTT</option>
                                <option value="PKWT">PKWT</option>
                                <option value="OUTSOURCING">OUTSOURCING</option>
                                <option value="CROWDSOURCING">CROWDSOURCING</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jabatan" class="form-label"><b>JABATAN</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="jabatan" name="jabatan" required>
                                <option value="">-- Pilih Jabatan --</option>
                                <option value="STAFF">STAFF</option>
                                <option value="PIC">PIC</option>
                                <option value="LEADER">LEADER</option>
                                <option value="HEAD UNIT">HEAD UNIT</option>
                                <option value="SEACTION HEAD">SEACTION HEAD</option>
                                <option value="SR. HEAD UNIT">SR. HEAD UNIT</option>
                                <option value="MANAGER">MANAGER</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="posisi" class="form-label"><b>POSISI</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="posisi" name="posisi" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="unit" class="form-label"><b>UNIT</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="unit" name="unit" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="section" class="form-label"><b>SECTION</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="section" name="section" required>
                                <option value="">-- Pilih section --</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="birth_date" class="form-label"><b>BIRTH DATE</b> <b class="text-danger">*</b></label>
                            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="usia" class="form-label"><b>USIA</b></label>
                            <input type="text" class="form-control  bg-secondary text-white" id="usia" name="usia" readonly>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gen" class="form-label"><b>GEN</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="gen" name="gen" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="gender" class="form-label"><b>GENDER</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="gender" name="gender" required>
                                <option value="">-- Pilih Gender --</option>
                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                <option value="PEREMPUAN">PEREMPUAN</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="lokasi_kerja" class="form-label"><b>LOKASI KERJA</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="lokasi_kerja" name="lokasi_kerja" required>
                                <option value="">-- Pilih Lokasi Kerja --</option>
                                <option value="LAINNYA">LAINNYA</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="pendidikan_terakhir" class="form-label"><b>PENDIDIKAN TERAKHIR</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                                <option value="">-- Pilih Pendidikan --</option>
                                <option value="SMA">SMA</option>
                                <option value="D3">D1</option>
                                <option value="D3">D3</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="jurusan" class="form-label"><b>JURUSAN</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="jurusan" name="jurusan" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="alamat" class="form-label"><b>ALAMAT</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="alamat" name="alamat" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="kecamatan" class="form-label"><b>KECAMATAN</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
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
                            <label for="status_pekerjaan" class="form-label"><b>STATUS PEKERJAAN</b> <b class="text-danger">*</b></label>
                            <input type="text" class="form-control" id="status_pekerjaan" name="status_pekerjaan" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="status_pernikahan" class="form-label"><b>STATUS PERNIKAHAN</b> <b class="text-danger">*</b></label>
                            <select class="form-select form-control" id="status_pernikahan" name="status_pernikahan" required>
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

                        <div class="col-md-12 mb-3">
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

                        <input type="hidden" name="status_resign" value="NO">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="add_karyawan">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('kategori').addEventListener('change', function() {
        const kategori = this.value;
        const branchSelect = document.getElementById('branch');
        const options = branchSelect.querySelectorAll('option');

        options.forEach(option => {
            const namaCabang = option.getAttribute('data-nama');
            if (option.value === "") {
                option.style.display = 'block'; // selalu tampilkan placeholder
            } else if (kategori === 'MES 1') {
                option.style.display = (namaCabang === 'KCU MEDAN') ? 'block' : 'none';
            } else if (kategori === 'MES 2') {
                option.style.display = (namaCabang !== 'KCU MEDAN') ? 'block' : 'none';
            } else {
                option.style.display = 'none';
            }
        });

        branchSelect.value = ""; // reset pilihan setiap kali kategori berubah
    });
</script>

<script>
    function hitungSelisihTanggal(tanggalAwalStr) {
        const tanggalAwal = new Date(tanggalAwalStr);
        const today = new Date();

        let years = today.getFullYear() - tanggalAwal.getFullYear();
        let months = today.getMonth() - tanggalAwal.getMonth();
        let days = today.getDate() - tanggalAwal.getDate();

        if (days < 0) months--;
        if (months < 0) {
            years--;
            months += 12;
        }

        return `${years} TAHUN ${months} BULAN`;
    }

    function updateSelisihTanggal(inputId, outputId) {
        const input = document.getElementById(inputId);
        const output = document.getElementById(outputId);

        function update() {
            output.value = input.value ? hitungSelisihTanggal(input.value) : "";
        }

        input.addEventListener("change", update);
        window.addEventListener("load", update);
    }

    // Terapkan ke join_date → masa_kerja dan birth_date → usia
    updateSelisihTanggal("join_date", "masa_kerja");
    updateSelisihTanggal("birth_date", "usia");
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>