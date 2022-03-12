-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2020 at 03:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trms`
--
CREATE DATABASE IF NOT EXISTS `trms` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `trms`;

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `Cust_ID` int(11) NOT NULL,
  `Cust_Name` varchar(50) NOT NULL,
  `Cust_Project` varchar(50) NOT NULL,
  `Cust_Division` varchar(50) NOT NULL,
  `Cust_Unit` varchar(50) NOT NULL,
  `Cust_Phone` varchar(15) NOT NULL,
  `Cust_Email` varchar(50) NOT NULL,
  `Cust_Address` varchar(255) NOT NULL,
  `Cust_Is_Active` enum('Yes','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`Cust_ID`, `Cust_Name`, `Cust_Project`, `Cust_Division`, `Cust_Unit`, `Cust_Phone`, `Cust_Email`, `Cust_Address`, `Cust_Is_Active`) VALUES
(13, 'Khalida Binti Zainudin', 'Hospital Kuala Lumpur', 'Maintenance & Communication', 'General Hospital Kuala Lumpur', '032615555', 'kalida_88@gmail.com', 'Jalan Pahang 50586 Kuala Lumpur', 'Yes'),
(14, 'Khairul Azman Bin Mat Din', 'Hospital Putra', 'Maintenance & Communication', 'Hospital Putra Specialist ', '01241886188', 'khairul_a@gmail.com', 'Jalan Pantai Baharu Kuala Lumpur', 'Yes'),
(22, 'Zanirul Akmal', 'Markas Angkatan Tentera Malaysia', 'BAHAGIAN KOMUNIKASI DAN ELEKTRONIK PERTAHANAN', 'Sel Telefon', '01321687567', 'zanirul@gmail.com', 'KOMPLEKS HAIGATE ATM, JALAN TEKPI, OFF JALAN PADANG TEMBAK, KUALA LUMPUR, 50634, W.P. KUALA\r\nLUMPUR, WILAYAH PERSEKUTUAN KUALA LUMPUR, MALAYSIA', 'Yes'),
(23, 'Zulkarnain Ahmad Omar', 'Insolvensi Malaysia', 'Jabatan Insolvensi Shah Alam', 'Pengurusan Aset', '01121686578', 'zul@gmail.com', 'TINGKAT 1, IDCC SHAH ALAM, SEKSYEN 15, 40200 SHAH ALAM, SELANGOR DARUL EHSAN ', 'Yes'),
(24, 'Norusniza Yahaya', 'Jabatan Pengangkutan Jalan', 'JPJ Padang Jawa', 'Trafik', '0123456789', 'norusniza@email.com', 'Jalan Padang Jawa,\r\nPadang Jawa 41300,\r\nKlang, Selangor', 'Yes'),
(25, 'Mejar Shafiee', 'KEMENTAH', 'BAHAGIAN KOMUNIKASI DAN ELEKTRONIK PERTAHANAN', 'Sel Telefon', '0192415148', 'shafiee@email.com', 'Markas Angkatan Tentera Malaysia,\r\nJalan Padang Tembak,\r\n50634 Kuala Lumpur', 'Yes'),
(26, 'Zulkefli bin Johari', 'KEMENTAH', 'BAHAGIAN KOMUNIKASI DAN ELEKTRONIK PERTAHANAN', 'Ibu Sawat Telefon', '0123456879', 'zulkefli@email.com', 'Markas Angkatan Tentera Malaysia,\r\nJalan Padang Tembak,\r\n50634 Kuala Lumpur', 'Yes'),
(27, 'Muhammad Sharil bin Shamsudin', 'KEMENTAH', 'Rejimen Ke-31 Artileri Diraja', 'RAD 31', '0132456897', 'shahril@email.com', 'RAD 31, Kem Tun Ibrahim, \r\nKajang,\r\nSelangor', 'Yes'),
(28, 'Khairul Hafiz', 'MAMPU', '1MOCC', 'Contact Centre', '0124406876', 'khairul@email.com', '1MOCC, Aras 4, Skytech Tower 2,\r\nMKN Embassy Techzone,\r\nJalan Teknokrat 2,\r\n63000 Cyberjaya,\r\nSelangor', 'Yes'),
(29, 'En Shazwan Bin Muhamad', 'BUJANG HOLDINGS SDN BHD', 'Maintenance Dept', 'Customer', '012891511255', 'wan@gmail.com', 'Jalan TKP5, Ampang Kuala Lumpur', 'Yes'),
(30, 'Tuan Farhan Bin Abu', 'PDRM', 'Maintenance', 'IPK Seri Kembangan', '0326156666', 'farhan@email.com', 'Jalan Kinrara 5, Puchong Selangor', 'Yes'),
(31, 'Zamri Bin Ahmad', 'JKDM', 'Teknologi Maklumat', 'Jabatan Kastam Diraja Malaysia', '01231661511', 'zamri@yahoo.com', 'Persiaran Sultan Salahuddin Abdul Aziz Shah, Presint 2,62000 Putrajaya, Wilayah Persekutuan Putrajaya', 'Yes'),
(32, 'En  Ahmad Yusri Bin Kadir', 'JPM', 'Teknologi Maklumat', 'Jabatan Perdana Menteri', '01271682211', 'ayusri@yahoo.com', 'Persiaran Sultan Salahuddin Abdul Aziz Shah, Presint 2,62000 Putrajaya, Wilayah Persekutuan Putrajaya', 'Yes'),
(33, 'Hanafi Bin Ahmad', 'Jabatan Pendaftaran Pertubuhan Malaysia', 'Teknologi Maklumat', 'ROS', '01251681580', 'hanafi@yahoo.com', 'Persiaran Sultan Salahuddin Abdul Aziz Shah, Presint 1,62000 Putrajaya, Wilayah Persekutuan Putrajaya', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `Feedback_ID` int(11) NOT NULL,
  `Feedback_Content` varchar(255) NOT NULL,
  `Feedback_Date` date NOT NULL,
  `Cust_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`Feedback_ID`, `Feedback_Content`, `Feedback_Date`, `Cust_ID`) VALUES
