-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2021 at 07:15 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perijinan`
--

-- --------------------------------------------------------

--
-- Table structure for table `permohonan`
--

CREATE TABLE `permohonan` (
  `permohonan_id` int(11) NOT NULL,
  `penerima` varchar(40) NOT NULL,
  `pemohon` varchar(40) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `NIK` varchar(20) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `jenis_permohonan` enum('SIP','SIPP','SIPB') NOT NULL DEFAULT 'SIP',
  `status_peninjauan` enum('Ya','Tidak') NOT NULL DEFAULT 'Tidak',
  `status` enum('Diterima','Dikembalikan') NOT NULL DEFAULT 'Diterima',
  `diteruskan` enum('Kabid','Kasi Usaha','Non Usaha','Aris','Rifki') NOT NULL DEFAULT 'Kabid',
  `waktu` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proses` enum('Kabid','Kasi Usaha','Non Usaha','Aris','Rifki','Aris / Rifki') NOT NULL DEFAULT 'Aris / Rifki'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permohonan`
--
ALTER TABLE `permohonan`
  ADD PRIMARY KEY (`permohonan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permohonan`
--
ALTER TABLE `permohonan`
  MODIFY `permohonan_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
