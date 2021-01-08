-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 09:08 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bac`
--

-- --------------------------------------------------------

--
-- Table structure for table `cats`
--

CREATE TABLE `cats` (
  `catid` int(6) NOT NULL,
  `name` varchar(60) NOT NULL,
  `gender` char(1) NOT NULL,
  `age` int(11) NOT NULL,
  `breed` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cats`
--

INSERT INTO `cats` (`catid`, `name`, `gender`, `age`, `breed`) VALUES
(113268, 'tortilla', 'M', 9, 'american shorthair'),
(343401, 'princess', 'F', 49, 'ragdoll'),
(423876, 'oreo', 'M', 11, 'american shorthair tuxedo'),
(666233, 'rory', 'M', 30, 'unknown'),
(885448, 'decibelle', 'F', 6, 'american shorthair tabby'),
(918237, 'toast', 'M', 14, 'bengal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cats`
--
ALTER TABLE `cats`
  ADD PRIMARY KEY (`catid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
