<?php
namespace App\Core;

use PDO;

abstract class Model
{
    protected PDO $db;
    protected string $table = '';
    protected string $primaryKey = 'id';

    public function __construct()
    {
        $this->db = Database::connect();
    }

    // Wajib diisi child class: pasangan nama kolom => nilai
    abstract protected function data(): array;

    public function tampil(): array
    {
        $sql = "SELECT * FROM {$this->table}
                ORDER BY {$this->primaryKey} DESC";

        return $this->db->query($sql)->fetchAll();
    }

    public function cari(int $id): array|false
    {
        $sql  = "SELECT * FROM {$this->table}
                 WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function hapus(int $id): void
    {
        $sql  = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    // INSERT INTO tabel (kolom1, kolom2) VALUES (:kolom1, :kolom2)
    public function simpan(): void
    {
        $data  = $this->data();
        $kolom = [];
        $param = [];

        foreach (array_keys($data) as $nama) {
            $kolom[] = $nama;
            $param[] = ":{$nama}";
        }

        $sql = "INSERT INTO {$this->table} (" . implode(', ', $kolom) . ")
                VALUES (" . implode(', ', $param) . ")";

        $this->db->prepare($sql)->execute($data);
    }

    // UPDATE tabel SET kolom1 = :kolom1, kolom2 = :kolom2 WHERE pk = :pk_id
    public function update(int $id): void
    {
        $data = $this->data();
        $set  = [];

        foreach (array_keys($data) as $nama) {
            $set[] = "{$nama} = :{$nama}";
        }

        $sql = "UPDATE {$this->table} SET " . implode(', ', $set)
             . " WHERE {$this->primaryKey} = :pk_id";

        $data['pk_id'] = $id;
        $this->db->prepare($sql)->execute($data);
    }
}
