<?= $this->extend('layout/admin_template') ?>

<?= $this->section('styles') ?>
<style>
    .page-content {
        max-width: 720px;
        margin: 0 auto 40px;
    }

    .form-card {
        background:#ffffff;
        border-radius:20px;
        border:1px solid #e5e7eb;
        padding:18px 22px 22px;
    }

    .form-title {
        font-size:18px;
        font-weight:600;
        margin-bottom:4px;
    }

    .form-subtitle {
        font-size:12px;
        color:#6b7280;
        margin-bottom:16px;
    }

    .form-group {
        margin-bottom:14px;
    }

    label {
        display:block;
        font-size:13px;
        font-weight:500;
        margin-bottom:4px;
    }

    input[type="text"],
    input[type="date"],
    textarea,
    select {
        width:100%;
        border-radius:12px;
        border:1px solid #e5e7eb;
        padding:8px 10px;
        font-size:13px;
        font-family:inherit;
    }

    textarea { min-height:90px; resize:vertical; }

    .btn-primary {
        border:none;
        border-radius:999px;
        padding:9px 16px;
        background:#22c55e;
        color:#fff;
        font-size:13px;
        font-weight:500;
        cursor:pointer;
    }

    .btn-secondary {
        border:none;
        border-radius:999px;
        padding:9px 16px;
        background:#e5e7eb;
        color:#374151;
        font-size:13px;
        font-weight:500;
        cursor:pointer;
    }

    .form-actions {
        display:flex;
        justify-content:flex-end;
        gap:10px;
        margin-top:10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="form-card">
    <div class="form-title">
        <?= $event ? 'Edit Kegiatan Akademik' : 'Tambah Kegiatan Akademik'; ?>
    </div>
    <div class="form-subtitle">
        Lengkapi detail kegiatan akademik yang akan ditampilkan pada kalender.
    </div>

    <form action="<?= esc($action); ?>" method="post">
        <?= csrf_field(); ?>

        <div class="form-group">
            <label for="nama_kegiatan">Nama Kegiatan</label>
            <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                   value="<?= esc($event['nama_kegiatan'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                   value="<?= esc($event['tanggal_mulai'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai</label>
            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                   value="<?= esc($event['tanggal_selesai'] ?? ''); ?>" required>
        </div>

        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"><?= esc($event['deskripsi'] ?? ''); ?></textarea>
        </div>

        <!-- Tipe Event -->
        <div class="form-group">
            <label for="tipe_event">Tipe Event</label>
            <?php $tipe = $event['tipe_event'] ?? ''; ?>
            <select id="tipe_event" name="tipe_event" required>
                <option value="">-- Pilih Tipe Event --</option>
                <option value="libur" <?= $tipe=='libur'?'selected':''; ?>>Libur</option>
                <option value="deadline_tugas" <?= $tipe=='deadline_tugas'?'selected':''; ?>>Deadline Tugas</option>
                <option value="ujian" <?= $tipe=='ujian'?'selected':''; ?>>Ujian/UTS/UAS</option>
                <option value="materi_acara" <?= $tipe=='materi_acara'?'selected':''; ?>>Materi/Acara</option>
            </select>
        </div>

        <!-- Semester -->
        <?php
            $sem = $event['semester'] ?? '';
            // daftar semester bawaan (boleh kamu tambah di sini)
            $knownSemesters = [
                'Gasal 2025/2026',
                'Genap 2025/2026',
            ];
            $isCustomSemester = $sem && !in_array($sem, $knownSemesters);
        ?>
        <div class="form-group">
            <label for="semester">Semester</label>
            <select id="semester" name="semester" required onchange="handleSemesterChange(this.value)">
                <option value="">-- Pilih Semester --</option>

                <option value="Gasal 2025/2026"
                    <?= (!$isCustomSemester && $sem=='Gasal 2025/2026') ? 'selected' : ''; ?>>
                    Gasal 2025/2026
                </option>
                <option value="Genap 2025/2026"
                    <?= (!$isCustomSemester && $sem=='Genap 2025/2026') ? 'selected' : ''; ?>>
                    Genap 2025/2026
                </option>

                <!-- opsi khusus tambah semester -->
                <option value="__new__" <?= $isCustomSemester ? 'selected' : ''; ?>>
                    + Tambah Semester Baru…
                </option>
            </select>

            <!-- input semester baru -->
            <input
                type="text"
                id="semester_new"
                name="semester_new"
                placeholder="Tulis semester baru, misal: Gasal 2026/2027"
                value="<?= $isCustomSemester ? esc($sem) : ''; ?>"
                style="margin-top:8px; <?= $isCustomSemester ? '' : 'display:none;'; ?>"
                <?= $isCustomSemester ? 'required' : ''; ?>
            >
        </div>

        <div class="form-actions">
            <a href="<?= base_url('admin/kalender'); ?>">
                <button type="button" class="btn-secondary">Batal</button>
            </a>
            <button type="submit" class="btn-primary">
                <?= $event ? 'Simpan Perubahan' : 'Simpan Kegiatan'; ?>
            </button>
        </div>
    </form>  
</div>

<script>
function handleSemesterChange(value) {
    const inputNew = document.getElementById("semester_new");

    if (value === "__new__") {
        inputNew.style.display = "block";
        inputNew.required = true;
        inputNew.focus();
    } else {
        inputNew.style.display = "none";
        inputNew.required = false;
        inputNew.value = "";
    }
}
</script>

<?= $this->endSection() ?>
