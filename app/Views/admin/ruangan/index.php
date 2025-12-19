<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
/* container */
.page-content {
  max-width:1200px;
  margin:20px auto 60px;
  padding:18px;
  font-family: 'Poppins', system-ui, -apple-system, sans-serif;
  color: #0f172a;
}

/* header */
.header-row {
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:12px;
  margin-bottom:14px;
}
.header-row h1 { margin:0; font-size:20px; font-weight:700; }
.header-row .sub { color:#6b7280; font-size:13px; }

/* KPI */
.kpi-grid {
  display:grid;
  grid-template-columns:repeat(2,minmax(0,1fr));
  gap:12px;
  margin-bottom:16px;
}
.kpi {
  background:linear-gradient(180deg,#ffffff,#f8fffb);
  border-radius:12px;
  padding:12px 14px;
  border:1px solid #eef7ef;
  box-shadow:0 8px 18px rgba(15,23,42,0.03);
  display:flex;
  justify-content:space-between;
  align-items:center;
}
.kpi .label { color:#6b7280; font-size:13px; }
.kpi .value { font-weight:700; font-size:20px; }

/* panel / table wrapper */
.panel {
  background:#fff;
  border-radius:12px;
  border:1px solid #eef2f6;
  padding:14px;
  box-shadow:0 6px 18px rgba(15,23,42,0.02);
}

/* search */
.search-row { display:flex; gap:12px; align-items:center; margin-bottom:12px; }
.search-box {
  flex:1;
  background:#f6f7f8;
  padding:10px 14px;
  border-radius:999px;
  display:flex;
  gap:10px;
  align-items:center;
  border:1px solid transparent;
}
.search-box:focus-within { border-color:#e6eef5; }
.search-box input { width:100%; border:0; outline:none; background:transparent; font-size:14px; }

/* table */
.table-wrapper { overflow-x:auto; }
table.table {
  width:100%;
  border-collapse:collapse;
  min-width:760px;
  font-size:14px;
}
table.table thead th {
  text-align:left;
  padding:12px 14px;
  color:#394152;
  font-weight:600;
  border-bottom:1px solid #eef2f6;
}
table.table tbody td {
  padding:12px 14px;
  border-bottom:1px solid #f6f8fa;
  vertical-align:middle;
  color:#111827;
}

/* badges */
.badge {
  display:inline-block;
  padding:6px 10px;
  border-radius:999px;
  font-size:12px;
  font-weight:600;
  color:#fff;
}
.badge-lab { background:linear-gradient(180deg,#a855f7,#7c3aed); }
.badge-aud { background:linear-gradient(180deg,#10b981,#059669); }
.badge-class { background:linear-gradient(180deg,#2563eb,#1e40af); }

/* actions */
.actions { display:flex; gap:8px; justify-content:flex-end; }
.btn {
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding:8px 10px;
  border-radius:10px;
  background:#fff;
  border:1px solid rgba(2,6,23,0.06);
  text-decoration:none;
  color:#111827;
  font-weight:600;
}
.btn:hover { box-shadow:0 8px 20px rgba(2,6,23,0.06); transform:translateY(-2px); }
.btn-view { background:#f8fafc; }
.btn-edit { background:linear-gradient(180deg,#e6f4ff,#dbefff); }

/* small muted text */
.small { color:#6b7280; font-size:13px; }

/* responsive */
@media (max-width:1000px) {
  .kpi-grid { grid-template-columns:repeat(2,1fr); }
  table.table { min-width:640px; }
}
@media (max-width:720px) {
  .kpi-grid { grid-template-columns:1fr; }
  .search-row { flex-direction:column; align-items:stretch; }
  table.table { min-width:520px; font-size:13px; }
  .actions { justify-content:flex-start; }
}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="page-content">
  <div class="header-row">
    <div>
      <h1>Manajemen Ruangan</h1>
      <div class="sub">Daftar kelas / ruang yang tersedia dalam sistem</div>
    </div>
    <div class="small">Total data: <?= esc(count($ruangan ?? [])) ?></div>
  </div>

  <!-- KPI (controller boleh kirim $cards) -->
  <div class="kpi-grid">
    <div class="kpi">
      <div>
        <div class="label">Total Kelas</div>
        <div class="value"><?= esc($cards['total_kelas'] ?? count($ruangan ?? [])) ?></div>
      </div>
      <div>🏫</div>
    </div>

    <div class="kpi">
      <div>
        <div class="label">Gedung</div>
        <div class="value"><?= esc($cards['total_gedung'] ?? '-') ?></div>
      </div>
      <div>🏢</div>
    </div>
  </div>

  <div class="panel">
    <form method="get" action="<?= base_url('admin/ruangan'); ?>" class="search-row" role="search" aria-label="Cari ruangan">
      <div class="search-box">
        <span aria-hidden="true">🔍</span>
        <input type="text" name="q" placeholder="Cari ruangan (kode, lantai, gedung)..." value="<?= esc($keyword ?? '') ?>">
      </div>
    </form>

    <div class="table-wrapper" role="region" aria-labelledby="daftar-ruangan">
      <table class="table" aria-describedby="daftar-ruangan">
        <thead>
          <tr>
            <th style="width:140px">Kode</th>
            <th>Nama Ruang / Keterangan</th>
            <th style="width:130px">Tipe</th>
            <th style="width:260px">Lokasi</th>
            <th style="width:160px;text-align:right">Aksi</th>
          </tr>
        </thead>

        <tbody>
        <?php if (!empty($ruangan) && is_array($ruangan)): ?>
          <?php foreach ($ruangan as $r): ?>
            <?php
              $id     = $r['id_kelas'] ?? ($r['id_ruangan'] ?? null);
              $kode   = esc($r['kode_kelas'] ?? $r['kode_ruangan'] ?? '-');
              $title  = $r['nama_kelas'] ?? $r['nama_ruangan'] ?? $kode;
              $lantai = isset($r['lantai']) && $r['lantai'] !== '' ? esc($r['lantai']) : '-';
              // GUNAKAN nama_gedung kalau ada (dari JOIN controller)
              $gedung = !empty($r['nama_gedung']) ? esc($r['nama_gedung']) : (!empty($r['kode_gedung']) ? esc($r['kode_gedung']) : '-');
              // guess tipe dari kode
              $tipeGuess = 'Ruang Kelas';
              $upperKode = strtoupper($kode);
              if (strpos($upperKode, 'LAB') !== false) $tipeGuess = 'Laboratorium';
              elseif (strpos($upperKode, 'AUD') !== false || strpos($upperKode, 'AUDITOR') !== false) $tipeGuess = 'Auditorium';
              $tipeClass = $tipeGuess === 'Laboratorium' ? 'badge-lab' : ($tipeGuess === 'Auditorium' ? 'badge-aud' : 'badge-class');
              $lokasi = $gedung . ' • Lt. ' . $lantai;
            ?>
            <tr>
              <td class="small"><?= $kode ?></td>
              <td>
                <div style="font-weight:700;"><?= $title ?></div>
                <div class="small"><?= 'ID: ' . ($id ?? '-') ?></div>
              </td>
              <td>
                <span class="badge <?= $tipeClass ?>"><?= $tipeGuess ?></span>
              </td>
              <td class="small"><?= $lokasi ?></td>
              <td style="text-align:right;">
                <div class="actions" role="group" aria-label="Aksi untuk <?= $kode ?>">
                  <a class="btn btn-view" href="<?= base_url('admin/ruangan/' . ($id ?? '')); ?>">👁 Lihat</a>
                  <a class="btn btn-edit" href="<?= base_url('admin/ruangan/edit/' . ($id ?? '')); ?>">✏ Edit</a>
                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="5">
              <div style="padding:28px;text-align:center;color:#9ca3af;">
                Belum ada data ruangan/kelas. Pastikan tabel <code>t_kelas</code> dan <code>t_gedung</code> sudah terisi.
              </div>
            </td>
          </tr>
        <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
