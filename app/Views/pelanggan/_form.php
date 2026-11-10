<div class="mb-3">
    <label for="pel_nama" class="form-label">Nama</label>
    <input type="text" class="form-control" name="pel_nama" id="pel_nama"
           value="<?= e($row['pel_nama'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="pel_alamat" class="form-label">Alamat</label>
    <textarea class="form-control" name="pel_alamat" id="pel_alamat" rows="3"><?= e($row['pel_alamat'] ?? '') ?></textarea>
</div>
<div class="mb-3">
    <label for="pel_hp" class="form-label">No. HP</label>
    <input type="text" class="form-control" name="pel_hp" id="pel_hp"
           value="<?= e($row['pel_hp'] ?? '') ?>" required>
</div>
