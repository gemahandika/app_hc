<?php

class Kcuagenmitra_models
{

    private $table = 'tb_kcu_agen_mitra';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKcuagenmitra()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
}
