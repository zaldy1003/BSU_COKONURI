<?php
class Login extends Controller_core
{
    public function index()
    {
        $data['judul'] = 'Login page';

        // Mengecek apakah data POST 'username' dan 'password' ada
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Menangkap data dari form
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                // Validasi input
                if (empty($username) || empty($password)) {
                    // Kirim pesan error jika ada input yang kosong
                    echo "Username atau Password tidak boleh kosong.";
                    return;
                }

                // Cek kredensial pengguna (misalnya, terhadap database)
                $this->loginUser($username, $password);
            } else {
                echo "<script>alert('Username atau Password tidak ditemukan.');</script>";
            }

        }

        $this->loadView('Login/index', $data);
    }


    private function loginUser($username, $password)
    {
        // Memuat model dan mendapatkan data pengguna
        $userModel = $this->loadModel('Login_model');
        $user = $userModel->getUserByUsername($username);

        // Cek apakah pengguna ditemukan dan password cocok
        if ($user && $password === $user['password']) {
            // Jika login berhasil, atur session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect ke halaman dashboard
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        } else {
            // Jika login gagal
            echo "<script>alert('Username atau Password salah.');</script>";
        }
    }


    // Fungsi untuk memuat model
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}