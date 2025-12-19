<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- ICONS -->
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>
    .topbar {
        position: fixed;
        top: 0;
        left: 260px;
        /* sesuaikan width sidebar kamu */
        width: calc(100% - 260px);
        height: 60px;
        background: #ffffff;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        padding: 0 25px;
        box-sizing: border-box;
        gap: 20px;
        border-bottom: 1px solid #ddd;
        z-index: 9999;
    }


    /* ICON BELL */
    .topbar .bell {
        position: relative;
        cursor: pointer;
    }

    .topbar .bell i {
        font-size: 22px;
        color: #111;
    }

    .topbar .bell span {
        position: absolute;
        top: -4px;
        right: -2px;
        background: red;
        color: white;
        font-size: 10px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* PROFILE */
    .topbar .profile-img {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
        cursor: pointer;
    }

    /* CONTENT */

    .page-container {
        margin-top: 0px;
        /* aman dari topbar */
        padding: 60px;
        width: 110%;
        max-width: 1500px;
        /* BIKIN TENGAH & RAPI */
        font-family: "Poppins", sans-serif;
        box-sizing: border-box;
    }

    .page-title {
        font-size: 26px;
        font-weight: 600;
    }

    .sub-text {
        margin-top: 4px;
        font-size: 14px;
        color: gray;
    }

    /* STATIS */
    .stats-row {
        display: flex;
        gap: 18px;
        margin-top: 25px;
    }

    .stat-card {
        width: 250px;
        height: 70px;
        padding: 18px;
        border-radius: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.10);
    }

    /* WARNA CARD */
    .card-1 {
        background: #ffecec;
    }

    .card-2 {
        background: #e5f3ff;
    }

    .card-3 {
        background: #dce8ce;
    }

    /* CIRCLE ICON */
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 22px;
        color: #333;
    }

    .circle-1 {
        background: #cfc5f0;
    }

    .circle-2 {
        background: #d3dbf8;
    }

    .circle-3 {
        background: #c7d4c1;
    }

    .stat-title {
        margin: 0;
        font-size: 15px;
        font-weight: 600;
    }

    .stat-value {
        margin-top: 6px;
        font-size: 20px;
        font-weight: 700;
    }

    /* Warna angka */
    .value-1 {
        color: #cc00aa;
    }

    .value-2 {
        color: #00a6ff;
    }

    .value-3 {
        color: #4a8f7e;
    }

    /* FILTER */
    .filter-row {
        margin: 30px 0 20px;
        display: flex;
        gap: 15px;
    }

    .filter-btn {
        padding: 10px 16px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* TABEL */
    .table-box {
        width: 100%;
        border: 1px solid #ddd;
        border-radius: 14px;
        overflow: hidden;
    }

    thead {
        background: #f4f6fb;
    }

    th,
    td {
        padding: 12px;
        font-size: 14px;
        border-bottom: 1px solid #eee;
    }
</style>

<!-- TOPBAR SAMA PERSIS DENGAN PENGINGAT -->
<div class="topbar">

    <div class="bell">
        <i class="bx bx-bell"></i>
        <span>1</span>
    </div>

    <img src="/assets/img/pp.jpeg" class="profile-img">
</div>

<!-- PAGE CONTENT -->
<div class="page-container">

    <h2 class="page-title">Halaman Mahasiswa</h2>
    <p class="sub-text">Mahasiswa yang berada di bawah kelas yang Anda ajar</p>

    <!-- STATISTIK -->
    <!-- STATISTIK BARU -->
    <div class="stats-row">

        <!-- Card 1 -->
        <div class="stat-card card-1">
            <div>
                <p class="stat-title">Total Mahasiswa</p>
                <p class="stat-value value-1"><?= $totalMahasiswa ?? 0 ?></p>
            </div>
            <div class="stat-icon circle-1">
                <i class="uil uil-users-alt"></i>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="stat-card card-2">
            <div>
                <p class="stat-title">Mahasiswa Aktif</p>
                <p class="stat-value value-2"><?= $totalAktif ?? 0 ?></p>
            </div>
            <div class="stat-icon circle-2">
                <i class="uil uil-user-check"></i>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="stat-card card-3">
            <div>
                <p class="stat-title">IPK Rata-rata</p>
                <p class="stat-value value-3"><?= $ipkRataRata > 0 ? number_format($ipkRataRata, 2) : '-' ?></p>
            </div>
            <div class="stat-icon circle-3">
                <i class="uil uil-graduation-cap"></i>
            </div>
        </div>

    </div>


    <!-- FILTER -->
    <div class="filter-row">
        <button class="filter-btn"><i class="uil uil-search"></i> Cari</button>
        <button class="filter-btn">Semua Kelas <i class="uil uil-angle-down"></i></button>
        <button class="filter-btn">Semua Mata Kuliah <i class="uil uil-angle-down"></i></button>
    </div>

    <!-- TABLE -->
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Semester</th>
                    <th>Mata Kuliah</th>
                    <th>IPK</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($mahasiswa)): ?>
                    <?php foreach ($mahasiswa as $mhs): ?>
                        <tr>
                            <td><?= esc($mhs['nim'] ?? '-') ?></td>
                            <td><?= esc($mhs['nama_mahasiswa'] ?? '-') ?></td>
                            <td>-</td>
                            <td>Semester <?= $mhs['semester'] ?? '-' ?></td>
                            <td><?= esc($mhs['nama_prodi'] ?? '-') ?></td>
                            <td><?= isset($mhs['ipk']) && $mhs['ipk'] > 0 ? number_format($mhs['ipk'], 2) : '-' ?></td>
                            <td>
                                <span style="padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: 500; 
                                    <?php 
                                    $status = $mhs['status'] ?? 'Aktif';
                                    if ($status == 'Aktif') {
                                        echo 'background: #dcfce7; color: #166534;';
                                    } elseif ($status == 'Non-aktif') {
                                        echo 'background: #fee2e2; color: #991b1b;';
                                    } elseif ($status == 'Cuti') {
                                        echo 'background: #fef3c7; color: #92400e;';
                                    } else {
                                        echo 'background: #e0e7ff; color: #3730a3;';
                                    }
                                    ?>">
                                    <?= esc($status) ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px; color:#6b7280;">
                            Tidak ada data mahasiswa
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<?= $this->endSection() ?>