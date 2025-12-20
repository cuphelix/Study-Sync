<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:980px; margin: 28px auto 60px; padding:12px; }
.card { background:#fff; border-radius:14px; border:1px solid #eef2f6; padding:18px; box-shadow:0 6px 18px rgba(15,23,42,0.04); }
.form-row { display:flex; gap:12px; margin-bottom:12px; }
.form-col { flex:1; display:flex; flex-direction:column; gap:6px; }
label { font-size:13px; color:#374151; font-weight:600; }
input[type="text"], input[type="email"], input[type="password"], input[type="number"], select {
    padding:10px 12px;
    border-radius:10px;
    border:1px solid #e5e7eb;
    font-size:14px;
    width:100%;
}
.btn { display:inline-block; padding:10px 14px; border-radius:10px; text-decoration:none; }
.btn-primary { background:#16a34a; color:#fff; border:none; cursor:pointer; }
.btn-ghost { background:#f3f4f6; color:#111827; border:none; }
.invalid { border-color:#ef4444; }
.form-note { font-size:13px; color:#6b7280; margin-top:6px; }
.alert { padding:10px 12px; border-radius:10px; background:#fef3f2; color:#b91c1c; margin-bottom:12px; }
@media (max-width:760px) { .form-row { flex-direction:column; } }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
        <div>
            <h2 style="margin:0">Tambah Mahasiswa</h2>
            <div style="color:#6b7280;font-size:13px">Tambahkan data mahasiswa baru</div>
        </div>
        <div>
            <a href="<?= base_url('admin/mahasiswa'); ?>" class="btn btn-ghost">← Kembali</a>
        </div>
    </div>

    <div class="card">
        <?php $validation = session()->getFlashdata('validation') ?? (isset($validation) ? $validation : null); ?>
        <?php if (!empty($validation) && is_object($validation)): ?>
            <div class="alert">
                <?php foreach ($validation->getErrors() as $err): ?>
                    <?= esc($err) ?><br>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/mahasiswa/store'); ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="form-row">
                <div class="form-col">
                    <label for="nim">NIM <span style="color:#ef4444">*</span></label>
                    <input type="text" id="nim" name="nim" 
                           value="<?= old('nim'); ?>"
                           class="<?= ($validation && $validation->hasError('nim')) ? 'invalid' : '' ?>"
                           required>
                    <div class="form-note">NIM harus unik</div>
                </div>

                <div class="form-col">
                    <label for="nama_mahasiswa">Nama Lengkap <span style="color:#ef4444">*</span></label>
                    <input type="text" id="nama_mahasiswa" name="nama_mahasiswa"
                           value="<?= old('nama_mahasiswa'); ?>"
                           class="<?= ($validation && $validation->hasError('nama_mahasiswa')) ? 'invalid' : '' ?>"
                           required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="email">Email <span style="color:#ef4444">*</span></label>
                    <input type="email" id="email" name="email"
                           value="<?= old('email'); ?>"
                           class="<?= ($validation && $validation->hasError('email')) ? 'invalid' : '' ?>"
                           required>
                    <div class="form-note">Email harus unik</div>
                </div>

                <div class="form-col">
                    <label for="password">Password <span style="color:#ef4444">*</span></label>
                    <input type="password" id="password" name="password"
                           class="<?= ($validation && $validation->hasError('password')) ? 'invalid' : '' ?>"
                           required>
                    <div class="form-note">Minimal 6 karakter</div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="semester">Semester</label>
                    <input type="number" id="semester" name="semester" 
                           value="<?= old('semester', '1'); ?>"
                           min="1" max="14">
                </div>

                <div class="form-col">
                    <label for="tahun_masuk">Tahun Masuk</label>
                    <input type="number" id="tahun_masuk" name="tahun_masuk"
                           value="<?= old('tahun_masuk', date('Y')); ?>"
                           min="2000" max="<?= date('Y') + 1 ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-col">
                    <label for="id_prodi">ID Program Studi</label>
                    <input type="number" id="id_prodi" name="id_prodi" 
                           value="<?= old('id_prodi'); ?>">
                    <div class="form-note">Masukkan ID prodi jika ada (opsional)</div>
                </div>

                <div class="form-col">
                    <!-- Kosong untuk balance layout -->
                </div>
            </div>

            <div style="display:flex;gap:8px;margin-top:10px;">
                <button type="submit" class="btn btn-primary">Simpan Data</button>
                <a href="<?= base_url('admin/mahasiswa'); ?>" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>