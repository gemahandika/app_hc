   <main>
       <div class="container-fluid px-4">
           <h4 class="mt-4" style="border-bottom: solid 1px black;">Dashboard</h4>
           <?php Flasher::flash();  ?>
           <div class="card mb-4 mt-4 pb-4">
               <div class="container mt-3">
                   <form method="post">
                       <div class="row align-items-end g-2">
                           <div class="col-12 col-md-4 col-lg-2">
                               <label for="tgl_dari"><b>Date From:</b></label>
                               <input type="date" class="form-control" id="tgl_dari" name="tgl_dari" max="<?= date('Y-m-d') ?>" required>
                           </div>
                           <div class="col-12 col-md-4 col-lg-2">
                               <label for="tgl_ke"><b>Date Thru:</b></label>
                               <input type="date" class="form-control" id="tgl_ke" name="tgl_ke" max="<?= date('Y-m-d') ?>" required>
                           </div>
                           <div class="col-12 col-md-4 col-lg-3">
                               <label for="branch"><b>Branch:</b></label>
                               <input type="text" class="form-control" id="branch" name="branch" required>
                           </div>
                           <div class="col-12 col-md-12 col-lg-3 d-flex gap-2">
                               <button type="submit" class="btn btn-success w-100 w-md-auto"><i class="fa fa-filter"></i> Submit</button>
                               <a href="<?= BASE_URL; ?>/report/clear" class="btn btn-secondary w-100 w-md-auto">
                                   <i class="fa fa-refresh"></i> Refresh
                               </a>
                           </div>
                       </div>
                   </form>
               </div>
           </div>

           <div class="row">
               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card bg-primary text-white mb-4">
                           <div class="card-body">Total Karyawan</div>
                           <div class="card-footer d-flex justify-content-between align-items-center px-4">
                               <i class="fas fa-users fa-2x"></i>
                               <h1 class="mb-0">0</h1>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card bg-info text-white mb-4">
                           <div class="card-body">Karyawan Kcu</div>
                           <div class="card-footer d-flex justify-content-between align-items-center px-4">
                               <i class="fas fa-users fa-2x"></i>
                               <h1 class="mb-0">0</h1>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card bg-success text-white mb-4">
                           <div class="card-body">Karyawan Agen</div>
                           <div class="card-footer d-flex justify-content-between align-items-center px-4">
                               <i class="fas fa-users fa-2x"></i>
                               <h1 class="mb-0">0</h1>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card bg-warning text-white mb-4">
                           <div class="card-body">Karyawan Mitra</div>
                           <div class="card-footer d-flex justify-content-between align-items-center px-4">
                               <i class="fas fa-users fa-2x"></i>
                               <h1 class="mb-0">0</h1>
                           </div>
                       </div>
                   </a>
               </div>

               <div class="col-xl-3 col-md-6">
                   <a href="#" class="text-decoration-none">
                       <div class="card bg-danger text-white mb-4">
                           <div class="card-body">Karyawan Resign</div>
                           <div class="card-footer d-flex justify-content-between align-items-center px-4">
                               <i class="fas fa-users fa-2x"></i>
                               <h1 class="mb-0">0</h1>
                           </div>
                       </div>
                   </a>
               </div>
           </div>
       </div>
   </main>