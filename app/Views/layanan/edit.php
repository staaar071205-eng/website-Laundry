<h2 class="mb-3">Edit Layanan</h2>

<?php if ($error) : ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<div class="card" style="max-width: 40rem">
    <div class="card-body">
        <form action="?r=layanan/update" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="lay_id" value="<?= (int) ($row['lay_id'] ?? 0) ?>">
            <?php require __DIR__ . '/_form.php'; ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="?r=layanan" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
