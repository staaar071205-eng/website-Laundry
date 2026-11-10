<?php
$user  = $_SESSION['user'] ?? null;
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$r     = $_GET['r'] ?? 'dashboard';
$aktif = fn(string $awal) => str_starts_with($r, $awal) ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Laundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="?r=dashboard">LAUNDRY</a>
            <button class="navbar-toggler" type="button"
                    data-bs-toggle="collapse" data-bs-target="#menuUtama">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menuUtama">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link <?= $aktif('dashboard') ?>" href="?r=dashboard">Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link <?= $aktif('pelanggan') ?>" href="?r=pelanggan">Pelanggan</a></li>
                    <li class="nav-item"><a class="nav-link <?= $aktif('layanan') ?>" href="?r=layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link <?= $aktif('transaksi') ?>" href="?r=transaksi">Transaksi</a></li>
                </ul>

                <span class="navbar-text me-3"><?= e($user['nama'] ?? '') ?></span>
                <form action="?r=logout" method="POST" class="d-inline">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        <?php if ($flash) : ?>
            <div class="alert alert-<?= e($flash['jenis']) ?> alert-dismissible fade show">
                <?= e($flash['pesan']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php require $konten; ?>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
