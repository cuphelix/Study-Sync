<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:980px;margin:28px auto;padding:12px; }
.card{background:#fff;border-radius:12px;border:1px solid #eef2f6;padding:18px;box-shadow:0 6px 18px rgba(15,23,42,0.04);}
.form-row{display:flex;gap:12px;margin-bottom:12px;}
.form-col{flex:1;display:flex;flex-direction:column;gap:6px;}
label{font-size:13px;color:#374151;font-weight:600;}
input, select { padding:10px 12px;border-radius:10px;border:1px solid #e5e7eb;font-size:14px;width:100%; }
.btn{display:inline-block;padding:10px 14px;border-radius:10px;text-decoration:none;}
.btn-primary{background:#16a34a;color:#fff;border:none;}
.btn-ghost{background:#f3f4f6;color:#111827;border:none;}
.invalid{border-color:#ef4444;}
.alert{padding:10px 12px;border-radius:10px;background:#fef3f2;color:#b91c1c;margin-bottom:12px;}
@media (max-width:760px){.form-row{flex-direction:column;}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">
    <div>
      <h2 style="margin:0">Edit Mata Kuliah</h2>
      <div style="color:#6b7280;font-size:13px">Perbarui informasi mata kuliah</div>
    </div>
    <div>
      <a href="<?= base_url('admin/matakuliah/'.$mk['id_matakuliah']); ?>" class="btn btn-ghost">← Kembali</a>
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

    <form action="<?= base_url('admin/matakuliah/update/'.$mk['id_matakuliah']); ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-row">
        <div class="form-col">
          <label for="kode_matakuliah">Kode</label>
          <input type="text" id="kode_matakuliah" name="kode_matakuliah"
                 value="<?= old('kode_matakuliah', $mk['kode_matakuliah']); ?>"
                 class="<?= ($validation && $validation->hasError('kode_matakuliah')) ? 'invalid' : '' ?>">
        </div>

        <div class="form-col">
          <label for="sks">SKS</label>
          <input type="text" id="sks" name="sks"
                 value="<?= old('sks', $mk['sks']); ?>"
                 class="<?= ($validation && $validation->hasError('sks')) ? 'invalid' : '' ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label for="nama_matakuliah">Nama Mata Kuliah</label>
          <input type="text" id="nama_matakuliah" name="nama_matakuliah"
                 value="<?= old('nama_matakuliah', $mk['nama_matakuliah']); ?>"
                 class="<?= ($validation && $validation->hasError('nama_matakuliah')) ? 'invalid' : '' ?>">
        </div>

        <div class="form-col">
          <label for="id_prodi">ID Program Studi</label>
          <input type="text" id="id_prodi" name="id_prodi"
                 value="<?= old('id_prodi', $mk['id_prodi']); ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label for="jenis">Jenis</label>
          <select id="jenis" name="jenis">
            <option value="Wajib" <?= old('jenis', $mk['jenis']) === 'Wajib' ? 'selected' : '' ?>>Wajib</option>
            <option value="Pilihan" <?= old('jenis', $mk['jenis']) === 'Pilihan' ? 'selected' : '' ?>>Pilihan</option>
          </select>
        </div>

        <div class="form-col">
          <label for="id_kelas">ID Kelas (opsional)</label>
          <input type="text" id="id_kelas" name="id_kelas" value="<?= old('id_kelas', $mk['id_kelas'] ?? ''); ?>">
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:10px;">
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="<?= base_url('admin/matakuliah'); ?>" class="btn btn-ghost">Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
