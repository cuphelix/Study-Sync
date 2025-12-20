<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa - StudySync</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .logo i {
            font-size: 24px;
            color: #667eea;
            margin-right: 10px;
        }

        .logo span {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .menu-item {
            padding: 15px 20px;
            display: flex;
            align-items: center;
            color: #666;
            text-decoration: none;
            transition: all 0.3s;
            cursor: pointer;
        }

        .menu-item:hover {
            background: #f5f5f5;
            color: #667eea;
        }

        .menu-item.active {
            background: #f0f4ff;
            color: #667eea;
            border-right: 3px solid #667eea;
        }

        .menu-item i {
            margin-right: 15px;
            font-size: 18px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-title {
            color: white;
            font-size: 32px;
            margin-bottom: 30px;
            font-weight: 600;
        }

        /* Alert Messages */
        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }

        /* Profile Header */
        .profile-header {
            background: linear-gradient(135deg, #5e72e4 0%, #825ee4 100%);
            border-radius: 20px 20px 0 0;
            padding: 40px;
            position: relative;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .profile-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .profile-avatar-section {
            display: flex;
            align-items: center;
            gap: 30px;
        }

        .avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            border: 5px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .profile-info {
            color: white;
        }

        .profile-name {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .profile-badges {
            display: flex;
            gap: 10px;
            margin-bottom: 8px;
            flex-wrap: wrap;
        }

        .badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 13px;
            backdrop-filter: blur(10px);
        }

        .badge.primary {
            background: #10b981;
        }

        .profile-details {
            font-size: 14px;
            opacity: 0.95;
        }

        .edit-btn {
            background: white;
            color: #667eea;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s;
            text-decoration: none;
        }

        .edit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* Profile Body */
        .profile-body {
            background: white;
            border-radius: 0 0 20px 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 30px;
        }

        .info-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
        }

        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #667eea;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .info-row:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            color: #666;
            font-size: 14px;
        }

        .info-value {
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        /* Status Card */
        .status-card {
            background: linear-gradient(135deg, #e0f2fe 0%, #ddd6fe 100%);
            padding: 30px;
            border-radius: 15px;
            text-align: center;
        }

        .status-title {
            font-size: 16px;
            color: #666;
            margin-bottom: 15px;
        }

        .ipk-display {
            font-size: 48px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 20px;
        }

        .status-badge {
            background: #667eea;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 15px;
        }

        .status-info {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid rgba(102, 126, 234, 0.2);
        }

        .status-item {
            text-align: center;
        }

        .status-item-label {
            color: #666;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .status-item-value {
            color: #333;
            font-weight: 600;
            font-size: 16px;
        }

        /* SKS Card */
        .sks-card {
            background: linear-gradient(135deg, #f3e8ff 0%, #e0e7ff 100%);
            padding: 30px;
            border-radius: 15px;
        }

        .sks-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .sks-title {
            font-size: 16px;
            color: #666;
        }

        .sks-value {
            font-size: 36px;
            font-weight: bold;
            color: #8b5cf6;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sks-subtitle {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .progress-bar {
            background: rgba(139, 92, 246, 0.2);
            height: 10px;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .progress-fill {
            background: #8b5cf6;
            height: 100%;
            border-radius: 10px;
            transition: width 0.3s;
        }

        .progress-label {
            text-align: right;
            color: #8b5cf6;
            font-weight: 600;
            font-size: 14px;
        }

        /* Riwayat Akademik */
        .academic-history {
            margin-top: 30px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
        }

        .history-table thead {
            background: #f8f9fa;
        }

        .history-table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        .history-table td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
        }

        .status-badge-table {
            background: #10b981;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }

            .profile-avatar-section {
                flex-direction: column;
                text-align: center;
            }

            .profile-top {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-book"></i>
                <span>StudySync</span>
            </div>

            <a href="<?= base_url('mahasiswa/dashboard') ?>" class="menu-item">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            <a href="<?= base_url('mahasiswa/jadwal') ?>" class="menu-item">
                <i class="fas fa-clock"></i>
                <span>Jadwal Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/matakuliah') ?>" class="menu-item">
                <i class="fas fa-book-open"></i>
                <span>Mata Kuliah</span>
            </a>

            <a href="<?= base_url('mahasiswa/pengingat') ?>" class="menu-item">
                <i class="fas fa-bell"></i>
                <span>Pengingat</span>
            </a>

            <a href="<?= base_url('mahasiswa/kalender') ?>" class="menu-item">
                <i class="fas fa-calendar-alt"></i>
                <span>Kalender Akademik</span>
            </a>

            <a href="<?= base_url('mahasiswa/profil') ?>" class="menu-item active">
                <i class="fas fa-user"></i>
                <span>Profil</span>
            </a>

            <a href="<?= base_url('logout') ?>" class="menu-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>Log Out</span>
            </a>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1 class="page-title">Profil Mahasiswa</h1>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <!-- Profile Header -->
            <div class="profile-header">
                <div class="profile-top">
                    <div class="profile-avatar-section">
                        <div class="avatar">
                            <?php
                            $nama = $mahasiswa['nama_mahasiswa'];
                            $words = explode(' ', $nama);
                            $initials = '';
                            foreach ($words as $word) {
                                $initials .= strtoupper(substr($word, 0, 1));
                            }
                            echo substr($initials, 0, 2);
                            ?>
                        </div>
                        <div class="profile-info">
                            <h2 class="profile-name"><?= esc($mahasiswa['nama_mahasiswa']) ?></h2>
                            <div class="profile-badges">
                                <span class="badge"><?= esc($mahasiswa['nim']) ?></span>
                                <span class="badge"><?= esc($mahasiswa['nama_jurusan']) ?></span>
                                <span class="badge primary">NIM</span>
                            </div>
                            <p class="profile-details">Semester <?= $mahasiswa['semester'] ?> | IPK <?= number_format($ipk, 2) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <div class="content-grid">
                    <!-- Informasi Pribadi -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-user"></i>
                            Informasi Pribadi
                        </h3>
                        <div class="info-row">
                            <span class="info-label">Nama Lengkap</span>
                            <span class="info-value"><?= esc($mahasiswa['nama_mahasiswa']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">NIM</span>
                            <span class="info-value"><?= esc($mahasiswa['nim']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value"><?= esc($mahasiswa['email']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">No Telp</span>
                            <span class="info-value">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">-</span>
                        </div>
                    </div>

                    <!-- Status Akademik -->
                    <div class="status-card">
                        <p class="status-title">Indeks Prestasi Kumulatif</p>
                        <div class="ipk-display"><?= number_format($ipk, 2) ?></div>
                        <span class="status-badge">Semester <?= $mahasiswa['semester'] ?></span>
                        <div class="status-info">
                            <div class="status-item">
                                <p class="status-item-label">Tahun Masuk</p>
                                <p class="status-item-value"><?= $mahasiswa['tahun_masuk'] ?></p>
                            </div>
                            <div class="status-item">
                                <p class="status-item-label">Total IPK Semester ini</p>
                                <p class="status-item-value">19 SKS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-grid">
                    <!-- Informasi Akademik -->
                    <div class="info-section">
                        <h3 class="section-title">
                            <i class="fas fa-graduation-cap"></i>
                            Informasi Akademik
                        </h3>
                        <div class="info-row">
                            <span class="info-label">Tempat, Tanggal Lahir</span>
                            <span class="info-value">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Program Studi</span>
                            <span class="info-value"><?= esc($mahasiswa['nama_prodi']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jurusan</span>
                            <span class="info-value"><?= esc($mahasiswa['nama_jurusan']) ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Alamat</span>
                            <span class="info-value">-</span>
                        </div>
                    </div>

                    <!-- Total SKS -->
                    <div class="sks-card">
                        <div class="sks-header">
                            <p class="sks-title">Total SKS Terlaksana</p>
                        </div>
                        <div class="sks-value">
                            <i class="fas fa-book"></i>
                            <?= $total_sks ?>
                        </div>
                        <p class="sks-subtitle">dari <?= $target_sks ?> SKS</p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= $progress_sks ?>%"></div>
                        </div>
                        <p class="progress-label"><?= $progress_sks ?>% Selesai</p>
                    </div>
                </div>

                <!-- Riwayat Akademik -->
                <div class="academic-history">
                    <h3 class="section-title">
                        <i class="fas fa-history"></i>
                        Riwayat Akademik
                    </h3>
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($riwayat_akademik as $riwayat): ?>
                                <tr>
                                    <td><?= esc($riwayat['semester']) ?></td>
                                    <td><?= esc($riwayat['ipk']) ?></td>
                                    <td><span class="status-badge-table"><?= esc($riwayat['status']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>