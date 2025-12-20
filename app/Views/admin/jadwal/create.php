<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content{max-width:900px;margin:18px auto;padding:12px}
.card{background:#fff;padding:18px;border-radius:12px;border:1px solid #eef2f6}
.form-row{display:flex;gap:12px;margin-bottom:12px}
.form-col{flex:1;display:flex;flex-direction:column;gap:6px}
label{font-size:13px;color:#374151;font-weight:600}
input,select{padding:10px;border-radius:8px;border:1px solid #e5e7eb;font-size:14px;width:100%}
.btn{padding:10px 14px;border-radius:8px;text-decoration:none}
.btn-primary{background:#16a34a;color:#fff;border:none;cursor:pointer}
.btn-ghost{background:#f3f4f6;color:#111827;border:none}
.invalid{border-color:#ef4444}
.alert{background:#fef3f2;color:#b91c1c;padding:10px;border-radius:8px;margin-bottom:12px}
.form-note{font-size:13px;color:#6b7280;margin-top:6px}
@media (max-width:760px){.form-row{flex-direction:column}}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
    <div>
      <h2 style="margin:0">Tambah Jadwal</h2>
      <div style="color:#6b7280;font-size:13px">Tambahkan jadwal perkuliahan baru</div>
    </div>
    <div>
      <a class="btn btn-ghost" href="<?= base_url('admin/jadwal') ?>">← Kembali</a>
    </div>
  </div>

  <div class="card">
    <?php $validation = session()->getFlashdata('validation') ?? (isset($validation) ? $validation : null); ?>
    <?php if (!empty($validation) && is_object($validation)): ?>
      <div class="alert">
        <?php foreach ($validation->getErrors() as $err): ?><?= esc($err) ?><br><?php endforeach; ?>
      </div>
    <?php endif; ?>

    <form action="<?= base_url('admin/jadwal/store') ?>" method="post">
      <?= csrf_field() ?>

      <div class="form-row">
        <div class="form-col">
          <label>Mata Kuliah <span style="color:#ef4444">*</span></label>
          <select name="id_mk" class="<?= ($validation && $validation->hasError('id_mk')) ? 'invalid' : '' ?>" required>
            <option value="">-- Pilih Mata Kuliah --</option>
            <?php if (!empty($matkul)): foreach($matkul as $m): ?>
              <option value="<?= $m['id_matakuliah'] ?>" <?= old('id_mk') == $m['id_matakuliah'] ? 'selected' : '' ?>>
                <?= esc($m['kode_matakuliah'].' — '.$m['nama_matakuliah']) ?>
              </option>
            <?php endforeach; endif; ?>
          </select>
        </div>

        <div class="form-col">
          <label>Kelas / Ruangan <span style="color:#ef4444">*</span></label>
          <select name="id_ruangan" class="<?= ($validation && $validation->hasError('id_ruangan')) ? 'invalid' : '' ?>" required>
            <option value="">-- Pilih Kelas / Ruangan --</option>
            <?php if (!empty($kelas)): foreach($kelas as $k): ?>
              <option value="<?= $k['id_kelas'] ?>" <?= old('id_ruangan') == $k['id_kelas'] ? 'selected' : '' ?>>
                <?= esc($k['kode_kelas']) ?><?php if (!empty($k['nama_gedung'])): ?> • <?= esc($k['nama_gedung']) ?><?php endif; ?>
              </option>
            <?php endforeach; endif; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Dosen <span style="color:#ef4444">*</span></label>
          <select name="id_dosen" class="<?= ($validation && $validation->hasError('id_dosen')) ? 'invalid' : '' ?>" required>
            <option value="">-- Pilih Dosen --</option>
            <?php if (!empty($dosen)): foreach($dosen as $d): ?>
              <option value="<?= $d['id_dosen'] ?>" <?= old('id_dosen') == $d['id_dosen'] ? 'selected' : '' ?>>
                <?= esc($d['nama_dosen']) ?>
              </option>
            <?php endforeach; endif; ?>
          </select>
        </div>

        <div class="form-col">
          <label>Hari <span style="color:#ef4444">*</span></label>
          <select name="hari" class="<?= ($validation && $validation->hasError('hari')) ? 'invalid' : '' ?>" required>
            <option value="">-- Pilih Hari --</option>
            <?php $hariList = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu']; ?>
            <?php foreach($hariList as $h): ?>
              <option value="<?= $h ?>" <?= old('hari') == $h ? 'selected' : '' ?>><?= $h ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Jam Mulai <span style="color:#ef4444">*</span></label>
          <input type="time" name="jam_mulai" value="<?= old('jam_mulai', '08:00') ?>" required>
        </div>
        <div class="form-col">
          <label>Jam Selesai <span style="color:#ef4444">*</span></label>
          <input type="time" name="jam_selesai" value="<?= old('jam_selesai', '10:00') ?>" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>ID Mahasiswa (Opsional)</label>
          <input type="number" name="id_mahasiswa" value="<?= old('id_mahasiswa') ?>" placeholder="Kosongkan jika jadwal untuk semua">
          <div class="form-note">Isi hanya jika jadwal khusus untuk mahasiswa tertentu</div>
        </div>

        <div class="form-col">
          <label>Minggu Ke</label>
          <input type="number" name="minggu_ke" value="<?= old('minggu_ke', '1') ?>" min="1" max="16">
        </div>
      </div>

      <div class="form-row">
        <div class="form-col">
          <label>Tahun Ajaran</label>
          <input type="text" name="tahun_ajaran" value="<?= old('tahun_ajaran', '2024/2025') ?>" placeholder="Contoh: 2024/2025">
        </div>

        <div class="form-col">
          <label>Semester</label>
          <select name="semester">
            <option value="">-- Pilih --</option>
            <option value="Ganjil" <?= old('semester') == 'Ganjil' ? 'selected' : '' ?>>Ganjil</option>
            <option value="Genap" <?= old('semester') == 'Genap' ? 'selected' : '' ?>>Genap</option>
          </select>
        </div>
      </div>

      <div style="display:flex;gap:8px;margin-top:12px">
        <button class="btn btn-primary" type="submit">Simpan Data</button>
        <a class="btn btn-ghost" href="<?= base_url('admin/jadwal') ?>">Batal</a>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>