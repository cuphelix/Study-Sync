<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

<style>
/* ================= SAFE PAGE WRAPPER ================= */
.page-safe {
  width: 100%;
  display: flex;
  justify-content: center;
}

/* ================= MAIN CONTENT ================= */
.pengingat-root{
  margin-top: 0px;              /* aman dari topbar */
  padding: 60px;                 /* jarak aman kiri-kanan */
  width: 110%;
  max-width: 1100px;             /* supaya tidak terlalu melebar */
  box-sizing: border-box;
  font-family: "Poppins", system-ui, sans-serif;
}

/* ================= TITLE ================= */
.pengingat-root h1{
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 24px;
}

/* ================= STATS ================= */
.stats-row{
  display:flex;
  gap:20px;
  margin-bottom:32px;
}
.stat-card{
  flex:1;
  display:flex;
  justify-content:space-between;
  align-items:center;
  padding:22px;
  border-radius:16px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.08);
}
.stat-card.total{ background:#EBD9FF; }
.stat-card.upcoming{ background:#DDEAFF; }
.stat-card.urgent{ background:#FFD8D8; }

.stat-card .label{ font-size:14px; font-weight:600; }
.stat-card .count{ font-size:22px; font-weight:700; }

/* ================= REMINDER ================= */
.reminder-list{ display:flex; flex-direction:column; gap:22px; }

.reminder{
  background:#fff;
  border-radius:16px;
  padding:22px;
  box-shadow: 0 8px 18px rgba(0,0,0,0.06);
}

.head{ display:flex; gap:12px; align-items:center; }
.head .icon{
  width:36px;
  height:36px;
  border-radius:10px;
  display:flex;
  align-items:center;
  justify-content:center;
  background:#F3F0FF;
  color:#6a2cc9;
}
.title{ font-size:18px;font-weight:600; }

.desc{
  margin:10px 0 14px 48px;
  color:#6b7280;
}

.pills{
  display:flex;
  gap:10px;
  margin-left:48px;
  flex-wrap:wrap;
}
.pill{
  padding:8px 14px;
  border-radius:999px;
  font-size:13px;
  font-weight:600;
  background:#fff;
  border:1px solid rgba(0,0,0,.08);
}
.pill.cat-purple{ background:#efe8ff;color:#5b2acb;border:none; }
.pill.cat-red{ background:#ffe8e8;color:#b81f1f;border:none; }

.status-row{ margin-left:48px;margin-top:14px; }
.status{
  padding:8px 14px;
  border-radius:12px;
  font-size:13px;
  font-weight:700;
}
.status.sedang{ background:#fff4e6;color:#9a5b15; }
.status.penting{ background:#ffdada;color:#9a1a1a; }

/* ================= RESPONSIVE ================= */
@media(max-width: 900px){
  .stats-row{ flex-direction:column; }
  .desc,.pills,.status-row{ margin-left:0; }
}
</style>

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

<div class="page-safe">
<div class="pengingat-root">

  <h1>Pengingat</h1>

  <div class="stats-row">
    <div class="stat-card total">
      <div>
        <div class="label">Total Pengingat</div>
        <div class="count">7</div>
      </div>
      <i class="uil uil-bell"></i>
    </div>
    <div class="stat-card upcoming">
      <div>
        <div class="label">Mendatang</div>
        <div class="count">8</div>
      </div>
      <i class="bx bx-calendar"></i>
    </div>
    <div class="stat-card urgent">
      <div>
        <div class="label">Prioritas Tinggi</div>
        <div class="count">5</div>
      </div>
      <i class="uil uil-exclamation-triangle"></i>
    </div>
  </div>

  <div class="reminder-list">

    <!-- reminder -->
    <article class="reminder">
      <div class="head">
        <div class="icon"><i class="uil uil-bell"></i></div>
        <div class="title">Persiapan Minggu Depan</div>
      </div>
      <p class="desc">Siapkan materi kuliah untuk pertemuan minggu depan</p>
      <div class="pills">
        <span class="pill">Jumat, 7 November 2025</span>
        <span class="pill">15:00</span>
        <span class="pill cat-purple">Perkuliahan</span>
      </div>
      <div class="status-row"><span class="status sedang">Sedang</span></div>
    </article>

    <!-- reminder 2 -->
    <article class="reminder" aria-labelledby="rem2">
      <div class="head">
        <div class="icon"><i class="uil uil-bell"></i></div>
        <div id="rem2" class="title">Persiapan UAS Pemrograman Web</div>
      </div>

      <p class="desc">Siapkan soal untuk kelas TRPL-5A & TRPL-5C</p>

      <div class="pills">
        <span class="pill date"><i class="uil uil-calender"></i> Senin, 9 November 2025</span>
        <span class="pill time"><i class="uil uil-clock"></i> 08:00</span>
        <span class="pill cat-red"><i class="uil uil-file-alt"></i> Ujian</span>
        <span class="pill outline">TRPL-5C & TRPL-5A</span>
      </div>

      <div class="status-row"><span class="status penting">Penting</span></div>
    </article>

    <!-- reminder 3 -->
    <article class="reminder" aria-labelledby="rem3">
      <div class="head">
        <div class="icon"><i class="uil uil-bell"></i></div>
        <div id="rem3" class="title">Rapat Dosen Program Studi</div>
      </div>

      <p class="desc">Rapat evaluasi kurikulum dan pembelajaran semester ini</p>

      <div class="pills">
        <span class="pill date"><i class="uil uil-calender"></i> Rabu, 10 November 2025</span>
        <span class="pill time"><i class="uil uil-clock"></i> 10:00</span>
        <span class="pill cat-purple"><i class="uil uil-comments"></i> Rapat</span>
      </div>

      <div class="status-row"><span class="status sedang">Sedang</span></div>
    </article>

    <!-- reminder 4 -->
    <article class="reminder" aria-labelledby="rem4">
      <div class="head">
        <div class="icon"><i class="uil uil-bell"></i></div>
        <div id="rem4" class="title">Review Tugas Besar Mahasiswa</div>
      </div>

      <p class="desc">Review dan evaluasi tugas besar mahasiswa kelas TRPL-7C</p>

      <div class="pills">
        <span class="pill date"><i class="uil uil-calender"></i> Sabtu, 13 November 2025</span>
        <span class="pill time"><i class="uil uil-clock"></i> 17:00</span>
        <span class="pill cat-purple"><i class="uil uil-book-alt"></i> Tugas</span>
        <span class="pill outline">TRPL-7C</span>
      </div>

      <div class="status-row"><span class="status sedang">Sedang</span></div>
    </article>

  </div>
</div>
<?= $this->endSection() ?>
