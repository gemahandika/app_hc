<?php

class Branch_models
{

    private $table = 'tb_branch';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllBranch()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
}
