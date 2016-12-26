-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2016 at 12:32 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gs`
--
CREATE DATABASE IF NOT EXISTS `gs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gs`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `autogen_email_content` text,
  `postage_cost` int(11) NOT NULL,
  `ticket_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `autogen_email_content`, `postage_cost`, `ticket_price`) VALUES
('admin', '$2y$10$cwr8XFgNJUufMeX2VhHIuuPibDpgxqB.toOXcLA1S8JApO2gK.QdK', 'Dear Student,\r\n\r\n\r\nYou are now eligible to apply for graduation. Please refer to MMU Online Graduation website and apply for graduation.\r\n\r\n\r\nBest Regards,\r\nMultimedia University', 70, 150);

-- --------------------------------------------------------

--
-- Table structure for table `convocation`
--

DROP TABLE IF EXISTS `convocation`;
CREATE TABLE `convocation` (
  `convocation_id` int(11) NOT NULL,
  `convocation_name` varchar(255) NOT NULL,
  `starting_time` varchar(255) NOT NULL,
  `ending_time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convocation`
--

INSERT INTO `convocation` (`convocation_id`, `convocation_name`, `starting_time`, `ending_time`, `date`) VALUES
(1, 'Undergradutes', '09:00 AM', '05:00 PM', '06/15/2016'),
(2, 'FOM', '08:00 AM', '12:00 PM', '08/12/2016'),
(3, 'FOE', '08:30 AM', '02:00 PM', '06/17/2016'),
(4, 'FCI', '09:00 AM', '12:00 PM', '09/15/2015');

-- --------------------------------------------------------

--
-- Table structure for table `convocation_faculty`
--

DROP TABLE IF EXISTS `convocation_faculty`;
CREATE TABLE `convocation_faculty` (
  `id` int(11) NOT NULL,
  `convocation_id` int(11) NOT NULL,
  `faculty` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `convocation_faculty`
--

INSERT INTO `convocation_faculty` (`id`, `convocation_id`, `faculty`) VALUES
(12, 1, 'Faculty of Management'),
(13, 1, 'Faculty of Engineering'),
(14, 1, 'Faculty of Computing and Informatics'),
(15, 2, 'Faculty of Management'),
(16, 3, 'Faculty of Engineering'),
(17, 4, 'Faculty of Computing and Informatics');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `course_code` varchar(20) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `total_credit_hours` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_code`, `course_name`, `total_credit_hours`) VALUES
('FCI_SE15', 'BACHELOR OF COMPUTER SCIENCE (HONS) SOFTWARE ENGINEERING', 74),
('FOE_CE15', 'BACHELOR OF ENGINEERING (HONS) ELECTRONICS MAJORING IN COMPUTER', 87),
('FOM_AE15', 'BACHELOR OF ECONOMICS (HONS) ANALYTICAL ECONOMICS', 63);

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE `mark` (
  `student_id` int(10) NOT NULL,
  `subject_code` varchar(20) NOT NULL,
  `mark` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`student_id`, `subject_code`, `mark`) VALUES
(1102702880, 'PWC1010', 90),
(1102702880, 'TCP1101', 64),
(1102702880, 'TCP2101', 69),
(1102702880, 'TCP2201', 98),
(1102702880, 'TIS1101', 88),
(1102702880, 'TIS3151', 59),
(1102702880, 'TMA1101', 45),
(1102702880, 'TMA1201', 57),
(1102702880, 'TMA1301', 79),
(1102702880, 'TPT1101', 60),
(1102702880, 'TPT1201', 59),
(1102702880, 'TSE2101', 78),
(1102702880, 'TSE2451', 56),
(1102702880, 'TSE3151', 69),
(1102702880, 'TSE3251', 83),
(1102702880, 'TSN1101', 51),
(1102702880, 'TSN2101', 43),
(1102703105, 'PWC1010', 68),
(1102703105, 'TCP1101', 93),
(1102703105, 'TCP1201', 89),
(1102703105, 'TCP2101', 67),
(1102703105, 'TCP2201', 58),
(1102703105, 'TIS1101', 98),
(1102703105, 'TIS3151', 68),
(1102703105, 'TMA1101', 56),
(1102703105, 'TMA1201', 69),
(1102703105, 'TMA1301', 67),
(1102703105, 'TPT1101', 83),
(1102703105, 'TPT1201', 92),
(1102703105, 'TSE2101', 79),
(1102703105, 'TSE2451', 62),
(1102703105, 'TSE3151', 56),
(1102703105, 'TSE3251', 97),
(1102703105, 'TSN1101', 86),
(1102703105, 'TSN2101', 64),
(1102703105, 'TSN2201', 99),
(1102703221, 'BAC1024', 89),
(1102703221, 'BAE1010', 56),
(1102703221, 'BAE1024', 58),
(1102703221, 'BBR3044', 98),
(1102703221, 'BBR3064', 78),
(1102703221, 'BCT1024', 98),
(1102703221, 'BEC1034', 57),
(1102703221, 'BEC2044', 78),
(1102703221, 'BEC6667', 98),
(1102703221, 'BEN2010', 100),
(1102703221, 'BFE2074', 68),
(1102703221, 'BFN1014', 95),
(1102703221, 'BIE2024', 70),
(1102703221, 'BMD3024', 73),
(1102703221, 'BME2034', 69),
(1102703221, 'BMG1014', 98),
(1102703221, 'BMS1024', 95),
(1102703221, 'BMT1014', 67),
(1102703221, 'BPB2034', 53),
(1102703221, 'BRM2034', 58),
(1102703221, 'MMB2013', 69),
(1102703221, 'MPW2133', 50),
(1102706646, 'BHM3086', 74),
(1102706646, 'BMT1024', 57),
(1102706646, 'ECE1016', 82),
(1102706646, 'ECE1026', 79),
(1102706646, 'ECE2046', 82),
(1102706646, 'ECE2056', 56),
(1102706646, 'ECE2066', 72),
(1102706646, 'ECE2216', 83),
(1102706646, 'ECE3076', 79),
(1102706646, 'ECE3166', 74),
(1102706646, 'ECE3206', 65),
(1102706646, 'EEE1016', 50),
(1102706646, 'EEE1026', 92),
(1102706646, 'EEE1036', 79),
(1102706646, 'EEE1046', 90),
(1102706646, 'EEL1166', 91),
(1102706646, 'EEL1176', 95),
(1102706646, 'EEL1196', 63),
(1102706646, 'EEL2186', 89),
(1102706646, 'EEL2216', 96),
(1102706646, 'EES3016', 51),
(1102706646, 'EES3026', 89),
(1102706646, 'EMF2016', 92),
(1102706646, 'EMT1016', 77),
(1102706646, 'EMT1026', 71),
(1102706646, 'EMT2036', 73),
(1102706646, 'EMT2046', 67),
(1102706646, 'ETN3046', 57),
(1102706646, 'ETN3096', 85),
(1103805006, 'BAC1024', 69),
(1103805006, 'BAE1010', 78),
(1103805006, 'BAE1024', 56),
(1103805006, 'BBR3044', 93),
(1103805006, 'BBR3064', 67),
(1103805006, 'BCT1024', 93),
(1103805006, 'BEC1034', 56),
(1103805006, 'BEC2044', 65),
(1103805006, 'BEC6667', 78),
(1103805006, 'BEN2010', 94),
(1103805006, 'BFE2074', 96),
(1103805006, 'BFN1014', 65),
(1103805006, 'BIE2024', 98),
(1103805006, 'BMD3024', 56),
(1103805006, 'BME2034', 92),
(1103805006, 'BMG1014', 89),
(1103805006, 'BMS1024', 56),
(1103805006, 'BMT1014', 78),
(1103805006, 'BPB2034', 90),
(1103805006, 'BRM2034', 60),
(1103805006, 'MMB2013', 67),
(1103805006, 'MPW2133', 78),
(1106903311, 'PWC1010', 78),
(1106903311, 'TCP1101', 67),
(1106903311, 'TCP1201', 59),
(1106903311, 'TCP2101', 84),
(1106903311, 'TCP2201', 72),
(1106903311, 'TIS1101', 71),
(1106903311, 'TIS3151', 78),
(1106903311, 'TMA1101', 84),
(1106903311, 'TMA1201', 93),
(1106903311, 'TMA1301', 92),
(1106903311, 'TPT1101', 86),
(1106903311, 'TPT1201', 57),
(1106903311, 'TSE2101', 69),
(1106903311, 'TSE2451', 59),
(1106903311, 'TSE3151', 92),
(1106903311, 'TSE3251', 89),
(1106903311, 'TSN1101', 79),
(1106903311, 'TSN2101', 67),
(1106903311, 'TSN2201', 71),
(1109801212, 'BHM3086', 78),
(1109801212, 'BMT1024', 68),
(1109801212, 'ECE1016', 68),
(1109801212, 'ECE1026', 98),
(1109801212, 'ECE2046', 69),
(1109801212, 'ECE2056', 89),
(1109801212, 'ECE2066', 69),
(1109801212, 'ECE2216', 92),
(1109801212, 'ECE3076', 93),
(1109801212, 'ECE3166', 71),
(1109801212, 'ECE3206', 92),
(1109801212, 'EEE1016', 72),
(1109801212, 'EEE1026', 81),
(1109801212, 'EEE1036', 61),
(1109801212, 'EEE1046', 64),
(1109801212, 'EEL1166', 54),
(1109801212, 'EEL1176', 98),
(1109801212, 'EEL1196', 63),
(1109801212, 'EEL2186', 59),
(1109801212, 'EEL2216', 72),
(1109801212, 'EES3016', 91),
(1109801212, 'EES3026', 99),
(1109801212, 'EMF2016', 78),
(1109801212, 'EMT1016', 68),
(1109801212, 'EMT1026', 63),
(1109801212, 'EMT2036', 73),
(1109801212, 'EMT2046', 77),
(1109801212, 'ETN3046', 88),
(1109801212, 'ETN3096', 99),
(1113809091, 'BHM3086', 50),
(1113809091, 'BMT1024', 50),
(1113809091, 'ECE1016', 50),
(1113809091, 'ECE1026', 50),
(1113809091, 'ECE2046', 50),
(1113809091, 'ECE2056', 50),
(1113809091, 'ECE2066', 50),
(1113809091, 'ECE2216', 50),
(1113809091, 'ECE3076', 50),
(1113809091, 'ECE3166', 50),
(1113809091, 'ECE3206', 50),
(1113809091, 'EEE1016', 50),
(1113809091, 'EEE1026', 50),
(1113809091, 'EEE1036', 50),
(1113809091, 'EEE1046', 50),
(1113809091, 'EEL1166', 50),
(1113809091, 'EEL1176', 50),
(1113809091, 'EEL1196', 50),
(1113809091, 'EEL2186', 50),
(1113809091, 'EEL2216', 50),
(1113809091, 'EES3016', 50),
(1113809091, 'EES3026', 50),
(1113809091, 'EMF2016', 50),
(1113809091, 'EMT1016', 50),
(1113809091, 'EMT1026', 50),
(1113809091, 'EMT2036', 50),
(1113809091, 'EMT2046', 50),
(1113809091, 'ETN3046', 50),
(1113809091, 'ETN3096', 50),
(1115609090, 'PWC1010', 50),
(1115609090, 'TCP1101', 50),
(1115609090, 'TCP1201', 50),
(1115609090, 'TCP2101', 50),
(1115609090, 'TCP2201', 50),
(1115609090, 'TIS1101', 50),
(1115609090, 'TIS3151', 50),
(1115609090, 'TMA1101', 50),
(1115609090, 'TMA1201', 50),
(1115609090, 'TMA1301', 50),
(1115609090, 'TPT1101', 50),
(1115609090, 'TPT1201', 50),
(1115609090, 'TSE2101', 50),
(1115609090, 'TSE2451', 50),
(1115609090, 'TSE3151', 50),
(1115609090, 'TSE3251', 50),
(1115609090, 'TSN1101', 50),
(1115609090, 'TSN2101', 50),
(1115609090, 'TSN2201', 50),
(1119503432, 'PWC1010', 89),
(1119503432, 'TCP1101', 74),
(1119503432, 'TCP1201', 50),
(1119503432, 'TCP2101', 68),
(1119503432, 'TCP2201', 59),
(1119503432, 'TIS1101', 74),
(1119503432, 'TIS3151', 69),
(1119503432, 'TMA1101', 53),
(1119503432, 'TMA1201', 58),
(1119503432, 'TMA1301', 98),
(1119503432, 'TPT1101', 90),
(1119503432, 'TPT1201', 58),
(1119503432, 'TSE2101', 64),
(1119503432, 'TSE2451', 59),
(1119503432, 'TSE3151', 75),
(1119503432, 'TSE3251', 68),
(1119503432, 'TSN1101', 93),
(1119503432, 'TSN2101', 82),
(1119503432, 'TSN2201', 80),
(1119807878, 'TMA1101', 100);

-- --------------------------------------------------------

--
-- Table structure for table `seat_group`
--

DROP TABLE IF EXISTS `seat_group`;
CREATE TABLE `seat_group` (
  `label` varchar(255) NOT NULL,
  `rows` int(11) NOT NULL,
  `coloumns` int(11) NOT NULL,
  `left_position` int(11) NOT NULL,
  `top_position` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `reservable` tinyint(4) NOT NULL,
  `convocation_id` int(11) NOT NULL,
  `z_index` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat_group`
--

INSERT INTO `seat_group` (`label`, `rows`, `coloumns`, `left_position`, `top_position`, `color`, `reservable`, `convocation_id`, `z_index`) VALUES
('FCI', 4, 16, 451, 218, '#cde11a', 0, 1, 1532559),
('FOE', 10, 8, 1058, 18, '#d0db1a', 0, 1, 1531),
('FOM', 10, 8, 108, 14, '#d0db1a', 0, 1, 153254),
('Guests', 10, 38, 97, 419, '#40ea72', 1, 1, 1532555),
('jadidd', 6, 8, 230, 318, '#e5df31', 1, 2, 153),
('jkl', 6, 8, 845, 436, '#e5df31', 0, 2, 1546),
('new seats', 3, 6, 242, 110, '#5be884', 1, 2, 14),
('Others', 16, 16, 226, 114, '#bfd21d', 1, 3, 1337),
('Students', 16, 16, 830, 120, '#3ceaea', 0, 3, 132),
('V I P', 3, 16, 456, 23, '#14e5e5', 0, 1, 1529);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE `student` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `student_id` int(10) NOT NULL,
  `username` int(10) NOT NULL,
  `password` varchar(128) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `contact_number` varchar(11) DEFAULT NULL,
  `mail_address` text,
  `email_address` varchar(255) DEFAULT NULL,
  `cgpa` float DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`first_name`, `last_name`, `student_id`, `username`, `password`, `faculty`, `course_code`, `status`, `contact_number`, `mail_address`, `email_address`, `cgpa`, `ticket_id`) VALUES
('Rian', 'Diesel', 1102702880, 1102702880, '$2y$10$8m1qO84e.DtXpz94TcMhp.Jpc7fzkeYz//xwFbfMiVUUQ3RJ5BmEm', 'Faculty of Computing and Informatics', 'FCI_SE15', 'Active', '173986646', 'null', 'rian.diesel@gmail.com', 2.84, 0),
('Lonnie', 'Tyler', 1102703105, 1102703105, '$2y$10$VQO6uVaMSCCgw8sBidpq.uk19fuzse/bTYWU/K2UI2JHtPlCpkui2', 'Faculty of Computing and Informatics', 'FCI_SE15', 'Eligible for Graduation', '17398646', '1110 Country Club Road \r\nPerrysburg, OH 43551', 'Lonnie_Tyler@gmail.com', 3.32, 0),
('Aria', 'Akbariyeh', 1102703221, 1102703221, '$2y$10$zzz0xGWMgS1AvqLEhC5Y9.0xVCxlNuyBEqcJPCvZljWhOB6EMCnaC', 'Faculty of Management', 'FOM_AE15', 'Graduated', '1128802837', 'Cyberia, Cyberjaya , Selangor, Malaysia', 'aria.ak7@gmail.com', 3.24, 26),
('John', 'Doe', 1102706646, 1102706646, '$2y$10$s856Dk8fCIMCdqKJDfPZ/.645FgQKtFEXEKQDzpldLG53hNFEi0rG', 'Faculty of Engineering', 'FOE_CE15', 'Graduated', '01137705434', '4673 Spruce Avenue \r\nMinneapolis, MN 55406', 'JohnDoe@gmail.com', 3.41, 25),
('Joan', 'Fernn', 1103805006, 1103805006, '$2y$10$YgeRWdoaNZX9geWet2PbUOjkdR8554kNogujjQfnkz2ruxjjDde6y', 'Faculty of Management', 'FOM_AE15', 'Approved', '0', 'null', 'null', 3.35, 0),
('Bob', 'Hopkins', 1106903311, 1106903311, '$2y$10$Mw9.3UPSjknVe.7pXs/1BuxJ/14Up3HxUyp8Wu.uCCMEXrcshmWra', 'Faculty of Engineering', 'FCI_SE15', 'Applied for Graduation', '0', 'null', 'null', 3.42, 0),
('Alice', 'Jonson', 1109801212, 1109801212, '$2y$10$moRSNOwePcs0x17lazIYZOaaqcZV1BZqKzTzh3g.mU6uPSVo5/E8G', 'Faculty of Engineering', 'FOE_CE15', 'Applied for Graduation', '1860507170', '4246 High Street \r\nHarvey, IL 60426', 'Alice_Jonson@yahoo.com', 3.39, 0),
('David', 'Ross', 1112703323, 1112703323, '$2y$10$sstOCMTyqcJ7RIvuOG7JxeDfrdIvecRhhg/4XyJ4hkr23.J2kctBa', 'Faculty of Management', 'FOM_AE15', 'Active', '117863232', 'Cresent1, Cyberjaya, Selangor', 'David.Ross@gmail.com', 0, NULL),
('Tom', 'Sander', 1113809091, 1113809091, '$2y$10$qgBRL8NsZEg9uvTj5p3TYOUbHtJhBFvU/.zQUqmkuksL0GhF5qLXq', 'Faculty of Engineering', 'FOE_CE15', 'Graduated', '6039898123', 'cyberjaya', 'Tom.Sander@gmail.com', 2, 24),
('Samuel', 'Rex', 1115609090, 1115609090, '$2y$10$.XumPhEA//Zqu0kMr6c0puejmOSESIHbzABx37Q/LwJQ8mQ2Lv0sa', 'Faculty of Computing and Informatics', 'FCI_SE15', 'Graduated', '185403030', '676 Sycamore Drive \r\nWest New York, NJ 07093', 'SamiRex@icloud.com', 2, 23),
('Afra', 'Johnson', 1119503432, 1119503432, '$2y$10$sXZt7.5gh.E7RkyNclDs5usVZxGbjzTmQ6.VlI5E8G11dbPJ3Pxp.', 'Faculty of Computing and Informatics', 'FCI_SE15', 'Eligible for Graduation', '0', 'null', 'null', 3.12, 0),
('Dash', 'Mehdi', 1119807878, 1119807878, '$2y$10$VH2shaOiHGGLd4hYDnvQZeRfPmi8mIDHvYBl.o0Mh32K3szw4efBO', 'Faculty of Computing and Informatics', 'FCI_SE15', 'Active', '0', 'null', 'null', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `subject_code` varchar(20) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `credit_hours` int(3) NOT NULL,
  `course_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_code`, `subject_name`, `credit_hours`, `course_code`) VALUES
('BAC1024', 'Principles of Accounting', 3, 'FOM_AE15'),
('BAE1010', 'Preparatory Management English', 3, 'FOM_AE15'),
('BAE1024', 'Advanced Management English', 3, 'FOM_AE15'),
('BBR3044', 'Research Project I', 2, 'FOM_AE15'),
('BBR3064', 'Research Project II', 3, 'FOM_AE15'),
('BCT1024', 'Critical Thinking and Application in Management', 3, 'FOM_AE15'),
('BEC1034', 'Microeconomics', 3, 'FOM_AE15'),
('BEC2044', 'Econometrics I', 3, 'FOM_AE15'),
('BEC6667', 'Macroeconimcs', 3, 'FOM_AE15'),
('BEN2010', 'Introduction to Cyberpreneurship', 1, 'FOM_AE15'),
('BFE2074', 'Financial Economics', 3, 'FOM_AE15'),
('BFN1014', 'Financial Management I', 3, 'FOM_AE15'),
('BHM3086', 'Law for Engineers', 3, 'FOE_CE15'),
('BIE2024', 'Intermediate Microeconomics', 3, 'FOM_AE15'),
('BMD3024', 'Multivariate Data Analysis', 3, 'FOM_AE15'),
('BME2034', 'Malaysian Economy', 3, 'FOM_AE15'),
('BMG1014', 'Management', 3, 'FOM_AE15'),
('BMS1024', 'Managerial Statistics', 3, 'FOM_AE15'),
('BMT1014', 'Managerial Mathematics', 3, 'FOM_AE15'),
('BMT1024', 'Advanced Managerial Mathematics', 3, 'FOE_CE15'),
('BPB2034', 'Programming for Business Applications', 3, 'FOM_AE15'),
('BRM2034', 'Research Methodology', 3, 'FOM_AE15'),
('ECE1016', 'Computer and Program Design', 3, 'FOE_CE15'),
('ECE1026', 'Algorithms and Data Structures', 3, 'FOE_CE15'),
('ECE2046', 'Computer Organization and Architecture', 3, 'FOE_CE15'),
('ECE2056', 'Data Communications and Networking', 3, 'FOE_CE15'),
('ECE2066', 'Operating Systems', 3, 'FOE_CE15'),
('ECE2216', 'Microcontroller and Microprocessor Systems', 3, 'FOE_CE15'),
('ECE3076', 'Database Systems', 3, 'FOE_CE15'),
('ECE3166', 'Advanced Microprocessors', 3, 'FOE_CE15'),
('ECE3206', 'Object Oriented Programming with C++', 3, 'FOE_CE15'),
('EEE1016', 'Engineering Mathematics I', 3, 'FOE_CE15'),
('EEE1026', 'Introduction to Machines and Power Systems', 3, 'FOE_CE15'),
('EEE1036', 'Digital Logic Design', 3, 'FOE_CE15'),
('EEE1046', 'Electronics III', 3, 'FOE_CE15'),
('EEL1166', 'Circuit Theory', 3, 'FOE_CE15'),
('EEL1176', 'Field Theory', 3, 'FOE_CE15'),
('EEL1196', 'Instrumentation & Measurement Techniques', 3, 'FOE_CE15'),
('EEL2186', 'Circuits and Signals', 3, 'FOE_CE15'),
('EEL2216', 'Control Theory', 3, 'FOE_CE15'),
('EES3016', 'Engineer and Society', 3, 'FOE_CE15'),
('EES3026', 'Introduction to Research Methodology', 3, 'FOE_CE15'),
('EMF2016', 'Electromagnetic Theory', 3, 'FOE_CE15'),
('EMT1016', 'Engineering Mathematics I ', 3, 'FOE_CE15'),
('EMT1026', 'Engineering Mathematics II', 3, 'FOE_CE15'),
('EMT2036', 'Engineering Mathematics III', 3, 'FOE_CE15'),
('EMT2046', 'Engineering Mathematics IV', 3, 'FOE_CE15'),
('ETN3046', 'Analog and Digital Communications', 3, 'FOE_CE15'),
('ETN3096', 'Digital Signal Processing', 3, 'FOE_CE15'),
('MMB2013', 'Digital Media I', 3, 'FOM_AE15'),
('MPW2133', 'Malaysian Studies', 3, 'FOM_AE15'),
('PWC1010', 'Workplace\r\nCommunication', 3, 'FCI_SE15'),
('TCP1101', 'Programming Fundamentals', 4, 'FCI_SE15'),
('TCP1201', 'Object Oriented\r\nProgramming &\r\nData Structures', 4, 'FCI_SE15'),
('TCP2101', 'Algorithm Design & Analysis ', 4, 'FCI_SE15'),
('TCP2201', 'Object Oriented Analysis & Design ', 4, 'FCI_SE15'),
('TIS1101', 'Database\r\nFundamental', 4, 'FCI_SE15'),
('TIS3151', 'Software Reliability & Quality Assurance ', 4, 'FCI_SE15'),
('TMA1101', 'Calculus', 4, 'FCI_SE15'),
('TMA1201', 'Discrete\r\nStrcutures & \r\nProbability', 4, 'FCI_SE15'),
('TMA1301', 'Computational\r\nMethods', 4, 'FCI_SE15'),
('TPT1101', 'Professional\r\nDevelopment', 4, 'FCI_SE15'),
('TPT1201', 'Research\r\nMethodology', 3, 'FCI_SE15'),
('TSE2101', 'Software\r\nEngineering\r\nFundamentals', 4, 'FCI_SE15'),
('TSE2451', 'Software Requirements Engineering ', 4, 'FCI_SE15'),
('TSE3151', ' Software Design ', 4, 'FCI_SE15'),
('TSE3251', 'Software Verification & Validation ', 4, 'FCI_SE15'),
('TSN1101', 'Computer\r\nArchitechture &\r\nOrganization', 4, 'FCI_SE15'),
('TSN2101', 'Operating\r\nSystems', 4, 'FCI_SE15'),
('TSN2201', 'Computer Networks', 4, 'FCI_SE15');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `first_seat_number` varchar(255) NOT NULL,
  `second_seat_number` varchar(255) NOT NULL,
  `robe_size` varchar(255) NOT NULL,
  `convocation_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `first_seat_number`, `second_seat_number`, `robe_size`, `convocation_id`) VALUES
(23, 'Guests-C0-18', 'Guests-C0-17', '45', 1),
(24, 'Guests-E0-20', 'Guests-E0-19', '51', 1),
(25, 'Others-A0-1', 'Others-A0-2', '36', 3),
(26, 'Guests-C0-23', 'Guests-C0-24', '45', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `convocation`
--
ALTER TABLE `convocation`
  ADD PRIMARY KEY (`convocation_id`);

--
-- Indexes for table `convocation_faculty`
--
ALTER TABLE `convocation_faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`student_id`,`subject_code`),
  ADD KEY `subject_code` (`subject_code`);

--
-- Indexes for table `seat_group`
--
ALTER TABLE `seat_group`
  ADD PRIMARY KEY (`label`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_code`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `convocation`
--
ALTER TABLE `convocation`
  MODIFY `convocation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `convocation_faculty`
--
ALTER TABLE `convocation_faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_1` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`),
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`),
  ADD CONSTRAINT `mark_ibfk_3` FOREIGN KEY (`subject_code`) REFERENCES `subject` (`subject_code`),
  ADD CONSTRAINT `mark_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`course_code`) REFERENCES `course` (`course_code`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
