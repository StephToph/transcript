-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2022 at 06:18 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transcript_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tr_class`
--

CREATE TABLE `tr_class` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_class`
--

INSERT INTO `tr_class` (`id`, `name`) VALUES
(1, 'Manager'),
(2, 'Supervisors'),
(3, 'Auditor');

-- --------------------------------------------------------

--
-- Table structure for table `tr_course`
--

CREATE TABLE `tr_course` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `unit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_course`
--

INSERT INTO `tr_course` (`id`, `code`, `name`, `unit`) VALUES
(1, 'mth111', 'LOGIC AND LINEAR ALGEBRA', 2),
(3, 'COM111', 'INTRODUCTION TO COMPUTING', 3),
(4, 'COM112', 'INTRODUCTION TO DIGITAL ELECTRONICS', 3),
(5, 'COM113', 'INTRODUCTION TO PROGRAMMING', 3),
(6, 'STA111 ', 'DISCRIPTIVE STATISTICS 1', 2),
(7, 'STA112', 'ELEMENTARY PROBABILITY THEORY', 2),
(8, 'MTH112', 'TRI. AND ANALYTICAL GEOMETRY', 2),
(9, 'OTM112 ', 'TECHNICAL ENGLISH 1', 2),
(10, 'GNS117 ', 'CITIZENSHIP EDUCATION 1', 2),
(11, 'GNS111 ', 'USE OF LIBRARY', 1),
(12, 'COM215 ', 'COMPUTER PACKAGES II', 3),
(13, 'COM211', 'COMPUTER PROG USING OO BASIC', 3),
(14, 'COM212 ', 'INTRO TO SYSTEM PROGRAMMING', 3),
(15, 'GNS211 ', 'INTRODUCTION TO SOCIOLOGY', 2),
(16, 'COM214 ', 'FILE ORGANIZATION AND MANAGEMENT', 2),
(17, 'COM216 ', 'COMPUTER TROUBLESHOOTING 1', 2),
(18, 'COM217 ', 'INTRODUCTION TO LINUX OPERATING SYSTEM', 2),
(19, 'COM213 ', 'COMMERCIAL PROG. USING OO COBOL', 3),
(20, 'EED213 ', 'ENTERPRENEURSHIP', 2),
(21, 'COM219', 'SEMINAR', 0),
(22, 'COM312 ', 'DATABASE DESIGN I ', 3),
(23, 'COM313 ', 'COMPUTER PROGRAMMING USING C++', 3),
(24, 'COM314 ', 'COMPUTER ARCHITECTURE ', 3),
(25, 'COM315', 'WEB DEVELOPMENT & DESIGN USING DRUPAL', 3),
(26, 'COM311 ', 'OPERATING SYSTEM I ', 3),
(27, 'STA311 ', 'STATISTICS THEORY I ', 2),
(28, 'STA314 ', 'OPERATIONS RESEARCH I', 2),
(29, 'OTM315 ', 'BUSINESS COMMUNICATIONS I', 2),
(30, 'EED312 ', 'ENTREPRENEURSHIP DEVELOPMENT', 2),
(31, 'COM321 ', 'OPERATING SYSTEM II', 3),
(32, 'COM322 ', 'DATABASE DESIGN II', 3),
(33, 'COM323 ', 'ASSEMBLY LANGUAGE', 3),
(34, 'COM324 ', 'INTRO. TO SOFTWARE ENGINEERING', 3),
(35, 'COM326 ', 'INTRO. TO HUMAN COMP. INTERFACE', 2),
(36, 'STA321 ', 'STATISTICS THEORY I', 2),
(37, 'OTM412 ', 'BUSINESS COMMUNICATIONS II', 2),
(38, 'COM 121 ', 'SCIENTIFIC PROG. LANG.Using OOFORTRAN', 3),
(39, 'COM 122 ', 'INTRODUCTION TO INTERNET', 3),
(40, 'COM 123 ', 'COMPUTER APPLICATION PACKAGE I', 3),
(41, 'COM 124 ', 'DATA STRUCTURE & ALGORITHMS', 3),
(42, 'COM 125 ', 'INTRODUCTION TO SYSTEMS ANALYSIS', 3),
(43, 'COM 126 ', 'PC UPGRADE & MAINTENANCE', 2),
(44, 'GNS 128 ', 'CITIZENSHIP EDUCATION II', 2),
(45, 'EED 126 ', 'ENTREPRENEURSHIP DEVELOPMENT', 2),
(46, 'MTH 124 ', 'CALCULUS', 2),
(47, 'COM 221 ', 'COMP. PROG USING OO FORTRAN', 3),
(48, 'COM 222 ', 'SEMINAR ON COMP. & SOCIETY', 2),
(49, 'COM 223 ', 'BASIC HARDWARE MAINTENANCE', 3),
(50, 'COM 224 ', 'MANAGEMENT INFORMATION SYSTEM', 3),
(51, 'COM 225 ', 'WEB TECHNOLOGY', 3),
(52, 'COM 226 ', 'COMPUTER SYSTEMS TROUBLESHOOTING', 2),
(53, 'COM 229 ', 'PROJECT', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tr_course_allocate`
--

CREATE TABLE `tr_course_allocate` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `semester` varchar(10) NOT NULL,
  `programme_type` varchar(10) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_course_allocate`
--

INSERT INTO `tr_course_allocate` (`id`, `course_code`, `semester`, `programme_type`, `level`) VALUES
(1, 'mth111', 'First', 'Full', 'ND1'),
(2, 'COM111', 'First', 'Full', 'ND1'),
(3, 'COM112', 'First', 'Full', 'ND1'),
(4, 'COM113', 'First', 'Full', 'ND1'),
(5, 'STA111 ', 'First', 'Full', 'ND1'),
(6, 'STA112', 'First', 'Full', 'ND1'),
(7, 'MTH112', 'First', 'Full', 'ND1'),
(8, 'OTM112 ', 'First', 'Full', 'ND1'),
(9, 'GNS117 ', 'First', 'Full', 'ND1'),
(10, 'GNS111 ', 'First', 'Full', 'ND1'),
(12, 'COM 121 ', 'Second', 'Full', 'ND1'),
(13, 'COM 122 ', 'Second', 'Full', 'ND1'),
(14, 'COM 123 ', 'Second', 'Full', 'ND1'),
(15, 'COM 124 ', 'Second', 'Full', 'ND1'),
(16, 'COM 125 ', 'Second', 'Full', 'ND1'),
(17, 'COM 126 ', 'Second', 'Full', 'ND1'),
(18, 'GNS 128 ', 'Second', 'Full', 'ND1'),
(19, 'EED 126 ', 'Second', 'Full', 'ND1'),
(20, 'MTH 124 ', 'Second', 'Full', 'ND1'),
(21, 'COM211', 'First', 'Full', 'ND2'),
(22, 'COM212 ', 'First', 'Full', 'ND2'),
(23, 'COM215 ', 'First', 'Full', 'ND2'),
(24, 'COM213 ', 'First', 'Full', 'ND2'),
(25, 'COM214 ', 'First', 'Full', 'ND2'),
(26, 'COM216 ', 'First', 'Full', 'ND2'),
(27, 'COM217 ', 'First', 'Full', 'ND2'),
(28, 'GNS211 ', 'First', 'Full', 'ND2'),
(29, 'COM219', 'First', 'Full', 'ND2'),
(30, 'EED213 ', 'First', 'Full', 'ND2'),
(31, 'COM 221 ', 'Second', 'Full', 'ND2'),
(32, 'COM 222 ', 'Second', 'Full', 'ND2'),
(33, 'COM 223 ', 'Second', 'Full', 'ND2'),
(34, 'COM 224 ', 'Second', 'Part', 'ND2'),
(35, 'COM 225 ', 'Second', 'Full', 'ND2'),
(36, 'COM 226 ', 'Second', 'Full', 'ND2'),
(37, 'COM 229 ', 'Second', 'Full', 'ND2');

-- --------------------------------------------------------

--
-- Table structure for table `tr_result`
--

CREATE TABLE `tr_result` (
  `id` bigint(20) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `session` varchar(10) NOT NULL,
  `approve_status` int(11) NOT NULL DEFAULT 0,
  `approved_by` varchar(15) DEFAULT NULL,
  `course_code` varchar(9) NOT NULL,
  `exam` int(11) NOT NULL,
  `ca` int(11) NOT NULL,
  `lecturer` varchar(9) NOT NULL,
  `total` int(11) NOT NULL,
  `level` varchar(8) NOT NULL,
  `semester` varchar(9) NOT NULL,
  `programme_type` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_result`
--

INSERT INTO `tr_result` (`id`, `student_id`, `session`, `approve_status`, `approved_by`, `course_code`, `exam`, `ca`, `lecturer`, `total`, `level`, `semester`, `programme_type`) VALUES
(11, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'GNS111 ', 30, 40, 'St001', 70, 'ND1', 'First', 'Full'),
(12, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'GNS117 ', 0, 40, 'St001', 40, 'ND1', 'First', 'Full'),
(13, 'NCSF/22/0001', '2021/2022', 1, NULL, 'MTH 124 ', 40, 30, 'St001', 70, 'ND1', 'Second', 'Full'),
(14, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'OTM112 ', 40, 30, 'St001', 70, 'ND1', 'First', 'Full'),
(15, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'MTH112', 30, 30, 'St001', 60, 'ND1', 'First', 'Full'),
(16, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'STA112', 50, 20, 'St001', 70, 'ND1', 'First', 'Full'),
(17, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'STA111 ', 20, 40, 'St001', 60, 'ND1', 'First', 'Full'),
(18, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM113', 30, 30, 'St001', 60, 'ND1', 'First', 'Full'),
(19, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM112', 30, 20, 'St001', 50, 'ND1', 'First', 'Full'),
(20, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM111', 30, 20, 'St001', 50, 'ND1', 'First', 'Full'),
(21, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'mth111', 30, 20, 'St001', 50, 'ND1', 'First', 'Full'),
(22, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'EED 126 ', 30, 20, 'St001', 50, 'ND1', 'Second', 'Full'),
(23, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'GNS 128 ', 30, 20, 'St001', 50, 'ND1', 'Second', 'Full'),
(24, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 126 ', 40, 20, 'St001', 60, 'ND1', 'Second', 'Full'),
(25, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 125 ', 40, 30, 'St001', 70, 'ND1', 'Second', 'Full'),
(26, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 124 ', 50, 20, 'St001', 70, 'ND1', 'Second', 'Full'),
(27, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 123 ', 50, 30, 'St001', 80, 'ND1', 'Second', 'Full'),
(28, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 122 ', 50, 30, 'St001', 80, 'ND1', 'Second', 'Full'),
(29, 'NCSF/22/0001', '2021/2022', 1, 'St001', 'COM 121 ', 50, 20, 'St001', 70, 'ND1', 'Second', 'Full'),
(30, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'EED213 ', 50, 30, 'St001', 80, 'ND2', 'First', 'Full'),
(31, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM219', 40, 40, 'St001', 80, 'ND2', 'First', 'Full'),
(32, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'GNS211 ', 30, 20, 'St001', 50, 'ND2', 'First', 'Full'),
(33, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM217 ', 30, 20, 'St001', 50, 'ND2', 'First', 'Full'),
(34, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM216 ', 50, 30, 'St001', 80, 'ND2', 'First', 'Full'),
(35, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM214 ', 50, 30, 'St001', 80, 'ND2', 'First', 'Full'),
(36, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM213 ', 40, 30, 'St001', 70, 'ND2', 'First', 'Full'),
(37, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM215 ', 50, 30, 'St001', 80, 'ND2', 'First', 'Full'),
(38, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM212 ', 40, 30, 'St001', 70, 'ND2', 'First', 'Full'),
(39, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM211', 40, 30, 'St001', 70, 'ND2', 'First', 'Full'),
(40, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 226 ', 50, 40, 'St001', 90, 'ND2', 'Second', 'Full'),
(41, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 229 ', 50, 30, 'St001', 80, 'ND2', 'Second', 'Full'),
(42, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 225 ', 40, 30, 'St001', 70, 'ND2', 'Second', 'Full'),
(43, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 223 ', 30, 20, 'St001', 50, 'ND2', 'Second', 'Full'),
(44, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 222 ', 40, 20, 'St001', 60, 'ND2', 'Second', 'Full'),
(45, 'NCSF/22/0001', '2022/2023', 1, 'St001', 'COM 221 ', 40, 30, 'St001', 70, 'ND2', 'Second', 'Full');

-- --------------------------------------------------------

--
-- Table structure for table `tr_result_grade`
--

CREATE TABLE `tr_result_grade` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `semester` varchar(8) NOT NULL,
  `session` varchar(15) NOT NULL,
  `level` varchar(9) NOT NULL,
  `gpa` varchar(7) NOT NULL,
  `cgpa` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_result_grade`
--

INSERT INTO `tr_result_grade` (`id`, `student_id`, `semester`, `session`, `level`, `gpa`, `cgpa`) VALUES
(7, 'NCSF/22/0001', 'First', '2021/2022', 'ND1', '2.84', '1.57'),
(8, 'NCSF/22/0001', 'Second', '2021/2022', 'ND1', '3.42', '3.13'),
(9, 'NCSF/22/0001', 'First', '2022/2023', 'ND2', '3.53', '3.26'),
(10, 'NCSF/22/0001', 'Second', '2022/2023', 'ND2', '2.94', '3.18');

-- --------------------------------------------------------

--
-- Table structure for table `tr_session`
--

CREATE TABLE `tr_session` (
  `id` int(11) NOT NULL,
  `session` varchar(10) NOT NULL,
  `current` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_session`
--

INSERT INTO `tr_session` (`id`, `session`, `current`) VALUES
(1, '2020_2021', 0),
(2, '2021_2022', 1),
(5, '2022_2023', 0),
(6, '2019_2020', 0),
(7, '2023_2024', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tr_student`
--

CREATE TABLE `tr_student` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `reg_date` datetime NOT NULL,
  `level` varchar(8) NOT NULL,
  `address` varchar(200) NOT NULL,
  `programme_type` varchar(9) NOT NULL,
  `img_id` text NOT NULL,
  `admission_session` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_student`
--

INSERT INTO `tr_student` (`id`, `student_id`, `surname`, `firstname`, `gender`, `reg_date`, `level`, `address`, `programme_type`, `img_id`, `admission_session`) VALUES
(2, 'NCSF/22/0002', 'owolabi', 'damola', 'Female', '2021-10-08 23:33:21', 'HND', '40, Emmanuel Aina, Street, Odokekere, Odogunyan, Ikorodu', 'Barguna D', 'assets/img/users/1633728801.jpg', '2020_2021'),
(3, 'NCSF/22/0003', 'TAYE', 'CURRENCY', 'Female', '2021-10-10 18:49:13', 'HND', '07031549500', 'Tasmania', '', '2021_2022'),
(4, 'NCSF/22/0004', 'Bodunde', 'Damola', 'Male', '2021-10-12 07:11:35', 'ND', '40, Emmanuel Aina,', 'Full', 'assets/img/users/1634015495.jpg', '2021_2022'),
(6, 'NCSF/22/0005', 'ADEAGBO', 'STEPHEN', 'Female', '2022-02-08 22:02:04', 'ND', 'USI-EKITI, IDO OSI, EKITI', 'Full', 'assets/img/users/1644354124.png', '2020_2021'),
(7, 'NCSF/22/0001', 'ADEAGBO', 'STEPHEN', 'Male', '2022-03-01 19:17:18', 'ND', 'USI-EKITI, IDO OSI, EKITI', 'Full', 'assets/img/users/1646158638.jpg', '2021_2022');

-- --------------------------------------------------------

--
-- Table structure for table `tr_transcript`
--

CREATE TABLE `tr_transcript` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` int(11) NOT NULL DEFAULT 0,
  `request_approve` varchar(15) NOT NULL,
  `request_type` varchar(20) NOT NULL,
  `receiver_email` varchar(100) DEFAULT NULL,
  `date_approved` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tr_transcript`
--

INSERT INTO `tr_transcript` (`id`, `student_id`, `request_date`, `request_status`, `request_approve`, `request_type`, `receiver_email`, `date_approved`) VALUES
(1, 'NCSF/22/0001', '2022-03-17', 1, '1', 'Official', 'tofunmi015@gmail.com', '2022-03-18 22:33:18'),
(2, 'NCSF/22/0001', '2022-03-20', 2, '1', 'Official', 'tofunmi015@gmail.com', '2022-03-20 18:35:08'),
(3, 'NCSF/22/0004', '2022-03-20', 1, '1', 'Unofficial', '', '2022-03-20 18:42:17'),
(4, 'NCSF/22/0001', '2022-03-31', 0, '', 'Unofficial', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tr_user`
--

CREATE TABLE `tr_user` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `last_log` datetime NOT NULL,
  `active_stat` int(11) NOT NULL DEFAULT 0,
  `user_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_user`
--

INSERT INTO `tr_user` (`id`, `name`, `staff_id`, `password`, `last_log`, `active_stat`, `user_role`) VALUES
(1, 'Admin', 'St001', '827ccb0eea8a706c4c34a16891f84e7b', '2022-03-31 06:07:15', 1, 'Superadmin'),
(2, 'Alamo Akanni', 'st002', '827ccb0eea8a706c4c34a16891f84e7b', '2022-03-23 22:09:51', 1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tr_class`
--
ALTER TABLE `tr_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_course`
--
ALTER TABLE `tr_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_course_allocate`
--
ALTER TABLE `tr_course_allocate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_result`
--
ALTER TABLE `tr_result`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_result_grade`
--
ALTER TABLE `tr_result_grade`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_session`
--
ALTER TABLE `tr_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_student`
--
ALTER TABLE `tr_student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_transcript`
--
ALTER TABLE `tr_transcript`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tr_user`
--
ALTER TABLE `tr_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tr_class`
--
ALTER TABLE `tr_class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tr_course`
--
ALTER TABLE `tr_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tr_course_allocate`
--
ALTER TABLE `tr_course_allocate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tr_result`
--
ALTER TABLE `tr_result`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tr_result_grade`
--
ALTER TABLE `tr_result_grade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tr_session`
--
ALTER TABLE `tr_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tr_student`
--
ALTER TABLE `tr_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tr_transcript`
--
ALTER TABLE `tr_transcript`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_user`
--
ALTER TABLE `tr_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
