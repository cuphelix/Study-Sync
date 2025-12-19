<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'StudySync' ?></title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Optional: bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        /* GLOBAL LAYOUT */

        body {
            margin: 0;
            font-family: 'Inter', Arial, sans-serif;
            background: #ffffff;
            display: flex;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            width: 210px;
            height: 100vh;
            border-right: 1px solid #e2e2e2;
            padding: 25px 22px;
            position: fixed;
            left: 0;
            top: 0;
            background: #fff;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 35px;
        }

        .logo i {
            font-size: 22px;
            margin-right: 12px;
        }

        .logo h2 {
            font-size: 20px;
            font-weight: 700;
        }

        .menu {
            padding-left: 0;
            margin: 0;
        }

        .menu li {
            list-style: none;
            padding: 10px 12px;
            margin: 8px 0;
            border-radius: 10px;
            display: flex;
            align-items: center;
            font-size: 14.5px;
            cursor: pointer;
            color: #333;
        }

        .menu li i {
            margin-right: 12px;
            font-size: 18px;
        }

        .menu li:hover,
        .menu li.active {
            background: #f3f3f3;
            font-weight: 600;
        }

        .menu li.logout {
            color: #d9534f !important;
            font-weight: 600;
        }

        /* ===== CONTENT WRAPPER ===== */
        .content-wrapper {
            margin-left: 210px;
            width: calc(100% - 210px);
            min-height: 100vh;
            display: flex;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="logo">
            <i class="bi bi-list"></i>
            <h2>StudySync</h2>
        </div>

        <ul class="menu">
            <li class="<?= (current_url() == base_url('dosen') || current_url() == base_url('dosen/dashboard')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/dashboard') ?>'">
                <i class="bx bx-grid-alt"></i> Dashboard
            </li>

            <li class="<?= (current_url() == base_url('dosen/jadwal')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/jadwal') ?>'">
                <i class="bx bx-calendar"></i> Jadwal Mengajar
            </li>

            <li class="<?= (current_url() == base_url('dosen/matakuliah')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/matakuliah') ?>'">
                <i class="bi bi-book"></i> Mata Kuliah Diajarkan
            </li>

            <li class="<?= (current_url() == base_url('dosen/pengingat')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/pengingat') ?>'">
                <i class="bi bi-bell"></i> Pengingat
            </li>

            <li class="<?= (current_url() == base_url('dosen/mahasiswa')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/mahasiswa') ?>'">
                <i class="bi bi-people"></i> Mahasiswa
            </li>

            <li class="<?= (current_url() == base_url('dosen/profil')) ? 'active' : '' ?>"
                onclick="location.href='<?= base_url('dosen/profil') ?>'">
                <i class="bi bi-person"></i> Profil
            </li>

            <li class="logout" onclick="location.href='<?= base_url('logout') ?>'">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </li>
        </ul>
    </aside>


    <!-- PLACE PAGE CONTENT -->
    <div class="content-wrapper">
        <?= $this->renderSection('content') ?>
    </div>

</body>

</html>