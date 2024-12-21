<?php
class Pengelola_model
{
    private $db;
    private $table = 'pengelola';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPengelola()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getPengelolaById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' where id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}
