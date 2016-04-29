-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2016 at 04:51 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resultdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `board_admin`
--

CREATE TABLE `board_admin` (
  `board_name` varchar(45) NOT NULL,
  `board_id` int(11) NOT NULL,
  `board_admin_email` varchar(45) NOT NULL,
  `board_admin_password` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `board_admin`
--

INSERT INTO `board_admin` (`board_name`, `board_id`, `board_admin_email`, `board_admin_password`) VALUES
('Dhaka', 1001, 'dhaka@gmail.com', '1234'),
('Comilla', 1002, 'comilla@gmail.com', '1234'),
('Dinajpur', 1003, 'dinajpur@gmail.com', '1234'),
('Sylhet', 1004, 'sylhet@gmail.com', '1234'),
('Chittagong ', 1005, 'chittagong@gmail.com', '1234'),
('Rajshahi', 1006, 'rajshahi@gmail.com', '1234'),
('Jessore ', 1007, 'jessore@gmail.com', '1234'),
('Barisal', 1008, 'barisal@gmail.com', '1234'),
('Madrasah Board', 1009, 'madrasah_board@gmail.com', '1234'),
('Technical Board', 1010, 'technical_board@gmail.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `institute_name` varchar(45) NOT NULL,
  `institute_code` int(11) NOT NULL,
  `institute_email` varchar(45) NOT NULL,
  `institute_password` varchar(45) NOT NULL,
  `board_name` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`institute_name`, `institute_code`, `institute_email`, `institute_password`, `board_name`) VALUES
('IDEAL SCHOOL & COLLEGE(M)', 2001, 'ISC@gmail.com', '1000', 'Dhaka'),
('VIQARUNNISA NOON HIGH SCHOOL', 2002, 'vnsc@gmail.com', '1000', 'Dhaka'),
('Comilla Cantonment High School', 2003, 'CCHC@gmail.com', '1000', 'Comilla'),
('Dinajpur Govt. High School', 2004, 'DGHS@gmail.com', '1000', 'Dinajpur'),
('Sylhet Pilot High School', 2005, 'SPHS@gmail.com', '1000', 'Sylhet'),
('Anwara Model High School', 2006, 'AMHS@gmail.com', '1000', 'Chittagong'),
('Government Laboratory High School', 2007, 'GLHS@gmail.com', '1000', 'Rajshahi'),
('Jessore Cantonment High School', 2008, 'JCHS@gmail.com', '1000', 'Jessore'),
('Udayan Secondary School', 2009, 'USS@gmail.com', '1000', 'Barisal'),
('Apornacharan Girls High School', 2010, 'AGHS@gmail.com', '1000', 'Chittagong');

-- --------------------------------------------------------

--
-- Table structure for table `result_info`
--

CREATE TABLE `result_info` (
  `year` int(11) NOT NULL,
  `board` varchar(45) DEFAULT NULL,
  `cgpa` float DEFAULT NULL,
  `student_roll` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result_info`
--

INSERT INTO `result_info` (`year`, `board`, `cgpa`, `student_roll`) VALUES
(2015, 'Dhaka', 5, 1),
(2015, 'Dhaka', 4.96, 2),
(2015, 'Comilla', 5, 3),
(2015, 'Dinajpur', 4.99, 4),
(2015, 'Chittagong', 4.88, 5),
(2015, 'Chittagong', 5, 6),
(2015, 'Sylhet', 5, 7),
(2015, 'Rajshahi', 4.96, 8),
(2015, 'Jessore', 5, 9),
(2015, 'Barisal', 5, 10);

-- --------------------------------------------------------

--
-- Table structure for table `student_academic_info`
--

CREATE TABLE `student_academic_info` (
  `roll` int(11) NOT NULL,
  `registration` int(11) NOT NULL,
  `group` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `institute_code` int(11) NOT NULL,
  `board_name` varchar(45) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_academic_info`
--

INSERT INTO `student_academic_info` (`roll`, `registration`, `group`, `type`, `institute_code`, `board_name`) VALUES
(1, 21, 'Science', 'Regular', 2001, 'Dhaka'),
(2, 22, 'Science', 'Regular', 2002, 'Dhaka'),
(3, 23, 'Commerce', 'Regular', 2003, 'Comilla'),
(4, 24, 'Science', 'Regular', 2004, 'Dinajpur'),
(5, 25, 'Science', 'Regular', 2006, 'Chittagong'),
(6, 26, 'Commerce', 'Regular', 2010, 'Chittagong'),
(7, 27, 'Science', 'Regular', 2005, 'Sylhet'),
(8, 28, 'Science', 'Regular', 2007, 'Rajshahi'),
(9, 29, 'Commerce', 'Regular', 2008, 'Jessore'),
(10, 30, 'Science', 'Regular', 2009, 'Barisal');

-- --------------------------------------------------------

--
-- Table structure for table `student_personal_info`
--

CREATE TABLE `student_personal_info` (
  `student_name` varchar(45) NOT NULL,
  `father_name` varchar(45) NOT NULL,
  `mother_name` varchar(45) NOT NULL,
  `date_of_birth` date NOT NULL,
  `roll` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_personal_info`
--

INSERT INTO `student_personal_info` (`student_name`, `father_name`, `mother_name`, `date_of_birth`, `roll`) VALUES
('MOHAMMAD MAHBUBUL BARI', 'MD. ABDUL BARI', 'SUKTARA BARI', '2015-12-17', 1),
('Jannatul Abrar', 'SAYEDUL ABRAR', 'SHAMIMA ABRAR', '2015-12-17', 2),
('MASUDUR RAHMAN', 'A. B. M. ABDUR RAHMAN', 'MAJEDA BEGUM', '2015-12-17', 3),
('MD. EAZAZUL HAQUE', 'MD. EMDADUL HAQUE', 'HAFIZA KHANAM', '2015-12-17', 4),
('NISHAT SADAF PEYA', 'MD. SAIFUL ISLAM', 'SULTANA YESMIN', '2015-12-17', 5),
('REFAT-E-RUBAIA', 'RAFIQUL ISLAM', 'SHAMIMA SULTANA', '2015-12-17', 6),
('MRINAL DEBNATH', 'NONI GOPAL DEBNATH', 'KAZAL RANI DEBNATH', '2015-12-17', 7),
('ANTOR MAHMUD', 'MAHBUB AZAM RAZA', 'MORIOM SIDDIKA', '2015-12-17', 8),
('MD. ABUL HASAN SHOVON', 'MD. SHAMSUL HAQUE', 'ROSHONARA BAGUM', '2015-12-17', 9),
('RINAT MALIK', 'ABDUL MALEK', 'MINA PARVEEN', '2015-12-17', 10);

-- --------------------------------------------------------

--
-- Table structure for table `subject_wise_result`
--

CREATE TABLE `subject_wise_result` (
  `subject_name` varchar(45) NOT NULL,
  `subject_code` int(11) NOT NULL,
  `subject_gpa` int(11) NOT NULL,
  `student_roll` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_wise_result`
--

INSERT INTO `subject_wise_result` (`subject_name`, `subject_code`, `subject_gpa`, `student_roll`) VALUES
('Bangla I', 101, 5, 1),
('Bangla II', 102, 5, 1),
('English I', 103, 5, 1),
('English II', 104, 5, 1),
('Mathematics', 105, 5, 1),
('Religion', 106, 5, 1),
('Social Science', 107, 5, 1),
('Physics', 108, 5, 1),
('Chemistry', 109, 5, 1),
('Biology', 110, 5, 1),
('Higher Mathematics', 111, 5, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `board_admin`
--
ALTER TABLE `board_admin`
  ADD PRIMARY KEY (`board_id`),
  ADD UNIQUE KEY `admin_id_UNIQUE` (`board_id`),
  ADD UNIQUE KEY `admin_email_UNIQUE` (`board_admin_email`),
  ADD UNIQUE KEY `board_name_UNIQUE` (`board_name`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`institute_code`),
  ADD UNIQUE KEY `institute_code_UNIQUE` (`institute_code`),
  ADD UNIQUE KEY `institute_name_UNIQUE` (`institute_name`),
  ADD UNIQUE KEY `institute_email_UNIQUE` (`institute_email`),
  ADD KEY `fk_board_name` (`board_name`);

--
-- Indexes for table `result_info`
--
ALTER TABLE `result_info`
  ADD KEY `fk_student_roll` (`student_roll`),
  ADD KEY `fk_board` (`board`);

--
-- Indexes for table `student_academic_info`
--
ALTER TABLE `student_academic_info`
  ADD PRIMARY KEY (`roll`),
  ADD UNIQUE KEY `roll_UNIQUE` (`roll`),
  ADD UNIQUE KEY `registration_UNIQUE` (`registration`),
  ADD KEY `fk_institute_code` (`institute_code`),
  ADD KEY `fk_brd_name` (`board_name`);

--
-- Indexes for table `student_personal_info`
--
ALTER TABLE `student_personal_info`
  ADD PRIMARY KEY (`roll`),
  ADD UNIQUE KEY `student_id_UNIQUE` (`roll`);

--
-- Indexes for table `subject_wise_result`
--
ALTER TABLE `subject_wise_result`
  ADD KEY `fk_st_roll` (`student_roll`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
