-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 05:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hatchery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_tb`
--

CREATE TABLE `admin_tb` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_tb`
--

INSERT INTO `admin_tb` (`id`, `name`, `email`, `password`) VALUES
(1, 'Rakesh Das', 'das.rakesh2001@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `District` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`District`) VALUES
('Alipurduar'),
('Bankura'),
('Birbhum'),
('Cooch Behar'),
('Dakshin Dinajpur'),
('Darjeeling'),
('Hooghly'),
('Howrah'),
('Jalpaiguri'),
('Jhargram'),
('Kalimpong'),
('Kolkata'),
('Malda'),
('Murshidabad'),
('Nadia'),
('North 24 Parganas'),
('Paschim Bardhaman'),
('Paschim Medinipur'),
('Purba Bardhaman'),
('Purba Medinipur'),
('Purulia'),
('South 24 Parganas'),
('Uttar Dinajpur');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `Slno` int(10) NOT NULL,
  `ID` int(10) NOT NULL,
  `SenderID` int(20) NOT NULL,
  `Sendername` varchar(30) NOT NULL,
  `District` varchar(30) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Date` date NOT NULL,
  `Time` varchar(10) NOT NULL,
  `Reply` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`Slno`, `ID`, `SenderID`, `Sendername`, `District`, `Message`, `Type`, `Date`, `Time`, `Reply`) VALUES
(27, 19, 19, 'HO1 Kuldeep Jadav', 'North 24 Parganas', 'à¦†à¦®à¦¿ à¦¹à§à¦¯à¦¾à¦šà¦¾à¦°à¦¿ à¦®à¦¾à¦²à¦¿à¦• à¦†à¦ªà¦¨à¦¾à¦¦à§‡à¦°à¦•à§‡ à¦…à¦¤à§à¦¯à¦¨à§à¦¤ à¦§à¦¨à§à¦¯à¦¬à¦¾à¦¦ à¦œà¦¾à¦¨à¦¾à¦šà§à¦›à¦¿ à¦†à¦®à¦¾à¦° à¦¹à§à¦¯à¦¾à¦šà¦¾à¦°à¦¿ à¦…à§à¦¯à¦¾à¦•à§à¦°à¦¿à¦¡à¦¿à¦Ÿà§‡à¦¶à¦¨ à¦•à¦°à¦¾à¦° à¦œà¦¨à§à¦¯ à§·', 'HO', '2021-06-17', '16:25', 'N'),
(24, 19, 19, 'HO1 Kuldeep Jadav', 'North 24 Parganas', 'Directly or indirectly, the livelihood of over 500 million people in developing countries depends on fisheries and aquaculture.\r\n', 'HO', '2021-06-17', '15:41', 'N'),
(63, 36, 38, 'lvl2', 'Kolkata', 'A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts of sentences fly into your mouth.', 'Level-2 Officer', '2022-06-17', '16:02', 'Y'),
(52, 35, 38, 'lvl2', 'Kolkata', 'again', 'Level-2 Officer', '2022-06-06', '15:18', 'Y'),
(53, 35, 38, 'lvl2', 'Kolkata', 'again', 'Level-2 Officer', '2022-06-06', '15:18', 'Y'),
(50, 35, 38, 'lvl2', 'Kolkata', 'lvl 2 off\r\n', 'Level-2 Officer', '2022-06-06', '15:15', 'Y'),
(51, 35, 38, 'lvl2', 'Kolkata', 'again\r\n', 'Level-2 Officer', '2022-06-06', '15:15', 'Y'),
(48, 35, 35, 'db', 'Kolkata', 'district plz 2', 'Hatchery Owner', '2022-06-06', '15:02', 'N'),
(49, 35, 35, 'db', 'Kolkata', 'what is this', 'Hatchery Owner', '2022-06-06', '15:06', 'N'),
(59, 35, 35, 'db', 'Kolkata', 'Sure we would like to know more about your problems and hopefully solve them', 'Hatchery Owner', '2022-06-17', '15:42', 'N'),
(60, 36, 38, 'lvl2', 'Kolkata', 'hello', 'Level-2 Officer', '2022-06-17', '15:59', 'Y'),
(61, 36, 36, 'Ram Singh', 'Kolkata', 'hello', 'Hatchery Owner', '2022-06-17', '16:00', 'N'),
(62, 36, 36, 'Ram Singh', 'Kolkata', 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. ', 'Hatchery Owner', '2022-06-17', '16:00', 'N'),
(58, 35, 35, 'db', 'Kolkata', 'I would like to file a complaint', 'Hatchery Owner', '2022-06-17', '15:41', 'N'),
(57, 35, 32, 'Abhishek', 'Howrah', 'case solved', 'Level-3 Officer', '2022-06-14', '15:25', 'Y'),
(56, 36, 38, 'lvl2', 'Kolkata', 'ok', 'Level-2 Officer', '2022-06-12', '15:52', 'Y'),
(55, 36, 38, 'lvl2', 'Kolkata', 'Reply Lvl2', 'Level-2 Officer', '2022-06-08', '15:46', 'Y'),
(54, 36, 36, 'db1', 'Kolkata', 'This is DB1', 'Hatchery Owner', '2022-06-08', '15:45', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `hatchery`
--

CREATE TABLE `hatchery` (
  `ID` varchar(20) NOT NULL,
  `ID Year` varchar(10) NOT NULL,
  `Owner's Name` varchar(30) NOT NULL,
  `Father's Name` varchar(30) NOT NULL,
  `Owner's District` varchar(50) NOT NULL,
  `Owner's Block` varchar(50) NOT NULL,
  `Owner's GP` varchar(50) NOT NULL,
  `Owner's Village` varchar(50) NOT NULL,
  `Owner's Post Office` varchar(50) NOT NULL,
  `Owner's Police Station` varchar(50) NOT NULL,
  `Owner's PIN` varchar(50) NOT NULL,
  `Phone 1` varchar(50) NOT NULL,
  `Phone 2` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Hatchery Name` varchar(50) NOT NULL,
  `Hatchery District` varchar(50) NOT NULL,
  `Hatchery Block` varchar(50) NOT NULL,
  `Hatchery GP` varchar(50) NOT NULL,
  `Hatchery Village` varchar(50) NOT NULL,
  `Hatchery Post Office` varchar(50) NOT NULL,
  `Hatchery Police Station` varchar(50) NOT NULL,
  `Hatchery PIN` varchar(50) NOT NULL,
  `Species` varchar(100) NOT NULL,
  `Owner's Photo` varchar(50) NOT NULL,
  `Hatchery Photo` varchar(50) NOT NULL,
  `Aadhar Photo` varchar(50) NOT NULL,
  `Challan Photo` varchar(50) NOT NULL,
  `App Date` date NOT NULL,
  `Year` int(5) NOT NULL,
  `Acc No` varchar(10) DEFAULT NULL,
  `Acc Date` date NOT NULL,
  `Acc Valid` date NOT NULL,
  `Acc DFO` varchar(30) NOT NULL,
  `DFO date` date NOT NULL,
  `Acc ADF` varchar(30) NOT NULL,
  `ADF date` date NOT NULL,
  `Acc JDF` varchar(30) NOT NULL,
  `JDF date` date NOT NULL,
  `Current` varchar(5) NOT NULL,
  `Remarks` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hatchery`
--

INSERT INTO `hatchery` (`ID`, `ID Year`, `Owner's Name`, `Father's Name`, `Owner's District`, `Owner's Block`, `Owner's GP`, `Owner's Village`, `Owner's Post Office`, `Owner's Police Station`, `Owner's PIN`, `Phone 1`, `Phone 2`, `Email`, `Hatchery Name`, `Hatchery District`, `Hatchery Block`, `Hatchery GP`, `Hatchery Village`, `Hatchery Post Office`, `Hatchery Police Station`, `Hatchery PIN`, `Species`, `Owner's Photo`, `Hatchery Photo`, `Aadhar Photo`, `Challan Photo`, `App Date`, `Year`, `Acc No`, `Acc Date`, `Acc Valid`, `Acc DFO`, `DFO date`, `Acc ADF`, `ADF date`, `Acc JDF`, `JDF date`, `Current`, `Remarks`) VALUES
('35', '35y2022', 'Ram Singh', 'Shaan Singh ', 'Kolkata', 'Thakurpukur', 'Behala', 'Behala', 'Behala Post Office', 'Thakurpukur Police Station', '700 060', '9903401319', '9903858325', 'd@gmail.com', 'Ram Hatchery', 'Kolkata', 'Thakurpukur', 'Behala', 'a', 'a', 'ps', '700 060', 'Magur , Katla', 'image1.jpg', 'waterfall.png', 'survey.png', 'Picture3.png', '2022-06-14', 2022, 'ACR-3', '2022-06-14', '2023-06-09', 'lvl1', '2022-06-16', '', '0000-00-00', '', '2022-06-14', 'Y', ''),
('36', '36y2021', 'Bijoy Das', 'Sujoy Das', 'Kolkata', 'Bijan Hatchery', 'a', 'a', 'a', 'ps', 'a', '1000000000', '1000000000', 'd@g.com', 'Bijan Hatchery', 'Kolkata', 'asd', 'a', 'a', 'a', 'ps', 'apin', 'many', 'Picture1.png', 'waterfall.png', 'survey.png', 'Picture3.png', '2022-06-04', 2022, 'ACR-2', '0000-00-00', '2022-06-04', 'lvl1', '2022-06-09', '', '0000-00-00', '', '0000-00-00', 'Y', ''),
('old35', '35y2021', 'db1', 'dbf', 'Kolkata', 'asd', 'a', 'a', 'a', 'ps', 'a', '1000000000', '1000000000', 'd@g.com', 'asd', 'Kolkata', 'asd', 'a', 'a', 'a', 'ps', 'apin', 'asdasd Reason Gone Now  Lvl2 ?', 'Picture1.png', 'waterfall.png', 'survey.png', 'Picture3.png', '2022-06-09', 2022, 'ACR-3', '2022-06-13', '2022-06-09', 'lvl2', '2022-06-09', 'lvl2', '2022-06-13', 'lvl2', '2022-06-13', 'N', 'not ok by Lvl 3');

-- --------------------------------------------------------

--
-- Table structure for table `login_tb`
--

CREATE TABLE `login_tb` (
  `sl_no` int(10) NOT NULL,
  `id` int(10) NOT NULL,
  `log_time` time NOT NULL,
  `log_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tb`
--

INSERT INTO `login_tb` (`sl_no`, `id`, `log_time`, `log_date`) VALUES
(6, 33, '19:12:03', '2022-05-24'),
(7, 33, '19:19:05', '2022-05-24'),
(8, 33, '19:30:03', '2022-05-24'),
(9, 32, '19:28:54', '2022-05-24'),
(10, 32, '20:24:52', '2022-05-24'),
(11, 32, '20:41:36', '2022-05-24'),
(12, 35, '16:17:04', '2022-05-28'),
(13, 35, '16:18:51', '2022-05-28'),
(14, 35, '16:19:57', '2022-05-28'),
(15, 35, '16:21:33', '2022-05-28'),
(16, 35, '16:26:07', '2022-05-28'),
(17, 35, '16:28:11', '2022-05-28'),
(18, 35, '14:12:40', '2022-06-01'),
(19, 35, '14:55:53', '2022-06-01'),
(20, 35, '15:00:17', '2022-06-01'),
(21, 35, '15:57:55', '2022-06-01'),
(22, 35, '15:59:11', '2022-06-01'),
(23, 35, '15:27:42', '2022-06-02'),
(24, 35, '15:28:31', '2022-06-02'),
(25, 35, '15:29:03', '2022-06-02'),
(26, 35, '15:29:23', '2022-06-02'),
(27, 32, '15:31:05', '2022-06-02'),
(28, 32, '15:31:25', '2022-06-02'),
(29, 32, '15:32:54', '2022-06-02'),
(30, 35, '15:33:33', '2022-06-02'),
(31, 33, '15:35:09', '2022-06-02'),
(32, 33, '15:35:27', '2022-06-02'),
(33, 33, '15:36:48', '2022-06-02'),
(34, 33, '15:38:10', '2022-06-02'),
(35, 35, '14:19:33', '2022-06-04'),
(36, 35, '15:09:50', '2022-06-04'),
(37, 35, '15:49:53', '2022-06-04'),
(38, 35, '14:01:22', '2022-06-05'),
(39, 36, '14:09:37', '2022-06-05'),
(40, 37, '14:18:13', '2022-06-05'),
(41, 37, '14:48:25', '2022-06-05'),
(42, 38, '15:01:47', '2022-06-05'),
(43, 38, '15:02:38', '2022-06-05'),
(44, 35, '15:26:12', '2022-06-05'),
(45, 35, '14:15:56', '2022-06-06'),
(46, 38, '14:56:04', '2022-06-06'),
(47, 35, '14:57:08', '2022-06-06'),
(48, 38, '15:14:54', '2022-06-06'),
(49, 38, '14:50:12', '2022-06-07'),
(50, 35, '14:50:44', '2022-06-07'),
(51, 38, '14:50:59', '2022-06-07'),
(52, 35, '15:08:03', '2022-06-07'),
(53, 38, '15:12:48', '2022-06-07'),
(54, 38, '15:41:32', '2022-06-08'),
(55, 36, '15:45:21', '2022-06-08'),
(56, 38, '15:45:56', '2022-06-08'),
(57, 35, '15:20:50', '2022-06-09'),
(58, 38, '15:21:17', '2022-06-09'),
(59, 35, '15:22:29', '2022-06-09'),
(60, 38, '15:40:10', '2022-06-09'),
(61, 35, '15:40:31', '2022-06-09'),
(62, 35, '15:44:13', '2022-06-09'),
(63, 38, '15:44:32', '2022-06-09'),
(64, 35, '15:51:33', '2022-06-09'),
(65, 38, '15:52:30', '2022-06-09'),
(66, 38, '16:12:31', '2022-06-09'),
(67, 35, '16:21:33', '2022-06-09'),
(68, 38, '16:22:40', '2022-06-09'),
(69, 35, '14:24:00', '2022-06-12'),
(70, 38, '14:26:35', '2022-06-12'),
(71, 35, '15:32:31', '2022-06-12'),
(72, 38, '15:33:08', '2022-06-12'),
(73, 38, '15:29:14', '2022-06-13'),
(74, 38, '14:40:44', '2022-06-14'),
(75, 32, '15:14:22', '2022-06-14'),
(76, 35, '15:48:31', '2022-06-14'),
(77, 32, '15:55:38', '2022-06-14'),
(78, 35, '15:58:31', '2022-06-14'),
(79, 35, '15:12:42', '2022-06-15'),
(80, 38, '15:35:34', '2022-06-15'),
(81, 38, '14:36:48', '2022-06-16'),
(82, 38, '15:49:24', '2022-06-16'),
(83, 35, '12:12:47', '2022-06-17'),
(84, 38, '12:16:51', '2022-06-17'),
(85, 35, '12:38:48', '2022-06-17'),
(86, 35, '12:39:51', '2022-06-17'),
(87, 38, '12:41:36', '2022-06-17'),
(88, 35, '15:36:18', '2022-06-17'),
(89, 38, '15:43:01', '2022-06-17'),
(90, 35, '15:57:59', '2022-06-17'),
(91, 38, '15:59:08', '2022-06-17'),
(92, 36, '16:00:04', '2022-06-17'),
(93, 38, '16:02:13', '2022-06-17'),
(94, 35, '22:21:09', '2022-06-17'),
(95, 38, '22:38:11', '2022-06-17'),
(96, 35, '22:52:09', '2022-06-17'),
(97, 35, '22:54:21', '2022-06-17'),
(98, 35, '16:10:01', '2022-06-19'),
(99, 38, '16:11:16', '2022-06-19'),
(100, 35, '15:15:31', '2022-06-22'),
(101, 36, '15:16:55', '2022-06-22'),
(102, 35, '16:00:01', '2022-07-15'),
(103, 35, '15:35:05', '2022-07-17'),
(104, 41, '15:43:53', '2022-07-17'),
(105, 29, '15:46:24', '2022-07-17'),
(106, 35, '16:37:30', '2022-07-19'),
(107, 35, '20:16:05', '2022-07-19'),
(108, 39, '14:18:59', '2022-07-20'),
(109, 38, '15:26:28', '2022-07-20'),
(110, 35, '15:33:39', '2022-07-20'),
(111, 35, '22:38:17', '2022-07-20'),
(112, 29, '22:39:12', '2022-07-20'),
(113, 41, '21:29:03', '2022-07-21'),
(114, 33, '21:31:58', '2022-07-21'),
(115, 33, '13:49:43', '2022-08-01'),
(116, 32, '14:04:40', '2022-08-01'),
(117, 33, '14:06:52', '2022-08-01'),
(118, 32, '14:08:21', '2022-08-01'),
(119, 33, '14:13:42', '2022-08-01'),
(120, 32, '14:15:16', '2022-08-01'),
(121, 29, '14:25:09', '2022-08-01'),
(122, 45, '14:26:04', '2022-08-01'),
(123, 29, '14:26:20', '2022-08-01'),
(124, 33, '14:43:59', '2022-08-01'),
(125, 29, '20:20:08', '2022-08-01'),
(126, 29, '20:22:26', '2022-08-01'),
(127, 35, '20:29:01', '2022-08-01'),
(128, 41, '20:29:43', '2022-08-01');

-- --------------------------------------------------------

--
-- Table structure for table `notice_tb`
--

CREATE TABLE `notice_tb` (
  `ID` int(11) NOT NULL,
  `Notice` varchar(100) NOT NULL,
  `Uploader` varchar(20) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notice_tb`
--

INSERT INTO `notice_tb` (`ID`, `Notice`, `Uploader`, `Date`) VALUES
(10, 'Bellman_Ford.pdf', 'lvl2', '2022-06-16'),
(11, 'BFS_DFS.pdf', 'lvl2', '2022-06-17'),
(12, 'Notice-01.pdf', 'lvl2', '2022-06-17'),
(13, 'Notice-02.pdf', 'lvl2', '2022-06-17'),
(14, 'Notice-03.pdf', 'lvl2', '2022-06-17'),
(15, 'Notice-04.pdf', 'lvl2', '2022-06-17'),
(16, 'Notice-05.pdf', 'lvl2', '2022-06-17'),
(17, 'Notice-06.pdf', 'lvl2', '2022-06-17'),
(18, 'Notice-07.pdf', 'lvl2', '2022-06-17');

-- --------------------------------------------------------

--
-- Table structure for table `reg_tb`
--

CREATE TABLE `reg_tb` (
  `id` int(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `password` varchar(1000) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL,
  `phnum` bigint(11) DEFAULT NULL,
  `district` varchar(1000) NOT NULL,
  `certificate_id` varchar(1000) NOT NULL,
  `astatus` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reg_tb`
--

INSERT INTO `reg_tb` (`id`, `name`, `type`, `password`, `email`, `phnum`, `district`, `certificate_id`, `astatus`, `status`) VALUES
(29, 'Abhishek', 'Level-2 Officer', '123', 'rakeshdas199807@gmail.com', 12345, 'Howrah', '', 'Verified', 'Verified'),
(32, 'Abhishek', 'Level-3 Officer', '12345', 'fliersfunny283@gmail.com', 12345, 'Howrah', '', 'Verified', 'Verified'),
(33, 'Rakesh', 'Level-1 Officer', '2468', 'das.rakesh2001@gmail.com', 12345, 'Kolkata', '', 'NotVerified', 'Verified'),
(35, 'db', 'Hatchery Owner', '123', 'dhrubashis.basak@gmail.com', 1, 'Kolkata', '', 'NotVerified', 'Verified'),
(37, 'db2', 'Hatchery Owner', '123', 'dhrubashis.basak2@gmail.com', 12, 'Kolkata', '', 'NotVerified', 'Verified'),
(38, 'lvl2', 'Level-2 Officer', 'lvl2', 'ex@gmail.com', 9903401317, 'Kolkata', '', 'Verified', 'Verified'),
(39, 'sample1', 'Hatchery Owner', '123', 'ex1@gmail.com', 1, 'Paschim Bardhaman', '', 'NotVerified', 'Verified'),
(40, 'sample2', 'Hatchery Owner', '321', 'ex3@gmail.com', 1, 'Paschim Medinipur', '', 'NotVerified', 'NotVerified'),
(41, 'Farmer 1', 'Hatchery Owner', '123', 'dhrubashis.basak1@gmail.com', 9903401319, 'Kolkata', '', 'NotVerified', 'Verified'),
(42, 'asd', 'Hatchery Owner', '123', 'asd@g.com', 123, 'Bankura', '', 'NotVerified', 'NotVerified'),
(43, 'Suresh Das', 'Level-1 Officer', '123', 'das.suresh2001@gmail.com', 9903401318, 'Howrah', '', 'Verified', 'Verified'),
(44, 'Saurabh Sen', 'Level-1 Officer', '123', 'sen.saurabh20@gmail.com', 8909761310, 'Howrah', '', 'NotVerified', 'Verified'),
(45, 'Farhan', 'Level-1 Officer', '123', 'farhan.work@gmail.com', 9903401312, 'Howrah', '', 'Verified', 'Verified'),
(46, 'Manoj', 'Level-1 Officer', '123', 'manoj.ghosh52@gmail.com', 99032131317, 'Howrah', '', 'Verified', 'Verified'),
(47, 'Ganesh Das', 'Level-1 Officer', '123', 'das.ganesh2001@gmail.com', 9903445317, 'Howrah', '', 'NotVerified', 'Verified'),
(48, 'Rahul Sen', 'Level-1 Officer', '123', 'sen.rahul20@gmail.com', 9823401317, 'Howrah', '', 'NotVerified', 'Verified'),
(49, 'Firhad', 'Level-1 Officer', '123', 'firhad.work@gmail.com', 9903401312, 'Howrah', '', 'NotVerified', 'Verified'),
(50, 'Amitabh', 'Level-1 Officer', '123', 'ami.ghosh52@gmail.com', 8803405617, 'Howrah', '', 'NotVerified', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `user_feedback`
--

CREATE TABLE `user_feedback` (
  `id` int(5) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `subject` varchar(1000) NOT NULL,
  `message` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_feedback`
--

INSERT INTO `user_feedback` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'Rakesh', 'das.rakesh2001@gmail.com', '1232', 'MLA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`Slno`);

--
-- Indexes for table `hatchery`
--
ALTER TABLE `hatchery`
  ADD PRIMARY KEY (`ID Year`) USING BTREE,
  ADD KEY `ID` (`ID`) USING BTREE;

--
-- Indexes for table `login_tb`
--
ALTER TABLE `login_tb`
  ADD PRIMARY KEY (`sl_no`);

--
-- Indexes for table `notice_tb`
--
ALTER TABLE `notice_tb`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `reg_tb`
--
ALTER TABLE `reg_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_feedback`
--
ALTER TABLE `user_feedback`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `Slno` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `login_tb`
--
ALTER TABLE `login_tb`
  MODIFY `sl_no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `notice_tb`
--
ALTER TABLE `notice_tb`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `reg_tb`
--
ALTER TABLE `reg_tb`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `user_feedback`
--
ALTER TABLE `user_feedback`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
