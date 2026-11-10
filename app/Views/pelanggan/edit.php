<h2 class="mb-3">Edit Pelanggan</h2>

<?php if ($error) : ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<div class="card" style="max-width: 40rem">
    <div class="card-body">
        <form action="?r=pelanggan/update" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="pel_id" value="<?= (int) ($row['pel_id'] ?? 0) ?>">
            <?php require __DIR__ . '/_form.php'; ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="?r=pelanggan" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
