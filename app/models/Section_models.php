<?php

class Section_models
{
    private $db;
    private $table = 'tb_section';

    public function __construct()
    {
        require_once '../app/config/config.php';
        $this->db = new Database();
    }

    public function getAllSection()
    {
        $this->db->query("SELECT DISTINCT nama_section FROM {$this->table} ORDER BY nama_section ASC");
        return $this->db->resultSet();
    }
}
