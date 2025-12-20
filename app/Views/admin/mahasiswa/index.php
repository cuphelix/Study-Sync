<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:1360px; margin:0 auto 40px; padding:12px; }

/* ringkasan */
.kpi-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; margin-bottom:18px; }
.kpi-card { background:#f8fffb; padding:16px; border-radius:14px; border:1px solid #e6f6ea; display:flex; justify-content:space-between; align-items:center; }
.kpi-card .left { font-size:13px; color:#6b7280; }
.kpi-card .value { font-size:22px; font-weight:700; color:#0f172a; }

/* search + container */
.panel { background:#fff; border-radius:14px; border:1px solid #eef2f6; padding:14px; }
.search-box { background:#f6f7f8; padding:10px 12px; border-radius:999px; display:flex; gap:10px; align-items:center; margin-bottom:12px; }

/* table */
.table-wrapper { overflow-x:auto; }
table.table { width:100%; border-collapse:collapse; min-width:900px; }
table.table th, table.table td { padding:12px 10px; border-bottom:1px solid #eef2f6; text-align:left; vertical-align:middle; }
table.table thead th { background:#fff; color:#6b7280; font-weight:600; font-size:13px; }
.badge { display:inline-block; padding:6px 10px; border-radius:999px; font-size:12px; color:#fff; }
.badge-success { background:#16a34a; }
.badge-muted { background:#eef2f3; color:#374151; }

/* action buttons */
.btn { border-radius:999px; padding:8px 12px; font-size:13px; display:inline-flex; gap:8px; align-items:center; border:none; cursor:pointer; }
.btn-view { background:#f3f4f6; color:#111827; }
.btn-edit { background:#e6f4ff; color:#1d4ed8; }

/* responsive */
@media (max-width:1100px) {
    .kpi-grid { grid-template-columns:repeat(2,1fr); }
}
@media (max-width:760px) {
    .kpi-grid { grid-template-columns:1fr; }
    .col-prodi, .col-semester, .col-ipk { display:none; }
    table.table { min-width:600px; }
}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-content">
    <h1 style="margin:0 0 12px;">Manajemen Mahasiswa</h1>

    <div class="kpi-grid">
        <div class="kpi-card">
            <div>
                <div class="left">Total Mahasiswa</div>
                <div class="value"><?= esc($cards['total_mahasiswa'] ?? 0) ?></div>
            </div>
            <div>👥</div>
        </div>

        <div class="kpi-card">
            <div>
                <div class="left">Mahasiswa Aktif</div>
                <div class="value"><?= esc($cards['mahasiswa_aktif'] ?? 0) ?></div>
            </div>
            <div>🎓</div>
        </div>

        <div class="kpi-card">
            <div>
                <div class="left">IPK Rata-rata</div>
                <div class="value"><?= $cards['avg_ipk'] !== null ? esc($cards['avg_ipk']) : '-' ?></div>
            </div>
            <div>📊</div>
        </div>
    </div>

    <!-- MAHASISWA INDEX -->
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
    <h1>Manajemen Mahasiswa</h1>
    <a href="<?= base_url('admin/mahasiswa/create'); ?>">
        <button style="border:none;border-radius:999px;padding:10px 20px;background:#16a34a;color:#fff;font-size:14px;font-weight:500;cursor:pointer;">
            + Tambah Mahasiswa
        </button>
    </a>
</div>

    <div class="panel">
        <form method="get" action="<?= base_url('admin/mahasiswa'); ?>">
            <div class="search-box" role="search">
                <span>🔍</span>
                <input type="text" name="q" placeholder="Cari mahasiswa (NIM, nama, email, program studi)..." value="<?= esc($keyword ?? '') ?>" style="border:none;background:transparent;outline:none;width:100%;font-size:14px;">
            </div>
        </form>

        <div class="table-wrapper">
            <table class="table" aria-describedby="daftar-mahasiswa">
                <thead>
                    <tr>
                        <th style="width:150px;">NIM</th>
                        <th>Nama</th>
                        <th class="col-prodi">Program Studi</th>
                        <th class="col-semester" style="width:120px;">Semester</th>
                        <th class="col-ipk" style="width:90px;">IPK</th>
                        <th style="width:110px;">Status</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mahasiswa)): ?>
                        <?php foreach ($mahasiswa as $m): ?>
                            <tr>
                                <td style="color:#6b7280;"><?= esc($m['nim']); ?></td>
                                <td>
                                    <div style="font-weight:600;"><?= esc($m['nama_mahasiswa']); ?></div>
                                </td>
                                <td class="col-prodi"><?= esc($m['nama_prodi'] ?? '-'); ?></td>
                                <td class="col-semester"><?= !empty($m['semester']) ? 'Semester '.esc($m['semester']) : '-' ?></td>
                                <td class="col-ipk" style="text-align:center;"><?= isset($m['ipk_estimate']) && $m['ipk_estimate'] !== null ? esc($m['ipk_estimate']) : '-' ?></td>
                                <td>
                                    <?php
                                        // definisi status: contoh jika semester > 0 => aktif
                                        $status = (!empty($m['semester']) && intval($m['semester']) > 0) ? 'Aktif' : 'Tidak Aktif';
                                    ?>
                                    <span class="badge <?= $status === 'Aktif' ? 'badge-success' : 'badge-muted' ?>"><?= $status ?></span>
                                </td>
                                <td>
                                    <a href="<?= base_url('admin/mahasiswa/'.$m['id_mahasiswa']); ?>">
                                        <button class="btn btn-view" type="button">👁 Lihat</button>
                                    </a>
                                    <a href="<?= base_url('admin/mahasiswa/edit/'.$m['id_mahasiswa']); ?>">
                                        <button class="btn btn-edit" type="button">✏ Edit</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" style="text-align:center;padding:30px;color:#9ca3af;">Belum ada data mahasiswa.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
