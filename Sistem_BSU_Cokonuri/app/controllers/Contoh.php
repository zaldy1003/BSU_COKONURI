<?php

class Contoh extends Controller_core
{
    public function index()
    {
        $this->loadView('Contoh/index');
    }

    // Jika ingin mengirim data
    //data yang dikirimkan nantinya akan dikirim dengan menggunakan method loadView dari controller_core
    public function page($nama = 'zaldy', $pekerjaan = 'programmer', $umur = 20)
    {
        $data['nama'] = $nama;
        
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $this->loadView('Components/header');
        $this->loadView('Contoh/page', $data);
    }
}
