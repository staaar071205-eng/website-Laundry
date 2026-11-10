<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class User
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Mengembalikan data pengguna jika username dan password benar
    public function login(string $username, string $password): array|false
    {
        $sql  = "SELECT * FROM tb_users
                 WHERE user_name = :user_name AND user_aktif = 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['user_name' => $username]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['user_password'])) {
            return $user;
        }

        return false;
    }
}
