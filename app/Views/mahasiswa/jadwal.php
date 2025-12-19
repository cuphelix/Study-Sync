<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kuliah - StudySync</title>
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

        /* Sidebar - Copy dari file sebelumnya */
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

        /* Schedule Container */
        .schedule-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            overflow-x: auto;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }

        .schedule-table th {
            background: #2563eb;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 15px;
            font-weight: 600;
        }

        .schedule-table th:first-child {
            border-radius: 10px 0 0 0;
        }

        .schedule-table th:last-child {
            border-radius: 0 10px 0 0;
        }

        .schedule-table td {
            height: 120px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
            padding: 8px;
            background: #fafbfd;
        }

        .time-col {
            font-weight: 600;
            text-align: center;
            background: #f1f5f9;
            width: 100px;
            color: #475569;
        }

        .event-card {
            background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
            padding: 10px;
            border-radius: 8px;
            font-size: 12px;
            margin-bottom: 6px;
            border-left: 4px solid #2563eb;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .event-title {
            font-weight: 600;
            font-size: 13px;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .event-detail {
            color: #64748b;
            font-size: 11px;
            margin-top: 2px;
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

            <a href="<?= base_url('mahasiswa/jadwal') ?>" class="menu-item active">
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
        <div class="header">
            <h1>Jadwal Kuliah</h1>
        </div>

        <div class="schedule-container">
            <?php
            $jamList = [
                "08:00",
                "09:00",
                "10:00",
                "11:00",
                "12:00",
                "13:00",
                "14:00",
                "15:00",
                "16:00"
            ];
            $hariList = ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"];
            ?>

            <table class="schedule-table">
                <tr>
                    <th>Waktu</th>
                    <?php foreach ($hariList as $h): ?>
                        <th><?= $h ?></th>
                    <?php endforeach ?>
                </tr>

                <?php foreach ($jamList as $jam): ?>
                    <tr>
                        <td class="time-col"><?= $jam ?></td>

                        <?php foreach ($hariList as $hari): ?>
                            <td>
                                <?php foreach ($jadwal as $item): ?>
                                    <?php if ($item['hari'] == $hari && substr($item['jam_mulai'], 0, 5) == $jam): ?>
                                        <div class="event-card">
                                            <div class="event-title">
                                                <?= esc($item['nama_mk']) ?>
                                            </div>
                                            <div class="event-detail">
                                                <?= esc($item['kode_matakuliah']) ?>
                                            </div>
                                            <div class="event-detail">
                                                <i class="fas fa-clock"></i>
                                                <?= substr($item['jam_mulai'], 0, 5) ?> - <?= substr($item['jam_selesai'], 0, 5) ?>
                                            </div>
                                            <div class="event-detail">
                                                <i class="fas fa-user"></i>
                                                <?= esc($item['nama_dosen']) ?>
                                            </div>
                                            <div class="event-detail">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <?= esc($item['nama_ruangan']) ?>
                                            </div>
                                        </div>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </table>
        </div>
    </div>
</body>

</html>