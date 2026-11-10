<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Layanan;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use InvalidArgumentException;

class TransaksiController extends Controller
{
    private Transaksi $model;

    public function __construct()
    {
        $this->model = new Transaksi();
    }

    // GET ?r=transaksi
    public function index(): void
    {
        $this->view('transaksi/index', ['data' => $this->model->tampil()]);
    }

    // GET ?r=transaksi/create
    public function create(): void
    {
        $this->tampilForm('transaksi/create', null, [
            'trans_tgl_masuk' => date('Y-m-d'),
        ]);
    }

    // POST ?r=transaksi/store
    public function store(): void
    {
        try {
            $this->isiDari($_POST);
            $this->model->simpan();
            $this->redirect('transaksi', 'Data transaksi berhasil disimpan.');
        } catch (InvalidArgumentException $e) {
            $this->tampilForm('transaksi/create', $e->getMessage(), $_POST);
        }
    }

    // GET ?r=transaksi/edit&id=...
    public function edit(): void
    {
        $row = $this->model->cari((int) ($_GET['id'] ?? 0));

        if ($row === false) {
            $this->redirect('transaksi', 'Data tidak ditemukan.', 'danger');
        }

        $this->tampilForm('transaksi/edit', null, $row);
    }

    // POST ?r=transaksi/update
    public function update(): void
    {
        $id = (int) ($_POST['trans_id'] ?? 0);

        try {
            $this->isiDari($_POST);
            $this->model->update($id);
            $this->redirect('transaksi', 'Data transaksi berhasil diperbarui.');
        } catch (InvalidArgumentException $e) {
            $this->tampilForm('transaksi/edit', $e->getMessage(), $_POST);
        }
    }

    // POST ?r=transaksi/destroy
    public function destroy(): void
    {
        $id = (int) ($_POST['trans_id'] ?? 0);

        if ($id > 0) {
            $this->model->hapus($id);
        }

        $this->redirect('transaksi', 'Data transaksi berhasil dihapus.');
    }

    private function isiDari(array $input): void
    {
        $this->model->setPelanggan((int) ($input['trans_id_pelanggan'] ?? 0));
        $this->model->setLayanan((int) ($input['trans_id_layanan'] ?? 0));
        $this->model->setTanggal(
            $input['trans_tgl_masuk'] ?? '',
            $input['trans_tgl_selesai'] ?? ''
        );
        $this->model->setBerat($input['trans_berat'] ?? '');
    }

    // Form transaksi butuh daftar pelanggan dan layanan untuk <select>
    private function tampilForm(string $view, ?string $error, array $row): void
    {
        $this->view($view, [
            'error'           => $error,
            'row'             => $row,
            'daftarPelanggan' => (new Pelanggan())->tampil(),
            'daftarLayanan'   => (new Layanan())->tampil(),
        ]);
    }
}
