<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content{max-width:900px;margin:18px auto;padding:12px}
.card{background:#fff;padding:18px;border-radius:12px;border:1px solid #eef2f6}
.form-row{display:flex;gap:12px;margin-bottom:12px}
.form-col{flex:1;display:flex;flex-direction:column;gap:6px}
input,select{padding:10px;border-radius:8px;border:1px solid #e5e7eb;font-size:14px}
.btn{padding:10px 14px;border-radius:8px;background:#16a34a;color:#fff;border:none}
.btn-ghost{background:#f3f4f6;color:#111827;border:none;padding:10px 12px;border-radius:8px}
.invalid{border-color:#ef4444}
.alert{background:#fef3f2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:12px}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
    <div><h2>Edit Jadwal</h2><div style="color:#6b7280;font-size:13px">Perbarui jadwal perkuliahan</div></div>
    <div><a class="btn-ghost" href="<?= base_url('admin/jadwal/'.$jadwal['id_jadwal']) ?>">← Kembali</a></div>
  </div>

  <div class="card">
    <?php $validation = session()->getFlashdata('validation') ?? (isset($validation)?$validation:null); ?>
    <?php if (!empty($validation) && is_object($validation)): ?>
      <div class="alert">
        <?php foreach ($validation->getErrors() as $err): ?><?= esc($err) ?><br><?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/jadwal/update/'.$jadwal['id_jadwal']) ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-row">
        <div class="form-col">
          <label>Mata Kuliah</label>
          <select name="id_mk" class="<?= ($validation && $validation->hasError('id_mk')) ? 'invalid' : '' ?>">
            <option value="">-- Pilih Mata Kuliah --</option>
            <?php foreach($matkul as $m): ?>
              <option value="<?= $m['id_matakuliah'] ?>" <?= old('id_mk', $jadwal['id_mk']) == $m['id_matakuliah'] ? 'selected' : '' ?>>
                <?= esc($m['kode_matakuliah'].' — '.$m['nama_matakuliah']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-col">
          <label>Kelas / Ruangan</label>
          <select name="id_ruangan" class="<?= ($validation && $validation->hasError('id_ruangan')) ? 'invalid' : '' ?>">
            <option value="">-- Pilih Kelas / Ruangan --</option>
            <?php foreach($kelas as $k): ?>
              <option value="<?= $k['id_kelas'] ?>" <?= old('id_ruangan', $jadwal['id_ruangan']) == $k['id_kelas'] ? 'selected' : '' ?>>
                <?= esc($k['kode_kelas'] . ' • ' . ($k['nama_gedung'] ?? '')) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Dosen</label>
          <select name="id_dosen" class="<?= ($validation && $validation->hasError('id_dosen')) ? 'invalid' : '' ?>">
            <option value="">-- Pilih Dosen --</option>
            <?php foreach($dosen as $d): ?>
              <option value="<?= $d['id_dosen'] ?>" <?= old('id_dosen', $jadwal['id_dosen']) == $d['id_dosen'] ? 'selected' : '' ?>>
                <?= esc($d['nama_dosen']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-col">
          <label>Hari</label>
          <select name="hari" class="<?= ($validation && $validation->hasError('hari')) ? 'invalid' : '' ?>">
            <?php $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; ?>
            <?php foreach($hariList as $h): ?>
              <option value="<?= $h ?>" <?= old('hari', $jadwal['hari']) == $h ? 'selected' : '' ?>><?= $h ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Jam Mulai</label>
          <input type="time" name="jam_mulai" value="<?= old('jam_mulai', $jadwal['jam_mulai']) ?>">
        </div>
        <div class="form-col">
          <label>Jam Selesai</label>
          <input type="time" name="jam_selesai" value="<?= old('jam_selesai', $jadwal['jam_selesai']) ?>">
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:12px">
        <button class="btn" type="submit">Simpan Perubahan</button>
        <a class="btn-ghost" href="<?= base_url('admin/jadwal') ?>">Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
