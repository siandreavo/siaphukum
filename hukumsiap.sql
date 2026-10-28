-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 8.4.3 - MySQL Community Server - GPL
-- OS Server:                    Win64
-- HeidiSQL Versi:               12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk hukumsiap
CREATE DATABASE IF NOT EXISTS `hukumsiap` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hukumsiap`;

-- membuang struktur untuk table hukumsiap.keluar
CREATE TABLE IF NOT EXISTS `keluar` (
  `idkeluar` int NOT NULL AUTO_INCREMENT,
  `nosuratkeluar` varchar(100) NOT NULL DEFAULT '',
  `tglsuratkeluar` date NOT NULL,
  `tglsekarangkeluar` date NOT NULL,
  `tujuan` varchar(50) NOT NULL DEFAULT '',
  `perihalkeluar` varchar(255) NOT NULL DEFAULT '',
  `orangkeluar` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idkeluar`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.keluar: ~1 rows (lebih kurang)
INSERT INTO `keluar` (`idkeluar`, `nosuratkeluar`, `tglsuratkeluar`, `tglsekarangkeluar`, `tujuan`, `perihalkeluar`, `orangkeluar`) VALUES
	(2, 'sahk', '2026-10-28', '2026-10-28', 'SHABCK', 'ASHKJ', 'ASHK');

-- membuang struktur untuk table hukumsiap.keputusan
CREATE TABLE IF NOT EXISTS `keputusan` (
  `idkep` int NOT NULL AUTO_INCREMENT,
  `nomorkep` varchar(100) NOT NULL DEFAULT '',
  `judulkep` varchar(255) NOT NULL DEFAULT '',
  `tglpenetapankep` date NOT NULL,
  `kodenaskahkep` varchar(50) NOT NULL DEFAULT '',
  `opd` varchar(50) NOT NULL DEFAULT '',
  `statuskep` varchar(50) NOT NULL DEFAULT '',
  `filekep` varchar(255) NOT NULL DEFAULT '',
  `diinputolehkep` varchar(50) NOT NULL,
  `ketkep` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `filebarukep` varchar(255) NOT NULL,
  PRIMARY KEY (`idkep`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.keputusan: ~1 rows (lebih kurang)
INSERT INTO `keputusan` (`idkep`, `nomorkep`, `judulkep`, `tglpenetapankep`, `kodenaskahkep`, `opd`, `statuskep`, `filekep`, `diinputolehkep`, `ketkep`, `filebarukep`) VALUES
	(2, 'SHIK', 'SCKH', '2026-10-28', 'SKH', 'SHC', 'DIUBAH', 'Per3-Penjadwalan Proses (1).pdf', 'SAJKCHS', 'CJHO', '');

-- membuang struktur untuk table hukumsiap.login
CREATE TABLE IF NOT EXISTS `login` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `peran` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.login: ~4 rows (lebih kurang)
INSERT INTO `login` (`iduser`, `username`, `email`, `password`, `peran`) VALUES
	(2, 'IT', 'it@siaphukum.com', '123456', 'Admin'),
	(3, 'Kabag', 'kabag@siaphukum.com', '123456', 'User'),
	(4, 'Kasubag', 'kasubag@siaphukum.com', '123456', 'User'),
	(5, 'Staf', 'staf@siaphukum.com', '123456', 'User');

-- membuang struktur untuk table hukumsiap.masuk
CREATE TABLE IF NOT EXISTS `masuk` (
  `idmasuk` int NOT NULL AUTO_INCREMENT,
  `nosuratmasuk` varchar(100) NOT NULL DEFAULT '',
  `tglsuratmasuk` date NOT NULL,
  `tglsekarang` date NOT NULL,
  `asal` varchar(50) NOT NULL DEFAULT '',
  `perihalmasuk` varchar(255) NOT NULL DEFAULT '',
  `orangmasuk` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`idmasuk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.masuk: ~1 rows (lebih kurang)
INSERT INTO `masuk` (`idmasuk`, `nosuratmasuk`, `tglsuratmasuk`, `tglsekarang`, `asal`, `perihalmasuk`, `orangmasuk`) VALUES
	(2, 'sjcn', '2026-10-28', '2026-10-28', 'SAJHL', 'SJN', 'SAJK');

-- membuang struktur untuk table hukumsiap.perbup
CREATE TABLE IF NOT EXISTS `perbup` (
  `idperbup` int NOT NULL AUTO_INCREMENT,
  `diinputolehperbup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `judulperbup` varchar(255) NOT NULL,
  `nomorperbup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `tglevaluasiperbup` date NOT NULL,
  `tglpengundanganperbup` date NOT NULL,
  `tglpenetapanperbup` date NOT NULL,
  `statusperbup` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `nobd` varchar(50) NOT NULL DEFAULT '',
  `nobdt` varchar(50) NOT NULL DEFAULT '',
  `ketperbup` varchar(255) NOT NULL DEFAULT '',
  `fileperbup` varchar(255) NOT NULL DEFAULT '',
  `filebaruperbup` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`idperbup`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.perbup: ~1 rows (lebih kurang)
INSERT INTO `perbup` (`idperbup`, `diinputolehperbup`, `judulperbup`, `nomorperbup`, `tglevaluasiperbup`, `tglpengundanganperbup`, `tglpenetapanperbup`, `statusperbup`, `nobd`, `nobdt`, `ketperbup`, `fileperbup`, `filebaruperbup`) VALUES
	(5, 'KSHFOW', 'AFH', 'ASJKFH', '2026-10-28', '2026-10-28', '2026-10-28', 'BERLAKU', 'WEJH', 'WEHE', 'CHSAJ', 'Questions for subnetting.pptx', '');

-- membuang struktur untuk table hukumsiap.perda
CREATE TABLE IF NOT EXISTS `perda` (
  `idperda` int unsigned NOT NULL AUTO_INCREMENT,
  `diinputolehperda` varchar(50) NOT NULL,
  `judulperda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  `nomorperda` varchar(50) NOT NULL DEFAULT '',
  `tglevaluasiperda` date NOT NULL,
  `tglpengundanganperda` date NOT NULL,
  `tglpenetapanperda` date NOT NULL,
  `nold` varchar(50) NOT NULL DEFAULT '0',
  `noldt` varchar(50) NOT NULL DEFAULT '0',
  `seriperda` varchar(50) NOT NULL DEFAULT '',
  `statusperda` varchar(50) NOT NULL DEFAULT '',
  `ketperda` varchar(255) NOT NULL,
  `fileperda` varchar(255) NOT NULL DEFAULT '',
  `filebaruperda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`idperda`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Membuang data untuk tabel hukumsiap.perda: ~1 rows (lebih kurang)
INSERT INTO `perda` (`idperda`, `diinputolehperda`, `judulperda`, `nomorperda`, `tglevaluasiperda`, `tglpengundanganperda`, `tglpenetapanperda`, `nold`, `noldt`, `seriperda`, `statusperda`, `ketperda`, `fileperda`, `filebaruperda`) VALUES
	(3, 'ADSYG', 'SH', 'SADGAIS', '2026-10-28', '2026-10-28', '2026-10-28', 'HCOS', 'SAJKHCAO', 'SAHBK', 'BERLAKU', 'ASJKHAS', '6c32fd46-fdda-4e3c-a6b6-d59e53198699.jfif', '');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
