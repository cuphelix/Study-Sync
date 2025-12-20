<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
    :root{
        --card-radius:20px;
        --muted: #6b7280;
        --border: #e5e7eb;
    }

    .page-content {
        max-width: 1360px;
        margin: 0 auto 56px;
        padding: 8px 12px;
    }

    /* Card ringkasan */
    .dosen-summary-grid {
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:20px;
        margin-bottom:22px;
    }

    .dosen-card {
        border-radius:var(--card-radius);
        padding:20px 22px;
        border:1px solid var(--border);
        display:flex;
        justify-content:space-between;
        align-items:center;
        min-height:100px;
        box-shadow: 0 1px 0 rgba(0,0,0,0.02);
    }
    .dosen-card--blue   { background:#e8f6ff; border-color:#dbeafe; }
    .dosen-card--green  { background:#f0fbef; border-color:#bbf7d0; }
    .dosen-card--purple { background:#fbf2ff; border-color:#efe1ff; }

    .dosen-card-title { font-size:13px; color:var(--muted); margin-bottom:6px; }
    .dosen-card-value { font-size:28px; font-weight:700; line-height:1; }
    .dosen-card-sub { font-size:13px; color:var(--muted); }

    .dosen-card-icon {
        width:48px;
        height:48px;
        border-radius:14px;
        background:rgba(255,255,255,0.95);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:20px;
        box-shadow:0 1px 0 rgba(0,0,0,0.02);
    }

    /* Container list */
    .dosen-list-card {
        background:#ffffff;
        border-radius:var(--card-radius);
        border:1px solid var(--border);
        padding:18px 20px 24px;
    }

    .dosen-list-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:14px;
        gap:12px;
    }

    .dosen-list-title {
        font-size:18px;
        font-weight:700;
        color:#111827;
    }

    /* Search */
    .dosen-search-box {
        display:flex;
        align-items:center;
        gap:10px;
        border-radius:999px;
        border:1px solid var(--border);
        padding:10px 14px;
        max-width:520px;
        background:#f8fafb;
    }

    .dosen-search-box input {
        border:none;
        outline:none;
        background:transparent;
        font-size:14px;
        flex:1;
        font-family:inherit;
    }

    /* Table wrapper */
    .dosen-table-wrapper {
        margin-top:10px;
        overflow-x:auto;
    }

    table.dosen-table {
        width:100%;
        border-collapse:separate;
        border-spacing:0;
        font-size:14px;
        min-width: 980px;
    }

    .dosen-table thead {
        position: sticky;
        top: 0;
        background: #fff;
        z-index: 2;
    }

    .dosen-table thead tr {
        background: #ffffff;
    }

    .dosen-table th,
    .dosen-table td {
        padding:14px 12px;
        border-bottom:1px solid var(--border);
        text-align:left;
        vertical-align:middle;
    }

    .dosen-table th {
        font-weight:600;
        color:var(--muted);
        font-size:13px;
    }

    /* row style */
    .dosen-table tbody tr {
        transition: background .12s ease;
    }
    .dosen-table tbody tr:hover {
        background: #fbfbfd;
    }

    /* name block */
    .dosen-name {
        font-weight:700;
        font-size:14px;
        margin-bottom:4px;
    }
    .dosen-subsmall {
        font-size:12px;
        color:var(--muted);
    }

    .small-muted {
        font-size:13px;
        color:var(--muted);
    }

    /* WA link */
    .wa-link {
        color:var(--muted);
        text-decoration: none;
        font-size:13px;
    }

    /* action buttons */
    .btn-sm {
        border:none;
        border-radius:999px;
        padding:8px 12px;
        font-size:13px;
        cursor:pointer;
        display:inline-flex;
        align-items:center;
        gap:8px;
        box-shadow: 0 1px 0 rgba(0,0,0,0.03);
    }

    .btn-view  { background:#eef2f2; color:#1f2937; }
    .btn-edit  { background:#e6f4ff; color:#1d4ed8; }

    .btn-icon { font-size:15px; }

    /* responsive: sembunyikan email di layar lebih kecil */
    @media (max-width:1100px) {
        .col-email { display:none; }
    }
    @media (max-width:900px) {
        .dosen-summary-grid { grid-template-columns:1fr; gap:14px; }
        .col-kelas, .col-mk { display:none; }
        table.dosen-table { min-width: 720px; }
    }

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="page-content">

    <!-- CARD RINGKASAN -->
    <section class="dosen-summary-grid">
        <div class="dosen-card dosen-card--blue">
            <div>
                <div class="dosen-card-title">Total Dosen</div>
                <div class="dosen-card-value"><?= esc($cards['total_dosen']); ?></div>
                <div class="dosen-card-sub">&nbsp;</div>
            </div>
            <div class="dosen-card-icon">👨‍🏫</div>
        </div>

        <div class="dosen-card dosen-card--green">
            <div>
                <div class="dosen-card-title">Dosen Aktif</div>
                <div class="dosen-card-value"><?= esc($cards['dosen_aktif']); ?></div>
                <div class="dosen-card-sub">Sedang mengajar</div>
            </div>
            <div class="dosen-card-icon">✅</div>
        </div>

        <div class="dosen-card dosen-card--purple">
            <div>
                <div class="dosen-card-title">Total Mata Kuliah</div>
                <div class="dosen-card-value"><?= esc($cards['total_matakuliah']); ?></div>
                <div class="dosen-card-sub">Diampu oleh seluruh dosen</div>
            </div>
            <div class="dosen-card-icon">📘</div>
        </div>
    </section>

                <!-- DOSEN INDEX -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
        <h1>Manajemen Dosen</h1>
        <a href="<?= base_url('admin/dosen/create'); ?>">
            <button style="border:none;border-radius:999px;padding:10px 20px;background:#16a34a;color:#fff;font-size:14px;font-weight:500;cursor:pointer;">
                + Tambah Dosen
            </button>
        </a>
    </div>

    <!-- LIST DOSEN -->
    <section class="dosen-list-card">
        <div class="dosen-list-header">
            <div class="dosen-list-title">Daftar Dosen</div>

            <form method="get" action="<?= base_url('admin/dosen'); ?>">
                <div class="dosen-search-box" role="search" aria-label="Cari dosen">
                    <span class="btn-icon">🔍</span>
                    <input type="text"
                           name="q"
                           placeholder="Cari dosen (NIP, nama, email)..."
                           value="<?= esc($keyword); ?>">
                </div>
            </form>
        </div>

        <div class="dosen-table-wrapper">
            <table class="dosen-table" aria-describedby="daftar-dosen">
                <thead>
                    <tr>
                        <th style="width:150px;">NIP</th>
                        <th>Nama</th>
                        <th class="col-email">Email</th>
                        <th style="width:140px;">No. WA</th>
                        <th class="col-mk" style="width:90px;">Mata Kuliah</th>
                        <th class="col-kelas" style="width:90px;">Kelas</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($dosen)): ?>
                        <?php foreach ($dosen as $d): ?>
                            <tr>
                                <td class="small-muted"><?= esc($d['nip']); ?></td>

                                <td>
                                    <div class="dosen-name"><?= esc($d['nama_dosen']); ?></div>
                                </td>

                                <!-- Email -->
                                <td class="col-email">
                                    <?php if (!empty($d['email'])): ?>
                                        <a href="mailto:<?= esc($d['email']); ?>" class="small-muted">
                                            <?= esc($d['email']); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="small-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- No WA -->
                                <td>
                                    <?php if (!empty($d['no_wa'])): ?>
                                        <a href="https://wa.me/<?= preg_replace('/\D+/', '', $d['no_wa']); ?>" target="_blank" class="wa-link" rel="noopener">
                                            <?= esc($d['no_wa']); ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="small-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <!-- jumlah mata kuliah & kelas hasil agregasi -->
                                <td class="col-mk" style="text-align:center;"><?= (int) ($d['total_mk'] ?? 0); ?></td>
                                <td class="col-kelas" style="text-align:center;"><?= (int) ($d['total_kelas'] ?? 0); ?></td>

                                <td>
                                    <a href="<?= base_url('admin/dosen/'.$d['id_dosen']); ?>">
                                        <button class="btn-sm btn-view" type="button" aria-label="Lihat <?= esc($d['nama_dosen']); ?>">
                                            <span class="btn-icon">👁</span> Lihat
                                        </button>
                                    </a>

                                    <a href="<?= base_url('admin/dosen/edit/'.$d['id_dosen']); ?>">
                                        <button class="btn-sm btn-edit" type="button" aria-label="Edit <?= esc($d['nama_dosen']); ?>">
                                            <span class="btn-icon">✏</span> Edit
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align:center;color:#9ca3af; padding:30px 12px;">
                                Belum ada data dosen.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>

<?= $this->endSection() ?>
