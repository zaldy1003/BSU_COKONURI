<?php
class Pengaturan_sistem extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Pengaturan sistem page';
        $this->loadView('Components/header', $data);
        $this->loadView('Pengaturan_sistem/index');
        $this->loadView('Components/footer');
    }
}