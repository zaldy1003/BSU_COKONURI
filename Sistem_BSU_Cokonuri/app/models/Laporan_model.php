<?php

class Laporan_model
{
    private $db;
    private $table = 'transaksi_sampah';

    public function __construct()
    {
        $this->db = new Database;
    }


    public function getTransaksiByMonthYear($month, $year)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE MONTH(tanggalWaktu) = :month AND YEAR(tanggalWaktu) = :year');
        $this->db->bind('month', $month);
        $this->db->bind('year', $year);
        return $this->db->resultSet();
    }
    public function getJumlahTransaksi($month, $year)
    {
        $this->db->query('CALL tampilJumlahTransaksiperBulan( :month , :year );');
        $this->db->bind('month', $month);
        $this->db->bind('year', $year);
        return $this->db->single();
    }
    public function getJumlahPoin($month, $year)
    {
        $this->db->query('CALL tampilJumlahPoinperBulan( :month , :year );');
        $this->db->bind('month', $month);
        $this->db->bind('year', $year);
        return $this->db->single();
    }
    public function getJumlahBeratSampah($month, $year)
    {
        $this->db->query('CALL tampilJumlahBeratSampahperBulan( :month , :year );');
        $this->db->bind('month', $month);
        $this->db->bind('year', $year);
        return $this->db->single();
    }
    public function getTableLaporan($month, $year)
    {
        $this->db->query('CALL tampilTableLaporan( :month , :year );');
        $this->db->bind('month', $month);
        $this->db->bind('year', $year);
        return $this->db->resultSet();
    }






    // public function getTransaksiByMonthYear($month, $year)
    // {
    //     $query = "SELECT * 
    //               FROM transaksi_sampah
    //               WHERE MONTH(tanggalWaktu) = :month AND YEAR(tanggalWaktu) = :year";

    //     $statement = $this->db->prepare($query);
    //     $statement->bindParam(':month', $month, PDO::PARAM_INT);
    //     $statement->bindParam(':year', $year, PDO::PARAM_INT);
    //     $statement->execute();

    //     return $statement->fetchAll(PDO::FETCH_ASSOC); // Mengembalikan semua data dalam bentuk array
    // }
}
