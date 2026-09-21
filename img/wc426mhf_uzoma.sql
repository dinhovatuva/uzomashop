-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 23, 2021 at 11:09 AM
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
-- Table structure for table `tbcart_product`
--

CREATE TABLE `tbcart_product` (
  `num` int(11) NOT NULL,
  `cart` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `date_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` datetime DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcart_product`
--

INSERT INTO `tbcart_product` (`num`, `cart`, `product`, `description`, `price`, `amount`, `discount`, `date_begin`, `date_end`, `state`) VALUES
(1, 1, 4, 'Chamussa', 3500.00, 2, NULL, '2020-11-04 23:44:31', NULL, 1),
(2, 1, 2, 'produto de teste', 8000.00, 1, NULL, '2020-11-04 23:43:37', NULL, 0),
(3, 2, 2, 'produto de teste', 8000.00, 1, NULL, '2020-11-04 23:46:13', NULL, 1),
(4, 3, 4, 'Chamussa', 3500.00, 1, NULL, '2020-11-05 00:13:56', NULL, 1),
(5, 3, 2, 'produto de teste', 8000.00, 1, NULL, '2020-11-05 00:14:53', NULL, 1),
(6, 4, 4, 'Chamussa', 3500.00, 2, NULL, '2020-11-06 04:41:55', NULL, 1),
(7, 5, 6, 'TÃ©nis da Puma', 30000.00, 2, NULL, '2020-11-06 12:01:13', NULL, 1),
(8, 5, 2, 'MaÃ§Ã£', 8000.00, 1, NULL, '2020-11-06 12:01:22', NULL, 1),
(9, 6, 6, 'TÃ©nis da Puma', 30000.00, 3, NULL, '2020-11-06 12:03:24', NULL, 1),
(10, 6, 4, 'Chamussa', 3500.00, 3, NULL, '2020-11-06 12:03:33', NULL, 1),
(11, 7, 4, 'Chamussa', 3500.00, 1, NULL, '2020-11-06 13:51:20', NULL, 1),
(12, 8, 5, 'TÃ©nis da Adidas Stam Smith', 30000.00, 1, NULL, '2020-11-06 13:53:26', NULL, 1),
(13, 9, 6, 'TÃ©nis da Puma', 30000.00, 1, NULL, '2020-11-06 16:15:56', NULL, 1),
(14, 9, 5, 'TÃ©nis da Adidas Stam Smith', 30000.00, 1, NULL, '2020-11-06 16:16:26', NULL, 1),
(15, 10, 14, 'Banner', 5000.00, 7, NULL, '2020-11-29 11:56:29', NULL, 1),
(16, 10, 9, 'blazers', 90000.00, 1, NULL, '2020-11-29 11:57:20', NULL, 1),
(17, 11, 11, 'salto da Zara', 50000.00, 1, NULL, '2020-11-29 14:00:39', NULL, 1),
(18, 12, 11, 'salto da Zara', 50000.00, 1, NULL, '2021-02-13 18:09:54', NULL, 1),
(19, 13, 38, 'toca de cetim', 0.00, 1, NULL, '2021-02-13 18:09:55', NULL, 1),
(20, 14, 36, 'vestido preto transparente', 15000.00, 1, NULL, '2021-02-13 18:09:55', NULL, 1),
(21, 15, 37, 'vestido preto transparente', 15000.00, 1, NULL, '2021-02-13 18:09:56', NULL, 1),
(22, 16, 2, 'Navy Black (Zara)', 26000.00, 1, NULL, '2021-02-13 18:09:57', NULL, 1),
(23, 17, 35, 'vestido preto transparente', 15000.00, 1, NULL, '2021-02-13 18:09:57', NULL, 1),
(24, 18, 27, 'ChÃ¡vena branca', 1000.00, 1, NULL, '2021-02-13 18:09:58', NULL, 1),
(25, 19, 4, 'Warm Black (Zara)', 26000.00, 1, NULL, '2021-02-13 18:09:58', NULL, 1),
(26, 20, 33, 'Pasta', 25000.00, 1, NULL, '2021-02-13 18:09:59', NULL, 1),
(27, 21, 28, 'ChÃ¡vena branca', 1000.00, 1, NULL, '2021-02-13 18:10:00', NULL, 1),
(28, 22, 32, 'Chinelo', 15000.00, 1, NULL, '2021-02-13 18:10:00', NULL, 1),
(29, 23, 6, 'Holidaymood (Zara)', 15000.00, 1, NULL, '2021-02-13 18:10:01', NULL, 1),
(30, 24, 19, 'Fronha de cetim liso', 10000.00, 1, NULL, '2021-02-13 18:10:01', NULL, 1),
(31, 25, 31, 'Vestido', 20000.00, 1, NULL, '2021-02-13 18:10:02', NULL, 1),
(32, 26, 30, 'Vestido', 20000.00, 1, NULL, '2021-02-13 18:10:03', NULL, 1),
(33, 27, 20, 'Fronha de cetim liso', 10000.00, 1, NULL, '2021-02-13 18:10:03', NULL, 1),
(34, 28, 29, 'Vestido', 20000.00, 1, NULL, '2021-02-13 18:10:04', NULL, 1),
(35, 29, 14, 'kiko', 8500.00, 1, NULL, '2021-02-13 18:10:05', NULL, 1),
(36, 30, 21, 'Fronha de cetim liso', 10000.00, 1, NULL, '2021-02-13 18:10:05', NULL, 1),
(37, 31, 10, 'blazers', 50000.00, 1, NULL, '2021-02-13 18:10:06', NULL, 1),
(38, 32, 5, 'TÃ©nis da Adidas Stam Smith', 30000.00, 1, NULL, '2021-02-13 18:10:06', NULL, 1),
(39, 33, 22, 'Fronha de cetim liso', 10000.00, 1, NULL, '2021-02-13 18:10:07', NULL, 1),
(40, 34, 26, 'Lamina de silhouette', 30000.00, 1, NULL, '2021-02-13 18:10:08', NULL, 1),
(41, 35, 16, 'Stars Wars (Zara)', 13000.00, 1, NULL, '2021-02-13 18:10:08', NULL, 1),
(42, 36, 23, 'toca de cetim', 5000.00, 1, NULL, '2021-02-13 18:10:08', NULL, 1),
(43, 37, 34, 'toca de cetim', 5000.00, 1, NULL, '2021-02-13 18:10:09', NULL, 1),
(44, 38, 25, 'Base de silhouette', 60000.00, 1, NULL, '2021-02-13 18:10:10', NULL, 1),
(45, 39, 24, 'toca de cetim', 5000.00, 1, NULL, '2021-02-13 18:10:11', NULL, 1),
(46, 40, 15, 'Zara', 23000.00, 1, NULL, '2021-02-13 18:10:11', NULL, 1),
(47, 41, 9, 'blazers', 90000.00, 1, NULL, '2021-02-13 18:10:11', NULL, 1),
(48, 42, 18, 'Colher dourada', 3500.00, 1, NULL, '2021-02-13 18:10:12', NULL, 1),
(49, 43, 38, 'toca de cetim', 0.00, 1, NULL, '2021-02-15 17:46:01', NULL, 1),
(50, 43, 2, 'Navy Black (Zara)', 26000.00, 1, NULL, '2021-02-15 17:46:08', NULL, 1),
(51, 43, 6, 'Holidaymood (Zara)', 15000.00, 1, NULL, '2021-02-15 17:46:19', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog`
--

CREATE TABLE `tb_blog` (
  `num` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `author` varchar(60) NOT NULL,
  `introduction` mediumtext NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_blog_post`
--

CREATE TABLE `tb_blog_post` (
  `num` int(11) NOT NULL,
  `numblog` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `state` int(11) NOT NULL DEFAULT '1',
  `user` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tb_cart`
--

CREATE TABLE `tb_cart` (
  `num` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `date_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` datetime DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `global_discount` decimal(11,2) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `global_value` decimal(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_cart`
--

INSERT INTO `tb_cart` (`num`, `description`, `date_begin`, `date_end`, `customer`, `global_discount`, `hash`, `location`, `state`, `global_value`) VALUES
(1, 'Encomenda de produto', '2020-11-04 23:23:20', NULL, 0, NULL, NULL, NULL, 1, NULL),
(2, 'Encomenda de produto', '2020-11-04 23:46:13', NULL, 0, NULL, NULL, NULL, 1, NULL),
(3, 'Encomenda de produto', '2020-11-05 00:13:56', NULL, 0, NULL, NULL, NULL, 1, NULL),
(4, 'Encomenda de produto', '2020-11-06 05:01:46', '2020-11-06 06:01:52', 2, NULL, 'NCA3MDAwLjAwIDIwMjAtMTEtMDYgMDY6MDE6NTI=', NULL, 3, 7000.00),
(5, 'Encomenda de produto', '2020-11-06 12:01:06', NULL, 0, NULL, NULL, NULL, 1, NULL),
(6, 'Encomenda de produto', '2020-11-06 12:01:47', NULL, 0, NULL, NULL, NULL, 1, NULL),
(7, 'Encomenda de produto', '2020-11-06 13:51:20', '2020-11-06 01:52:26', 4, NULL, 'NyAzNTAwLjAwIDIwMjAtMTEtMDYgMDE6NTI6MjY=', NULL, 3, 3500.00),
(8, 'Encomenda de produto', '2020-11-06 13:53:26', NULL, 4, NULL, NULL, NULL, 1, NULL),
(9, 'Encomenda de produto', '2020-11-06 16:15:56', NULL, 0, NULL, NULL, NULL, 1, NULL),
(10, 'Encomenda de produto', '2020-11-29 11:38:30', NULL, 0, NULL, NULL, NULL, 1, NULL),
(11, 'Encomenda de produto', '2020-11-29 14:00:39', NULL, 0, NULL, NULL, NULL, 1, NULL),
(12, 'Encomenda de produto', '2021-02-13 18:09:54', NULL, 0, NULL, NULL, NULL, 1, NULL),
(13, 'Encomenda de produto', '2021-02-13 18:09:55', NULL, 0, NULL, NULL, NULL, 1, NULL),
(14, 'Encomenda de produto', '2021-02-13 18:09:55', NULL, 0, NULL, NULL, NULL, 1, NULL),
(15, 'Encomenda de produto', '2021-02-13 18:09:56', NULL, 0, NULL, NULL, NULL, 1, NULL),
(16, 'Encomenda de produto', '2021-02-13 18:09:57', NULL, 0, NULL, NULL, NULL, 1, NULL),
(17, 'Encomenda de produto', '2021-02-13 18:09:57', NULL, 0, NULL, NULL, NULL, 1, NULL),
(18, 'Encomenda de produto', '2021-02-13 18:09:58', NULL, 0, NULL, NULL, NULL, 1, NULL),
(19, 'Encomenda de produto', '2021-02-13 18:09:58', NULL, 0, NULL, NULL, NULL, 1, NULL),
(20, 'Encomenda de produto', '2021-02-13 18:09:59', NULL, 0, NULL, NULL, NULL, 1, NULL),
(21, 'Encomenda de produto', '2021-02-13 18:10:00', NULL, 0, NULL, NULL, NULL, 1, NULL),
(22, 'Encomenda de produto', '2021-02-13 18:10:00', NULL, 0, NULL, NULL, NULL, 1, NULL),
(23, 'Encomenda de produto', '2021-02-13 18:10:01', NULL, 0, NULL, NULL, NULL, 1, NULL),
(24, 'Encomenda de produto', '2021-02-13 18:10:01', NULL, 0, NULL, NULL, NULL, 1, NULL),
(25, 'Encomenda de produto', '2021-02-13 18:10:02', NULL, 0, NULL, NULL, NULL, 1, NULL),
(26, 'Encomenda de produto', '2021-02-13 18:10:03', NULL, 0, NULL, NULL, NULL, 1, NULL),
(27, 'Encomenda de produto', '2021-02-13 18:10:03', NULL, 0, NULL, NULL, NULL, 1, NULL),
(28, 'Encomenda de produto', '2021-02-13 18:10:04', NULL, 0, NULL, NULL, NULL, 1, NULL),
(29, 'Encomenda de produto', '2021-02-13 18:10:05', NULL, 0, NULL, NULL, NULL, 1, NULL),
(30, 'Encomenda de produto', '2021-02-13 18:10:05', NULL, 0, NULL, NULL, NULL, 1, NULL),
(31, 'Encomenda de produto', '2021-02-13 18:10:06', NULL, 0, NULL, NULL, NULL, 1, NULL),
(32, 'Encomenda de produto', '2021-02-13 18:10:06', NULL, 0, NULL, NULL, NULL, 1, NULL),
(33, 'Encomenda de produto', '2021-02-13 18:10:07', NULL, 0, NULL, NULL, NULL, 1, NULL),
(34, 'Encomenda de produto', '2021-02-13 18:10:08', NULL, 0, NULL, NULL, NULL, 1, NULL),
(35, 'Encomenda de produto', '2021-02-13 18:10:08', NULL, 0, NULL, NULL, NULL, 1, NULL),
(36, 'Encomenda de produto', '2021-02-13 18:10:08', NULL, 0, NULL, NULL, NULL, 1, NULL),
(37, 'Encomenda de produto', '2021-02-13 18:10:09', NULL, 0, NULL, NULL, NULL, 1, NULL),
(38, 'Encomenda de produto', '2021-02-13 18:10:10', NULL, 0, NULL, NULL, NULL, 1, NULL),
(39, 'Encomenda de produto', '2021-02-13 18:10:11', NULL, 0, NULL, NULL, NULL, 1, NULL),
(40, 'Encomenda de produto', '2021-02-13 18:10:11', NULL, 0, NULL, NULL, NULL, 1, NULL),
(41, 'Encomenda de produto', '2021-02-13 18:10:11', NULL, 0, NULL, NULL, NULL, 1, NULL),
(42, 'Encomenda de produto', '2021-02-13 18:10:12', NULL, 0, NULL, NULL, NULL, 1, NULL),
(43, 'Encomenda de produto', '2021-02-15 17:46:01', NULL, 0, NULL, NULL, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `num` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `address` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `state` int(11) NOT NULL DEFAULT '1',
  `mission` longtext,
  `vision` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`num`, `name`, `address`, `img`, `state`, `mission`, `vision`) VALUES
(1, 'Uzoma shop', 'Luanda - Angola', 'img/210914463720201104013401.png', 1, 'Tornar mais fÃ¡cil e descontraÃ­do a forma como as pessoas fazem o comÃ©rcio de produtos.\r\nContribuir para o desenvolvimento de uma comercializaÃ§Ã£o mais sustentÃ¡vel e diversificada,\r\npotencializando o escoamento de produtos, nacional e internacionalmente.\r\n \r\n', 'Ser a maior plataforma de Compra & Venda de produtos.\r\n \r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tb_company_contact`
--

CREATE TABLE `tb_company_contact` (
  `num` int(11) NOT NULL,
  `description` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_company_contact`
--

INSERT INTO `tb_company_contact` (`num`, `description`, `contact`, `state`) VALUES
(6, 'tel', '931313140', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_company_value`
--

CREATE TABLE `tb_company_value` (
  `num` int(11) NOT NULL,
  `value` varchar(60) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `tb_gallery`
--

CREATE TABLE `tb_gallery` (
  `num` int(11) NOT NULL,
  `description` varchar(60) COLLATE utf8_bin NOT NULL,
  `img` varchar(256) COLLATE utf8_bin NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext COLLATE utf8_bin,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tb_gallery`
--

INSERT INTO `tb_gallery` (`num`, `description`, `img`, `note`, `state`, `date`, `user`) VALUES
(2, 'Novo Game Boy', 'img/novidades/126919347020201106101537.png', 'Já foi lançado o novo game boy', 1, '2020-11-06 10:15:37', 'admin'),
(3, 'Iphone 11 Pro ', 'img/novidades/125402083020201106102457.png', '', 1, '2020-11-06 10:24:57', 'admin'),
(4, 'LG Led Smart', 'img/novidades/4881574320201106102637.png', '', 1, '2020-11-06 10:26:37', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_msg`
--

CREATE TABLE `tb_msg` (
  `num` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL,
  `note` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_msg`
--

INSERT INTO `tb_msg` (`num`, `name`, `nickname`, `email`, `tel`, `subject`, `note`, `date`, `state`) VALUES
(5, 'teste', ' ', 'aa@gmai', '741', 'asd', '141', '2020-05-24 23:39:04', 1),
(6, 'teste', ' ', 'aa@gmai', '741', '', '141', '2020-05-24 23:55:50', 1),
(7, 'teste', ' ', 'aa@gmai', '741', 'asd', '141', '2020-05-25 00:01:59', 1),
(8, 'teste', NULL, 'mvcontech@gmail.com', '745658', 'assd', 'asd', '2020-07-07 06:39:05', 1),
(9, 'Adolfo Vatuva - 940302546', NULL, 'dinhovatuva@gmail.com', '940302546', 'Encomenda de Produtos', '', '2020-11-06 04:55:47', 1),
(10, 'Adolfo Vatuva - 940302546', NULL, 'dinhovatuva@gmail.com', '940302546', 'Encomenda de Produtos', '', '2020-11-06 04:57:05', 1),
(11, 'Adolfo Vatuva - 940302546', NULL, 'dinhovatuva@gmail.com', '940302546', 'Encomenda de Produtos', '', '2020-11-06 05:01:52', 1),
(12, 'Sanders - 991561655', NULL, 'dinhovatuva@gmail.com', '991561655', 'Encomenda de Produtos', 'Produto: Chamussa - Qtd: 1 PreÃ§o: 3500.00AKZ </td></tr>', '2020-11-06 13:52:26', 1),
(13, 'Eric', NULL, 'eric.jones.z.mail@gmail.com', '555-555-1212', 'Try this, get more leads', 'Hi, my name is Eric and Iâ€™m betting youâ€™d like your website uzomashop.com to generate more leads.\r\n\r\nHereâ€™s how:\r\nTalk With Web Visitor is a software widget thatâ€™s works on your site, ready to capture any visitorâ€™s Name, Email address and Phone Number.  It signals you as soon as they say theyâ€™re interested â€“ so that you can talk to that lead while theyâ€™re still there at uzomashop.com.\r\n\r\nTalk With Web Visitor â€“ CLICK HERE https://talkwithwebvisitors.com for a live demo now.\r\n\r\nAnd now that youâ€™ve got their phone number, our new SMS Text With Lead feature enables you to start a text (SMS) conversation â€“ answer questions, provide more info, and close a deal that way.\r\n\r\nIf they donâ€™t take you up on your offer then, just follow up with text messages for new offers, content links, even just â€œhow you doing?â€ notes to build a relationship.\r\n\r\nCLICK HERE https://talkwithwebvisitors.com to discover what Talk With Web Visitor can do for your business.\r\n\r\nThe difference between contacting someone within 5 minutes versus a half-hour means you could be converting up to 100X more leads today!\r\n\r\nTry Talk With Web Visitor and get more leads now.\r\n\r\nEric\r\nPS: The studies show 7 out of 10 visitors donâ€™t hang around â€“ you canâ€™t afford to lose them!\r\nTalk With Web Visitor offers a FREE 14 days trial â€“ and it even includes International Long Distance Calling. \r\nYou have customers waiting to talk with you right nowâ€¦ donâ€™t keep them waiting. \r\nCLICK HERE https://talkwithwebvisitors.com to try Talk With Web Visitor now.\r\n\r\nIf you\'d like to unsubscribe click here http://talkwithwebvisitors.com/unsubscribe.aspx?d=uzomashop.com\r\n', '2021-02-18 10:35:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_newsletter`
--

CREATE TABLE `tb_newsletter` (
  `num` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_newsletter`
--

INSERT INTO `tb_newsletter` (`num`, `email`, `date`, `state`) VALUES
(1, 'dinhovatuva@gmail.com', '2020-11-02 18:57:47', 1),
(3, 'asd@gmail.com', '2020-11-17 15:10:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_partner`
--

CREATE TABLE `tb_partner` (
  `num` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_partner`
--

INSERT INTO `tb_partner` (`num`, `name`, `img`, `note`, `state`, `date`, `user`) VALUES
(3, 'Adoane', 'img/sem imagem.jpg', 'Sempre a subir', 1, '2020-11-04 02:31:11', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `num` int(11) NOT NULL,
  `description` varchar(120) NOT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext,
  `state` int(11) NOT NULL DEFAULT '1',
  `category` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL,
  `obs` varchar(60) DEFAULT NULL,
  `un` varchar(45) DEFAULT NULL,
  `discount` decimal(11,2) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`num`, `description`, `price`, `img`, `note`, `state`, `category`, `date`, `user`, `obs`, `un`, `discount`, `click`, `views`, `stars`) VALUES
(2, 'Navy Black (Zara)', 26000.00, 'img/produtos/92746874820201203134532.png', 'FaÃ§a jÃ¡ a sua compra                                                                                                         ', 1, 10, '2020-12-03 14:12:40', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(4, 'Warm Black (Zara)', 26000.00, 'img/produtos/198352646020201203135334.png', 'FaÃ§a jÃ¡ a sua compra                                                      ', 1, 10, '2020-12-03 13:53:34', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(5, 'TÃ©nis da Adidas Stam Smith', 30000.00, 'img/produtos/160547657420201106101151.png', 'Tamanhos 40, 41 e 42   Cor branca e cor preta                ', 1, 8, '2020-11-17 15:34:20', 'admin', NULL, 'un', 0.00, NULL, NULL, 4),
(6, 'Holidaymood (Zara)', 15000.00, 'img/produtos/110293717120201203140522.png', 'FaÃ§a jÃ¡ a sua compra', 1, 10, '2020-12-03 14:05:22', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(9, 'blazers', 90000.00, 'img/produtos/183792331620201224133812.png', ' tamanho M                                                               ', 1, 5, '2020-12-24 13:38:12', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(10, 'blazers', 50000.00, 'img/produtos/90485615120201224133750.png', '                ', 1, 5, '2020-12-24 13:37:50', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(11, 'salto da Zara', 50000.00, 'img/produtos/138934874820201117163734.png', 'tamanho  37 38 40                                                ', 1, 8, '2020-12-03 13:46:36', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(14, 'kiko', 8500.00, 'img/produtos/37388035220201203134133.png', 'FaÃ§a jÃ¡ a sua compra                ', 1, 10, '2020-12-03 13:41:33', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(15, 'Zara', 23000.00, 'img/produtos/185208550920201203124350.png', '                                ', 1, 10, '2020-12-03 14:14:23', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(16, 'Stars Wars (Zara)', 13000.00, 'img/produtos/196800628020201203141004.png', 'FaÃ§a jÃ¡ a sua compra', 1, 10, '2020-12-03 14:10:04', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(18, 'Colher dourada', 3500.00, 'img/produtos/105287682220201224131328.png', '', 1, 12, '2020-12-24 13:13:28', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(19, 'Fronha de cetim liso', 10000.00, 'img/produtos/110740551020210113145428.png', '  2 fronhas de cetim rosa pink                                         ', 1, 13, '2021-01-13 15:01:38', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(20, 'Fronha de cetim liso', 10000.00, 'img/produtos/96705899320210113151204.png', '2 fronhas de cetim branco             ', 1, 13, '2021-01-13 15:12:04', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(21, 'Fronha de cetim liso', 10000.00, 'img/produtos/210572069120210113145808.png', '2 fronhas de cetim rosa magnÃ©tico                 ', 1, 13, '2021-01-13 15:02:16', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(22, 'Fronha de cetim liso', 10000.00, 'img/produtos/29986451620210113150623.png', '2 fronhas de cetim preto', 1, 13, '2021-01-13 15:06:23', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(23, 'toca de cetim', 5000.00, 'img/produtos/198899914220210113154551.png', 'Toca de cetim branco                ', 1, 15, '2021-01-13 15:46:40', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(24, 'toca de cetim', 5000.00, 'img/produtos/94763965020210113154333.png', 'Toca de cetim rosa magnÃ©tico                            ', 1, 15, '2021-01-13 15:44:43', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(25, 'Base de silhouette', 60000.00, 'img/produtos/12716704420210113173344.png', 'Base grande de silhouette 30x60', 1, 16, '2021-01-13 17:33:44', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(26, 'Lamina de silhouette', 30000.00, 'img/produtos/150848194520210113173611.png', 'Lamina manual de silhouette                ', 1, 16, '2021-01-13 17:36:11', 'admin', NULL, 'un', 0.00, NULL, NULL, 5),
(27, 'ChÃ¡vena branca', 1000.00, 'img/produtos/71881781420210114134548.png', 'ChÃ¡vena branca', 1, 12, '2021-01-14 13:45:48', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(28, 'ChÃ¡vena branca', 1000.00, 'img/produtos/112170531820210114144004.png', 'ChÃ¡vena branca', 1, 12, '2021-01-14 14:40:04', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(29, 'Vestido', 20000.00, 'img/produtos/35595654420210114182545.png', 'Vestido', 1, 5, '2021-01-14 18:25:45', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(30, 'Vestido', 20000.00, 'img/produtos/128399794220210114192426.png', '', 1, 5, '2021-01-14 19:24:26', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(31, 'Vestido', 20000.00, 'img/produtos/1075996120210114192454.png', '', 1, 5, '2021-01-14 19:24:54', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(32, 'Chinelo', 15000.00, 'img/produtos/146579717220210114192636.png', '', 1, 5, '2021-01-14 19:26:36', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(33, 'Pasta', 25000.00, 'img/produtos/67781337220210114192729.png', '', 1, 5, '2021-01-14 19:27:29', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(34, 'toca de cetim', 5000.00, 'img/produtos/145166285720210115190357.png', '', 1, 15, '2021-01-15 19:03:57', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(35, 'vestido preto transparente', 15000.00, 'img/produtos/110302763320210116213934.png', '', 1, 5, '2021-01-16 21:39:34', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(36, 'vestido preto transparente', 15000.00, 'img/sem imagem.jpg', '', 1, 5, '2021-01-16 21:33:00', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(37, 'vestido preto transparente', 15000.00, 'img/sem imagem.jpg', '', 1, 5, '2021-01-16 21:33:01', 'admin', NULL, 'un', 0.00, NULL, NULL, 3),
(38, 'toca de cetim', 0.00, 'img/produtos/154307028220210212145126.png', '', 1, 5, '2021-02-12 14:51:26', 'admin', NULL, 'un', 0.00, NULL, NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_category`
--

CREATE TABLE `tb_product_category` (
  `num` int(11) NOT NULL,
  `category` varchar(30) NOT NULL,
  `user` varchar(30) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `img` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product_category`
--

INSERT INTO `tb_product_category` (`num`, `category`, `user`, `state`, `img`) VALUES
(5, 'Roupa ', 'admin', 1, NULL),
(7, 'AlimentaÃ§Ã£o', 'admin', 1, NULL),
(8, 'sapatos', 'admin', 1, NULL),
(9, 'Vinho', 'admin', 1, NULL),
(10, 'CosmÃ©ticos', 'admin', 1, NULL),
(11, 'perfumes', 'admin', 1, NULL),
(12, 'Cozinha', 'admin', 1, NULL),
(13, 'Roupa de cama', 'admin', 1, NULL),
(14, 'Casa e sala', 'admin', 1, NULL),
(15, 'toca de cetim', 'admin', 1, NULL),
(16, 'acessÃ³rios', 'admin', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product_img`
--

CREATE TABLE `tb_product_img` (
  `num` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product_img`
--

INSERT INTO `tb_product_img` (`num`, `product`, `img`) VALUES
(1, 2, 'img/produtos/10738992120201104033844.png'),
(3, 2, 'img/sem imagem.jpg'),
(4, 5, 'img/produtos/175386122220201106103825.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_slide`
--

CREATE TABLE `tb_slide` (
  `num` int(11) NOT NULL,
  `description` varchar(60) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_slide`
--

INSERT INTO `tb_slide` (`num`, `description`, `img`, `note`, `state`, `date`, `user`) VALUES
(9, 'UZOMA', 'img/slide/78124982820201129174120.png', NULL, 1, '2020-11-29 17:41:20', 'admin'),
(11, 'UZOMA', 'img/slide/192865759620201201153130.png', NULL, 1, '2020-12-01 15:31:30', 'admin'),
(14, 'UZOMA', 'img/slide/88313507920201201152722.png', NULL, 1, '2020-12-01 15:27:22', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `num` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`num`, `name`, `user`, `password`, `email`, `tel`, `state`) VALUES
(1, 'Administrador', 'admin', '$2y$12$uK4xG54P5nXgC1CpuXSJgetmgn5IjEfOIg0RgvfjFNu2WN35hTdaq', 'admin@mail.com', '999999', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbcart_product`
--
ALTER TABLE `tbcart_product`
  ADD PRIMARY KEY (`num`),
  ADD KEY `cartproduct_idx` (`cart`),
  ADD KEY `productproduct_idx` (`product`);

--
-- Indexes for table `tb_blog`
--
ALTER TABLE `tb_blog`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_blog_post`
--
ALTER TABLE `tb_blog_post`
  ADD PRIMARY KEY (`num`),
  ADD KEY `fk_blog_idx` (`numblog`);

--
-- Indexes for table `tb_cart`
--
ALTER TABLE `tb_cart`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_company_contact`
--
ALTER TABLE `tb_company_contact`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_company_value`
--
ALTER TABLE `tb_company_value`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_customershop`
--
ALTER TABLE `tb_customershop`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `tel_UNIQUE` (`tel`);

--
-- Indexes for table `tb_gallery`
--
ALTER TABLE `tb_gallery`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_msg`
--
ALTER TABLE `tb_msg`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_newsletter`
--
ALTER TABLE `tb_newsletter`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `tb_partner`
--
ALTER TABLE `tb_partner`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`num`),
  ADD KEY `fk_kklggf_idx` (`category`);

--
-- Indexes for table `tb_product_category`
--
ALTER TABLE `tb_product_category`
  ADD PRIMARY KEY (`num`,`category`),
  ADD UNIQUE KEY `category_UNIQUE` (`category`);

--
-- Indexes for table `tb_product_img`
--
ALTER TABLE `tb_product_img`
  ADD PRIMARY KEY (`num`),
  ADD KEY `fk_img_product_idx` (`product`);

--
-- Indexes for table `tb_slide`
--
ALTER TABLE `tb_slide`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`num`),
  ADD UNIQUE KEY `user_UNIQUE` (`user`),
  ADD UNIQUE KEY `tel_UNIQUE` (`tel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbcart_product`
--
ALTER TABLE `tbcart_product`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `tb_blog`
--
ALTER TABLE `tb_blog`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_blog_post`
--
ALTER TABLE `tb_blog_post`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_cart`
--
ALTER TABLE `tb_cart`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_company`
--
ALTER TABLE `tb_company`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_company_contact`
--
ALTER TABLE `tb_company_contact`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_company_value`
--
ALTER TABLE `tb_company_value`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_customershop`
--
ALTER TABLE `tb_customershop`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_gallery`
--
ALTER TABLE `tb_gallery`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_msg`
--
ALTER TABLE `tb_msg`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_newsletter`
--
ALTER TABLE `tb_newsletter`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_partner`
--
ALTER TABLE `tb_partner`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_product_category`
--
ALTER TABLE `tb_product_category`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tb_product_img`
--
ALTER TABLE `tb_product_img`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_slide`
--
ALTER TABLE `tb_slide`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbcart_product`
--
ALTER TABLE `tbcart_product`
  ADD CONSTRAINT `cartproduct` FOREIGN KEY (`cart`) REFERENCES `tb_cart` (`num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `productproduct` FOREIGN KEY (`product`) REFERENCES `tb_product` (`num`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tb_blog_post`
--
ALTER TABLE `tb_blog_post`
  ADD CONSTRAINT `fk_blog` FOREIGN KEY (`numblog`) REFERENCES `tb_blog` (`num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD CONSTRAINT `fk_kklggf` FOREIGN KEY (`category`) REFERENCES `tb_product_category` (`num`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_product_img`
--
ALTER TABLE `tb_product_img`
  ADD CONSTRAINT `fk_img_product` FOREIGN KEY (`product`) REFERENCES `tb_product` (`num`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
