<?php
namespace App\Models;

use App\Core\Model;
use DateTime;
use InvalidArgumentException;

class Transaksi extends Model
{
    protected string $table = 'tb_transaksi';
    protected string $primaryKey = 'trans_id';

    private int $idPelanggan = 0;
    private int $idLayanan = 0;
    private int $harga = 0;
    private string $tglMasuk = '';
    private ?string $tglSelesai = null;
    private int $berat = 0;

    // Daftar transaksi digabung dengan nama pelanggan dan jenis layanan
    public function tampil(): array
    {
        $sql = "SELECT t.*, p.pel_nama, l.lay_jenis
                FROM tb_transaksi t
                JOIN tb_pelanggan p ON p.pel_id = t.trans_id_pelanggan
                JOIN tb_layanan l   ON l.lay_id = t.trans_id_layanan
                ORDER BY t.trans_id DESC";

        return $this->db->query($sql)->fetchAll();
    }

    public function setPelanggan(int $id): void
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM tb_pelanggan WHERE pel_id = :id");
        $stmt->execute(['id' => $id]);

        if ((int) $stmt->fetchColumn() === 0) {
            throw new InvalidArgumentException('Pelanggan wajib dipilih.');
        }

        $this->idPelanggan = $id;
    }

    // Harga layanan diambil dari database untuk menghitung total
    public function setLayanan(int $id): void
    {
        $stmt = $this->db->prepare("SELECT lay_harga FROM tb_layanan WHERE lay_id = :id");
        $stmt->execute(['id' => $id]);

        $harga = $stmt->fetchColumn();

        if ($harga === false) {
            throw new InvalidArgumentException('Layanan wajib dipilih.');
        }

        $this->idLayanan = $id;
        $this->harga     = (int) $harga;
    }

    public function setTanggal(string $masuk, string $selesai): void
    {
        $d1 = DateTime::createFromFormat('Y-m-d', $masuk);

        if (!$d1 || $d1->format('Y-m-d') !== $masuk) {
            throw new InvalidArgumentException('Tanggal masuk tidak valid.');
        }

        $this->tglMasuk = $masuk;

        // Tanggal selesai boleh kosong (cucian belum selesai)
        if ($selesai === '') {
            $this->tglSelesai = null;
            return;
        }

        $d2 = DateTime::createFromFormat('Y-m-d', $selesai);

        if (!$d2 || $d2->format('Y-m-d') !== $selesai) {
            throw new InvalidArgumentException('Tanggal selesai tidak valid.');
        }

        if ($d2 < $d1) {
            throw new InvalidArgumentException('Tanggal selesai tidak boleh sebelum tanggal masuk.');
        }

        $this->tglSelesai = $selesai;
    }

    public function setBerat(string $berat): void
    {
        $berat = trim($berat);

        if (!ctype_digit($berat) || (int) $berat < 1) {
            throw new InvalidArgumentException('Berat minimal 1 kg dan harus berupa angka bulat.');
        }

        $this->berat = (int) $berat;
    }

    // Total dihitung di sini: berat x harga layanan
    protected function data(): array
    {
        return [
            'trans_id_pelanggan' => $this->idPelanggan,
            'trans_id_layanan'   => $this->idLayanan,
            'trans_tgl_masuk'    => $this->tglMasuk,
            'trans_tgl_selesai'  => $this->tglSelesai,
            'trans_berat'        => $this->berat,
            'trans_total'        => $this->berat * $this->harga,
        ];
    }
}
