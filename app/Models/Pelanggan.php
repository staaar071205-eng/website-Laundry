<?php
namespace App\Models;

use App\Core\Model;
use InvalidArgumentException;

class Pelanggan extends Model
{
    protected string $table = 'tb_pelanggan';
    protected string $primaryKey = 'pel_id';

    private string $nama = '';
    private string $alamat = '';
    private string $hp = '';

    public function setNama(string $nama): void
    {
        $nama = trim($nama);

        if ($nama === '' || mb_strlen($nama) > 100) {
            throw new InvalidArgumentException('Nama wajib diisi dan maksimal 100 karakter.');
        }

        $this->nama = $nama;
    }

    public function setAlamat(string $alamat): void
    {
        $this->alamat = trim($alamat);
    }

    public function setHp(string $hp): void
    {
        $hp = trim($hp);

        if (!preg_match('/^[0-9+\-\s]{5,30}$/', $hp)) {
            throw new InvalidArgumentException('No. HP harus berupa angka (5 sampai 30 karakter).');
        }

        $this->hp = $hp;
    }

    protected function data(): array
    {
        return [
            'pel_nama'   => $this->nama,
            'pel_alamat' => $this->alamat === '' ? null : $this->alamat,
            'pel_hp'     => $this->hp,
        ];
    }
}
