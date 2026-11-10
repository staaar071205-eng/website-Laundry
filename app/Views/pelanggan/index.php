<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Data Pelanggan</h2>
    <a href="?r=pelanggan/create" class="btn btn-primary">+ Tambah</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No. HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $row) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($row['pel_nama']) ?></td>
                    <td><?= e($row['pel_alamat'] ?? '-') ?></td>
                    <td><?= e($row['pel_hp']) ?></td>
                    <td class="text-nowrap">
                        <a href="?r=pelanggan/edit&id=<?= (int) $row['pel_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="?r=pelanggan/destroy" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="pel_id" value="<?= (int) $row['pel_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data)) : ?>
                <tr><td colspan="5" class="text-center text-muted">Belum ada data pelanggan.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
