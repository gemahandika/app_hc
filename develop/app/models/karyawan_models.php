<?php
// Validasi format tanggal
function isValidDate($date)
{
    $d = DateTime::createFromFormat('Y-m-d', $date);
    return $d && $d->format('Y-m-d') === $date;
}

// Ambil filter tanggal dari URL
$start_date = isset($_GET['start_date']) && isValidDate($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) && isValidDate($_GET['end_date']) ? $_GET['end_date'] : null;

// Buat kondisi dasar berdasarkan status_resign dan rentang tanggal (jika ada)
// Update fungsi buildConditions untuk menggunakan $koneksi
function buildConditions($status_resign = 'NO', $extra_conditions = [], $branch = null)
{
    global $koneksi; // Mengakses variabel $koneksi di dalam fungsi

    $conditions = [];

    if ($status_resign !== null) {
        $conditions[] = "status_resign = '$status_resign'";
    }

    global $start_date, $end_date;
    if ($start_date && $end_date) {
        $conditions[] = "join_date BETWEEN '$start_date' AND '$end_date'";
    }

    // Filter berdasarkan branch (jika ada)
    if ($branch) {
        $branch = mysqli_real_escape_string($koneksi, $branch); // Pastikan menggunakan koneksi yang benar
        $conditions[] = "branch = '$branch'";
    }

    return array_merge($conditions, $extra_conditions);
}



// Fungsi untuk menghitung total berdasarkan kondisi
// Fungsi untuk menghitung total berdasarkan kondisi
function countKaryawan($koneksi, $conditions = [])
{
    $where = '';
    if (!empty($conditions)) {
        $where = ' WHERE ' . implode(' AND ', $conditions);
    }

    $query = "SELECT COUNT(*) AS total FROM tb_karyawan" . $where;
    $result = mysqli_query($koneksi, $query);
    if ($result) {
        $data = mysqli_fetch_assoc($result);
        return (int)$data['total'];
    }
    return 0;
}


// Ambil filter branch dari URL (jika ada)
$branch = isset($_GET['branch']) ? $_GET['branch'] : null;

// Hitung total karyawan berdasarkan filter yang ada
$total_karyawan = countKaryawan($koneksi, buildConditions('NO', [], $branch));
$total_agen     = countKaryawan($koneksi, buildConditions('NO', ["kcu_agen = 'AGEN'"], $branch));
$total_kcu      = countKaryawan($koneksi, buildConditions('NO', ["kcu_agen = 'KCU'"], $branch));
$total_resign   = countKaryawan($koneksi, buildConditions('YES', [], $branch));
