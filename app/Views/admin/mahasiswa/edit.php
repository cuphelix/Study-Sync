<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:980px; margin: 28px auto 60px; padding:12px; }
.card { background:#fff; border-radius:14px; border:1px solid #eef2f6; padding:18px; box-shadow:0 6px 18px rgba(15,23,42,0.04); }

/* layout dua kolom */
.edit-grid {
    display:flex;
    gap:20px;
    align-items:flex-start;
}
/* kiri: form, kanan: preview */
.edit-main { flex: 1 1 65%; }
.edit-side { flex: 0 0 320px; }

/* bila layar kecil, stack */
@media (max-width: 900px) {
    .edit-grid { flex-direction:column; }
    .edit-side { width:100%; }
}

/* form */
.form-row { display:flex; gap:12px; margin-bottom:12px; }
.form-col { flex:1; display:flex; flex-direction:column; gap:6px; }
label { font-size:13px; color:#374151; font-weight:600; }
input[type="text"], input[type="email"], input[type="password"], select, textarea {
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    font-size:14px;
    width:100%;
}
.btn { display:inline-block; padding:10px 14px; border-radius:10px; text-decoration:none; }
.btn-primary { background:#16a34a; color:#fff; border:none; }
.btn-ghost { background:#f3f4f6; color:#111827; border:none; }
.invalid { border-color:#ef4444; }
.form-note { font-size:13px; color:#6b7280; margin-top:6px; }

/* side preview */
.preview-card {
    background: linear-gradient(180deg,#fff,#fbfcfd);
    border-radius:12px;
    border:1px solid #eef4f8;
    padding:16px;
    box-shadow:0 6px 14px rgba(16,24,40,0.04);
}
.preview-meta { color:#6b7280; font-size:13px; margin-bottom:8px; }
.preview-nim { font-weight:700; font-size:16px; margin-bottom:6px; }
.preview-name { font-weight:700; font-size:15px; margin-bottom:4px; }
.preview-prodi { font-weight:600; color:#0f172a; margin-bottom:8px; }

/* small stat boxes */
.stat-grid { display:flex; gap:10px; margin-top:12px; }
.stat-box {
    background:#f8fafc;
    border-radius:10px;
    padding:12px;
    text-align:center;
    flex:1;
}
.stat-value { font-weight:700; font-size:18px; margin-top:6px; color:#0f172a; }
.stat-label { font-size:12px; color:#6b7280; }

/* status badge */
.badge {
    display:inline-block;
    padding:6px 10px;
    border-radius:999px;
    font-size:12px;
    color:#fff;
}
.badge-active { background:#16a34a; }
.badge-inactive { background:#9ca3af; }

/* pesan validasi & alerts */
.alert { padding:10px 12px; border-radius:10px; background:#fef3f2; color:#b91c1c; margin-bottom:12px; }
.success { background:#ecfdf5; color:#065f46; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
        <div>
            <h2 style="margin:0">Edit Mahasiswa</h2>
            <div style="color:#6b7280;font-size:13px">Perbarui informasi mahasiswa</div>
        </div>
        <div>
            <a href="<?= base_url('admin/mahasiswa/'.$mahasiswa['id_mahasiswa']); ?>" class="btn btn-ghost">← Kembali</a>
        </div>
    </div>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('success')): ?>
        <div class="success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <?php $validation = session()->getFlashdata('validation') ?? (isset($validation) ? $validation : null); ?>
    <?php if (!empty($validation) && is_object($validation)): ?>
        <div class="alert">
            <?php foreach ($validation->getErrors() as $err): ?>
                <?= esc($err) ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="card edit-grid">
        <!-- LEFT: FORM -->
        <div class="edit-main">
            <form action="<?= base_url('admin/mahasiswa/update/'.$mahasiswa['id_mahasiswa']); ?>" method="post">
                <?= csrf_field() ?>

                <div class="form-row">
                    <div class="form-col">
                        <label for="nim">NIM</label>
                        <input type="text" id="nim" name="nim"
                               value="<?= old('nim', $mahasiswa['nim']); ?>"
                               class="<?= ($validation && $validation->hasError('nim')) ? 'invalid' : '' ?>">
                    </div>

                    <div class="form-col">
                        <label for="nama_mahasiswa">Nama Lengkap</label>
                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa"
                               value="<?= old('nama_mahasiswa', $mahasiswa['nama_mahasiswa']); ?>"
                               class="<?= ($validation && $validation->hasError('nama_mahasiswa')) ? 'invalid' : '' ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email"
                               value="<?= old('email', $mahasiswa['email']); ?>"
                               class="<?= ($validation && $validation->hasError('email')) ? 'invalid' : '' ?>">
                    </div>

                    <div class="form-col">
                        <label for="semester">Semester</label>
                        <input type="text" id="semester" name="semester" value="<?= old('semester', $mahasiswa['semester'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="id_prodi">Program Studi (ID)</label>
                        <input type="text" id="id_prodi" name="id_prodi" value="<?= old('id_prodi', $mahasiswa['id_prodi'] ?? ''); ?>">
                        <div class="form-note">Masukkan ID prodi jika ada.</div>
                    </div>

                    <div class="form-col">
                        <label for="tahun_masuk">Tahun Masuk</label>
                        <input type="text" id="tahun_masuk" name="tahun_masuk" value="<?= old('tahun_masuk', $mahasiswa['tahun_masuk'] ?? ''); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-col">
                        <label for="password">Password baru (opsional)</label>
                        <input type="password" id="password" name="password" placeholder="Isi kalau ingin mengganti password">
                        <div class="form-note">Kosongkan jika tidak mengubah password.</div>
                    </div>
                    <div class="form-col">
                        <!-- kosongkan kolom kanan form agar rata dengan layout -->
                    </div>
                </div>

                <div style="display:flex;gap:8px;margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="<?= base_url('admin/mahasiswa'); ?>" class="btn btn-ghost">Batal</a>
                </div>
            </form>
        </div>

        <!-- RIGHT: PREVIEW / SUMMARY -->
        <aside class="edit-side">
            <div class="preview-card">
                <div class="preview-meta">Detail singkat</div>
                <div class="preview-nim"><?= esc($mahasiswa['nim']); ?></div>
                <div class="preview-name"><?= esc($mahasiswa['nama_mahasiswa']); ?></div>
                <div class="preview-prodi"><?= esc($mahasiswa['nama_prodi'] ?? ('Prodi ID: '.esc($mahasiswa['id_prodi'] ?? '-'))); ?></div>

                <div class="stat-grid">
                    <div class="stat-box">
                        <div class="stat-label">Semester</div>
                        <div class="stat-value"><?= !empty($mahasiswa['semester']) ? 'Semester '.esc($mahasiswa['semester']) : '-' ?></div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-label">IPK (estimasi)</div>
                        <div class="stat-value"><?= isset($mahasiswa['ipk_estimate']) && $mahasiswa['ipk_estimate'] !== null ? esc($mahasiswa['ipk_estimate']) : '-' ?></div>
                    </div>

                    <div class="stat-box">
                        <div class="stat-label">Tahun Masuk</div>
                        <div class="stat-value"><?= esc($mahasiswa['tahun_masuk'] ?? '-') ?></div>
                    </div>
                </div>

                <div style="margin-top:14px;">
                    <?php $status = (!empty($mahasiswa['semester']) && intval($mahasiswa['semester']) > 0) ? 'Aktif' : 'Tidak Aktif'; ?>
                    <div style="font-size:13px;color:#6b7280;margin-bottom:6px;">Status</div>
                    <div class="badge <?= $status === 'Aktif' ? 'badge-active' : 'badge-inactive' ?>"><?= $status ?></div>
                </div>

                <!-- tombol quick -->
                <div style="margin-top:14px; display:flex; gap:8px;">
                    <a href="<?= base_url('admin/mahasiswa/'.$mahasiswa['id_mahasiswa']); ?>" class="btn btn-ghost" style="flex:1;text-align:center;">Lihat</a>
                    <a href="<?= base_url('admin/mahasiswa/edit/'.$mahasiswa['id_mahasiswa']); ?>" class="btn btn-primary" style="flex:1;text-align:center;">Edit</a>
                </div>
            </div>
        </aside>
    </div>
</div>
<?= $this->endSection() ?>
