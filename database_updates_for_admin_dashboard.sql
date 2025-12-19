-- =====================================================
-- QUERY SQL UNTUK MELENGKAPI DASHBOARD ADMIN
-- =====================================================
-- File ini berisi semua query yang diperlukan untuk
-- membuat dashboard admin berfungsi sepenuhnya
-- =====================================================

-- =====================================================
-- 1. TAMBAH FIELD STATUS DI TABEL t_mahasiswa
-- =====================================================
ALTER TABLE `t_mahasiswa` 
ADD COLUMN `status` ENUM('Aktif', 'Non-aktif', 'Cuti', 'Lulus') DEFAULT 'Aktif' 
AFTER `semester`;

-- Update semua mahasiswa yang ada menjadi Aktif (jika belum ada data)
UPDATE `t_mahasiswa` SET `status` = 'Aktif' WHERE `status` IS NULL;

-- =====================================================
-- 2. TAMBAH FIELD TAMBAHAN DI TABEL t_dosen
-- =====================================================
ALTER TABLE `t_dosen` 
ADD COLUMN `nidn` VARCHAR(20) NULL AFTER `nip`,
ADD COLUMN `jabatan_fungsional` VARCHAR(50) NULL AFTER `no_wa`,
ADD COLUMN `pendidikan_terakhir` VARCHAR(100) NULL AFTER `jabatan_fungsional`,
ADD COLUMN `bidang_keahlian` VARCHAR(200) NULL AFTER `pendidikan_terakhir`,
ADD COLUMN `jam_kantor` VARCHAR(100) NULL AFTER `bidang_keahlian`,
ADD COLUMN `tanggal_mulai` DATE NULL AFTER `jam_kantor`,
ADD COLUMN `foto` VARCHAR(255) NULL AFTER `tanggal_mulai`;

