<?php
class Transaksi_sampah_model
{
    private $db;
    private $table = 'Pengaturan_transaksi';
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getJenisSampah()
    {
        $this->db->query('CALL tampilSampah();');
        return $this->db->resultSet();
    }
}