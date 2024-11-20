-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Nov 20, 2024 at 12:18 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdcms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `Id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Name`, `username`, `password`) VALUES
(1, 'Admin', 'Admin', '$2a$12$RVcgCzCXGNAu7WWjnwDxZ.RDXeNJ.hJxiiUlVc43IFQ6Fhvm5BeQG');

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

DROP TABLE IF EXISTS `announcement`;
CREATE TABLE IF NOT EXISTS `announcement` (
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fileName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descreption` text COLLATE utf8mb4_general_ci,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datePosted` datetime DEFAULT NULL,
  `DeleteStatus` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'active',
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`title`, `fileName`, `descreption`, `createdAt`, `datePosted`, `DeleteStatus`, `id`) VALUES
('WELCOME TO MOBILE LEGENDS BANG BANG', 'avkqkHU.png', 'WELCOME PLAYER', '2024-11-12 14:57:21', '2024-11-12 14:57:21', 'is_Deleted', 1),
('HONOR OF KINGS ', '', 'WELCOME PLAYERS ', '2024-11-14 06:41:15', '2024-11-14 06:41:14', 'is_Deleted', 2),
('sdads', 'PicsArt_04-16-07.36.38.jpg', 'dfdfs', '2024-11-20 06:25:01', '2024-11-20 06:25:01', 'is_Deleted', 3),
('WALANG PASOK!!!!!!!', 'maxresdefault.jpg', 'SA BAHAY ', '2024-11-20 09:41:39', '2024-11-20 09:41:39', 'active', 4),
('BASTA', 'RIZAL.jpg', 's;ljfskdasamdsfjadsjfoiashdiohasoidhoashdoashondifgwehfiuwegasndbiqwgdshhpoua9yojhssidgaskldhoashdknasbcas owdopwwqiuedqwumxq wuenqwxjw wqudioqwnncuw jqwcwucnuqwdncuoqwudncoiqwhdocj qwh doiqwdopnccqwicd wocwnoidwuqdcojqwocnoqwicn owqhwhdoiwqhcnwodcuposjdnahsndohafskdn oiwduwcnodnoADAPF A;F;OSAG FNPNANPhfkdhfdhfdshfhodsh sk jiofioasdihasndj ishdh sjhjasdhajsdjash hadsohhsadnocpapa', '2024-11-20 10:27:07', '2024-11-20 10:27:07', 'active', 5);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `StudentNo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `StudentName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Date` date NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `StudentNo`, `StudentName`, `Date`, `status`) VALUES
(1, 'DDC16960', 'NewStudent victorio', '2024-10-22', 'Absent'),
(2, '122A0084', 'Erwin Victorio', '2024-10-16', 'Present'),
(3, '122A0084', 'Erwin Victorio', '2024-10-17', 'Present'),
(4, '122A0084', 'Erwin Victorio', '2024-10-18', 'Present'),
(5, '122A0084', 'Erwin Victorio', '2024-10-19', 'Absent'),
(6, '122A0084', 'Erwin Victorio', '2024-10-20', 'Absent'),
(7, '122A0084', 'Erwin Victorio', '2024-10-21', 'Absent'),
(8, 'A122s', 'Juan pedro', '2024-10-16', 'Absent'),
(9, 'A122s', 'Juan pedro', '2024-10-17', 'Present'),
(10, 'A122s', 'Juan pedro', '2024-10-18', 'Absent'),
(11, 'A122s', 'Juan pedro', '2024-10-19', 'Present'),
(12, 'A122s', 'Juan pedro', '2024-10-20', 'Absent'),
(13, 'A122s', 'Juan pedro', '2024-10-21', 'Present'),
(14, '122A0084', 'juan Just', '2024-11-15', 'Present'),
(15, 'A122s', 'juan Just', '2024-11-15', 'Present'),
(16, 'Student123', 'juan Just', '2024-11-15', 'Present'),
(17, '122A0084', 'juan Just', '2024-11-15', 'Absent'),
(18, 'A122s', 'juan Just', '2024-11-15', 'Absent'),
(19, 'Student123', 'juan Just', '2024-11-15', 'Absent'),
(20, '777A888', 'MARK SAMSON', '2024-11-20', 'Present'),
(21, '122A0084', 'juan Just', '2024-11-20', 'Present'),
(22, 'A122s', 'juan Just', '2024-11-20', 'Present'),
(23, 'Student123', 'juan Just', '2024-11-20', 'Present'),
(24, '777A888', 'bossing kupal ka ba jr.', '2024-11-20', 'Present'),
(25, '111111', 'bossing kupal ka ba jr.', '2024-11-20', 'Absent'),
(26, '122A0084', 'juan Just', '2024-11-20', 'Present'),
(27, 'A122s', 'juan Just', '2024-11-20', 'Absent'),
(28, 'Student123', 'juan Just', '2024-11-20', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Email_Or_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `StudentName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `StudentNumber` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `FullName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_student_StudentNo_fk` (`StudentNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `Email_Or_username`, `Password`, `StudentName`, `StudentNumber`, `FullName`) VALUES
(1, 'paren1@gmail.com', '$2y$10$A.0WFEWK9.W4iGRuKFbKxeayIqTPV.WPuKWqmq4MXOF7ps3hcWrzq', 'Erwin Victorio', '122A0084', 'parent1'),
(2, 'parent2@gmail.com', '$2y$10$DoMvABQsAvnzS9QGQCK61e2Qgo9uAE6taYKJ0tIfMX7znwLoXggG6', 'juan', 'A122s', 'paren2'),
(3, 'ParentNiSamson@gmail.com', '$2y$10$ftGamlf4NBD7L8uutwR.LeO.Z4iIqMb8b6PpVnuAZptr4u7izVkvi', 'Samson', '777A888', 'Samson'),
(4, 'richardtabemmasculino@gmail.com', '$2y$10$nWw8G8zJ.NDlMcgS62P/6upPv74dEzFdyHQYg6.mVkQtROS4INNpe', 'ryan ocampo', '122A0084', 'richard'),
(5, 'richard@gmail.com', '$2y$10$tMBo/6LTtv6tq3bJakrkteQ60qdobHWd2eh35w01mhWFnp7IXjB4O', 'Erwin Victorio', '122A0084', 'ricardo mayang');

-- --------------------------------------------------------

--
-- Table structure for table `requirements`
--

DROP TABLE IF EXISTS `requirements`;
CREATE TABLE IF NOT EXISTS `requirements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fileName` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `SdudentId` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requirements`
--

INSERT INTO `requirements` (`id`, `Name`, `fileName`, `SdudentId`) VALUES
(3, '    Birth Update', 'capstone_logo.jpg', 'A122s'),
(5, '167', '137.jpeg', 'A122s'),
(7, ' Sample BirthCert', 'Birth-Certificate-template_HD-Smaller.jpg', '777A888'),
(10, 'amd', 'AMD-Intel-Rivalry-Wccftech.jpg', '122A0084');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `LastName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `StudentNo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ArchiveStatus` varchar(255) COLLATE utf8mb4_general_ci DEFAULT 'Active',
  `Status` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Pending' COMMENT 'Enrolled or Pending',
  `Age` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Birdate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Gender` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `healthHistory` text COLLATE utf8mb4_general_ci,
  `Profile` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `schedule` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `student_pk` (`StudentNo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `FirstName`, `LastName`, `StudentNo`, `ArchiveStatus`, `Status`, `Age`, `Birdate`, `Gender`, `Address`, `healthHistory`, `Profile`, `schedule`) VALUES
(1, 'Ryan ', 'Ocampo', '122A0084', 'Active', 'Enrolled', '25', '1997-05-09', 'Male', NULL, NULL, NULL, 'morning'),
(4, 'Juan', 'pedro', 'A122s', 'Active', 'Enrolled', '7', '2019-01-08', 'Male', NULL, NULL, NULL, 'morning'),
(5, 'MARK', 'SAMSON', '123A99A', 'isDeleted', 'Pending', '8', '2010-06-15', '\'\'', NULL, NULL, NULL, 'Select Schedule'),
(8, 'MARK', 'SAMSON', '777A888', 'Active', 'Enrolled', '8', '2010-06-15', 'Female', NULL, NULL, NULL, 'afternoon'),
(9, 'MARK', 'VICTORIO', 'A77A00A', 'isDeleted', 'Pending', '4', '2010-03-18', 'Female', NULL, NULL, NULL, 'afternoon'),
(10, 'juan', 'Just', 'Student123', 'isDeleted', 'Enrolled', '12', '2002-02-06', '\'\'', NULL, NULL, NULL, 'morning'),
(11, 'ezreal', 'demon', '19015196', 'Active', 'Pending', '5', '1998-06-30', 'Male', NULL, NULL, NULL, 'morning'),
(21, 'bossing', 'kupal ka ba jr.', '111111', 'isDeleted', 'Enrolled', '4', '2001-01-01', 'Male', NULL, NULL, NULL, 'afternoon');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_student_StudentNo_fk` FOREIGN KEY (`StudentNumber`) REFERENCES `student` (`StudentNo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
