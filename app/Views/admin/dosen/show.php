<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
:root{
    --card-radius:20px;
    --muted: #6b7280;
    --border: #e5e7eb;
    --accent: #16a34a;
}

/* wrapper konsisten dengan index */
.page-content {
    max-width: 1360px;
    margin: 0 auto 56px;
    padding: 12px;
}

/* card utama */
.detail-container {
    max-width: 1100px;
    margin: 24px auto 40px;
}

.detail-card {
    background:#ffffff;
    border-radius:var(--card-radius);
    border:1px solid var(--border);
    padding:20px;
    box-shadow: 0 1px 0 rgba(0,0,0,0.03);
}

/* header */
.detail-header {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
    margin-bottom:16px;
}

.detail-title {
    font-size:20px;
    font-weight:700;
    color:#0f172a;
}
.detail-sub {
    color:var(--muted);
    font-size:13px;
    margin-top:4px;
}

/* layout two-column */
.row {
    display:flex;
    gap:22px;
    align-items:flex-start;
}
.col {
    flex:1;
}

/* left column fields */
.kv { color:var(--muted); font-size:13px; margin-bottom:6px; }
.val { font-weight:700; font-size:15px; margin-bottom:12px; color:#0f172a; }

/* small stat boxes on right */
.stats-row { display:flex; gap:12px; margin-bottom:14px; }
.small-box {
    background:#f8fafb;
    padding:14px;
    border-radius:12px;
    text-align:center;
    flex:1;
    border:1px solid #f1f5f9;
}
.small-box .label { font-size:13px; color:var(--muted); margin-bottom:6px; }
.small-box .value { font-size:20px; font-weight:700; }

/* description */
.note {
    background:#f9fafb;
    border-radius:12px;
    padding:14px;
    border:1px solid #f1f5f9;
    color:#0f172a;
}

/* buttons */
.action-group { display:flex; gap:8px; }
.btn {
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:10px 14px;
    border-radius:999px;
    text-decoration:none;
    font-size:14px;
    border:1px solid var(--border);
}
.btn-back { background:#eef2f2; color:#0f172a; }
.btn-edit { background:#e6f4ff; color:#1d4ed8; border-color:#e0f2fe; }

@media (max-width:900px) {
    .row { flex-direction:column; }
    .stats-row { flex-direction:column; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">
    <div class="detail-container">

        <div class="detail-header">
            <div>
                <div class="detail-title">Detail Dosen</div>
                <div class="detail-sub">Informasi lengkap dosen</div>
            </div>

            <div class="action-group">
                <a href="<?= base_url('admin/dosen'); ?>" class="btn btn-back">← Kembali</a>
                <a href="<?= base_url('admin/dosen/edit/'.$dosen['id_dosen']); ?>" class="btn btn-edit">✏ Edit</a>
            </div>
        </div>

        <div class="detail-card">
            <div class="row">
                <!-- LEFT -->
                <div class="col" style="max-width:480px;">
                    <div class="kv">NIP</div>
                    <div class="val"><?= esc($dosen['nip'] ?? '-'); ?></div>

                    <div class="kv">Nama Lengkap</div>
                    <div class="val"><?= esc($dosen['nama_dosen'] ?? '-'); ?></div>

                    <div class="kv">Email</div>
                    <div class="val">
                        <?php if (! empty($dosen['email'])): ?>
                            <a href="mailto:<?= esc($dosen['email']); ?>"><?= esc($dosen['email']); ?></a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>

                    <div class="kv">Nomor WA</div>
                    <div class="val">
                        <?php if (! empty($dosen['no_wa'])): ?>
                            <a href="https://wa.me/<?= preg_replace('/\D+/', '', $dosen['no_wa']); ?>" target="_blank" rel="noopener">
                                <?= esc($dosen['no_wa']); ?>
                            </a>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </div>
                </div>

                <!-- RIGHT -->
                <div class="col">
                    <div class="stats-row" role="status" aria-label="Statistik dosen">
                        <div class="small-box">
                            <div class="label">Total Mata Kuliah</div>
                            <div class="value"><?= (int) ($dosen['total_mk'] ?? 0); ?></div>
                        </div>
                        <div class="small-box">
                            <div class="label">Total Kelas</div>
                            <div class="value"><?= (int) ($dosen['total_kelas'] ?? 0); ?></div>
                        </div>
                        <div class="small-box">
                            <div class="label">Total Jadwal</div>
                            <div class="value"><?= (int) ($dosen['total_jadwal'] ?? 0); ?></div>
                        </div>
                    </div>

                    <div style="margin-top:6px;">
                        <div class="kv">Deskripsi / Catatan</div>
                        <div class="note"><?= esc($dosen['keterangan'] ?? '-'); ?></div>
                    </div>

                    <?php if (! empty($dosen['created_at']) || ! empty($dosen['updated_at'])): ?>
                        <div style="margin-top:12px; color:var(--muted); font-size:13px;">
                            <?php if (! empty($dosen['created_at'])): ?>
                                Dibuat: <?= date('j M Y H:i', strtotime($dosen['created_at'])); ?>
                            <?php endif; ?>
                            <?php if (! empty($dosen['updated_at'])): ?>
                                &nbsp;•&nbsp; Terakhir update: <?= date('j M Y H:i', strtotime($dosen['updated_at'])); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
