-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2025 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konser`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'harits', 'harits'),
(3, 'jasmine', 'jasmine');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama`, `email`, `no_telp`, `password`) VALUES
(3, 'contoh', 'contoh@gmail.com', '081234567890', '1234'),
(4, 'contoh22', 'contoh2@gmail.com', '081234567892', '12345'),
(5, 'Example', 'example@gmail.com', '123456789', '1234'),
(6, 'ganes', 'ganes@gmail.com', '000000000', 'heritage');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `tgl_pembelian` datetime NOT NULL DEFAULT current_timestamp(),
  `kategori` varchar(50) NOT NULL,
  `jml_tiket` int(11) NOT NULL,
  `metode_pembayaran` varchar(20) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `jml_per_tiket` varchar(20) NOT NULL,
  `harga_per_tiket` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `tgl_pembelian`, `kategori`, `jml_tiket`, `metode_pembayaran`, `id_pembeli`, `total_price`, `jml_per_tiket`, `harga_per_tiket`, `status`) VALUES
(10, '2024-11-14 13:52:03', 'Silver, Festival, Gold, Platinum', 6, 'Credit Card', 4, 5775000, '1, 2, 2, 1', '500000, 750000, 1000000, 1250000', 'pending'),
(11, '2024-11-14 14:15:46', 'Platinum', 1, 'Bank Transfer', 4, 1375000, '1', '1250000', 'accepted'),
(12, '2024-11-15 09:25:43', 'Silver, Gold, Platinum', 5, 'E-Wallet', 4, 4950000, '2, 1, 2', '500000, 1000000, 1250000', 'pending'),
(13, '2024-11-15 09:38:34', 'Festival, Gold', 5, 'Bank Transfer', 3, 4950000, '2, 3', '750000, 1000000', 'pending'),
(14, '2024-11-15 09:50:34', 'Silver, Gold', 3, 'Bank Transfer', 3, 2200000, '2, 1', '500000, 1000000', 'pending'),
(15, '2024-11-15 09:52:07', 'Silver', 1, 'E-Wallet', 3, 550000, '1', '500000', 'accepted'),
(16, '2024-11-15 09:53:30', 'Silver, Festival, Gold, Platinum', 7, 'Bank Transfer', 3, 7425000, '1, 2, 1, 3', '500000, 750000, 1000000, 1250000', 'pending'),
(17, '2024-11-19 00:23:00', 'Silver, Festival, Gold, Platinum', 6, 'Bank Transfer', 3, 5775000, '2, 1, 1, 2', '500000, 750000, 1000000, 1250000', 'pending'),
(18, '2024-11-19 14:28:51', 'Silver, Festival, Gold, Platinum', 6, 'Bank Transfer', 5, 5775000, '2, 1, 1, 2', '500000, 750000, 1000000, 1250000', 'accepted'),
(19, '2024-11-28 19:05:26', 'Silver, Platinum', 7, 'E-Wallet', 6, 7975000, '2, 5', '500000, 1250000', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiket`
--

INSERT INTO `tiket` (`id_tiket`, `kategori`, `harga`) VALUES
(1, 'silver', 500000),
(2, 'festival', 750000),
(3, 'gold', 1000000),
(4, 'platinum', 1250000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tiket`
--
ALTER TABLE `tiket`
  MODIFY `id_tiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id_pembeli`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
