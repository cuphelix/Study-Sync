<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:760px;margin:24px auto;padding:12px; }
.card { background:#fff;border-radius:12px;border:1px solid #eef2f6;padding:20px; }
.form-row { display:flex;gap:12px;margin-bottom:12px; }
.form-col { flex:1; display:flex; flex-direction:column; gap:6px; }
input, select { padding:10px;border-radius:8px;border:1px solid #e5e7eb; }
.btn { padding:10px 12px;border-radius:8px;text-decoration:none; }
.btn-primary { background:#2563eb;color:#fff;border:none; }
.btn-ghost { background:#f3f4f6;color:#111827;border:none; }
.alert { padding:10px;border-radius:8px;background:#fef3f2;color:#b91c1c;margin-bottom:12px; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
    <div>
      <h2>Edit Ruangan</h2>
      <div style="color:#6b7280;font-size:13px">Perbarui data kelas/ruangan</div>
    </div>
    <div>
      <a href="<?= base_url('admin/ruangan/'.$ruangan['id_kelas']); ?>" class="btn btn-ghost">← Kembali</a>
    </div>
  </div>

  <div class="card">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert" style="background:#ecfdf5;color:#065f46;"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('admin/ruangan/update/'.$ruangan['id_kelas']); ?>" method="post">
      <?= csrf_field() ?>
      <div class="form-row">
        <div class="form-col">
          <label for="kode_kelas">Kode Ruangan</label>
          <input type="text" name="kode_kelas" id="kode_kelas" value="<?= esc(old('kode_kelas', $ruangan['kode_kelas'])); ?>">
        </div>
        <div class="form-col">
          <label for="lantai">Lantai</label>
          <input type="text" name="lantai" id="lantai" value="<?= esc(old('lantai', $ruangan['lantai'])); ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label for="id_gedung">Gedung</label>
          <select name="id_gedung" id="id_gedung">
            <option value="">-- Pilih Gedung --</option>
            <?php foreach ($gedungs as $g): ?>
              <option value="<?= $g['id_gedung'] ?>" <?= ($g['id_gedung'] == old('id_gedung', $ruangan['id_gedung'] ?? '')) ? 'selected' : '' ?>>
                <?= esc($g['nama_gedung']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:10px;">
        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        <a href="<?= base_url('admin/ruangan'); ?>" class="btn btn-ghost">Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
