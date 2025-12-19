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
    .pengingat-root {
        margin-top: 0px;
        /* aman dari topbar */
        padding: 60px;
        /* jarak aman kiri-kanan */
        width: 110%;
        max-width: 1100px;
        /* supaya tidak terlalu melebar */
        box-sizing: border-box;
        font-family: "Poppins", system-ui, sans-serif;
    }

    /* ================= TITLE ================= */
    .pengingat-root h1 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 24px;
    }

    /* ================= STATS ================= */
    .stats-row {
        display: flex;
        gap: 20px;
        margin-bottom: 32px;
    }

    .stat-card {
        flex: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 22px;
        border-radius: 16px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    .stat-card.total {
        background: #EBD9FF;
    }

    .stat-card.upcoming {
        background: #DDEAFF;
    }

    .stat-card.urgent {
        background: #FFD8D8;
    }

    .stat-card .label {
        font-size: 14px;
        font-weight: 600;
    }

    .stat-card .count {
        font-size: 22px;
        font-weight: 700;
    }

    /* ================= TABLE CARD ================= */
    .table-card {
        background: #fff;
        border-radius: 16px;
        padding: 22px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.06);
    }

    .table-card .card-header {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .table-responsive {
        border-radius: 0 0 16px 16px;
    }

    table {
        margin-bottom: 0;
        width: 100%;
        border-collapse: collapse;
    }

    table th {
        background: #495057;
        color: #fff;
        text-align: center;
        vertical-align: middle;
        font-weight: 600;
        padding: 15px;
        border: none;
    }

    table td {
        vertical-align: middle;
        padding: 12px 15px;
        border: none;
        border-bottom: 1px solid #e9ecef;
    }

    table tbody tr:hover {
        background-color: #f1f3f4;
        transition: background-color 0.3s ease;
    }

    .badge-prodi {
        background: linear-gradient(135deg, #2E86C1 0%, #3498DB 100%);
        padding: 8px 12px;
        border-radius: 20px;
        color: #fff;
        font-size: 13px;
        font-weight: 500;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* ================= EMPTY STATE ================= */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 50px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    /* ================= RESPONSIVE ================= */
    @media(max-width: 900px) {
        .stats-row {
            flex-direction: column;
        }

        .table-card {
            padding: 15px;
        }

        table th,
        table td {
            padding: 10px;
        }
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

        <h1><i class="fas fa-chalkboard-teacher"></i> Mata Kuliah yang Diajar</h1>

        <div class="stats-row">
            <div class="stat-card total">
                <div>
                    <div class="label">Total Mata Kuliah</div>
                    <div class="count"><?= $total_matkul ?? 0 ?></div>
                </div>
                <i class="uil uil-book-open"></i>
            </div>
            <!-- Tambahkan stat card lain jika diperlukan, misalnya untuk prodi atau lainnya -->
        </div>

        <div class="table-card">
            <div class="card-header">
                <i class="fas fa-list-ul"></i> Daftar Mata Kuliah yang Diajar
            </div>
            <div class="table-responsive">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Kode</th>
                            <th>Nama Mata Kuliah</th>
                            <th width="80">SKS</th>
                            <th>Prodi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($matkul)): ?>
                            <?php $no = 1;
                            foreach ($matkul as $m): ?>
                                <tr>
                                    <td><strong><?= $no++ ?></strong></td>
                                    <td><code><?= esc($m['kode_matakuliah']) ?></code></td>
                                    <td class="text-start fw-semibold"><?= esc($m['nama_matakuliah']) ?></td>
                                    <td><span class="badge bg-secondary fs-6"><?= esc($m['sks']) ?></span></td>
                                    <td><span class="badge-prodi"><?= esc($m['nama_prodi']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class="fas fa-inbox"></i>
                                    <p>Data mata kuliah tidak tersedia</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>