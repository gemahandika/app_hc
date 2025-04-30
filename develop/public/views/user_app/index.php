<?php
session_name("hc_session");
session_start();
include '../../header.php';
if (!in_array("super_admin", $_SESSION['admin_akses'])) {
    echo "Ooopss!! Kamu Tidak Punya Akses";
    exit();
}
include 'add_modal.php';
// include 'edit_modal.php';
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Data User Aplikasi</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header">
                <button type="button" class="btn btn-primary btn-sm me-2" data-toggle="modal" data-target=".bd-example-modal-lg">+ Tambah User</button>
                <a href="aktivasi.php" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg"> Aktivasi User</a>
            </div>
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-secondary text-white">
                            <th style="font-size: 0.75rem;">NO</th>
                            <th style="font-size: 0.75rem;">NIK</th>
                            <th style="font-size: 0.75rem;">NAMA USER</th>
                            <th style="font-size: 0.75rem;">USERNAME</th>
                            <th style="font-size: 0.75rem;">STATUS</th>
                            <th style="font-size: 0.75rem;">ACTION</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE status != 'NONAKTIF' ORDER BY login_id ASC") or die(mysqli_error($koneksi));
                    $result = array();
                    while ($data = mysqli_fetch_array($sql)) {
                        $result[] = $data;
                    }
                    foreach ($result as $data) {
                        $no++;
                    ?>
                        <tr>
                            <th class="kecil-normal"><?= $no ?></th>
                            <th class="kecil-normal"><?= $data['nip'] ?></th>
                            <th class="kecil-normal"><?= $data['nama_user'] ?></th>
                            <th class="kecil-normal"><?= $data['username'] ?></th>
                            <th class="kecil-normal"><?= $data['status'] ?></th>
                            <th class="d-flex p-2">
                                <button type="button" class="btn btn-warning btn-sm me-2 text-white" data-toggle="modal" data-target=".bd-example-modal-lg">Edit</button>
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target=".bd-example-modal-lg">Reset</button>
                            </th>
                        </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>
</main>

<?php
include '../../footer.php';
?>