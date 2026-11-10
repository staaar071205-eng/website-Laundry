<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller
{
    // GET ?r=login
    public function login(): void
    {
        if (isset($_SESSION['user'])) {
            $this->redirect('dashboard');
        }

        $this->view('auth/login', ['error' => null, 'old' => ''], '');
    }

    // POST ?r=login/proses
    public function proses(): void
    {
        $username = trim($_POST['user_name'] ?? '');
        $password = $_POST['password'] ?? '';

        $user = (new User())->login($username, $password);

        if ($user === false) {
            $this->view('auth/login', [
                'error' => 'Username atau password salah.',
                'old'   => $username,
            ], '');
            return;
        }

        // ganti ID session setelah login (mencegah session fixation)
        session_regenerate_id(true);

        $_SESSION['user'] = [
            'id'   => (int) $user['user_id'],
            'nama' => $user['user_namalengkap'],
        ];

        $this->redirect('dashboard');
    }

    // POST ?r=logout
    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header('Location: ?r=login');
        exit;
    }
}
