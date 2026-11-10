<h2 class="mb-4">Dashboard</h2>

<div class="row g-3 mb-4">
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-bg-primary"><div class="card-body">
            <div class="small">Jumlah Pelanggan</div>
            <div class="fs-2 fw-bold"><?= $jmlPelanggan ?></div>
        </div></div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-bg-success"><div class="card-body">
            <div class="small">Jenis Layanan</div>
            <div class="fs-2 fw-bold"><?= $jmlLayanan ?></div>
        </div></div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-bg-warning"><div class="card-body">
            <div class="small">Jumlah Transaksi</div>
            <div class="fs-2 fw-bold"><?= $jmlTransaksi ?></div>
        </div></div>
    </div>
    <div class="col-12 col-md-6 col-xl-3">
        <div class="card text-bg-danger"><div class="card-body">
            <div class="small">Total Pendapatan</div>
            <div class="fs-2 fw-bold"><?= rupiah($pendapatan) ?></div>
        </div></div>
    </div>
</div>

<div class="card">
    <div class="card-header fw-semibold">Transaksi Terbaru</div>
    <ul class="list-group list-group-flush">
        <?php if (!empty($terbaru)) : ?>
            <?php foreach ($terbaru as $t) : ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span><?= e($t['pel_nama']) ?> &middot; <?= e($t['lay_jenis']) ?></span>
                    <span class="badge text-bg-secondary"><?= rupiah($t['trans_total']) ?></span>
                </li>
            <?php endforeach; ?>
        <?php else : ?>
            <li class="list-group-item text-muted">Belum ada transaksi.</li>
        <?php endif; ?>
    </ul>
</div>
