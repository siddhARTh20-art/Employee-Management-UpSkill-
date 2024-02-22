-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2024 at 12:51 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `upskill_employee`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
CREATE TABLE IF NOT EXISTS `address` (
  `aid` int NOT NULL AUTO_INCREMENT,
  `employee_id` int DEFAULT NULL,
  `add_line1` varchar(100) DEFAULT NULL,
  `add_line2` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`aid`),
  KEY `employee_id` (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`aid`, `employee_id`, `add_line1`, `add_line2`, `country`, `state`, `pincode`) VALUES
(1, 1, '123 Maratha Street', 'Apt 101', 'India', 'Maharashtra', '400068'),
(2, 2, '456 Quebec Street', 'Apt 102', 'Canada', 'Quebec', '411068'),
(3, 3, '789 Shibuya Street', 'Apt 103', 'Japan', 'Tokyo', '511069');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `eid` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `photograph` blob,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`eid`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`eid`, `fname`, `mname`, `lname`, `gender`, `email`, `mobile_no`, `date_of_birth`, `photograph`, `status`) VALUES
(1, 'Siddharth', 'Ganpat', 'Jambhavdekar', 'male', 'sid.20@gmail.com', '8169896979', '2000-11-20', NULL, 1),
(2, 'Heer', 'Jinesh', 'Shah', 'male', 'heer.11@gmail.com', '9876543210', '2000-05-11', NULL, 1),
(3, 'Mahesh', 'Ajneih', 'Duvaka', 'male', 'mad.09@gmail.com', '9876743210', '2001-02-09', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_address_mapping`
--

DROP TABLE IF EXISTS `emp_address_mapping`;
CREATE TABLE IF NOT EXISTS `emp_address_mapping` (
  `eid` int NOT NULL,
  `aid` int NOT NULL,
  PRIMARY KEY (`eid`,`aid`),
  KEY `aid` (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
