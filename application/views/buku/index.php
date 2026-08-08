<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-journals"></i> Daftar Buku</h4>
    <a href="<?= base_url('buku/create') ?>" class="btn btn-success">
        <i class="bi bi-plus-circle"></i> Tambah Buku
    </a>
</div>

<div class="card p-3 mb-3">
    <?= form_open('buku', ['method' => 'get', 'class' => 'row g-2']) ?>
        <div class="col-md-9">
            <input type="text" name="keyword" class="form-control"
                   placeholder="Cari judul, penulis, penerbit, atau kategori..."
                   value="<?= htmlspecialchars($keyword) ?>">
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    <?= form_close() ?>
    <?php if (!empty($keyword)): ?>
        <div class="mt-2">
            <span class="badge bg-info text-dark">Hasil pencarian: "<?= htmlspecialchars($keyword) ?>"</span>
            <a href="<?= base_url('buku') ?>" class="ms-2 small">Reset pencarian</a>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($buku_list)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-inbox"></i> Tidak ada data buku ditemukan.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($buku_list as $buku): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= htmlspecialchars($buku['judul']) ?></td>
                        <td><?= htmlspecialchars($buku['penulis']) ?></td>
                        <td><?= htmlspecialchars($buku['penerbit']) ?></td>
                        <td><?= htmlspecialchars($buku['tahun_terbit']) ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($buku['kategori']) ?></span></td>
                        <td>
                            <?php if ($buku['stok'] > 0): ?>
                                <span class="badge bg-success"><?= $buku['stok'] ?></span>
                            <?php else: ?>
                                <span class="badge bg-danger">Habis</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="<?= base_url('buku/detail/' . $buku['id']) ?>" class="btn btn-sm btn-outline-info" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="<?= base_url('buku/edit/' . $buku['id']) ?>" class="btn btn-sm btn-outline-warning" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="<?= base_url('buku/delete/' . $buku['id']) ?>" class="btn btn-sm btn-outline-danger"
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus buku \'<?= htmlspecialchars(addslashes($buku['judul'])) ?>\'?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-3">
    <small class="text-muted">Total data: <?= $total_rows ?> buku</small>
    <nav><?= $pagination ?></nav>
</div>
