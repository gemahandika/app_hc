<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4" style="border-bottom: 1px solid black;">Data Karyawan</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKaryawan">
                        <i class="fa fa-plus"></i> Tambah Karyawan
                    </button>
                </div>
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
                    <form action="<?= BASE_URL ?>/karyawan/import" method="POST" enctype="multipart/form-data">
                        <input type="file" name="file_excel" accept=".xls,.xlsx,.csv" required>
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-upload"></i> Upload Data
                        </button>
                    </form>
                    <form id="formExportKaryawan" method="POST" action="<?= BASE_URL ?>/karyawan/export">
                        <input type="hidden" name="section" id="export_section">
                        <input type="hidden" name="gen" id="export_gen">
                        <input type="hidden" name="usia" id="export_usia">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i> Download
                        </button>
                    </form>
                    <a href="<?= BASE_URL ?>/karyawan/template" class="btn btn-secondary btn-sm">
                        <i class="fa fa-file-excel-o"></i> Download Template Excel
                    </a>
                </div>
            </div>
            <div class="filter-wrapper position-relative" style="z-index: 1;">
                <form id="filterForm" class="row card-header g-3 mb-2 gap-2">
                    <div class="col-md-3">
                        <label for="filter_section" class="form-label">Filter Section</label>
                        <select id="filter_section" class="form-select select2 filter-karyawan">
                            <option value="">-- Pilih Section --</option>
                            <?php foreach ($list_section as $s): ?>
                                <option value="<?= $s['section'] ?>"><?= $s['section'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_gen" class="form-label">Filter Gen</label>
                        <select id="filter_gen" class="form-select select2 filter-karyawan">
                            <option value="">-- Pilih Gen --</option>
                            <?php foreach ($list_gen as $g): ?>
                                <option value="<?= $g['gen'] ?>"><?= $g['gen'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="filter_usia" class="form-label">Filter Usia</label>
                        <select id="filter_usia" class="form-select select2 filter-karyawan">
                            <option value="">-- Pilih Usia --</option>
                            <?php foreach ($list_usia as $u): ?>
                                <option value="<?= $u['usia'] ?>"><?= $u['usia'] ?> TAHUN</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2 align-self-end">
                        <a href="<?= BASE_URL; ?>/karyawan" class="btn btn-secondary">Reset</a>
                    </div>
                </form>
            </div>
            <div id="karyawanResult"></div>

            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-success text-white">
                                <th class="small text-center bg-success">NO</th>
                                <th class="small text-center bg-success">ACTION</th>
                                <th class="small text-center bg-success">NAMA KARYAWAN</th>
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
                                <th class="small text-center">ID CARD</th>
                                <th class="small text-center">SERAGAM</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/karyawan/_partial_tabel_karyawan.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Tanbah -->
                <div class="modal fade" id="modalTambahKaryawan" tabindex="-1" aria-labelledby="modalTambahKaryawanLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/karyawan/tambah" id="formTambahKaryawan" method="POST">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="modalTambahKaryawanLabel">Tambah Data Karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-kategori" class="form-label fw-bold">Kategori</label>
                                            <select class="form-select" name="kategori" id="tambah-kategori" required>
                                                <option value="MES 1">MES 1</option>
                                                <option value="MES 2">MES 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-branch" class="form-label fw-bold">Branch</label>
                                            <select class="form-select select2 w-100" name="branch" id="tambah-branch" required>
                                                <option value="">Pilih Branch</option>
                                                <?php foreach ($data['branch'] as $row): ?>
                                                    <option value="<?= $row['nama_branch']; ?>"><?= $row['nama_branch']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-kcu" class="form-label fw-bold">Kcu / Agen / Mitra</label>
                                            <select class="form-select select2 w-100" name="kcu" id="tambah-kcu" required>
                                                <option value="">Pilih Kcu / Agen / Mitra</option>
                                                <?php foreach ($data['kcu'] as $kcu): ?>
                                                    <option value="<?= $kcu['nama']; ?>"><?= $kcu['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-nikJne" class="form-label fw-bold">Nik Jne</label>
                                            <input class="form-control" type="text" name="nikJne" id="tambah-nikJne">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-nikVendor" class="form-label fw-bold">Nik Vendor</label>
                                            <input class="form-control" type="text" name="nikVendor" id="tambah-nikVendor">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-nama" class="form-label fw-bold">Nama Karyawan</label>
                                            <input class="form-control" type="text" name="nama" id="tambah-nama">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-vendor" class="form-label fw-bold">Vendor</label>
                                            <input class="form-control" type="text" name="vendor" id="tambah-vendor">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-phone" class="form-label fw-bold">Hanphone</label>
                                            <input class="form-control" type="text" name="phone" id="tambah-phone">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-finger" class="form-label fw-bold">ID Finger</label>
                                            <input class="form-control" type="text" name="finger" id="tambah-finger">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-join" class="form-label fw-bold">Join Date</label>
                                            <input class="form-control" type="date" name="join" id="tambah-join">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-statusKaryawan" class="form-label fw-bold">Status Karyawan</label>
                                            <select class="form-select select2 w-100" name="statusKaryawan" id="tambah-statusKaryawan" required>
                                                <option value="">Pilih Status Karyawan</option>
                                                <?php foreach ($data['status_karyawan'] as $row): ?>
                                                    <option value="<?= $row['nama_status_karyawan']; ?>"><?= $row['nama_status_karyawan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-jabatan" class="form-label fw-bold">Jabatan</label>
                                            <select class="form-select select2 w-100" name="jabatan" id="tambah-jabatan" required>
                                                <option value="">Pilih Jabatan</option>
                                                <?php foreach ($data['jabatan'] as $row): ?>
                                                    <option value="<?= $row['nama_jabatan']; ?>"><?= $row['nama_jabatan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-posisi" class="form-label fw-bold">Posisi</label>
                                            <input class="form-control" type="text" name="posisi" id="tambah-posisi">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-unit" class="form-label fw-bold">Unit</label>
                                            <input class="form-control" type="text" name="unit" id="tambah-unit">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-section" class="form-label fw-bold">Section</label>
                                            <input class="form-control" type="text" name="section" id="tambah-section">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-birthdate" class="form-label fw-bold">Birthdate</label>
                                            <input class="form-control" type="date" name="birthdate" id="tambah-birthdate">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-gen" class="form-label fw-bold">Gen</label>
                                            <input class="form-control" type="text" name="gen" id="tambah-gen">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-gender" class="form-label fw-bold">Gender</label>
                                            <select class="form-select" name="gender" id="tambah-gender" required>
                                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                <option value="PEREMPUAN">PEREMPUAN</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-lokasi_kerja" class="form-label fw-bold">Lokasi Kerja</label>
                                            <input class="form-control" type="text" name="lokasi_kerja" id="tambah-lokasi_kerja">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-pendidikan_terakhir" class="form-label fw-bold">Pendidikan Terakhir</label>
                                            <input class="form-control" type="text" name="pendidikan_terakhir" id="tambah-pendidikan_terakhir">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-jurusan" class="form-label fw-bold">Jurusan</label>
                                            <input class="form-control" type="text" name="jurusan" id="tambah-jurusan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-alamat" class="form-label fw-bold">Alamat</label>
                                            <textarea class="form-control" type="text" name="alamat" id="tambah-alamat"></textarea>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-kecamatan" class="form-label fw-bold">Kecamatan</label>
                                            <input class="form-control" type="text" name="kecamatan" id="tambah-kecamatan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-bpjs_kesehatan" class="form-label fw-bold">BPJS Kesehatan</label>
                                            <input class="form-control" type="text" name="bpjs_kesehatan" id="tambah-bpjs_kesehatan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-bpjs_ketenagakerjaan" class="form-label fw-bold">BPJS Ketenagakerjaan</label>
                                            <input class="form-control" type="text" name="bpjs_ketenagakerjaan" id="tambah-bpjs_ketenagakerjaan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-perusahaan_mitra" class="form-label fw-bold">Perusahaan Mitra</label>
                                            <input class="form-control" type="text" name="perusahaan_mitra" id="tambah-perusahaan_mitra">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-status_pekerjaan" class="form-label fw-bold">Status Pekerjaan</label>
                                            <input class="form-control" type="text" name="status_pekerjaan" id="tambah-status_pekerjaan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="tambah-status_pernikahan" class="form-label fw-bold">Status Pernikahan</label>
                                            <input class="form-control" type="text" name="status_pernikahan" id="tambah-status_pernikahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Edit -->
                <div class="modal fade" id="modalEditKaryawan" tabindex="-1" aria-labelledby="modalEditKaryawanLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/karyawan/edit" id="formEditKaryawan" method="POST">
                                <div class="modal-header bg-success text-white">
                                    <h5 class="modal-title" id="modalEditKaryawanLabel">Edit Data Karyawan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_karyawan" id="edit-idKaryawan">
                                    <div class="row">
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-kategori" class="form-label fw-bold">Kategori</label>
                                            <select class="form-select" name="kategori" id="edit-kategori" required>
                                                <option value="MES 1">MES 1</option>
                                                <option value="MES 2">MES 2</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-branch" class="form-label fw-bold">Branch</label>
                                            <select class="form-select select2 w-100" name="branch" id="edit-branch" required>
                                                <option value="">Pilih Branch</option>
                                                <?php foreach ($data['branch'] as $row): ?>
                                                    <option value="<?= $row['nama_branch']; ?>"><?= $row['nama_branch']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-kcu" class="form-label fw-bold">Kcu / Agen / Mitra</label>
                                            <select class="form-select select2 w-100" name="kcu" id="edit-kcu" required>
                                                <option value="">Pilih Kcu / Agen / Mitra</option>
                                                <?php foreach ($data['kcu'] as $kcu): ?>
                                                    <option value="<?= $kcu['nama']; ?>"><?= $kcu['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-nikJne" class="form-label fw-bold">Nik Jne</label>
                                            <input class="form-control" type="text" name="nikJne" id="edit-nikJne">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-nikVendor" class="form-label fw-bold">Nik Vendor</label>
                                            <input class="form-control" type="text" name="nikVendor" id="edit-nikVendor">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-nama" class="form-label fw-bold">Nama Karyawan</label>
                                            <input class="form-control" type="text" name="nama" id="edit-nama">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-vendor" class="form-label fw-bold">Vendor</label>
                                            <input class="form-control" type="text" name="vendor" id="edit-vendor">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-phone" class="form-label fw-bold">Hanphone</label>
                                            <input class="form-control" type="text" name="phone" id="edit-phone">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-finger" class="form-label fw-bold">ID Finger</label>
                                            <input class="form-control" type="text" name="finger" id="edit-finger">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-join" class="form-label fw-bold">Join Date</label>
                                            <input class="form-control" type="date" name="join" id="edit-join">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-statusKaryawan" class="form-label fw-bold">Status Karyawan</label>
                                            <select class="form-select select2 w-100" name="statusKaryawan" id="edit-statusKaryawan" required>
                                                <option value="">Pilih Status Karyawan</option>
                                                <?php foreach ($data['status_karyawan'] as $row): ?>
                                                    <option value="<?= $row['nama_status_karyawan']; ?>"><?= $row['nama_status_karyawan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-jabatan" class="form-label fw-bold">Jabatan</label>
                                            <select class="form-select select2 w-100" name="jabatan" id="edit-jabatan" required>
                                                <option value="">Pilih Jabatan</option>
                                                <?php foreach ($data['jabatan'] as $row): ?>
                                                    <option value="<?= $row['nama_jabatan']; ?>"><?= $row['nama_jabatan']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-posisi" class="form-label fw-bold">Posisi</label>
                                            <input class="form-control" type="text" name="posisi" id="edit-posisi">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-unit" class="form-label fw-bold">Unit</label>
                                            <input class="form-control" type="text" name="unit" id="edit-unit">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-section" class="form-label fw-bold">Section</label>
                                            <input class="form-control" type="text" name="section" id="edit-section">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-birthdate" class="form-label fw-bold">Birthdate</label>
                                            <input class="form-control" type="date" name="birthdate" id="edit-birthdate">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-gen" class="form-label fw-bold">Gen</label>
                                            <input class="form-control" type="text" name="gen" id="edit-gen">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-gender" class="form-label fw-bold">Gender</label>
                                            <select class="form-select" name="gender" id="edit-gender" required>
                                                <option value="LAKI-LAKI">LAKI-LAKI</option>
                                                <option value="PEREMPUAN">PEREMPUAN</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-lokasi_kerja" class="form-label fw-bold">Lokasi Kerja</label>
                                            <input class="form-control" type="text" name="lokasi_kerja" id="edit-lokasi_kerja">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-pendidikan_terakhir" class="form-label fw-bold">Pendidikan Terakhir</label>
                                            <input class="form-control" type="text" name="pendidikan_terakhir" id="edit-pendidikan_terakhir">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-jurusan" class="form-label fw-bold">Jurusan</label>
                                            <input class="form-control" type="text" name="jurusan" id="edit-jurusan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-alamat" class="form-label fw-bold">Alamat</label>
                                            <textarea class="form-control" type="text" name="alamat" id="edit-alamat"></textarea>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-kecamatan" class="form-label fw-bold">Kecamatan</label>
                                            <input class="form-control" type="text" name="kecamatan" id="edit-kecamatan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-bpjs_kesehatan" class="form-label fw-bold">BPJS Kesehatan</label>
                                            <input class="form-control" type="text" name="bpjs_kesehatan" id="edit-bpjs_kesehatan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-bpjs_ketenagakerjaan" class="form-label fw-bold">BPJS Ketenagakerjaan</label>
                                            <input class="form-control" type="text" name="bpjs_ketenagakerjaan" id="edit-bpjs_ketenagakerjaan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-perusahaan_mitra" class="form-label fw-bold">Perusahaan Mitra</label>
                                            <input class="form-control" type="text" name="perusahaan_mitra" id="edit-perusahaan_mitra">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-status_pekerjaan" class="form-label fw-bold">Status Pekerjaan</label>
                                            <input class="form-control" type="text" name="status_pekerjaan" id="edit-status_pekerjaan">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label for="edit-status_pernikahan" class="form-label fw-bold">Status Pernikahan</label>
                                            <input class="form-control" type="text" name="status_pernikahan" id="edit-status_pernikahan">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Modal Resign -->
                <div class="modal fade" id="modalResignKaryawan" tabindex="-1" aria-labelledby="modalResignKaryawanLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/karyawan/resign" id="formResignKaryawan" method="POST">
                                <div class="modal-header bg-success text-white">
                                    <h6 class="modal-title" id="modalResignKaryawanLabel">FORM RESIGN KARYAWAN</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_karyawanResign" id="resign-idKaryawan">
                                    <div class="row flex-column">
                                        <div class="col-12 mb-3">
                                            <label for="nama" class="form-label fw-bold">Nama Karyawan</label>
                                            <input class="form-control" type="text" name="nama" id="resign-nama" style="background-color: rgba(53, 220, 145, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="nikJne" class="form-label fw-bold">Nik JNE</label>
                                            <input class="form-control" type="text" name="nikJne" id="resign-nikJne" style="background-color: rgba(53, 220, 145, 0.3);" readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="tglResign" class="form-label fw-bold">Tgl Resign</label>
                                            <input class="form-control" type="date" name="tglResign" id="resign-tgl" required>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="ketResign" class="form-label fw-bold">Keterangan Resign</label>
                                            <input class="form-control" type="text" name="ketResign" id="resign-ket" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-success">SUBMIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>