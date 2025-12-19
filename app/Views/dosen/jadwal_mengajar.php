<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>
/* ================= HEADER ================= */
.topbar {
    position: fixed;
    top: 0;
    left: 260px;
    width: calc(100% - 260px);
    height: 60px;
    background: #ffffff;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 0 25px;
    box-sizing: border-box;
    border-bottom: 1px solid #e5e5e5;
    z-index: 9999;
    gap: 20px;
}

.topbar .bell {
    position: relative;
    cursor: pointer;
}
.topbar .bell i {
    font-size: 22px;
    color: #333;
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

.topbar .profile-img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
}

.page-container{
    margin-top: 0px;          /* aman dari topbar */
    padding: 60px;
    width: 110%;
    max-width: 1500px;         /* BIKIN TENGAH & RAPI */
    font-family: "Poppins", sans-serif;
    box-sizing: border-box;}
.page-title {
    font-size: 28px;
    font-weight: bold;
}

/* ================= CARD STATISTIK ================= */
.stat-row {
    margin-top: 20px;
    display: flex;
    gap: 20px;
}

.stat-card {
    flex: 1;
    padding: 20px 22px;
    background: #fff;
    border-radius: 20px;
   width: 250px;          
    height: 60px;  
    position: relative;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.07);
}

.stat-card small {
    font-size: 14px;
    font-weight: 600;
    color: #555;
}

.stat-card h3 {
    font-size: 24px;
    font-weight: 800;
    margin-top: 5px;
}

/* ICON BUBBLE */
.stat-icon-circle {
    position: absolute;
    right: 20px;
    top: 18px;
    width: 55px;
    height: 55px;
    border-radius: 18px;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* CARD COLORS */
.card-purple {
    background: #f4ecff;
}
.card-purple .stat-icon-circle {
    background: #e8daff;
}
.card-purple h3,
.card-purple i {
    color: #8b2cc7;
}

.card-blue {
    background: #e4f3ff;
}
.card-blue .stat-icon-circle {
    background: #d4ecff;
}
.card-blue h3,
.card-blue i {
    color: #1976d2;
}

.card-green {
    background: #e6f8ef;
}
.card-green .stat-icon-circle {
    background: #d2f0e0;
}
.card-green h3,
.card-green i {
    color: #2e7d32;
}

/* ================= JADWAL TABLE ================= */
.schedule-table {
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
}

.schedule-table th {
    background: #d6b6ff;
    padding: 12px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    color: white;
}

.schedule-table td {
    border: 1px solid #ddd;
    height: 90px;
    padding: 4px;
    vertical-align: top;
    font-size: 12px;
}

.block-blue { background: #cfe2ff; border-radius: 6px; padding: 5px; }
block-green { background: #d7f5d6; border-radius: 6px; padding: 5px; }
.block-red { background: #ffd4d4; border-radius: 6px; padding: 5px; }
.block-purple { background: #f1d4ff; border-radius: 6px; padding: 5px; }
.block-brown { background: #e6d3b1; border-radius: 6px; padding: 5px; }

</style>
    <!-- ========== TOPBAR GLOBAL FIX ========== -->
<div class="topbar" 
     style="
        position: fixed;
        top: 0;
        left: 260px; /* sesuaikan width sidebar kamu */
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
        z-index: 9999;">
    
    <!-- ICON LONCENG -->
    <div style="position: relative; cursor: pointer;">
        <i class='bx bx-bell' style="font-size: 22px; color:#444;"></i>

        <span style="
            position: absolute;
            top: -4px;
            right: -2px;
            background: red;
            color: white;
            border-radius: 50%;
            width: 16px;
            height: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 10px;">
            1
        </span>
    </div>

    <!-- FOTO PROFIL -->
    <img src="<?= base_url('assets/img/pp.jpeg') ?>" 
         style="width: 36px;
                height: 36px;
                border-radius: 50%;
                object-fit: cover;
                cursor: pointer;">
</div>

<!-- AGAR KONTEN TIDAK TERTUTUP TOPBAR -->
<div style="height: 60px;"></div>

<!-- ======= PAGE CONTENT ======= -->
<div class="page-container">

    <h2 class="page-title">Jadwal Mengajar</h2>

    <!-- CARD STATISTIK -->
    <div class="stat-row">

        <div class="stat-card card-purple">
            <small>Total Kelas</small>
            <h3><?= $totalKelas ?? 0 ?></h3>
            <div class="stat-icon-circle">
                <i class="uil uil-book-open" style="font-size:26px;"></i>
            </div>
        </div>

        <div class="stat-card card-blue">
            <small>Total Mahasiswa</small>
            <h3><?= $totalMahasiswa ?? 0 ?></h3>
            <div class="stat-icon-circle">
                <i class="uil uil-users-alt" style="font-size:26px;"></i>
            </div>
        </div>

        <div class="stat-card card-green">
            <small>Mata Kuliah</small>
            <h3><?= $totalMatkul ?? 0 ?></h3>
            <div class="stat-icon-circle">
                <i class="uil uil-notebooks" style="font-size:26px;"></i>
            </div>
        </div>

    </div>


    <!-- ======= TABEL JADWAL ======= -->
    <?php
    $jamList = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00', '15:00', '16:00'];
    $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $colors = ['blue', 'green', 'purple', 'brown', 'red'];
    $displayedJadwal = [];
    ?>
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Waktu</th>
                <?php foreach ($hariList as $h): ?>
                    <th><?= $h ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($jamList as $jam): ?>
                <tr>
                    <td><?= $jam ?></td>
                    <?php foreach ($hariList as $hari): ?>
                        <td>
                            <?php 
                            foreach ($jadwal as $item): 
                                $jadwalKey = $item['id_jadwal'] . '_' . $hari;
                                if (isset($displayedJadwal[$jadwalKey])) {
                                    continue;
                                }
                                
                                if ($item['hari'] != $hari) {
                                    continue;
                                }
                                
                                $jamSlot = (int)substr($jam, 0, 2);
                                $jamMulai = (int)substr($item['jam_mulai'], 0, 2);
                                $menitMulai = (int)substr($item['jam_mulai'], 3, 2);
                                $jamSelesai = (int)substr($item['jam_selesai'], 0, 2);
                                
                                $jamMulaiDecimal = $jamMulai + ($menitMulai / 60);
                                $jamSelesaiDecimal = $jamSelesai + ((int)substr($item['jam_selesai'], 3, 2) / 60);
                                
                                if ($jamMulaiDecimal <= $jamSlot && $jamSlot < $jamSelesaiDecimal) {
                                    $displayedJadwal[$jadwalKey] = true;
                                    $colorIndex = ($item['id_jadwal'] % count($colors));
                                    $colorClass = 'block-' . $colors[$colorIndex];
                                    ?>
                                    <div class="<?= $colorClass ?>">
                                        <?= esc($item['nama_matakuliah'] ?? '-') ?><br>
                                        <?= esc($item['kode_matakuliah'] ?? '-') ?> <?= esc($item['kode_kelas'] ?? '-') ?><br>
                                        <?= substr($item['jam_mulai'], 0, 5) ?> - <?= substr($item['jam_selesai'], 0, 5) ?><br>
                                        <?= esc($item['nama_gedung'] ?? $item['kode_kelas'] ?? '-') ?>
                                    </div>
                                    <?php
                                }
                            endforeach; 
                            ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>