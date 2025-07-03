   <main>
       <div class="container-fluid px-4">
           <h4 class="mt-4" style="border-bottom: solid 1px black;">Dashboard</h4>
           <?php Flasher::flash();  ?>
           <div class="card mb-4 mt-4 pb-4">
               <div class="container mt-3">
                   <form method="GET" class="mb-4">
                       <div class="row g-3 align-items-end">
                           <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                               <label for="tgl_dari" class="form-label"><strong>Date From:</strong></label>
                               <input type="date" class="form-control" id="tgl_dari" name="tgl_dari" max="<?= date('Y-m-d') ?>" value="<?= $_GET['tgl_dari'] ?? '' ?>">
                           </div>

                           <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                               <label for="tgl_ke" class="form-label"><strong>Date Thru:</strong></label>
                               <input type="date" class="form-control" id="tgl_ke" name="tgl_ke" max="<?= date('Y-m-d') ?>" value="<?= $_GET['tgl_ke'] ?? '' ?>">
                           </div>

                           <div class="col-12 col-md-4 col-lg-3">
                               <label for="branch" class="form-label"><strong>Branch:</strong></label>
                               <select id="branch" name="branch" class="form-select select2 form-control">
                                   <option value="">-- Pilih Branch --</option>
                                   <?php foreach ($data['branch_list'] as $row): ?>
                                       <option value="<?= $row['branch']; ?>" <?= isset($_GET['branch']) && $_GET['branch'] === $row['branch'] ? 'selected' : '' ?>>
                                           <?= $row['branch']; ?>
                                       </option>
                                   <?php endforeach; ?>
                               </select>
                           </div>

                           <div class="col-12 col-lg-3 d-grid">
                               <button type="submit" class="btn btn-primary">
                                   <i class="fa fa-filter me-2"></i> Filter
                               </button>
                           </div>
                       </div>
                   </form>
               </div>
           </div>
           <?php if (!empty($data['filter_badge'])): ?>
               <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                   <i class="fas fa-filter me-2"></i>
                   <div><?= $data['filter_badge']; ?></div>
               </div>
           <?php endif; ?>
           <div class="row">
               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Total Karyawan</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0"><?= $data['jumlah_karyawan_aktif']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Karyawan Kcu</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0"><?= $data['jumlah_karyawan_kcu']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Karyawan Agen Mdn</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0"><?= $data['jumlah_karyawan_agen_medan']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Karyawan Mitra</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0"><?= $data['jumlah_karyawan_mitra']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Karyawan Agen Mes 2</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0 "><?= $data['jumlah_karyawan_agen_mes2']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Agen Mitra Cabang</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0 "><?= $data['jumlah_karyawan_agen_mitra_cabang']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Karyawan Gerai</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0 "><?= $data['jumlah_karyawan_gerai']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Mitra Delivery Agen</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0 "><?= $data['jumlah_karyawan_mitra_delivery_agen']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
               <div class="col-xl-2 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card  mb-4">
                           <div class="card-body bg-success text-white text-uppercase small text-center">Mitra Delivery Cbng</div>
                           <div class="card-footer text-dark d-flex justify-content-between align-items-center px-4">
                               <i style="opacity: 0.7;" class="fas fa-users fa-2x"></i>
                               <h2 class="mb-0 "><?= $data['jumlah_karyawan_mitra_delivery_cabang']; ?></h2>
                           </div>
                       </div>
                   </a>
               </div>
           </div>
       </div>
   </main>