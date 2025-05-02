<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
require_once "../config/koneksi.php";
require_once "../assets/sweetalert/dist/func_sweetAlert.php";


// **Input Visi Misi**
if (isset($_POST['add_karyawan'])) {
    // Ambil dan bersihkan input (tanpa escape string karena pakai prepared)
    $kategori = trim($_POST['kategori']);
    $branch = trim($_POST['branch']);
    $kcu_agen = trim($_POST['kcu_agen']);
    $nik_jne = trim($_POST['nik_jne']);
    $nik_vendor = trim($_POST['nik_vendor']);
    $nama_karyawan = trim($_POST['nama_karyawan']);
    $vendor = trim($_POST['vendor']);
    $id_finger = trim($_POST['id_finger']);
    $join_date = trim($_POST['join_date']);
    $masa_kerja = trim($_POST['masa_kerja']);
    $status_karyawan = trim($_POST['status_karyawan']);
    $jabatan = trim($_POST['jabatan']);
    $posisi = trim($_POST['posisi']);
    $unit = trim($_POST['unit']);
    $birth_date = trim($_POST['birth_date']);
    $usia = trim($_POST['usia']);
    $gen = trim($_POST['gen']);
    $gender = trim($_POST['gender']);
    $lokasi_kerja = trim($_POST['lokasi_kerja']);
    $pendidikan_terakhir = trim($_POST['pendidikan_terakhir']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);
    $kecamatan = trim($_POST['kecamatan']);
    $bpjs_kesehatan = trim($_POST['bpjs_kesehatan']);
    $bpjs_ketenagakerjaan = trim($_POST['bpjs_ketenagakerjaan']);
    $perusahaan_mitra = trim($_POST['perusahaan_mitra']);
    $status_pekerjaan = trim($_POST['status_pekerjaan']);
    $status_pernikahan = trim($_POST['status_pernikahan']);
    $status_resign = trim($_POST['status_resign']);
    $ket_induction = trim($_POST['ket_induction']);
    $service_byheart = trim($_POST['service_byheart']);
    $code_ofconduct = trim($_POST['code_ofconduct']);
    $training_sales = trim($_POST['training_sales']);
    $training_sco = trim($_POST['training_sco']);
    $visimisi_oflife = trim($_POST['visimisi_oflife']);
    $kurir_program = trim($_POST['kurir_program']);
    $id_card = trim($_POST['id_card']);
    $seragam = trim($_POST['seragam']);

    $stmt = $koneksi->prepare("INSERT INTO tb_karyawan (
        kategori, branch, kcu_agen, nik_jne, nik_vendor, nama_karyawan, vendor, id_finger, join_date, masa_kerja, status_karyawan,
        jabatan, posisi, unit, birth_date, usia, gen, gender, lokasi_kerja, pendidikan_terakhir, jurusan, alamat,
        kecamatan, bpjs_kesehatan, bpjs_ketenagakerjaan, perusahaan_mitra, status_pekerjaan, status_pernikahan, status_resign,
        ket_induction, service_byheart, code_ofconduct, training_sales, training_sco, visimisi_oflife,
        kurir_program, id_card, seragam
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

    $stmt->bind_param(
        "ssssssssssssssssssssssssssssssssssssss",
        $kategori,
        $branch,
        $kcu_agen,
        $nik_jne,
        $nik_vendor,
        $nama_karyawan,
        $vendor,
        $id_finger,
        $join_date,
        $masa_kerja,
        $status_karyawan,
        $jabatan,
        $posisi,
        $unit,
        $birth_date,
        $usia,
        $gen,
        $gender,
        $lokasi_kerja,
        $pendidikan_terakhir,
        $jurusan,
        $alamat,
        $kecamatan,
        $bpjs_kesehatan,
        $bpjs_ketenagakerjaan,
        $perusahaan_mitra,
        $status_pekerjaan,
        $status_pernikahan,
        $status_resign,
        $ket_induction,
        $service_byheart,
        $code_ofconduct,
        $training_sales,
        $training_sco,
        $visimisi_oflife,
        $kurir_program,
        $id_card,
        $seragam
    );

    if ($stmt->execute()) {
        showSweetAlert('success', 'Sukses', 'Data berhasil ditambahkan!', '#3085d6', '../../public/views/karyawan/index.php');
    } else {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan saat menambahkan data.', '#d33', '../../public/views/karyawan/index.php');
        // echo "Error: " . $stmt->error; // <- Bisa kamu aktifkan untuk debug
    }
} elseif (isset($_POST['edit_karyawan'])) {
    // Ambil dan bersihkan data input
    $id_karyawan = intval($_POST['id_karyawan']);
    $kategori = trim($_POST['kategori']);
    $branch = trim($_POST['branch']);
    $kcu_agen = trim($_POST['kcu_agen']);
    $nik_jne = trim($_POST['nik_jne']);
    $nik_vendor = trim($_POST['nik_vendor']);
    $nama_karyawan = trim($_POST['nama_karyawan']);
    $vendor = trim($_POST['vendor']);
    $id_finger = trim($_POST['id_finger']);
    $join_date = trim($_POST['join_date']);
    $masa_kerja = trim($_POST['masa_kerja']);
    $status_karyawan = trim($_POST['status_karyawan']);
    $jabatan = trim($_POST['jabatan']);
    $posisi = trim($_POST['posisi']);
    $unit = trim($_POST['unit']);
    $birth_date = trim($_POST['birth_date']);
    $usia = trim($_POST['usia']);
    $gen = trim($_POST['gen']);
    $gender = trim($_POST['gender']);
    $lokasi_kerja = trim($_POST['lokasi_kerja']);
    $pendidikan_terakhir = trim($_POST['pendidikan_terakhir']);
    $jurusan = trim($_POST['jurusan']);
    $alamat = trim($_POST['alamat']);
    $kecamatan = trim($_POST['kecamatan']);
    $bpjs_kesehatan = trim($_POST['bpjs_kesehatan']);
    $bpjs_ketenagakerjaan = trim($_POST['bpjs_ketenagakerjaan']);
    $perusahaan_mitra = trim($_POST['perusahaan_mitra']);
    $status_pekerjaan = trim($_POST['status_pekerjaan']);
    $status_pernikahan = trim($_POST['status_pernikahan']);
    $ket_induction = trim($_POST['ket_induction']);
    $service_byheart = trim($_POST['service_byheart']);
    $code_ofconduct = trim($_POST['code_ofconduct']);
    $training_sales = trim($_POST['training_sales']);
    $training_sco = trim($_POST['training_sco']);
    $visimisi_oflife = trim($_POST['visimisi_oflife']);
    $kurir_program = trim($_POST['kurir_program']);
    $id_card = trim($_POST['id_card']);
    $seragam = trim($_POST['seragam']);

    // Query update
    $stmt = $koneksi->prepare("UPDATE tb_karyawan SET
        kategori = ?, branch = ?, kcu_agen = ?, nik_jne = ?, nik_vendor = ?, nama_karyawan = ?, vendor = ?, id_finger = ?, join_date = ?, masa_kerja = ?, status_karyawan = ?,
        jabatan = ?, posisi = ?, unit = ?, birth_date = ?, usia = ?, gen = ?, gender = ?, lokasi_kerja = ?, pendidikan_terakhir = ?, jurusan = ?, alamat = ?,
        kecamatan = ?, bpjs_kesehatan = ?, bpjs_ketenagakerjaan = ?, perusahaan_mitra = ?, status_pekerjaan = ?, status_pernikahan = ?,
        ket_induction = ?, service_byheart = ?, code_ofconduct = ?, training_sales = ?, training_sco = ?, visimisi_oflife = ?,
        kurir_program = ?, id_card = ?, seragam = ?
        WHERE id_karyawan = ?");

    $stmt->bind_param(
        "sssssssssssssssssssssssssssssssssssssi",
        $kategori,
        $branch,
        $kcu_agen,
        $nik_jne,
        $nik_vendor,
        $nama_karyawan,
        $vendor,
        $id_finger,
        $join_date,
        $masa_kerja,
        $status_karyawan,
        $jabatan,
        $posisi,
        $unit,
        $birth_date,
        $usia,
        $gen,
        $gender,
        $lokasi_kerja,
        $pendidikan_terakhir,
        $jurusan,
        $alamat,
        $kecamatan,
        $bpjs_kesehatan,
        $bpjs_ketenagakerjaan,
        $perusahaan_mitra,
        $status_pekerjaan,
        $status_pernikahan,
        $ket_induction,
        $service_byheart,
        $code_ofconduct,
        $training_sales,
        $training_sco,
        $visimisi_oflife,
        $kurir_program,
        $id_card,
        $seragam,
        $id_karyawan
    );

    if ($stmt->execute()) {
        showSweetAlert('success', 'Berhasil', 'Data karyawan berhasil diubah.', '#3085d6', '../../public/views/karyawan/index.php');
    } else {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan saat menyimpan perubahan.', '#d33', '../../public/views/karyawan/index.php');
    }
} elseif (isset($_POST['resign_karyawan'])) {
    // Ambil dan bersihkan data input
    $id_karyawan = intval($_POST['id_karyawan']);
    $tgl_resign = trim($_POST['tgl_resign']);
    $ket_resign = trim($_POST['ket_resign']);
    $status_resign = trim($_POST['status_resign']);


    // Query update
    $stmt = $koneksi->prepare("UPDATE tb_karyawan SET
        tgl_resign = ?, ket_resign = ?, status_resign = ? WHERE id_karyawan = ?");

    $stmt->bind_param(
        "sssi",
        $tgl_resign,
        $ket_resign,
        $status_resign,
        $id_karyawan
    );

    if ($stmt->execute()) {
        showSweetAlert('success', 'Berhasil', 'Karyawan resign berhasil di tambah', '#3085d6', '../../public/views/karyawan/index.php');
    } else {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan saat menyimpan perubahan.', '#d33', '../../public/views/karyawan/index.php');
    }
} else
if (isset($_POST['update_all_karyawan']) && isset($_POST['karyawan'])) {
    try {
        foreach ($_POST['karyawan'] as $id => $data) {
            $id_karyawan = intval($data['id']);
            $masa_kerja = trim($data['masa_kerja']);
            $usia = trim($data['usia']);

            $stmt = $koneksi->prepare("UPDATE tb_karyawan SET masa_kerja = ?, usia = ? WHERE id_karyawan = ?");
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $koneksi->error);
            }

            $stmt->bind_param("ssi", $masa_kerja, $usia, $id_karyawan);
            $stmt->execute();
            $stmt->close();
        }

        showSweetAlert('success', 'Berhasil', 'Data karyawan berhasil diperbarui.', '#3085d6', '../../public/views/karyawan/index.php');
    } catch (Exception $e) {
        showSweetAlert('error', 'Gagal', 'Terjadi kesalahan: ' . $e->getMessage(), '#d33', '../../public/views/karyawan/index.php');
    }
}
