-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 04:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `koperasi1`
--

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_pemasukan` int(11) NOT NULL,
  `tgl_pemasukan` date NOT NULL,
  `jumlah` int(30) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `harga_satuan` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_pemasukan`, `tgl_pemasukan`, `jumlah`, `id_sumber`, `nama`, `jumlah_item`, `harga_satuan`) VALUES
(3, '2022-06-15', 150000, 2, 'Topi', 10, 15000),
(6, '2022-06-15', 1000000, 1, 'Seragam Sekolah Putih Biru', 10, 100000),
(11, '2022-06-16', 600000, 5, 'Seragam Pencak Silat', 5, 120000),
(12, '2022-06-18', 800000, 3, 'Seragam Paskibra', 2, 400000),
(21, '2022-07-06', 1500000, 1, 'Seragam Sekolah Putih Biru', 15, 100000),
(26, '2022-07-07', 360000, 5, 'Seragam Pencak Silat', 3, 120000),
(71, '2022-07-07', 640000, 6, 'Seragam Olah Raga', 8, 80000),
(74, '2022-07-29', 105000, 2, 'Topi', 7, 15000),
(76, '2022-07-31', 400000, 3, 'Seragam Paskibra', 1, 400000),
(77, '2022-08-01', 400000, 3, 'Seragam Paskibra', 1, 400000),
(78, '2022-08-02', 160000, 6, 'Seragam Olah Raga', 2, 80000),
(81, '2022-08-02', 60000, 2, 'Seragam Sekolah Putih Biru', 4, 15000),
(82, '2022-08-05', 150000, 2, 'Topi', 10, 15000);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `jumlah` int(30) NOT NULL,
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `jumlah_item` int(11) NOT NULL,
  `harga_satuan` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `tgl_pengeluaran`, `jumlah`, `id_sumber`, `nama`, `jumlah_item`, `harga_satuan`) VALUES
(39, '2022-07-21', 2000000, 7, 'Pengeluaran Seragam Sekolah Putih Biru', 25, 80000),
(40, '2022-08-05', 1700000, 12, 'Pengeluaran Seragam Olah Raga', 20, 85000),
(41, '2022-08-06', 1875000, 11, 'Pengeluaran Seragam Pencak Silat', 15, 125000);

-- --------------------------------------------------------

--
-- Table structure for table `sumber`
--

CREATE TABLE `sumber` (
  `id_sumber` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sumber`
--

INSERT INTO `sumber` (`id_sumber`, `nama`) VALUES
(1, 'Seragam Sekolah Putih Biru'),
(2, 'Topi'),
(3, 'Seragam Paskibra'),
(4, 'Perlengkapan Kelas'),
(5, 'Seragam Pencak Silat'),
(6, 'Seragam Olah Raga'),
(7, 'Pengeluaran Seragam Sekolah Putih Biru'),
(8, 'Pengeluaran Topi'),
(9, 'Pengeluaran Seragam Paskibra'),
(10, 'Pengeluaran Perlengkapan Kelas'),
(11, 'Pengeluaran Seragam Pencak Silat'),
(12, 'Pengeluaran Seragam Olah Raga');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `level` enum('admin','anggota') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'ujang', '123', 'anggota'),
(8, 'Tarno', 'tarno', 'admin'),
(10, 'joko', 'joko', 'admin'),
(13, 'suparman', 'suparman', 'anggota'),
(14, 'firman', 'firman', 'anggota');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_pemasukan`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_sumber` (`id_sumber`);

--
-- Indexes for table `sumber`
--
ALTER TABLE `sumber`
  ADD PRIMARY KEY (`id_sumber`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemasukan`
--
ALTER TABLE `pemasukan`
  MODIFY `id_pemasukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sumber`
--
ALTER TABLE `sumber`
  MODIFY `id_sumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD CONSTRAINT `pemasukan_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_sumber`) REFERENCES `sumber` (`id_sumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
