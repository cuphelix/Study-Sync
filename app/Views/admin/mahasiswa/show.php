<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
/* Container */
.page-content { max-width:1100px; margin:24px auto 60px; padding:12px; }

/* Card dasar */
.card { background:#fff; border-radius:12px; border:1px solid #eef2f6; padding:20px; box-shadow:0 6px 18px rgba(15,23,42,0.04); }

/* Grid dua kolom */
.grid {
  display:grid;
  grid-template-columns: 1fr 360px; /* kiri fleksibel, kanan tetap */
  gap:20px;
  align-items:start;
}

/* Untuk layar kecil stack */
@media (max-width: 900px) {
  .grid { grid-template-columns: 1fr; }
}

/* Detail kiri */
.kv { color:#6b7280; font-size:13px; margin-bottom:6px; }
.val { font-weight:700; font-size:15px; margin-bottom:12px; color:#111827; }

/* Ringkasan kanan */
.side-card { border-radius:12px; padding:18px; background: linear-gradient(180deg,#ffffff,#fbfcfd); border:1px solid #eef4f8; box-shadow:0 8px 20px rgba(16,24,40,0.04); }

/* avatar */
.avatar {
  width:84px; height:84px; border-radius:12px;
  background:linear-gradient(135deg,#eef2ff,#f0fff4);
  display:flex; align-items:center; justify-content:center;
  font-weight:700; font-size:28px; color:#0f172a;
  margin-bottom:12px;
}

/* nama & prodi */
.side-title { font-weight:700; font-size:16px; margin-bottom:4px; color:#0f172a; }
.side-sub { font-size:13px; color:#6b7280; margin-bottom:12px; }

/* small stats */
.stat-row { display:flex; gap:10px; margin-bottom:14px; }
.stat {
  flex:1;
  background:#f8fafb;
  border-radius:10px;
  padding:10px;
  text-align:center;
}
.stat .label { color:#6b7280; font-size:12px; }
.stat .value { font-weight:700; font-size:16px; margin-top:6px; color:#0f172a; }

/* contact list */
.info-list { list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:8px 0; }
.info-list li { font-size:14px; color:#374151; }

/* quick actions */
.quick-actions { display:flex; gap:8px; margin-top:12px; }
.btn { display:inline-block; padding:10px 12px; border-radius:10px; text-decoration:none; font-weight:600; font-size:14px; }
.btn-back { background:#eef2f2; color:#111827; }
.btn-edit { background:#e6f4ff; color:#1d4ed8; border: none; }

/* badge status */
.badge { display:inline-block; padding:6px 12px; border-radius:999px; font-size:12px; color:#fff; }
.badge-success { background:#16a34a; }
.badge-muted  { background:#d1d5db; color:#374151; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">

  <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;">
    <div>
      <h2 style="margin:0">Detail Mahasiswa</h2>
      <div style="color:#6b7280;font-size:13px">Informasi lengkap mahasiswa</div>
    </div>
    <div>
      <a href="<?= base_url('admin/mahasiswa'); ?>" class="btn btn-back">← Kembali</a>
      <a href="<?= base_url('admin/mahasiswa/edit/'.$mahasiswa['id_mahasiswa']); ?>" class="btn btn-edit">✏ Edit</a>
    </div>
  </div>

  <div class="card">
    <div class="grid">
      <!-- KIRI: detail lengkap -->
      <div>
        <div style="margin-bottom:12px;">
          <div class="kv">NIM</div>
          <div class="val"><?= esc($mahasiswa['nim']); ?></div>
        </div>

        <div style="margin-bottom:12px;">
          <div class="kv">Nama Lengkap</div>
          <div class="val"><?= esc($mahasiswa['nama_mahasiswa']); ?></div>
        </div>

        <div style="margin-bottom:12px;">
          <div class="kv">Program Studi</div>
          <div class="val"><?= esc($mahasiswa['nama_prodi'] ?? ('Prodi ID: '.esc($mahasiswa['id_prodi'] ?? '-'))); ?></div>
        </div>

        <div style="margin-bottom:12px;">
          <div class="kv">Email</div>
          <div class="val">
            <?php if (!empty($mahasiswa['email'])): ?>
              <a href="mailto:<?= esc($mahasiswa['email']); ?>"><?= esc($mahasiswa['email']); ?></a>
            <?php else: echo '-'; endif; ?>
          </div>
        </div>

        <div style="margin-bottom:12px;">
          <div class="kv">Tahun Masuk</div>
          <div class="val"><?= !empty($mahasiswa['tahun_masuk']) ? esc($mahasiswa['tahun_masuk']) : '-'; ?></div>
        </div>
      </div>

      <!-- KANAN: ringkasan visual (tanpa riwayat/mk/keterangan) -->
      <aside>
        <div class="side-card">
          <!-- avatar -->
          <div style="display:flex;gap:12px;align-items:center;">
            <div class="avatar">
              <?= !empty($mahasiswa['nama_mahasiswa']) ? strtoupper(substr($mahasiswa['nama_mahasiswa'],0,1)) : 'U'; ?>
            </div>
            <div>
              <div class="side-title"><?= esc($mahasiswa['nama_mahasiswa']); ?></div>
              <div class="side-sub"><?= esc($mahasiswa['nama_prodi'] ?? 'Prodi: -'); ?></div>
              <div style="font-size:13px;color:#6b7280;">
                ID: <?= esc($mahasiswa['id_mahasiswa']); ?>
              </div>
            </div>
          </div>

          <!-- statistik kecil -->
          <div class="stat-row" style="margin-top:14px;">
            <div class="stat">
              <div class="label">Semester</div>
              <div class="value"><?= !empty($mahasiswa['semester']) ? 'S. '.esc($mahasiswa['semester']) : '-'; ?></div>
            </div>
            <div class="stat">
              <div class="label">IPK (est)</div>
              <div class="value"><?= isset($mahasiswa['ipk_estimate']) && $mahasiswa['ipk_estimate'] !== null ? esc($mahasiswa['ipk_estimate']) : '-'; ?></div>
            </div>
            <div class="stat">
              <div class="label">SKS</div>
              <div class="value"><?= isset($mahasiswa['sks_total']) ? esc($mahasiswa['sks_total']) : '-'; ?></div>
            </div>
          </div>

          <!-- kontak singkat -->
          <ul class="info-list" style="margin-top:6px;">
            <?php if (!empty($mahasiswa['email'])): ?>
              <li><strong>Email:</strong> <a href="mailto:<?= esc($mahasiswa['email']); ?>"><?= esc($mahasiswa['email']); ?></a></li>
            <?php endif; ?>
            <?php if (!empty($mahasiswa['alamat'])): ?>
              <li><strong>Alamat:</strong> <?= esc($mahasiswa['alamat']); ?></li>
            <?php endif; ?>
          </ul>

          <!-- quick actions -->
          <div class="quick-actions">
            <a href="<?= base_url('admin/mahasiswa/edit/'.$mahasiswa['id_mahasiswa']); ?>" class="btn btn-edit" style="flex:1;text-align:center;">Edit Data</a>
            <a href="<?= base_url('admin/mahasiswa'); ?>" class="btn btn-back" style="flex:1;text-align:center;">Kembali</a>
          </div>

        </div>
      </aside>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
