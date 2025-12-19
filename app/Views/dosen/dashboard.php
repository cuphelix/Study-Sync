<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            background: #f5f7fa;
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

        .stat-icon.green {
            background: #d1fae5;
            color: #059669;
        }

        /* Two Column Layout */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 24px;
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

        /* Calendar Section */
        .calendar-section {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            margin-top: 24px;
        }

        .calendar-section h2 {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .calendar-box table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px;
        }

        .calendar-box th {
            font-size: 13px;
            color: #64748b;
            font-weight: 600;
            padding: 8px;
        }

        .calendar-box td {
            padding: 12px;
            border-radius: 8px;
            background: #f8fafc;
            text-align: center;
            font-size: 14px;
            color: #475569;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-box td:hover {
            background: #e0e7ff;
            color: #3b82f6;
        }

        /* Right Sidebar */
        .right-sidebar {
            background: white;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            height: fit-content;
        }

        .right-sidebar h2 {
            font-size: 18px;
            color: #1e293b;
            margin-bottom: 20px;
            font-weight: 600;
        }

        .tag-pengingat {
            background: #3b82f6;
            color: white;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }

        .pengingat-item {
            background: #f8fafc;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 12px;
            border: 1px solid #e2e8f0;
            transition: all 0.3s;
        }

        .pengingat-item:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }

        .pengingat-item:last-child {
            margin-bottom: 0;
        }

        .pengingat-content {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .pengingat-content i {
            font-size: 18px;
            color: #3b82f6;
            margin-top: 2px;
        }

        .pengingat-text {
            flex: 1;
        }

        .pengingat-text p {
            font-size: 14px;
            color: #1e293b;
            font-weight: 500;
            margin-bottom: 6px;
        }

        .pengingat-text .tanggal {
            font-size: 12px;
            color: #64748b;
            margin: 0;
        }

        /* Profile Card */
        .profil-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 24px;
            border-radius: 12px;
            text-align: center;
            color: white;
            margin-top: 24px;
        }

        .profil-card img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 12px;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profil-card h3 {
            font-size: 18px;
            margin-bottom: 4px;
        }

        .profil-card p {
            font-size: 13px;
            opacity: 0.9;
            margin-bottom: 16px;
        }

        .btn-profile,
        .btn-logout {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            font-weight: 600;
            margin-top: 8px;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-profile {
            background: white;
            color: #667eea;
        }

        .btn-profile:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .btn-logout {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }

        .btn-logout:hover {
            background: #dc2626;
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

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }

            .right-sidebar {
                order: 2;
            }
        }

        @media (max-width: 768px) {
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
    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Dashboard Dosen</h1>
            <p>Selamat datang kembali, Dr. Ahmad Wijaya, M.Kom</p>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-info">
                    <h3>Jadwal Hari Ini</h3>
                    <p>2 Kelas</p>
                </div>
                <div class="stat-icon blue">
                    <i class="fas fa-clock"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total Mata Kuliah</h3>
                    <p>5 Matkul</p>
                </div>
                <div class="stat-icon purple">
                    <i class="fas fa-book"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Total Mahasiswa</h3>
                    <p>156 Mhs</p>
                </div>
                <div class="stat-icon green">
                    <i class="fas fa-users"></i>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-info">
                    <h3>Pengingat Aktif</h3>
                    <p>3 Item</p>
                </div>
                <div class="stat-icon orange">
                    <i class="fas fa-bell"></i>
                </div>
            </div>
        </div>

        <!-- Two Column Layout -->
        <div class="content-grid">
            <!-- Left Column -->
            <div>
                <!-- Schedule Section -->
                <div class="schedule-section">
                    <div class="schedule-header">
                        <h2><i class="fas fa-clock"></i> Jadwal Mengajar Hari Ini</h2>
                        <p>Selasa, 16 Desember 2025</p>
                    </div>

                    <div class="schedule-card blue">
                        <div class="schedule-top">
                            <div class="schedule-title-section">
                                <h3 class="schedule-title">Algoritma dan Struktur Data</h3>
                                <span class="schedule-code">TIF-A</span>
                            </div>
                            <div class="schedule-time">
                                <i class="far fa-clock"></i>
                                08:00 - 10:00
                            </div>
                        </div>

                        <p class="schedule-week">Minggu ke-12</p>

                        <div class="schedule-details">
                            <div class="schedule-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="schedule-detail-info">
                                    <h4>Ruangan</h4>
                                    <p>Lab Komputer 1</p>
                                </div>
                            </div>

                            <div class="schedule-detail">
                                <i class="fas fa-users"></i>
                                <div class="schedule-detail-info">
                                    <h4>Jumlah Mahasiswa</h4>
                                    <p>32 Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="schedule-card purple">
                        <div class="schedule-top">
                            <div class="schedule-title-section">
                                <h3 class="schedule-title">Matematika Diskrit</h3>
                                <span class="schedule-code">TIF-A</span>
                            </div>
                            <div class="schedule-time">
                                <i class="far fa-clock"></i>
                                13:00 - 15:00
                            </div>
                        </div>

                        <p class="schedule-week">Minggu ke-12</p>

                        <div class="schedule-details">
                            <div class="schedule-detail">
                                <i class="fas fa-map-marker-alt"></i>
                                <div class="schedule-detail-info">
                                    <h4>Ruangan</h4>
                                    <p>Ruang Kelas 301</p>
                                </div>
                            </div>

                            <div class="schedule-detail">
                                <i class="fas fa-users"></i>
                                <div class="schedule-detail-info">
                                    <h4>Jumlah Mahasiswa</h4>
                                    <p>35 Mahasiswa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Section -->
                <div class="calendar-section">
                    <h2><i class="fas fa-calendar"></i> Kalender Bulanan</h2>
                    <div class="calendar-box">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sen</th>
                                    <th>Sel</th>
                                    <th>Rab</th>
                                    <th>Kam</th>
                                    <th>Jum</th>
                                    <th>Sab</th>
                                    <th>Min</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                </tr>
                                <tr>
                                    <td>15</td>
                                    <td style="background: #3b82f6; color: white; font-weight: 600;">16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                </tr>
                                <tr>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                </tr>
                                <tr>
                                    <td>29</td>
                                    <td>30</td>
                                    <td>31</td>
                                    <td style="background: transparent;"></td>
                                    <td style="background: transparent;"></td>
                                    <td style="background: transparent;"></td>
                                    <td style="background: transparent;"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="right-sidebar">
                <h2><i class="fas fa-bell"></i> Pengingat</h2>
                <span class="tag-pengingat">3 Pengingat Aktif</span>

                <div class="pengingat-item">
                    <div class="pengingat-content">
                        <i class="fas fa-book-open"></i>
                        <div class="pengingat-text">
                            <p>Siapkan materi kuliah minggu depan</p>
                            <span class="tanggal">Kamis, 15 Mei • 08:00</span>
                        </div>
                    </div>
                </div>

                <div class="pengingat-item">
                    <div class="pengingat-content">
                        <i class="fas fa-envelope"></i>
                        <div class="pengingat-text">
                            <p>Periksa email mahasiswa</p>
                            <span class="tanggal">Kamis, 15 Mei • 10:00</span>
                        </div>
                    </div>
                </div>

                <div class="pengingat-item">
                    <div class="pengingat-content">
                        <i class="fas fa-upload"></i>
                        <div class="pengingat-text">
                            <p>Unggah nilai ujian semester</p>
                            <span class="tanggal">Jumat, 16 Mei • 14:00</span>
                        </div>
                    </div>
                </div>

                <!-- Profile Card -->
                <div class="profil-card">
                    <img src="<?= base_url('assets/img/pp.jpeg') ?>" alt="Profile">
                    <h3>Dr. Ahmad Wijaya, M.Kom</h3>
                    <p>Dosen Teknik Informatika</p>

                    <button class="btn-profile" onclick="location.href='<?= base_url('/profile') ?>'">
                        <i class="fas fa-user"></i> Lihat Profil
                    </button>
                    <button class="btn-logout" onclick="location.href='<?= base_url('logout') ?>'">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?= $this->endSection() ?>