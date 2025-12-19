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
        <div class="count"><?= $totalPengingat ?? 0 ?></div>
      </div>
      <i class="uil uil-bell"></i>
    </div>
    <div class="stat-card upcoming">
      <div>
        <div class="label">Mendatang</div>
        <div class="count"><?= $upcoming ?? 0 ?></div>
      </div>
      <i class="bx bx-calendar"></i>
    </div>
    <div class="stat-card urgent">
      <div>
        <div class="label">Prioritas Tinggi</div>
        <div class="count"><?= $urgent ?? 0 ?></div>
      </div>
      <i class="uil uil-exclamation-triangle"></i>
    </div>
  </div>

  <div class="reminder-list">
    <?php if (!empty($pengingat)): ?>
      <?php 
      $bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      $hariIndo = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
      foreach ($pengingat as $p): 
        $tanggal = $p['tanggal'] ?? '';
        $waktu = $p['waktu'] ?? '';
        $judul = $p['judul'] ?? 'Pengingat';
        $deskripsi = $p['deskripsi'] ?? '';
        $prioritas = $p['prioritas'] ?? 'Sedang';
        
        if ($tanggal) {
          $tglObj = date_create($tanggal);
          $hariNama = $hariIndo[date('w', strtotime($tanggal))];
          $tanggalFormatted = date('d', strtotime($tanggal)) . ' ' . $bulanIndo[date('n', strtotime($tanggal))] . ' ' . date('Y', strtotime($tanggal));
        }
        
        // Warna berdasarkan prioritas
        $prioritasClass = 'cat-purple';
        if ($prioritas == 'Tinggi') {
          $prioritasClass = 'cat-red';
        } elseif ($prioritas == 'Rendah') {
          $prioritasClass = 'cat-blue';
        }
      ?>
        <article class="reminder">
          <div class="head">
            <div class="icon"><i class="uil uil-bell"></i></div>
            <div class="title"><?= esc($judul) ?></div>
          </div>
          <?php if ($deskripsi): ?>
            <p class="desc"><?= esc($deskripsi) ?></p>
          <?php endif; ?>
          <div class="pills">
            <?php if ($tanggal): ?>
              <span class="pill date"><i class="uil uil-calender"></i> <?= $hariNama ?>, <?= $tanggalFormatted ?></span>
            <?php endif; ?>
            <?php if ($waktu): ?>
              <span class="pill time"><i class="uil uil-clock"></i> <?= substr($waktu, 0, 5) ?></span>
            <?php endif; ?>
            <span class="pill <?= $prioritasClass ?>"><i class="uil uil-<?= $prioritas == 'Tinggi' ? 'exclamation-triangle' : ($prioritas == 'Rendah' ? 'info-circle' : 'bell') ?>"></i> <?= esc($prioritas) ?></span>
            <?php if (!empty($p['id_kalender'])): ?>
              <span class="pill cat-purple"><i class="uil uil-calendar-alt"></i> Kalender Akademik</span>
            <?php endif; ?>
          </div>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <article class="reminder">
        <div class="head">
          <div class="icon"><i class="uil uil-bell-slash"></i></div>
          <div class="title">Tidak Ada Pengingat</div>
        </div>
        <p class="desc">Belum ada pengingat yang dibuat</p>
      </article>
    <?php endif; ?>
  </div>
</div>
<?= $this->endSection() ?>
