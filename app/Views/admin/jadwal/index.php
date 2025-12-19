<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:1200px;margin:18px auto;padding:12px; }
.kpi-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:12px; margin-bottom:14px; }
.kpi { background:linear-gradient(180deg,#fff,#f8fffb); padding:12px;border-radius:10px;border:1px solid #eef6f0; display:flex;justify-content:space-between;align-items:center; }
.search-box{background:#f6f7f8;padding:10px;border-radius:999px;margin-bottom:12px;}
.table { width:100%; border-collapse:collapse; min-width:900px; }
.table th { text-align:left; padding:10px; color:#6b7280; font-weight:600; border-bottom:1px solid #eef2f6; }
.table td { padding:12px 10px; border-bottom:1px solid #f6f8fa; vertical-align:middle; }
.badge-klas{background:#f3f4f6;color:#111827;padding:6px 8px;border-radius:999px;font-weight:700}
.actions { display:flex; gap:8px; justify-content:flex-end; }
.btn { padding:8px 10px;border-radius:8px;background:#fff;border:1px solid rgba(2,6,23,0.06); text-decoration:none;color:#111827;font-weight:600;}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <h2>Manajemen Jadwal</h2>

  <div class="kpi-grid">
    <div class="kpi"><div><div style="color:#6b7280">Total Jadwal</div><div style="font-weight:700;font-size:20px"><?= esc($cards['total_jadwal'] ?? 0) ?></div></div><div>⏱️</div></div>
    <div class="kpi"><div><div style="color:#6b7280">Mata Kuliah Aktif</div><div style="font-weight:700;font-size:20px"><?= esc($cards['matkul_aktif'] ?? 0) ?></div></div><div>📘</div></div>
    <div class="kpi"><div><div style="color:#6b7280">Kelas Berbeda</div><div style="font-weight:700;font-size:20px"><?= esc($cards['kelas_berbeda'] ?? '-') ?></div></div><div>🏫</div></div>
  </div>

  <form method="get" action="<?= base_url('admin/jadwal') ?>">
    <div class="search-box"><input type="text" name="q" placeholder="Cari jadwal (mata kuliah, kode, dosen, kelas)..." value="<?= esc($keyword ?? '') ?>" style="border:0;background:transparent;width:100%;outline:none"></div>
  </form>

  <div style="background:#fff;border-radius:10px;border:1px solid #eef4f8;padding:12px;">
    <table class="table" role="table">
      <thead>
        <tr>
          <th style="width:110px">Kode</th>
          <th>Nama Mata Kuliah</th>
          <th style="width:120px">Kelas</th>
          <th style="width:200px">Dosen</th>
          <th style="width:160px">Hari & Waktu</th>
          <th style="width:220px">Ruangan</th>
          <th style="width:160px;text-align:right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($jadwal)): foreach($jadwal as $j): ?>
          <tr>
            <td><?= esc($j['kode_matakuliah'] ?? '-') ?></td>
            <td><?= esc($j['nama_matakuliah'] ?? '-') ?></td>
            <td><span class="badge-klas"><?= esc($j['kode_kelas'] ?? '-') ?></span></td>
            <td><?= esc($j['nama_dosen'] ?? '-') ?></td>
            <td><?= esc($j['hari']) ?> <div style="color:#6b7280;font-size:13px"><?= esc(substr($j['jam_mulai'],0,5)) ?> - <?= esc(substr($j['jam_selesai'],0,5)) ?></div></td>
            <td><?= esc($j['kode_kelas'] ?? '-') ?> <?php if(!empty($j['nama_gedung'])): ?>• <?= esc($j['nama_gedung']) ?><?php endif; ?></td>
            <td style="text-align:right">
              <div class="actions">
                <a class="btn" href="<?= base_url('admin/jadwal/'.$j['id_jadwal']) ?>">👁 Lihat</a>
                <a class="btn" href="<?= base_url('admin/jadwal/edit/'.$j['id_jadwal']) ?>">✏ Edit</a>
              </div>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr><td colspan="7" style="text-align:center;padding:28px;color:#9ca3af;">Belum ada data jadwal.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<?= $this->endSection() ?>
