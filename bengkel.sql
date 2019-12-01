-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2019 at 04:01 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bengkel`
--

CREATE TABLE `bengkel` (
  `id` int(11) NOT NULL,
  `nama_bengkel` varchar(255) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bengkel`
--

INSERT INTO `bengkel` (`id`, `nama_bengkel`, `pemilik`, `hp`, `lat`, `lng`) VALUES
(1, '', '', '', -8.646673, 115.173035),
(2, 'wigun', 'arat', '04578457', 28.645332, 77.215408),
(3, 'benkel sejahtera', '', '', 0.000000, 0.000000),
(4, 'bengkel sejahtera', 'arta', '08432672634', 28.645445, 77.215919),
(5, 'asdasd', 'asdasd', 'asdasd', 28.645351, 77.216148),
(6, 'asdasd', 'asdasd', '6456456', 28.645756, 77.216148),
(7, 'argas', 'asas', 'aad', 28.645557, 77.215858),
(8, 'wiguna', 'wiguna', '07548357', 28.645576, 77.214996),
(9, 'art', 'arta', '4363745', -8.651396, 115.161438),
(10, 'tes', 'tes', '4763475', 28.645079, 77.215225),
(11, 'wwkwk', 'wkkwkw', '33274', 28.645464, 77.215538),
(12, 'asdasd', 'adsads', '67567', 28.644522, 77.216820),
(13, 'asdasd', 'asdasd', '4324543', 28.644871, 77.217545),
(14, 'asdasd', 'asdsd', '3425', 28.644627, 77.217453),
(15, 'asdsa', 'asdas', 'asdasd', 28.645830, 77.216187),
(16, 'asd', 'asdasd', 'asdasd', 28.644672, 77.220093),
(17, 'asd', 'asdasda', 'asdasd', 28.645124, 77.218819),
(18, 'asdasd', 'asdasd', 'asdasd', 28.644909, 77.218346),
(19, 'asdasd', 'asda', 'asdsda', 28.645067, 77.217926),
(20, 'adsa', 'asdasd', 'asdasd', 28.645370, 77.218948),
(21, 'adsads', 'asdasd', 'asdasd', 28.645426, 77.216911),
(22, 'asdasd', 'asda', 'asd', 28.645342, 77.218140),
(23, 'arat', 'arta', '45435435', -8.584524, 115.135933);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `lat`, `lng`) VALUES
(1, -8.646673, 115.173035),
(2, 28.645830, 77.216621),
(3, -8.606809, 115.183990),
(4, 28.645220, 77.217415),
(5, 28.644117, 77.217422);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bengkel`
--
ALTER TABLE `bengkel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bengkel`
--
ALTER TABLE `bengkel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
