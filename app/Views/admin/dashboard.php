<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
    /* Wrapper konten biar nggak terlalu mepet kanan */
    .page-content {
        max-width: 1360px;
        margin: 0 auto 40px;
    }

    /* ===== STATUS SINKRONISASI ===== */
    .status-card {
        background:#ecfdf5;
        border-radius:20px;
        padding:20px 24px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:26px;
        border:1px solid #bbf7d0;
        min-height:100px;
    }

    .status-main {
        display:flex;
        flex-direction:column;
        gap:8px;
    }

    .status-left-title {
        display:flex;
        align-items:center;
        gap:12px;
        font-weight:600;
        font-size:16px;
    }

    .status-icon-circle {
        width:30px;
        height:30px;
        border-radius:999px;
        background:#22c55e;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:18px;
        color:#fff;
    }

    .status-sub {
        font-size:14px;
        color:#4b5563;
    }

    .status-updated {
        font-size:13px;
        color:#6b7280;
        display:inline-flex;
        align-items:center;
        gap:6px;
        padding:5px 10px;
        border-radius:999px;
        background:#f1f5f9;
    }

    .status-updated-label {
        font-weight:500;
    }

    .badge-success {
        background:#16a34a;
        color:#fff;
        border-radius:999px;
        padding:8px 18px;
        font-size:13px;
        font-weight:500;
    }

    /* ===== KARTU ATAS ===== */
    .grid-cards {
        display:grid;
        grid-template-columns:repeat(5,minmax(0,1fr));
        gap:18px;
        margin-bottom:24px;
    }

    .card {
        border-radius:20px;
        padding:18px 20px;
        border:1px solid #e5e7eb;
        display:flex;
        flex-direction:column;
        justify-content:space-between;
        min-height:140px;
    }

    .card--blue   { background:#e0f2fe; border-color:#dbeafe; }
    .card--purple { background:#f3e8ff; border-color:#e9d5ff; }
    .card--green  { background:#dcfce7; border-color:#bbf7d0; }
    .card--orange { background:#fef3c7; border-color:#fde68a; }
    .card--pink   { background:#ffe4e6; border-color:#fecdd3; }
    .card--indigo { background:#e0e7ff; border-color:#c7d2fe; }

    .card-header {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:10px;
    }
    .card-title { font-size:14px; color:#4b5563; }

    .card-icon {
        width:40px;height:40px;border-radius:14px;
        background:rgba(255,255,255,0.9);
        display:flex;align-items:center;justify-content:center;
        font-size:20px;
    }

    .card-value {
        font-size:26px;
        font-weight:700;
        margin-bottom:4px;
    }
    .card-desc  { font-size:13px;color:#6b7280; }

    /* ===== PANEL TENGAH ===== */
    .mid-grid {
        display:grid;
        grid-template-columns:minmax(0,2.1fr) minmax(0,1.4fr);
        gap:20px;
        margin-bottom:24px;
    }

    .panel {
        background:#ffffff;
        border-radius:20px;
        border:1px solid #e5e7eb;
        display:flex;
        flex-direction:column;
        overflow:hidden;
    }

    .panel-header {
        padding:14px 20px;
        font-size:15px;
        font-weight:600;
        color:#ffffff;
        display:flex;
        align-items:center;
        gap:8px;
    }
    .panel-header--green { background:#16a34a; }
    .panel-header--blue  { background:#2563eb; }

    .panel-body { padding:14px 20px 18px; }

    .info-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:12px 16px;
        background:#f9fafb;
        border-radius:14px;
        font-size:14px;
        margin-bottom:10px;
    }
    .info-row:last-child { margin-bottom:0; }

    .info-label { color:#6b7280; }
    .info-value { font-weight:500; }
    .badge-semester {
        background:#22c55e;color:#fff;
        font-size:12px;padding:5px 12px;border-radius:999px;
    }

    .activity-item {
        display:flex;
        justify-content:space-between;
        align-items:flex-start;
        padding:12px 16px;
        background:#f9fafb;
        border-radius:14px;
        font-size:14px;
        margin-bottom:10px;
    }
    .activity-item:last-child { margin-bottom:0; }

    .activity-main-title { font-weight:500; }
    .activity-meta { font-size:12px;color:#9ca3af;margin-top:2px; }
    .badge-status {
        background:#16a34a;color:#fff;
        padding:5px 12px;border-radius:999px;
        font-size:12px;
    }

    /* ===== RINGKASAN BAWAH ===== */
    .summary-panel {
        background:#ffffff;
        border-radius:20px;
        border:1px solid #e5e7eb;
        padding:16px 20px 20px;
    }
    .summary-title { font-size:15px;font-weight:600;margin-bottom:14px; }

    .summary-grid {
        display:grid;
        grid-template-columns:repeat(6,minmax(0,1fr));
        gap:14px;
    }

    .summary-card {
        border-radius:18px;
        padding:14px 12px;
        text-align:center;
        font-size:13px;
    }
    .summary-value { font-size:22px;font-weight:600;margin-bottom:4px; }
    .summary-label { color:#6b7280; }

    @media (max-width:1200px) {
        .grid-cards   { grid-template-columns:repeat(3,minmax(0,1fr)); }
        .summary-grid { grid-template-columns:repeat(3,minmax(0,1fr)); }
    }
    @media (max-width:900px) {
        .mid-grid { grid-template-columns:1fr; }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
// lastSync bisa dikirim dari controller, kalau nggak ada pakai waktu sekarang
$lastSyncRaw  = $lastSync ?? date('Y-m-d H:i:s');
$lastSyncText = date('j F Y, H:i', strtotime($lastSyncRaw));
?>

<!-- STATUS SINKRONISASI -->
<section class="status-card">
    <div class="status-main">
        <div class="status-left-title">
            <div class="status-icon-circle">✓</div>
            <span>Status Sinkronisasi</span>
        </div>
        <div class="status-sub">Semua data berhasil disinkronkan</div>
        <div class="status-updated">
            <span class="status-updated-label">Terakhir diperbarui:</span>
            <span><?= esc($lastSyncText); ?></span>
        </div>
    </div>
    <div>
        <span class="badge-success">Berhasil</span>
    </div>
</section>

<!-- KARTU ATAS -->
<section class="grid-cards">
    <div class="card card--blue">
        <div class="card-header">
            <div class="card-title">Total Mahasiswa</div>
            <div class="card-icon">👥</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_mahasiswa']); ?></div>
            <div class="card-desc"><?= esc($semester['mahasiswa_aktif']); ?> aktif semester ini</div>
        </div>
    </div>

    <div class="card card--purple">
        <div class="card-header">
            <div class="card-title">Total Dosen</div>
            <div class="card-icon">👨‍🏫</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_dosen']); ?></div>
            <div class="card-desc">Pengajar aktif</div>
        </div>
    </div>

    <div class="card card--green">
        <div class="card-header">
            <div class="card-title">Total Mata Kuliah</div>
            <div class="card-icon">📘</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_matakuliah']); ?></div>
            <div class="card-desc">Berbagai program studi</div>
        </div>
    </div>

    <div class="card card--orange">
        <div class="card-header">
            <div class="card-title">Total Ruangan</div>
            <div class="card-icon">🏛</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_ruangan']); ?></div>
            <div class="card-desc">Lab & kelas tersedia</div>
        </div>
    </div>

    <div class="card card--indigo">
        <div class="card-header">
            <div class="card-title">Event Kalender</div>
            <div class="card-icon">📅</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_event']); ?></div>
            <div class="card-desc"><?= esc($upcoming_exam); ?> ujian mendatang</div>
        </div>
    </div>
</section>

<!-- KARTU RUANGAN & JADWAL -->
<section class="grid-cards" style="grid-template-columns:repeat(2,minmax(0,1fr));margin-bottom:6px;">
    <div class="card card--orange">
        <div class="card-header">
            <div class="card-title">Total Ruangan</div>
            <div class="card-icon">🏛</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_ruangan']); ?></div>
            <div class="card-desc">Lab & kelas tersedia</div>
        </div>
    </div>

    <div class="card card--pink">
        <div class="card-header">
            <div class="card-title">Total Jadwal</div>
            <div class="card-icon">⏰</div>
        </div>
        <div>
            <div class="card-value"><?= esc($cards['total_jadwal']); ?></div>
            <div class="card-desc"><?= esc($semester['kelas_berjalan']); ?> kelas aktif</div>
        </div>
    </div>
</section>

<!-- INFORMASI SEMESTER AKTIF & AKTIVITAS TERBARU -->
<section class="mid-grid">
    <div class="panel">
        <div class="panel-header panel-header--green">
            <span>📈</span> <span>Informasi Semester Aktif</span>
        </div>
        <div class="panel-body">
            <div class="info-row">
                <span class="info-label">Semester</span>
                <span class="badge-semester"><?= esc($semester['label_semester']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Mahasiswa Aktif</span>
                <span class="info-value"><?= esc($semester['mahasiswa_aktif']); ?> Mahasiswa</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kelas Berjalan</span>
                <span class="info-value"><?= esc($semester['kelas_berjalan']); ?> Kelas</span>
            </div>
            <div class="info-row">
                <span class="info-label">Ujian Mendatang</span>
                <span class="info-value"><?= esc($semester['ujian_mendatang']); ?> Event</span>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-header panel-header--blue">
            <span>🕒</span> <span>Aktivitas Terbaru</span>
        </div>
        <div class="panel-body">
            <?php if (!empty($activities)): ?>
                <?php foreach ($activities as $act): ?>
                    <div class="activity-item">
                        <div>
                            <div class="activity-main-title"><?= esc($act['judul']); ?></div>
                            <div class="activity-meta">
                                <?= esc($act['jumlah']); ?> • <?= esc($act['tanggal']); ?>
                            </div>
                        </div>
                        <div>
                            <span class="badge-status"><?= esc($act['status']); ?></span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="font-size:13px;color:#9ca3af;">Belum ada aktivitas terbaru.</div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- RINGKASAN DATA SISTEM -->
<section class="summary-panel">
    <div class="summary-title">Ringkasan Data Sistem</div>
    <div class="summary-grid">
        <div class="summary-card" style="background:#eef2ff;">
            <div class="summary-value"><?= esc($cards['total_mahasiswa']); ?></div>
            <div class="summary-label">Mahasiswa</div>
        </div>
        <div class="summary-card" style="background:#f3e8ff;">
            <div class="summary-value"><?= esc($cards['total_dosen']); ?></div>
            <div class="summary-label">Dosen</div>
        </div>
        <div class="summary-card" style="background:#dcfce7;">
            <div class="summary-value"><?= esc($cards['total_matakuliah']); ?></div>
            <div class="summary-label">Mata Kuliah</div>
        </div>
        <div class="summary-card" style="background:#fef3c7;">
            <div class="summary-value"><?= esc($cards['total_ruangan']); ?></div>
            <div class="summary-label">Ruangan</div>
        </div>
        <div class="summary-card" style="background:#ffe4e6;">
            <div class="summary-value"><?= esc($cards['total_jadwal']); ?></div>
            <div class="summary-label">Jadwal</div>
        </div>
        <div class="summary-card" style="background:#e0e7ff;">
            <div class="summary-value"><?= esc($cards['total_event']); ?></div>
            <div class="summary-label">Event</div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>
