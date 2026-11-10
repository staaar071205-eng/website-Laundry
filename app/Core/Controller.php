<?php
namespace App\Core;

abstract class Controller
{
    // Menampilkan view di dalam layout ($layout kosong = tanpa layout).
    // Nama parameter sengaja dibuat khusus agar tidak bentrok dengan
    // variabel dari controller (misalnya 'data', 'row', 'error').
    protected function view(string $namaView, array $dataView = [], string $layout = 'layout'): void
    {
        extract($dataView, EXTR_SKIP);
        $konten = __DIR__ . "/../Views/{$namaView}.php";

        if ($layout === '') {
            require $konten;
            return;
        }

        require __DIR__ . "/../Views/{$layout}.php";
    }

    // Mengalihkan ke route lain, opsional dengan pesan
    protected function redirect(string $route, ?string $pesan = null, string $jenis = 'success'): never
    {
        if ($pesan !== null) {
            $_SESSION['flash'] = ['jenis' => $jenis, 'pesan' => $pesan];
        }

        header("Location: ?r={$route}");
        exit;
    }
}