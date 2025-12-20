<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:760px;margin:24px auto;padding:12px; }
.card { background:#fff;border-radius:12px;border:1px solid #eef2f6;padding:20px; }
.form-row { display:flex;gap:12px;margin-bottom:12px; }
.form-col { flex:1; display:flex; flex-direction:column; gap:6px; }
label { font-size:13px; color:#374151; font-weight:600; }
input, select { padding:10px;border-radius:8px;border:1px solid #e5e7eb;font-size:14px;width:100%; }
.btn { padding:10px 12px;border-radius:8px;text-decoration:none; }
.btn-primary { background:#16a34a;color:#fff;border:none;cursor:pointer; }
.btn-ghost { background:#f3f4f6;color:#111827;border:none; }
.alert { padding:10px;border-radius:8px;background:#fef3f2;color:#b91c1c;margin-bottom:12px; }
.form-note { font-size:13px;color:#6b7280;margin-top:6px; }
.invalid { border-color:#ef4444; }
@media (max-width:760px){.form-row{flex-direction:column;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
    <div>
      <h2>Tambah Ruangan</h2>
      <div style="color:#6b7280;font-size:13px">Tambahkan kelas/ruangan baru</div>
    </div>
    <div>
      <a href="<?= base_url('admin/ruangan'); ?>" class="btn btn-ghost">← Kembali</a>
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

    <form action="<?= base_url('admin/ruangan/store'); ?>" method="post">
      <?= csrf_field() ?>
      
      <div class="form-row">
        <div class="form-col">
          <label for="kode_kelas">Kode Ruangan <span style="color:#ef4444">*</span></label>
          <input type="text" name="kode_kelas" id="kode_kelas" 
                 value="<?= old('kode_kelas'); ?>"
                 class="<?= ($validation && $validation->hasError('kode_kelas')) ? 'invalid' : '' ?>"
                 placeholder="Contoh: IF-1A atau LAB-101"
                 required>
          <div class="form-note">Kode harus unik</div>
        </div>

        <div class="form-col">
          <label for="lantai">Lantai</label>
          <input type="number" name="lantai" id="lantai" 
                 value="<?= old('lantai', '1'); ?>"
                 min="1" max="20"
                 placeholder="Contoh: 3">
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label for="id_gedung">Gedung</label>
          <select name="id_gedung" id="id_gedung">
            <option value="">-- Pilih Gedung (Opsional) --</option>
            <?php if (!empty($gedungs)): ?>
              <?php foreach ($gedungs as $g): ?>
                <option value="<?= $g['id_gedung'] ?>" <?= old('id_gedung') == $g['id_gedung'] ? 'selected' : '' ?>>
                  <?= esc($g['nama_gedung']) ?>
                </option>
              <?php endforeach; ?>
            <?php endif; ?>
          </select>
          <div class="form-note">Pilih gedung tempat ruangan berada</div>
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:10px;">
        <button class="btn btn-primary" type="submit">Simpan Data</button>
        <a href="<?= base_url('admin/ruangan'); ?>" class="btn btn-ghost">Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>