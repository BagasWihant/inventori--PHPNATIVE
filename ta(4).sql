-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 04, 2021 at 04:10 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `iduser` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `level` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`iduser`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Bagas Wihant', 'admin', 'admin', '1'),
(2, 'WIHANT', 'kiko', 'kiko', '2');

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_brg` int(11) NOT NULL,
  `nm_brg` varchar(50) NOT NULL,
  `stok_brg` int(11) DEFAULT 0,
  `hbeli` int(11) NOT NULL,
  `hjual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id_brg`, `nm_brg`, `stok_brg`, `hbeli`, `hjual`) VALUES
(1, 'BAN', 104, 12000, 13000),
(9, 'PELEM', 44, 121, 1111),
(20, 'AREM-AREM', 77, 1200, 3000),
(25, 'B', 90, 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_brgKeluar`
--

CREATE TABLE `tb_brgKeluar` (
  `id_penjualan` varchar(15) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `jml_jual` int(11) NOT NULL,
  `tgl_jual` timestamp NOT NULL DEFAULT current_timestamp(),
  `diskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_brgKeluar`
--

INSERT INTO `tb_brgKeluar` (`id_penjualan`, `id_brg`, `jml_jual`, `tgl_jual`, `diskripsi`) VALUES
('K0408321043117', 25, 9, '2021-08-04 10:31:04', '');

--
-- Triggers `tb_brgKeluar`
--
DELIMITER $$
CREATE TRIGGER `batal_keluar` AFTER DELETE ON `tb_brgKeluar` FOR EACH ROW BEGIN
UPDATE tb_barang SET stok_brg = stok_brg + OLD.jml_jual WHERE id_brg = OLD.id_brg;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `penjualan` AFTER INSERT ON `tb_brgKeluar` FOR EACH ROW BEGIN

UPDATE tb_barang SET stok_brg = stok_brg - new.jml_jual WHERE id_brg = new.id_brg;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tb_brgMasuk`
--

CREATE TABLE `tb_brgMasuk` (
  `id_pembelian` varchar(15) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `jml_beli` int(11) NOT NULL,
  `tgl_beli` timestamp NOT NULL DEFAULT current_timestamp(),
  `diskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_brgMasuk`
--

INSERT INTO `tb_brgMasuk` (`id_pembelian`, `id_brg`, `jml_beli`, `tgl_beli`, `diskripsi`) VALUES
('M0308221012819', 9, 31, '2021-08-03 12:28:01', '122NN'),
('M0308221291719', 1, 10, '2021-08-03 12:17:29', 'STOK AWALNYA KOK'),
('M0408321041219', 25, 7, '2021-08-04 12:12:04', '465TRUURTURTUTU'),
('M0408321044615', 9, 1, '2021-08-04 08:46:04', 'INI APA'),
('M0408321130419', 25, 1, '2021-08-04 12:04:13', '1'),
('M0408321163512', 20, 77, '2021-08-04 05:35:16', ''),
('M0408321235118', 1, 7, '2021-08-04 11:51:23', '8'),
('M0408321300219', 1, 73, '2021-08-04 12:02:30', '8'),
('M0408321321219', 25, 1, '2021-08-04 12:12:32', 'TTYRTYRTYURTUTU'),
('M0408321340319', 9, 11, '2021-08-04 12:03:34', ''),
('M0408321422717', 25, 89, '2021-08-04 10:27:42', '12'),
('M0408321431219', 25, 1, '2021-08-04 12:12:43', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
('M0408321435118', 1, 7, '2021-08-04 11:51:43', '8'),
('M0408321450319', 9, 1, '2021-08-04 12:03:45', '123213123123123213123'),
('M0408321475118', 1, 7, '2021-08-04 11:51:47', '8');

--
-- Triggers `tb_brgMasuk`
--
DELIMITER $$
CREATE TRIGGER `batal_masuk` AFTER DELETE ON `tb_brgMasuk` FOR EACH ROW BEGIN

UPDATE tb_barang SET stok_brg = stok_brg - OLD.jml_beli WHERE id_brg = OLD.id_brg;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pembelian` AFTER INSERT ON `tb_brgMasuk` FOR EACH ROW BEGIN

INSERT INTO tb_barang SET id_brg = new.id_brg, stok_brg = new.jml_beli
ON DUPLICATE KEY UPDATE stok_brg = stok_brg + new.jml_beli; 

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_brg`);

--
-- Indexes for table `tb_brgKeluar`
--
ALTER TABLE `tb_brgKeluar`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `id_brg` (`id_brg`);

--
-- Indexes for table `tb_brgMasuk`
--
ALTER TABLE `tb_brgMasuk`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_brg` (`id_brg`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_brg` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_brgKeluar`
--
ALTER TABLE `tb_brgKeluar`
  ADD CONSTRAINT `tb_brgKeluar_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `tb_barang` (`id_brg`) ON UPDATE CASCADE;

--
-- Constraints for table `tb_brgMasuk`
--
ALTER TABLE `tb_brgMasuk`
  ADD CONSTRAINT `tb_brgMasuk_ibfk_1` FOREIGN KEY (`id_brg`) REFERENCES `tb_barang` (`id_brg`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
