<?php
class Laporan extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Laporan Bulanan';
        $data['post'] = $_POST;

        // Pastikan ada data bulan dan tahun yang dikirim
        if (isset($_POST['month'], $_POST['year'])) {
            $data['time'] = $this->loadModel('Laporan_model')->getTransaksiByMonthYear($_POST['month'], $_POST['year']);
            $data['jumlahTransaksi'] = $this->loadModel('Laporan_model')->getJumlahTransaksi($_POST['month'], $_POST['year']);
            $data['jumlahPoin'] = $this->loadModel('Laporan_model')->getJumlahPoin($_POST['month'], $_POST['year']);
            $data['jumlahBerat'] = $this->loadModel('Laporan_model')->getJumlahBeratSampah($_POST['month'], $_POST['year']);
            $data['tableLaporan'] = $this->loadModel('Laporan_model')->getTableLaporan($_POST['month'], $_POST['year']);
        } else {
            // Jika tidak ada, bisa kosongkan data
            $data['time'] = $this->loadModel('Laporan_model')->getTransaksiByMonthYear('12', '2024');
            $data['jumlahTransaksi'] = $this->loadModel('Laporan_model')->getJumlahTransaksi('12', '2024');
            $data['jumlahPoin'] = $this->loadModel('Laporan_model')->getJumlahPoin('12', '2024');
            $data['jumlahBerat'] = $this->loadModel('Laporan_model')->getJumlahBeratSampah('12', '2024');
            $data['tableLaporan'] = $this->loadModel('Laporan_model')->getTableLaporan('12', '2024');
        }

        $this->loadView('Components/header', $data);
        $this->loadView('Laporan/index', $data);
        $this->loadView('Components/footer');
    }
    // Ambil parameter bulan dan tahun dari query string
    // $data['month'] = $_GET['month'] ?? null;
    // $data['year'] = $_GET['year'] ?? null;

    // var_dump($data);


    // // Jika bulan dan tahun diberikan, ambil data dari model
    // if ($data['month'] && $data['year']) {
    //     $laporanModel = $this->loadModel('Laporan_model');

    //     // Ambil summary
    //     $summary = $laporanModel->getSummaryByMonthYear($data['month'], $data['year']);
    //     if ($summary) {
    //         $data['summary'] = $summary;
    //     }

    //     // Ambil detail laporan
    //     $data['details'] = $laporanModel->getLaporanByMonthYear($data['month'], $data['year']);
    // }

    public function showData()
    {
        $data['judul'] = 'Laporan Bulanan';

        $data['time'] = $this->loadModel('Laporan_model')->getTransaksiByMonthYear($_POST);

        $this->loadView('Components/header', $data);
        $this->loadView('Laporan/index', $data);
        $this->loadView('Components/footer');
    }

    public function insertData()
    {
        if ($this->loadModel('Laporan_model')->getTransaksiByMonthYear($_POST) > 0) {
            header('Lovation: ' . BASEURL . '/Laporan');
            exit;
        }
    }
}
