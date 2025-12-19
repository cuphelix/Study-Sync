<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content{max-width:900px;margin:18px auto;padding:12px}
.card{background:#fff;padding:18px;border-radius:12px;border:1px solid #eef2f6}
.kv{color:#6b7280;font-size:13px;margin-bottom:6px}
.val{font-weight:700;font-size:16px;margin-bottom:12px}
.btn{padding:8px 12px;border-radius:8px;background:#fff;border:1px solid rgba(2,6,23,0.06)}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
    <div><h2>Detail Jadwal</h2><div style="color:#6b7280;font-size:13px">Informasi lengkap jadwal</div></div>
    <div>
      <a class="btn" href="<?= base_url('admin/jadwal') ?>">← Kembali</a>
      <a class="btn" href="<?= base_url('admin/jadwal/edit/'.$jadwal['id_jadwal']) ?>">✏ Edit</a>
    </div>
  </div>

  <div class="card">
    <div class="kv">Mata Kuliah</div>
    <div class="val"><?= esc($jadwal['kode_matakuliah'] ?? '-') ?> — <?= esc($jadwal['nama_matakuliah'] ?? '-') ?></div>

    <div style="display:flex;gap:16px;">
      <div style="flex:1">
        <div class="kv">Kelas</div>
        <div class="val"><?= esc($jadwal['kode_kelas'] ?? '-') ?></div>
      </div>
      <div style="flex:1">
        <div class="kv">Dosen Pengampu</div>
        <div class="val"><?= esc($jadwal['nama_dosen'] ?? '-') ?></div>
      </div>
      <div style="flex:1">
        <div class="kv">Hari & Waktu</div>
        <div class="val"><?= esc($jadwal['hari']) ?>, <?= esc(substr($jadwal['jam_mulai'],0,5)) ?> - <?= esc(substr($jadwal['jam_selesai'],0,5)) ?></div>
      </div>
    </div>

    <div style="margin-top:12px">
      <div class="kv">Lokasi</div>
      <div class="val"><?= esc($jadwal['kode_kelas'] ?? '-') ?> <?php if(!empty($jadwal['nama_gedung'])): ?>• <?= esc($jadwal['nama_gedung']) ?>, Lt. <?= esc($jadwal['lantai'] ?? '-') ?><?php endif; ?></div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
