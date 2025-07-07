<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4" style="border-bottom: 1px solid black;">Data Karyawan Resign</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-end align-items-center">
                <?php Flasher::flash(); ?>
                <?php if (isset($_SESSION['flash_stack'])): ?>
                    <?php foreach ($_SESSION['flash_stack'] as $flash): ?>
                        <script>
                            Swal.fire({
                                icon: '<?= $flash['tipe']; ?>',
                                title: '<?= $flash['pesan']; ?>',
                                text: '<?= $flash['aksi']; ?>',
                                confirmButtonText: 'Oke',
                                allowOutsideClick: false
                            });
                        </script>
                    <?php endforeach;
                    unset($_SESSION['flash_stack']); ?>
                <?php endif; ?>

                <div class="d-flex flex-wrap gap-2">
                    <form action="<?= BASE_URL ?>/karyawan_resign/importResign" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file_excel" accept=".xls,.xlsx,.csv" required>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Upload Data
                        </button>
                    </form>
                    <form id="formExportKaryawan" method="POST" action="<?= BASE_URL ?>/karyawan_resign/export">
                        <input type="hidden" name="section" id="export_section">
                        <input type="hidden" name="gen" id="export_gen">
                        <input type="hidden" name="usia" id="export_usia">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>
                    <a href="<?= BASE_URL ?>/karyawan_resign/templateResign" class="btn btn-secondary btn-sm">
                        <i class="fa fa-file-excel-o"></i> Download Template Excel
                    </a>
                </div>
            </div>
            <div class="filter-wrapper position-relative" style="z-index: 1;">
                <form id="filterForm" class="row card-header g-3 mb-2 gap-2">
                    <div class="col-md-3">
                        <label for="filter_section_resign" class="form-label">Filter Section</label>
                        <select id="filter_section_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Section --</option>
                            <?php foreach ($list_section as $s): ?>
                                <option value="<?= $s['section'] ?>"><?= $s['section'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_gen_resign" class="form-label">Filter Gen</label>
                        <select id="filter_gen_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Gen --</option>
                            <?php foreach ($list_gen as $g): ?>
                                <option value="<?= $g['gen'] ?>"><?= $g['gen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_usia_resign" class="form-label">Filter Usia</label>
                        <select id="filter_usia_resign" class="form-select select2 filter-karyawan-resign">
                            <option value="">-- Pilih Usia --</option>
                            <?php foreach ($list_usia as $u): ?>
                                <option value="<?= $u['usia'] ?>"><?= $u['usia'] ?> TAHUN</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <a href="<?= BASE_URL; ?>/karyawan_resign" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
            <div id="karyawanResultResign"></div>

            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-danger text-white">
                                <th class="small text-center bg-danger">NO</th>
                                <th class="small text-center bg-danger">ACTION</th>
                                <th class="small text-center bg-danger">NAMA KARYAWAN</th>
                                <th class="small text-center">TGL RESIGN</th>
                                <th class="small text-center">KETERANGAN RESIGN</th>
                                <th class="small text-center">KATEGORI</th>
                                <th class="small text-center">BRANCH</th>
                                <th class="small text-center">KCU / AGEN / MITRA</th>
                                <th class="small text-center">NIK JNE</th>
                                <th class="small text-center">NIK VENDOR</th>
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
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/karyawan_resign/_partial_tabel_karyawan_resign.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit Karyawan Resign -->
                <div class="modal fade" id="modalEditKaryawanResign" tabindex="-1" aria-labelledby="modalEditKaryawanResignLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/karyawan_resign/editResign" id="formEditKaryawanResign" method="POST">
                                <div class="modal-header bg-danger text-white">
                                    <h6 class="modal-title" id="modalEditKaryawanResignLabel">EDIT DATA KARYAWAN RESIGN</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_karyawan" id="editResign-idKaryawan">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="edit-nama" class="form-label fw-bold">Nama Karyawan</label>
                                            <input class="form-control text-dark" style="background-color: rgba(220, 53, 69, 0.3);" type="text" name="edit-nama" id="editResign-nama" required readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-tgl_resign" class="form-label fw-bold">Tanggal Resign</label>
                                            <input class="form-control" type="date" name="edit-tgl_resign" id="editResign-tgl">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-ket_resign" class="form-label fw-bold">Keterangan Resign</label>
                                            <input class="form-control" type="text" name="edit-ket_resign" id="editResign-ket">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-status_resign" class="form-label fw-bold">Status Resign</label>
                                            <select class="form-select" name="edit-status_resign" id="editResign-status">
                                                <option value="YES">YES</option>
                                                <option value="NO">NO</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>