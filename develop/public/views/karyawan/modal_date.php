<?php
$date = date('Y-m-d');
$time = date("H:i");
?>

<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title" id="modalAparaturLabel">TAMBAH KARYAWAN BARU</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../../../app/controller/Karyawan_controller.php" method="POST">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        <label><b>Apakah Anda Ingin Update Data?</b></label>
                    </div>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT id_karyawan, nama_karyawan, join_date, birth_date FROM tb_karyawan WHERE status_resign = 'NO'");
                    while ($data = mysqli_fetch_assoc($query)):
                        $id = $data['id_karyawan'];
                        $nama = $data['nama_karyawan'];
                        $join_date = $data['join_date'];
                        $birth_date = $data['birth_date'];
                    ?>
                        <!-- Gunakan struktur array -->
                        <input type="text" name="karyawan[<?= $id ?>][id]" value="<?= $id ?>">
                        <input type="text" class="join-date" data-id="<?= $id ?>" value="<?= $join_date ?>">
                        <input type="text" name="karyawan[<?= $id ?>][masa_kerja]" class="masa-kerja" id="masa_kerja_<?= $id ?>" readonly>
                        <input type="text" class="birthdate" data-id="<?= $id ?>" value="<?= $birth_date ?>">
                        <input type="text" name="karyawan[<?= $id ?>][usia]" class="usia" id="usia_<?= $id ?>" readonly>
                    <?php endwhile; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="update_all_karyawan">Update</button>
                </div>
            </form>


        </div>
    </div>
</div>

<script>
    function hitungSelisihTanggal(tanggalAwalStr) {
        if (!tanggalAwalStr || isNaN(new Date(tanggalAwalStr).getTime())) {
            return ""; // Handle kosong atau invalid date
        }

        const tanggalAwal = new Date(tanggalAwalStr);
        const today = new Date();

        let years = today.getFullYear() - tanggalAwal.getFullYear();
        let months = today.getMonth() - tanggalAwal.getMonth();
        let days = today.getDate() - tanggalAwal.getDate();

        if (days < 0) months--;
        if (months < 0) {
            years--;
            months += 12;
        }

        return `${years} TAHUN ${months} BULAN`;
    }


    function hitungUsia(birthdateStr) {
        if (!birthdateStr || isNaN(new Date(birthdateStr).getTime())) {
            return ""; // Handle kosong atau invalid date
        }
        const birthDate = new Date(birthdateStr);
        const today = new Date();

        let years = today.getFullYear() - birthDate.getFullYear();
        let months = today.getMonth() - birthDate.getMonth();
        let days = today.getDate() - birthDate.getDate();

        if (days < 0) months--;
        if (months < 0) {
            years--;
            months += 12;
        }

        return `${years} TAHUN ${months} BULAN`;
    }


    function updateSemuaMasaKerja() {
        document.querySelectorAll(".join-date").forEach(input => {
            const id = input.getAttribute("data-id");
            const output = document.getElementById("masa_kerja_" + id);
            output.value = input.value ? hitungSelisihTanggal(input.value) : "";
        });
    }

    function updateSemuaUsia() {
        document.querySelectorAll(".birthdate").forEach(input => {
            const id = input.getAttribute("data-id");
            const output = document.getElementById("usia_" + id);
            output.value = input.value ? hitungUsia(input.value) : "";
        });
    }

    document.addEventListener("DOMContentLoaded", () => {
        updateSemuaMasaKerja();
        updateSemuaUsia();
    });
</script>




<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>