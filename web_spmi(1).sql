-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2024 at 01:52 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_spmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `gkm_ami`
--

CREATE TABLE `gkm_ami` (
  `nidn` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gkm_ami`
--

INSERT INTO `gkm_ami` (`nidn`, `nama`, `jabatan`, `email`, `foto`) VALUES
(2222, 'c', 'c', 'cindykfykfy@gmail.com', 0x696e7374616772616d2d6c6f676f2d453030363741313430332d7365656b6c6f676f2e636f6d2e706e67),
(11111, 'cindy', 'lpm', 'cindykfykfy@gmail.com', 0x696d61676573202831292e6a7067),
(23456, 'nita', 'lpm', 'lookism41@vikas2.com', 0x62756b746920627961722e6a7067),
(200003, 'nita', 'lpm', 'saf@wgf', 0x65),
(32009853, 'cindy', 'lpm', 'adefitriaputri06122002@gmail.com', 0x53637265656e73686f745f5f32395f2d72656d6f766562672d707265766965772e706e67);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_ami`
--

CREATE TABLE `jadwal_ami` (
  `id_jadwal` int(11) NOT NULL,
  `nama_auditor` varchar(100) NOT NULL,
  `fakultas` varchar(100) NOT NULL,
  `prodi` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `nama`) VALUES
(1, 'auditee', 'ac7b19332cdf22ce60b441e35d31984e', 'auditee'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(3, 'auditor', '5cb59fe845b83231b0e5aa95d96267e9', 'auditor');

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `id_pelaksanaan` int(11) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `auditor` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `status` enum('Proses','Belum Selesai','Perbaikan') DEFAULT 'Proses'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaksanaan`
--

INSERT INTO `pelaksanaan` (`id_pelaksanaan`, `fakultas`, `prodi`, `auditor`, `keterangan`, `status`) VALUES
(1, 'fbi aja', 'Ilmu Komputer aja', 'x', 'x', 'Proses');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id_prodi` int(11) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `kaprodi` varchar(255) NOT NULL,
  `akreditasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gkm_ami`
--
ALTER TABLE `gkm_ami`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`id_pelaksanaan`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_ami`
--
ALTER TABLE `jadwal_ami`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `id_pelaksanaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodi`
--
ALTER TABLE `prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
