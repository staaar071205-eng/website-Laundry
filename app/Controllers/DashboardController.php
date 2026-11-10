<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    // GET ?r=dashboard
    public function index(): void
    {
        $transaksi = (new Transaksi())->tampil();

        $this->view('dashboard', [
            'jmlPelanggan' => count((new Pelanggan())->tampil()),
            'jmlLayanan'   => count((new Layanan())->tampil()),
            'jmlTransaksi' => count($transaksi),
            'pendapatan'   => array_sum(array_column($transaksi, 'trans_total')),
            'terbaru'      => array_slice($transaksi, 0, 5),
        ]);
    }
}
