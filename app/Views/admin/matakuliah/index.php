<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content { max-width:1360px; margin:0 auto 40px; padding:12px; }

.kpi-grid { display:grid; grid-template-columns:repeat(3,minmax(0,1fr)); gap:16px; margin-bottom:18px; }
.kpi-card { background:#f8fffb; padding:16px; border-radius:14px; border:1px solid #e6f6ea; display:flex; justify-content:space-between; align-items:center; }
.kpi-card .left { font-size:13px; color:#6b7280; }
.kpi-card .value { font-size:22px; font-weight:700; color:#0f172a; }

.panel { background:#fff; border-radius:14px; border:1px solid #eef2f6; padding:14px; }

.search-box { background:#f6f7f8; padding:10px 12px; border-radius:999px; display:flex; gap:10px; align-items:center; margin-bottom:12px; }

.table-wrapper { overflow-x:auto; }
table.table { width:100%; border-collapse:collapse; min-width:900px; }
table.table th, table.table td { padding:12px 10px; border-bottom:1px solid #eef2f6; text-align:left; }

.badge {
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    color:#fff;
}
.badge-wajib { background:#2563eb; }
.badge-pilihan { background:#a855f7; }

.btn { border-radius:999px; padding:8px 12px; font-size:13px; display:inline-flex; gap:8px; align-items:center; border:none; cursor:pointer; }
.btn-view { background:#f3f4f6; color:#111827; }
.btn-edit { background:#e6f4ff; color:#1d4ed8; }

</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="page-content">
                    <!-- Mata Kuliah INDEX -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
        <h1>Manajemen Mata Kuliah</h1>
        <a href="<?= base_url('admin/matakuliah/create'); ?>">
            <button style="border:none;border-radius:999px;padding:10px 20px;background:#16a34a;color:#fff;font-size:14px;font-weight:500;cursor:pointer;">
                + Tambah Mata Kuliah
            </button>
        </a>
    </div>

    <!-- KPI CARDS -->
    <div class="kpi-grid">
        <div class="kpi-card">
            <div>
                <div class="left">Total Mata Kuliah</div>
                <div class="value"><?= esc($cards['total_mk']); ?></div>
            </div>
            <div>📘</div>
        </div>

        <div class="kpi-card">
            <div>
                <div class="left">Mata Kuliah Wajib</div>
                <div class="value"><?= esc($cards['wajib']); ?></div>
            </div>
            <div>🎓</div>
        </div>

        <div class="kpi-card">
            <div>
                <div class="left">Total SKS</div>
                <div class="value"><?= esc($cards['total_sks']); ?></div>
            </div>
            <div>📚</div>
        </div>
    </div>

    <!-- PANEL SEARCH -->
    <div class="panel">
        <form method="get" action="<?= base_url('admin/matakuliah'); ?>">
            <div class="search-box">
                <span>🔍</span>
                <input type="text" name="q" placeholder="Cari mata kuliah (kode, nama, program studi)..."
                       value="<?= esc($keyword); ?>"
                       style="border:none;background:transparent;outline:none;width:100%;">
            </div>
        </form>

        <!-- TABLE -->
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Program Studi</th>
                        <th>Jenis</th>
                        <th style="width:140px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($matakuliah as $mk): ?>
                    <tr>
                        <td><?= esc($mk['kode_matakuliah']); ?></td>
                        <td><?= esc($mk['nama_matakuliah']); ?></td>
                        <td><?= esc($mk['sks']); ?> SKS</td>
                        <td><?= esc($mk['nama_prodi'] ?? '-'); ?></td>
                        <td>
                            <?php if ($mk['jenis'] == 'Wajib'): ?>
                                <span class="badge badge-wajib">Wajib</span>
                            <?php else: ?>
                                <span class="badge badge-pilihan">Pilihan</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= base_url('admin/matakuliah/'.$mk['id_matakuliah']); ?>">
                                <button class="btn btn-view" type="button">👁 Lihat</button>
                            </a>
                            <a href="<?= base_url('admin/matakuliah/edit/'.$mk['id_matakuliah']); ?>">
                                <button class="btn btn-edit" type="button">✏ Edit</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
