-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: uzomashop
-- ------------------------------------------------------
-- Server version	5.5.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_blog`
--

DROP TABLE IF EXISTS `tb_blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_blog` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `author` varchar(60) NOT NULL,
  `introduction` mediumtext NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_blog`
--

LOCK TABLES `tb_blog` WRITE;
/*!40000 ALTER TABLE `tb_blog` DISABLE KEYS */;
INSERT INTO `tb_blog` VALUES (2,'Tituloo','img/clientes/26707525520200922170219.png','autorr','introdução',1,'2020-09-22 15:02:19','admin');
/*!40000 ALTER TABLE `tb_blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_blog_post`
--

DROP TABLE IF EXISTS `tb_blog_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_blog_post` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `numblog` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `state` int(11) NOT NULL DEFAULT '1',
  `user` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`num`),
  KEY `fk_blog_idx` (`numblog`),
  CONSTRAINT `fk_blog` FOREIGN KEY (`numblog`) REFERENCES `tb_blog` (`num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_blog_post`
--

LOCK TABLES `tb_blog_post` WRITE;
/*!40000 ALTER TABLE `tb_blog_post` DISABLE KEYS */;
INSERT INTO `tb_blog_post` VALUES (2,2,'brilho','img/sem imagem.jpg',1,'admin');
/*!40000 ALTER TABLE `tb_blog_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_cart`
--

DROP TABLE IF EXISTS `tb_cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_cart` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) NOT NULL,
  `date_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` datetime DEFAULT NULL,
  `customer` int(11) DEFAULT NULL,
  `global_discount` decimal(11,2) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `global_value` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_cart`
--

LOCK TABLES `tb_cart` WRITE;
/*!40000 ALTER TABLE `tb_cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_company`
--

DROP TABLE IF EXISTS `tb_company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_company` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `address` varchar(256) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `state` int(11) NOT NULL DEFAULT '1',
  `mission` longtext,
  `vision` longtext,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_company`
--

LOCK TABLES `tb_company` WRITE;
/*!40000 ALTER TABLE `tb_company` DISABLE KEYS */;
INSERT INTO `tb_company` VALUES (1,'S-BOSSA','Rua direita do Calemba II na paragem da Fârmacia','img/clientes/1726153220200707051621.png',1,'A nossa missão é de tornar .','Se tornar numa empresa de referencia nacional no .');
/*!40000 ALTER TABLE `tb_company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_company_contact`
--

DROP TABLE IF EXISTS `tb_company_contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_company_contact` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(30) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_company_contact`
--

LOCK TABLES `tb_company_contact` WRITE;
/*!40000 ALTER TABLE `tb_company_contact` DISABLE KEYS */;
INSERT INTO `tb_company_contact` VALUES (2,'email','sbossa@gmail.com',1),(3,'tel','999999999',1),(4,'whatsapp','999999',1);
/*!40000 ALTER TABLE `tb_company_contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_company_value`
--

DROP TABLE IF EXISTS `tb_company_value`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_company_value` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(60) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_company_value`
--

LOCK TABLES `tb_company_value` WRITE;
/*!40000 ALTER TABLE `tb_company_value` DISABLE KEYS */;
INSERT INTO `tb_company_value` VALUES (1,'Alegria',1);
/*!40000 ALTER TABLE `tb_company_value` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_costumershop`
--

DROP TABLE IF EXISTS `tb_costumershop`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_costumershop` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `user` varchar(60) NOT NULL,
  `pass` varchar(256) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_costumershop`
--

LOCK TABLES `tb_costumershop` WRITE;
/*!40000 ALTER TABLE `tb_costumershop` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_costumershop` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_gallery`
--

DROP TABLE IF EXISTS `tb_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_gallery` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(60) COLLATE utf8_bin NOT NULL,
  `img` varchar(256) COLLATE utf8_bin NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext COLLATE utf8_bin,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_gallery`
--

LOCK TABLES `tb_gallery` WRITE;
/*!40000 ALTER TABLE `tb_gallery` DISABLE KEYS */;
INSERT INTO `tb_gallery` VALUES (1,'Noviidade 1','img/novidades/120776411120200707034200.png','Nota da novidade 1',1,'2020-07-07 01:45:46','admin');
/*!40000 ALTER TABLE `tb_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_msg`
--

DROP TABLE IF EXISTS `tb_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_msg` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `tel` varchar(60) DEFAULT NULL,
  `subject` varchar(60) NOT NULL,
  `note` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_msg`
--

LOCK TABLES `tb_msg` WRITE;
/*!40000 ALTER TABLE `tb_msg` DISABLE KEYS */;
INSERT INTO `tb_msg` VALUES (4,'asd','asd','asd','9999','asd','asd','2020-04-11 01:32:57',1),(5,'teste',' ','aa@gmai','741','asd','141','2020-05-24 23:39:04',1),(6,'teste',' ','aa@gmai','741','','141','2020-05-24 23:55:50',1),(7,'teste',' ','aa@gmai','741','asd','141','2020-05-25 00:01:59',1),(8,'teste',NULL,'mvcontech@gmail.com','745658','assd','asd','2020-07-07 06:39:05',1),(9,'julho',NULL,'julho@sbossa.com','944','asd','asd','2020-07-27 04:10:58',1),(10,'',NULL,'','','','','2020-09-05 01:12:13',1);
/*!40000 ALTER TABLE `tb_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_newsletter`
--

DROP TABLE IF EXISTS `tb_newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_newsletter` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_newsletter`
--

LOCK TABLES `tb_newsletter` WRITE;
/*!40000 ALTER TABLE `tb_newsletter` DISABLE KEYS */;
INSERT INTO `tb_newsletter` VALUES (1,'dinhovatuva@gmail.com','2020-04-29 21:18:51',1);
/*!40000 ALTER TABLE `tb_newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_partner`
--

DROP TABLE IF EXISTS `tb_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_partner` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_partner`
--

LOCK TABLES `tb_partner` WRITE;
/*!40000 ALTER TABLE `tb_partner` DISABLE KEYS */;
INSERT INTO `tb_partner` VALUES (2,'nome do cliente','img/clientes/55179276620200707035820.png','gostei do trabalho',1,'2020-07-07 01:59:21','admin');
/*!40000 ALTER TABLE `tb_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product`
--

DROP TABLE IF EXISTS `tb_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_product` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
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
  `details` longtext,
  `click` int(11) DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `stars` int(11) DEFAULT NULL,
  PRIMARY KEY (`num`),
  KEY `fk_kklggf_idx` (`category`),
  CONSTRAINT `fk_kklggf` FOREIGN KEY (`category`) REFERENCES `tb_product_category` (`num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_product`
--

LOCK TABLES `tb_product` WRITE;
/*!40000 ALTER TABLE `tb_product` DISABLE KEYS */;
INSERT INTO `tb_product` VALUES (2,'produto de teste',8000000.00,'img/produtos/54384897720200707015144.png','nota b                                ',1,5,'2020-07-06 23:51:44','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,'Produto 2',100000.00,'img/produtos/18101525420200707055209.png','nota',1,6,'2020-07-07 03:52:09','admin',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tb_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product_category`
--

DROP TABLE IF EXISTS `tb_product_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_product_category` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(30) NOT NULL,
  `user` varchar(30) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  `img` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`num`,`category`),
  UNIQUE KEY `category_UNIQUE` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_product_category`
--

LOCK TABLES `tb_product_category` WRITE;
/*!40000 ALTER TABLE `tb_product_category` DISABLE KEYS */;
INSERT INTO `tb_product_category` VALUES (5,'alugar','admin',1,NULL),(6,'comprar','admin',1,NULL);
/*!40000 ALTER TABLE `tb_product_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_product_img`
--

DROP TABLE IF EXISTS `tb_product_img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_product_img` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  PRIMARY KEY (`num`),
  KEY `fk_img_product_idx` (`product`),
  CONSTRAINT `fk_img_product` FOREIGN KEY (`product`) REFERENCES `tb_product` (`num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_product_img`
--

LOCK TABLES `tb_product_img` WRITE;
/*!40000 ALTER TABLE `tb_product_img` DISABLE KEYS */;
INSERT INTO `tb_product_img` VALUES (1,2,'img/sem imagem.jpg'),(2,2,'img/produtos/71042330220200707025718.png');
/*!40000 ALTER TABLE `tb_product_img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_slide`
--

DROP TABLE IF EXISTS `tb_slide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_slide` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(60) NOT NULL,
  `img` varchar(256) NOT NULL DEFAULT 'img/sem imagem.jpg',
  `note` longtext,
  `state` int(11) NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_slide`
