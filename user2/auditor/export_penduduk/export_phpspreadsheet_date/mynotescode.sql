-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2020 at 06:04 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mynotescode`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `barang` varchar(100) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` double NOT NULL,
  `tgl` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `kode`, `barang`, `jumlah`, `total_harga`, `tgl`) VALUES
(1, 'T0004', 'Mouse Wireless Logitech', 2, 330000, '2018-07-09 10:23:00'),
(2, 'T0005', 'Meja Laptop Portable', 5, 490000, '2018-07-11 14:48:00'),
(3, 'T0006', 'Tas Laptop Sleeve Cast', 3, 237000, '2018-07-17 16:02:00'),
(4, 'T0007', 'Cooler Master X-LITE II', 1, 265000, '2018-07-17 19:32:00'),
(5, 'T0008', 'Vacuum Cooler Taffware', 10, 1820000, '2018-08-01 13:10:00'),
(6, 'T0009', 'Keyboard Notebook for Wireless', 1, 150000, '2018-08-05 18:13:00'),
(7, 'T0010', 'Baterai Asus X450CA', 1, 650000, '2018-08-12 17:06:00'),
(8, 'T0001', 'Cooler Master X-LITE II', 1, 265000, '2017-10-09 11:00:00'),
(9, 'T0002', 'Meja Laptop Portable', 2, 196000, '2017-10-20 14:18:00'),
(10, 'T0003', 'Keyboard Notebook for Wireless', 2, 300000, '2017-11-15 15:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
