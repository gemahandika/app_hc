<?php
require_once '../app/core/Flasher.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

class Home extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        // Ambil filter dari form
        $start  = $_GET['tgl_dari'] ?? null;
        $end    = $_GET['tgl_ke'] ?? null;
        $branch = $_GET['branch'] ?? null;

        $filterInfo = [];

        if ($branch) {
            $filterInfo[] = "Branch: <strong>$branch</strong>";
        }

        if ($start && $end) {
            $tanggalLabel = date('d M Y', strtotime($start)) . " – " . date('d M Y', strtotime($end));
            $filterInfo[] = "Tanggal: <strong>$tanggalLabel</strong>";
        }

        $data['filter_badge'] = $filterInfo
            ? "🔎 Filter Aktif – " . implode(' | ', $filterInfo)
            : null;

        $model = $this->model('Karyawan_models');

        // Daftar kategori kcu_agen dan key yang dipakai untuk $data[]
        $kategoriList = [
            'KCU' => 'jumlah_karyawan_kcu',
            'AGEN KOTA MEDAN' => 'jumlah_karyawan_agen_medan',
            'MITRA' => 'jumlah_karyawan_mitra',
            'AGEN MES 2' => 'jumlah_karyawan_agen_mes2',
            'AGEN MITRA CABANG' => 'jumlah_karyawan_agen_mitra_cabang',
            'GERAI' => 'jumlah_karyawan_gerai',
            'MITRA DELIVERY AGEN' => 'jumlah_karyawan_mitra_delivery_agen',
            'MITRA DELIVERY CABANG' => 'jumlah_karyawan_mitra_delivery_cabang',
        ];

        // Loop seluruh kategori dan isi nilai ke $data[]
        foreach ($kategoriList as $kcu_agen => $key) {
            if ($branch) {
                $data[$key] = $model->countByKcuAgenInBranch($branch, $kcu_agen, $start, $end)['total'];
            } else {
                $data[$key] = $model->countByKcuAgen($kcu_agen, $start, $end)['total'];
            }
        }

        // Data lain
        $data['jumlah_karyawan_aktif'] = 0;
        foreach ($kategoriList as $kcu => $key) {
            $data['jumlah_karyawan_aktif'] += $data[$key];
        }
        $data['branch_list'] = $model->getAllBranch();
        $data['judul'] = 'Home';
        $data['userRole'] = $_SESSION['role'];
        $data['username'] = $_SESSION['username'];
        $data['name'] = $_SESSION['name'];

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