--

LOCK TABLES `tb_slide` WRITE;
/*!40000 ALTER TABLE `tb_slide` DISABLE KEYS */;
INSERT INTO `tb_slide` VALUES (3,'Teste1','img/slide/125305706020200715204014.png',NULL,1,'2020-07-15 18:40:14','admin'),(5,'Slide 2','img/slide/146247628520200707052347.png',NULL,1,'2020-07-07 03:23:47','admin');
/*!40000 ALTER TABLE `tb_slide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(256) NOT NULL,
  `email` varchar(60) NOT NULL,
  `tel` varchar(30) DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`),
  UNIQUE KEY `user_UNIQUE` (`user`),
  UNIQUE KEY `tel_UNIQUE` (`tel`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_user`
--

LOCK TABLES `tb_user` WRITE;
/*!40000 ALTER TABLE `tb_user` DISABLE KEYS */;
INSERT INTO `tb_user` VALUES (1,'Administrador','admin','$2y$12$IsZ2p/l1WlrmcsAWZNPWBOdh7hTnVeSNICwzs.u.OGyqcw/5or/qm','admin@mail.com','999999',1);
/*!40000 ALTER TABLE `tb_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbcart_product`
--

DROP TABLE IF EXISTS `tbcart_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbcart_product` (
  `num` int(11) NOT NULL AUTO_INCREMENT,
  `cart` int(11) NOT NULL,
  `product` int(11) NOT NULL,
  `description` varchar(100) DEFAULT NULL,
  `price` decimal(11,2) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `date_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_end` datetime DEFAULT NULL,
  `state` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`num`),
  KEY `cartproduct_idx` (`cart`),
  KEY `productproduct_idx` (`product`),
  CONSTRAINT `cartproduct` FOREIGN KEY (`cart`) REFERENCES `tb_cart` (`num`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `productproduct` FOREIGN KEY (`product`) REFERENCES `tb_product` (`num`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbcart_product`
--

LOCK TABLES `tbcart_product` WRITE;
/*!40000 ALTER TABLE `tbcart_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbcart_product` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-11-01 15:46:55
