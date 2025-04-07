-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 11, 2021 at 02:15 PM
-- Server version: 5.7.31
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sinamum`
--

-- --------------------------------------------------------
CREATE DATABASE `sinamum` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `sinamum`;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`, `name`) VALUES
('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `anc_id` int(11) NOT NULL AUTO_INCREMENT,
  `anc_title` varchar(255) DEFAULT NULL,
  `anc_text` text,
  `admin_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`anc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`anc_id`, `anc_title`, `anc_text`, `admin_id`) VALUES
(1, 'OPENING HOURS', '8am - 8pm (DAILY)', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `password`, `name`) VALUES
('cust@cust.com', '80d26609c5226268981e4a6d4ceddbc339d991841ae580e3180b56c8ade7651d', 'cust'),
('1@1.com', '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', '1'),
('', 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855', 'daas'),
('12@12.com', '6b51d431df5d7f141cbececcf79edf3dd861c3b4069f0b11661a3eefacbba918', '12'),
('syahiranaffendy99@gmail.com', '28ac75d55a1e0cd1432f839dd89974c06414e06e711e9b3a0f7d6b1e4df66232', 'Muhammad Syahiran Affendy');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `phone` text,
  `total_payment` double DEFAULT NULL,
  `deposit_payment` double DEFAULT NULL,
  `make_payment` tinyint(1) DEFAULT '0',
  `resource_id` int(11) DEFAULT NULL,
  `cust_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `start`, `end`, `phone`, `total_payment`, `deposit_payment`, `make_payment`, `resource_id`, `cust_id`) VALUES
(9, '12', '2021-07-09 08:00:00', '2021-07-09 09:00:00', '12', 80, 24, 1, 1, 'cust@cust.com'),
(14, '33', '2021-07-09 08:00:00', '2021-07-09 09:00:00', '33', 80, 24, 1, 2, 'cust@cust.com'),
(30, 'daas', '2021-07-09 14:00:00', '2021-07-09 16:00:00', 'daas', 160, 48, 1, 2, 'cust@cust.com'),
(32, 'admin', '2021-07-09 10:00:00', '2021-07-09 12:00:00', '12', 160, 48, 1, 2, 'admin'),
(33, 'abu', '2021-07-09 17:00:00', '2021-07-09 18:00:00', '0123456789', 80, 24, 0, 1, 'cust@cust.com'),
(36, 'Syah', '2021-07-12 08:00:00', '2021-07-12 09:00:00', '01123157590', 80, 24, 1, 2, 'syahiranaffendy99@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `group_id`, `availability`) VALUES
(1, 'Court 1', 1, 1),
(2, 'Court 2', 1, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
