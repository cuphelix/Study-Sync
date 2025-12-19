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
            <h3>7</h3>
            <div class="stat-icon-circle">
                <i class="uil uil-book-open" style="font-size:26px;"></i>
            </div>
        </div>

        <div class="stat-card card-blue">
            <small>Total Mahasiswa</small>
            <h3>225</h3>
            <div class="stat-icon-circle">
                <i class="uil uil-users-alt" style="font-size:26px;"></i>
            </div>
        </div>

        <div class="stat-card card-green">
            <small>Mata Kuliah</small>
            <h3>5</h3>
            <div class="stat-icon-circle">
                <i class="uil uil-notebooks" style="font-size:26px;"></i>
            </div>
        </div>

    </div>


    <!-- ======= TABEL JADWAL ======= -->
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Waktu</th>
                <th>Senin</th>
                <th>Selasa</th>
                <th>Rabu</th>
                <th>Kamis</th>
                <th>Jumat</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>08:00</td>
                <td class="block-blue">
                    Pemrograman Web<br>
                    TI301 TI-5A<br>
                    08:00 - 10:00<br>
                    Lab. Komputer 1<br>
                    35 Mhs
                </td>
                <td></td>
                <td class="block-green">
                    Basis Data Lanjut<br>
                    TI401 TI-7A<br>
                    08:00 - 10:00<br>
                    Lab. Database<br>
                    28 Mhs
                </td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>09:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td class="block-purple">
                    Sistem Informasi<br>
                    SI201 SI-3B<br>
                    09:00 - 11:00<br>
                    Ruang 310<br>
                    38 Mhs
                </td>
                <td></td>
            </tr>

            <tr>
                <td>10:00</td>
                <td></td>
                <td class="block-brown">
                    Sistem Informasi<br>
                    SI201 SI-3A<br>
                    10:00 - 12:00<br>
                    Ruang 305<br>
                    40 Mhs
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>13:00</td>
                <td class="block-red">
                    Pemrograman Web<br>
                    TI301 TI-5B<br>
                    13:00 - 15:00<br>
                    Lab. Komputer 2<br>
                    32 Mhs
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            <tr>
                <td>14:00</td>
                <td></td>
                <td class="block-blue">
                    Pemrograman Mobile<br>
                    TI402 TI-7B<br>
                    14:00 - 16:00<br>
                    Lab. Komputer 3<br>
                    30 Mhs
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

</div>

<?= $this->endSection() ?>