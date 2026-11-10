<?php
// Front controller: satu-satunya pintu masuk aplikasi

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\LayananController;
use App\Controllers\PelangganController;
use App\Controllers\TransaksiController;
use App\Core\Router;

Dotenv\Dotenv::createImmutable(__DIR__ . '/..')->load();
session_start();

$router = new Router();

// Tabel route: (method HTTP, path) => [Controller, method]
$router->get('login', [AuthController::class, 'login']);
$router->post('login/proses', [AuthController::class, 'proses']);
$router->post('logout', [AuthController::class, 'logout']);

$router->get('dashboard', [DashboardController::class, 'index']);

$router->get('pelanggan', [PelangganController::class, 'index']);
$router->get('pelanggan/create', [PelangganController::class, 'create']);
$router->post('pelanggan/store', [PelangganController::class, 'store']);
$router->get('pelanggan/edit', [PelangganController::class, 'edit']);
$router->post('pelanggan/update', [PelangganController::class, 'update']);
$router->post('pelanggan/destroy', [PelangganController::class, 'destroy']);

$router->get('layanan', [LayananController::class, 'index']);
$router->get('layanan/create', [LayananController::class, 'create']);
$router->post('layanan/store', [LayananController::class, 'store']);
$router->get('layanan/edit', [LayananController::class, 'edit']);
$router->post('layanan/update', [LayananController::class, 'update']);
$router->post('layanan/destroy', [LayananController::class, 'destroy']);

$router->get('transaksi', [TransaksiController::class, 'index']);
$router->get('transaksi/create', [TransaksiController::class, 'create']);
$router->post('transaksi/store', [TransaksiController::class, 'store']);
$router->get('transaksi/edit', [TransaksiController::class, 'edit']);
$router->post('transaksi/update', [TransaksiController::class, 'update']);
$router->post('transaksi/destroy', [TransaksiController::class, 'destroy']);

$method = $_SERVER['REQUEST_METHOD'];
$path   = $_GET['r'] ?? 'dashboard';

// Hanya halaman login yang boleh dibuka tanpa login
$halamanPublik = ['login', 'login/proses'];

if (!isset($_SESSION['user']) && !in_array($path, $halamanPublik, true)) {
    header('Location: ?r=login');
    exit;
}

// Setiap formulir POST harus membawa token CSRF yang benar
if ($method === 'POST' && !csrf_valid()) {
    http_response_code(419);
    die('Token tidak valid. Muat ulang halaman lalu coba lagi.');
}

$router->dispatch($method, $path);
