<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik - StudySync</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar - sama seperti halaman lain */
        .sidebar {
            width: 250px;
            background: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 0 20px;
            margin-bottom: 10px;
        }

        .logo h2 {
            font-size: 22px;
            color: #2563eb;
            font-weight: 700;
        }

        .logo p {
            font-size: 13px;
            color: #64748b;
            margin-top: 2px;
        }

        .menu-item {
            padding: 14px 20px;
            display: flex;
            align-items: center;
            color: #475569;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background: #f1f5f9;
            color: #2563eb;
        }

        .menu-item.active {
            background: #eff6ff;
            color: #2563eb;
            border-left-color: #2563eb;
        }

        .menu-item i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        .menu-divider {
            height: 1px;
            background: #e2e8f0;
            margin: 10px 20px;
        }

        .menu-item.logout {
            color: #dc2626;
            margin-top: 10px;
        }

        .menu-item.logout:hover {
            background: #fef2f2;
            color: #dc2626;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 30px;
        }

        /* Layout kalender & event */
        .calendar-wrapper {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        /* Kalender Container */
        .calendar-container {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .calendar-header {
            background: #2563eb;
            color: white;
            padding: 15px 20px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .calendar-nav {
            color: white;
            text-decoration: none;
            font-size: 20px;
            padding: 5px 10px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }

        .day-name {
            background: #f8fafc;
            padding: 12px;
            text-align: center;
            font-weight: 600;
            color: #475569;
            font-size: 14px;
        }

        .day-box {
            background: white;
            padding: 10px;
            min-height: 90px;
            position: relative;
        }

        .day-box strong {
            font-weight: 600;
            color: #1e293b;
            font-size: 14px;
        }

        .event {
            margin-top: 4px;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 11px;
            color: white;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .red {
            background: #ef4444;
        }

        .green {
            background: #10b981;
        }

        .purple {
            background: #8b5cf6;
        }

        .orange {
            background: #f59e0b;
        }

        .blue {
            background: #3b82f6;
        }

        /* Upcoming Events */
        .upcoming-container {
            width: 320px;
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            max-height: 80vh;
            overflow-y: auto;
            position: sticky;
            top: 20px;
        }

        .upcoming-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }

        .upcoming-item {
            background: #f8fafc;
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 12px;
            border-left: 4px solid #8b5cf6;
            transition: all 0.3s;
        }

        .upcoming-item:hover {
            transform: translateX(5px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .upcoming-event-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #1e293b;
        }

        .upcoming-date {
            font-size: 13px;
            color: #64748b;
        }

        /* Legend */
        .legend-box {
            margin-top: 20px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        }

        .legend-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #1e293b;
        }

        .legend-items {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            font-size: 14px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .legend-color {
            width: 15px;
            height: 15px;
            border-radius: 3px;
        }

        @media (max-width: 1024px) {
            .calendar-wrapper {
                flex-direction: column;
            }

            .upcoming-container {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar DIPERBAIKI -->
    <div class="sidebar">
        <div class="logo">
            <h2>StudySync</h2>
            <p>Portal Mahasiswa</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="<?= base_url('mahasiswa/dashboard') ?>" class="menu-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('mahasiswa/jadwal') ?>" class="menu-item">
                <i class="fas fa-clock"></i>
                <span>Jadwal Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/matakuliah') ?>" class="menu-item">
                <i class="fas fa-book"></i>
                <span>Mata Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/pengingat') ?>" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Pengingat</span>
            </a>

            <a href="<?= base_url('mahasiswa/kalender') ?>" class="menu-item active">
                <i class="fas fa-calendar"></i>
                <span>Kalender Akademik</span>
            </a>

            <a href="<?= base_url('mahasiswa/profil') ?>" class="menu-item">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>
        </div>

        <div class="menu-divider"></div>

        <a href="<?= base_url('logout') ?>" class="menu-item logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Keluar</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Kalender Akademik</h1>
        </div>

        <div class="calendar-wrapper">
            <!-- Kalender -->
            <div style="flex: 1;">
                <div class="calendar-container">
                    <?php
                    $monthNames = [
                        1 => 'Januari',
                        2 => 'Februari',
                        3 => 'Maret',
                        4 => 'April',
                        5 => 'Mei',
                        6 => 'Juni',
                        7 => 'Juli',
                        8 => 'Agustus',
                        9 => 'September',
                        10 => 'Oktober',
                        11 => 'November',
                        12 => 'Desember'
                    ];

                    $monthName = $monthNames[(int)$month];
                    $daysInMonth = date('t', strtotime("$year-$month-01"));
                    $firstDay = date('N', strtotime("$year-$month-01"));

                    $prevMonth = $month - 1;
                    $prevYear = $year;
                    if ($prevMonth < 1) {
                        $prevMonth = 12;
                        $prevYear--;
                    }

                    $nextMonth = $month + 1;
                    $nextYear = $year;
                    if ($nextMonth > 12) {
                        $nextMonth = 1;
                        $nextYear++;
                    }
                    ?>

                    <div class="calendar-header">
                        <a href="?month=<?= $prevMonth ?>&year=<?= $prevYear ?>" class="calendar-nav">◀</a>
                        <span><?= $monthName . " " . $year ?></span>
                        <a href="?month=<?= $nextMonth ?>&year=<?= $nextYear ?>" class="calendar-nav">▶</a>
                    </div>

                    <div class="calendar-grid">
                        <div class="day-name">Min</div>
                        <div class="day-name">Sen</div>
                        <div class="day-name">Sel</div>
                        <div class="day-name">Rab</div>
                        <div class="day-name">Kam</div>
                        <div class="day-name">Jum</div>
                        <div class="day-name">Sab</div>

                        <?php for ($i = 1; $i < $firstDay; $i++): ?>
                            <div class="day-box"></div>
                        <?php endfor; ?>

                        <?php for ($d = 1; $d <= $daysInMonth; $d++): ?>
                            <?php $currentDate = "$year-" . str_pad($month, 2, '0', STR_PAD_LEFT) . "-" . str_pad($d, 2, '0', STR_PAD_LEFT); ?>

                            <div class="day-box">
                                <strong><?= $d ?></strong>

                                <?php foreach ($events as $ev): ?>
                                    <?php if ($currentDate >= $ev['tanggal_mulai'] && $currentDate <= $ev['tanggal_selesai']): ?>
                                        <?php
                                        $color = 'purple';
                                        if (stripos($ev['nama_kegiatan'], 'UTS') !== false || stripos($ev['nama_kegiatan'], 'UAS') !== false) $color = 'red';
                                        if (stripos($ev['nama_kegiatan'], 'Libur') !== false) $color = 'green';
                                        if (stripos($ev['nama_kegiatan'], 'Deadline') !== false || stripos($ev['nama_kegiatan'], 'Tugas') !== false) $color = 'orange';
                                        if (stripos($ev['nama_kegiatan'], 'Registrasi') !== false) $color = 'blue';
                                        ?>
                                        <div class="event <?= $color ?>">
                                            <?= esc($ev['nama_kegiatan']) ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>

                <!-- Legend -->
                <div class="legend-box">
                    <h3 class="legend-title">Keterangan</h3>
                    <div class="legend-items">
                        <div class="legend-item">
                            <span class="legend-color" style="background:#ef4444;"></span>
                            <span>Ujian</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#f59e0b;"></span>
                            <span>Tugas</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#10b981;"></span>
                            <span>Libur</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#3b82f6;"></span>
                            <span>Registrasi</span>
                        </div>
                        <div class="legend-item">
                            <span class="legend-color" style="background:#8b5cf6;"></span>
                            <span>Acara</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Upcoming Events -->
            <div class="upcoming-container">
                <h3 class="upcoming-title">Event Mendatang</h3>

                <?php if (!empty($upcoming)): ?>
                    <?php foreach ($upcoming as $ev): ?>
                        <?php
                        $colorLeft = '#8b5cf6';
                        if (stripos($ev['nama_kegiatan'], 'UTS') !== false || stripos($ev['nama_kegiatan'], 'UAS') !== false) $colorLeft = '#ef4444';
                        if (stripos($ev['nama_kegiatan'], 'Libur') !== false) $colorLeft = '#10b981';
                        if (stripos($ev['nama_kegiatan'], 'Deadline') !== false || stripos($ev['nama_kegiatan'], 'Tugas') !== false) $colorLeft = '#f59e0b';
                        if (stripos($ev['nama_kegiatan'], 'Registrasi') !== false) $colorLeft = '#3b82f6';
                        ?>

                        <div class="upcoming-item" style="border-left-color:<?= $colorLeft ?>;">
                            <div class="upcoming-event-title"><?= esc($ev['nama_kegiatan']) ?></div>
                            <div class="upcoming-date">
                                <?= date('d M', strtotime($ev['tanggal_mulai'])) ?>
                                <?php if ($ev['tanggal_mulai'] != $ev['tanggal_selesai']): ?>
                                    – <?= date('d M', strtotime($ev['tanggal_selesai'])) ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="color:#64748b; text-align: center; padding: 20px;">Tidak ada event mendatang.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>