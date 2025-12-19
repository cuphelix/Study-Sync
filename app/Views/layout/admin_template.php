<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title ?? 'Portal Admin'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 240px;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding: 18px 16px;
            display: flex;
            flex-direction: column;
        }

        .brand-title { font-weight: 600; }
        .brand-sub   { font-size: 11px; color:#6b7280; }

        .nav {
            list-style:none;
            padding:0;
            margin:20px 0 0;
            flex:1;
        }

        .nav-item { margin-bottom:6px; }

        .nav-link {
            display:flex;
            align-items:center;
            gap:8px;
            padding:8px 10px;
            border-radius:10px;
            text-decoration:none;
            color:#374151;
            font-size:14px;
        }

        .nav-link span.icon { width:22px; text-align:center; }

        .nav-link.active {
            background:#22c55e;
            color:#ffffff;
        }

        .nav-link:hover:not(.active) {
            background:#f3f4ff;
        }

        .nav-logout {
            margin-top:16px;
            border-top:1px solid #e5e7eb;
            padding-top:12px;
        }

        .nav-link.logout { color:#ef4444; }

        /* MAIN */
        .main {
            flex:1;
            padding:20px 26px;
        }

        .top-bar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:16px;
        }

        .top-title { font-size:20px; font-weight:600; }
        .top-date  { font-size:13px; color:#6b7280; }
        .user-info { font-size:13px; color:#6b7280; }

        /* biar konten dashboard punya spacing */
        .page-content { }
    </style>

    <?= $this->renderSection('styles'); // kalau halaman mau nambah CSS sendiri ?>
</head>
<body>

<div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="brand">
            <div class="brand-title">StudySync</div>
            <div class="brand-sub">Portal Admin</div>
        </div>

        <ul class="nav">
            <li class="nav-item">
                <a href="<?= base_url('admin/dashboard'); ?>"
                   class="nav-link <?= (uri_string() === 'admin/dashboard') ? 'active' : '' ?>">
                    <span class="icon">🏠</span>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/mahasiswa'); ?>"
                class="nav-link <?= (strpos(uri_string(), 'admin/mahasiswa') === 0) ? 'active' : '' ?>">
                <span class="icon">🧑‍🎓</span>
                <span>Manajemen Mahasiswa</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?= base_url('admin/dosen'); ?>"
                class="nav-link <?= (strpos(uri_string(), 'admin/dosen') === 0) ? 'active' : '' ?>">
                <span class="icon">👨‍🏫</span>
                <span>Manajemen Dosen</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/matakuliah'); ?>"
                class="nav-link <?= (strpos(uri_string(), 'admin/matakuliah') === 0) ? 'active' : '' ?>">
                <span class="icon">📚</span>
                <span>Manajemen Mata Kuliah</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?= base_url('admin/ruangan'); ?>"
                class="nav-link <?= (strpos(uri_string(), 'admin/ruangan') === 0) ? 'active' : '' ?>">
                <span class="icon">🏢</span>
                <span>Manajemen Ruangan</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= base_url('admin/jadwal'); ?>"
                class="nav-link <?= (strpos(uri_string(), 'admin/jadwal') === 0) ? 'active' : '' ?>">
                <span class="icon">🗓</span>
                <span>Manajemen Jadwal</span>
                </a>
            </li>


            <li class="nav-item">
                <a href="<?= base_url('admin/kalender'); ?>" 
                class="nav-link <?= (uri_string() === 'admin/kalender' || uri_string() === 'admin/kalender/tabel') ? 'active' : '' ?>">
                <span class="icon">📆</span>
                <span>Kalender Akademik</span>
                </a>
            </li>
        </ul>

        <div class="nav-logout">
            <a href="<?= base_url('/logout'); ?>" class="nav-link logout">
                <span class="icon">↩</span>
                <span>Keluar</span>
            </a>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main">
        <div class="top-bar">
            <div>
                <div class="top-title"><?= esc($pageTitle ?? 'Dashboard Admin'); ?></div>
                <div class="top-date">
                    <?= esc($today ?? date('l, j F Y')); ?>
                </div>
            </div>
            <div class="user-info">
                Hai, <strong><?= esc(session('nama_admin')); ?></strong>
            </div>
        </div>

        <div class="page-content">
            <?= $this->renderSection('content'); ?>
        </div>
    </main>

</div>

<?= $this->renderSection('scripts'); ?>
</body>
</html>
