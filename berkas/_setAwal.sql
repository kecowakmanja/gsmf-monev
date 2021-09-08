-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.17-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for gsmf-monev
CREATE DATABASE IF NOT EXISTS `gsmf-monev` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `gsmf-monev`;

-- Dumping structure for table gsmf-monev.hutang_master
CREATE TABLE IF NOT EXISTS `hutang_master` (
  `hutprm` int(11) NOT NULL AUTO_INCREMENT,
  `hut_mst_lock` int(11) DEFAULT 0,
  `hut_mst_dt` varchar(20) DEFAULT NULL,
  `hut_mst_nobuk` varchar(20) DEFAULT NULL,
  `hut_mst_noref` varchar(20) DEFAULT NULL,
  `hut_mst_sts` varchar(20) DEFAULT NULL,
  `hut_mst_tgl` date DEFAULT NULL,
  `hut_mst_tglrnc` date DEFAULT NULL,
  `hut_mst_pst` varchar(20) DEFAULT NULL,
  `hut_mst_kel` varchar(20) DEFAULT NULL,
  `hut_mst_rek` varchar(20) DEFAULT NULL,
  `hut_mst_rnc` double DEFAULT NULL,
  `hut_mst_ttl` double DEFAULT NULL,
  `hut_mst_ket` varchar(2000) DEFAULT NULL,
  `hut_mst_dok` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`hutprm`),
  UNIQUE KEY `hut_mst_dt_hut_mst_nobuk` (`hut_mst_dt`,`hut_mst_nobuk`),
  UNIQUE KEY `hut_mst_nobuk` (`hut_mst_nobuk`),
  KEY `hut_mst_dt_hut_mst_tgl` (`hut_mst_dt`,`hut_mst_tgl`),
  KEY `hut_mst_sts` (`hut_mst_sts`),
  KEY `hut_mst_dt_hut_mst_noref` (`hut_mst_dt`,`hut_mst_noref`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.hutang_master: ~9 rows (approximately)
/*!40000 ALTER TABLE `hutang_master` DISABLE KEYS */;
INSERT INTO `hutang_master` (`hutprm`, `hut_mst_lock`, `hut_mst_dt`, `hut_mst_nobuk`, `hut_mst_noref`, `hut_mst_sts`, `hut_mst_tgl`, `hut_mst_tglrnc`, `hut_mst_pst`, `hut_mst_kel`, `hut_mst_rek`, `hut_mst_rnc`, `hut_mst_ttl`, `hut_mst_ket`, `hut_mst_dok`) VALUES
	(17, 0, 'AGR', 'AGR-20210515-39997', NULL, 'TOLAK', '2021-05-15', '2021-05-15', 'GSU', 'F-01', '2121-01', 250000, 0, 'COBA PROGRAM1', 'AGR-20210515-39997.docx'),
	(19, 0, 'AGR', 'AGR-20210515-02595', NULL, 'CAIR', '2021-05-15', '2021-05-23', 'GSU', 'F-01', '2121-02', 50000, 50000, 'COBAIN ISI 2', 'AGR-20210515-02595.docx'),
	(20, 0, 'AGR', 'AGR-20210515-07313', NULL, 'TOLAK', '2021-05-15', '2021-05-15', 'GSU', 'F-01', '2122-01', 25000, 0, 'RUTIN1', 'AGR-20210515-07313.jpg'),
	(21, 0, 'AGR', 'AGR-20210515-62507', NULL, 'TOLAK', '2021-05-15', '2021-05-15', 'GSU', 'F-01', '2122-11', 50100, 0, 'RUTIN2', 'AGR-20210515-62507.jpg'),
	(22, 0, 'AGR', 'AGR-20210515-22533', 'UJICOBA1', 'CAIR', '2021-05-15', '2021-05-31', 'GSU', 'F-01', '2123-01', 2500000, 2500000, 'GAJI KARYAWAN', ''),
	(23, 0, 'AGR', 'AGR-20210515-17188', 'UJICOBA1', 'CAIR', '2021-05-15', '2021-06-30', 'GSU', 'F-01', '2123-01', 2500000, 2500000, 'GAJI KARYAWAN', ''),
	(24, 0, 'AGR', 'AGR-20210515-20456', 'UJICOBA2', 'CAIR', '2021-05-15', '2021-05-31', 'GSU', 'F-01', '2123-01', 950000, 950000, 'GAJI KARYAWAN', ''),
	(25, 0, 'AGR', 'AGR-20210515-30115', 'GSU', 'CAIR', '2021-05-15', '2021-05-31', 'GSU', 'F-01', '2123-01', 2250000, 2250000, 'GAJI KARYAWAN', ''),
	(27, 0, 'AGR', 'AGR-20210518-21838', 'HANDPHONE XIAOMI', 'CAIR', '2021-05-18', '2021-05-23', 'GSU', 'F-01', '2124-03', 750000, 650000, 'BETULKAN HP', 'AGR-20210518-21838.jpg');
/*!40000 ALTER TABLE `hutang_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.info_level_1
CREATE TABLE IF NOT EXISTS `info_level_1` (
  `infoprm` int(11) NOT NULL AUTO_INCREMENT,
  `in_lv_1_dt` varchar(20) DEFAULT NULL,
  `in_lv_1_kd` varchar(20) DEFAULT NULL,
  `in_lv_1_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`infoprm`) USING BTREE,
  UNIQUE KEY `in_lv_1_dt_in_lv_1_kd` (`in_lv_1_dt`,`in_lv_1_kd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.info_level_1: ~32 rows (approximately)
/*!40000 ALTER TABLE `info_level_1` DISABLE KEYS */;
INSERT INTO `info_level_1` (`infoprm`, `in_lv_1_dt`, `in_lv_1_kd`, `in_lv_1_ket`) VALUES
	(8, 'STATUS', 'AKTIF', 'AKTIF'),
	(9, 'STATUS', 'PASIF', 'PASIF'),
	(13, 'REKENING', 'ANGGARAN', 'ANGGARAN'),
	(14, 'REKENING', 'NERACA', 'NERACA'),
	(15, 'AP', 'AKTIVA', 'AKTIVA'),
	(16, 'AP', 'PASIVA', 'PASIVA'),
	(17, 'PENDIDIKAN', 'SD', 'SD'),
	(18, 'PENDIDIKAN', 'SMU', 'SMU'),
	(19, 'PENDIDIKAN', 'D3', 'D3'),
	(20, 'PENDIDIKAN', 'S1', 'S1'),
	(21, 'PENDIDIKAN', 'D1', 'D1'),
	(22, 'STSKRY', 'TETAP', 'KARYAWAN TETAP'),
	(23, 'STSKRY', 'TDK-SJK-15', 'TIDAK TETAP SEJAK 2015'),
	(24, 'STSKRY', 'RELAWAN', 'RELAWAN PRO-DEO'),
	(25, 'TUNJTTP', 'PASANGAN', 'ISTRI-SUAMI'),
	(26, 'TUNJTTP', 'ANAK', 'ANAK'),
	(27, 'TUNJTTP', 'PENDIDIKAN', 'PENDIDIKAN'),
	(28, 'TUNJTTP', 'MASA', 'MASA KERJA'),
	(29, 'TUNJTTP', 'BEBAN', 'BEBAN KERJA'),
	(30, 'TUNJTTP', 'BERAS', 'BERAS'),
	(31, 'TUNJTTTP', 'HADIR', 'KEHADIRAN'),
	(32, 'TUNJTTTP', 'PRESTASI', 'PRESTASI'),
	(35, 'PENDIDIKAN', 'SMP', 'SMP'),
	(36, 'STSNKH', 'TK/0', 'TK/0'),
	(37, 'STSNKH', 'KW/0', 'KW/0'),
	(38, 'STSNKH', 'KW/1', 'KW/1'),
	(39, 'STSNKH', 'KW/2', 'KW/2'),
	(40, 'STSNKH', 'KW/3', 'KW/3'),
	(48, 'STSKRY', 'TDK-SBL-15', 'TIDAK TETAP SEBELUM 2015'),
	(54, 'PENDIDIKAN', 'SMK', 'SMK'),
	(55, 'PENDIDIKAN', 'STM', 'STM'),
	(56, 'STSKRY', 'CALON', 'CALON KARYAWAN TETAP');
/*!40000 ALTER TABLE `info_level_1` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.info_level_2
CREATE TABLE IF NOT EXISTS `info_level_2` (
  `infoprm` int(11) NOT NULL AUTO_INCREMENT,
  `in_lv_1_dt` varchar(20) DEFAULT NULL,
  `in_lv_1_kd` varchar(20) DEFAULT NULL,
  `in_lv_2_kd` varchar(20) DEFAULT NULL,
  `in_lv_2_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`infoprm`) USING BTREE,
  UNIQUE KEY `in_lv_1_dt_in_lv_1_kd_in_lv_2_kd` (`in_lv_1_dt`,`in_lv_1_kd`,`in_lv_2_kd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.info_level_2: ~7 rows (approximately)
/*!40000 ALTER TABLE `info_level_2` DISABLE KEYS */;
INSERT INTO `info_level_2` (`infoprm`, `in_lv_1_dt`, `in_lv_1_kd`, `in_lv_2_kd`, `in_lv_2_ket`) VALUES
	(1, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'ABTS-NP'),
	(2, 'REKENING', 'ANGGARAN', 'ABTS-P', 'ABTS-P'),
	(3, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'ABTS-UKSP'),
	(4, 'REKENING', 'ANGGARAN', 'ABTT', 'ABTT'),
	(5, 'REKENING', 'NERACA', 'ASET', 'ASET'),
	(6, 'REKENING', 'NERACA', 'ASET BERSIH', 'ASET BERSIH'),
	(7, 'REKENING', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN');
/*!40000 ALTER TABLE `info_level_2` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.info_level_3
CREATE TABLE IF NOT EXISTS `info_level_3` (
  `infoprm` int(11) NOT NULL AUTO_INCREMENT,
  `in_lv_1_dt` varchar(20) DEFAULT NULL,
  `in_lv_1_kd` varchar(20) DEFAULT NULL,
  `in_lv_2_kd` varchar(20) DEFAULT NULL,
  `in_lv_3_kd` varchar(20) DEFAULT NULL,
  `in_lv_3_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`infoprm`) USING BTREE,
  UNIQUE KEY `in_lv_1_dt_in_lv_1_kd_in_lv_2_kd_in_lv_3_kd` (`in_lv_1_dt`,`in_lv_1_kd`,`in_lv_2_kd`,`in_lv_3_kd`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.info_level_3: ~15 rows (approximately)
/*!40000 ALTER TABLE `info_level_3` DISABLE KEYS */;
INSERT INTO `info_level_3` (`infoprm`, `in_lv_1_dt`, `in_lv_1_kd`, `in_lv_2_kd`, `in_lv_3_kd`, `in_lv_3_ket`) VALUES
	(1, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'BIAYA'),
	(2, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'PENDAPATAN'),
	(3, 'REKENING', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'BIAYA'),
	(4, 'REKENING', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'PENDAPATAN'),
	(5, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'BIAYA', 'BIAYA'),
	(6, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'PENDAPATAN', 'PENDAPATAN'),
	(7, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'BIAYA'),
	(8, 'REKENING', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'PENDAPATAN'),
	(9, 'REKENING', 'NERACA', 'ASET', 'ASETLAIN', 'ASETLAIN'),
	(10, 'REKENING', 'NERACA', 'ASET', 'ASETLANCAR', 'ASETLANCAR'),
	(11, 'REKENING', 'NERACA', 'ASET', 'ASETTETAP', 'ASETTETAP'),
	(12, 'REKENING', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'TERIKATSEMENTARA'),
	(13, 'REKENING', 'NERACA', 'ASET BERSIH', 'TIDAKTERIKAT', 'TIDAKTERIKAT'),
	(14, 'REKENING', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'KEWAJIBAN'),
	(16, 'REKENING', 'ANGGARAN', 'ABTS-TT', 'KARYAWAN', 'KARYAWAN'),
	(17, 'REKENING', 'ANGGARAN', 'ABTS-TT', 'INVENTARIS', 'INVENTARIS');
/*!40000 ALTER TABLE `info_level_3` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.info_level_4
CREATE TABLE IF NOT EXISTS `info_level_4` (
  `infoprm` int(11) NOT NULL AUTO_INCREMENT,
  `in_lv_1_dt` varchar(20) DEFAULT NULL,
  `in_lv_1_kd` varchar(20) DEFAULT NULL,
  `in_lv_2_kd` varchar(20) DEFAULT NULL,
  `in_lv_3_kd` varchar(20) DEFAULT NULL,
  `in_lv_4_kd` varchar(20) DEFAULT NULL,
  `in_lv_4_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`infoprm`),
  UNIQUE KEY `in_lv_1_dt_in_lv_1_kd_in_lv_2_kd_in_lv_3_kd_in_lv_4_kd` (`in_lv_1_dt`,`in_lv_1_kd`,`in_lv_2_kd`,`in_lv_3_kd`,`in_lv_4_kd`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.info_level_4: ~35 rows (approximately)
/*!40000 ALTER TABLE `info_level_4` DISABLE KEYS */;
INSERT INTO `info_level_4` (`infoprm`, `in_lv_1_dt`, `in_lv_1_kd`, `in_lv_2_kd`, `in_lv_3_kd`, `in_lv_4_kd`, `in_lv_4_ket`) VALUES
	(1, 'REKENING', 'NERACA', 'ASET', 'ASETLANCAR', 'SETARAKAS', 'SETARAKAS\r'),
	(2, 'REKENING', 'NERACA', 'ASET', 'ASETLANCAR', 'PIUTANG', 'PIUTANG\r'),
	(3, 'REKENING', 'NERACA', 'ASET', 'ASETLANCAR', 'PERSEDIAAN', 'PERSEDIAAN\r'),
	(4, 'REKENING', 'NERACA', 'ASET', 'ASETLANCAR', 'PERLENGKAPAN', 'PERLENGKAPAN\r'),
	(5, 'REKENING', 'NERACA', 'ASET', 'ASETTETAP', 'BERGERAK', 'BERGERAK\r'),
	(6, 'REKENING', 'NERACA', 'ASET', 'ASETTETAP', 'TIDAKBERGERAK', 'TIDAKBERGERAK\r'),
	(7, 'REKENING', 'NERACA', 'ASET', 'ASETLAIN', 'LAIN', 'LAIN\r'),
	(8, 'REKENING', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPANJANG', 'JANGKAPANJANG\r'),
	(9, 'REKENING', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPENDEK', 'JANGKAPENDEK\r'),
	(10, 'REKENING', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'KHUSUS', 'KHUSUS\r'),
	(11, 'REKENING', 'NERACA', 'ASET BERSIH', 'TIDAKTERIKAT', 'TIDAKTERIKAT', 'TIDAKTERIKAT\r'),
	(12, 'REKENING', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'NONPEMBANGUNAN', 'NONPEMBANGUNAN\r'),
	(13, 'REKENING', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'PEMBANGUNAN', 'PEMBANGUNAN\r'),
	(14, 'REKENING', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'UKSP', 'UKSP\r'),
	(15, 'REKENING', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'KOLEKTE', 'KOLEKTE\r'),
	(16, 'REKENING', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'BANTUAN', 'BANTUAN\r'),
	(17, 'REKENING', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'UMUM', 'UMUM\r'),
	(18, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'PROGRAM', 'PROGRAM\r'),
	(19, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', 'RUTIN\r'),
	(20, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'UMUM', 'UMUM\r'),
	(21, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'KOLEKTE', 'KOLEKTE\r'),
	(22, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'BANTUAN', 'BANTUAN\r'),
	(23, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', 'UMUM\r'),
	(24, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'RUTIN', 'RUTIN\r'),
	(25, 'REKENING', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', 'UMUM\r'),
	(26, 'REKENING', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'KOLEKTE', 'KOLEKTE\r'),
	(27, 'REKENING', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'BANTUAN', 'BANTUAN\r'),
	(28, 'REKENING', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'UMUM', 'UMUM\r'),
	(29, 'REKENING', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'RUTIN', 'RUTIN\r'),
	(30, 'REKENING', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'UMUM', 'UMUM\r'),
	(31, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'PENDAPATAN', 'KOLEKTE', 'KOLEKTE\r'),
	(32, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'PENDAPATAN', 'BANTUAN', 'BANTUAN\r'),
	(33, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'PENDAPATAN', 'UMUM', 'UMUM\r'),
	(34, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'BIAYA', 'RUTIN', 'RUTIN\r'),
	(35, 'REKENING', 'ANGGARAN', 'ABTS-UKSP', 'BIAYA', 'UMUM', 'UMUM\r'),
	(36, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'KARYAWAN', 'KARYAWAN'),
	(37, 'REKENING', 'NERACA', 'ASET', 'ASETTETAP', 'PERALATAN', 'PERALATAN'),
	(38, 'REKENING', 'ANGGARAN', 'ABTT', 'BIAYA', 'INVENTARIS', 'INVENTARIS');
/*!40000 ALTER TABLE `info_level_4` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.inventaris_master
CREATE TABLE IF NOT EXISTS `inventaris_master` (
  `invprm` int(11) NOT NULL AUTO_INCREMENT,
  `inv_mst_lock` int(11) DEFAULT NULL,
  `inv_mst_sts` varchar(20) DEFAULT NULL,
  `inv_mst_dt` varchar(20) DEFAULT NULL,
  `inv_mst_kode` varchar(20) DEFAULT NULL,
  `inv_mst_tipe` varchar(20) DEFAULT NULL,
  `inv_mst_barang` varchar(2000) DEFAULT NULL,
  `inv_mst_ket` varchar(2000) DEFAULT NULL,
  `inv_mst_pemilik` varchar(2000) DEFAULT NULL,
  `inv_mst_nm` varchar(2000) DEFAULT NULL,
  `inv_mst_tgl` date DEFAULT NULL,
  `inv_mst_tgl_beli` date DEFAULT NULL,
  `inv_mst_rek` varchar(20) DEFAULT NULL,
  `inv_mst_rek_sst` varchar(20) DEFAULT NULL,
  `inv_mst_rek_rawat` varchar(20) DEFAULT NULL,
  `inv_mst_jthtmp1` date DEFAULT NULL,
  `inv_mst_jthtmp2` date DEFAULT NULL,
  `inv_mst_masa` int(11) DEFAULT NULL,
  `inv_mst_awal` double DEFAULT NULL,
  `inv_mst_tambah` double DEFAULT NULL,
  `inv_mst_kurang` double DEFAULT NULL,
  `inv_mst_akhir` double DEFAULT NULL,
  PRIMARY KEY (`invprm`) USING BTREE,
  UNIQUE KEY `inv_mst_dt_inv_mst_kode` (`inv_mst_dt`,`inv_mst_kode`),
  UNIQUE KEY `inv_mst_kode_pst_mst_sts` (`inv_mst_sts`,`inv_mst_kode`) USING BTREE,
  UNIQUE KEY `inv_mst_kode` (`inv_mst_kode`) USING BTREE,
  KEY `inv_mst_tipe` (`inv_mst_tipe`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.inventaris_master: ~3 rows (approximately)
/*!40000 ALTER TABLE `inventaris_master` DISABLE KEYS */;
INSERT INTO `inventaris_master` (`invprm`, `inv_mst_lock`, `inv_mst_sts`, `inv_mst_dt`, `inv_mst_kode`, `inv_mst_tipe`, `inv_mst_barang`, `inv_mst_ket`, `inv_mst_pemilik`, `inv_mst_nm`, `inv_mst_tgl`, `inv_mst_tgl_beli`, `inv_mst_rek`, `inv_mst_rek_sst`, `inv_mst_rek_rawat`, `inv_mst_jthtmp1`, `inv_mst_jthtmp2`, `inv_mst_masa`, `inv_mst_awal`, `inv_mst_tambah`, `inv_mst_kurang`, `inv_mst_akhir`) VALUES
	(29, 0, 'AKTIF', 'INV', 'H5569WR', 'RODA2', 'VARIO 125 CBS FI', 'H5569WR', 'PAROKI', 'ANASTASIA YULI P', '2021-05-18', '2021-05-07', '1122-01', '1122-02', '2124-01', '2021-05-07', '2021-05-07', 48, 24000000, 0, 0, 24000000),
	(30, 0, 'AKTIF', 'INV', 'H3357ABC', 'RODA4', 'TOYOTA YARIS', 'H3357ABC', 'PAROKI', 'SATRIO UTOMO', '2021-05-18', '2021-05-07', '1122-01', '1122-02', '2124-01', '2022-06-01', '2022-06-01', 96, 210000000, 0, 0, 210000000),
	(32, 0, 'AKTIF', 'INV', '12345678910', 'TANAHBANGUNAN', 'SERT.A01B02', 'KANFER RAYA BANYUMANIK SEMARANG', 'PAROKI', 'GUWE', '2021-05-18', '2021-05-18', '1121-02', '1121-03', '2124-02', '2021-05-13', '9999-12-31', 240, 500000000, 0, 0, 500000000),
	(33, 0, 'AKTIF', 'INV', 'HANDPHONE XIAOMI', 'PERALATAN', 'XIAOMI REDMI 8 NOTE', 'HANDPHONE', 'PAROKI', 'SATRIO ', '2021-05-18', '2021-05-18', '1123-02', '1123-01', '2124-03', '9999-12-31', '9999-12-31', 48, 2250000, 0, 0, 2250000);
/*!40000 ALTER TABLE `inventaris_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.jurnal_master
CREATE TABLE IF NOT EXISTS `jurnal_master` (
  `jrnprm` int(11) NOT NULL AUTO_INCREMENT,
  `jrn_mst_lock` int(11) DEFAULT NULL,
  `jrn_mst_dt` varchar(20) DEFAULT NULL,
  `jrn_mst_nobuk` varchar(20) DEFAULT NULL,
  `jrn_mst_noref` varchar(20) DEFAULT NULL,
  `jrn_mst_pst` varchar(20) DEFAULT NULL,
  `jrn_mst_tgl` date DEFAULT NULL,
  `jrn_mst_rek` varchar(20) DEFAULT NULL,
  `jrn_mst_dk` varchar(20) DEFAULT NULL,
  `jrn_mst_ttl` double DEFAULT NULL,
  `jrn_mst_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`jrnprm`) USING BTREE,
  KEY `jrn_mst_dt_kas_mst_nobuk` (`jrn_mst_dt`,`jrn_mst_nobuk`) USING BTREE,
  KEY `jrn_mst_nobuk` (`jrn_mst_nobuk`) USING BTREE,
  KEY `jrn_mst_dt_kas_mst_tgl` (`jrn_mst_dt`,`jrn_mst_tgl`) USING BTREE,
  KEY `jrn_mst_noref` (`jrn_mst_noref`) USING BTREE,
  KEY `jrn_mst_rek` (`jrn_mst_rek`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.jurnal_master: ~12 rows (approximately)
/*!40000 ALTER TABLE `jurnal_master` DISABLE KEYS */;
INSERT INTO `jurnal_master` (`jrnprm`, `jrn_mst_lock`, `jrn_mst_dt`, `jrn_mst_nobuk`, `jrn_mst_noref`, `jrn_mst_pst`, `jrn_mst_tgl`, `jrn_mst_rek`, `jrn_mst_dk`, `jrn_mst_ttl`, `jrn_mst_ket`) VALUES
	(1, 0, 'KK', 'KK-20210515-18978', 'AGR-20210515-02595', 'GSU', '2021-05-15', '2121-02', 'D', 49000, 'DITERIMA OLEH SATRIO/ 3374111206850007'),
	(2, 0, 'KK', 'KK-20210515-18978', 'AGR-20210515-02595', 'GSU', '2021-05-15', '1111-01', 'K', 49000, 'DITERIMA OLEH SATRIO/ 3374111206850007'),
	(3, 0, 'KK', 'KK-20210515-83400', 'AGR-20210515-02595', 'GSU', '2021-05-15', '2121-02', 'D', 1000, 'SISA NYA '),
	(4, 0, 'KK', 'KK-20210515-83400', 'AGR-20210515-02595', 'GSU', '2021-05-15', '1111-01', 'K', 1000, 'SISA NYA '),
	(5, 0, 'KK', 'KK-20210515-84040', 'AGR-20210515-22533', 'GSU', '2021-05-15', '2123-01', 'D', 2500000, 'GAJI'),
	(6, 0, 'KK', 'KK-20210515-84040', 'AGR-20210515-22533', 'GSU', '2021-05-15', '1111-02', 'K', 2500000, 'GAJI'),
	(7, 0, 'KK', 'KK-20210515-76498', 'AGR-20210515-17188', 'GSU', '2021-05-15', '2123-01', 'D', 2500000, 'COBAIN'),
	(8, 0, 'KK', 'KK-20210515-76498', 'AGR-20210515-17188', 'GSU', '2021-05-15', '1111-01', 'K', 2500000, 'COBAIN'),
	(9, 0, 'KK', 'KK-20210515-24561', 'AGR-20210515-20456', 'GSU', '2021-05-15', '2123-01', 'D', 950000, 'TRANSFER KE BCA08912123'),
	(10, 0, 'KK', 'KK-20210515-24561', 'AGR-20210515-20456', 'GSU', '2021-05-15', '1111-02', 'K', 950000, 'TRANSFER KE BCA08912123'),
	(11, 0, 'KK', 'KK-20210515-46591', 'AGR-20210515-30115', 'GSU', '2021-05-15', '2123-01', 'D', 2250000, 'AMBIL TUNAI OLEH YBS'),
	(12, 0, 'KK', 'KK-20210515-46591', 'AGR-20210515-30115', 'GSU', '2021-05-15', '1111-01', 'K', 2250000, 'AMBIL TUNAI OLEH YBS'),
	(13, 0, 'KK', 'KK-20210518-65872', 'AGR-20210518-21838', 'GSU', '2021-05-18', '2124-03', 'D', 650000, 'DITERIMA OLEH SATRIO'),
	(14, 0, 'KK', 'KK-20210518-65872', 'AGR-20210518-21838', 'GSU', '2021-05-18', '1111-01', 'K', 650000, 'DITERIMA OLEH SATRIO');
/*!40000 ALTER TABLE `jurnal_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.karyawan_master
CREATE TABLE IF NOT EXISTS `karyawan_master` (
  `kryprm` int(11) NOT NULL AUTO_INCREMENT,
  `kry_mst_lock` int(11) DEFAULT NULL,
  `kry_mst_sts` varchar(20) DEFAULT NULL,
  `kry_mst_kode` varchar(20) DEFAULT NULL,
  `kry_mst_ic` varchar(20) DEFAULT NULL,
  `kry_mst_alamat` varchar(2000) DEFAULT NULL,
  `kry_mst_tgllhr` date DEFAULT NULL,
  `kry_mst_tglkry` date DEFAULT NULL,
  `kry_mst_pddk` varchar(20) DEFAULT NULL,
  `kry_mst_stsanak` varchar(20) DEFAULT NULL,
  `kry_mst_gol` varchar(20) DEFAULT NULL,
  `kry_mst_rek` varchar(20) DEFAULT NULL,
  `kry_mst_upah_pokok` double DEFAULT NULL,
  `kry_mst_tunj_ttp` double DEFAULT NULL,
  `kry_mst_tunj_t_ttp` double DEFAULT NULL,
  PRIMARY KEY (`kryprm`) USING BTREE,
  UNIQUE KEY `pst_mst_kode_pst_mst_sts` (`kry_mst_sts`,`kry_mst_kode`) USING BTREE,
  UNIQUE KEY `pst_mst_kode` (`kry_mst_kode`) USING BTREE,
  UNIQUE KEY `kry_mst_ic` (`kry_mst_ic`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- Dumping data for table gsmf-monev.karyawan_master: ~3 rows (approximately)
/*!40000 ALTER TABLE `karyawan_master` DISABLE KEYS */;
INSERT INTO `karyawan_master` (`kryprm`, `kry_mst_lock`, `kry_mst_sts`, `kry_mst_kode`, `kry_mst_ic`, `kry_mst_alamat`, `kry_mst_tgllhr`, `kry_mst_tglkry`, `kry_mst_pddk`, `kry_mst_stsanak`, `kry_mst_gol`, `kry_mst_rek`, `kry_mst_upah_pokok`, `kry_mst_tunj_ttp`, `kry_mst_tunj_t_ttp`) VALUES
	(28, 0, 'AKTIF', 'UJICOBA1', '12345678910111206', 'JALAN MERBAU SELATAN DALAM 1 NO 210 SEMARANG BANYUMANIK 50267', '1985-06-12', '2015-01-01', 'S1', 'KW/2', 'TETAP', '2123-01', 1250000, 750000, 500000),
	(29, 0, 'AKTIF', 'UJICOBA2', '32132132132123123123', 'JALANALAMAT', '2021-05-15', '2021-05-15', 'S1', 'KW/0', 'CALON', '2123-01', 750000, 150000, 50000),
	(30, 0, 'AKTIF', 'GSU', '3374111206850007', 'MERBAU SELATAN DALAM 1/210 BANYUMANIK SEMARANG 50267', '1985-06-12', '2015-01-01', 'S1', 'KW/2', 'TETAP', '2123-01', 1500000, 500000, 250000);
/*!40000 ALTER TABLE `karyawan_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.kas_master
CREATE TABLE IF NOT EXISTS `kas_master` (
  `kasprm` int(11) NOT NULL AUTO_INCREMENT,
  `kas_mst_lock` int(11) DEFAULT NULL,
  `kas_mst_dt` varchar(20) DEFAULT NULL,
  `kas_mst_nobuk` varchar(20) DEFAULT NULL,
  `kas_mst_sts` varchar(20) DEFAULT NULL,
  `kas_mst_tgl` date DEFAULT NULL,
  `kas_mst_pst` varchar(20) DEFAULT NULL,
  `kas_mst_noref` varchar(20) DEFAULT NULL,
  `kas_mst_rek` varchar(20) DEFAULT NULL,
  `kas_mst_ttl` double DEFAULT NULL,
  `kas_mst_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`kasprm`),
  UNIQUE KEY `kas_mst_dt_kas_mst_nobuk` (`kas_mst_dt`,`kas_mst_nobuk`),
  UNIQUE KEY `kas_mst_nobuk` (`kas_mst_nobuk`),
  KEY `kas_mst_dt_kas_mst_tgl` (`kas_mst_dt`,`kas_mst_tgl`),
  KEY `kas_mst_noref` (`kas_mst_noref`),
  KEY `kas_mst_rek` (`kas_mst_rek`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.kas_master: ~6 rows (approximately)
/*!40000 ALTER TABLE `kas_master` DISABLE KEYS */;
INSERT INTO `kas_master` (`kasprm`, `kas_mst_lock`, `kas_mst_dt`, `kas_mst_nobuk`, `kas_mst_sts`, `kas_mst_tgl`, `kas_mst_pst`, `kas_mst_noref`, `kas_mst_rek`, `kas_mst_ttl`, `kas_mst_ket`) VALUES
	(1, 0, 'KK', 'KK-20210515-18978', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-02595', '1111-01', -49000, 'DITERIMA OLEH SATRIO/ 3374111206850007'),
	(2, 0, 'KK', 'KK-20210515-83400', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-02595', '1111-01', -1000, 'SISA NYA '),
	(3, 0, 'KK', 'KK-20210515-84040', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-22533', '1111-02', -2500000, 'GAJI'),
	(4, 0, 'KK', 'KK-20210515-76498', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-17188', '1111-01', -2500000, 'COBAIN'),
	(5, 0, 'KK', 'KK-20210515-24561', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-20456', '1111-02', -950000, 'TRANSFER KE BCA08912123'),
	(6, 0, 'KK', 'KK-20210515-46591', 'CAIR', '2021-05-15', 'GSU', 'AGR-20210515-30115', '1111-01', -2250000, 'AMBIL TUNAI OLEH YBS'),
	(7, 0, 'KK', 'KK-20210518-65872', 'CAIR', '2021-05-18', 'GSU', 'AGR-20210518-21838', '1111-01', -650000, 'DITERIMA OLEH SATRIO');
/*!40000 ALTER TABLE `kas_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.kelompok_master
CREATE TABLE IF NOT EXISTS `kelompok_master` (
  `kelprm` int(11) NOT NULL AUTO_INCREMENT,
  `kel_mst_sts` varchar(20) DEFAULT NULL,
  `kel_mst_kode` varchar(20) DEFAULT NULL,
  `kel_mst_subkode` varchar(20) DEFAULT NULL,
  `kel_mst_ket` varchar(2000) DEFAULT NULL,
  `kel_mst_subket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`kelprm`),
  UNIQUE KEY `kel_mst_kode_kel_mst_subkode_kel_mst_sts` (`kel_mst_sts`,`kel_mst_kode`,`kel_mst_subkode`),
  UNIQUE KEY `kel_mst_subkode` (`kel_mst_subkode`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.kelompok_master: ~66 rows (approximately)
/*!40000 ALTER TABLE `kelompok_master` DISABLE KEYS */;
INSERT INTO `kelompok_master` (`kelprm`, `kel_mst_sts`, `kel_mst_kode`, `kel_mst_subkode`, `kel_mst_ket`, `kel_mst_subket`) VALUES
	(68, 'AKTIF', 'A', 'A-01', 'BIDANG LITURGI DAN PERIBADATAN', 'BIDANG LITURGI DAN PERIBADATAN'),
	(69, 'AKTIF', 'A', 'A-02', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN TATA PERAYAAN DAN PERIBADATAN'),
	(70, 'AKTIF', 'A', 'A-03', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PRODIAKON'),
	(71, 'AKTIF', 'A', 'A-04', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PUTRA-PUTRI ALTAR'),
	(72, 'AKTIF', 'A', 'A-05', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PADUAN SUARA'),
	(73, 'AKTIF', 'A', 'A-06', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN LEKTOR'),
	(74, 'AKTIF', 'A', 'A-07', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PEMAZMUR'),
	(75, 'AKTIF', 'A', 'A-08', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PEMUSIK'),
	(76, 'AKTIF', 'A', 'A-09', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN DIRIGEN'),
	(77, 'AKTIF', 'A', 'A-10', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN PARAMENTA'),
	(78, 'AKTIF', 'A', 'A-11', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN TATA ALTAR'),
	(79, 'AKTIF', 'A', 'A-12', 'BIDANG LITURGI DAN PERIBADATAN', 'TIM PELAYANAN LITURGI DAN PERIBADATAN LAIN-LAIN'),
	(80, 'AKTIF', 'B', 'B-01', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'BIDANG PEWARTAAN DAN EVANGELISASI'),
	(81, 'AKTIF', 'B', 'B-02', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN EVANGELISASI'),
	(82, 'AKTIF', 'B', 'B-03', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN SAKRAMEN INISIASI'),
	(83, 'AKTIF', 'B', 'B-04', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN KATEKIS'),
	(84, 'AKTIF', 'B', 'B-05', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN KERASULAN KITAB SUCI'),
	(85, 'AKTIF', 'B', 'B-06', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN USIA DINI'),
	(86, 'AKTIF', 'B', 'B-07', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN ANAK'),
	(87, 'AKTIF', 'B', 'B-08', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN REMAJA'),
	(88, 'AKTIF', 'B', 'B-09', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN ORANG MUDA'),
	(89, 'AKTIF', 'B', 'B-10', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN ORANG DEWASA'),
	(90, 'AKTIF', 'B', 'B-11', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PENDAMPINGAN IMAN USIA LANJUT'),
	(91, 'AKTIF', 'B', 'B-12', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PROMOSI PANGGILAN'),
	(92, 'AKTIF', 'B', 'B-13', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN KOMUNIKASI SOSIAL'),
	(93, 'AKTIF', 'B', 'B-14', 'BIDANG PEWARTAAN DAN EVANGELISASI', 'TIM PELAYANAN PEWARTAAN DAN EVANGELISASI LAIN-LAIN'),
	(94, 'AKTIF', 'C', 'C-01', 'BIDANG PELAYANAN KEMASYARAKATAN', 'BIDANG PELAYANAN KEMASYARAKATAN'),
	(95, 'AKTIF', 'C', 'C-02', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN PENGEMBANGAN SOSIAL EKONOMI'),
	(96, 'AKTIF', 'C', 'C-03', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN KESEHATAN'),
	(97, 'AKTIF', 'C', 'C-04', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN PENDIDIKAN'),
	(98, 'AKTIF', 'C', 'C-05', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN PANGRUKTILAYA'),
	(99, 'AKTIF', 'C', 'C-06', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN BERKAT SANTO YUSUF'),
	(100, 'AKTIF', 'C', 'C-07', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN HUBUNGAN ANTAR AGAMA DAN KEPERCAYAAN'),
	(101, 'AKTIF', 'C', 'C-08', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN KARYA KERASULAN KEMASYARAKATAN'),
	(102, 'AKTIF', 'C', 'C-09', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN KEUTUHAN CIPTAAN DAN LINGKUNGAN HIDUP'),
	(103, 'AKTIF', 'C', 'C-10', 'BIDANG PELAYANAN KEMASYARAKATAN', 'TIM PELAYANAN KEMASYARAKATAN LAIN-LAIN'),
	(104, 'AKTIF', 'D', 'D-01', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN'),
	(105, 'AKTIF', 'D', 'D-02', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'TIM PELAYANAN IBU-IBU PAROKI'),
	(106, 'AKTIF', 'D', 'D-03', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'TIM PELAYANAN PASTORAL KELUARGA PAROKI'),
	(107, 'AKTIF', 'D', 'D-04', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'TIM PELAYANAN KESENIAN'),
	(108, 'AKTIF', 'D', 'D-05', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'TIM PELAYANAN PERPUSTAKAAN'),
	(109, 'AKTIF', 'D', 'D-06', 'BIDANG PAGUYUBAN DAN PERSAUDARAAN', 'TIM PELAYANAN PAGUYUBAN DAN PERSAUDARAAN LAIN-LAIN'),
	(110, 'AKTIF', 'E', 'E-01', 'BIDANG RUMAH TANGGA', 'BIDANG RUMAH TANGGA'),
	(111, 'AKTIF', 'E', 'E-02', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN RUMAH TANGGA PAROKI'),
	(112, 'AKTIF', 'E', 'E-03', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN RUMAH TANGGA PASTORAN'),
	(113, 'AKTIF', 'E', 'E-04', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN KEAMANAN DAN PARKIR'),
	(114, 'AKTIF', 'E', 'E-05', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN LISTRIK DAN AUDIO VISUAL'),
	(115, 'AKTIF', 'E', 'E-06', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN PEMELIHARAAN DAN INVENTARIS'),
	(116, 'AKTIF', 'E', 'E-07', 'BIDANG RUMAH TANGGA', 'TIM PELAYANAN RUMAH TANGGA LAIN-LAIN'),
	(117, 'AKTIF', 'F', 'F-01', 'BIDANG PENELITIAN DAN PENGEMBANGAN', 'BIDANG PENELITIAN DAN PENGEMBANGAN'),
	(118, 'AKTIF', 'F', 'F-02', 'BIDANG PENELITIAN DAN PENGEMBANGAN', 'TIM PELAYANAN PENDATAAN'),
	(119, 'AKTIF', 'F', 'F-03', 'BIDANG PENELITIAN DAN PENGEMBANGAN', 'TIM PELAYANAN PENGEMBANGAN SDM'),
	(120, 'AKTIF', 'F', 'F-04', 'BIDANG PENELITIAN DAN PENGEMBANGAN', 'TIM PELAYANAN PROGRAMASI DAN MONEV'),
	(121, 'AKTIF', 'F', 'F-05', 'BIDANG PENELITIAN DAN PENGEMBANGAN', 'TIM PELAYANAN PENELITIAN DAN PENGEMBANGAN LAIN-LAIN'),
	(122, 'AKTIF', 'G', 'G-01', 'KEPANITIAAN', 'PANITIA PASKAH'),
	(123, 'AKTIF', 'G', 'G-02', 'KEPANITIAAN', 'PANITIA NATAL'),
	(124, 'AKTIF', 'G', 'G-03', 'KEPANITIAAN', 'PANITIA HUT PAROKI'),
	(125, 'AKTIF', 'G', 'G-04', 'KEPANITIAAN', 'PANITIA MISA DAN KEGIATAN IMLEK'),
	(126, 'AKTIF', 'G', 'G-05', 'KEPANITIAAN', 'PANITIA MISA DAN KEGIATAN MALAM 1 SURO'),
	(127, 'AKTIF', 'G', 'G-06', 'KEPANITIAAN', 'PANITIA MISA DAN KEGIATAN TAHUN BARU'),
	(128, 'AKTIF', 'G', 'G-07', 'KEPANITIAAN', 'PANITIA MISA DAN KEGIATAN NOVENA-DEVOSI'),
	(129, 'AKTIF', 'G', 'G-08', 'KEPANITIAAN', 'PANITIA HARI PANGAN SEDUNIA'),
	(130, 'AKTIF', 'G', 'G-09', 'KEPANITIAAN', 'PEMBEKALAN PENGURUS DEWAN PASTORAL PAROKI'),
	(131, 'AKTIF', 'G', 'G-10', 'KEPANITIAAN', 'PANITIA SAKRAMEN INISIASI'),
	(132, 'AKTIF', 'G', 'G-11', 'KEPANITIAAN', 'PANITIA LAIN-LAIN'),
	(133, 'AKTIF', 'H', 'H-01', 'DPPH', 'BENDAHARA'),
	(134, 'AKTIF', 'I', 'I-01', 'KARYAWAN', 'ADMINISTRASI UMUM'),
	(135, 'AKTIF', 'I', 'I-02', 'KARYAWAN', 'ADMINISTRASI PASTORAL'),
	(136, 'AKTIF', 'I', 'I-03', 'KARYAWAN', 'ADMINISTRASI KEUANGAN'),
	(137, 'AKTIF', 'I', 'I-04', 'KARYAWAN', 'PASTORAN DAN GEREJA-SOPIR'),
	(138, 'AKTIF', 'I', 'I-05', 'KARYAWAN', 'PASTORAN DAN GEREJA-SATPAM'),
	(139, 'AKTIF', 'I', 'I-06', 'KARYAWAN', 'PASTORAN DAN GEREJA-KOSTER'),
	(140, 'AKTIF', 'I', 'I-07', 'KARYAWAN', 'PASTORAN DAN GEREJA-RUMAH TANGGA');
/*!40000 ALTER TABLE `kelompok_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.periksa_master
CREATE TABLE IF NOT EXISTS `periksa_master` (
  `perprm` int(11) NOT NULL AUTO_INCREMENT,
  `per_mst_dt` varchar(20) DEFAULT NULL,
  `per_mst_nobuk` varchar(20) DEFAULT NULL,
  `per_mst_sts` varchar(20) DEFAULT NULL,
  `per_mst_tgl` date DEFAULT NULL,
  `per_mst_pst` varchar(20) DEFAULT NULL,
  `per_mst_ket` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`perprm`),
  UNIQUE KEY `per_mst_dt_per_mst_nobuk` (`per_mst_dt`,`per_mst_nobuk`) USING BTREE,
  KEY `per_mst_tgl` (`per_mst_tgl`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.periksa_master: ~8 rows (approximately)
/*!40000 ALTER TABLE `periksa_master` DISABLE KEYS */;
INSERT INTO `periksa_master` (`perprm`, `per_mst_dt`, `per_mst_nobuk`, `per_mst_sts`, `per_mst_tgl`, `per_mst_pst`, `per_mst_ket`) VALUES
	(1, 'VER', 'AGR-20210515-17188', 'SETUJU', '2021-05-15', 'GSU', ''),
	(2, 'VER', 'AGR-20210515-22533', 'SETUJU', '2021-05-15', 'GSU', ''),
	(3, 'VER', 'AGR-20210515-02595', 'SETUJU', '2021-05-15', 'GSU', ''),
	(4, 'VER', 'AGR-20210515-62507', 'TOLAK', '2021-05-15', 'GSU', 'COBA TOLAK'),
	(5, 'VER', 'AGR-20210515-39997', 'TOLAK', '2021-05-15', 'GSU', 'TOLAAAAK'),
	(6, 'VER', 'AGR-20210515-07313', 'TOLAK', '2021-05-15', 'GSU', 'TOLAKIN LAGI'),
	(7, 'VER', 'AGR-20210515-20456', 'SETUJU', '2021-05-15', 'GSU', ''),
	(8, 'VER', 'AGR-20210515-30115', 'SETUJU', '2021-05-15', 'GSU', ''),
	(9, 'VER', 'AGR-20210518-21838', 'SETUJU', '2021-05-18', 'GSU', '');
/*!40000 ALTER TABLE `periksa_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.peserta_master
CREATE TABLE IF NOT EXISTS `peserta_master` (
  `pstprm` int(11) NOT NULL AUTO_INCREMENT,
  `pst_mst_sts` varchar(20) DEFAULT NULL,
  `pst_mst_kode` varchar(20) DEFAULT NULL,
  `pst_mst_kel` varchar(20) DEFAULT NULL,
  `pst_mst_hak` varchar(20) DEFAULT NULL,
  `pst_mst_nm` varchar(2000) DEFAULT NULL,
  `pst_mst_pswd` varchar(2000) DEFAULT NULL,
  `pst_mst_lock` int(11) DEFAULT NULL,
  PRIMARY KEY (`pstprm`),
  UNIQUE KEY `pst_mst_kode_pst_mst_sts` (`pst_mst_sts`,`pst_mst_kode`),
  UNIQUE KEY `pst_mst_kode` (`pst_mst_kode`),
  KEY `pst_mst_kel` (`pst_mst_kel`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.peserta_master: ~7 rows (approximately)
/*!40000 ALTER TABLE `peserta_master` DISABLE KEYS */;
INSERT INTO `peserta_master` (`pstprm`, `pst_mst_sts`, `pst_mst_kode`, `pst_mst_kel`, `pst_mst_hak`, `pst_mst_nm`, `pst_mst_pswd`, `pst_mst_lock`) VALUES
	(10, 'AKTIF', 'GSU', 'F-01', 'PEMILIK', 'GREGORIUSSATRIOUTOMO', '254fdf40e3d857f739b7ee57e44b8757', 1),
	(12, 'AKTIF', 'VERIFIKATOR1', 'H-01', 'PENGAWAS', 'NAMAVERIFIKATOR1', '68ba07abf0d370630620ea43c68fabbd', 0),
	(13, 'AKTIF', 'BENDAHARA1', 'H-01', 'PELAKSANA', 'ISINAMABENDAHARA1', '68ba07abf0d370630620ea43c68fabbd', 0),
	(14, 'AKTIF', 'UJICOBA1', 'F-02', 'PEMAKAI', 'NAMAUJICOBA1', '68ba07abf0d370630620ea43c68fabbd', 0),
	(15, 'AKTIF', 'UJICOBA2', 'F-03', 'PEMAKAI', 'NAMAUJICOBA2', '68ba07abf0d370630620ea43c68fabbd', 0),
	(16, 'AKTIF', 'UJICOBA3', 'E-02', 'PEMAKAI', 'NAMAUJICOBA3', '68ba07abf0d370630620ea43c68fabbd', 0),
	(18, 'AKTIF', 'VERIFIKATOR2', 'H-01', 'PENGAWAS', 'INI_DI_ISI_NAMANYA_VERIFIKATOR2', '68ba07abf0d370630620ea43c68fabbd', 0);
/*!40000 ALTER TABLE `peserta_master` ENABLE KEYS */;

-- Dumping structure for table gsmf-monev.rekening_master
CREATE TABLE IF NOT EXISTS `rekening_master` (
  `rekprm` int(11) NOT NULL AUTO_INCREMENT,
  `rek_mst_sts` varchar(20) DEFAULT NULL,
  `rek_mst_kel` varchar(20) DEFAULT NULL,
  `rek_mst_gol` varchar(20) DEFAULT NULL,
  `rek_mst_sub_gol` varchar(20) DEFAULT NULL,
  `rek_mst_kode` varchar(20) DEFAULT NULL,
  `rek_mst_sub_kode` varchar(20) DEFAULT NULL,
  `rek_mst_ket_sub_kode` varchar(2000) DEFAULT NULL,
  `rek_mst_pos` varchar(20) DEFAULT NULL,
  `rek_mst_sld_awl` float DEFAULT NULL,
  `rek_mst_sld_deb` float DEFAULT NULL,
  `rek_mst_sld_kre` float DEFAULT NULL,
  `rek_mst_sld_akh` float DEFAULT NULL,
  PRIMARY KEY (`rekprm`),
  UNIQUE KEY `komplit` (`rek_mst_sts`,`rek_mst_kel`,`rek_mst_gol`,`rek_mst_sub_gol`,`rek_mst_kode`,`rek_mst_sub_kode`),
  UNIQUE KEY `rek_mst_sub_kode` (`rek_mst_sub_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table gsmf-monev.rekening_master: ~79 rows (approximately)
/*!40000 ALTER TABLE `rekening_master` DISABLE KEYS */;
INSERT INTO `rekening_master` (`rekprm`, `rek_mst_sts`, `rek_mst_kel`, `rek_mst_gol`, `rek_mst_sub_gol`, `rek_mst_kode`, `rek_mst_sub_kode`, `rek_mst_ket_sub_kode`, `rek_mst_pos`, `rek_mst_sld_awl`, `rek_mst_sld_deb`, `rek_mst_sld_kre`, `rek_mst_sld_akh`) VALUES
	(74, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'SETARAKAS', '1111-01', 'KAS', 'AKTIVA', 0, 0, 0, 0),
	(75, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'SETARAKAS', '1111-02', 'BANK', 'AKTIVA', 0, 0, 0, 0),
	(76, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'SETARAKAS', '1111-03', 'DEPOSITO', 'AKTIVA', 0, 0, 0, 0),
	(77, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'SETARAKAS', '1111-04', 'GIRO', 'AKTIVA', 0, 0, 0, 0),
	(78, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PIUTANG', '1112-01', 'LEMBAGA', 'AKTIVA', 0, 0, 0, 0),
	(79, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PIUTANG', '1112-02', 'PERORANGAN', 'AKTIVA', 0, 0, 0, 0),
	(80, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PIUTANG', '1112-03', 'BIDANG', 'AKTIVA', 0, 0, 0, 0),
	(81, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PIUTANG', '1112-04', 'TIMPELAYANAN', 'AKTIVA', 0, 0, 0, 0),
	(82, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PERSEDIAAN', '1113-01', 'PERSEDIAAN', 'AKTIVA', 0, 0, 0, 0),
	(83, 'AKTIF', 'NERACA', 'ASET', 'ASETLANCAR', 'PERLENGKAPAN', '1113-02', 'HABISPAKAI', 'AKTIVA', 0, 0, 0, 0),
	(84, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'TIDAKBERGERAK', '1121-01', 'TANAH', 'AKTIVA', 0, 0, 0, 0),
	(85, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'TIDAKBERGERAK', '1121-02', 'BANGUNAN', 'AKTIVA', 0, 0, 0, 0),
	(86, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'TIDAKBERGERAK', '1121-03', 'SUSUT', 'AKTIVA', 0, 0, 0, 0),
	(87, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'BERGERAK', '1122-01', 'KENDARAAN', 'AKTIVA', 0, 0, 0, 0),
	(88, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'BERGERAK', '1122-02', 'SUSUT', 'AKTIVA', 0, 0, 0, 0),
	(89, 'AKTIF', 'NERACA', 'ASET', 'ASETLAIN', 'LAIN', '1131-01', 'LAIN', 'AKTIVA', 250000, 0, 0, 0),
	(90, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPANJANG', '1211-01', 'LEMBAGA', 'PASIVA', 0, 0, 0, 0),
	(91, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPANJANG', '1211-02', 'PERORANGAN', 'PASIVA', 0, 0, 0, 0),
	(92, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPENDEK', '1212-01', 'LEMBAGA', 'PASIVA', 0, 0, 0, 0),
	(93, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'JANGKAPENDEK', '1212-02', 'PERORANGAN', 'PASIVA', 0, 0, 0, 0),
	(94, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'KHUSUS', '1213-01', 'LEMBAGA', 'PASIVA', 0, 0, 0, 0),
	(95, 'AKTIF', 'NERACA', 'KEWAJIBAN', 'KEWAJIBAN', 'KHUSUS', '1213-02', 'PERORANGAN', 'PASIVA', 0, 0, 0, 0),
	(96, 'AKTIF', 'NERACA', 'ASET BERSIH', 'TIDAKTERIKAT', 'TIDAKTERIKAT', '1311-01', 'AKUMULASI', 'PASIVA', 0, 0, 0, 0),
	(97, 'AKTIF', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'NONPEMBANGUNAN', '1321-01', 'AKUMULASI', 'PASIVA', 0, 0, 0, 0),
	(98, 'AKTIF', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'PEMBANGUNAN', '1322-01', 'AKUMULASI', 'PASIVA', 0, 0, 0, 0),
	(99, 'AKTIF', 'NERACA', 'ASET BERSIH', 'TERIKATSEMENTARA', 'UKSP', '1323-01', 'AKUMULASI', 'PASIVA', 0, 0, 0, 0),
	(100, 'AKTIF', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'KOLEKTE', '2111-01', 'MISAUMUM', 'PASIVA', 0, 0, 0, 0),
	(101, 'AKTIF', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'KOLEKTE', '2111-02', 'MISAKHUSUS', 'PASIVA', 0, 0, 0, 0),
	(102, 'AKTIF', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'BANTUAN', '2112-01', 'LEMBAGA', 'PASIVA', 0, 0, 0, 0),
	(103, 'AKTIF', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'BANTUAN', '2112-02', 'PERORANGAN', 'PASIVA', 0, 0, 0, 0),
	(104, 'AKTIF', 'ANGGARAN', 'ABTT', 'PENDAPATAN', 'UMUM', '2113-01', 'BUNGABANK', 'PASIVA', 0, 0, 0, 0),
	(105, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'PROGRAM', '2121-01', 'BIDANG', 'AKTIVA', 0, 0, 0, 0),
	(106, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'PROGRAM', '2121-02', 'TIMPELAYANAN', 'AKTIVA', 0, 0, 0, 0),
	(107, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'KARYAWAN', '2123-01', 'GAJITUNJANGANDANUPAH', 'AKTIVA', 0, 0, 0, 0),
	(108, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-01', 'GEREJA', 'AKTIVA', 0, 0, 0, 0),
	(109, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-02', 'RUMAHTANGGA', 'AKTIVA', 0, 0, 0, 0),
	(110, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-03', 'KEAMANAN', 'AKTIVA', 0, 0, 0, 0),
	(111, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-04', 'ADMINISTRASI', 'AKTIVA', 0, 0, 0, 0),
	(112, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-05', 'DEVOSIONALIA', 'AKTIVA', 0, 0, 0, 0),
	(113, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-06', 'AULAPAROKI', 'AKTIVA', 0, 0, 0, 0),
	(114, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-07', 'DEWANPASTORAL', 'AKTIVA', 0, 0, 0, 0),
	(115, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-08', 'PENYUSUTAN', 'AKTIVA', 0, 0, 0, 0),
	(116, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-09', 'PAJAKBUNGABANK', 'AKTIVA', 0, 0, 0, 0),
	(117, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-10', 'ADMINISTRASIBANK', 'AKTIVA', 0, 0, 0, 0),
	(118, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'RUTIN', '2122-11', 'PAJAK', 'AKTIVA', 0, 0, 0, 0),
	(119, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'BANTUAN', '2211-01', 'PENDIDIKAN', 'PASIVA', 0, 0, 0, 0),
	(120, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'BANTUAN', '2211-02', 'KESEHATAN', 'PASIVA', 0, 0, 0, 0),
	(121, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'BANTUAN', '2211-03', 'SEMINARI', 'PASIVA', 0, 0, 0, 0),
	(122, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-01', 'DANAPAPAMISKIN', 'PASIVA', 0, 0, 0, 0),
	(123, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-02', 'APP', 'PASIVA', 0, 0, 0, 0),
	(124, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-03', 'PANGRUKTILAYA', 'PASIVA', 0, 0, 0, 0),
	(125, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-04', 'BKSY', 'PASIVA', 0, 0, 0, 0),
	(126, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-05', 'PENDINGCOFFEE', 'PASIVA', 0, 0, 0, 0),
	(127, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'PENDAPATAN', 'UMUM', '2212-06', 'BUNGABANK', 'PASIVA', 0, 0, 0, 0),
	(128, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-01', 'DANAPAPAMISKIN', 'AKTIVA', 0, 0, 0, 0),
	(129, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-02', 'PENDIDIKAN', 'AKTIVA', 0, 0, 0, 0),
	(130, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-03', 'KESEHATAN', 'AKTIVA', 0, 0, 0, 0),
	(131, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-04', 'SEMINARI', 'AKTIVA', 0, 0, 0, 0),
	(132, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-05', 'APP', 'AKTIVA', 0, 0, 0, 0),
	(133, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-06', 'PANGRUKTILAYA', 'AKTIVA', 0, 0, 0, 0),
	(134, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-07', 'BKSY', 'AKTIVA', 0, 0, 0, 0),
	(135, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'UMUM', '2213-08', 'PENDINGCOFFEE', 'AKTIVA', 0, 0, 0, 0),
	(136, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'RUTIN', '2214-01', 'PAJAKBUNGABANK', 'AKTIVA', 0, 0, 0, 0),
	(137, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'RUTIN', '2214-02', 'ADMINISTRASIBANK', 'AKTIVA', 0, 0, 0, 0),
	(138, 'AKTIF', 'ANGGARAN', 'ABTS-NP', 'BIAYA', 'RUTIN', '2214-03', 'PAJAK', 'AKTIVA', 0, 0, 0, 0),
	(139, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'KOLEKTE', '2311-01', 'MISAUMUM', 'PASIVA', 0, 0, 0, 0),
	(140, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'KOLEKTE', '2311-02', 'MISAKHUSUS', 'PASIVA', 0, 0, 0, 0),
	(141, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'BANTUAN', '2312-01', 'LEMBAGA', 'PASIVA', 0, 0, 0, 0),
	(142, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'BANTUAN', '2312-02', 'PERORANGAN', 'PASIVA', 0, 0, 0, 0),
	(143, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'PENDAPATAN', 'UMUM', '2313-01', 'BUNGABANK', 'PASIVA', 0, 0, 0, 0),
	(144, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'RUTIN', '2321-01', 'PAJAKBUNGABANK', 'AKTIVA', 0, 0, 0, 0),
	(145, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'RUTIN', '2321-02', 'ADMINISTRASIBANK', 'AKTIVA', 0, 0, 0, 0),
	(146, 'AKTIF', 'ANGGARAN', 'ABTS-P', 'BIAYA', 'RUTIN', '2321-03', 'PAJAK', 'AKTIVA', 0, 0, 0, 0),
	(147, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'PERALATAN', '1123-01', 'SUSUT', 'AKTIVA', 0, 0, 0, 0),
	(148, 'AKTIF', 'NERACA', 'ASET', 'ASETTETAP', 'PERALATAN', '1123-02', 'PERALATAN KANTOR DAN SEKERTARIAT', 'AKTIVA', 0, 0, 0, 0),
	(149, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'INVENTARIS', '2124-01', 'PERAWATANKENDARAAN', 'AKTIVA', 0, 0, 0, 0),
	(150, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'INVENTARIS', '2124-02', 'PERAWATANTANAHDANGEDUNG', 'AKTIVA', 0, 0, 0, 0),
	(151, 'AKTIF', 'ANGGARAN', 'ABTT', 'BIAYA', 'INVENTARIS', '2124-03', 'PERAWATANPERALATAN', 'AKTIVA', 0, 0, 0, 0);
/*!40000 ALTER TABLE `rekening_master` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
