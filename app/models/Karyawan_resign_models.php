<?php

class Karyawan_resign_models
{

    private $table = 'tb_karyawan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKaryawanNonaktifWithUsia()
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia
            FROM tb_karyawan
            WHERE status_resign = 'YES'";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDistinctUsiaResign()
    {
        $sql = "SELECT DISTINCT TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia 
            FROM tb_karyawan 
            WHERE status_resign = 'YES'
            ORDER BY usia ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDistinctGenResign()
    {
        $sql = "SELECT DISTINCT gen FROM " . $this->table . " WHERE gen IS NOT NULL AND status_resign = 'YES' ORDER BY gen ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getDistinctSectionResign()
    {
        $sql = "SELECT DISTINCT section FROM " . $this->table . " WHERE section IS NOT NULL AND status_resign = 'YES' ORDER BY section ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getFilteredKaryawanResign($section = '', $usia = '', $gen = '')
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia FROM tb_karyawan WHERE status_resign = 'YES'";
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

    public function getByIdResign($id)
    {
        $this->db->query("SELECT * FROM tb_karyawan WHERE id_karyawan = :id AND status_resign = :status_resign");
        $this->db->bind('id', $id);
        $this->db->bind('status_resign', 'YES'); // ⬅️ ini yang dibutuhkan
        return $this->db->single();
    }

    public function updateKaryawanResign($data)
    {
        $query = "UPDATE {$this->table} SET 
            tgl_resign = :tglResign,
            ket_resign = :ketResign,
            status_resign = :statusResign
          WHERE id_karyawan = :id_karyawan";
        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }
        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }

    public function insertResign($data)
    {
        $query = "INSERT INTO tb_karyawan (
        kategori, branch, kcu_agen, nik_jne, nik_vendor, nama_karyawan,
        vendor, phone, id_finger, join_date, status_karyawan, jabatan,
        posisi, unit, section, birth_date, gen, gender, lokasi_kerja,
        pendidikan_terakhir, jurusan, alamat, kecamatan, bpjs_kesehatan,
        bpjs_ketenagakerjaan, perusahaan_mitra, status_pekerjaan, status_pernikahan,
        status_resign, ket_induction, service_byheart, code_ofconduct, visimisi_oflife,
        training_sco, training_sales, kurir_program, id_card, seragam, tgl_resign, ket_resign
    ) VALUES (
        :kategori, :branch, :kcu_agen, :nik_jne, :nik_vendor, :nama_karyawan,
        :vendor, :phone, :id_finger, :join_date, :status_karyawan, :jabatan,
        :posisi, :unit, :section, :birth_date, :gen, :gender, :lokasi_kerja,
        :pendidikan_terakhir, :jurusan, :alamat, :kecamatan, :bpjs_kesehatan,
        :bpjs_ketenagakerjaan, :perusahaan_mitra, :status_pekerjaan, :status_pernikahan,
        :status_resign, :ket_induction, :service_byheart, :code_ofconduct, :visimisi_oflife,
        :training_sco, :training_sales, :kurir_program, :id_card, :seragam, :tgl_resign, :ket_resign
    )";

        $this->db->query($query);

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }
        return $this->db->execute();
    }
}
