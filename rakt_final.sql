-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 14, 2020 at 07:12 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rakt`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `bankId` int(11) NOT NULL,
  `bMgr` int(11) NOT NULL,
  `bCity` varchar(30) NOT NULL,
  `bPincode` int(6) NOT NULL,
  `bAddress` varchar(100) NOT NULL,
  `bPhone` bigint(11) NOT NULL,
  `bName` varchar(100) NOT NULL,
  PRIMARY KEY (`bankId`,`bMgr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bankId`, `bMgr`, `bCity`, `bPincode`, `bAddress`, `bPhone`, `bName`) VALUES
(1001, 98001, 'Lucknow', 226001, '24, Cantonment Rd, Kaiserbagh Officer\'s Colony, Husainganj', 5224299999, 'Plasma Bank of Lucknow'),
(1002, 98002, 'Delhi', 110070, 'D-1, ILBS Hospital, Vasant Kunj', 5698342051, 'Delhi Plasma Bank'),
(1003, 98003, 'Chennai', 600040, ' #70, 42/T1&T2 3rd Floor, Sindhoor Shopping Complex 5th Street, 2nd Ave, X Block, Anna Nagar West Ex', 4448504455, 'Chennai Blood Centre'),
(1004, 98004, 'Banglore', 560054, 'North, Jaladarshini Layout, Raj Mahal Vilas 2nd Stage, East Zone, Bengaluru', 8022183100, 'M. S. Ramaiah Medical Teaching Hospital Blood Bank');

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

DROP TABLE IF EXISTS `donor`;
CREATE TABLE IF NOT EXISTS `donor` (
  `donorId` int(11) NOT NULL AUTO_INCREMENT,
  `donorEmail` varchar(256) NOT NULL,
  `plasmaId` int(11) NOT NULL,
  `dod` date NOT NULL,
  `dBankId` int(11) NOT NULL,
  PRIMARY KEY (`donorId`),
  UNIQUE KEY `pasmaId_unique` (`plasmaId`),
  UNIQUE KEY `donorEmail` (`donorEmail`),
  KEY `donorEmail_fk` (`donorEmail`),
  KEY `dBankId_fk` (`dBankId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `donor`
--

INSERT INTO `donor` (`donorId`, `donorEmail`, `plasmaId`, `dod`, `dBankId`) VALUES
(1, 'jainronak784@gmail.com', 2020001, '2020-09-14', 1001),
(2, 'piyushgoyal21@gmail.com', 2020002, '2020-11-10', 1001),
(4, 'gkalyankar33@gmail.com', 2020004, '2020-09-19', 1004),
(6, 'naresh77@gmail.com', 2020006, '2020-08-19', 1003),
(19, '2019060@iiitdmj.ac.in', 2020019, '2020-11-23', 1004),
(20, 'vishal35@ymail.com', 2020020, '2020-11-23', 1004),
(22, 'tanmay@gmail.com', 2020022, '2020-12-20', 1004),
(23, 'ishita@iiitdmj.ac.in', 2020023, '2020-12-04', 1004);

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `empId` int(11) NOT NULL,
  `empPassword` varchar(256) NOT NULL,
  `empName` varchar(50) NOT NULL,
  `empPhone` bigint(11) NOT NULL,
  `BankId` int(11) NOT NULL,
  KEY `empId_fk` (`empId`),
  KEY `bankId_fk` (`BankId`),
  KEY `BankId` (`BankId`,`empId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`empId`, `empPassword`, `empName`, `empPhone`, `BankId`) VALUES
(98001, 'robin@001', 'Robin Sharma', 7424101010, 1001),
(98002, 'asmita@002', 'Asmita Singh', 7024578033, 1002),
(98003, 'riyan@003', 'Riyan Parag', 8570396615, 1003),
(98004, 'shreyas@004', 'Shreyas Iyer', 9003671425, 1004);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `pEmail` varchar(256) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `pAge` int(2) NOT NULL,
  `pSex` int(1) NOT NULL,
  `pDoc` varchar(50) NOT NULL,
  `pHospital` varchar(60) NOT NULL,
  `pPincode` int(6) NOT NULL,
  `pBldGrp` varchar(3) NOT NULL,
  `pPassword` varchar(256) NOT NULL,
  `pPhone` bigint(11) NOT NULL,
  `pDoa` date NOT NULL,
  `pVerified` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pEmail`, `pName`, `pAge`, `pSex`, `pDoc`, `pHospital`, `pPincode`, `pBldGrp`, `pPassword`, `pPhone`, `pDoa`, `pVerified`) VALUES
