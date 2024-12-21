<?php
class Pengelola extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Pengelola page';
        $data['pengelola'] = $this->loadModel('Pengelola_model')->getAllPengelola();
        $this->loadView('Components/header', $data);
        $this->loadView('Pengelola/index', $data);
        $this->loadView('Components/footer');
    }

    // belum ada pengelola detail
    public function detail($id)
    {
        $data['judul'] = 'Detail Nasabah page';
        $data['pengelola'] = $this->loadModel('Pengelola_model')->getPengelolaById($id);
        $this->loadView('Components/header', $data);
        $this->loadView('Pengelola/detail', $data);
        $this->loadView('Components/footer');
    }
}