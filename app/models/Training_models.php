<?php

class Training_models
{

    private $table = 'tb_karyawan';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getKaryawanWithUsia()
    {
        $sql = "SELECT *, TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS usia
            FROM tb_karyawan
            WHERE status_resign = 'NO'";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getByIdTraining($id)
    {
        $this->db->query("SELECT * FROM tb_karyawan WHERE id_karyawan = :id AND status_resign = :status_resign");
        $this->db->bind('id', $id);
        $this->db->bind('status_resign', 'NO');
        return $this->db->single();
    }

    public function updateKaryawanTraining($data)
    {
        $query = "UPDATE {$this->table} SET 
            ket_induction = :induction,
            service_byheart = :serviceByheart,
            code_ofconduct = :codeOfconduct,
            visimisi_oflife = :visimisiOflife,
            training_sco = :trainingSco,
            training_sales = :trainingSales,
            kurir_program = :kurirProgram
          WHERE id_karyawan = :id_karyawan";
        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind($key, $val);
        }
        return $this->db->execute();
    }

    public function getSemuaJumlahTraining()
    {
        $jenis_training = [
            'induction'        => 'ket_induction',
            'service'          => 'service_byheart',
            'codeofconduct'    => 'code_ofconduct',
            'vmts'             => 'visimisi_oflife',
            'sco'              => 'training_sco',
            'sales'            => 'training_sales',
            'jsc'              => 'kurir_program'
        ];

        $result = [];

        foreach ($jenis_training as $key => $field) {
            $sql = "SELECT COUNT(*) as jumlah FROM {$this->table} 
                WHERE {$field} = :ya AND status_resign = :aktif";
            $this->db->query($sql);
            $this->db->bind('ya', 'YA');
            $this->db->bind('aktif', 'NO');
            $row = $this->db->single(); // return-nya harusnya associative array
            $result[$key] = $row['jumlah'] ?? 0;
        }

        return $result;
    }
}
