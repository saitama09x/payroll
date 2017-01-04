-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2016 at 02:36 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `payroll_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE IF NOT EXISTS `allowances` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `details` varchar(45) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `emp_id`, `details`, `amount`, `date_created`) VALUES
(1, 7, 'load allowance', '1000.00', '0000-00-00'),
(2, 1, 'travel allowance', '1000.00', '0000-00-00'),
(4, 1, 'load allowance', '100.00', '2016-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `assigntutor`
--

CREATE TABLE IF NOT EXISTS `assigntutor` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `stud_id` int(10) NOT NULL,
  `room_id` int(10) NOT NULL,
  `subject` varchar(60) NOT NULL,
  `assign_date` date NOT NULL DEFAULT '0000-00-00',
  `assign_time` time NOT NULL DEFAULT '00:00:00',
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `status` int(5) NOT NULL,
  `canceled` int(5) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assigntutor`
--

INSERT INTO `assigntutor` (`id`, `emp_id`, `stud_id`, `room_id`, `subject`, `assign_date`, `assign_time`, `start_date`, `start_time`, `end_date`, `end_time`, `status`, `canceled`) VALUES
(1, 7, 1, 1, 'Tutorial for subject math and science', '2016-12-03', '02:30:00', '2016-12-03', '03:50:00', '2016-12-03', '13:30:00', 2, 0),
(2, 8, 1, 1, 'Tutorial for subject science', '2016-12-08', '13:30:00', '2016-12-12', '13:35:00', '2016-12-06', '14:30:00', 2, 0),
(3, 1, 1, 1, 'Tutorial for subject math', '2016-12-20', '05:30:00', '2016-12-18', '14:34:18', '0000-00-00', '00:00:00', 2, 0),
(5, 1, 1, 1, 'Tutorial for subject test', '2016-12-20', '08:30:00', '2016-12-18', '14:36:57', '2016-12-18', '14:37:05', 2, 0),
(12, 1, 1, 1, 'asdasd', '2016-12-21', '05:30:00', '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00',
  `shifting_id` int(10) NOT NULL,
  `attendance_start_pic` longblob,
  `attendance_end_pic` longblob
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_id`, `date_created`, `start_time`, `end_time`, `shifting_id`, `attendance_start_pic`, `attendance_end_pic`) VALUES
(1, 1, '2016-12-12', '09:24:53', '19:01:00', 1, NULL, NULL),
(2, 1, '2016-12-13', '08:01:00', '15:50:43', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `authorities`
--

CREATE TABLE IF NOT EXISTS `authorities` (
  `username` varchar(100) NOT NULL,
  `authority` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `authorities`
--

INSERT INTO `authorities` (`username`, `authority`) VALUES
('admin', 'ADMIN'),
('admin1', 'ADMIN'),
('asdasd', 'ACCTG'),
('ian', 'ADMIN'),
('lorem', 'HR'),
('naruto', 'ADMIN');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE IF NOT EXISTS `bonuses` (
`id` int(100) NOT NULL,
  `name` varchar(45) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `payslip_id` int(10) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE IF NOT EXISTS `classrooms` (
`id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'Room One', 'testing', '2016-12-03 20:26:26'),
(2, 'myroom', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `deductiondetails`
--

CREATE TABLE IF NOT EXISTS `deductiondetails` (
`id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `deduction_id` int(11) NOT NULL,
  `details` varchar(15) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deductiondetails`
--

INSERT INTO `deductiondetails` (`id`, `emp_id`, `deduction_id`, `details`) VALUES
(4, 8, 1, ''),
(5, 8, 2, ''),
(6, 8, 3, ''),
(8, 1, 1, '12345'),
(9, 1, 2, '123123');

-- --------------------------------------------------------

--
-- Table structure for table `deductionpercent`
--

CREATE TABLE IF NOT EXISTS `deductionpercent` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `deduction_id` int(10) NOT NULL,
  `details` varchar(20) DEFAULT NULL,
  `percentage` decimal(10,2) NOT NULL DEFAULT '0.00',
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deductionpercent`
--

INSERT INTO `deductionpercent` (`id`, `emp_id`, `deduction_id`, `details`, `percentage`, `date_created`) VALUES
(3, 1, 1, '123', '0.20', '2016-12-29'),
(4, 1, 2, '12345', '0.30', '2016-12-29'),
(5, 1, 3, '1234567', '0.10', '2016-12-29');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE IF NOT EXISTS `deductions` (
`id` int(10) NOT NULL,
  `name` varchar(45) NOT NULL,
  `details` text,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `name`, `details`, `date_created`) VALUES
(1, 'Social Security System', 'sss', '2016-12-03'),
(2, 'Philippines Health Insurance', 'philhealth', '2016-12-03'),
(3, 'TAX', 'tax', '2016-12-03');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
`id` int(10) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender_id` int(10) NOT NULL,
  `address` varchar(100) NOT NULL,
  `position_id` int(10) NOT NULL,
  `pro_pic` varchar(20) NOT NULL,
  `status_id` int(5) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `lname`, `dob`, `gender_id`, `address`, `position_id`, `pro_pic`, `status_id`, `date_created`) VALUES
(1, 'admin', 'admin123', '2016-11-01', 1, 'iloilo', 1, '3.png', 2, '2016-12-29 00:00:00'),
(7, 'Naruto', 'Uzumaki', '2016-12-08', 1, 'testing', 1, '', 2, '2016-12-03 20:22:24'),
(8, 'Ian Paul', 'Jocsing', '1989-08-08', 1, 'arevalo', 2, '', 1, '2016-12-06 17:58:46'),
(30, 'test', 'test', '2016-12-08', 1, 'test', 1, '', 1, '2016-12-18 00:00:00'),
(31, 'asdasd', 'asdasd', '2016-12-08', 1, 'asdasd', 1, '', 1, '2016-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `empposition`
--

CREATE TABLE IF NOT EXISTS `empposition` (
`id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empposition`
--

INSERT INTO `empposition` (`id`, `name`, `date_created`) VALUES
(1, 'Teacher', '2016-08-10 00:00:00'),
(2, 'Accountant', '2016-08-17 00:00:00'),
(3, 'Student', '2016-12-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `empshifting`
--

CREATE TABLE IF NOT EXISTS `empshifting` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `empshifting`
--

INSERT INTO `empshifting` (`id`, `emp_id`, `start_time`, `end_time`) VALUES
(1, 1, '08:00:00', '17:00:00'),
(5, 2, '08:00:00', '17:00:00'),
(8, 7, '08:00:00', '05:30:00'),
(9, 8, '08:00:00', '17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `empstatus`
--

CREATE TABLE IF NOT EXISTS `empstatus` (
`id` int(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `empstatus`
--

INSERT INTO `empstatus` (`id`, `status`) VALUES
(1, 'Inactive'),
(2, 'Active'),
(3, 'Suspended'),
(4, 'Terminated'),
(5, 'Awol');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE IF NOT EXISTS `gender` (
`id` int(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `type`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `payslip`
--

CREATE TABLE IF NOT EXISTS `payslip` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `gross_pay` decimal(10,2) NOT NULL,
  `allowances` decimal(10,2) NOT NULL,
  `deductions` decimal(10,2) NOT NULL,
  `net_pay` decimal(10,2) NOT NULL,
  `cutoff_from` date NOT NULL,
  `cutoff_to` date NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payslip`
--

INSERT INTO `payslip` (`id`, `emp_id`, `gross_pay`, `allowances`, `deductions`, `net_pay`, `cutoff_from`, `cutoff_to`, `date_created`) VALUES
(1, 7, '333.33', '1000.00', '0.00', '1333.33', '2016-12-02', '2016-12-05', '2016-12-03'),
(2, 8, '333.33', '1000.00', '0.00', '1333.33', '2016-12-05', '2016-12-08', '2016-12-06'),
(3, 1, '800.00', '1100.00', '480.00', '1420.00', '2016-12-08', '2016-12-30', '2016-12-30'),
(4, 1, '800.00', '1100.00', '480.00', '1420.00', '2016-12-08', '2016-12-30', '2016-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE IF NOT EXISTS `salaries` (
`id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `emp_id`, `amount`, `type`, `status`, `date_created`) VALUES
(2, 7, '7000.00', 2, 1, '2016-12-06 18:14:43'),
(3, 1, '12000.00', 2, 1, '2016-12-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `salarytype`
--

CREATE TABLE IF NOT EXISTS `salarytype` (
`id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salarytype`
--

INSERT INTO `salarytype` (`id`, `name`, `date_created`) VALUES
(1, 'Monthly', '2016-12-14'),
(2, 'Weekly', '2016-12-14'),
(3, 'Daily', '2016-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
`id` int(10) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `dob` varchar(15) DEFAULT NULL,
  `gender_id` int(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `school` varchar(100) DEFAULT NULL,
  `date_created` date DEFAULT '0000-00-00'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `fname`, `lname`, `dob`, `gender_id`, `address`, `school`, `date_created`) VALUES
(1, 'Naruto', 'Uzumaki', '10', 2, 'testing', 'testing123', '2016-12-12'),
(7, 'asdasdassd', 'asdasd', '2016-12-28', 2, 'asdas12', 'dasd', '2016-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) NOT NULL,
  `emp_id` int(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT '0000-00-00 00:00:00',
  `date_modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emp_id`, `username`, `password`, `date_created`, `date_modified`) VALUES
(1, 1, 'admin', '$2a$10$a7XmJFMJiwEg5VIbPPnCDO.xlsPMjjcfOwqSrjjZBWS8l1nYDLbYS', '2016-08-09 09:29:49', NULL),
(13, 7, 'naruto', 'uzumaki', '2016-12-03 20:25:34', NULL),
(14, 8, 'ian', 'admin123', '2016-12-06 18:00:14', NULL),
(18, 26, 'asdasd', '$2y$10$brZGnZom8GSnAMLJEhaX8OtzV8wXzpLFu0PWi480IdtGe7WWqbn2y', '2016-12-18 00:00:00', NULL),
(21, 29, 'test', '$2y$10$0Wdgb7vhNS8qhMIMS4fmbOMU/bLOhcORMhCBqdUNdcCnBKt9jINza', '2016-12-18 00:00:00', NULL),
(22, 30, 'asdas', '$2y$10$TXbk2bIj/h3pGn/OHZuYQuJZFO1lfxoLv1pzUMYAhHSOtfQjHovJq', '2016-12-18 00:00:00', NULL),
(23, 31, 'asdasd', '$2y$10$Vqlq7fmBej8W6l7gE2ZrvejKsGMtZx70bGW9KXPBfvRhhGdzhTbq6', '2016-12-18 00:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigntutor`
--
ALTER TABLE `assigntutor`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authorities`
--
ALTER TABLE `authorities`
 ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductiondetails`
--
ALTER TABLE `deductiondetails`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductionpercent`
--
ALTER TABLE `deductionpercent`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empposition`
--
ALTER TABLE `empposition`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empshifting`
--
ALTER TABLE `empshifting`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empstatus`
--
ALTER TABLE `empstatus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payslip`
--
ALTER TABLE `payslip`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salarytype`
--
ALTER TABLE `salarytype`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `assigntutor`
--
ALTER TABLE `assigntutor`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `deductiondetails`
--
ALTER TABLE `deductiondetails`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `deductionpercent`
--
ALTER TABLE `deductionpercent`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `empposition`
--
ALTER TABLE `empposition`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `empshifting`
--
ALTER TABLE `empshifting`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `empstatus`
--
ALTER TABLE `empstatus`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
MODIFY `id` int(100) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payslip`
--
ALTER TABLE `payslip`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `salarytype`
--
ALTER TABLE `salarytype`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
