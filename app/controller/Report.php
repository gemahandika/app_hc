<?php

class Report extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Report';
        $userRole = $_SESSION['role'];
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];

        $data['name'] = $name;
        $data['username'] = $username;
        $data['userRole'] = $userRole;
        $data['report'] = [];
        $data['tgl_dari'] = $_SESSION['tgl_dari'] ?? '';
        $data['tgl_ke'] = $_SESSION['tgl_ke'] ?? '';

        // Jika form disubmit
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tglDari = $_POST['tgl_dari'] ?? '';
            $tglKe = $_POST['tgl_ke'] ?? '';

            // Simpan ke SESSION
            $_SESSION['tgl_dari'] = $tglDari;
            $_SESSION['tgl_ke'] = $tglKe;

            $data['tgl_dari'] = $tglDari;
            $data['tgl_ke'] = $tglKe;

            // Jika tanggal lengkap
            if (!empty($tglDari) && !empty($tglKe)) {
                $from = $tglDari . ' 00:00:00';
                $to = $tglKe . ' 23:59:59';

                if ($userRole === 'agen') {
                    $data['report'] = $this->model('Resi_models')->getReportByDateRangeAndUserId($from, $to, $username);
                } else {
                    $data['report'] = $this->model('Resi_models')->getReportByDateRange($from, $to);
                }
            }
        }

        $this->view('templates/header', $data);
        $this->view('report/index', $data);
        $this->view('templates/footer');
    }

    public function download()
    {
        // Pastikan method POST digunakan
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tgl_dari = $_POST['tgl_dari'] ?? null;
            $tgl_ke = $_POST['tgl_ke'] ?? null;
            $user_id = $_POST['user_id'] ?? null;

            if ($tgl_dari && $tgl_ke) {
                $from = $tgl_dari . ' 00:00:00';
                $to = $tgl_ke . ' 23:59:59';

                if ($user_id) {
                    $data['report'] = $this->model('Resi_models')->getReportByDateRangeAndUserId($from, $to, $user_id);
                } else {
                    $data['report'] = $this->model('Resi_models')->getReportByDateRange($from, $to);
                }

                if (!empty($data['report'])) {
                    $this->generateCSV($data['report'], $tgl_dari, $tgl_ke);
                    exit;
                } else {
                    Flasher::setFlash('Download Gagal', ' Data tidak ditemukan di range tanggal tersebut.', 'error');
                    header('Location: ' . BASE_URL . '/report');
                    exit;
                }
            } else {
                Flasher::setFlash('Data', 'Kosong.', 'error');
                header('Location: ' . BASE_URL . '/report');
                exit;
            }
        } else {
            Flasher::setFlash('Akses', 'tidak valid.', 'error');
            header('Location: ' . BASE_URL . '/report');
            exit;
        }
    }

    private function generateCSV($data, $tgl_dari, $tgl_ke)
    {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="report_' . $tgl_dari . '_to_' . $tgl_ke . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['NO', 'NOMOR RESI', 'KETERANGAN', 'NAMA AGEN', 'USER ID', 'TGL REQ CANCEL', 'TGL PROSES CANCEL', 'STATUS']);

        $no = 1;
        foreach ($data as $row) {
            fputcsv($output, [
                $no++,
                $row['no_resi'],
                $row['keterangan'],
                $row['nama_agen'],
                $row['user_id'],
                $row['tgl_req'],
                $row['tgl_proses'],
                $row['status']
            ]);
        }

        fclose($output);
    }

    public function clear()
    {
        unset($_SESSION['tgl_dari'], $_SESSION['tgl_ke']);
        header('Location: ' . BASE_URL . '/report');
        exit;
    }
}
