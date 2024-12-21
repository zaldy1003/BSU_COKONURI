<?php
class Transaksi extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Transaksi page';
        $data['jenisSampah'] = $this->loadModel('Transaksi_sampah_model')->getJenisSampah();
        $this->loadView('Components/header', $data);
        $this->loadView('Transaksi/index', $data);
        $this->loadView('Components/footer');
    }
}