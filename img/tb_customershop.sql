-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2021 at 11:02 AM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wc426mhf_uzoma`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_customershop`
--

CREATE TABLE `tb_customershop` (
  `num` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `pass` varchar(256) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `status_email` varchar(5) DEFAULT 'não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_customershop`
--

INSERT INTO `tb_customershop` (`num`, `name`, `email`, `pass`, `tel`, `country`, `province`, `city`, `address`, `date`, `state`, `status_email`) VALUES
(4, 'Sanders', 'dinhovatuva@gmail.com', '$2y$12$j3YZMgn8KsGFVSzIYKDsa.OeZfooAABo53eanzBst0ZExdW2rix8q', '991561655', '', '', '', '', NULL, 1, 'sim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_customershop`
--
ALTER TABLE `tb_customershop`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `tel_UNIQUE` (`tel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_customershop`
--
ALTER TABLE `tb_customershop`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
