<?= $this->extend('layout/main') ?>

<?= $this->section('head') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<style>
 
.profile-page{
 margin-top: 25px;          /* aman dari topbar */
    padding: 60px;
    width: 110%;
    max-width: 1500px;         /* BIKIN TENGAH & RAPI */
    font-family: "Poppins", sans-serif;
    box-sizing: border-box;}


/* TITLE */
.page-title{font-size:26px;font-weight:700;margin-bottom:20px}

/* HEADER */
.header-wrap{position:relative;margin-bottom:28px}
.header-banner{
  height:120px;
  background:linear-gradient(180deg,#8C7BFA,#BFA8FF);
  border-radius:12px
}
.avatar{
  width:120px;height:120px;border-radius:50%;
  background:#e9ddff;border:8px solid #efeefe;
  position:absolute;top:40px;left:32px;
  display:flex;align-items:center;justify-content:center;
  font-size:36px;font-weight:700;color:#342561;
  z-index:2
}
.header-card{
  background:#fff;border-radius:12px;
  padding:28px 28px 28px 180px;
  margin-top:-55px;position:relative;
  box-shadow:0 8px 20px rgba(0,0,0,.06)
}

/* HEADER CONTENT */
.name{font-size:20px;font-weight:700}
.badges{display:flex;gap:10px;margin-top:8px}
.nip-badge,.status-badge{
  font-size:13px;font-weight:700;
  padding:6px 10px;border-radius:8px
}
.nip-badge{background:#eef2ff;color:#2e2a7a}
.status-badge{background:#e9fff0;color:#0e7a38}
.small-labels{display:flex;gap:18px;margin-top:8px}

/* EDIT */
.edit-btn{
  position:absolute;top:18px;right:18px;
  background:#efe6ff;color:#4634ad;
  border:none;border-radius:8px;
  padding:8px 12px;font-weight:600
}

/* INFO */
.info-card{
  background:#fff;border-radius:12px;
  padding:20px;margin-bottom:22px;
  box-shadow:0 3px 8px rgba(0,0,0,.05)
}
.info-title{font-weight:700;margin-bottom:14px;display:flex;gap:8px}
.info-grid{display:grid;grid-template-columns:1fr 1fr;gap:20px 40px}
.info-label{font-size:13px;color:#6b7280}
.info-value{font-weight:600;margin-top:6px}

/* STATS */
.stats-row{
  display:grid;
  grid-template-columns:2fr 1fr 1fr;
  gap:18px;margin-bottom:22px
}
.stat-box{
  border-radius:12px;padding:18px;
  box-shadow:0 3px 8px rgba(0,0,0,.05)
}
.stat-1{background:#f3e2ff}
.stat-2{background:#eafff4}
.stat-3{background:#e6e8ff}

/* TABLE */
.table-card{
  background:#fff;border-radius:12px;
  padding:16px;margin-bottom:22px;
  box-shadow:0 3px 8px rgba(0,0,0,.05)
}
.table-header{
  background:#cfc6ff;padding:12px 16px;
  border-radius:8px;font-weight:700;
  margin-bottom:12px;display:flex;gap:8px
}
.mata-table{width:100%;border-collapse:collapse}
.mata-table th,.mata-table td{
  padding:10px;border-bottom:1px solid #eee
}
.kd{
  background:#f3f3f3;padding:6px 10px;
  border-radius:8px;font-weight:700;font-size:12px
}

/* PUB */
.pub-item{
  background:#efefef;border-radius:10px;
  padding:14px;display:flex;gap:14px;
  margin-bottom:14px
}
.pub-year{
  width:60px;height:60px;background:#dff3ec;
  border-radius:8px;
  display:flex;align-items:center;justify-content:center;
  font-weight:700
}

/* RESPONSIVE */
@media(max-width:900px){
  .header-card{padding-left:20px;margin-top:-20px}
  .avatar{left:50%;transform:translateX(-50%);top:20px}
  .info-grid{grid-template-columns:1fr}
  .stats-row{grid-template-columns:1fr}
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

<!-- AGAR KONTEN TIDAK TERTUTUP TOPBAR -->
<div style="height: 50px;"></div>

<div class="profile-page">

<div class="page-title">Profil Dosen</div>

<div class="header-wrap">
  <div class="header-banner"></div>
  <div class="avatar"><?= strtoupper(substr($dosen['nama_dosen'] ?? 'D', 0, 1)) ?><?= strtoupper(substr(explode(' ', $dosen['nama_dosen'] ?? 'D')[1] ?? '', 0, 1)) ?></div>

  <div class="header-card">
    <button class="edit-btn">Edit Profil</button>

    <div class="name"><?= esc($dosen['nama_dosen'] ?? 'Dosen') ?></div>

    <div class="badges">
      <div class="nip-badge"><?= esc($dosen['nip'] ?? '-') ?></div>
      <div class="status-badge">Aktif</div>
    </div>

    <div class="small-labels">
      <div><?= esc($prodi['nama_prodi'] ?? 'Program Studi') ?></div>
    </div>
  </div>
</div>

<!-- ===== INFO PRIBADI (ASLI TIDAK DIUBAH) ===== -->
<div class="info-card">
  <div class="info-title"><i class="uil uil-user"></i> Informasi Pribadi</div>

  <div class="info-grid">
    <div>
      <div class="info-label">Nama Lengkap</div>
      <div class="info-value"><?= esc($dosen['nama_dosen'] ?? '-') ?></div>

      <div class="info-label">NIP</div>
      <div class="info-value"><?= esc($dosen['nip'] ?? '-') ?></div>

      <?php if (!empty($dosen['nidn'])): ?>
      <div class="info-label">NIDN</div>
      <div class="info-value"><?= esc($dosen['nidn']) ?></div>
      <?php endif; ?>

      <div class="info-label">Email</div>
      <div class="info-value"><?= esc($dosen['email'] ?? '-') ?></div>

      <div class="info-label">Nomor WhatsApp</div>
      <div class="info-value"><?= esc($dosen['no_wa'] ?? '-') ?></div>
    </div>

    <div>
      <div class="info-label">Program Studi</div>
      <div class="info-value"><?= esc($prodi['nama_prodi'] ?? '-') ?></div>

      <?php if (!empty($dosen['jabatan_fungsional'])): ?>
      <div class="info-label">Jabatan Fungsional</div>
      <div class="info-value"><?= esc($dosen['jabatan_fungsional']) ?></div>
      <?php endif; ?>

      <?php if (!empty($dosen['pendidikan_terakhir'])): ?>
      <div class="info-label">Pendidikan Terakhir</div>
      <div class="info-value"><?= esc($dosen['pendidikan_terakhir']) ?></div>
      <?php endif; ?>

      <?php if (!empty($dosen['bidang_keahlian'])): ?>
      <div class="info-label">Bidang Keahlian</div>
      <div class="info-value"><?= esc($dosen['bidang_keahlian']) ?></div>
      <?php endif; ?>

      <?php if (!empty($dosen['jam_kantor'])): ?>
      <div class="info-label">Jam Kantor</div>
      <div class="info-value"><?= esc($dosen['jam_kantor']) ?></div>
      <?php endif; ?>
    </div>
  </div>
</div>

  <!-- Statistik & Masa Kerja -->
  <div class="stats-row">
    <div class="stat-box stat-1">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <div style="font-weight:700; margin-bottom:6px;">Statistik Mengajar</div>
          <div style="display:flex; gap:30px;">
            <div>
              <div style="color:#6b7280;">Mata Kuliah</div>
              <div style="font-weight:700;"><?= $totalMatkul ?? 0 ?></div>
            </div>
            <div>
              <div style="color:#6b7280;">Kelas</div>
              <div style="font-weight:700;"><?= $totalKelas ?? 0 ?></div>
            </div>
            <div>
              <div style="color:#6b7280;">Mahasiswa</div>
              <div style="font-weight:700;"><?= $totalMahasiswa ?? 0 ?></div>
            </div>
          </div>
        </div>
        <div style="font-size:26px; opacity:0.6;"><i class="uil uil-book-open"></i></div>
      </div>
    </div>

    <div class="stat-box stat-2">
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <div style="color:#6b7280; font-weight:700;"><?= !empty($masaKerja) ? 'Masa Kerja' : 'Total SKS' ?></div>
          <div style="font-size:28px; font-weight:700;">
            <?php 
            if (!empty($masaKerja)) {
                echo $masaKerja;
            } else {
                $totalSKS = 0;
                foreach ($matakuliah as $mk) {
                    $totalSKS += isset($mk['sks']) ? (int)$mk['sks'] : 0;
                }
                echo $totalSKS;
            }
            ?>
          </div>
          <div style="color:#6b7280;"><?= !empty($masaKerja) ? 'Tahun' : 'SKS' ?></div>
        </div>
        <div style="opacity:0.6; font-size:26px;"><i class="uil uil-award"></i></div>
      </div>
    </div>

    <div class="stat-box stat-3">
      <div style="font-weight:700; color:#6b7280;">&nbsp;</div>
      <div style="text-align:right; opacity:0.6;"><i class="uil uil-book-open" style="font-size:28px;"></i></div>
    </div>
  </div>

  <!-- Mata Kuliah Table -->
  <div class="table-card">
    <div class="table-header"><i class="uil uil-books"></i> Mata Kuliah Semester Ini</div>

    <table class="mata-table">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Mata Kuliah</th>
          <th>Jumlah Kelas</th>
          <th>Jumlah Mahasiswa</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($matkulGrouped)): ?>
          <?php foreach ($matkulGrouped as $mk): ?>
            <tr>
              <td><span class="kd"><?= esc($mk['kode']) ?></span></td>
              <td><?= esc($mk['nama']) ?></td>
              <td><?= $mk['jumlah_kelas'] ?> Kelas</td>
              <td><?= $mk['jumlah_mahasiswa'] > 0 ? $mk['jumlah_mahasiswa'] . ' Mahasiswa' : '-' ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" style="text-align:center; padding:20px; color:#6b7280;">Belum ada mata kuliah yang diajar</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Publikasi -->
  <div>
    <div class="info-title" style="margin-bottom:12px; padding:10px 6px; background:#cdc7ff; border-radius:8px; width:260px;">
      <i class="uil uil-book-open"></i> Publikasi & Penelitian
    </div>

    <div class="pub-section">
      <?php if (!empty($publikasi)): ?>
        <?php foreach ($publikasi as $pub): ?>
          <div class="pub-item">
            <div class="pub-year"><?= esc($pub['tahun'] ?? date('Y')) ?></div>
            <div>
              <div style="font-weight:700; margin-bottom:6px;"><?= esc($pub['judul']) ?></div>
              <?php if (!empty($pub['penerbit'])): ?>
                <div style="font-size:13px; color:#6b7280; margin-bottom:8px;">
                  <?= esc($pub['jenis']) ?> · <?= esc($pub['penerbit']) ?>
                </div>
              <?php else: ?>
                <div style="font-size:13px; color:#6b7280; margin-bottom:8px;">
                  <?= esc($pub['jenis']) ?>
                </div>
              <?php endif; ?>
              <?php if (!empty($pub['deskripsi'])): ?>
                <div style="font-size:13px; color:#6b7280; margin-bottom:8px;">
                  <?= esc($pub['deskripsi']) ?>
                </div>
              <?php endif; ?>
              <div style="display:flex; gap:8px;">
                <span style="background:#fff; border-radius:6px; padding:6px 10px; font-size:12px; border:1px solid rgba(0,0,0,0.06);">
                  <?= esc($pub['jenis']) ?>
                </span>
                <?php if (!empty($pub['penerbit'])): ?>
                  <span style="background:#fff; border-radius:6px; padding:6px 10px; font-size:12px; border:1px solid rgba(0,0,0,0.06);">
                    <?= esc($pub['penerbit']) ?>
                  </span>
                <?php endif; ?>
                <?php if (!empty($pub['link'])): ?>
                  <a href="<?= esc($pub['link']) ?>" target="_blank" style="background:#fff; border-radius:6px; padding:6px 10px; font-size:12px; border:1px solid rgba(0,0,0,0.06); text-decoration:none; color:#2563eb;">
                    Link
                  </a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div style="text-align:center; padding:40px; color:#6b7280;">
          <i class="uil uil-file-slash" style="font-size:48px; opacity:0.3; margin-bottom:15px;"></i>
          <p>Belum ada publikasi</p>
          <p style="font-size:13px; margin-top:8px;">Data publikasi akan ditampilkan di sini</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

</div>

<?= $this->endSection() ?>
