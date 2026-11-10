<h2 class="mb-3">Tambah Layanan</h2>

<?php if ($error) : ?>
    <div class="alert alert-danger"><?= e($error) ?></div>
<?php endif; ?>

<div class="card" style="max-width: 40rem">
    <div class="card-body">
        <form action="?r=layanan/store" method="POST">
            <?= csrf_field() ?>
            <?php require __DIR__ . '/_form.php'; ?>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="?r=layanan" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
