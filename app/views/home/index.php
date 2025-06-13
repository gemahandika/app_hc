   <main>
       <div class="container-fluid px-4">
           <h4 class="mt-4" style="border-bottom: solid 1px black;">Form Cancel Resi</h4>
           <div class="alert alert-primary" role="alert">
               <b>Noted :</b> Resi yang di request cancel atau status nya OPEN, akan pindah ke report setelah di proses oleh ADMIN / TIM IT <br>
               <span class="fw-bold text-danger"><b>Perhatian !!</b> Untuk cancel resi cashless silahkan info ke pengirim untuk di cancel di marketplacenya</span>
           </div>
           <?php Flasher::flash();  ?>
           <div class="card mb-4 mt-4">
               <div class="d-flex justify-content-between align-items-end p-2 flex-wrap gap-2 w-100">
                   <!-- FORM -->
                   <form method="post" action="<?= BASE_URL; ?>/home/tambah" class="row gx-3 gy-2 align-items-end flex-grow-1 m-0">
                       <div class="col-lg-4 col-md-6">
                           <label for="no_resi" class="form-label mb-1">Nomor Resi / AWB</label>
                           <input type="text" class="form-control" id="no_resi" name="no_resi" autocomplete="off" required>
                       </div>
                       <div class="col-lg-4 col-md-6">
                           <label for="keterangan" class="form-label mb-1">Keterangan Cancel</label>
                           <input type="text" class="form-control" id="keterangan" name="keterangan" autocomplete="off" required>
                       </div>
                       <div class="col-lg-2 col-md-4 d-grid">
                           <button type="submit" class="btn btn-primary text-nowrap">
                               <i class="fa fa-plus me-1"></i> CANCEL
                           </button>
                       </div>
                   </form>

                   <?php if (isset($data['userRole']) && in_array($data['userRole'], ['superadmin', 'admin'])) : ?>
                       <!-- Tombol hanya untuk superadmin dan admin -->
                       <form action="<?= BASE_URL; ?>/home/kirimEmail" method="post" onsubmit="return confirm('Apakah Anda yakin ingin mengirim email ke Helpdesk?')">
                           <div class="d-grid ml-2">
                               <button type="submit" class="btn btn-success text-nowrap">
                                   <i class="fa fa-envelope me-1"></i> EMAIL TO HELPDESK
                               </button>
                           </div>
                       </form>
                   <?php endif; ?>
               </div>
               <div class="card-header mt-4">
                   <i class="fas fa-table me-1"></i>
                   Data Resi Request Cancel
               </div>
               <div class="card-body">
                   <table id="example" class="display" style="width:100%">
                       <thead>
                           <tr class="bg-primary text-white">
                               <th class="small text-center">NO</th>
                               <th class="small text-center">NOMOR RESI</th>
                               <th class="small text-center">KETERANGAN</th>
                               <th class="small text-center">NAMA AGEN</th>
                               <th class="small text-center">BRANCH</th>
                               <th class="small text-center">USER ID</th>
                               <th class="small text-center">TGL REQ CANCEL</th>
                               <th class="small text-center">STATUS</th>
                               <th class="small text-center">ACTION</th>

                           </tr>
                       </thead>
                       <tbody>
                           <?php
                            $no = 1;
                            foreach ($data['open'] as $open) :
                            ?>
                               <tr>
                                   <td class="small text-center"><?= $no++ ?></td>
                                   <td class="small text-center"><?= $open['no_resi']; ?></td>
                                   <td class="small text-center"><?= $open['keterangan']; ?></td>
                                   <td class="small text-center"><?= $open['nama_agen']; ?></td>
                                   <td class="small text-center"><?= $open['cabang']; ?></td>
                                   <td class="small text-center"><?= $open['user_id']; ?></td>
                                   <td class="small text-center"><?= $open['tgl_req']; ?></td>
                                   <td class="small text-center"><?= $open['status']; ?></td>
                                   <td class="text-center">
                                       <button
                                           class="btn btn-warning btn-sm btn-editResi"
                                           data-id="<?= $open['id_resi']; ?>"
                                           data-resi="<?= $open['no_resi']; ?>"
                                           data-keterangan="<?= $open['keterangan']; ?>">
                                           <i class="fa fa-edit"></i>EDIT
                                       </button>

                                   </td>
                               </tr>
                           <?php endforeach; ?>
                       </tbody>
                   </table>
               </div>
           </div>
       </div>
   </main>

   <!-- Modal Edit -->
   <div class="modal fade" id="modalEditResi" tabindex="-1" aria-labelledby="modalEditResiLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="<?= BASE_URL; ?>/home/edit" method="POST">
                   <div class="modal-header bg-primary text-white">
                       <h5 class="modal-title " id="modalEditResiLabel">Edit Data</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                   </div>
                   <div class="modal-body">
                       <input type="hidden" name="id_resi" id="edit-idResi">

                       <div class="mb-3">
                           <label for="edit-resi" class="form-label">No Resi</label>
                           <input type="text" class="form-control" name="no_resi" id="edit-resi" required>
                       </div>

                       <div class="mb-3">
                           <label for="edit-keterangan" class="form-label">Keterangan</label>
                           <input type="text" class="form-control" name="keterangan" id="edit-keterangan" required>
                       </div>
                       <!-- Tambahkan input lainnya sesuai kebutuhan -->
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                       <button type="submit" class="btn btn-primary">Update</button>
                   </div>
               </form>
           </div>
       </div>
   </div>