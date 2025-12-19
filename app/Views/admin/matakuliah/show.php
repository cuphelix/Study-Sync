<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
/* Page container */
.page-content {
  max-width:1120px;
  margin:28px auto;
  padding:18px;
  box-sizing:border-box;
  color: #0f172a;
  font-family: "Poppins", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

/* Header area */
.page-header {
  display:flex;
  justify-content:space-between;
  align-items:center;
  gap:16px;
  margin-bottom:18px;
}
.page-header h2{ margin:0; font-size:20px; font-weight:700; }
.page-header p{ margin:2px 0 0; color:#6b7280; font-size:13px; }

/* Card */
.card {
  background:#ffffff;
  border-radius:14px;
  border:1px solid #eef2f6;
  padding:20px;
  box-shadow: 0 10px 30px rgba(15,23,42,0.04);
}

/* grid layout: left details + right summary */
.grid {
  display:grid;
  grid-template-columns: 1fr 360px;
  gap:22px;
  align-items:start;
}

/* left detail column */
.detail {
  padding-right:4px;
}
.field {
  display:flex;
  gap:18px;
  padding:12px 0;
  align-items:flex-start;
  border-bottom:1px dashed #f1f5f9;
}
.field:last-child { border-bottom:none; padding-bottom:0; }
.label {
  min-width:130px;
  color:#6b7280;
  font-size:13px;
  font-weight:600;
}
.value {
  color:#0f172a;
  font-weight:700;
  font-size:15px;
  word-break:break-word;
}

/* right summary card */
.summary {
  position:relative;
  border-radius:12px;
  padding:16px;
  background:linear-gradient(180deg,#ffffff,#fbfcfd);
  border:1px solid #eef4f8;
  box-shadow: 0 8px 22px rgba(16,24,40,0.04);
}

.summary-top {
  display:flex;
  gap:12px;
  align-items:center;
  margin-bottom:12px;
}
.avatar {
  width:72px;
  height:72px;
  border-radius:12px;
  display:flex;
  align-items:center;
  justify-content:center;
  font-weight:700;
  font-size:26px;
  color:#0f172a;
  background:linear-gradient(135deg,#eef2ff,#f0fff4);
  flex-shrink:0;
}
.summary-title { font-weight:700; font-size:16px; color:#0f172a; }
.summary-sub { color:#6b7280; font-size:13px; }

/* small stat boxes */
.stat-row { display:flex; gap:10px; margin:10px 0 14px; }
.stat {
  flex:1;
  background:#f8fafb;
  border-radius:10px;
  padding:10px;
  text-align:center;
  border:1px solid #f1f5f9;
}
.stat .s-label { color:#6b7280; font-size:12px; }
.stat .s-value { font-weight:700; font-size:16px; margin-top:6px; color:#0f172a; }

/* jenis badge */
.badge {
  display:inline-block;
  padding:8px 12px;
  border-radius:999px;
  font-weight:700;
  font-size:13px;
  color:#fff;
  box-shadow: 0 6px 14px rgba(37,99,235,0.08);
}
.badge-wajib { background: linear-gradient(180deg,#2563eb,#1e40af); }
.badge-pilihan { background: linear-gradient(180deg,#a855f7,#7c3aed); }

/* action buttons */
.actions { display:flex; gap:10px; }
.btn {
  padding:9px 12px;
  border-radius:10px;
  font-weight:600;
  text-decoration:none;
  display:inline-flex;
  align-items:center;
  gap:8px;
  border:none;
  cursor:pointer;
}
.btn-ghost { background:#eef2f2; color:#0f172a; }
.btn-primary { background:#e6f4ff; color:#1d4ed8; }

/* responsive */
@media (max-width: 980px) {
  .grid { grid-template-columns: 1fr; }
  .summary { order: -1; margin-bottom:12px; }
  .label { min-width:120px; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="page-header">
    <div>
      <h2>Detail Mata Kuliah</h2>
      <p>Informasi lengkap mata kuliah</p>
    </div>

    <div class="actions">
      <a href="<?= base_url('admin/matakuliah'); ?>" class="btn btn-ghost">← Kembali</a>
      <a href="<?= base_url('admin/matakuliah/edit/'.$mk['id_matakuliah']); ?>" class="btn btn-primary">✏ Edit</a>
    </div>
  </div>

  <div class="card">
    <div class="grid">
      <!-- LEFT: detail fields -->
      <div class="detail" aria-labelledby="detail-heading">
        <div class="field">
          <div class="label">Kode</div>
          <div class="value"><?= esc($mk['kode_matakuliah'] ?? '-'); ?></div>
        </div>

        <div class="field">
          <div class="label">Nama Mata Kuliah</div>
          <div class="value"><?= esc($mk['nama_matakuliah'] ?? '-'); ?></div>
        </div>

        <div class="field">
          <div class="label">SKS</div>
          <div class="value"><?= isset($mk['sks']) ? esc($mk['sks']) . ' SKS' : '-'; ?></div>
        </div>

        <div class="field">
          <div class="label">Semester</div>
          <div class="value"><?= isset($mk['semester']) ? 'Semester '.esc($mk['semester']) : '-'; ?></div>
        </div>

        <div class="field">
          <div class="label">Program Studi (ID)</div>
          <div class="value"><?= esc($mk['id_prodi'] ?? '-'); ?></div>
        </div>

        <div class="field">
          <div class="label">ID Kelas</div>
          <div class="value"><?= esc($mk['id_kelas'] ?? '-'); ?></div>
        </div>

        <div class="field">
          <div class="label">Dosen Pengampu (ID)</div>
          <div class="value"><?= esc($mk['id_dosen'] ?? '-'); ?></div>
        </div>
      </div>

      <!-- RIGHT: summary -->
      <aside class="summary" role="complementary" aria-labelledby="summary-heading">
        <div class="summary-top">
          <div class="avatar">
            <?= empty($mk['nama_matakuliah']) ? 'M' : strtoupper(substr($mk['nama_matakuliah'], 0, 1)); ?>
          </div>
          <div>
            <div class="summary-title"><?= esc($mk['nama_matakuliah'] ?? 'Mata Kuliah'); ?></div>
            <div class="summary-sub"><?= esc($mk['kode_matakuliah'] ?? '—'); ?></div>
            <div style="margin-top:6px;">
              <?php $jenis = $mk['jenis'] ?? null; ?>
              <?php if ($jenis === 'Wajib'): ?>
                <span class="badge badge-wajib">Wajib</span>
              <?php elseif ($jenis === 'Pilihan'): ?>
                <span class="badge badge-pilihan">Pilihan</span>
              <?php else: ?>
                <span style="display:inline-block;padding:6px 10px;border-radius:999px;background:#eef2f2;color:#374151;font-weight:700;font-size:13px;">—</span>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="stat-row" aria-hidden="true">
          <div class="stat">
            <div class="s-label">SKS</div>
            <div class="s-value"><?= isset($mk['sks']) ? esc($mk['sks']) : '-'; ?></div>
          </div>
          <div class="stat">
            <div class="s-label">Semester</div>
            <div class="s-value"><?= isset($mk['semester']) ? esc($mk['semester']) : '-'; ?></div>
          </div>
          <div class="stat">
            <div class="s-label">ID Kelas</div>
            <div class="s-value"><?= esc($mk['id_kelas'] ?? '-'); ?></div>
          </div>
        </div>

        <div style="margin-top:6px;">
          <div style="color:#6b7280;font-size:13px;margin-bottom:6px;">Dosen Pengampu</div>
          <div style="font-weight:700;color:#0f172a;"><?= esc($mk['id_dosen'] ?? '-'); ?></div>
        </div>

        <div style="margin-top:12px;">
          <div style="color:#6b7280;font-size:13px;margin-bottom:8px;">Program Studi</div>
          <div style="font-weight:700;color:#0f172a;"><?= esc($mk['nama_prodi'] ?? ('ID: '.($mk['id_prodi'] ?? '-'))); ?></div>
        </div>
      </aside>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
