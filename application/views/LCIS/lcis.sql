-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2014 at 09:21 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lcis`
--
CREATE DATABASE IF NOT EXISTS `lcis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lcis`;

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE IF NOT EXISTS `colleges` (
  `colID` int(11) NOT NULL AUTO_INCREMENT,
  `col_name` varchar(100) NOT NULL,
  `col_abb` varchar(50) NOT NULL,
  PRIMARY KEY (`colID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`colID`, `col_name`, `col_abb`) VALUES
(1, 'COE', 'College of Engineering'),
(2, 'CAAD', 'College of Architecture and Allied Discipline'),
(3, 'COBE', 'College of Business and Entrepreneurship'),
(4, 'CAS', 'College of Arts and Sciences'),
(5, 'COT', 'College of Technology'),
(6, 'COED', 'College of Education');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  `course_description` varchar(100) NOT NULL,
  `college` varchar(50) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`cid`, `course_name`, `course_description`, `college`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', 'COE'),
(2, 'BSAr', 'Bachelor of Science in Architecture', 'CAAD'),
(4, 'BSOA', 'Bachelor of Science in Office Administrator', 'COBE'),
(5, 'BIT', 'Bachelor in Industrial Technology', 'COT'),
(6, 'BSEE', 'Bachelor of Science in Electrical Engineering', 'COE'),
(7, 'BSID', 'Bachelor of Science in Interior Design', 'CAAD'),
(8, 'BSStat', 'Bachelor of Science in Statistics', 'CAS'),
(9, 'BSME', 'Bachelor of Science in Mechanical Engineering', 'COE'),
(10, 'BSIE', 'Bachelor of Science in Industrial Engineering', 'COE'),
(11, 'BSED', 'Bachelor in Secondary Education', 'COED');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE IF NOT EXISTS `grades` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL,
  `grade` decimal(10,2) NOT NULL,
  `syid` int(11) NOT NULL,
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`gid`, `sid`, `grade`, `syid`) VALUES
(1, 1, '1.20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `loads`
--

CREATE TABLE IF NOT EXISTS `loads` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(20) NOT NULL,
  `cid` int(11) NOT NULL,
  `department` varchar(20) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `loads`
--

INSERT INTO `loads` (`lid`, `emp_id`, `cid`, `department`) VALUES
(12, '29', 9, 'CWTS'),
(14, '29', 11, 'CWTS'),
(15, '29', 10, 'CWTS');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `sid` varchar(10) NOT NULL,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`sid`, `username`, `password`, `status`) VALUES
('1', 'asd', 'UÐ€*½ÈåT?å$Tm	€', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE IF NOT EXISTS `student_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact_no` varchar(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `cid` int(11) NOT NULL,
  `course` varchar(30) NOT NULL,
  `guardian` varchar(100) NOT NULL,
  `gaddress` varchar(200) NOT NULL,
  `gcontact` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sid` (`sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `sid`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `address`, `contact_no`, `status`, `cid`, `course`, `guardian`, `gaddress`, `gcontact`) VALUES
(1, '2011-11111', 'Juan', 'Daman', 'Dela Cruz', '2358-12-31', 'Male', 'Hgasdhsagdhasgd', '13212132132', 'Single', 1, 'CWTS', 'Dela Cruz', 'Hgasdhsagdhasgd', '212312323123');

-- --------------------------------------------------------

--
-- Table structure for table `syandsem`
--

CREATE TABLE IF NOT EXISTS `syandsem` (
  `syID` int(11) NOT NULL AUTO_INCREMENT,
  `SY` varchar(20) NOT NULL,
  `semester` int(2) NOT NULL,
  PRIMARY KEY (`syID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `syandsem`
--

INSERT INTO `syandsem` (`syID`, `SY`, `semester`) VALUES
(1, '2013-2014', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(20) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `date_of_birth` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `address` varchar(200) NOT NULL,
  `designation` varchar(20) NOT NULL,
  `department` varchar(20) NOT NULL,
  PRIMARY KEY (`eid`),
  UNIQUE KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`eid`, `emp_id`, `first_name`, `middle_name`, `last_name`, `date_of_birth`, `gender`, `address`, `designation`, `department`) VALUES
(1, '2007-00268', 'Registrar', 'Registrar', 'Registrar', '1991-04-25', 'Male', 'Brgy. Cayare, San Miguel, Leyte', 'Registrar', 'Registrar'),
(2, '2014-81273', 'Jericho', 'Rosales', 'Dean', '1978-09-21', 'Male', 'Tacloban City', 'Dean', 'Deans Office'),
(3, '20005-00345', 'Faculty', 'Faculty', 'Faculty', '09-09-1976', 'Male', 'Calbiga, Samar', 'Faculty', 'Deans Office'),
(4, '2003-91839', 'controller', 'controller', 'controller', '1987-08-08', 'Male', 'Tacloban City', 'Controller', 'Cashier');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE IF NOT EXISTS `user_accounts` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `eid` varchar(20) NOT NULL,
  `username` longtext NOT NULL,
  `password` longtext NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`uid`, `eid`, `username`, `password`, `status`) VALUES
(16, '1', 'registrar', '€±‡r´ª\ZC–„:…”\rŠ', 'active'),
(17, '2', 'dean', '”ùlÓï\\¹+eec"q', 'active'),
(18, '3', 'faculty', 'K³j½¶<x|²ªR9 Á', 'active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
