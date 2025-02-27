-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table data_roti.fuzzy_rules
CREATE TABLE IF NOT EXISTS `fuzzy_rules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `kondisi` text NOT NULL,
  `output` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table data_roti.fuzzy_rules: ~0 rows (approximately)
INSERT INTO `fuzzy_rules` (`id`, `kondisi`, `output`) VALUES
	(1, 'Stok Sangat Rendah AND Terjual Sangat Rendah AND Sisa Sangat Banyak AND Harga Mahal AND Pembeli Sangat Rendah AND Tanggal Hari Kerja Pagi', 'Tidak Laris'),
	(2, 'Stok Rendah AND Terjual Rendah AND Sisa Banyak AND Harga Sedang AND Pembeli Rendah AND Tanggal Hari Kerja Tengah', 'Tidak Laris'),
	(3, 'Stok Sedang AND Terjual Sedang AND Sisa Sedang AND Harga Murah AND Pembeli Sedang AND Tanggal Hari Kerja Akhir', 'Sedang'),
	(4, 'Stok Tinggi AND Terjual Rendah AND Sisa Banyak AND Harga Mahal AND Pembeli Rendah AND Tanggal Akhir Pekan', 'Tidak Laris'),
	(5, 'Stok Sangat Tinggi AND Terjual Tinggi AND Sisa Sedikit AND Harga Sangat Murah AND Pembeli Tinggi AND Tanggal Hari Libur', 'Sangat Laris'),
	(6, 'Stok Rendah AND Terjual Tinggi AND Sisa Sedikit AND Harga Sedang AND Pembeli Sedang AND Tanggal Hari Kerja Pagi', 'Laris'),
	(7, 'Stok Sedang AND Terjual Sangat Tinggi AND Sisa Sangat Sedikit AND Harga Murah AND Pembeli Tinggi AND Tanggal Akhir Pekan', 'Sangat Laris'),
	(8, 'Stok Tinggi AND Terjual Sedang AND Sisa Sedang AND Harga Tinggi AND Pembeli Sedang AND Tanggal Hari Kerja Tengah', 'Sedang'),
	(9, 'Stok Sangat Rendah AND Terjual Rendah AND Sisa Sangat Banyak AND Harga Sangat Mahal AND Pembeli Sangat Rendah AND Tanggal Hari Kerja Akhir', 'Tidak Laris'),
	(10, 'Stok Rendah AND Terjual Sedang AND Sisa Banyak AND Harga Sedang AND Pembeli Rendah AND Tanggal Hari Libur', 'Sedang'),
	(11, 'Stok Sedang AND Terjual Tinggi AND Sisa Sedikit AND Harga Murah AND Pembeli Tinggi AND Tanggal Hari Kerja Pagi', 'Laris'),
	(12, 'Stok Tinggi AND Terjual Sangat Tinggi AND Sisa Sangat Sedikit AND Harga Sedang AND Pembeli Sangat Tinggi AND Tanggal Akhir Pekan', 'Sangat Laris'),
	(13, 'Stok Sangat Tinggi AND Terjual Rendah AND Sisa Banyak AND Harga Mahal AND Pembeli Rendah AND Tanggal Hari Kerja Tengah', 'Tidak Laris'),
	(14, 'Stok Rendah AND Terjual Rendah AND Sisa Sedang AND Harga Sangat Murah AND Pembeli Sedang AND Tanggal Hari Kerja Akhir', 'Sedang'),
	(15, 'Stok Sedang AND Terjual Sedang AND Sisa Sedikit AND Harga Tinggi AND Pembeli Tinggi AND Tanggal Hari Libur', 'Laris'),
	(16, 'Stok Tinggi AND Terjual Tinggi AND Sisa Sangat Sedikit AND Harga Murah AND Pembeli Sedang AND Tanggal Akhir Pekan', 'Sangat Laris'),
	(17, 'Stok Sangat Rendah AND Terjual Tinggi AND Sisa Sedikit AND Harga Sedang AND Pembeli Rendah AND Tanggal Hari Kerja Pagi', 'Laris'),
	(18, 'Stok Rendah AND Terjual Sangat Tinggi AND Sisa Sangat Sedikit AND Harga Mahal AND Pembeli Tinggi AND Tanggal Hari Kerja Tengah', 'Sangat Laris'),
	(19, 'Stok Sedang AND Terjual Rendah AND Sisa Banyak AND Harga Sangat Murah AND Pembeli Rendah AND Tanggal Hari Kerja Akhir', 'Tidak Laris'),
	(20, 'Stok Tinggi AND Terjual Sedang AND Sisa Sedang AND Harga Tinggi AND Pembeli Sedang AND Tanggal Hari Libur', 'Sedang'),
	(21, 'Stok Sangat Tinggi AND Terjual Tinggi AND Sisa Sedikit AND Harga Murah AND Pembeli Sangat Tinggi AND Tanggal Akhir Pekan', 'Sangat Laris'),
	(22, 'Stok Rendah AND Terjual Rendah AND Sisa Sangat Banyak AND Harga Mahal AND Pembeli Sangat Rendah AND Tanggal Hari Kerja Pagi', 'Tidak Laris'),
	(23, 'Stok Sedang AND Terjual Tinggi AND Sisa Sedikit AND Harga Sedang AND Pembeli Tinggi AND Tanggal Hari Kerja Tengah', 'Laris'),
	(24, 'Stok Tinggi AND Terjual Sangat Tinggi AND Sisa Sangat Sedikit AND Harga Murah AND Pembeli Sedang AND Tanggal Hari Libur', 'Sangat Laris'),
	(25, 'Stok Sangat Rendah AND Terjual Sedang AND Sisa Banyak AND Harga Tinggi AND Pembeli Rendah AND Tanggal Akhir Pekan', 'Sedang'),
	(26, 'Stok Rendah AND Terjual Tinggi AND Sisa Sedikit AND Harga Sangat Murah AND Pembeli Tinggi AND Tanggal Hari Kerja Akhir', 'Laris'),
	(27, 'Stok Sedang AND Terjual Rendah AND Sisa Sangat Banyak AND Harga Mahal AND Pembeli Sedang AND Tanggal Hari Kerja Pagi', 'Tidak Laris'),
	(28, 'Stok Tinggi AND Terjual Sedang AND Sisa Sedang AND Harga Sedang AND Pembeli Tinggi AND Tanggal Hari Kerja Tengah', 'Laris'),
	(29, 'Stok Sangat Tinggi AND Terjual Tinggi AND Sisa Sedikit AND Harga Murah AND Pembeli Sangat Tinggi AND Tanggal Akhir Pekan', 'Sangat Laris'),
	(30, 'Stok Rendah AND Terjual Rendah AND Sisa Banyak AND Harga Sangat Mahal AND Pembeli Rendah AND Tanggal Hari Libur', 'Tidak Laris');

-- Dumping structure for table data_roti.fuzzy_variables
CREATE TABLE IF NOT EXISTS `fuzzy_variables` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `batas_bawah` int NOT NULL,
  `batas_tengah` int NOT NULL,
  `batas_atas` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table data_roti.fuzzy_variables: ~30 rows (approximately)
INSERT INTO `fuzzy_variables` (`id`, `nama`, `kategori`, `batas_bawah`, `batas_tengah`, `batas_atas`) VALUES
	(1, 'Stok', 'Sangat Rendah', 30, 40, 50),
	(2, 'Stok', 'Rendah', 40, 50, 60),
	(3, 'Stok', 'Sedang', 50, 60, 70),
	(4, 'Stok', 'Tinggi', 60, 70, 80),
	(5, 'Stok', 'Sangat Tinggi', 70, 80, 90),
	(6, 'Terjual', 'Sangat Rendah', 20, 30, 40),
	(7, 'Terjual', 'Rendah', 30, 40, 50),
	(8, 'Terjual', 'Sedang', 40, 50, 60),
	(9, 'Terjual', 'Tinggi', 50, 60, 70),
	(10, 'Terjual', 'Sangat Tinggi', 60, 70, 80),
	(11, 'Sisa', 'Sangat Banyak', 8, 10, 12),
	(12, 'Sisa', 'Banyak', 6, 8, 10),
	(13, 'Sisa', 'Sedang', 4, 6, 8),
	(14, 'Sisa', 'Sedikit', 2, 4, 6),
	(15, 'Sisa', 'Sangat Sedikit', 0, 2, 4),
	(16, 'Harga', 'Sangat Murah', 3000, 5000, 7000),
	(17, 'Harga', 'Murah', 5000, 7000, 9000),
	(18, 'Harga', 'Sedang', 7000, 9000, 11000),
	(19, 'Harga', 'Mahal', 9000, 11000, 13000),
	(20, 'Harga', 'Sangat Mahal', 11000, 13000, 15000),
	(21, 'Pembeli', 'Sangat Rendah', 15, 25, 35),
	(22, 'Pembeli', 'Rendah', 25, 30, 40),
	(23, 'Pembeli', 'Sedang', 30, 35, 45),
	(24, 'Pembeli', 'Tinggi', 35, 40, 50),
	(25, 'Pembeli', 'Sangat Tinggi', 40, 45, 55),
	(26, 'Tanggal', 'Hari Kerja Pagi', 1, 2, 3),
	(27, 'Tanggal', 'Hari Kerja Tengah', 3, 4, 5),
	(28, 'Tanggal', 'Hari Kerja Akhir', 5, 6, 7),
	(29, 'Tanggal', 'Akhir Pekan', 6, 7, 1),
	(30, 'Tanggal', 'Hari Libur', 7, 1, 2);

-- Dumping structure for table data_roti.roti
CREATE TABLE IF NOT EXISTS `roti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `stok` int NOT NULL,
  `terjual` int NOT NULL,
  `sisa` int NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `pembeli` int NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table data_roti.roti: ~0 rows (approximately)
