<?php
class Riwayat_transaksi extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Riwayat transaksi page';
        $this->loadView('Components/header', $data);
        $this->loadView('Riwayat_transaksi/index');
        $this->loadView('Components/footer');
    }
}