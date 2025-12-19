<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:980px; margin: 28px auto 60px; padding:12px; }
.card { background:#fff; border-radius:14px; border:1px solid #eef2f6; padding:18px; }
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
.btn-primary { background:#6366f1; color:#fff; border:none; }
.btn-ghost { background:#f3f4f6; color:#111827; border:none; }
.invalid { border-color:#ef4444; }
.form-note { font-size:13px; color:#6b7280; margin-top:6px; }
.alert { padding:10px 12px; border-radius:10px; background:#fef3f2; color:#b91c1c; margin-bottom:12px; }
.success { background:#ecfdf5; color:#065f46; padding:10px 12px; border-radius:10px; margin-bottom:12px; }
@media (max-width:760px) { .form-row { flex-direction:column; } }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
        <div>
            <h2 style="margin:0">Edit Dosen</h2>
            <div style="color:#6b7280;font-size:13px">Perbarui informasi dosen</div>
        </div>
        <div>
            <a href="<?= base_url('admin/dosen/'.$dosen['id_dosen']); ?>" class="btn btn-ghost">← Kembali</a>
        </div>
    </div>

    <div class="card">
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

        <form action="<?= base_url('admin/dosen/update/'.$dosen['id_dosen']); ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-row">
                <div class="form-col">
                    <label for="nip">NIP</label>
                    <input type="text" id="nip" name="nip"
                           value="<?= old('nip', $dosen['nip']); ?>"
                           class="<?= ($validation && $validation->hasError('nip')) ? 'invalid' : '' ?>">
                </div>

                <div class="form-col">
                    <label for="nama_dosen">Nama Lengkap</label>
                    <input type="text" id="nama_dosen" name="nama_dosen"
                           value="<?= old('nama_dosen', $dosen['nama_dosen']); ?>"
                           class="<?= ($validation && $validation->hasError('nama_dosen')) ? 'invalid' : '' ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email"
                           value="<?= old('email', $dosen['email']); ?>"
                           class="<?= ($validation && $validation->hasError('email')) ? 'invalid' : '' ?>">
                </div>

                <div class="form-col">
                    <label for="no_wa">No. WA</label>
                    <input type="text" id="no_wa" name="no_wa"
                           value="<?= old('no_wa', $dosen['no_wa']); ?>"
                           class="<?= ($validation && $validation->hasError('no_wa')) ? 'invalid' : '' ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="password">Password baru (opsional)</label>
                    <input type="password" id="password" name="password"
                           placeholder="Isi kalau ingin mengganti password">
                    <div class="form-note">Biarkan kosong jika tidak ingin mengubah password.</div>
                </div>

                <div class="form-col">
                    <label for="id_prodi">Program Studi (opsional)</label>
                    <input type="text" id="id_prodi" name="id_prodi" value="<?= old('id_prodi', $dosen['id_prodi'] ?? ''); ?>">
                    <div class="form-note">Masukkan ID Prodi kalau ada. Kosongkan jika tidak perlu.</div>
                </div>
            </div>

            <div style="display:flex;gap:8px;margin-top:10px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('admin/dosen'); ?>" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
