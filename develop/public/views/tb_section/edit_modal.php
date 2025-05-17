<?php
include '../../../app/config/koneksi.php'; // koneksi database

if (isset($_GET['id_section']) && isset($_GET['mode'])) {
    $id_section = $_GET['id_section'];
    $mode = $_GET['mode'];

    $query = mysqli_query($koneksi, "SELECT * FROM tb_section WHERE id_section = '$id_section'");
    $data = mysqli_fetch_assoc($query);


?>
    <div class="modal-header bg-success text-white">
        <h6 class="modal-title" id="editModalLabel">Edit Data Section</h6>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form method="POST" action="../../../app/controller/Section_controller.php">
        <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
            <input type="hidden" name="id_section" value="<?= $data['id_section']; ?>">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="nama_section" class="form-label"><b>NAMA SECTION <span class="text-danger">*</span></b></label>
                    <input type="text" class="form-control" id="nama_section" name="nama_section" value="<?= $data['nama_section'] ?>" required>
                </div>
            </div>
        </div>
        <!-- Tambahkan field edit lainnya -->
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success" name="edit_section">Update</button>
        </div>
    </form>
<?php
}
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>