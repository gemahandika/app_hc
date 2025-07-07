<?php

class Training extends Controller
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
        $data['judul'] = 'Training';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['karyawan'] = $this->model('Training_models')->getKaryawanWithUsia();
        $data['jumlah_training'] = $this->model('Training_models')->getSemuaJumlahTraining();
        // view
        $this->view('templates/header', $data);
        $this->view('training/index', $data);
        $this->view('templates/footer');
    }

    public function getKaryawanTrainingById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_karyawan'];

            // Panggil dari model
            $data = $this->model('Training_models')->getByIdTraining($id);

            // Kirim data sebagai JSON
            echo json_encode($data);
        }
    }

    public function editTraining()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_karyawan' => $_POST['id_karyawan'],
                'induction' => $_POST['edit-ket_induction'],
                'serviceByheart' => $_POST['edit-service_byheart'],
                'codeOfconduct' => $_POST['edit-code_ofconduct'],
                'visimisiOflife' => $_POST['edit-visimisi_oflife'],
                'trainingSco' => $_POST['edit-training_sco'],
                'trainingSales' => $_POST['edit-training_sales'],
                'kurirProgram' => $_POST['edit-kurir_program']
            ];
            if ($this->model('Training_models')->updateKaryawanTraining($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }
            header('Location: ' . BASE_URL . '/training');
            exit;
        }
    }
}
