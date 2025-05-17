<?php
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";
if (isset($_POST['add_section'])) {
    $section = trim($_POST['section']);
    $unit = trim($_POST['unit']);
    $posisi = trim($_POST['posisi']);
    $stmt = $koneksi->prepare("INSERT INTO tb_section (nama_section, unit, posisi) VALUES (?,?,?)");
    $stmt->bind_param(
        "sss",
        $section,
        $unit,
        $posisi
    );
    if ($stmt->execute()) {
        showSweetAlert('success', 'Sukses', 'Section berhasil ditambahkan!', '#3085d6', '../../public/views/tb_section/index.php');
    } else {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan saat menambahkan section.', '#d33', '../../public/views/tb_section/index.php');
        // echo "Error: " . $stmt->error; // <- Bisa kamu aktifkan untuk debug
    }
} elseif (isset($_POST['edit_section'])) {
    // Ambil dan bersihkan data input
    $id_section = intval($_POST['id_section']);
    $nama_section = trim($_POST['nama_section']);
    $unit = trim($_POST['unit']);
    $posisi = trim($_POST['posisi']);
    // Query update
    $stmt = $koneksi->prepare("UPDATE tb_section SET
        nama_section = ?, unit = ?, posisi = ? WHERE id_section = ?");

    $stmt->bind_param(
        "sssi",
        $nama_section,
        $unit,
        $posisi,
        $id_section
    );

    if ($stmt->execute()) {
        showSweetAlert('success', 'Berhasil', 'Data karyawan berhasil diUpdate.', '#3085d6', '../../public/views/tb_section/index.php');
    } else {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan saat menyimpan perubahan.', '#d33', '../../public/views/tb_section/index.php');
    }
}