INSERT INTO `roti` (`id`, `nama`, `stok`, `terjual`, `sisa`, `harga`, `pembeli`, `tanggal`) VALUES
	(1, 'Roti Manis', 30, 20, 10, 5000.00, 15, '2023-01-01'),
	(2, 'Roti Tawar', 40, 30, 10, 4000.00, 20, '2023-01-02'),
	(3, 'Roti Keju', 50, 40, 10, 6000.00, 25, '2023-01-03'),
	(4, 'Roti Coklat', 60, 50, 10, 7000.00, 30, '2023-01-04'),
	(5, 'Roti Pisang', 70, 60, 10, 8000.00, 35, '2023-01-05'),
	(6, 'Roti Manis', 35, 25, 10, 5200.00, 18, '2023-01-06'),
	(7, 'Roti Tawar', 45, 35, 10, 4200.00, 22, '2023-01-07'),
	(8, 'Roti Keju', 55, 45, 10, 6200.00, 28, '2023-01-08'),
	(9, 'Roti Coklat', 65, 55, 10, 7200.00, 32, '2023-01-09'),
	(10, 'Roti Pisang', 75, 65, 10, 8200.00, 38, '2023-01-10'),
	(11, 'Roti Manis', 32, 22, 10, 5100.00, 16, '2023-01-11'),
	(12, 'Roti Tawar', 42, 32, 10, 4100.00, 21, '2023-01-12'),
	(13, 'Roti Keju', 52, 42, 10, 6100.00, 26, '2023-01-13'),
	(14, 'Roti Coklat', 62, 52, 10, 7100.00, 31, '2023-01-14'),
	(15, 'Roti Pisang', 72, 62, 10, 8100.00, 36, '2023-01-15'),
	(16, 'Roti Manis', 33, 23, 10, 5300.00, 17, '2023-01-16'),
	(17, 'Roti Tawar', 43, 33, 10, 4300.00, 23, '2023-01-17'),
	(18, 'Roti Keju', 53, 43, 10, 6300.00, 27, '2023-01-18'),
	(19, 'Roti Coklat', 63, 53, 10, 7300.00, 33, '2023-01-19'),
	(20, 'Roti Pisang', 73, 63, 10, 8300.00, 37, '2023-01-20'),
	(21, 'Roti Manis', 34, 24, 10, 5400.00, 19, '2023-01-21'),
	(22, 'Roti Tawar', 44, 34, 10, 4400.00, 24, '2023-01-22'),
	(23, 'Roti Keju', 54, 44, 10, 6400.00, 29, '2023-01-23'),
	(24, 'Roti Coklat', 64, 54, 10, 7400.00, 34, '2023-01-24'),
	(25, 'Roti Pisang', 74, 64, 10, 8400.00, 39, '2023-01-25'),
	(26, 'Roti Manis', 36, 26, 10, 5500.00, 20, '2023-01-26'),
	(27, 'Roti Tawar', 46, 36, 10, 4500.00, 25, '2023-01-27'),
	(28, 'Roti Keju', 56, 46, 10, 6500.00, 30, '2023-01-28'),
	(29, 'Roti Coklat', 66, 56, 10, 7500.00, 35, '2023-01-29'),
	(30, 'Roti Pisang', 76, 66, 10, 8500.00, 40, '2023-01-30'),
	(31, 'Roti Manis', 37, 27, 10, 5600.00, 21, '2023-01-31'),
	(32, 'Roti Tawar', 47, 37, 10, 4600.00, 26, '2023-02-01'),
	(33, 'Roti Keju', 57, 47, 10, 6600.00, 31, '2023-02-02'),
	(34, 'Roti Coklat', 67, 57, 10, 7600.00, 36, '2023-02-03'),
	(35, 'Roti Pisang', 77, 67, 10, 8600.00, 41, '2023-02-04'),
	(36, 'Roti Manis', 38, 28, 10, 5700.00, 22, '2023-02-05'),
	(37, 'Roti Tawar', 48, 38, 10, 4700.00, 27, '2023-02-06'),
	(38, 'Roti Keju', 58, 48, 10, 6700.00, 32, '2023-02-07'),
	(39, 'Roti Coklat', 68, 58, 10, 7700.00, 37, '2023-02-08'),
	(40, 'Roti Pisang', 78, 68, 10, 8700.00, 42, '2023-02-09'),
	(41, 'Roti Manis', 39, 29, 10, 5800.00, 23, '2023-02-10'),
	(42, 'Roti Tawar', 49, 39, 10, 4800.00, 28, '2023-02-11'),
	(43, 'Roti Keju', 59, 49, 10, 6800.00, 33, '2023-02-12'),
	(44, 'Roti Coklat', 69, 59, 10, 7800.00, 38, '2023-02-13'),
	(45, 'Roti Pisang', 79, 69, 10, 8800.00, 43, '2023-02-14'),
	(46, 'Roti Manis', 31, 21, 10, 4900.00, 16, '2023-02-15'),
	(47, 'Roti Tawar', 41, 31, 10, 3900.00, 21, '2023-02-16'),
	(48, 'Roti Keju', 51, 41, 10, 5900.00, 26, '2023-02-17'),
	(49, 'Roti Coklat', 61, 51, 10, 6900.00, 31, '2023-02-18'),
	(50, 'Roti Pisang', 71, 61, 10, 7900.00, 36, '2023-02-19'),
	(51, 'Roti Manis', 32, 22, 10, 5000.00, 17, '2023-02-20'),
	(52, 'Roti Tawar', 42, 32, 10, 4000.00, 22, '2023-02-21'),
	(53, 'Roti Keju', 52, 42, 10, 6000.00, 27, '2023-02-22'),
	(54, 'Roti Coklat', 62, 52, 10, 7000.00, 32, '2023-02-23'),
	(55, 'Roti Pisang', 72, 62, 10, 8000.00, 37, '2023-02-24'),
	(56, 'Roti Manis', 33, 23, 10, 5100.00, 18, '2023-02-25'),
	(57, 'Roti Tawar', 43, 33, 10, 4100.00, 23, '2023-02-26'),
	(58, 'Roti Keju', 53, 43, 10, 6100.00, 28, '2023-02-27'),
	(59, 'Roti Coklat', 63, 53, 10, 7100.00, 33, '2023-02-28'),
	(60, 'Roti Pisang', 73, 63, 10, 8100.00, 38, '2023-03-01'),
	(61, 'Roti Manis', 34, 24, 10, 5200.00, 19, '2023-03-02'),
	(62, 'Roti Tawar', 44, 34, 10, 4200.00, 24, '2023-03-03'),
	(63, 'Roti Keju', 54, 44, 10, 6200.00, 29, '2023-03-04'),
	(64, 'Roti Coklat', 64, 54, 10, 7200.00, 34, '2023-03-05'),
	(65, 'Roti Pisang', 74, 64, 10, 8200.00, 39, '2023-03-06'),
	(66, 'Roti Manis', 35, 25, 10, 5300.00, 20, '2023-03-07'),
	(67, 'Roti Tawar', 45, 35, 10, 4300.00, 25, '2023-03-08'),
	(68, 'Roti Keju', 55, 45, 10, 6300.00, 30, '2023-03-09'),
	(69, 'Roti Coklat', 65, 55, 10, 7300.00, 35, '2023-03-10'),
	(70, 'Roti Pisang', 75, 65, 10, 8300.00, 40, '2023-03-11'),
	(71, 'Roti Manis', 36, 26, 10, 5400.00, 21, '2023-03-12'),
	(72, 'Roti Tawar', 46, 36, 10, 4400.00, 26, '2023-03-13'),
	(73, 'Roti Keju', 56, 46, 10, 6400.00, 31, '2023-03-14'),
	(74, 'Roti Coklat', 66, 56, 10, 7400.00, 36, '2023-03-15'),
	(75, 'Roti Pisang', 76, 66, 10, 8400.00, 41, '2023-03-16'),
	(76, 'Roti Manis', 37, 27, 10, 5500.00, 22, '2023-03-17'),
	(77, 'Roti Tawar', 47, 37, 10, 4500.00, 27, '2023-03-18'),
	(78, 'Roti Keju', 57, 47, 10, 6500.00, 32, '2023-03-19'),
	(79, 'Roti Coklat', 67, 57, 10, 7500.00, 37, '2023-03-20'),
	(80, 'Roti Pisang', 77, 67, 10, 8500.00, 42, '2023-03-21'),
	(81, 'Roti Manis', 38, 28, 10, 5600.00, 23, '2023-03-22'),
	(82, 'Roti Tawar', 48, 38, 10, 4600.00, 28, '2023-03-23'),
	(83, 'Roti Keju', 58, 48, 10, 6600.00, 33, '2023-03-24'),
	(84, 'Roti Coklat', 68, 58, 10, 7600.00, 38, '2023-03-25'),
	(85, 'Roti Pisang', 78, 68, 10, 8600.00, 43, '2023-03-26'),
	(86, 'Roti Manis', 39, 29, 10, 5700.00, 24, '2023-03-27'),
	(87, 'Roti Tawar', 49, 39, 10, 4700.00, 29, '2023-03-28'),
	(88, 'Roti Keju', 59, 49, 10, 6700.00, 34, '2023-03-29'),
	(89, 'Roti Coklat', 69, 59, 10, 7700.00, 39, '2023-03-30'),
	(90, 'Roti Pisang', 79, 69, 10, 8700.00, 44, '2023-03-31'),
	(91, 'Roti Manis', 40, 30, 10, 5800.00, 25, '2023-04-01'),
	(92, 'Roti Tawar', 50, 40, 10, 4800.00, 30, '2023-04-02'),
	(93, 'Roti Keju', 60, 50, 10, 6800.00, 35, '2023-04-03'),
	(94, 'Roti Coklat', 70, 60, 10, 7800.00, 40, '2023-04-04'),
	(95, 'Roti Pisang', 80, 70, 10, 8800.00, 45, '2023-04-05'),
	(96, 'Roti Manis', 41, 31, 10, 5900.00, 26, '2023-04-06'),
	(97, 'Roti Tawar', 51, 41, 10, 4900.00, 31, '2023-04-07'),
	(98, 'Roti Keju', 61, 51, 10, 6900.00, 36, '2023-04-08'),
	(99, 'Roti Coklat', 71, 61, 10, 7900.00, 41, '2023-04-09'),
	(100, 'Roti Pisang', 81, 71, 10, 8900.00, 46, '2023-04-10');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
