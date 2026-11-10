<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Data Layanan</h2>
    <a href="?r=layanan/create" class="btn btn-primary">+ Tambah</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Jenis Layanan</th>
                <th>Harga per Kg</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $row) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($row['lay_jenis']) ?></td>
                    <td><?= rupiah($row['lay_harga']) ?></td>
                    <td class="text-nowrap">
                        <a href="?r=layanan/edit&id=<?= (int) $row['lay_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="?r=layanan/destroy" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="lay_id" value="<?= (int) $row['lay_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data)) : ?>
                <tr><td colspan="4" class="text-center text-muted">Belum ada data layanan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
