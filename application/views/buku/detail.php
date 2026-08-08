<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-book"></i> Detail Buku</h4>
    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card p-4">
    <h3><?= htmlspecialchars($buku['judul']) ?></h3>
    <span class="badge bg-secondary mb-3"><?= htmlspecialchars($buku['kategori']) ?></span>

    <table class="table table-borderless w-auto">
        <tr><th class="pe-4">Penulis</th><td>: <?= htmlspecialchars($buku['penulis']) ?></td></tr>
        <tr><th class="pe-4">Penerbit</th><td>: <?= htmlspecialchars($buku['penerbit']) ?></td></tr>
        <tr><th class="pe-4">Tahun Terbit</th><td>: <?= htmlspecialchars($buku['tahun_terbit']) ?></td></tr>
        <tr><th class="pe-4">Stok</th><td>: <?= (int) $buku['stok'] ?></td></tr>
    </table>

    <h6>Sinopsis</h6>
    <p class="text-muted"><?= nl2br(htmlspecialchars($buku['sinopsis'] ?: '-')) ?></p>

    <div class="mt-3">
        <a href="<?= base_url('buku/edit/' . $buku['id']) ?>" class="btn btn-warning">
            <i class="bi bi-pencil-square"></i> Edit
        </a>
        <a href="<?= base_url('buku/delete/' . $buku['id']) ?>" class="btn btn-danger"
           onclick="return confirm('Yakin ingin menghapus buku ini?');">
            <i class="bi bi-trash"></i> Hapus
        </a>
    </div>
</div>
