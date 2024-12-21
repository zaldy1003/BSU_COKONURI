<?php
class Login_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByUsername($username)
    {
        $this->db->query('SELECT * FROM pengelola WHERE username = :username');
        $this->db->bind(':username', $username);

        // Mengembalikan data pengguna (user) yang sesuai dengan username
        $user = $this->db->single();
        return $user;
    }
}