(10, 'Customer very happy with PABX system', '2020-11-05', 14),
(11, 'Migrated to new PRI for new PABX', '2020-11-05', 26),
(12, 'Guide user how to call out by dialing \"9\" before call out', '2020-11-06', 27),
(13, 'Double check connectivity of media gateway', '2020-11-06', 31),
(14, 'Check completed successfully', '2020-11-06', 13);

-- --------------------------------------------------------

--
-- Table structure for table `tbllog`
--

CREATE TABLE `tbllog` (
  `Log_ID` int(5) NOT NULL,
  `Log_Message` varchar(255) NOT NULL,
  `Log_Date` datetime NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Service_ID` int(5) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllog`
--

INSERT INTO `tbllog` (`Log_ID`, `Log_Message`, `Log_Date`, `User_ID`, `Service_ID`) VALUES
(1, 'Check completed', '2020-11-06 01:07:20', 43, 00001),
(18, 'SV9500 communication server - Check the IOS system trail to re install & setting', '2020-11-05 14:34:00', 46, 00001),
(19, 'Agent Operator - Headset for operator broken (propose to replacement)', '2020-11-05 14:34:19', 47, 00001),
(22, '1 Lot Alcatel Lucent System', '2020-11-05 16:07:54', 40, 00002),
(23, '2 UPS Communication', '2020-11-05 16:08:06', 48, 00002),
(24, '1 Desktop for Operator', '2020-11-05 16:08:19', 44, 00002),
(25, '1 Lot Fiber Optic & UTP for Communication ', '2020-11-05 16:08:30', 42, 00002),
(26, 'Customer very happy with PABX system', '2020-11-05 16:13:39', 39, 00002),
(27, 'Calling Billing system - Re format desktop ', '2020-11-05 16:21:53', 40, 00006),
(28, 'Trunk Card - Replace the trunk card ', '2020-11-05 16:22:08', 41, 00006),
(29, 'Propose new system IP PABX system ', '2020-11-05 16:32:36', 42, 00007),
(30, 'Propose new infra for communication system ', '2020-11-05 16:32:46', 43, 00007),
(31, 'Proposal Operator Console', '2020-11-05 16:32:57', 44, 00007),
(32, 'Power meter reading = -2.90dB', '2020-11-05 23:45:18', 45, 00009),
(33, 'About 400 numbers of analog extensions from existing PABX system are not working due to EOL from the existing system.', '2020-11-05 23:52:36', 46, 00010),
(34, 'Recommend to install Alcatel PABX c/w 400 analog ports to overcome this problem', '2020-11-05 23:53:17', 47, 00010),
(35, 'Current analog interface can\'t connect to new PABX', '2020-11-05 23:56:55', 48, 00011),
(36, 'Migrated to new PRI for new PABX', '2020-11-05 23:57:23', 47, 00011),
(37, 'Discuss further about new implementation of PABX with sales, projects and technical officers involved', '2020-11-05 23:58:30', 46, 00011),
(38, 'Found that phone working fine', '2020-11-06 00:04:39', 45, 00012),
(39, 'Guide user how to call out by dialing \"9\" before call out', '2020-11-06 00:05:21', 44, 00012),
(40, 'All 14 phones able to call out, tested and verified by me', '2020-11-06 00:05:44', 43, 00012),
(41, 'Send Canon old projector to customer', '2020-11-06 00:11:06', 43, 00013),
(42, 'HDMI x 2 pieces (3 meter each)', '2020-11-06 00:11:26', 43, 00013),
(43, 'Collect back loan Casio projector from customer', '2020-11-06 00:11:48', 42, 00013),
(44, 'Site visit for location of extension line', '2020-11-06 00:16:49', 41, 00014),
(45, 'Propose new system for PABX', '2020-11-06 00:17:03', 42, 00014),
(46, 'Reinstall software version for operator console', '2020-11-06 00:19:51', 40, 00015),
(47, 'Uninstall the license and reinstall for call recording software', '2020-11-06 00:20:11', 39, 00015),
(48, 'Double check connectivity of media gateway', '2020-11-06 00:24:30', 39, 00016),
(49, 'Head set replacement', '2020-11-06 00:24:42', 41, 00016),
(50, 'Installation of call billing system', '2020-11-06 00:25:00', 42, 00016),
(51, 'Communication internal cabling using Cat 6', '2020-11-06 00:25:17', 39, 00016),
(52, 'Double check connectivity for media gateway', '2020-11-06 00:27:31', 45, 00017),
(53, 'Internal communication cabling using Cat 6', '2020-11-06 00:27:50', 48, 00017),
(54, 'Double check connectivity', '2020-11-06 00:30:10', 43, 00018),
(55, 'Replace broken headset', '2020-11-06 00:30:21', 40, 00018),
(56, 'IP Phone power line problem', '2020-11-06 00:30:33', 40, 00018),
(57, 'Reinstall call billing system', '2020-11-06 00:30:43', 42, 00018);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotification`
--

CREATE TABLE `tblnotification` (
  `Noti_ID` int(11) NOT NULL,
  `Noti_Title` varchar(50) NOT NULL,
  `Noti_Content` varchar(255) NOT NULL,
  `Noti_Class` enum('primary','success','warning','danger') NOT NULL,
  `Noti_Date_Added` date NOT NULL,
  `Noti_Is_Active` enum('No','Yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblnotification`
--

INSERT INTO `tblnotification` (`Noti_ID`, `Noti_Title`, `Noti_Content`, `Noti_Class`, `Noti_Date_Added`, `Noti_Is_Active`) VALUES
(7, 'TRMS is now live!', '  The Technical Resource Management System (TRMS) is fully functional. Feel free to test and voice out your feedback to <strong>nazrin.putra@tm.com.my</strong>', 'success', '2020-11-05', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tblreset`
--

CREATE TABLE `tblreset` (
  `Reset_ID` int(11) NOT NULL,
  `Reset_Key` varchar(255) NOT NULL,
  `Reset_Expiry` datetime NOT NULL,
  `User_Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `Service_ID` int(5) UNSIGNED ZEROFILL NOT NULL,
  `Service_Title` varchar(50) NOT NULL,
  `Service_Description` varchar(255) NOT NULL,
  `Service_Status` enum('Open','Pending','Closed') NOT NULL,
  `Service_Type` varchar(50) NOT NULL,
  `Service_Date` date NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblservice`
--

INSERT INTO `tblservice` (`Service_ID`, `Service_Title`, `Service_Description`, `Service_Status`, `Service_Type`, `Service_Date`, `Cust_ID`, `User_ID`) VALUES
(00001, 'Check IOS System and Headset', 'Model Phone : NEC SV 9500 Communication Server\r\nSerial Number : SV95-0001241JK-0X1\r\nNo Ext : NIL', 'Open', 'Service Call', '2021-10-21', 13, 43),
(00002, 'Installation Alcatel - Lucent Communication Server', 'Installation for IP PABX system\r\ncabling work for infra for communication \r\ninstall for Operator Console', 'Pending', 'Installation', '2020-11-05', 14, 43),
(00006, 'Call Billing System and Trunk Card ', 'Tone and billing System eror\r\nIncoming Line Not Function', 'Open', 'Cable Work', '2020-10-16', 22, 40),
(00007, 'Proposal Survey', 'None', 'Pending', 'Survey', '2020-10-19', 23, 40),
(00008, 'Installation Alcatel - Lucent Communication Server', 'cabling work for infra for communication ', 'Open', 'Contract', '2020-10-22', 14, 40),
(00009, 'Fiber Cable Splicing', '80 meter 2 core fiber optic cable', 'Open', 'Cable Work', '2020-03-11', 24, 43),
(00010, 'Assessment of Existing System', 'Existing System : Philips iS3000', 'Open', 'Survey', '2020-11-04', 25, 39),
(00011, 'Site Survey for PABX', 'Model phone : Philips', 'Open', 'Survey', '2020-04-24', 26, 43),
(00012, 'To Check Phone', 'Phone cannot call out', 'Open', 'Service Call', '2020-09-21', 27, 39),
(00013, 'Projector', 'Send and collect', 'Open', 'Contract', '2020-10-10', 28, 39),
(00014, 'PABX', 'Site Visit', 'Open', 'Survey', '2020-11-11', 29, 43),
(00015, 'Software installation', 'Operator console and call recording', 'Open', 'Installation', '2020-11-02', 30, 39),
(00016, 'Internal cabling', 'Alcatel-Lucent Enterprise System', 'Open', 'Cable Work', '2020-10-28', 31, 40),
(00017, 'Connection', 'Alcatel-Lucent Enterprise System', 'Open', 'Service Call', '2020-10-30', 32, 39),
(00018, 'Check communication Server', 'SIP card, Headset, IP Phone, Call Billing System', 'Open', 'Contract', '2020-10-26', 33, 43);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `User_ID` int(11) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `User_Email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `User_Staff_No` varchar(10) NOT NULL,
  `User_Position` varchar(50) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `User_Gender` enum('Male','Female') NOT NULL,
  `User_Phone` varchar(11) NOT NULL,
  `User_Address` varchar(255) NOT NULL,
  `User_Avatar` varchar(50) NOT NULL,
  `User_Bio` varchar(255) NOT NULL,
  `User_Role` enum('Admin','Tech') NOT NULL,
  `User_Assigned` int(11) NOT NULL,
  `User_Created` int(11) NOT NULL,
  `User_Updated` int(11) NOT NULL,
  `User_Closed` int(11) NOT NULL,
  `User_Token` varchar(255) NOT NULL,
  `User_Is_Active` enum('No','Yes') NOT NULL,
  `User_Date_Registered` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`User_ID`, `User_Name`, `User_Email`, `User_Staff_No`, `User_Position`, `User_Password`, `User_Gender`, `User_Phone`, `User_Address`, `User_Avatar`, `User_Bio`, `User_Role`, `User_Assigned`, `User_Created`, `User_Updated`, `User_Closed`, `User_Token`, `User_Is_Active`, `User_Date_Registered`) VALUES
(1, 'Nazrin Putra Rasol', 'nazrin.putra@tm.com.my', 'TM38432', 'Assistant Manager', '$2y$10$amwZr4ag.e3eMqW2sGxb5eb0G0kHzZizC38d.C62cgBNtwXgalFX6', 'Male', '0135711937', 'KM 32, Parit Sidang Seman', 'images/icon/Avatars33.png', 'I\'m a developer!', 'Admin', 4, 13, 33, 3, '959597e5e8872721163d6c1fc62f5132', 'Yes', '2020-10-30'),
(2, 'Super User', 'superuser@email.com', 'AA1234', 'Super User', '$2y$10$amwZr4ag.e3eMqW2sGxb5eb0G0kHzZizC38d.C62cgBNtwXgalFX6', 'Female', '0123456789', '127.0.0.1', 'images/icon/Avatars38.png', '', 'Admin', 0, 1, 3, 0, '', 'Yes', '2020-11-01'),
(39, 'Muhamad Faiz Bin Zainol', 'faiz_tsssb@gmail.com', 'TS1005', '', '$2y$10$Slec1hVWe.6QCjW7CyS5yeGGkEDRcfeZ5iBCOppfxWCG.MJZzwOOO', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 2, 0, 0, 0, '8af2766e49c37f2333e45f0f21b38d94', 'Yes', '2020-11-05'),
(40, 'Masror bin Tomin', 'masror_tsssb@gmail.com', 'TS1002', '', '$2y$10$EwzbC/ES.M01yMtcVU8L9uHEBfc.rW7GwDh4o2L51mKI1uPV0oMV2', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, '67990c6463590d64abc2c84a2dfad433', 'Yes', '2020-11-05'),
(41, 'Mohd Shah Kamal', 'shah_tsssb@gmail.com', 'TS1003', '', '$2y$10$BmNYsP4VxXV37QdJb8ITTeDEBns6Ay20FUi5yc.S0Eh4WITbbv9aK', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 0, 0, 0, 0, 'a5ac83f5f80d45770a495b9cda7b31a2', 'No', '2020-11-05'),
(42, 'Kamarul bin Ismail', 'kamarul_tsssb@gmail.com', 'TS1004', '', '$2y$10$B11s7J8CEarGSXh2UJvBvOShLKXi6RyIlHAGjj7mjd0jLVgp34J8a', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 0, 0, 0, 0, '8455c15d4f4b8274909d2ca1d352305e', 'No', '2020-11-05'),
(43, 'Mohd Fitri Samsudin', 'fitrry@yahoo.com', 'TS1001', '', '$2y$10$azYr7/oOYQEWAFD3XqAEHuaQJQp7OBU97W.mQvN3upp4ogrvdxL7S', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 5, 0, 0, 0, 'b591df3e617c9bc4b8f4ffeffc686aeb', 'Yes', '2020-11-05'),
(44, 'Khairul Amy Bin Zainudin', 'khairul_tsssb@gmail.com', 'TS1006', '', '$2y$10$C8igCP.3pONoabcXWJUMB.tovj6ZMIZBCqGlTDiai/AhWiEZJnhzi', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, 'f4c07e06dc004457b73aa8055edd98a3', 'No', '2020-11-05'),
(45, 'Muhamad Zainol Bin Zain', 'zainol_tsssb@gmail.com', 'TS1007', '', '$2y$10$ZSsHjTr078m22YGJZtJJY.Bd3aSqFGbE4V1DZF9k3gbyYy4BfEtLC', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, '6e5f50252e4644e56a0c9fa2f3cceb76', 'No', '2020-11-05'),
(46, 'Faisal Paisan Bin Ali', 'faisal_tsssb@gmail.com', 'TS1008', '', '$2y$10$AN3fkJ0qNnXg0Q4g20xJxOyaQ8/xaAIqSJrrMeR.Pe2bdcWguH3MK', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, '60a53de718bc662f029cffd6aa349f4f', 'No', '2020-11-05'),
(47, 'Faris Bin Kamarul', 'faris_tsssb@gmail.com', 'TS1009', '', '$2y$10$xVxlwfWn5VHfYUA9l832p.Y7cehzz37la2yWrQGZJ.KCJfxNr3hCi', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, '4f4575b33bf77de35174343d48ea1f43', 'No', '2020-11-05'),
(48, 'Mohd Shah Bin Rosli', 'mrosli_tsssb@gmail.com', 'TS1010', '', '$2y$10$pVr4htVhEOj4GdG.M3CizeXZXSjaaHC3InIwZkw2kD7SaM0Od7SmS', 'Male', '', '', 'images/icon/Avatars17.png', '', 'Tech', 1, 0, 0, 0, 'bc474596adf432a7c61bcbff5b31bd8d', 'No', '2020-11-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`Cust_ID`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD KEY `Foreign_Key_Feedback` (`Cust_ID`);

--
-- Indexes for table `tbllog`
--
ALTER TABLE `tbllog`
  ADD PRIMARY KEY (`Log_ID`),
  ADD KEY `Foreign_Key_Service` (`Service_ID`),
  ADD KEY `Foreign_Key_User_Log` (`User_ID`);

--
-- Indexes for table `tblnotification`
--
ALTER TABLE `tblnotification`
  ADD PRIMARY KEY (`Noti_ID`);

--
-- Indexes for table `tblreset`
--
ALTER TABLE `tblreset`
  ADD PRIMARY KEY (`Reset_ID`),
  ADD KEY `Foreign_Key_Email` (`User_Email`);

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`Service_ID`),
  ADD KEY `Service_Customer` (`Cust_ID`),
  ADD KEY `Foreign_Key_User` (`User_ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_Email` (`User_Email`,`User_Staff_No`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `Cust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `Feedback_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbllog`
--
ALTER TABLE `tbllog`
  MODIFY `Log_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tblnotification`
--
ALTER TABLE `tblnotification`
  MODIFY `Noti_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblreset`
--
ALTER TABLE `tblreset`
  MODIFY `Reset_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservice`
--
ALTER TABLE `tblservice`
  MODIFY `Service_ID` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD CONSTRAINT `Foreign_Key_Feedback` FOREIGN KEY (`Cust_ID`) REFERENCES `tblcustomer` (`Cust_ID`);

--
-- Constraints for table `tbllog`
--
ALTER TABLE `tbllog`
  ADD CONSTRAINT `Foreign_Key_Service` FOREIGN KEY (`Service_ID`) REFERENCES `tblservice` (`Service_ID`),
  ADD CONSTRAINT `Foreign_Key_User_Log` FOREIGN KEY (`User_ID`) REFERENCES `tbluser` (`User_ID`);

--
-- Constraints for table `tblreset`
--
ALTER TABLE `tblreset`
  ADD CONSTRAINT `Foreign_Key_Email` FOREIGN KEY (`User_Email`) REFERENCES `tbluser` (`User_Email`);

--
-- Constraints for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD CONSTRAINT `Foreign_Key_Cust` FOREIGN KEY (`Cust_ID`) REFERENCES `tblcustomer` (`Cust_ID`),
  ADD CONSTRAINT `Foreign_Key_User` FOREIGN KEY (`User_ID`) REFERENCES `tbluser` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
