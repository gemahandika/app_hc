<?php
include '../config/koneksi.php'; // Pastikan koneksi DB sesuai

if (isset($_POST['type'])) {
    $type = $_POST['type'];

    // Get Unit berdasarkan Section
    if ($type == 'unit' && isset($_POST['section'])) {
        $section = mysqli_real_escape_string($koneksi, $_POST['section']);
        $query = mysqli_query($koneksi, "SELECT DISTINCT unit FROM tb_section WHERE nama_section = '$section'");
        echo '<option value="">-- Pilih Unit --</option>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<option value="' . $row['unit'] . '">' . $row['unit'] . '</option>';
        }

        // Get Posisi berdasarkan Unit
    } elseif ($type == 'posisi' && isset($_POST['unit'])) {
        $unit = mysqli_real_escape_string($koneksi, $_POST['unit']);
        $query = mysqli_query($koneksi, "SELECT DISTINCT posisi FROM tb_section WHERE unit = '$unit'");
        echo '<option value="">-- Pilih Posisi --</option>';
        while ($row = mysqli_fetch_assoc($query)) {
            echo '<option value="' . $row['posisi'] . '">' . $row['posisi'] . '</option>';
        }
    }
}
