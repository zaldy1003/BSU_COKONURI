<?php

// require_once '../config/db.php';
class Nasabah_model
{
    private $db;
    private $table = 'nasabah';

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllNasabah()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getNasabahById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' where id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // public function getAll()
    // {
    //     $query =
    //         $stmt = $this->db->prepare($query);
    //     $stmt->execute();
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // public function getById($id)
    // {
    //     $query = "SELECT * FROM nasabah WHERE id = :id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     $stmt->execute();
    //     return $stmt->fetch(PDO::FETCH_ASSOC);
    // }

    // public function create($data)
    // {
    //     $query = "INSERT INTO nasabah (nama, alamat, noTelp) VALUES (:nama, :alamat, :noTelp)";
    //     $stmt = $this->db->prepare($query);
    //     return $stmt->execute($data);
    // }

    // public function update($data)
    // {
    //     $query = "UPDATE nasabah SET nama = :nama, alamat = :alamat, noTelp = :noTelp WHERE id = :id";
    //     $stmt = $this->db->prepare($query);
    //     return $stmt->execute($data);
    // }

    // public function delete($id)
    // {
    //     $query = "DELETE FROM nasabah WHERE id = :id";
    //     $stmt = $this->db->prepare($query);
    //     $stmt->bindParam(':id', $id);
    //     return $stmt->execute();
    // }
}

// include("../../router/index.php");
// $model = new Nasabah_model($db);