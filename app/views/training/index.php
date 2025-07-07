<main>
    <div class="container-fluid px-4">
        <h6 class="mt-4" style="border-bottom: 1px solid black;">DATA KARYAWAN TRAINING</h6>
        <div class="card mb-4 mt-4">
            <div class="row border-bottom p-2">
                <div class="d-flex flex-wrap gap-4 mb-3">
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-rocket text-primary"></i>
                        <span class="fw-semibold">Induction:</span>
                        <span class="text-dark"><b><?= $jumlah_training['induction']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-heart text-danger"></i>
                        <span class="fw-semibold">Service by Heart:</span>
                        <span class="text-dark"><b><?= $jumlah_training['service']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-shield-alt text-info"></i>
                        <span class="fw-semibold">Code of Conduct:</span>
                        <span class="text-dark"><b><?= $jumlah_training['codeofconduct']; ?></b></span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-lightbulb text-success"></i>
                        <span class="fw-semibold">Vision & Strategy:</span>
                        <span class="text-dark"><b><?= $jumlah_training['vmts']; ?></b></span>
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-graduation-cap text-primary"></i>
                        <span class="fw-semibold">Profesi SCO:</span>
                        <span class="text-dark"><b><?= $jumlah_training['sco']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-user-tie text-info"></i>
                        <span class="fw-semibold">Profesi Sales:</span>
                        <span class="text-dark"><b><?= $jumlah_training['sales']; ?></b></span>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <i class="fas fa-box text-danger"></i>
                        <span class="fw-semibold">Kurir Dev. Program:</span>
                        <span class="text-dark"><b><?= $jumlah_training['jsc']; ?></b></span>
                    </div>
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
            </div>
            <div id="karyawanResultResign"></div>

            <div class="card-body">
                <div id="tableWrapper">
                    <table id="example" class="display nowrap" style="width:100%">
                        <thead>
                            <tr class="bg-success text-white">
                                <th class="small text-center bg-success">NO</th>
                                <th class="small text-center bg-success">ACTION</th>
                                <th class="small text-center bg-success">NAMA KARYAWAN</th>
                                <th class="small text-center">NIK JNE</th>
                                <th class="small text-center">KET INDUCTION</th>
                                <th class="small text-center">SERVICE BY HEART</th>
                                <th class="small text-center">CODE OF CONDUCT</th>
                                <th class="small text-center">CREAT VISION, MISSION,TARGET & STRATGY OF LIFE</th>
                                <th class="small text-center">TRAINING PROFESI SCO</th>
                                <th class="small text-center">TRAINING PROFESI SALES</th>
                                <th class="small text-center">JSC (KURIR DEV PROGRAM)</th>
                            </tr>
                        </thead>
                        <tbody id="karyawanResult">
                            <?php
                            extract($data);
                            require_once '../app/views/training/_partial_tabel_karyawan_training.php';
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Modal Edit Karyawan Training -->
                <div class="modal fade" id="modalEditTraining" tabindex="-1" aria-labelledby="modalEditTrainingLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
                            <form action="<?= BASE_URL; ?>/training/editTraining" id="formEditTraining" method="POST">
                                <div class="modal-header bg-success text-white">
                                    <h6 class="modal-title" id="modalEditTrainingLabel">EDIT DATA TRAINING</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                                    <input type="hidden" name="id_karyawan" id="editTraining-idKaryawan">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="edit-nama" class="form-label fw-bold">Nama Karyawan</label>
                                            <input class="form-control text-dark" style="background-color: rgba(53, 220, 98, 0.3);" type="text" name="edit-nama" id="editTraining-nama" required readonly>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-ket_induction" class="form-label fw-bold">Induction</label>
                                            <select class="form-select" name="edit-ket_induction" id="editTraining-ket_induction">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-service_byheart" class="form-label fw-bold">Service ByHeart</label>
                                            <select class="form-select" name="edit-service_byheart" id="editTraining-service_byheart">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-code_ofconduct" class="form-label fw-bold">Code OfConduct</label>
                                            <select class="form-select" name="edit-code_ofconduct" id="editTraining-code_ofconduct">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-visimisi_oflife" class="form-label fw-bold">VisiMisi OfLife</label>
                                            <select class="form-select" name="edit-visimisi_oflife" id="editTraining-visimisi_oflife">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="edit-training_sco" class="form-label fw-bold">Training SCO</label>
                                            <select class="form-select" name="edit-training_sco" id="editTraining-training_sco">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="edit-training_sales" class="form-label fw-bold">Training Sales</label>
                                            <select class="form-select" name="edit-training_sales" id="editTraining-training_sales">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="edit-kurir_program" class="form-label fw-bold">Kurir Program</label>
                                            <select class="form-select" name="edit-kurir_program" id="editTraining-kurir_program">
                                                <option value="YA">YA</option>
                                                <option value="BELUM">BELUM</option>
                                            </select>
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
            </div>
        </div>
    </div>
</main>