<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Data Transaksi</h2>
    <a href="?r=transaksi/create" class="btn btn-primary">+ Tambah</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered table-striped bg-white align-middle">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Layanan</th>
                <th>Tgl Masuk</th>
                <th>Tgl Selesai</th>
                <th>Berat (Kg)</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $i => $row) : ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($row['pel_nama']) ?></td>
                    <td><?= e($row['lay_jenis']) ?></td>
                    <td><?= date('d-m-Y', strtotime($row['trans_tgl_masuk'])) ?></td>
                    <td><?= $row['trans_tgl_selesai'] ? date('d-m-Y', strtotime($row['trans_tgl_selesai'])) : '-' ?></td>
                    <td><?= (int) $row['trans_berat'] ?></td>
                    <td><?= rupiah($row['trans_total']) ?></td>
                    <td class="text-nowrap">
                        <a href="?r=transaksi/edit&id=<?= (int) $row['trans_id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="?r=transaksi/destroy" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin hapus data ini?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="trans_id" value="<?= (int) $row['trans_id'] ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($data)) : ?>
                <tr><td colspan="8" class="text-center text-muted">Belum ada data transaksi.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
