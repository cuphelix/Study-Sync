<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - StudySync</title>
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

        /* Sidebar */
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

        .header {
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
            margin-bottom: 5px;
        }

        .header p {
            color: #64748b;
            font-size: 14px;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .stat-info h3 {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .stat-info p {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .stat-icon.blue {
            background: #dbeafe;
            color: #2563eb;
        }

        .stat-icon.purple {
            background: #ede9fe;
            color: #7c3aed;
        }

        .stat-icon.orange {
            background: #fed7aa;
            color: #ea580c;
        }

        /* Schedule Section */
        .schedule-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .schedule-header {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 24px;
        }

        .schedule-header h2 {
            font-size: 20px;
            margin-bottom: 4px;
        }

        .schedule-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        /* Schedule Card */
        .schedule-card {
            background: #f8fafc;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 16px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .schedule-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
        }

        .schedule-card:last-child {
            margin-bottom: 0;
        }

        .schedule-card.blue {
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .schedule-card.purple {
            background: #faf5ff;
            border-color: #e9d5ff;
        }

        .schedule-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .schedule-title-section {
            flex: 1;
        }

        .schedule-title {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .schedule-code {
            display: inline-block;
            background: white;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 12px;
            color: #475569;
            margin-right: 8px;
        }

        .schedule-sks {
            display: inline-block;
            background: #3b82f6;
            color: white;
            padding: 4px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .schedule-time {
            display: flex;
            align-items: center;
            gap: 6px;
            color: #475569;
            font-size: 14px;
            white-space: nowrap;
        }

        .schedule-week {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 16px;
        }

        .schedule-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .schedule-detail {
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
            padding: 12px;
            border-radius: 8px;
        }

        .schedule-detail i {
            color: #64748b;
            font-size: 16px;
        }

        .schedule-detail-info h4 {
            font-size: 11px;
            color: #64748b;
            margin-bottom: 4px;
            font-weight: 500;
        }

        .schedule-detail-info p {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
        }

        .no-schedule {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

        .no-schedule i {
            font-size: 48px;
            margin-bottom: 16px;
            opacity: 0.3;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .schedule-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <h2>StudySync</h2>
            <p>Portal Mahasiswa</p>
        </div>

        <div style="margin-top: 30px;">
            <a href="<?= base_url('mahasiswa/dashboard') ?>" class="menu-item active">
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

            <a href="<?= base_url('mahasiswa/kalender') ?>" class="menu-item">
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
        <!-- Header -->
        <div class="header">
            <h1>Dashboard Mahasiswa</h1>
            <p><?= $today ?></p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Jadwal Hari Ini</h3>
                    <p><?= $total_kelas_hari_ini ?> Kelas</p>
                </div>
                <div class="stat-icon blue">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total SKS Semester Ini</h3>
                    <p><?= $total_sks ?> SKS</p>
                </div>
                <div class="stat-icon purple">
                    <i class="fas fa-book"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Pengingat Aktif</h3>
                    <p><?= $total_pengingat ?> Item</p>
                </div>
                <div class="stat-icon orange">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
        </div>

        <!-- Schedule Section -->
        <div class="schedule-section">
            <div class="schedule-header">
                <h2><i class="fas fa-clock"></i> Jadwal Kuliah Hari Ini</h2>
                <p><?= $hari_ini ?>, <?= date('d F Y') ?></p>
            </div>

            <?php if (empty($jadwal_hari_ini)): ?>
                <div class="no-schedule">
                    <i class="fas fa-calendar-check"></i>
                    <p>Tidak ada jadwal kuliah hari ini</p>
                </div>
            <?php else: ?>
                <?php
                $colors = ['blue', 'purple'];
                $colorIndex = 0;
                ?>
                <?php foreach ($jadwal_hari_ini as $jadwal): ?>
                    <div class="schedule-card <?= $colors[$colorIndex % 2] ?>">
                        <div class="schedule-top">
                            <div class="schedule-title-section">
                                <h3 class="schedule-title"><?= esc($jadwal['nama_matakuliah']) ?></h3>
                                <span class="schedule-code"><?= esc($jadwal['kode_matakuliah']) ?></span>
                                <span class="schedule-sks">3 SKS</span>
                            </div>
                            <div class="schedule-time">
                                <i class="far fa-clock"></i>
                                <?= date('H:i', strtotime($jadwal['jam_mulai'])) ?> - <?= date('H:i', strtotime($jadwal['jam_selesai'])) ?>
                            </div>
                        </div>

                        <p class="schedule-week">Minggu ke-<?= $jadwal['minggu_ke'] ?? '11' ?></p>

                        <div class="schedule-details">
                            <div class="schedule-detail">
                                <i class="fas fa-user"></i>
                                <div class="schedule-detail-info">
                                    <h4>Dosen Pengampu</h4>
                                    <p><?= esc($jadwal['nama_dosen']) ?></p>
                                </div>
                            </div>

                            <div class="schedule-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="schedule-detail-info">
                                    <h4>Ruangan</h4>
                                    <p><?= esc($jadwal['kode_kelas']) ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $colorIndex++;
                    ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>