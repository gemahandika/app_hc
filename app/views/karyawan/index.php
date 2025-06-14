<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4" style="border-bottom: 1px solid black;">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                    <i class="fa fa-plus"></i> Tambah Karyawan
                </button>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg1">
                        Syncrone Data
                    </button>
                    <a href="export_karyawan_filter.php?filter_section=<?= $_GET['filter_section'] ?? '' ?>&filter_gen=<?= $_GET['filter_gen'] ?? '' ?>&filter_usia=<?= $_GET['filter_usia'] ?? '' ?>" class="btn btn-success btn-sm">Download Data</a>
                    <a href="bulk_insert_karyawan.php" class="btn btn-success btn-sm "> Upload Data</a>
                    <a href="bulk_update_karyawan.php" class="btn btn-success btn-sm ">Update Data</a>
                </div>
            </div>

            <form method="GET" action="" class="row card-header g-3 mb-2 gap-2">
                <div class="col-md-3">
                    <label for="filter_section" class="form-label">Filter Section</label>
                    <select class="form-select select2" id="filter_section" name="filter_section">
                        <option value="">-- Pilih Data --</option>
                        <?php foreach ($data['section'] as $row): ?>
                            <option value="<?= $row['nama_section']; ?>"><?= $row['nama_section']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filter_usia" class="form-label">Filter GEN</label>
                    <select class="form-select select2" id="filter_usia" name="filter_usia">
                        <option value="">-- Pilih Data --</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label for="filter_usia" class="form-label">Filter Usia</label>
                    <select class="form-select select2" id="filter_usia" name="filter_usia">
                        <option value="">-- Pilih Data --</option>
                    </select>
                </div>

                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="index.php" class="btn btn-secondary">Reset</a>
                </div>
            </form>

            <div class="card-body">
                <table id="example" class="display nowrap" style="width:100%">
                    <thead>
                        <tr class="bg-success text-white">
                            <th class="small text-center">ACTION</th>
                            <th class="small text-center">NO</th>
                            <th class="small text-center">KATEGORI</th>
                            <th class="small text-center">BRANCH</th>
                            <th class="small text-center">KCU / AGEN</th>
                            <th class="small text-center">NIK JNE</th>
                            <th class="small text-center">NIK VENDOR</th>
                            <th class="small text-center">NAMA KARYAWAN</th>
                            <th class="small text-center">VENDOR</th>
                            <th class="small text-center">HANDPHONE</th>
                            <th class="small text-center">ID FINGER</th>
                            <th class="small text-center">JOINDATE</th>
                            <th class="small text-center">MASA KERJA</th>
                            <th class="small text-center">STATUS KARYAWAN</th>
                            <th class="small text-center">JABATAN</th>
                            <th class="small text-center">POSISI</th>
                            <th class="small text-center">UNIT</th>
                            <th class="small text-center">SECTION</th>
                            <th class="small text-center">BIRTHDATE</th>
                            <th class="small text-center">USIA</th>
                            <th class="small text-center">GEN</th>
                            <th class="small text-center">GENDER</th>
                            <th class="small text-center">LOKASI KERJA</th>
                            <th class="small text-center">LEVEL PENDIDIKAN TERAKHIR</th>
                            <th class="small text-center">JURUSAN</th>
                            <th class="small text-center">ALAMAT</th>
                            <th class="small text-center">KECAMATAN</th>
                            <th class="small text-center">BPJS KESEHATAN</th>
                            <th class="small text-center">BPJS KETENAGAKERJAAN</th>
                            <th class="small text-center">NAMA CV/PERUSAHAAN MITRA</th>
                            <th class="small text-center">STATUS PEKERJAAN</th>
                            <th class="small text-center">STATUS PERNIKAHAN</th>
                            <th class="small text-center">KET INDUCTION</th>
                            <th class="small text-center">SERVICE BY HEART</th>
                            <th class="small text-center">CODE OF CONDUCT</th>
                            <th class="small text-center">CREAT VISION, MISSION,TARGET & STRATGY OF LIFE</th>
                            <th class="small text-center">TRAINING PROFESI SCO</th>
                            <th class="small text-center">TRAINING PROFESI SALES</th>
                            <th class="small text-center">JSC (KURIR DEV PROGRAM)</th>
                            <th class="small text-center">ID CARD</th>
                            <th class="small text-center">SERAGAM</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 1;
                    foreach ($data['karyawan'] as $karyawan) :
                    ?>
                        <tr>
                            <td class="d-flex p-2">
                                <button
                                    type="button"
                                    class="btn btn-success btn-sm me-2 text-white openModalButton"
                                    data-id_karyawan="<?= $karyawan['id_karyawan']; ?>"
                                    data-mode="edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-danger btn-sm openModalButton"
                                    data-id_karyawan="<?= $karyawan['id_karyawan']; ?>"
                                    data-mode="resign"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Resign
                                </button>
                            </td>
                            <td class="small text-center"><?= $no ?></td>
                            <td class="small text-center"><?= $karyawan['kategori'] ?></td>
                            <td class="small text-center"><?= $karyawan['branch'] ?></td>
                            <td class="small text-center"><?= $karyawan['kcu_agen'] ?></td>
                            <td class="small text-center"><?= $karyawan['nik_jne'] ?></td>
                            <td class="small text-center"><?= $karyawan['nik_vendor'] ?></td>
                            <td class="small text-center"><?= $karyawan['nama_karyawan'] ?></td>
                            <td class="small text-center"><?= $karyawan['vendor'] ?></td>
                            <td class="small text-center"><?= $karyawan['phone'] ?></td>
                            <td class="small text-center"><?= $karyawan['id_finger'] ?></td>
                            <td class="small text-center"><?= $karyawan['join_date'] ?></td>
                            <td class="small text-center"><?= $karyawan['masa_kerja'] ?></td>
                            <td class="small text-center"><?= $karyawan['status_karyawan'] ?></td>
                            <td class="small text-center"><?= $karyawan['jabatan'] ?></td>
                            <td class="small text-center"><?= $karyawan['posisi'] ?></td>
                            <td class="small text-center"><?= $karyawan['unit'] ?></td>
                            <td class="small text-center"><?= $karyawan['section'] ?></td>
                            <td class="small text-center"><?= $karyawan['birth_date'] ?></td>
                            <td class="small text-center"><?= $karyawan['usia'] ?></td>
                            <td class="small text-center"><?= $karyawan['gen'] ?></td>
                            <td class="small text-center"><?= $karyawan['gender'] ?></td>
                            <td class="small text-center"><?= $karyawan['lokasi_kerja'] ?></td>
                            <td class="small text-center"><?= $karyawan['pendidikan_terakhir'] ?></td>
                            <td class="small text-center"><?= $karyawan['jurusan'] ?></td>
                            <td class="small text-center"><?= $karyawan['alamat'] ?></td>
                            <td class="small text-center"><?= $karyawan['kecamatan'] ?></td>
                            <td class="small text-center"><?= $karyawan['bpjs_kesehatan'] ?></td>
                            <td class="small text-center"><?= $karyawan['bpjs_ketenagakerjaan'] ?></td>
                            <td class="small text-center"><?= $karyawan['perusahaan_mitra'] ?></td>
                            <td class="small text-center"><?= $karyawan['status_pekerjaan'] ?></td>
                            <td class="small text-center"><?= $karyawan['status_pernikahan'] ?></td>
                            <td class="small text-center"><?= $karyawan['ket_induction'] ?></td>
                            <td class="small text-center"><?= $karyawan['service_byheart'] ?></td>
                            <td class="small text-center"><?= $karyawan['code_ofconduct'] ?></td>
                            <td class="small text-center"><?= $karyawan['visimisi_oflife'] ?></td>
                            <td class="small text-center"><?= $karyawan['training_sco'] ?></td>
                            <td class="small text-center"><?= $karyawan['training_sales'] ?></td>
                            <td class="small text-center"><?= $karyawan['kurir_program'] ?></td>
                            <td class="small text-center"><?= $karyawan['id_card'] ?></td>
                            <td class="small text-center"><?= $karyawan['seragam'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" role="dialog" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content" id="modalEditContent">
                            <!-- isi form akan di-load lewat Ajax -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>