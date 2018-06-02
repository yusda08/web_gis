-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.19 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for simpelgis
DROP DATABASE IF EXISTS `simpelgis`;
CREATE DATABASE IF NOT EXISTS `simpelgis` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `simpelgis`;

-- Dumping structure for table simpelgis.koordinatjalan
DROP TABLE IF EXISTS `koordinatjalan`;
CREATE TABLE IF NOT EXISTS `koordinatjalan` (
  `id_koordinatjalan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jalan` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_koordinatjalan`),
  KEY `jalan_id` (`id_jalan`),
  CONSTRAINT `koordinatjalan_ibfk_1` FOREIGN KEY (`id_jalan`) REFERENCES `tbl_jalan` (`id_jalan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table simpelgis.koordinatjalan: ~0 rows (approximately)
/*!40000 ALTER TABLE `koordinatjalan` DISABLE KEYS */;
INSERT INTO `koordinatjalan` (`id_koordinatjalan`, `id_jalan`, `latitude`, `longitude`) VALUES
	(1, 2, '-2.5841600258445805', '115.38565804722361'),
	(2, 2, '-2.583066796961424', '115.38700988056712');
/*!40000 ALTER TABLE `koordinatjalan` ENABLE KEYS */;

-- Dumping structure for table simpelgis.tbl_jalan
DROP TABLE IF EXISTS `tbl_jalan`;
CREATE TABLE IF NOT EXISTS `tbl_jalan` (
  `id_jalan` int(11) NOT NULL AUTO_INCREMENT,
  `namajalan` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1,
  PRIMARY KEY (`id_jalan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table simpelgis.tbl_jalan: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_jalan` DISABLE KEYS */;
INSERT INTO `tbl_jalan` (`id_jalan`, `namajalan`, `keterangan`) VALUES
	(2, 'Jl. Sudirmas', 'Oke');
/*!40000 ALTER TABLE `tbl_jalan` ENABLE KEYS */;

-- Dumping structure for table simpelgis.tbl_jembatan
DROP TABLE IF EXISTS `tbl_jembatan`;
CREATE TABLE IF NOT EXISTS `tbl_jembatan` (
  `id_jembatan` int(11) NOT NULL AUTO_INCREMENT,
  `namajembatan` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1,
  PRIMARY KEY (`id_jembatan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table simpelgis.tbl_jembatan: ~1 rows (approximately)
/*!40000 ALTER TABLE `tbl_jembatan` DISABLE KEYS */;
INSERT INTO `tbl_jembatan` (`id_jembatan`, `namajembatan`, `keterangan`) VALUES
	(1, 'Jembatan Barito', 'Oke');
/*!40000 ALTER TABLE `tbl_jembatan` ENABLE KEYS */;

-- Dumping structure for table simpelgis.tbl_koordinatjembatan
DROP TABLE IF EXISTS `tbl_koordinatjembatan`;
CREATE TABLE IF NOT EXISTS `tbl_koordinatjembatan` (
  `id_koordinatjembatan` int(11) NOT NULL AUTO_INCREMENT,
  `id_jembatan` int(11) DEFAULT NULL,
  `latitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  `longitude` varchar(24) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_koordinatjembatan`),
  KEY `jembatan_id` (`id_jembatan`),
  CONSTRAINT `tbl_koordinatjembatan_ibfk_1` FOREIGN KEY (`id_jembatan`) REFERENCES `tbl_jembatan` (`id_jembatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table simpelgis.tbl_koordinatjembatan: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_koordinatjembatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_koordinatjembatan` ENABLE KEYS */;

-- Dumping structure for table simpelgis.tbl_user
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(512) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table simpelgis.tbl_user: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
