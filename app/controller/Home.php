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

        $data['judul'] = 'Home';
        $userRole = $_SESSION['role'];
        $username = $_SESSION['username'];
        $name = $_SESSION['name'];

        $data['userRole'] = $userRole;
        $data['username'] = $username;
        $data['name'] = $name;

        if ($userRole == 'agen') {
            $data['open'] = $this->model('Resi_models')->getReportByUserId($username);
        } else {
            $data['open'] = $this->model('Resi_models')->getReportByOpen();
        }

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }


    public function tambah()
    {
        // Ambil langsung dari session
        $_POST['user_id'] = $_SESSION['username']; // karena yang disimpan adalah $_SESSION['username']
        $_POST['name'] = $_SESSION['name']; // sesuaikan jika ada

        $result = $this->model('Resi_models')->tambahDataResi($_POST);

        if ($result === 'duplicate') {
            Flasher::setFlash('Opppss!!', 'Resi sudah pernah ditambahkan', 'error');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }

        if ($result > 0) {
            Flasher::setFlash('Resi Berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASE_URL . '/home');
            exit;
        } else {
            Flasher::setFlash('Resi Gagal', 'ditambahkan', 'error');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }

    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_resi' => $_POST['id_resi'],
                'no_resi' => $_POST['no_resi'],
                'keterangan' => $_POST['keterangan']
            ];

            $result = $this->model('Resi_models')->updateDataResi($data);
            if ($result !== false) {
                Flasher::setFlash('Resi Berhasil', 'diUpdate', 'success');
                header('Location: ' . BASE_URL . '/home'); // sesuaikan route-nya
                exit;
            } else {
                Flasher::setFlash('Gagal', 'diUpdate', 'error');
                header('Location: ' . BASE_URL . '/home');
                exit;
            }
        }
    }

    public function kirimEmail()
    {


        $report = $this->model('Resi_models')->getReportByOpen();

        $isiEmail = "Dear Team IT Helpdesk:\n";
        $isiEmail .= "Mohon Bantuannya Untuk Mencancel Resi Berikut Ini : \n\n";
        foreach ($report as $item) {
            $isiEmail .= "{$item['no_resi']}\n";
        }
        $isiEmail .= "\n";
        $isiEmail .= "Dikarenakan Petugas Salah Entry \n\n";
        $isiEmail .= "Terima Kasih \n";
        $isiEmail .= "Gemasyah Handika\n";
        $isiEmail .= "IT JNE MEDAN\n";
        $mail = new PHPMailer(true);

        try {
            // Server SMTP Outlook atau Office365
            $mail->isSMTP();
            $mail->Host = 'smtp.office365.com';
            $mail->SMTPAuth = true;
            $mail->Username = EMAIL_USER;  // dari config_email.php
            $mail->Password = EMAIL_PASS;  // dari config_email.php
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mes.it@jne.co.id', 'IT JNE MES');
            $mail->addAddress('ithelpdesk@jne.co.id', 'Team IT Helpdesk'); // Ganti tujuan
            $mail->addCC('mes.it@jne.co.id', 'Team IT');
            $mail->addCC('mes.it1@jne.co.id', 'Team IT');
            $mail->addCC('mes.it2@jne.co.id', 'Team IT');
            $mail->addCC('sigit.suprihandoko@jne.co.id', 'Head IT');

            $mail->Subject = 'Cancel Resi Orion Hybrid';
            $mail->Body    = $isiEmail;

            $mail->send();

            // ✅ Tambahkan baris ini untuk update status resi
            $this->model('Resi_models')->ubahStatusOpenMenjadiDone();

            Flasher::setFlash('Resi Berhasil', 'DiEmail ke Helpdesk', 'success');
            header('Location: ' . BASE_URL . '/home');
        } catch (Exception $e) {
            Flasher::setFlash('Gagal', 'DiEmail ke Helpdesk', 'danger');
            header('Location: ' . BASE_URL . '/home');
            exit;
        }
    }
}
