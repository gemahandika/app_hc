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
$total_mitra      = countKaryawan($koneksi, buildConditions('NO', ["kcu_agen = 'MITRA'"], $branch));
$total_resign   = countKaryawan($koneksi, buildConditions('YES', [], $branch));


// Tentukan batas waktu 5 tahun yang lalu
$startDate = new DateTime();
$startDate->modify('-2 years');

// Format tanggal untuk query
$startDateFormatted = $startDate->format('Y-m');

// Ambil data join dari DB (5 tahun terakhir)
$joinQuery = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(join_date, '%Y-%m') AS bulan, COUNT(*) AS total
    FROM tb_karyawan
    WHERE join_date IS NOT NULL AND status_resign = 'NO' AND join_date >= '$startDateFormatted'
    GROUP BY bulan
");

// Ambil data resign dari DB (5 tahun terakhir)
$resignQuery = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(tgl_resign, '%Y-%m') AS bulan, COUNT(*) AS total
    FROM tb_karyawan
    WHERE tgl_resign IS NOT NULL AND status_resign = 'YES' AND tgl_resign >= '$startDateFormatted'
    GROUP BY bulan
");

// Masukkan data hasil query ke array asosiatif untuk join
$joinCounts = [];
while ($row = mysqli_fetch_assoc($joinQuery)) {
    $joinCounts[$row['bulan']] = $row['total'];
}

// Masukkan data hasil query ke array asosiatif untuk resign
$resignCounts = [];
while ($row = mysqli_fetch_assoc($resignQuery)) {
    $resignCounts[$row['bulan']] = $row['total'];
}

// Buat array semua bulan untuk 5 tahun terakhir
$allMonths = [];
$start = new DateTime($startDateFormatted . '-01');
$end = new DateTime();
$end->modify('first day of next month');

while ($start < $end) {
    $allMonths[] = $start->format('Y-m');
    $start->modify('+1 month');
}

// Buat array final untuk join, hanya memasukkan data yang lebih dari 0
$joinLabels = [];
$joinData = [];
foreach ($allMonths as $bulan) {
    if (isset($joinCounts[$bulan]) && $joinCounts[$bulan] > 0) {
        $joinLabels[] = $bulan;
        $joinData[] = $joinCounts[$bulan];
    }
}

// Buat array final untuk resign, hanya memasukkan data yang lebih dari 0
$resignLabels = [];
$resignData = [];
foreach ($allMonths as $bulan) {
    if (isset($resignCounts[$bulan]) && $resignCounts[$bulan] > 0) {
        $resignLabels[] = $bulan;
        $resignData[] = $resignCounts[$bulan];
    }
}
