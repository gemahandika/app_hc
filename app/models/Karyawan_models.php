<?php

class Karyawan_models
{

    private $table = 'tb_karyawan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function countKaryawanAktif()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM $this->table WHERE status_resign = :status_resign");
        $this->db->bind(':status_resign', 'NO');
        return $this->db->single(); // Ambil hasil COUNT-nya langsung
    }
    public function countByKcuAgen($kcu_agen, $start = null, $end = null)
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table 
              WHERE kcu_agen = :kcu_agen 
              AND status_resign = 'NO'";

        if ($start && $end) {
            $query .= " AND join_date BETWEEN :start AND :end";
        }

        $this->db->query($query);
        $this->db->bind(':kcu_agen', $kcu_agen);

        if ($start && $end) {
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
        }

        return $this->db->single();
    }
    public function countByKcuAgenInBranch($branch, $kcu_agen, $start = null, $end = null)
    {
        $query = "SELECT COUNT(*) AS total FROM $this->table 
              WHERE kcu_agen = :kcu_agen 
              AND branch = :branch 
              AND status_resign = 'NO'";

        if ($start && $end) {
            $query .= " AND join_date BETWEEN :start AND :end";
        }

        $this->db->query($query);
        $this->db->bind(':kcu_agen', $kcu_agen);
        $this->db->bind(':branch', $branch);

        if ($start && $end) {
            $this->db->bind(':start', $start);
            $this->db->bind(':end', $end);
        }

        return $this->db->single();
    }

    public function getAllBranch()
    {
        $this->db->query("SELECT DISTINCT branch FROM $this->table WHERE branch IS NOT NULL AND branch != '' ORDER BY branch ASC");
        return $this->db->resultSet();
    }


    public function getById($id)
    {
        $this->db->query("SELECT * FROM tb_karyawan WHERE id_karyawan = :id AND status_resign = :status_resign");
        $this->db->bind('id', $id);
        $this->db->bind('status_resign', 'NO');
        return $this->db->single();
    }

    public function getKaryawanBySection($section)
    {
        $this->db->query("SELECT * FROM tb_karyawan WHERE section = :section AND status_resign = 'NO'");
        $this->db->bind('section', $section);
        return $this->db->resultSet();
    }

    public function updateKaryawan($data)
    {
        $query = "UPDATE {$this->table} SET 
            kategori = :kategori,
            branch = :branch,
            kcu_agen = :kcu,
            nik_jne = :nikJne,
            nik_vendor = :nikVendor,
            nama_karyawan = :nama,
            vendor = :vendor,
            phone = :phone,
            id_finger = :finger,
            join_date = :join,
            status_karyawan = :statusKaryawan,
            jabatan = :jabatan,
            posisi = :posisi,
            unit = :unit,
            section = :section,
            birth_date = :birthdate,
            gen = :gen,
            gender = :gender,
            lokasi_kerja = :lokasi_kerja,
            pendidikan_terakhir = :pendidikan_terakhir,
            jurusan = :jurusan,
            alamat = :alamat,
            kecamatan = :kecamatan,
            bpjs_kesehatan = :bpjs_kesehatan,
            bpjs_ketenagakerjaan = :bpjs_ketenagakerjaan,
            perusahaan_mitra = :perusahaan_mitra,
            status_pekerjaan = :status_pekerjaan,
            status_pernikahan = :status_pernikahan
          WHERE id_karyawan = :id_karyawan";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }

    public function updateKaryawanResign($data)
    {
        $query = "UPDATE {$this->table} SET 
            tgl_resign = :tglResign,
            ket_resign = :ketResign,
            status_resign = :status_resign
          WHERE id_karyawan = :id_karyawan";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }

    public function addKaryawan($data)
    {
        $query = "INSERT INTO {$this->table} (
        kategori,
        branch,
        kcu_agen,
        nik_jne,
        nik_vendor,
        nama_karyawan,
        vendor,
        phone,
        id_finger,
        join_date,
        status_karyawan,
        jabatan,
        posisi,
        unit,
        section,
        birth_date,
        gen,
        gender,
        lokasi_kerja,
        pendidikan_terakhir,
        jurusan,
        alamat,
        kecamatan,
        bpjs_kesehatan,
        bpjs_ketenagakerjaan,
        perusahaan_mitra,
        status_pekerjaan,
        status_pernikahan,
        status_resign
    ) VALUES (
        :kategori,
        :branch,
        :kcu,
        :nikJne,
        :nikVendor,
        :nama,
        :vendor,
        :phone,
        :finger,
        :join,
        :statusKaryawan,
        :jabatan,
        :posisi,
        :unit,
        :section,
        :birthdate,
        :gen,
        :gender,
        :lokasi_kerja,
        :pendidikan_terakhir,
        :jurusan,
        :alamat,
        :kecamatan,
        :bpjs_kesehatan,
        :bpjs_ketenagakerjaan,
        :perusahaan_mitra,
        :status_pekerjaan,
        :status_pernikahan,
        :status_resign
    )";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val);
        }

        try {
            $result = $this->db->execute();

            if (!$result) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Query gagal, tapi tidak ada error dari PDO.'
                ]);
                exit;
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan.'
            ]);
            exit;
        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'PDO Error: ' . $e->getMessage()
            ]);
            exit;
        }
    }

    public function getDistinctGen()
    {
        $sql = "SELECT DISTINCT gen FROM " . $this->table . " WHERE gen IS NOT NULL ORDER BY gen ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDistinctSection()
    {
        $sql = "SELECT DISTINCT section FROM " . $this->table . " WHERE section IS NOT NULL ORDER BY section ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDistinctUsia()
    {
        $sql = "SELECT DISTINCT TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia 
            FROM tb_karyawan 
            WHERE status_resign = 'NO'
            ORDER BY usia ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getKaryawanAktifWithUsia()
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia
            FROM tb_karyawan
            WHERE status_resign = 'NO'
            ORDER BY id_karyawan DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getFilteredKaryawan($section = '', $usia = '', $gen = '')
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia FROM tb_karyawan WHERE status_resign = 'NO'";
        $params = [];

        if ($section !== '') {
            $sql .= " AND section = :section";
            $params[':section'] = $section;
        }

        if ($usia !== '') {
            $sql .= " AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) = :usia";
            $params[':usia'] = $usia;
        }

        if ($gen !== '') {
            $sql .= " AND gen = :gen";
            $params[':gen'] = $gen;
        }

        $this->db->query($sql);

        foreach ($params as $key => $val) {
            $this->db->bind($key, $val);
        }

        return $this->db->resultSet();
    }

    public function getFilterOptions()
    {
        $sql = "SELECT 
                DISTINCT section, 
                gen, 
                TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia
            FROM tb_karyawan
            WHERE status_resign = 'NO'
            ORDER BY section ASC, gen ASC, usia ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function insert($data)
    {
        $query = "INSERT INTO tb_karyawan (
        kategori, branch, kcu_agen, nik_jne, nik_vendor, nama_karyawan,
        vendor, phone, id_finger, join_date, status_karyawan, jabatan,
        posisi, unit, section, birth_date, gen, gender, lokasi_kerja,
        pendidikan_terakhir, jurusan, alamat, kecamatan, bpjs_kesehatan,
        bpjs_ketenagakerjaan, perusahaan_mitra, status_pekerjaan, status_pernikahan,
        status_resign, ket_induction, service_byheart, code_ofconduct, visimisi_oflife,
        training_sco, training_sales, kurir_program, id_card, seragam
    ) VALUES (
        :kategori, :branch, :kcu_agen, :nik_jne, :nik_vendor, :nama_karyawan,
        :vendor, :phone, :id_finger, :join_date, :status_karyawan, :jabatan,
        :posisi, :unit, :section, :birth_date, :gen, :gender, :lokasi_kerja,
        :pendidikan_terakhir, :jurusan, :alamat, :kecamatan, :bpjs_kesehatan,
        :bpjs_ketenagakerjaan, :perusahaan_mitra, :status_pekerjaan, :status_pernikahan,
        :status_resign, :ket_induction, :service_byheart, :code_ofconduct, :visimisi_oflife,
        :training_sco, :training_sales, :kurir_program, :id_card, :seragam
    )";

        $this->db->query($query);

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }
        return $this->db->execute();
    }

    public function existsByNIK($nik_jne)
    {
        $this->db->query("SELECT COUNT(*) FROM tb_karyawan WHERE nik_jne = :nik");
        $this->db->bind('nik', $nik_jne);
        return $this->db->singleColumn() > 0;
    }
}
