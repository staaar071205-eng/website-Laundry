<?php
namespace App\Models;

use App\Core\Model;
use InvalidArgumentException;

class Layanan extends Model
{
    protected string $table = 'tb_layanan';
    protected string $primaryKey = 'lay_id';

    private string $jenis = '';
    private int $harga = 0;

    public function setJenis(string $jenis): void
    {
        $jenis = trim($jenis);

        if ($jenis === '' || mb_strlen($jenis) > 100) {
            throw new InvalidArgumentException('Jenis layanan wajib diisi dan maksimal 100 karakter.');
        }

        $this->jenis = $jenis;
    }

    public function setHarga(string $harga): void
    {
        $harga = trim($harga);

        if (!ctype_digit($harga)) {
            throw new InvalidArgumentException('Harga harus berupa angka bulat.');
        }

        $this->harga = (int) $harga;
    }

    protected function data(): array
    {
        return [
            'lay_jenis' => $this->jenis,
            'lay_harga' => $this->harga,
        ];
    }
}
