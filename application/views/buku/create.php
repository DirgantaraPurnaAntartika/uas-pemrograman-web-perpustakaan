<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><i class="bi bi-plus-circle"></i> Tambah Buku Baru</h4>
    <a href="<?= base_url('buku') ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card p-4">
    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

    <?= form_open('buku/create') ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Judul Buku <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control" value="<?= set_value('judul') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Penulis <span class="text-danger">*</span></label>
                <input type="text" name="penulis" class="form-control" value="<?= set_value('penulis') ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Penerbit <span class="text-danger">*</span></label>
                <input type="text" name="penerbit" class="form-control" value="<?= set_value('penerbit') ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Tahun Terbit <span class="text-danger">*</span></label>
                <input type="number" name="tahun_terbit" class="form-control" min="1900" max="<?= date('Y') ?>"
                       value="<?= set_value('tahun_terbit') ?>" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Stok <span class="text-danger">*</span></label>
                <input type="number" name="stok" class="form-control" min="0" value="<?= set_value('stok', 0) ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                <select name="kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach (['Fiksi', 'Non-Fiksi', 'Sains', 'Teknologi', 'Sejarah', 'Agama', 'Pendidikan', 'Komik'] as $kat): ?>
                        <option value="<?= $kat ?>" <?= set_select('kategori', $kat) ?>><?= $kat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">Sinopsis</label>
                <textarea name="sinopsis" class="form-control" rows="4"><?= set_value('sinopsis') ?></textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Simpan
            </button>
            <a href="<?= base_url('buku') ?>" class="btn btn-secondary">Batal</a>
        </div>
    <?= form_close() ?>
</div>
