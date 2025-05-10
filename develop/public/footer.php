<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; ITdev_Jne Medan 2025</div>
        </div>
    </div>
</footer>
</div> <!-- end content-wrapper -->
</div> <!-- end layout -->

<!-- =================== JS Libraries =================== -->

<!-- jQuery (pastikan hanya satu versi!) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Inisialisasi Select2
        $('.select2').select2({
            width: '100%',
            // placeholder: '-- Pilih Data --',
            allowClear: true
        });
    });
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>



<!-- DataTables -->
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>

<!-- Chart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

<!-- Custom Scripts -->
<script src="../../../app/assets/js/scripts.js"></script>
<script src="../../../app/assets/demo/chart-area-demo.js"></script>
<script src="../../../app/assets/demo/chart-bar-demo.js"></script>
<!-- <script src="../../../app/assets/demo/chart-pie-demo.js"></script> -->

<script src="../../../app/assets/js/datatables-simple-demo.js"></script>

<!-- =================== JS Inisialisasi =================== -->

<script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        new DataTable('#example', {
            scrollX: true
        });
    });

    // Handler tombol buka modal
    $(document).on('click', '.openModalButton', function() {
        var id_karyawan = $(this).data('id_karyawan');
        var mode = $(this).data('mode');

        $.ajax({
            url: 'edit_modal.php',
            type: 'GET',
            data: {
                id_karyawan: id_karyawan,
                mode: mode
            },
            success: function(response) {
                $('#modalEditContent').html(response);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + xhr.responseText);
            }
        });
    });
</script>

</body>

</html>