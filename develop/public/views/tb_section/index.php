<?php
session_name("hc_session");
session_start();
include '../../header.php';
include 'add_modal.php';
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4" style="border-bottom: 1px solid black;">Database Section</h3>
        <div class="card mb-4 mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button type="button" class="btn btn-success btn-sm me-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                    + Tambah Section
                </button>
            </div>
            <div class="card-body">
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr class="bg-success text-white">
                            <th class="text-center">NO</th>
                            <th class="text-center">NAMA SECTION</th>
                            <th class="text-center">UNIT</th>
                            <th class="text-center">POSISI</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    $sql = mysqli_query($koneksi, "SELECT * FROM tb_section ORDER BY id_section DESC") or die(mysqli_error($koneksi));
                    $result = array();
                    while ($data = mysqli_fetch_array($sql)) {
                        $result[] = $data;
                    }
                    foreach ($result as $data) {
                        $no++;
                    ?>
                        <tr>
                            <th class="text-center kecil-normal"><?= $no ?></th>
                            <th class="text-center kecil-normal"><?= $data['nama_section'] ?></th>
                            <th class="text-center kecil-normal"><?= $data['unit'] ?></th>
                            <th class="text-center kecil-normal"><?= $data['posisi'] ?></th>
                            <th class="text-center kecil-normal">
                                <button
                                    type="button"
                                    class="btn btn-warning btn-sm me-2 text-white openModalButtonSection"
                                    data-id_section="<?= $data['id_section']; ?>"
                                    data-mode="edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    Edit
                                </button>
                            </th>
                        </tr>
                    <?php } ?>
                </table>

                <!-- Modal -->
                <div class="modal fade bd-example-modal-lg" role="dialog" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modalEditContent">
                            <!-- isi form akan di-load lewat Ajax -->
                        </div>
                    </div>
                </div>

                <!-- jQuery harus ada -->


            </div>
        </div>
    </div>
</main>



<?php
include '../../footer.php';
?>