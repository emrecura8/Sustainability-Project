-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2022 at 11:16 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projecttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `username` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `name`, `username`, `password`, `type`, `id`) VALUES
('admin@admin.com', 'admin', 'admin', 'admin123', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `firm_user`
--

DROP TABLE IF EXISTS `firm_user`;
CREATE TABLE IF NOT EXISTS `firm_user` (
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `firm_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `firm_username` varchar(40) COLLATE utf8_bin NOT NULL,
  `firm_password` varchar(20) COLLATE utf8_bin NOT NULL,
  `city` varchar(20) COLLATE utf8_bin NOT NULL,
  `district` varchar(20) COLLATE utf8_bin NOT NULL,
  `address` varchar(175) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `firm_user`
--

INSERT INTO `firm_user` (`email`, `firm_name`, `firm_username`, `firm_password`, `city`, `district`, `address`, `type`, `id`) VALUES
('yasartekstil@gmail.com', 'Yaşar Tekstil', 'tekstilyasar', 'yt436', 'ankara', 'sincan', 'Ahi Evran OSB Mah. ASO Bulvarı No:1/101 06935 Sincan/Ankara', 2, 2),
('veliuzun@gmail.com', 'Veli\'s Cafe', 'cafeveli', 'cf749', 'ankara', 'bilkent', 'Üniversiteler, 1597. Cd. No:10, 06800 Çankaya/Ankara', 2, 3),
('galipithalat@gmail.com', 'Galip İthalat', 'ithalatgalip', 'gi437', 'istanbul', 'tuzla', 'Aydınlı İstanbul AYOSB Mahallesi 5. Sokak No:2 34953 Tuzla/İstanbul', 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `inst_user`
--

DROP TABLE IF EXISTS `inst_user`;
CREATE TABLE IF NOT EXISTS `inst_user` (
  `email` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `name` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `username` varchar(40) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `advisor_status` int(6) DEFAULT NULL,
  `student_advised` varchar(257) COLLATE utf8_bin DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `inst_user`
--

INSERT INTO `inst_user` (`email`, `name`, `username`, `password`, `advisor_status`, `student_advised`, `type`, `id`) VALUES
('mehmetucar@gmail.com', 'Mehmet Uçar', 'ucarmehmet', 'mehmet818', 1, 'Emre Cura', 3, 4),
('neseozcelik@gmail.com', 'Neşe Özçelik', 'ozceliknese', 'ozcelk958', 1, 'Bertan Özer', 3, 30),
('aligul@gmail.com', 'Ali Gül', 'gulali', 'gul746', NULL, NULL, 3, 31);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `p_name` varchar(40) COLLATE utf8_bin NOT NULL,
  `p_description` varchar(200) COLLATE utf8_bin NOT NULL,
  `p_requirement` varchar(200) COLLATE utf8_bin NOT NULL,
  `p_software` varchar(200) COLLATE utf8_bin NOT NULL,
  `p_hardware` varchar(200) COLLATE utf8_bin NOT NULL,
  `year` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '2022',
  `state` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `semester` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `advisor` varchar(275) COLLATE utf8_bin DEFAULT NULL,
  `Group_Members` varchar(175) COLLATE utf8_bin NOT NULL DEFAULT ' ',
  `p_mediapath` varchar(200) COLLATE utf8_bin NOT NULL,
  `p_id` int(11) NOT NULL,
  `self_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`self_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`p_name`, `p_description`, `p_requirement`, `p_software`, `p_hardware`, `year`, `state`, `comment`, `semester`, `advisor`, `Group_Members`, `p_mediapath`, `p_id`, `self_id`) VALUES
('Periodic Table Software', 'This software shows users to what are the elements on table  and what they used for.', 'Computer which have Processing language compiler', 'Processing', 'Computer', '2022', '', 'You need to work on animations', '2', '', ' ', 'none', 14, 13),
('Space Shuttle Model', 'Build a space shuttle model which can fly a couple of seconds and meters', 'Plastic shuttle toys and raspberry pi', 'Python', 'Raspberry Pi computer and signal receiver', '2022', NULL, 'Signalling needs to develop', '', NULL, ' ', 'none', 5, 14),
('Student Development System', 'An AI system that aims to develop student performance according to their results', 'Computer which Python language installed', 'StudentDev v0.6', 'Computer and camera', '2022', NULL, NULL, NULL, NULL, ' ', 'none', 4, 15);

-- --------------------------------------------------------

--
-- Table structure for table `stu_user`
--

DROP TABLE IF EXISTS `stu_user`;
CREATE TABLE IF NOT EXISTS `stu_user` (
  `email` varchar(40) COLLATE utf8_bin NOT NULL,
  `name` varchar(40) COLLATE utf8_bin NOT NULL,
  `username` varchar(40) COLLATE utf8_bin NOT NULL,
  `password` varchar(20) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `type` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `stu_user`
--

INSERT INTO `stu_user` (`email`, `name`, `username`, `password`, `type`, `id`) VALUES
('bertanozer@gmail.com', 'Bertan Özer', 'ozerbertan', 'bertan343', 1, 5),
('emre@gmail.com', 'Emre Cura', 'curaemre8', 'emre808', 1, 14),
('deryasipahi@gmail.com', 'Derya Sipahi', 'sipahiderya', 'derya746', 1, 15),
('merveatalay@gmail.com', 'Merve Atalay', 'atalaymerve', 'atalay834', 1, 16),
('kaanuzunoz@gmail.com', 'Kaan Uzunöz', 'uzunozkaan', 'uzunoz478', 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type` varchar(50) COLLATE utf8_bin NOT NULL,
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type`, `id`) VALUES
('student', 1),
('firm', 2),
('instructor', 3),
('admin', 4),
('guest', 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);

--
-- Constraints for table `firm_user`
--
ALTER TABLE `firm_user`
  ADD CONSTRAINT `firm_user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);

--
-- Constraints for table `inst_user`
--
ALTER TABLE `inst_user`
  ADD CONSTRAINT `inst_user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);

--
-- Constraints for table `stu_user`
--
ALTER TABLE `stu_user`
  ADD CONSTRAINT `stu_user_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
