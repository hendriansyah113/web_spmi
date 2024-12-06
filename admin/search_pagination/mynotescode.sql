-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2017 at 06:49 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mynotescode`
--

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE IF NOT EXISTS `siswa` (
  `nis` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('10110470110', 'Ade Zenudin Bimashita', 'Laki-laki', '08199288272', 'Tegal'),
('10110470111', 'Ani Lestari', 'Perempuan', '089228827727', 'Jakarta'),
('10110470112', 'Imam Maulana', 'Laki-laki', '08561777166', 'Bandung'),
('10110470113', 'Siska Melina Rachman', 'Perempuan', '0828817717', 'Bandung'),
('10110470114', 'Diki Somantri', 'Laki-laki', '081662662771', 'Padang'),
('10110470115', 'Shanty', 'Perempuan', '08552662771', 'Purwakarta'),
('10110470116', 'Rinrin Rosilawati', 'Perempuan', '082661551551', 'Banten'),
('10110470117', 'Anas Saepul', 'Laki-laki', '089988181717', 'Jakarta'),
('10110470118', 'Firman Ramdhan', 'Laki-laki', '089918827635', 'Solo'),
('10110470119', 'Resti Sri Wahyuni', 'Perempuan', '085661557281', 'Garut'),
('10110470120', 'Yayat', 'Laki-laki', '089928827151', 'Garut'),
('10110470121', 'Anjas Yuwar Mahesa', 'Laki-laki', '089166255151', 'Tangerang'),
('10110470122', 'Yusup Nur Permadi', 'Laki-laki', '081172652441', 'Bandung'),
('10110470123', 'Mawar Izzati', 'Perempuan', '088726166122', 'Yogyakarta'),
('10110470124', 'Siti Nurjanah', 'Perempuan', '089188172515', 'Bogor'),
('10110470125', 'Ayuni Anggraeni', 'Perempuan', '085516616611', 'Solo'),
('10110470126', 'Devi Nur', 'Perempuan', '082635534778', 'Lombok'),
('10110470127', 'Rijalul', 'Laki-laki', '089918826535', 'Padang'),
('10110470128', 'Dwi Angga', 'Laki-laki', '081552171888', 'Bandung'),
('10114070129', 'Rizaldi Maulidia Achmad', 'Laki-laki', '089283773622', 'Sumedang');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
