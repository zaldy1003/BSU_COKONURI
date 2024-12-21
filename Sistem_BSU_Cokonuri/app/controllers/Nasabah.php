<?php

class Nasabah extends Controller_core
{
    // private $model;

    // public function __construct($model)
    // {
    //     $this->model = $model;
    // }

    // public function index()
    // {
    // Panggil data dari model
    // $nasabahData = $this->model->getAll();

    // Kirim data ke view
    //     include '../../app/views/Kelola_nasabah/index.php';
    // }

    public function index()
    {
        $data['judul'] = 'Nasabah page';
        $data['nasabah'] = $this->loadModel('Nasabah_model')->getAllNasabah();
        $this->loadView('Components/header', $data);
        $this->loadView('Nasabah/index', $data);
        $this->loadView('Components/footer');
    }
    public function detail($id)
    {
        $data1['judul'] = 'Detail Nasabah page';
        $data2['nasabah'] = $this->loadModel('Nasabah_model')->getNasabahById($id);
        $this->loadView('Components/header', $data1);
        $this->loadView('Nasabah/detail', $data2);
        $this->loadView('Components/footer');
    }



}