('Ali86@gmail.com', 'Hassan Ali', 34, 1, 'Dr.Ramcharan', 'Govt.Hospital,Vizag', 789001, 'B+', 'hassan@34', 6035198374, '2020-09-21', 0),
('carry@minati.com', 'Ajey Nagar', 23, 1, 'Dr. Rishab Jain', 'Kokilaben Hospital', 400053, 'AB+', '99', 7424990011, '2020-12-19', 1),
('garvitgupta2001@gmail.com', 'Garvit Gupta', 19, 1, 'Dr. Apoorv Saxena', 'Medanta Hospital', 301001, 'O-', 'guptaji', 7424902850, '2020-11-27', 1),
('hari55@gmail.com', 'Hari Prakash Yadav', 36, 1, 'Dr.Harish rane', 'Sawai Mansingh Hospital, Jaipur', 431007, 'B-', 'hari@36', 8679556320, '2020-10-05', 0),
('jainvatsal67@yahoo.com', 'Vatsal Jain', 17, 1, 'Dr.Raghuvar Das', 'Shri sai Hospital', 451058, 'AB+', 'vatsal@17', 8745016459, '2020-11-17', 1),
('kaleen_tripathi@gmail.com', 'Kaleen Tripathi', 53, 1, 'Dr. Sharad Shukla', 'Govt. Hospital of Jaunpur', 222001, 'O-', 'kaleen@53', 7424818181, '2020-10-01', 1),
('khanirfan786@gmail.com', 'Irfan khan', 47, 1, 'Dr.kanojiya', 'City Hospital, lucknow', 456093, 'B+', 'irfan@47', 9967450123, '2020-10-30', 1),
('kumar43@gmail.com', 'Devendra Kumar', 42, 1, 'Dr.Saluke', 'Dhiru Bhai Ambani Hospital', 786098, 'A-', 'devendra@42', 6754303190, '2020-10-30', 0),
('munna_tripathi@ymail.com', 'Munna Tripathi', 27, 1, 'Dr. Guddu Pandit', 'Govt. Hospital of Mirzapur', 231001, 'AB+', 'munna@27', 7424902856, '2020-10-08', 0),
('rahulkumawat467@gmail.com', 'Rahul Kumawat', 27, 1, 'Dr.Anand Tyagi', 'Krishna Hospital', 421005, 'AB-', 'rahul@27', 7895432160, '2020-10-26', 0),
('rohit@gmail.com', 'Rohit Sharma', 32, 1, 'Dr Ajit Pawar', 'Shyam Mohan Hospital', 201001, 'O+', '78', 7424900000, '2020-12-13', 1),
('ruchi96@gmail.com', 'Ruchi Gupta', 35, 0, 'Dr.Arvind Sinha', 'Fortis Hospital', 431001, 'A-', 'ruchi@35', 9674832105, '2020-09-03', 1),
('saroj21@gmail.com', 'Saroj Kumari', 33, 0, 'Dr. Singh', 'kokila ben hospital, Mumbai', 361001, 'A-', 'saroj@33', 7895432601, '2020-11-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
CREATE TABLE IF NOT EXISTS `requests` (
  `reqId` int(11) NOT NULL AUTO_INCREMENT,
  `reqEmail` varchar(256) NOT NULL,
  `reqStatus` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reqId`),
  KEY `reqEmail_fk` (`reqEmail`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`reqId`, `reqEmail`, `reqStatus`) VALUES
(1, 'kaleen_tripathi@gmail.com', 0),
(2, 'khanirfan786@gmail.com', 1),
(3, 'ruchi96@gmail.com', 1),
(4, 'jainvatsal67@yahoo.com', 1),
(5, 'saroj21@gmail.com', 0),
(7, 'garvitgupta2001@gmail.com', 1),
(9, 'carry@minati.com', 1),
(10, 'rohit@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `bankId` int(11) NOT NULL,
  `A+` int(11) NOT NULL,
  `A-` int(11) NOT NULL,
  `B+` int(11) NOT NULL,
  `B-` int(11) NOT NULL,
  `AB+` int(11) NOT NULL,
  `AB-` int(11) NOT NULL,
  `O+` int(11) NOT NULL,
  `O-` int(11) NOT NULL,
  PRIMARY KEY (`bankId`),
  KEY `bankId_fk` (`bankId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`bankId`, `A+`, `A-`, `B+`, `B-`, `AB+`, `AB-`, `O+`, `O-`) VALUES
(1001, 1, 0, 0, 0, 0, 0, 0, 0),
(1002, 0, 0, 0, 0, 0, 0, 0, 0),
(1003, 0, 0, 0, 0, 0, 0, 0, 0),
(1004, 1, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

DROP TABLE IF EXISTS `transfer`;
CREATE TABLE IF NOT EXISTS `transfer` (
  `t_reqId` int(11) NOT NULL,
  `t_bankId` int(11) NOT NULL,
  `dot` date NOT NULL,
  PRIMARY KEY (`t_reqId`),
  KEY `t_bankId_fk` (`t_bankId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transfer`
--

INSERT INTO `transfer` (`t_reqId`, `t_bankId`, `dot`) VALUES
(2, 1004, '2020-09-28'),
(3, 1001, '2020-09-22'),
(4, 1003, '2020-09-02'),
(7, 1004, '2020-11-27'),
(9, 1004, '2020-12-21'),
(10, 1004, '2020-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `uEmail` varchar(256) NOT NULL,
  `uName` varchar(50) NOT NULL,
  `uAge` int(3) NOT NULL,
  `uSex` int(2) NOT NULL,
  `uAddress` varchar(100) NOT NULL,
  `uCity` varchar(30) NOT NULL,
  `uPincode` int(6) NOT NULL,
  `uPhone` bigint(11) NOT NULL,
  `uBldGrp` varchar(3) NOT NULL,
  `uDos` date NOT NULL,
  PRIMARY KEY (`uEmail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uEmail`, `uName`, `uAge`, `uSex`, `uAddress`, `uCity`, `uPincode`, `uPhone`, `uBldGrp`, `uDos`) VALUES
('2019060@iiitdmj.ac.in', 'Mayank Gupta', 20, 1, 'HALL-3', 'Jabalpur', 324005, 7424902828, 'A+', '2020-11-17'),
('gkalyankar33@gmail.com', 'Ganesh Kalyankar', 20, 1, 'c/o bhawar lal vyas teh:-Asind', 'Bhilwara', 311301, 7023676135, 'B+', '2020-08-28'),
('ishita@iiitdmj.ac.in', 'Ishita Agarwaal', 27, 0, 'Flat-101 Sahoo Apartments', 'Manali', 101001, 7424901111, 'O+', '2020-12-01'),
('jainronak784@gmail.com', 'Ronak Jain', 33, 1, 'Road no.32, House no.45, Near hanuman Mandir', 'Ranchi', 834004, 8952601157, 'A-', '2020-09-11'),
('madhuri78@outlook.com', 'Madhuri Yadav', 47, 0, 'station road, ambadkar circle, Teh-kalamnuri', 'Hingoli', 431702, 9905673920, 'O-', '2020-08-30'),
('madhuri_yadav@iiitdmj.ac.in\r\n', 'Madhuri Yadav', 25, 0, 'TCG -7/7, Vibhuti Khand, Gomti Nagar', 'Lucknow', 226001, 7424902829, 'A+', '2020-09-16'),
('naresh77@gmail.com', 'Naresh Srivastav', 28, 1, 'Railway station road, House no.54', 'Lucknow', 226001, 8963016846, 'AB+', '2020-07-13'),
('nehasharma143@gmail.com', 'Neha Sharma', 34, 0, 'CivilLines, Anand parbat', 'Delhi', 110005, 9983007654, 'AB-', '2020-09-23'),
('piyushgoyal21@gmail.com', 'Piyush Goyal', 19, 1, 'Mansarovar,road no.04, House no.111', 'Jaipur', 302007, 7849830281, 'A+', '2020-10-20'),
('rathoreamit96@gmail.com', 'Amit Sigh Rathore', 49, 1, 'vaishali Nagar, Near shiv mandir', 'jaisalmer', 345001, 9856321056, 'B-', '2020-10-21'),
('tanmay@gmail.com', 'Tanmay Bhatt', 35, 1, 'Flat 102,Phoenix Appartment', 'Mumbai', 400004, 6389110022, 'AB+', '2020-12-19'),
('vishal35@ymail.com', 'Vishal Dubey', 35, 1, 'Flat no. 102, Laxmi Bazzar', 'Angul', 759106, 7424502828, 'O-', '2020-11-01');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`donorEmail`) REFERENCES `user` (`uEmail`),
  ADD CONSTRAINT `donor_ibfk_2` FOREIGN KEY (`dBankId`) REFERENCES `bank` (`bankId`);

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`BankId`,`empId`) REFERENCES `bank` (`bankId`, `bMgr`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`reqEmail`) REFERENCES `patient` (`pEmail`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`bankId`) REFERENCES `bank` (`bankId`);

--
-- Constraints for table `transfer`
--
ALTER TABLE `transfer`
  ADD CONSTRAINT `t_bankId_fk` FOREIGN KEY (`t_bankId`) REFERENCES `bank` (`bankId`),
  ADD CONSTRAINT `t_reqId_fk` FOREIGN KEY (`t_reqId`) REFERENCES `requests` (`reqId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
