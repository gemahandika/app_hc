<?php

class Jabatan_models
{

    private $table = 'tb_jabatan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllJabatan()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
}
