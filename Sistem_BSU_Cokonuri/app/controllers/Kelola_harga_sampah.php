<?php
class Kelola_harga_sampah extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Kelola_harga_sampah page';
        $data['jenisSampah'] = $this->loadModel('Kelola_harga_sampah_model')->getJenisSampah();
        $this->loadView('Components/header', $data);
        $this->loadView('Kelola_harga_sampah/index', $data);
        $this->loadView('Components/footer');
    }
}