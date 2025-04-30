<?php
$date = date('Y-m-d');
$time = date("H:i");
?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title" id="modalAparaturLabel">TAMBAH KARYAWAN BARU</h6>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../../../app/controller/Karyawan_controller.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <?php
                    // Ambil data cabang
                    $queryCabang = mysqli_query($koneksi, "SELECT id_cabang, nama_cabang FROM tb_cabang");
                    ?>
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label for="nik">NIK :</label><br>
                            <input type="text" class="form-control" id="report" name="nik" required onkeyup="myFunction()">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="user_id">User ID :</label><br>
                            <input type="text" class="form-control" id="report" name="user_id" required onkeyup="myFunction()">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="password">Password :</label><br>
                            <input type="text" class="form-control" id="report1" name="password" required onkeyup="myFunction()">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="fullname">Fullname :</label><br>
                            <input type="text" class="form-control" id="report2" name="fullname" required onkeyup="myFunction()">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add_karyawan">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>