-- =====================================================
-- 3. BUAT TABEL t_semester_aktif
-- =====================================================
CREATE TABLE IF NOT EXISTS `t_semester_aktif` (
  `id_semester_aktif` INT(11) NOT NULL AUTO_INCREMENT,
  `semester` VARCHAR(20) NOT NULL COMMENT 'Contoh: Ganjil, Genap',
  `tahun_ajaran` VARCHAR(20) NOT NULL COMMENT 'Contoh: 2025/2026',
  `tanggal_mulai` DATE NOT NULL,
  `tanggal_selesai` DATE NOT NULL,
  `status` ENUM('Aktif', 'Non-aktif') DEFAULT 'Non-aktif',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_semester_aktif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data semester aktif default
INSERT INTO `t_semester_aktif` (`semester`, `tahun_ajaran`, `tanggal_mulai`, `tanggal_selesai`, `status`) 
VALUES ('Ganjil', '2025/2026', '2025-09-01', '2026-01-31', 'Aktif');

-- =====================================================
-- 4. BUAT TABEL t_log_aktivitas
-- =====================================================
CREATE TABLE IF NOT EXISTS `t_log_aktivitas` (
  `id_log` INT(11) NOT NULL AUTO_INCREMENT,
  `user_type` ENUM('admin', 'dosen', 'mahasiswa') NOT NULL,
  `user_id` INT(11) NOT NULL,
  `action` VARCHAR(50) NOT NULL COMMENT 'create, update, delete, login, logout',
  `table_name` VARCHAR(50) NULL COMMENT 'Nama tabel yang diubah',
  `record_id` INT(11) NULL COMMENT 'ID record yang diubah',
  `description` TEXT NULL COMMENT 'Deskripsi aktivitas',
  `ip_address` VARCHAR(45) NULL,
  `user_agent` TEXT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  INDEX `idx_user` (`user_type`, `user_id`),
  INDEX `idx_table` (`table_name`, `record_id`),
  INDEX `idx_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- 5. BUAT TABEL t_nilai
-- =====================================================
CREATE TABLE IF NOT EXISTS `t_nilai` (
  `id_nilai` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` INT(11) NOT NULL,
  `id_matakuliah` INT(11) NOT NULL,
  `id_dosen` INT(11) NULL,
  `nilai` DECIMAL(4,2) NOT NULL COMMENT 'Nilai angka (0.00 - 100.00)',
  `grade` CHAR(2) NULL COMMENT 'A, B+, B, C+, C, D, E',
  `semester` INT(2) NULL,
  `tahun_ajaran` VARCHAR(20) NULL,
  `keterangan` TEXT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nilai`),
  INDEX `idx_mahasiswa` (`id_mahasiswa`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  INDEX `idx_dosen` (`id_dosen`),
  INDEX `idx_semester` (`semester`, `tahun_ajaran`),
  FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa`(`id_mahasiswa`) ON DELETE CASCADE,
  FOREIGN KEY (`id_matakuliah`) REFERENCES `t_matakuliah`(`id_matakuliah`) ON DELETE CASCADE,
  FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen`(`id_dosen`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- 6. BUAT TABEL t_kelas_mahasiswa (Relasi Many-to-Many)
-- =====================================================
CREATE TABLE IF NOT EXISTS `t_kelas_mahasiswa` (
  `id_kelas_mahasiswa` INT(11) NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` INT(11) NOT NULL,
  `id_kelas` INT(11) NULL COMMENT 'ID kelas/ruangan',
  `id_matakuliah` INT(11) NOT NULL,
  `semester` INT(2) NOT NULL,
  `tahun_ajaran` VARCHAR(20) NOT NULL,
  `status` ENUM('Aktif', 'Selesai', 'Drop') DEFAULT 'Aktif',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kelas_mahasiswa`),
  UNIQUE KEY `unique_enrollment` (`id_mahasiswa`, `id_matakuliah`, `semester`, `tahun_ajaran`),
  INDEX `idx_mahasiswa` (`id_mahasiswa`),
  INDEX `idx_kelas` (`id_kelas`),
  INDEX `idx_matakuliah` (`id_matakuliah`),
  INDEX `idx_semester` (`semester`, `tahun_ajaran`),
  FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa`(`id_mahasiswa`) ON DELETE CASCADE,
  FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas`(`id_kelas`) ON DELETE SET NULL,
  FOREIGN KEY (`id_matakuliah`) REFERENCES `t_matakuliah`(`id_matakuliah`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- 7. BUAT TABEL t_publikasi (Opsional - untuk profil dosen)
-- =====================================================
CREATE TABLE IF NOT EXISTS `t_publikasi` (
  `id_publikasi` INT(11) NOT NULL AUTO_INCREMENT,
  `id_dosen` INT(11) NOT NULL,
  `judul` VARCHAR(255) NOT NULL,
  `jenis` ENUM('Jurnal Internasional', 'Jurnal Nasional', 'Konferensi Internasional', 'Konferensi Nasional', 'Buku', 'Lainnya') NOT NULL,
  `penerbit` VARCHAR(200) NULL,
  `tahun` YEAR(4) NOT NULL,
  `link` VARCHAR(500) NULL,
  `deskripsi` TEXT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publikasi`),
  INDEX `idx_dosen` (`id_dosen`),
  INDEX `idx_tahun` (`tahun`),
  FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen`(`id_dosen`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- =====================================================
-- 8. TAMBAH FIELD prioritas DI TABEL pengingat
-- =====================================================
ALTER TABLE `pengingat` 
ADD COLUMN `prioritas` ENUM('Rendah', 'Sedang', 'Tinggi') DEFAULT 'Sedang' 
AFTER `aktif`;

-- =====================================================
-- 9. BUAT VIEW untuk menghitung IPK mahasiswa (Opsional)
-- =====================================================
CREATE OR REPLACE VIEW `v_ipk_mahasiswa` AS
SELECT 
    m.id_mahasiswa,
    m.nim,
    m.nama_mahasiswa,
    COUNT(n.id_nilai) as total_matakuliah,
    AVG(n.nilai) as ipk,
    SUM(CASE WHEN n.grade IN ('A', 'B+', 'B') THEN 1 ELSE 0 END) as matkul_lulus
FROM t_mahasiswa m
LEFT JOIN t_nilai n ON n.id_mahasiswa = m.id_mahasiswa
GROUP BY m.id_mahasiswa, m.nim, m.nama_mahasiswa;

-- =====================================================
-- 10. BUAT FUNCTION untuk menghitung IPK (Opsional)
-- =====================================================
DELIMITER $$

CREATE FUNCTION IF NOT EXISTS `hitung_ipk`(mahasiswa_id INT) 
RETURNS DECIMAL(4,2)
READS SQL DATA
DETERMINISTIC
BEGIN
    DECLARE hasil_ipk DECIMAL(4,2);
    
    SELECT AVG(nilai) INTO hasil_ipk
    FROM t_nilai
    WHERE id_mahasiswa = mahasiswa_id;
    
    RETURN IFNULL(hasil_ipk, 0.00);
END$$

DELIMITER ;

-- =====================================================
-- 11. BUAT TRIGGER untuk update log aktivitas (Opsional)
-- =====================================================
DELIMITER $$

-- Trigger untuk INSERT di t_mahasiswa
CREATE TRIGGER IF NOT EXISTS `trg_mahasiswa_insert` 
AFTER INSERT ON `t_mahasiswa`
FOR EACH ROW
BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'create', 't_mahasiswa', NEW.id_mahasiswa, 
            CONCAT('Menambah mahasiswa baru: ', NEW.nama_mahasiswa));
END$$

-- Trigger untuk UPDATE di t_mahasiswa
CREATE TRIGGER IF NOT EXISTS `trg_mahasiswa_update` 
AFTER UPDATE ON `t_mahasiswa`
FOR EACH ROW
BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'update', 't_mahasiswa', NEW.id_mahasiswa, 
            CONCAT('Mengupdate data mahasiswa: ', NEW.nama_mahasiswa));
END$$

-- Trigger untuk DELETE di t_mahasiswa
CREATE TRIGGER IF NOT EXISTS `trg_mahasiswa_delete` 
AFTER DELETE ON `t_mahasiswa`
FOR EACH ROW
BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'delete', 't_mahasiswa', OLD.id_mahasiswa, 
            CONCAT('Menghapus mahasiswa: ', OLD.nama_mahasiswa));
END$$

DELIMITER ;

-- =====================================================
-- 12. INSERT DATA CONTOH (Opsional - untuk testing)
-- =====================================================

-- Contoh data nilai (sesuaikan dengan ID yang ada di database)
-- INSERT INTO `t_nilai` (`id_mahasiswa`, `id_matakuliah`, `id_dosen`, `nilai`, `grade`, `semester`, `tahun_ajaran`)
-- VALUES 
-- (1, 1, 1, 85.50, 'A', 5, '2025/2026'),
-- (1, 2, 1, 78.00, 'B+', 5, '2025/2026'),
-- (2, 1, 1, 92.00, 'A', 5, '2025/2026');

-- Contoh data kelas mahasiswa
-- INSERT INTO `t_kelas_mahasiswa` (`id_mahasiswa`, `id_kelas`, `id_matakuliah`, `semester`, `tahun_ajaran`, `status`)
-- VALUES 
-- (1, 1, 1, 5, '2025/2026', 'Aktif'),
-- (2, 1, 1, 5, '2025/2026', 'Aktif');

-- =====================================================
-- CATATAN PENTING:
-- =====================================================
-- 1. Pastikan backup database sebelum menjalankan query ini
-- 2. Sesuaikan FOREIGN KEY constraints jika ada perbedaan struktur
-- 3. Untuk production, pertimbangkan untuk menambahkan index tambahan
-- 4. Trigger untuk log aktivitas bisa disesuaikan dengan kebutuhan
-- 5. Data contoh bisa dihapus setelah testing
-- =====================================================

