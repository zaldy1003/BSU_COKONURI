<?php

class App_core
{
    // Variabel untuk membuat controller, method, dan params default
    protected $controller = 'login';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURl();

        // CONTROLLER CONFIGURATION
        if (isset($url[0]) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0];
            unset($url[0]);
        }

        // Memuat file controller
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // METHOD CONFIGURATION
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // PARAMS
        $this->params = !empty($url) ? array_values($url) : [];

        // Menjalankan controller, method, dan params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURl()
    {
        if (isset($_GET['url'])) {
            $a = rtrim($_GET['url'], '/'); // Menghilangkan karakter '/' di akhir
            $a = filter_var($a, FILTER_SANITIZE_URL); // Membersihkan URL
            $a = explode('/', $a); // Memisahkan URL menjadi array
            return $a;
        }
        return []; // Jika URL kosong, kembalikan array kosong
    }
}
