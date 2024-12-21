<?php

class Dashboard_model
{
    private $db;
    private $table1 = 'transaksi_sampah';
    private $table2 = 'nasabah';
    public function __construct()
    {
        $this->db = new Database;
    }

    public function getTotalNasabah()
    {
        $this->db->query('CALL hitungNasabah();');
        return $this->db->single();
    }

    public function getTotalTransaksi()
    {
        $this->db->query('CALL hitungTotalTransaksi();');
        return $this->db->single();
    }

    public function getSampahTerbanyak()
    {
        $this->db->query('CALL tampilTransaksiSampahTerbanyak();');
        return $this->db->single();
    }
}


