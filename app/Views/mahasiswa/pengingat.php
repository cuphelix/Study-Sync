<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengingat - StudySync</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #1e293b;
        }

        /* Reminder Cards */
        .reminder-grid {
            display: grid;
            gap: 20px;
            max-width: 900px;
        }

        .reminder-card {
            background: white;
            padding: 24px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }

        .reminder-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 12px;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            font-size: 18px;
        }

        .card-title {
            flex: 1;
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
        }

        .card-desc {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 16px;
            line-height: 1.6;
        }

        .card-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 13px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            font-size: 14px;
            color: #475569;
        }

        .meta-item i {
            color: #94a3b8;
        }

        .card-labels {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .label {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
        }

        .label-orange {
            background: #FBE4C7;
            color: #B76E00;
        }

        .label-red {
            background: #FFD4D4;
            color: #c0392b;
        }

        .label-grey {
            background: #E5E5E5;
            color: #333;
        }

        .label-black {
            background: #222;
            color: white;
        }

        .label-green {
            background: #d1fae5;
            color: #065f46;
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
    <!-- Sidebar -->
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

            <a href="<?= base_url('mahasiswa/pengingat') ?>" class="menu-item active">
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
        <div class="header">
            <h1>Pengingat</h1>
        </div>

        <div class="reminder-grid">


            <!-- Dynamic Cards from Database -->
            <?php if (!empty($pengingat)): ?>
                <?php foreach ($pengingat as $p): ?>
                    <div class="reminder-card">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-bell"></i>
                            </div>
                            <div style="flex: 1;">
                                <div class="card-title"><?= esc($p['judul']) ?></div>
                                <div class="card-desc"><?= esc($p['deskripsi']) ?></div>
                            </div>
                        </div>

                        <div class="card-meta">
                            <div class="meta-item">
                                <i class="far fa-calendar"></i>
                                <?php
                                setlocale(LC_TIME, 'id_ID');
                                echo date('l, d F Y', strtotime($p['tanggal']));
                                ?>
                            </div>
                            <div class="meta-item">
                                <i class="far fa-clock"></i>
                                <?= esc($p['waktu']) ?>
                            </div>
                        </div>

                        <div class="card-labels">
                            <span class="label label-green">Aktif</span>
                            <span class="label label-grey">Pribadi</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>