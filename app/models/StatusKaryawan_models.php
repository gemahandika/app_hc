<?php

class StatusKaryawan_models
{

    private $table = 'tb_status_karyawan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllStatusKaryawan()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
}
