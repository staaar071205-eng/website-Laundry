<div class="mb-3">
    <label for="trans_id_pelanggan" class="form-label">Pelanggan</label>
    <select class="form-select" name="trans_id_pelanggan" id="trans_id_pelanggan" required>
        <option value="">Pilih pelanggan...</option>
        <?php foreach ($daftarPelanggan as $p) : ?>
            <option value="<?= (int) $p['pel_id'] ?>"
                <?= (int) ($row['trans_id_pelanggan'] ?? 0) === (int) $p['pel_id'] ? 'selected' : '' ?>>
                <?= e($p['pel_nama']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label for="trans_id_layanan" class="form-label">Layanan</label>
    <select class="form-select" name="trans_id_layanan" id="trans_id_layanan" required>
        <option value="">Pilih layanan...</option>
        <?php foreach ($daftarLayanan as $l) : ?>
            <option value="<?= (int) $l['lay_id'] ?>"
                <?= (int) ($row['trans_id_layanan'] ?? 0) === (int) $l['lay_id'] ? 'selected' : '' ?>>
                <?= e($l['lay_jenis']) ?> (<?= rupiah($l['lay_harga']) ?>/kg)
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="trans_tgl_masuk" class="form-label">Tanggal Masuk</label>
        <input type="date" class="form-control" name="trans_tgl_masuk" id="trans_tgl_masuk"
               value="<?= e($row['trans_tgl_masuk'] ?? '') ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="trans_tgl_selesai" class="form-label">Tanggal Selesai</label>
        <input type="date" class="form-control" name="trans_tgl_selesai" id="trans_tgl_selesai"
               value="<?= e($row['trans_tgl_selesai'] ?? '') ?>">
    </div>
</div>

<div class="mb-3">
    <label for="trans_berat" class="form-label">Berat (Kg)</label>
    <input type="number" class="form-control" name="trans_berat" id="trans_berat" min="1"
           value="<?= e((string) ($row['trans_berat'] ?? '')) ?>" required>
    <div class="form-text">Total dihitung otomatis: berat &times; harga layanan.</div>
</div>
