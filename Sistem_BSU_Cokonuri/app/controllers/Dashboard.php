<?php
class Dashboard extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Dashboard page';
        $data['totalNasabah'] = $this->loadModel('Dashboard_model')->getTotalNasabah();
        $data['totalTransaksi'] = $this->loadModel('Dashboard_model')->getTotalTransaksi();
        $data['totalSampah'] = $this->loadModel('Dashboard_model')->getSampahTerbanyak();

        $this->loadView('Components/header', $data);
        $this->loadView('Dashboard/index', $data);
        $this->loadView('Components/footer');
    }
}