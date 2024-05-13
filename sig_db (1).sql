-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 09:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sig_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_jalan`
--

CREATE TABLE `data_jalan` (
  `id` int(200) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `latitude` varchar(25) NOT NULL,
  `longitude` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `foto` varchar(50) NOT NULL,
  `kondisi_jalan` varchar(15) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_jalan`
--

INSERT INTO `data_jalan` (`id`, `id_user`, `id_kabupaten`, `tanggal`, `alamat`, `latitude`, `longitude`, `keterangan`, `foto`, `kondisi_jalan`, `status`) VALUES
(37, 2, 4, '2024-05-02 03:15:00', 'NGGAMPING sleeee', '-7.8221645561739575', '110.34290313720703', 'BEGAL TETE tan', '912901121_', 'rusak berat', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kabupaten`
--

CREATE TABLE `kabupaten` (
  `id_kabupaten` int(200) NOT NULL,
  `nm_kab` varchar(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kabupaten`
--

INSERT INTO `kabupaten` (`id_kabupaten`, `nm_kab`) VALUES
(1, 'sleman'),
(2, 'bantul'),
(3, 'kodya'),
(4, 'gunung kidul'),
(5, 'kulon progo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(200) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(250) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `level`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 'admin'),
(7, 'gagasanda@gmail.com', 'ce0f6c28b5869ff166714da5fe08554c70c731a335ff9702e38b00f81ad348c6', 'Gagas Sanda', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_jalan`
--
ALTER TABLE `data_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kabupaten`
--
ALTER TABLE `kabupaten`
  ADD PRIMARY KEY (`id_kabupaten`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_jalan`
--
ALTER TABLE `data_jalan`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
