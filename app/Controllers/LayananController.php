<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Layanan;
use InvalidArgumentException;
use PDOException;

class LayananController extends Controller
{
    private Layanan $model;

    public function __construct()
    {
        $this->model = new Layanan();
    }

    // GET ?r=layanan
    public function index(): void
    {
        $this->view('layanan/index', ['data' => $this->model->tampil()]);
    }

    // GET ?r=layanan/create
    public function create(): void
    {
        $this->view('layanan/create', ['error' => null, 'row' => []]);
    }

    // POST ?r=layanan/store
    public function store(): void
    {
        try {
            $this->isiDari($_POST);
            $this->model->simpan();
            $this->redirect('layanan', 'Data layanan berhasil disimpan.');
        } catch (InvalidArgumentException $e) {
            $this->view('layanan/create', ['error' => $e->getMessage(), 'row' => $_POST]);
        }
    }

    // GET ?r=layanan/edit&id=...
    public function edit(): void
    {
        $row = $this->model->cari((int) ($_GET['id'] ?? 0));

        if ($row === false) {
            $this->redirect('layanan', 'Data tidak ditemukan.', 'danger');
        }

        $this->view('layanan/edit', ['error' => null, 'row' => $row]);
    }

    // POST ?r=layanan/update
    public function update(): void
    {
        $id = (int) ($_POST['lay_id'] ?? 0);

        try {
            $this->isiDari($_POST);
            $this->model->update($id);
            $this->redirect('layanan', 'Data layanan berhasil diperbarui.');
        } catch (InvalidArgumentException $e) {
            $this->view('layanan/edit', ['error' => $e->getMessage(), 'row' => $_POST]);
        }
    }

    // POST ?r=layanan/destroy
    public function destroy(): void
    {
        $id = (int) ($_POST['lay_id'] ?? 0);

        try {
            if ($id > 0) {
                $this->model->hapus($id);
            }
        } catch (PDOException $e) {
            if ($e->getCode() !== '23000') {
                throw $e;
            }

            $this->redirect('layanan', 'Layanan tidak dapat dihapus karena masih dipakai pada transaksi.', 'danger');
        }

        $this->redirect('layanan', 'Data layanan berhasil dihapus.');
    }

    private function isiDari(array $input): void
    {
        $this->model->setJenis($input['lay_jenis'] ?? '');
        $this->model->setHarga($input['lay_harga'] ?? '');
    }
}
