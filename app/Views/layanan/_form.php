<div class="mb-3">
    <label for="lay_jenis" class="form-label">Jenis Layanan</label>
    <input type="text" class="form-control" name="lay_jenis" id="lay_jenis"
           value="<?= e($row['lay_jenis'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="lay_harga" class="form-label">Harga per Kg (Rp)</label>
    <input type="number" class="form-control" name="lay_harga" id="lay_harga" min="0"
           value="<?= e((string) ($row['lay_harga'] ?? '')) ?>" required>
</div>
