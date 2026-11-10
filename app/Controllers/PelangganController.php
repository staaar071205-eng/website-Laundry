<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Pelanggan;
use InvalidArgumentException;
use PDOException;

class PelangganController extends Controller
{
    private Pelanggan $model;

    public function __construct()
    {
        $this->model = new Pelanggan();
    }

    // GET ?r=pelanggan
    public function index(): void
    {
        $this->view('pelanggan/index', ['data' => $this->model->tampil()]);
    }

    // GET ?r=pelanggan/create
    public function create(): void
    {
        $this->view('pelanggan/create', ['error' => null, 'row' => []]);
    }

    // POST ?r=pelanggan/store
    public function store(): void
    {
        try {
            $this->isiDari($_POST);
            $this->model->simpan();
            $this->redirect('pelanggan', 'Data pelanggan berhasil disimpan.');
        } catch (InvalidArgumentException $e) {
            $this->view('pelanggan/create', ['error' => $e->getMessage(), 'row' => $_POST]);
        }
    }

    // GET ?r=pelanggan/edit&id=...
    public function edit(): void
    {
        $row = $this->model->cari((int) ($_GET['id'] ?? 0));

        if ($row === false) {
            $this->redirect('pelanggan', 'Data tidak ditemukan.', 'danger');
        }

        $this->view('pelanggan/edit', ['error' => null, 'row' => $row]);
    }

    // POST ?r=pelanggan/update
    public function update(): void
    {
        $id = (int) ($_POST['pel_id'] ?? 0);

        try {
            $this->isiDari($_POST);
            $this->model->update($id);
            $this->redirect('pelanggan', 'Data pelanggan berhasil diperbarui.');
        } catch (InvalidArgumentException $e) {
            $this->view('pelanggan/edit', ['error' => $e->getMessage(), 'row' => $_POST]);
        }
    }

    // POST ?r=pelanggan/destroy
    public function destroy(): void
    {
        $id = (int) ($_POST['pel_id'] ?? 0);

        try {
            if ($id > 0) {
                $this->model->hapus($id);
            }
        } catch (PDOException $e) {
            // 23000 = masih dipakai di tb_transaksi (foreign key)
            if ($e->getCode() !== '23000') {
                throw $e;
            }

            $this->redirect('pelanggan', 'Pelanggan tidak dapat dihapus karena masih memiliki transaksi.', 'danger');
        }

        $this->redirect('pelanggan', 'Data pelanggan berhasil dihapus.');
    }

    // Mengisi model dari input formulir (validasi terjadi di setter)
    private function isiDari(array $input): void
    {
        $this->model->setNama($input['pel_nama'] ?? '');
        $this->model->setAlamat($input['pel_alamat'] ?? '');
        $this->model->setHp($input['pel_hp'] ?? '');
    }
}
