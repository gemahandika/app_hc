<?php

class Resi_models
{

    private $table = 'tb_resi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getReportByOpen()
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status ORDER BY id_resi DESC');
        $this->db->bind(':status', 'OPEN');
        return $this->db->resultSet();
    }

    public function getReportByUserId($userId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status AND user_id = :user_id ORDER BY id_resi DESC');
        $this->db->bind(':status', 'OPEN');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function tambahDataResi($data)
    {

        // Cek apakah resi sudah ada
        $this->db->query('SELECT no_resi FROM ' . $this->table . ' WHERE no_resi = :no_resi AND status = :status');
        $this->db->bind('no_resi', $data['no_resi']);
        $this->db->bind(':status', 'OPEN');
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            // Username sudah ada
            return 'duplicate';
        }
        $query = "INSERT INTO tb_resi (no_resi, keterangan, status, tgl_req, user_id, nama_agen, cabang)
              VALUES (:no_resi, :keterangan, :status, :tgl_req, :user_id, :name, :cabang)";

        $this->db->query($query);
        $this->db->bind('no_resi', $data['no_resi']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('status', 'OPEN'); // tetap
        $this->db->bind('tgl_req', date('Y-m-d H:i:s')); // otomatis waktu sekarang
        $this->db->bind('user_id', $data['user_id']);
        $this->db->bind('name', $data['name']);
        $this->db->bind('cabang', $_SESSION['cabang']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateDataResi($data)
    {
        $query = "UPDATE tb_resi 
              SET no_resi = :no_resi,
                  keterangan = :keterangan
               WHERE id_resi = :id_resi";

        $this->db->query($query);
        $this->db->bind('no_resi', $data['no_resi']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('id_resi', $data['id_resi']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getReportByDateRange($from, $to)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status AND tgl_req BETWEEN :from AND :to ORDER BY id_resi DESC');
        $this->db->bind(':status', 'DONE');
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);
        return $this->db->resultSet();
    }

    public function getReportByDateRangeAndUserId($from, $to, $userId)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = :status AND user_id = :user_id AND tgl_req BETWEEN :from AND :to ORDER BY id_resi DESC');
        $this->db->bind(':status', 'DONE');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);
        return $this->db->resultSet();
    }

    public function ubahStatusOpenMenjadiDone()
    {
        $query = "UPDATE tb_resi SET status = 'DONE', tgl_proses = NOW()  WHERE status = 'OPEN'";
        $this->db->query($query);
        $this->db->execute();
        return $this->db->rowCount(); // Bisa digunakan kalau ingin tahu berapa data yang diubah
    }
}
