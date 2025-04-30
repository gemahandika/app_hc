<!-- SweetAlert CSS -->
<link rel="stylesheet" href="../assets/sweetalert/dist/sweetalert2.min.css">

<!-- SweetAlert JS -->
<script src="../assets/sweetalert/dist/sweetalert2.all.min.js"></script>
<?php
$pesan = "Mohon maaf! Data sudah ada.";
$pesan_ok = "Data Berhasil di Tambah.";
$pesan_update = "Data Berhasil di Update.";
$pesan_ambil = "Saldo Berhasil di Ambil.";
$tujuan = "../../public/views/data_anggota/";
$tujuan_2 = "../../public/views/tb_daftar/list_daftar.php";
$tujuan_3 = "../../public/views/data_anggota/index_nonaktif.php";
function showSweetAlert($icon, $title, $text, $confirmButtonColor, $tujuan)
{
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '$icon',
                title: '$title',
                text: '$text',
                confirmButtonColor: '$confirmButtonColor',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = '$tujuan';
                }
            });
        });
    </script>";
}
