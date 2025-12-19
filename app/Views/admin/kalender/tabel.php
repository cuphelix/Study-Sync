<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
    .page-content {
        max-width: 1360px;
        margin: 0 auto 40px;
    }

    .kal-header-card {
        background:#ffffff;
        border-radius:20px;
        padding:18px 22px;
        border:1px solid #e5e7eb;
        margin-bottom:18px;
        display:flex;
        justify-content:space-between;
        align-items:center;
    }

    .kal-title-main {
        display:flex;
        flex-direction:column;
        gap:4px;
    }

    .kal-title-main h2 {
        margin:0;
        font-size:20px;
        font-weight:600;
    }

    .kal-subtitle {
        font-size:13px;
        color:#6b7280;
    }

    .btn-primary {
        border:none;
        border-radius:999px;
        padding:9px 16px;
        background:#6366f1;
        color:#fff;
        font-size:13px;
        font-weight:500;
        cursor:pointer;
    }

    .kal-card {
        background:#ffffff;
        border-radius:20px;
        border:1px solid #e5e7eb;
        padding:16px 20px 18px;
    }

    .kal-tabs {
        display:flex;
        gap:18px;
        border-bottom:1px solid #e5e7eb;
        margin-bottom:16px;
        padding:0 4px;
    }

    .kal-tab-link {
        padding:10px 4px;
        font-size:13px;
        color:#6b7280;
        text-decoration:none;
        position:relative;
    }

    .kal-tab-link.active {
        color:#111827;
        font-weight:500;
    }
    .kal-tab-link.active::after {
        content:"";
        position:absolute;
        left:0; right:0; bottom:-1px;
        height:3px;
        border-radius:999px;
        background:#6366f1;
    }

    table {
        width:100%;
        border-collapse:collapse;
        font-size:13px;
    }

    thead tr {
        background:#f9fafb;
    }

    th, td {
        padding:9px 8px;
        border-bottom:1px solid #e5e7eb;
        text-align:left;
    }

    th { font-weight:500; color:#4b5563; }

    .badge-small {
        font-size:11px;
        padding:3px 8px;
        border-radius:999px;
        background:#e5e7eb;
    }

    .btn-sm {
        border:none;
        border-radius:999px;
        padding:5px 10px;
        font-size:11px;
        cursor:pointer;
    }

    .btn-edit { background:#e0f2fe; color:#1d4ed8; }
    .btn-delete { background:#fee2e2; color:#b91c1c; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="kal-header-card">
    <div class="kal-title-main">
        <h2>Manajemen Kalender Akademik</h2>
        <div class="kal-subtitle">Kelola semua kegiatan dan jadwal akademik kampus</div>
    </div>

    <a href="<?= base_url('admin/kalender/create'); ?>">
        <button class="btn-primary">Tambah Kegiatan</button>
    </a>
</div>

<div class="kal-card">
    <div class="kal-tabs">
        <a href="<?= base_url('admin/kalender'); ?>" class="kal-tab-link">Kalender</a>
        <a href="<?= base_url('admin/kalender/tabel'); ?>" class="kal-tab-link active">Tabel</a>
    </div>

    <div style="overflow-x:auto;">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Kegiatan</th>
                    <th>Tipe Event</th>
                    <th>Semester</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($events)): ?>
                    <?php $no=1; foreach($events as $ev): ?>
                        <?php
                            $tipe = strtolower($ev['tipe_event'] ?? 'materi_acara');
                            $tipeLabel = 'Materi/Acara';
                            if ($tipe === 'libur')            $tipeLabel = 'Libur';
                            elseif ($tipe === 'deadline_tugas') $tipeLabel = 'Deadline Tugas';
                            elseif ($tipe === 'ujian')        $tipeLabel = 'Ujian/UTS/UAS';
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($ev['nama_kegiatan']); ?></td>
                            <td><span class="badge-small"><?= esc($tipeLabel); ?></span></td>
                            <td><?= esc($ev['semester'] ?? '-'); ?></td>
                            <td><?= date('d-m-Y', strtotime($ev['tanggal_mulai'])); ?></td>
                            <td><?= date('d-m-Y', strtotime($ev['tanggal_selesai'])); ?></td>
                            <td><?= esc($ev['deskripsi']); ?></td>
                            <td>
                                <a href="<?= base_url('admin/kalender/edit/'.$ev['id_kalender']); ?>">
                                    <button class="btn-sm btn-edit">Edit</button>
                                </a>
                                <a href="<?= base_url('admin/kalender/delete/'.$ev['id_kalender']); ?>"
                                   onclick="return confirm('Hapus kegiatan ini?')">
                                    <button class="btn-sm btn-delete">Hapus</button>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center;color:#9ca3af;">
                            Belum ada kegiatan yang tercatat.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
