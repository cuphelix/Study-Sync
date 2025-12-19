<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
    .page-content {
        max-width: 1400px;
        margin: 0 auto 44px;
    }

    .kal-header-card {
        background:#ffffff;
        border-radius:22px;
        padding:20px 24px;
        border:1px solid #e5e7eb;
        margin-bottom:22px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .kal-title-main {
        display:flex;
        flex-direction:column;
        gap:4px;
    }

    .kal-title-main h2 {
        margin:0;
        font-size:22px;
        font-weight:600;
    }

    .kal-subtitle {
        font-size:14px;
        color:#6b7280;
    }

    .btn-primary {
        border:none;
        border-radius:999px;
        padding:10px 20px;
        background:#6366f1;
        color:#fff;
        font-size:14px;
        font-weight:500;
        cursor:pointer;
    }

    .btn-primary:hover { filter:brightness(1.05); }

    /* Tabs */
    .kal-tabs {
        display:flex;
        gap:22px;
        border-bottom:1px solid #e5e7eb;
        margin-bottom:16px;
        padding:0 4px;
    }

    .kal-tab-link {
        padding:12px 4px;
        font-size:14px;
        color:#6b7280;
        text-decoration:none;
        position:relative;
    }

    .kal-tab-link.active {
        color:#111827;
        font-weight:500;
    }
    .kal-tab-link.active::after {
        content:"";
        position:absolute;
        left:0; right:0; bottom:-1px;
        height:3px;
        border-radius:999px;
        background:#6366f1; /* aksen ungu, sama seperti tombol */
    }

    /* Main layout: kalender + sidebar upcoming */
    .kal-layout {
        display:grid;
        grid-template-columns:minmax(0,4fr) minmax(280px,1.35fr);
        gap:20px;
    }

    .kal-card {
        background:#ffffff;
        border-radius:22px;
        border:1px solid #e5e7eb;
        padding:20px 22px 22px;
    }

    .kal-top-row {
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:18px;
    }

    .kal-month-label {
        font-weight:600;
        font-size:16px;
    }

    .kal-nav {
        display:flex;
        gap:10px;
        align-items:center;
    }
    .kal-nav-btn {
        width:30px;height:30px;
        border-radius:999px;
        border:1px solid #e5e7eb;
        display:flex;align-items:center;justify-content:center;
        background:#fff;
        cursor:pointer;
        font-size:18px;
    }

    .kal-legend {
        display:flex;
        gap:16px;
        font-size:12px;
        margin-right:8px;
    }
    .kal-legend-item {
        display:flex;
        align-items:center;
        gap:6px;
    }
    .kal-dot {
        width:9px;height:9px;border-radius:999px;
    }
    .kal-dot.libur          { background:#ef4444; }
    .kal-dot.deadline_tugas { background:#f97316; }
    .kal-dot.ujian          { background:#3b82f6; }
    .kal-dot.materi_acara   { background:#8b5cf6; }

    /* Kalender grid */
    .kal-weekdays {
        display:grid;
        grid-template-columns:repeat(7,1fr);
        font-size:13px;
        color:#6b7280;
        margin-bottom:6px;
        text-align:center;
        font-weight:500;
    }

    .kal-grid {
        display:grid;
        grid-template-columns:repeat(7,1fr);
        gap:10px;
    }

    .kal-day-cell {
        background:#f9fafb;
        border-radius:18px;
        min-height:110px;
        padding:10px 11px;
        border:1px solid #e5e7eb;
        font-size:13px;
        position:relative;
        display:flex;
        flex-direction:column;
    }

    .kal-day-number {
        font-weight:500;
        margin-bottom:8px;
    }

    .kal-day-today {
        display:inline-flex;
        width:26px;height:26px;
        border-radius:999px;
        background:#6366f1;
        color:#fff;
        align-items:center;
        justify-content:center;
        font-size:12px;
        font-weight:600;
    }

    .kal-event-badge {
        font-size:11px;
        padding:4px 7px;
        border-radius:999px;
        margin-bottom:3px;
        display:inline-block;
        max-width:100%;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
    }
    .kal-event-libur          { background:#fee2e2; color:#b91c1c; }
    .kal-event-deadline_tugas { background:#ffedd5; color:#c2410c; }
    .kal-event-ujian          { background:#dbeafe; color:#1d4ed8; }
    .kal-event-materi_acara   { background:#ede9fe; color:#6d28d9; }

    .kal-empty {
        background:transparent;
        border:none;
    }

    /* Upcoming card */
    .upcoming-card-title {
        font-size:15px;
        font-weight:600;
        margin-bottom:10px;
    }
    .upcoming-item {
        background:#f9fafb;
        border-radius:16px;
        padding:10px 12px;
        margin-bottom:10px;
        font-size:13px;
    }
    .upcoming-date {
        font-size:12px;
        color:#6b7280;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?php
$monthNames = [
    1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
    7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
];

$monthLabel = $monthNames[$month] . ' ' . $year;
$todayDate  = date('Y-m-d');
?>

<div class="kal-header-card">
    <div class="kal-title-main">
        <h2>Manajemen Kalender Akademik</h2>
        <div class="kal-subtitle">Kelola semua kegiatan dan jadwal akademik kampus</div>
    </div>

    <a href="<?= base_url('admin/kalender/create'); ?>">
        <button class="btn-primary">Tambah Kegiatan</button>
    </a>
</div>

<!-- TAB -->
<div class="kal-card" style="padding-bottom:12px;">
    <div class="kal-tabs">
        <a href="<?= base_url('admin/kalender'); ?>" class="kal-tab-link active">Kalender</a>
        <a href="<?= base_url('admin/kalender/tabel'); ?>" class="kal-tab-link">Tabel</a>
    </div>

    <div class="kal-layout" style="margin-top:10px;">
        <!-- KALENDER KIRI -->
        <div class="kal-card" style="padding-top:18px;">
            <div class="kal-top-row">
                <div class="kal-month-label"><?= esc($monthLabel); ?></div>
                <div class="kal-nav">
                    <!-- legend -->
                    <div class="kal-legend">
                        <div class="kal-legend-item">
                            <span class="kal-dot libur"></span><span>Libur</span>
                        </div>
                        <div class="kal-legend-item">
                            <span class="kal-dot deadline_tugas"></span><span>Deadline Tugas</span>
                        </div>
                        <div class="kal-legend-item">
                            <span class="kal-dot ujian"></span><span>Ujian/UTS/UAS</span>
                        </div>
                        <div class="kal-legend-item">
                            <span class="kal-dot materi_acara"></span><span>Materi/Acara</span>
                        </div>
                    </div>

                    <!-- nav month -->
                    <a href="<?= base_url('admin/kalender?month='.$prevMonth.'&year='.$prevYear); ?>" class="kal-nav-btn">&lt;</a>
                    <a href="<?= base_url('admin/kalender?month='.$nextMonth.'&year='.$nextYear); ?>" class="kal-nav-btn">&gt;</a>
                </div>
            </div>

            <!-- header hari -->
            <div class="kal-weekdays">
                <div>Min</div><div>Sen</div><div>Sel</div><div>Rab</div>
                <div>Kam</div><div>Jum</div><div>Sab</div>
            </div>

            <!-- GRID -->
            <div class="kal-grid">
                <?php
                // cell kosong sebelum tgl 1 (startWeekDay=0 Minggu)
                for ($i = 0; $i < $startWeekDay; $i++): ?>
                    <div class="kal-day-cell kal-empty"></div>
                <?php endfor; ?>

                <?php for ($day = 1; $day <= $daysInMonth; $day++):
                    $dateKey   = sprintf('%04d-%02d-%02d', $year, $month, $day);
                    $isToday   = ($dateKey === $todayDate);
                    $dayEvents = $eventsByDate[$dateKey] ?? [];
                ?>
                    <div class="kal-day-cell">
                        <div class="kal-day-number">
                            <?php if ($isToday): ?>
                                <span class="kal-day-today"><?= $day; ?></span>
                            <?php else: ?>
                                <?= $day; ?>
                            <?php endif; ?>
                        </div>

                        <?php foreach ($dayEvents as $ev):
                            $tipe = strtolower($ev['tipe_event'] ?? 'materi_acara');
                            $badgeClass = 'kal-event-materi_acara';
                            if ($tipe === 'libur')            $badgeClass = 'kal-event-libur';
                            elseif ($tipe === 'deadline_tugas') $badgeClass = 'kal-event-deadline_tugas';
                            elseif ($tipe === 'ujian')        $badgeClass = 'kal-event-ujian';
                        ?>
                            <div class="kal-event-badge <?= $badgeClass; ?>">
                                <?= esc($ev['nama_kegiatan']); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- SIDEBAR UPCOMING -->
        <div class="kal-card">
            <div class="upcoming-card-title">Upcoming Events</div>

            <?php if (!empty($upcomingEvents)): ?>
                <?php foreach ($upcomingEvents as $ev): ?>
                    <div class="upcoming-item">
                        <div style="font-weight:500; margin-bottom:2px;">
                            <?= esc($ev['nama_kegiatan']); ?>
                        </div>
                        <div class="upcoming-date">
                            <?= date('j M Y', strtotime($ev['tanggal_mulai'])); ?>
                            <?php if ($ev['tanggal_mulai'] !== $ev['tanggal_selesai']): ?>
                                – <?= date('j M Y', strtotime($ev['tanggal_selesai'])); ?>
                            <?php endif; ?>
                        </div>
                        <?php if (!empty($ev['deskripsi'])): ?>
                            <div style="margin-top:4px; color:#6b7280;">
                                <?= esc($ev['deskripsi']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="upcoming-item" style="text-align:center;color:#9ca3af;">
                    Tidak ada kegiatan mendatang
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
