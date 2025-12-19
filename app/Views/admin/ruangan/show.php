<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
.page-content {
    max-width:1100px;
    margin:24px auto;
    padding:12px;
    font-family: 'Poppins', sans-serif;
}

/* Card utama */
.card {
    background:#fff;
    border-radius:14px;
    border:1px solid #eef2f6;
    padding:24px;
    box-shadow:0 8px 24px rgba(15,23,42,0.04);
}

/* Layout dua kolom */
.row {
    display:flex;
    gap:26px;
    flex-wrap:wrap;
}

.col { flex:1; min-width:300px; }

/* Label & Value */
.kv {
    color:#6b7280;
    font-size:13px;
    margin-bottom:4px;
}
.val {
    font-weight:700;
    font-size:15px;
    margin-bottom:16px;
    color:#0f172a;
}

/* Box kecil */
.small-box {
    background:#f8fafb;
    padding:16px;
    border-radius:12px;
    text-align:center;
    border:1px solid #eef2f6;
}

/* Badge tipe */
.badge {
    padding:6px 14px;
    border-radius:999px;
    font-size:13px;
    font-weight:600;
    color:#fff;
}
.badge-lab { background:#a855f7; }
.badge-class { background:#2563eb; }
.badge-aud { background:#10b981; }

/* Tombol */
.btn {
    padding:10px 14px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
}
.btn-back { background:#eef2f2; color:#111827; margin-right:6px; }
.btn-edit { background:#e6f4ff; color:#1d4ed8; }

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="page-content">

    <!-- Header -->
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;">
        <div>
            <h2 style="margin:0;">Detail Ruangan</h2>
            <div style="color:#6b7280;font-size:13px;">Informasi lengkap ruangan / kelas</div>
        </div>

        <div>
            <a href="<?= base_url('admin/ruangan'); ?>" class="btn btn-back">← Kembali</a>
            <a href="<?= base_url('admin/ruangan/edit/'.$ruangan['id_kelas']); ?>" class="btn btn-edit">✏ Edit</a>
        </div>
    </div>

    <!-- Card -->
    <div class="card">
        <div class="row">

            <!-- Kolom kiri -->
            <div class="col">

                <div class="kv">Kode Ruangan</div>
                <div class="val"><?= esc($ruangan['kode_kelas']); ?></div>

                <div class="kv">Nama Ruangan</div>
                <div class="val"><?= esc($ruangan['kode_kelas']); ?></div>

                <div class="kv">Lokasi</div>
                <div class="val">
                    <?= esc($ruangan['nama_gedung'] ?? '-') ?>
                    • Lt. <?= esc($ruangan['lantai'] ?? '-') ?>
                </div>

            </div>

            <!-- Kolom kanan -->
            <div class="col">

                <?php
                    $kode = strtoupper($ruangan['kode_kelas'] ?? '');
                    if (strpos($kode, 'LAB') !== false) { $tipe = 'Laboratorium'; $badge='badge-lab'; }
                    elseif (strpos($kode, 'AUD') !== false) { $tipe = 'Auditorium'; $badge='badge-aud'; }
                    else { $tipe = 'Ruang Kelas'; $badge='badge-class'; }
                ?>

                <div class="small-box">
                    <div class="kv" style="margin-bottom:6px;">Jenis</div>
                    <span class="badge <?= $badge ?>"><?= $tipe ?></span>
                </div>

                <div style="margin-top:20px;">
                    <div class="kv">ID Kelas</div>
                    <div class="val"><?= esc($ruangan['id_kelas']); ?></div>

                    <div class="kv">ID Gedung</div>
                    <div class="val"><?= esc($ruangan['id_gedung'] ?? '-'); ?></div>
                </div>

            </div>

        </div>
    </div>
</div>
<?= $this->endSection() ?>
