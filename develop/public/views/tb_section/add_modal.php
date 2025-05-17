<?php
$date = date('Y-m-d');
$time = date("H:i");
?>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h6 class="modal-title" id="modalAparaturLabel">TAMBAH SECTION BARU</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="../../../app/controller/Section_controller.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nama_section" class="form-label"><b>NAMA SECTION <span class="text-danger">*</span></b></label>
                            <input type="text" class="form-control" id="section" name="section" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="add_section">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    document.getElementById('kategori').addEventListener('change', function() {
        const kategori = this.value;
        const branchSelect = document.getElementById('branch');
        const options = branchSelect.querySelectorAll('option');

        options.forEach(option => {
            const namaCabang = option.getAttribute('data-nama');
            if (option.value === "") {
                option.style.display = 'block'; // selalu tampilkan placeholder
            } else if (kategori === 'MES 1') {
                option.style.display = (namaCabang === 'KCU MEDAN') ? 'block' : 'none';
            } else if (kategori === 'MES 2') {
                option.style.display = (namaCabang !== 'KCU MEDAN') ? 'block' : 'none';
            } else {
                option.style.display = 'none';
            }
        });

        branchSelect.value = ""; // reset pilihan setiap kali kategori berubah
    });
</script>

<script>
    function hitungSelisihTanggal(tanggalAwalStr) {
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

    function updateSelisihTanggal(inputId, outputId) {
        const input = document.getElementById(inputId);
        const output = document.getElementById(outputId);

        function update() {
            output.value = input.value ? hitungSelisihTanggal(input.value) : "";
        }

        input.addEventListener("change", update);
        window.addEventListener("load", update);
    }

    // Terapkan ke join_date → masa_kerja dan birth_date → usia
    updateSelisihTanggal("join_date", "masa_kerja");
    updateSelisihTanggal("birth_date", "usia");
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>