<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;


class Karyawan_Resign extends Controller
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
        $data['judul'] = 'Karyawan_Resign';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['karyawan'] = $this->model('Karyawan_resign_models')->getKaryawanNonaktifWithUsia();
        $data['list_usia'] = $this->model('Karyawan_resign_models')->getDistinctUsiaResign();
        $data['list_gen'] = $this->model('Karyawan_resign_models')->getDistinctGenResign();
        $data['list_section'] = $this->model('Karyawan_resign_models')->getDistinctSectionResign();
        // view
        $this->view('templates/header', $data);
        $this->view('karyawan_resign/index', $data);
        $this->view('templates/footer');
    }

    public function filter()
    {
        $section = $_POST['section'] ?? '';
        $usia    = $_POST['usia'] ?? '';
        $gen     = $_POST['gen'] ?? '';

        $data['karyawan'] = $this->model('Karyawan_resign_models')->getFilteredKaryawanResign($section, $usia, $gen);

        extract($data);
        if (empty($data['karyawan'])) {
            echo 'EMPTY_DATA_MARKER';
            exit;
        }
        require_once '../app/views/karyawan_resign/_partial_tabel_karyawan_resign.php';
    }




    public function getKaryawanResignById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_karyawan'];

            // Panggil dari model
            $data = $this->model('Karyawan_resign_models')->getByIdResign($id);

            // Kirim data sebagai JSON
            echo json_encode($data);
        }
    }

    public function editResign()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_karyawan' => $_POST['id_karyawan'],
                'tglResign' => $_POST['edit-tgl_resign'],
                'ketResign' => $_POST['edit-ket_resign'],
                'statusResign' => $_POST['edit-status_resign']
            ];
            if ($this->model('Karyawan_resign_models')->updateKaryawanResign($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }
            header('Location: ' . BASE_URL . '/karyawan_resign');
            exit;
        }
    }

    public function getFilteredData()
    {
        $data['karyawan'] = $this->model('Karyawan_models')->getKaryawanWithUsia();
        $this->view('karyawan/_partial_tabel_karyawan', $data);
    }

    public function clear()
    {
        unset($_SESSION['tgl_dari'], $_SESSION['tgl_ke']);
        header('Location: ' . BASE_URL . '/report');
        exit;
    }

    public function export()
    {
        $section = $_POST['section'] ?? '';
        $gen     = $_POST['gen'] ?? '';
        $usia    = $_POST['usia'] ?? '';

        $karyawan = $this->model('Karyawan_resign_models')->getFilteredKaryawan($section, $usia, $gen);

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Karyawan_Resign_" . date('Ymd_His') . ".xls");

        echo '<table border="1">';
        echo '<thead><tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Branch</th>
        <th>KCU</th>
        <th>NIK JNE</th>
        <th>NIK Vendor</th>
        <th>Nama</th>
        <th>Vendor</th>
        <th>Phone</th>
        <th>Finger ID</th>
        <th>Join Date</th>
        <th>Masa Kerja</th>
        <th>Status</th>
        <th>Jabatan</th>
        <th>Posisi</th>
        <th>Unit</th>
        <th>Section</th>
        <th>Birth Date</th>
        <th>Usia</th>
        <th>Gen</th>
        <th>Gender</th>
        <th>Lokasi Kerja</th>
        <th>Pendidikan</th>
        <th>Jurusan</th>
        <th>Alamat</th>
        <th>Kecamatan</th>
        <th>BPJS Kesehatan</th>
        <th>BPJS TK</th>
        <th>Perusahaan Mitra</th>
        <th>Status Pekerjaan</th>
        <th>Status Pernikahan</th>
        <th>Induction</th>
        <th>By Heart</th>
        <th>Code of Conduct</th>
        <th>Visi Misi</th>
        <th>SCO</th>
        <th>Sales</th>
        <th>Kurir</th>
        <th>ID Card</th>
        <th>Seragam</th>
    </tr></thead><tbody>';

        $no = 1;
        foreach ($karyawan as $row) {
            $usia = $row['birth_date'] ? date_diff(date_create($row['birth_date']), date_create())->y . ' TAHUN' : '-';
            $masa_kerja = '-';
            if (!empty($row['join_date'])) {
                $join = new DateTime($row['join_date']);
                $now = new DateTime();
                $selisih = $join->diff($now);
                $masa_kerja = $selisih->y . ' TAHUN ' . $selisih->m . ' BULAN';
            }

            echo '<tr>
            <td>' . ($no++) . '</td>
            <td>' . $row['kategori'] . '</td>
            <td>' . $row['branch'] . '</td>
            <td>' . $row['kcu_agen'] . '</td>
            <td>' . $row['nik_jne'] . '</td>
            <td>' . $row['nik_vendor'] . '</td>
            <td>' . $row['nama_karyawan'] . '</td>
            <td>' . $row['vendor'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>' . $row['id_finger'] . '</td>
            <td>' . $row['join_date'] . '</td>
            <td>' . $masa_kerja . '</td>
            <td>' . $row['status_karyawan'] . '</td>
            <td>' . $row['jabatan'] . '</td>
            <td>' . $row['posisi'] . '</td>
            <td>' . $row['unit'] . '</td>
            <td>' . $row['section'] . '</td>
            <td>' . $row['birth_date'] . '</td>
            <td>' . $usia . '</td>
            <td>' . $row['gen'] . '</td>
            <td>' . $row['gender'] . '</td>
            <td>' . $row['lokasi_kerja'] . '</td>
            <td>' . $row['pendidikan_terakhir'] . '</td>
            <td>' . $row['jurusan'] . '</td>
            <td>' . $row['alamat'] . '</td>
            <td>' . $row['kecamatan'] . '</td>
            <td>' . $row['bpjs_kesehatan'] . '</td>
            <td>' . $row['bpjs_ketenagakerjaan'] . '</td>
            <td>' . $row['perusahaan_mitra'] . '</td>
            <td>' . $row['status_pekerjaan'] . '</td>
            <td>' . $row['status_pernikahan'] . '</td>
            <td>' . $row['ket_induction'] . '</td>
            <td>' . $row['service_byheart'] . '</td>
            <td>' . $row['code_ofconduct'] . '</td>
            <td>' . $row['visimisi_oflife'] . '</td>
            <td>' . $row['training_sco'] . '</td>
            <td>' . $row['training_sales'] . '</td>
            <td>' . $row['kurir_program'] . '</td>
            <td>' . $row['id_card'] . '</td>
            <td>' . $row['seragam'] . '</td>
        </tr>';
        }
        echo '</table>';
        exit;
    }


    public function importResign()
    {
        if (isset($_FILES['file_excel']) && $_FILES['file_excel']['error'] === 0) {
            $tmpFile = $_FILES['file_excel']['tmp_name'];

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($tmpFile);
            $spreadsheet = $reader->load($tmpFile);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $sukses = 0;
            $gagal = 0;

            foreach (array_slice($rows, 1) as $index => $row) {
                $barisExcel = $index + 2;

                $data = [
                    'kategori' => $row[0] ?? '',
                    'branch' => $row[1] ?? '',
                    'kcu_agen' => $row[2] ?? '',
                    'nik_jne' => $row[3] ?? '',
                    'nik_vendor' => $row[4] ?? '',
                    'nama_karyawan' => $row[5] ?? '',
                    'vendor' => $row[6] ?? '',
                    'phone' => $row[7] ?? '',
                    'id_finger' => $row[8] ?? '',
                    'join_date' => $row[9] ?? '',
                    'status_karyawan' => $row[10] ?? '',
                    'jabatan' => $row[11] ?? '',
                    'posisi' => $row[12] ?? '',
                    'unit' => $row[13] ?? '',
                    'section' => $row[14] ?? '',
                    'birth_date' => $row[15] ?? '',
                    'gen' => $row[16] ?? '',
                    'gender' => $row[17] ?? '',
                    'lokasi_kerja' => $row[18] ?? '',
                    'pendidikan_terakhir' => $row[19] ?? '',
                    'jurusan' => $row[20] ?? '',
                    'alamat' => $row[21] ?? '',
                    'kecamatan' => $row[22] ?? '',
                    'bpjs_kesehatan' => $row[23] ?? '',
                    'bpjs_ketenagakerjaan' => $row[24] ?? '',
                    'perusahaan_mitra' => $row[25] ?? '',
                    'status_pekerjaan' => $row[26] ?? '',
                    'status_pernikahan' => $row[27] ?? '',
                    'status_resign' => $row[28] ?? '',
                    'ket_induction' => $row[29] ?? '',
                    'service_byheart' => $row[30] ?? '',
                    'code_ofconduct' => $row[31] ?? '',
                    'visimisi_oflife' => $row[32] ?? '',
                    'training_sco' => $row[33] ?? '',
                    'training_sales' => $row[34] ?? '',
                    'kurir_program' => $row[35] ?? '',
                    'id_card' => $row[36] ?? '',
                    'seragam' => $row[37] ?? '',
                    'tgl_resign' => $row[38] ?? '',
                    'ket_resign' => $row[39] ?? ''
                ];

                // 🔎 Validasi wajib: kategori, branch, kcu_agen tidak boleh kosong
                if (empty($data['kategori']) || empty($data['branch']) || empty($data['kcu_agen'])) {
                    $gagal++;
                    $_SESSION['flash_stack'][] = [
                        'pesan' => "Baris ke-{$barisExcel} gagal",
                        'aksi' => "Kategori, Branch, dan KCU tidak boleh kosong",
                        'tipe' => 'warning'
                    ];
                    continue;
                }

                // 🚀 Simpan ke database
                if ($this->model('Karyawan_resign_models')->insertResign($data)) {
                    $sukses++;
                } else {
                    $gagal++;
                    error_log("❌ Gagal insert data ke-{$barisExcel}: " . json_encode($data));
                }
            }

            Flasher::setFlash("Upload selesai: {$sukses} baris berhasil", "{$gagal} baris gagal diproses", 'success');
        } else {
            Flasher::setFlash('Gagal', 'Upload file Excel bermasalah.', 'danger');
        }

        error_log('✅ Import selesai dijalankan');
        header('Location: ' . BASE_URL . '/karyawan_resign');
        exit;
    }



    public function templateResign()
    {
        $role = $_SESSION['role'] ?? 'guest';
        if (!in_array($role, ['admin', 'superadmin', 'user'])) {
            Flasher::setFlash('Sorry !!', 'Tidak Ada Akses', 'danger');
            header('Location: ' . BASE_URL . '/karyawan');
            exit;
        }

        $headers = [];

        if ($role === 'admin' || $role === 'superadmin') {
            $headers = [
                'Kategori',
                'Branch',
                'KCU',
                'NIK JNE',
                'NIK Vendor',
                'Nama Karyawan',
                'Vendor',
                'Phone',
                'ID Finger',
                'Join Date',
                'Status Karyawan',
                'Jabatan',
                'Posisi',
                'Unit',
                'Section',
                'Birth Date',
                'Gen',
                'Gender',
                'Lokasi Kerja',
                'Pendidikan Terakhir',
                'Jurusan',
                'Alamat',
                'Kecamatan',
                'BPJS Kesehatan',
                'BPJS Ketenagakerjaan',
                'Perusahaan Mitra',
                'Status Pekerjaan',
                'Status Pernikahan',
                'Status Resign',
                'Ket Induction',
                'Service ByHeart',
                'Code OfConduct',
                'VisiMisi OfLife',
                'Training SCO',
                'Training Sales',
                'Kurir Program',
                'ID Card',
                'Seragam',
                'Tgl Resign',
                'Keterangan Resign'
            ];
        } else {
            $headers = ['Nama Karyawan', 'Phone', 'Join Date', 'Vendor', 'Section', 'Birth Date'];
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->fromArray($headers, NULL, 'A1');

        // --- Sheet "options" untuk dropdown ---
        $optionsSheet = $spreadsheet->createSheet();
        $optionsSheet->setTitle('options');

        $kategoriList = ['MES 1', 'MES 2'];
        foreach ($kategoriList as $i => $val) {
            $optionsSheet->setCellValue('C' . ($i + 1), $val);
        }

        $branchList = [
            'CABANG BATUBARA',
            'CABANG ASAHAN',
            'CABANG BINJAI',
            'CABANG DAIRI',
            'CABANG DELI SERDANG',
            'CABANG KARO',
            'CABANG LABUHAN BATU',
            'CABANG LABUHAN BATU SELATAN',
            'CABANG LABUHAN BATU UTARA',
            'CABANG PAKPAK BHARAT',
            'CABANG PAYA GELI',
            'CABANG SAMOSIR',
            'CABANG SERDANG BEDAGAI',
            'CABANG SIANTAR',
            'CABANG SIMALUNGUN',
            'CABANG STABAT',
            'CABANG TANJUNG BALAI',
            'CABANG TEBING TINGGI',
            'KCU MEDAN'
        ];
        foreach ($branchList as $j => $val) {
            $optionsSheet->setCellValue('A' . ($j + 1), $val);
        }

        $kcuList = [
            'AGEN KOTA MEDAN',
            'AGEN MES 2',
            'AGEN MITRA CABANG',
            'GERAI',
            'KCU',
            'MITRA',
            'MITRA DELIVERY AGEN',
            'MITRA DELIVERY CABANG'
        ];
        foreach ($kcuList as $k => $val) {
            $optionsSheet->setCellValue('B' . ($k + 1), $val);
        }

        // --- Contoh baris kedua ---
        if ($role === 'admin' || $role === 'superadmin') {
            $contoh = [
                'MES 1',
                'KCU MEDAN',
                'KCU MEDAN',
                '',
                '',
                '',
                '',
                '',
                '',
                '2005-05-15 / FORMAT HARUS SEPERTI INI',
                '',
                '',
                '',
                '',
                '',
                '1995-05-15 / FORMAT HARUS SEPERTI INI',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                'YES',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                '1995-05-15 / FORMAT HARUS SEPERTI INI',
                ''
            ];
        } else {
            $contoh = ['Andi Wijaya', '08123456789', '2020-01-01', 'PT Jne Express', 'Section 1', '1995-05-15'];
        }
        $sheet->fromArray($contoh, NULL, 'A2');

        // --- Validasi dropdown ---
        $validasiKolom = [
            'A' => '=options!$C$1:$C$2',     // Kategori
            'B' => '=options!$A$1:$A$19',    // Branch
            'C' => '=options!$B$1:$B$8'      // KCU
        ];

        foreach ($validasiKolom as $col => $formula) {
            for ($row = 2; $row <= 100; $row++) {
                $validation = $sheet->getCell($col . $row)->getDataValidation();
                $validation->setType(DataValidation::TYPE_LIST);
                $validation->setErrorStyle(DataValidation::STYLE_STOP);
                $validation->setAllowBlank(true);
                $validation->setShowDropDown(true);
                $validation->setFormula1($formula);
            }
        }

        // --- Styling header ---
        $styleHeader = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'DDDDDD']]
        ];
        $lastColumn = Coordinate::stringFromColumnIndex(count($headers));
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray($styleHeader);

        // --- Download Excel ---
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="template_upload_karyawan_resign.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
