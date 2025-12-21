-- MySQL dump 10.13  Distrib 9.4.0, for Win64 (x86_64)
--
-- Host: localhost    Database: studysync
-- ------------------------------------------------------
-- Server version	9.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `jadwal_kuliah`
--

DROP TABLE IF EXISTS `jadwal_kuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_kuliah` (
  `id_jadwal` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int DEFAULT NULL,
  `id_mk` int DEFAULT NULL,
  `id_dosen` int DEFAULT NULL,
  `id_ruangan` int DEFAULT NULL,
  `hari` enum('Senin','Selasa','Rabu','Kamis','Jumat','Sabtu') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `minggu_ke` int DEFAULT NULL,
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semester` enum('Ganjil','Genap') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `fk_jadwal_matkul` (`id_mk`),
  KEY `fk_jadwal_dosen` (`id_dosen`),
  KEY `fk_jadwal_ruangan` (`id_ruangan`),
  KEY `fk_jadwal_mahasiswa` (`id_mahasiswa`),
  CONSTRAINT `fk_jadwal_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_jadwal_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_jadwal_matkul` FOREIGN KEY (`id_mk`) REFERENCES `t_matakuliah` (`id_matakuliah`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_jadwal_ruangan` FOREIGN KEY (`id_ruangan`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_kuliah`
--

LOCK TABLES `jadwal_kuliah` WRITE;
/*!40000 ALTER TABLE `jadwal_kuliah` DISABLE KEYS */;
INSERT INTO `jadwal_kuliah` VALUES (2,1,2,2,2,'Senin','13:00:00','15:30:00',1,'2024/2025','Ganjil'),(3,1,1,1,1,'Selasa','08:00:00','10:30:00',1,'2024/2025','Ganjil'),(4,1,4,4,4,'Rabu','10:30:00','13:00:00',1,'2024/2025','Ganjil'),(5,1,2,2,2,'Kamis','08:00:00','10:30:00',1,'2024/2025','Ganjil'),(6,1,4,4,4,'Jumat','13:00:00','15:30:00',1,'2024/2025','Ganjil'),(7,2,1,1,1,'Senin','08:00:00','10:30:00',1,'2024/2025','Ganjil'),(8,2,2,2,2,'Selasa','13:00:00','15:30:00',1,'2024/2025','Ganjil'),(9,3,3,3,3,'Rabu','08:00:00','10:30:00',1,'2024/2025','Ganjil'),(10,3,4,4,4,'Kamis','13:00:00','15:30:00',1,'2024/2025','Ganjil'),(11,NULL,1,1,1,'Senin','08:00:00','10:00:00',2,'2024/2025','Ganjil');
/*!40000 ALTER TABLE `jadwal_kuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal_pengganti`
--

DROP TABLE IF EXISTS `jadwal_pengganti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jadwal_pengganti` (
  `id_pengganti` int NOT NULL AUTO_INCREMENT,
  `id_jadwal` int DEFAULT NULL,
  `tanggal_pengganti` date DEFAULT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL,
  `alasan` text COLLATE utf8mb4_general_ci,
  `status` enum('diajukan','disetujui','ditolak') COLLATE utf8mb4_general_ci DEFAULT 'diajukan',
  `disetujui_oleh` int DEFAULT NULL,
  PRIMARY KEY (`id_pengganti`),
  KEY `fk_pengganti_jadwal` (`id_jadwal`),
  KEY `fk_pengganti_disetujui` (`disetujui_oleh`),
  CONSTRAINT `fk_pengganti_disetujui` FOREIGN KEY (`disetujui_oleh`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pengganti_jadwal` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_kuliah` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal_pengganti`
--

LOCK TABLES `jadwal_pengganti` WRITE;
/*!40000 ALTER TABLE `jadwal_pengganti` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal_pengganti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kalender_akademik`
--

DROP TABLE IF EXISTS `kalender_akademik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kalender_akademik` (
  `id_kalender` int NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `tipe_event` enum('libur','deadline_tugas','ujian','materi_acara') COLLATE utf8mb4_general_ci NOT NULL,
  `semester` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_kalender`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kalender_akademik`
--

LOCK TABLES `kalender_akademik` WRITE;
/*!40000 ALTER TABLE `kalender_akademik` DISABLE KEYS */;
INSERT INTO `kalender_akademik` VALUES (1,'UAS','2025-12-16','2025-12-22','UAS Semester Ganjil','ujian','Gasal 2025/2026'),(3,'brekad','2025-12-19','2025-12-21','aku nak meletop','materi_acara','Gasal 2025/2026');
/*!40000 ALTER TABLE `kalender_akademik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengingat`
--

DROP TABLE IF EXISTS `pengingat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengingat` (
  `id_pengingat` int NOT NULL AUTO_INCREMENT,
  `id_user` int DEFAULT NULL,
  `judul` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `id_kalender` int DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT '1',
  `prioritas` enum('Rendah','Sedang','Tinggi') COLLATE utf8mb4_general_ci DEFAULT 'Sedang',
  PRIMARY KEY (`id_pengingat`),
  KEY `fk_pengingat_kalender` (`id_kalender`),
  KEY `fk_pengingat_user` (`id_user`),
  CONSTRAINT `fk_pengingat_kalender` FOREIGN KEY (`id_kalender`) REFERENCES `kalender_akademik` (`id_kalender`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_pengingat_user` FOREIGN KEY (`id_user`) REFERENCES `t_mahasiswa` (`id_mahasiswa`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengingat`
--

LOCK TABLES `pengingat` WRITE;
/*!40000 ALTER TABLE `pengingat` DISABLE KEYS */;
INSERT INTO `pengingat` VALUES (1,1,'Kumpulkan Tugas Akhir','Deadline tugas pemrograman mobile di portal','2025-12-20','23:59:00',NULL,1,'Sedang'),(2,1,'Rapat Organisasi','Pembahasan program kerja semester depan','2025-12-21','14:00:00',NULL,1,'Sedang'),(3,1,'Bayar UKT','Batas akhir pembayaran semester genap','2025-12-25','10:00:00',NULL,1,'Sedang');
/*!40000 ALTER TABLE `pengingat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_admin`
--

DROP TABLE IF EXISTS `t_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_admin` (
  `id_admin` int NOT NULL AUTO_INCREMENT,
  `nama_admin` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_wa` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_prodi` int DEFAULT NULL,
  PRIMARY KEY (`id_admin`),
  KEY `fk_admin_prodi` (`id_prodi`),
  CONSTRAINT `fk_admin_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `t_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_admin`
--

LOCK TABLES `t_admin` WRITE;
/*!40000 ALTER TABLE `t_admin` DISABLE KEYS */;
INSERT INTO `t_admin` VALUES (1,'Admin Satu','admin1@example.com','admin123','081200000001',1),(2,'Admin Dua','admin2@example.com','admin123','081200000002',1),(3,'Admin Tiga','admin3@example.com','admin123','081200000003',2),(4,'Admin Empat','admin4@example.com','admin123','081200000004',2),(5,'Admin Lima','admin5@example.com','admin123','081200000005',3),(6,'Admin Enam','admin6@example.com','admin123','081200000006',3),(7,'Admin Tujuh','admin7@example.com','admin123','081200000007',4),(8,'Admin Delapan','admin8@example.com','admin123','081200000008',4),(9,'Admin Sembilan','admin9@example.com','admin123','081200000009',5),(10,'Admin Sepuluh','admin10@example.com','admin123','081200000010',5);
/*!40000 ALTER TABLE `t_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_akses_file`
--

DROP TABLE IF EXISTS `t_akses_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_akses_file` (
  `id_akses` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int DEFAULT NULL,
  `id_file` int DEFAULT NULL,
  `tanggal_akses` datetime DEFAULT NULL,
  PRIMARY KEY (`id_akses`),
  KEY `fk_akses_mahasiswa` (`id_mahasiswa`),
  KEY `fk_akses_file` (`id_file`),
  CONSTRAINT `fk_akses_file` FOREIGN KEY (`id_file`) REFERENCES `t_file_materi_dan_ebook` (`id_file`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_akses_mahasiswa` FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_akses_file`
--

LOCK TABLES `t_akses_file` WRITE;
/*!40000 ALTER TABLE `t_akses_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_akses_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_dosen`
--

DROP TABLE IF EXISTS `t_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_dosen` (
  `id_dosen` int NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nip` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nidn` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_wa` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jabatan_fungsional` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `bidang_keahlian` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jam_kantor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_prodi` int DEFAULT NULL,
  PRIMARY KEY (`id_dosen`),
  KEY `fk_dosen_prodi` (`id_prodi`),
  CONSTRAINT `fk_dosen_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `t_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_dosen`
--

LOCK TABLES `t_dosen` WRITE;
/*!40000 ALTER TABLE `t_dosen` DISABLE KEYS */;
INSERT INTO `t_dosen` VALUES (1,'Dr. Budi Santoso','198001012010011001',NULL,'budi@example.com','dosen123','081210000001',NULL,NULL,NULL,NULL,NULL,NULL,1),(2,'Andi Pratama, S.Kom M.Komt','198203142012021020',NULL,'andi@example.com','dosen123','081210000002',NULL,NULL,NULL,NULL,NULL,NULL,1),(3,'Dewi Lestari, M.Kom','198501112015022003',NULL,'dewi@example.com','dosen123','081210000003',NULL,NULL,NULL,NULL,NULL,NULL,2),(4,'Siti Rahma, M.T','198707152014021004',NULL,'siti@example.com','dosen123','081210000004',NULL,NULL,NULL,NULL,NULL,NULL,2),(5,'Rudi Hartono, M.T','197905062009031005',NULL,'rudi@example.com','dosen123','081210000005',NULL,NULL,NULL,NULL,NULL,NULL,3),(6,'Maria M., M.Kom','198309101013021006',NULL,'maria@example.com','dosen123','081210000006',NULL,NULL,NULL,NULL,NULL,NULL,3),(7,'Joko Purnomo, M.Kom','198911232018021007',NULL,'joko@example.com','dosen123','081210000007',NULL,NULL,NULL,NULL,NULL,NULL,4),(8,'Mega Sari, M.T','198202192010011008',NULL,'mega@example.com','dosen123','081210000008',NULL,NULL,NULL,NULL,NULL,NULL,4),(9,'Tri Handoko, M.Kom','198605281014021009',NULL,'tri@example.com','dosen123','081210000009',NULL,NULL,NULL,NULL,NULL,NULL,5),(10,'Dian Pertiwi, M.Kom','198304071013011010',NULL,'dian@example.com','dosen123','081210000010',NULL,NULL,NULL,NULL,NULL,NULL,5),(11,'Baban se bakum','198203142012021129',NULL,'bibit@jamil.komi','$2y$12$3B4fbzLto7RUn1ZeNPKBWOoL1nacAOfa04FtXyVcn7r.fQAbX0I/y','08kapankapan',NULL,NULL,NULL,NULL,NULL,NULL,2);
/*!40000 ALTER TABLE `t_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_file_materi_dan_ebook`
--

DROP TABLE IF EXISTS `t_file_materi_dan_ebook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_file_materi_dan_ebook` (
  `id_file` int NOT NULL AUTO_INCREMENT,
  `judul_file` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `file_path` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_file` enum('pdf','ppt','docx','xlsx','link') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tanggal_upload` datetime DEFAULT NULL,
  `id_dosen` int DEFAULT NULL,
  `id_matakuliah` int DEFAULT NULL,
  PRIMARY KEY (`id_file`),
  KEY `fk_file_dosen` (`id_dosen`),
  KEY `fk_file_matkul` (`id_matakuliah`),
  CONSTRAINT `fk_file_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_file_matkul` FOREIGN KEY (`id_matakuliah`) REFERENCES `t_matakuliah` (`id_matakuliah`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_file_materi_dan_ebook`
--

LOCK TABLES `t_file_materi_dan_ebook` WRITE;
/*!40000 ALTER TABLE `t_file_materi_dan_ebook` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_file_materi_dan_ebook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_gedung`
--

DROP TABLE IF EXISTS `t_gedung`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_gedung` (
  `id_gedung` int NOT NULL AUTO_INCREMENT,
  `kode_gedung` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_gedung` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_gedung`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_gedung`
--

LOCK TABLES `t_gedung` WRITE;
/*!40000 ALTER TABLE `t_gedung` DISABLE KEYS */;
INSERT INTO `t_gedung` VALUES (1,'G1','Gedung Teori 1'),(2,'G2','Gedung Teori 2'),(3,'G3','Gedung Laboratorium 1'),(4,'G4','Gedung Laboratorium 2'),(5,'G5','Gedung Administrasi'),(6,'G6','Gedung Kuliah Umum'),(7,'G7','Gedung Teknik'),(8,'G8','Gedung Informatika'),(9,'G9','Gedung Elektro'),(10,'G10','Gedung Riset');
/*!40000 ALTER TABLE `t_gedung` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_jurusan`
--

DROP TABLE IF EXISTS `t_jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_jurusan` (
  `id_jurusan` int NOT NULL AUTO_INCREMENT,
  `kode_jurusan` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_jurusan` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_jurusan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_jurusan`
--

LOCK TABLES `t_jurusan` WRITE;
/*!40000 ALTER TABLE `t_jurusan` DISABLE KEYS */;
INSERT INTO `t_jurusan` VALUES (1,'JR01','Teknik Informatika'),(2,'JR02','Teknik Elektro'),(3,'JR03','Teknik Mesin'),(4,'JR04','Teknik Sipil'),(5,'JR05','Akuntansi'),(6,'JR06','Administrasi Bisnis'),(7,'JR07','Manajemen Informatika'),(8,'JR08','Sistem Informasi'),(9,'JR09','Teknologi Komputer'),(10,'JR10','Teknik Telekomunikasi');
/*!40000 ALTER TABLE `t_jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_kelas`
--

DROP TABLE IF EXISTS `t_kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_kelas` (
  `id_kelas` int NOT NULL AUTO_INCREMENT,
  `kode_kelas` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `lantai` int DEFAULT NULL,
  `id_gedung` int DEFAULT NULL,
  PRIMARY KEY (`id_kelas`),
  KEY `fk_kelas_gedung` (`id_gedung`),
  CONSTRAINT `fk_kelas_gedung` FOREIGN KEY (`id_gedung`) REFERENCES `t_gedung` (`id_gedung`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_kelas`
--

LOCK TABLES `t_kelas` WRITE;
/*!40000 ALTER TABLE `t_kelas` DISABLE KEYS */;
INSERT INTO `t_kelas` VALUES (1,'IF-1A',1,8),(2,'IF-1B',1,8),(3,'IF-2A',2,8),(4,'IF-2B',2,8),(5,'EL-1A',1,9),(6,'EL-1B',1,9),(7,'EL-2A',2,9),(8,'MK-1A',1,7),(9,'MK-2A',2,7),(10,'TS-1A',1,10),(11,'IF-9A',9,1);
/*!40000 ALTER TABLE `t_kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_kelas_mahasiswa`
--

DROP TABLE IF EXISTS `t_kelas_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_kelas_mahasiswa` (
  `id_kelas_mahasiswa` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `id_kelas` int DEFAULT NULL COMMENT 'ID kelas/ruangan',
  `id_matakuliah` int NOT NULL,
  `semester` int NOT NULL,
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Aktif','Selesai','Drop') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_kelas_mahasiswa`),
  UNIQUE KEY `unique_enrollment` (`id_mahasiswa`,`id_matakuliah`,`semester`,`tahun_ajaran`),
  KEY `idx_mahasiswa` (`id_mahasiswa`),
  KEY `idx_kelas` (`id_kelas`),
  KEY `idx_matakuliah` (`id_matakuliah`),
  KEY `idx_semester` (`semester`,`tahun_ajaran`),
  CONSTRAINT `t_kelas_mahasiswa_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE,
  CONSTRAINT `t_kelas_mahasiswa_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE SET NULL,
  CONSTRAINT `t_kelas_mahasiswa_ibfk_3` FOREIGN KEY (`id_matakuliah`) REFERENCES `t_matakuliah` (`id_matakuliah`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_kelas_mahasiswa`
--

LOCK TABLES `t_kelas_mahasiswa` WRITE;
/*!40000 ALTER TABLE `t_kelas_mahasiswa` DISABLE KEYS */;
INSERT INTO `t_kelas_mahasiswa` VALUES (1,1,1,1,1,'2024/2025','Aktif','2025-12-20 17:28:30','2025-12-20 17:28:30'),(2,1,2,2,1,'2024/2025','Aktif','2025-12-20 17:28:30','2025-12-20 17:28:30');
/*!40000 ALTER TABLE `t_kelas_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_log_aktivitas`
--

DROP TABLE IF EXISTS `t_log_aktivitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_log_aktivitas` (
  `id_log` int NOT NULL AUTO_INCREMENT,
  `user_type` enum('admin','dosen','mahasiswa') COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'create, update, delete, login, logout',
  `table_name` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Nama tabel yang diubah',
  `record_id` int DEFAULT NULL COMMENT 'ID record yang diubah',
  `description` text COLLATE utf8mb4_general_ci COMMENT 'Deskripsi aktivitas',
  `ip_address` varchar(45) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_log`),
  KEY `idx_user` (`user_type`,`user_id`),
  KEY `idx_table` (`table_name`,`record_id`),
  KEY `idx_created` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_log_aktivitas`
--

LOCK TABLES `t_log_aktivitas` WRITE;
/*!40000 ALTER TABLE `t_log_aktivitas` DISABLE KEYS */;
INSERT INTO `t_log_aktivitas` VALUES (1,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratamat',NULL,NULL,'2025-12-19 19:12:25'),(2,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratama',NULL,NULL,'2025-12-19 19:23:54'),(3,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratamat',NULL,NULL,'2025-12-19 19:24:45'),(4,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratama',NULL,NULL,'2025-12-19 19:25:02'),(5,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratamat',NULL,NULL,'2025-12-19 19:31:15'),(6,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratama',NULL,NULL,'2025-12-19 19:31:29'),(7,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratama',NULL,NULL,'2025-12-19 20:12:44'),(8,'admin',1,'update','t_mahasiswa',10,'Mengupdate data mahasiswa: Angga Pratama',NULL,NULL,'2025-12-19 20:13:02'),(9,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:19:35'),(10,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:19:53'),(11,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:20:23'),(12,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:20:33'),(13,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:20:49'),(14,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:20:59'),(15,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkytak',NULL,NULL,'2025-12-20 04:28:27'),(16,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:28:35'),(17,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:28:53'),(18,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 04:29:09'),(19,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 22:19:10'),(20,'admin',1,'update','t_mahasiswa',1,'Mengupdate data mahasiswa: Milkyta',NULL,NULL,'2025-12-20 22:21:04'),(21,'admin',1,'create','t_mahasiswa',11,'Menambah mahasiswa baru: M. Sibawaihi Shiddiq Tarigan',NULL,NULL,'2025-12-20 23:27:48');
/*!40000 ALTER TABLE `t_log_aktivitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_mahasiswa`
--

DROP TABLE IF EXISTS `t_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_mahasiswa` (
  `id_mahasiswa` int NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_mahasiswa` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_masuk` year DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `status` enum('Aktif','Non-aktif','Cuti','Lulus') COLLATE utf8mb4_general_ci DEFAULT 'Aktif',
  `id_prodi` int DEFAULT NULL,
  PRIMARY KEY (`id_mahasiswa`),
  KEY `fk_mahasiswa_prodi` (`id_prodi`),
  CONSTRAINT `fk_mahasiswa_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `t_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_mahasiswa`
--

LOCK TABLES `t_mahasiswa` WRITE;
/*!40000 ALTER TABLE `t_mahasiswa` DISABLE KEYS */;
INSERT INTO `t_mahasiswa` VALUES (1,'231011001','Milkyta','milky@example.com','mhs123',2023,4,'Aktif',1),(2,'231011002','Rina Putri','rina@example.com','mhs123',2023,2,'Aktif',1),(3,'231021003','Siti Aisyah','aisyah@example.com','mhs123',2022,4,'Aktif',2),(4,'231021004','Rafi Hidayat','rafi@example.com','mhs123',2022,4,'Aktif',2),(5,'231031005','Dewi Kartika','dewik@example.com','mhs123',2023,2,'Aktif',3),(6,'231031006','Bagas Saputra','bagas@example.com','mhs123',2023,2,'Aktif',3),(7,'231041007','Salsabila','salsa@example.com','mhs123',2024,1,'Aktif',4),(8,'231041008','Yudi Prakoso','yudi@example.com','mhs123',2024,1,'Aktif',4),(9,'231051009','Lestari Ayu','lestari@example.com','mhs123',2023,3,'Aktif',5),(10,'231051010','Angga Pratama','angga@example.com','mhs123',2023,3,'Aktif',5),(11,'2305181079','M. Sibawaihi Shiddiq Tarigan','polmed@gmail.com','$2y$12$xQeBA0VkbbteHiDbwT1HKuktKU.U/g6fNe.y/m0//u/gisSx0TrnW',2025,1,'Aktif',2);
/*!40000 ALTER TABLE `t_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_mahasiswa_insert` AFTER INSERT ON `t_mahasiswa` FOR EACH ROW BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'create', 't_mahasiswa', NEW.id_mahasiswa, 
            CONCAT('Menambah mahasiswa baru: ', NEW.nama_mahasiswa));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_mahasiswa_update` AFTER UPDATE ON `t_mahasiswa` FOR EACH ROW BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'update', 't_mahasiswa', NEW.id_mahasiswa, 
            CONCAT('Mengupdate data mahasiswa: ', NEW.nama_mahasiswa));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_unicode_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `trg_mahasiswa_delete` AFTER DELETE ON `t_mahasiswa` FOR EACH ROW BEGIN
    INSERT INTO t_log_aktivitas (user_type, user_id, action, table_name, record_id, description)
    VALUES ('admin', 1, 'delete', 't_mahasiswa', OLD.id_mahasiswa, 
            CONCAT('Menghapus mahasiswa: ', OLD.nama_mahasiswa));
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `t_matakuliah`
--

DROP TABLE IF EXISTS `t_matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_matakuliah` (
  `id_matakuliah` int NOT NULL AUTO_INCREMENT,
  `kode_matakuliah` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_matakuliah` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `semester` int DEFAULT NULL,
  `sks` tinyint NOT NULL DEFAULT '3',
  `id_dosen` int DEFAULT NULL,
  `id_prodi` int DEFAULT NULL,
  `jenis` enum('Wajib','Pilihan') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Wajib',
  `id_kelas` int DEFAULT NULL,
  PRIMARY KEY (`id_matakuliah`),
  KEY `fk_matkul_dosen` (`id_dosen`),
  KEY `fk_matkul_prodi` (`id_prodi`),
  KEY `fk_matkul_kelas` (`id_kelas`),
  CONSTRAINT `fk_matkul_dosen` FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_matkul_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_matkul_prodi` FOREIGN KEY (`id_prodi`) REFERENCES `t_prodi` (`id_prodi`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_matakuliah`
--

LOCK TABLES `t_matakuliah` WRITE;
/*!40000 ALTER TABLE `t_matakuliah` DISABLE KEYS */;
INSERT INTO `t_matakuliah` VALUES (1,'IF101','Algoritma dan Pemrograman',1,3,1,1,'Wajib',1),(2,'IF102','Basis Data',2,3,2,1,'Wajib',2),(3,'IF201','Struktur Data',3,3,3,2,'Wajib',3),(4,'IF202','Pemrograman Web',3,3,4,2,'Wajib',4),(5,'EL101','Rangkaian Listrik',1,3,5,3,'Wajib',5),(6,'EL102','Elektronika Dasar',2,3,6,3,'Wajib',6),(7,'EL201','Sistem Digital',3,3,7,4,'Wajib',7),(8,'MK101','Gambar Teknik',1,3,8,5,'Wajib',8),(9,'MK201','Material Teknik',3,3,9,5,'Wajib',9),(10,'IF301','Machine Learning',5,3,10,2,'Wajib',3),(11,'Whenyes','When yes',9,3,9,9,'Wajib',9);
/*!40000 ALTER TABLE `t_matakuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_nilai`
--

DROP TABLE IF EXISTS `t_nilai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_nilai` (
  `id_nilai` int NOT NULL AUTO_INCREMENT,
  `id_mahasiswa` int NOT NULL,
  `id_matakuliah` int NOT NULL,
  `id_dosen` int DEFAULT NULL,
  `nilai` decimal(4,2) NOT NULL COMMENT 'Nilai angka (0.00 - 100.00)',
  `grade` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'A, B+, B, C+, C, D, E',
  `semester` int DEFAULT NULL,
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_nilai`),
  KEY `idx_mahasiswa` (`id_mahasiswa`),
  KEY `idx_matakuliah` (`id_matakuliah`),
  KEY `idx_dosen` (`id_dosen`),
  KEY `idx_semester` (`semester`,`tahun_ajaran`),
  CONSTRAINT `t_nilai_ibfk_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `t_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE,
  CONSTRAINT `t_nilai_ibfk_2` FOREIGN KEY (`id_matakuliah`) REFERENCES `t_matakuliah` (`id_matakuliah`) ON DELETE CASCADE,
  CONSTRAINT `t_nilai_ibfk_3` FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_nilai`
--

LOCK TABLES `t_nilai` WRITE;
/*!40000 ALTER TABLE `t_nilai` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_nilai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_prodi`
--

DROP TABLE IF EXISTS `t_prodi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_prodi` (
  `id_prodi` int NOT NULL AUTO_INCREMENT,
  `kode_prodi` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_prodi` varchar(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_jurusan` int DEFAULT NULL,
  PRIMARY KEY (`id_prodi`),
  KEY `fk_prodi_jurusan` (`id_jurusan`),
  CONSTRAINT `fk_prodi_jurusan` FOREIGN KEY (`id_jurusan`) REFERENCES `t_jurusan` (`id_jurusan`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_prodi`
--

LOCK TABLES `t_prodi` WRITE;
/*!40000 ALTER TABLE `t_prodi` DISABLE KEYS */;
INSERT INTO `t_prodi` VALUES (1,'PR01','D3 Teknik Informatika',1),(2,'PR02','D4 Teknik Informatika',1),(3,'PR03','D3 Teknik Elektro',2),(4,'PR04','D4 Teknik Elektro',2),(5,'PR05','D3 Teknik Mesin',3),(6,'PR06','D4 Teknik Mesin',3),(7,'PR07','D3 Sistem Informasi',8),(8,'PR08','D4 Sistem Informasi',8),(9,'PR09','D3 Teknologi Komputer',9),(10,'PR10','D4 Teknologi Komputer',9);
/*!40000 ALTER TABLE `t_prodi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_publikasi`
--

DROP TABLE IF EXISTS `t_publikasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_publikasi` (
  `id_publikasi` int NOT NULL AUTO_INCREMENT,
  `id_dosen` int NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis` enum('Jurnal Internasional','Jurnal Nasional','Konferensi Internasional','Konferensi Nasional','Buku','Lainnya') COLLATE utf8mb4_general_ci NOT NULL,
  `penerbit` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun` year NOT NULL,
  `link` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_publikasi`),
  KEY `idx_dosen` (`id_dosen`),
  KEY `idx_tahun` (`tahun`),
  CONSTRAINT `t_publikasi_ibfk_1` FOREIGN KEY (`id_dosen`) REFERENCES `t_dosen` (`id_dosen`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_publikasi`
--

LOCK TABLES `t_publikasi` WRITE;
/*!40000 ALTER TABLE `t_publikasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_publikasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_semester_aktif`
--

DROP TABLE IF EXISTS `t_semester_aktif`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `t_semester_aktif` (
  `id_semester_aktif` int NOT NULL AUTO_INCREMENT,
  `semester` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contoh: Ganjil, Genap',
  `tahun_ajaran` varchar(20) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Contoh: 2025/2026',
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `status` enum('Aktif','Non-aktif') COLLATE utf8mb4_general_ci DEFAULT 'Non-aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_semester_aktif`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_semester_aktif`
--

LOCK TABLES `t_semester_aktif` WRITE;
/*!40000 ALTER TABLE `t_semester_aktif` DISABLE KEYS */;
INSERT INTO `t_semester_aktif` VALUES (1,'Ganjil','2025/2026','2025-09-01','2026-01-31','Aktif','2025-12-19 18:23:52','2025-12-19 18:23:52');
/*!40000 ALTER TABLE `t_semester_aktif` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tugas`
--

DROP TABLE IF EXISTS `tugas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tugas` (
  `id_tugas` int NOT NULL AUTO_INCREMENT,
  `id_mk` int DEFAULT NULL,
  `id_kelas` int DEFAULT NULL,
  `judul_tugas` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_general_ci,
  `tanggal_diberikan` date DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `tipe_tugas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_tugas`),
  KEY `fk_tugas_matkul` (`id_mk`),
  KEY `fk_tugas_kelas` (`id_kelas`),
  CONSTRAINT `fk_tugas_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `t_kelas` (`id_kelas`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `fk_tugas_matkul` FOREIGN KEY (`id_mk`) REFERENCES `t_matakuliah` (`id_matakuliah`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tugas`
--

LOCK TABLES `tugas` WRITE;
/*!40000 ALTER TABLE `tugas` DISABLE KEYS */;
/*!40000 ALTER TABLE `tugas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `v_ipk_mahasiswa`
--

DROP TABLE IF EXISTS `v_ipk_mahasiswa`;
/*!50001 DROP VIEW IF EXISTS `v_ipk_mahasiswa`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `v_ipk_mahasiswa` AS SELECT 
 1 AS `id_mahasiswa`,
 1 AS `nim`,
 1 AS `nama_mahasiswa`,
 1 AS `total_matakuliah`,
 1 AS `ipk`,
 1 AS `matkul_lulus`*/;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_ipk_mahasiswa`
--

/*!50001 DROP VIEW IF EXISTS `v_ipk_mahasiswa`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_unicode_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_ipk_mahasiswa` AS select `m`.`id_mahasiswa` AS `id_mahasiswa`,`m`.`nim` AS `nim`,`m`.`nama_mahasiswa` AS `nama_mahasiswa`,count(`n`.`id_nilai`) AS `total_matakuliah`,avg(`n`.`nilai`) AS `ipk`,sum((case when (`n`.`grade` in ('A','B+','B')) then 1 else 0 end)) AS `matkul_lulus` from (`t_mahasiswa` `m` left join `t_nilai` `n` on((`n`.`id_mahasiswa` = `m`.`id_mahasiswa`))) group by `m`.`id_mahasiswa`,`m`.`nim`,`m`.`nama_mahasiswa` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-21  7:54:20
