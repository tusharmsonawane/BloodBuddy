-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/


-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 07:39 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- Database: `bloodbuddy`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminregister`
--



CREATE TABLE `adminregister` (
  `id` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `adminemail` varchar(255) NOT NULL,
  `adminpassword` varchar(255) NOT NULL,
  `admintype` varchar(255) NOT NULL DEFAULT 'admin',
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminregister`
--

INSERT INTO `adminregister` (`id`, `adminname`, `adminemail`, `adminpassword`, `admintype`, `date`) VALUES
(3, 'tushar sonawane', 'tushar@gmail.com', '$2y$10$MTJ.Lc9AmRCYKZYU.5I2..fMTTEZ.mgifme4gdcCnH3j3S90mSiFm', 'admin', '2023-03-07'),
(9, 'deven wagh', 'deven@gmail.com', '$2y$10$eVn4B1fDIIZgs15WzMxBo.yGdc8Z7Pi6UVMxb1.efKpc7DPT5upqm', 'admin', '2023-03-11');

-- --------------------------------------------------------

--
-- Table structure for table `bloodbankregister`
--

CREATE TABLE `bloodbankregister` (
  `id` int(11) NOT NULL,
  `bloodbankname` varchar(225) NOT NULL,
  `bloodbankid` varchar(225) NOT NULL,
  `bloodbankemail` varchar(255) NOT NULL,
  `bloodbankprofile` varchar(255) NOT NULL DEFAULT 'bloodbank.png',
  `bloodbanknumber` varchar(255) NOT NULL,
  `bloodbankfile` varchar(255) NOT NULL,
  `bloodbankLid` varchar(255) NOT NULL,
  `bloodbankmanager` varchar(255) NOT NULL,
  `bloodbankpassword` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `bloodbankstatus` varchar(255) NOT NULL DEFAULT 'pendding'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bloodbankregister`
--

INSERT INTO `bloodbankregister` (`id`, `bloodbankname`, `bloodbankid`, `bloodbankemail`, `bloodbankprofile`, `bloodbanknumber`, `bloodbankfile`, `bloodbankLid`, `bloodbankmanager`, `bloodbankpassword`, `date`, `time`, `bloodbankstatus`) VALUES
(1, 'bloodbank name 1', '197217', 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank.png', '3333', 'blog-2.jpg', '3333333', 'gggg', '$2y$10$JuIVKVD9jo.9RYzi3GnyLu5m9brRpENSktTnnB.7rykBkAjP2sRye', '2023-05-15', '09:03:06', 'accept');

-- --------------------------------------------------------

--
-- Table structure for table `bloodcamp`
--

CREATE TABLE `bloodcamp` (
  `id` int(11) NOT NULL,
  `bloodcampid` varchar(255) NOT NULL,
  `bloodbankname` varchar(255) NOT NULL,
  `bloodbankid` varchar(255) NOT NULL,
  `bloodcampname` varchar(255) NOT NULL,
  `bloodcampaddress` varchar(255) NOT NULL,
  `bloodcampdate` varchar(255) NOT NULL,
  `bloodcamptimeto` varchar(255) NOT NULL,
  `bloodcamptimefrom` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendding'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bloodcamp`
--

INSERT INTO `bloodcamp` (`id`, `bloodcampid`, `bloodbankname`, `bloodbankid`, `bloodcampname`, `bloodcampaddress`, `bloodcampdate`, `bloodcamptimeto`, `bloodcamptimefrom`, `status`) VALUES
(5, '70391186', 'bloodbank name 1', '197217', 'navgeevan camp1', 'dhule', '2023-05-17', '07:07 pm', '07:08 pm', 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `bloodcampstock`
--

CREATE TABLE `bloodcampstock` (
  `id` int(11) NOT NULL,
  `bloodbankid` varchar(255) NOT NULL,
  `bloodcampid` varchar(255) NOT NULL,
  `AP` varchar(255) NOT NULL,
  `BP` varchar(255) NOT NULL,
  `ABP` varchar(255) NOT NULL,
  `OP` varchar(255) NOT NULL,
  `AM` varchar(255) NOT NULL,
  `BM` varchar(255) NOT NULL,
  `ABM` varchar(255) NOT NULL,
  `OM` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bloodstock`
--

CREATE TABLE `bloodstock` (
  `id` int(11) NOT NULL,
  `bloodbankname` varchar(255) NOT NULL,
  `bloodbankemail` varchar(255) NOT NULL,
  `bloodbankid` varchar(255) NOT NULL,
  `AP` varchar(255) DEFAULT NULL,
  `BP` varchar(255) DEFAULT NULL,
  `ABP` varchar(255) DEFAULT NULL,
  `OP` varchar(255) DEFAULT NULL,
  `OM` varchar(255) DEFAULT NULL,
  `AM` varchar(255) DEFAULT NULL,
  `BM` varchar(255) DEFAULT NULL,
  `ABM` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `donarappointment`
--

CREATE TABLE `donarappointment` (
  `id` int(11) NOT NULL,
  `appointmentid` varchar(255) NOT NULL,
  `donarname` varchar(255) NOT NULL,
  `donaremail` varchar(255) NOT NULL,
  `donarid` varchar(255) NOT NULL,
  `bloodbankid` varchar(255) NOT NULL,
  `bookdate` varchar(255) NOT NULL,
  `completedate` varchar(255) NOT NULL,
  `completetime` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `bloodbag` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donarappointment`
--

INSERT INTO `donarappointment` (`id`, `appointmentid`, `donarname`, `donaremail`, `donarid`, `bloodbankid`, `bookdate`, `completedate`, `completetime`, `status`, `bloodbag`) VALUES
(4, '20514817', 'tushar sonawane', 'tusharmsonawane20@gmail.com', '487541', '197217', '2023-05-18', '', '', 'accept', '0');

-- --------------------------------------------------------

--
-- Table structure for table `donarregister`
--

CREATE TABLE `donarregister` (
  `id` int(11) NOT NULL,
  `donarid` varchar(255) NOT NULL,
  `donarname` varchar(255) NOT NULL,
  `donaremail` varchar(255) NOT NULL,
  `donarprofile` varchar(255) NOT NULL DEFAULT 'user.png',
  `donargender` varchar(255) NOT NULL,
  `donardob` varchar(255) NOT NULL,
  `donarbloodgroup` varchar(255) NOT NULL,
  `donarnumber` varchar(255) NOT NULL,
  `donaraddress` varchar(255) NOT NULL,
  `donaroccuption` varchar(255) NOT NULL,
  `donarpassword` varchar(255) NOT NULL,
  `donarotp` varchar(255) NOT NULL,
  `time` time NOT NULL DEFAULT current_timestamp(),
  `lastdate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='7';

--
-- Dumping data for table `donarregister`
--

INSERT INTO `donarregister` (`id`, `donarid`, `donarname`, `donaremail`, `donarprofile`, `donargender`, `donardob`, `donarbloodgroup`, `donarnumber`, `donaraddress`, `donaroccuption`, `donarpassword`, `donarotp`, `time`, `lastdate`) VALUES
(1, '487541', 'tushar sonawane', 'tusharmsonawane20@gmail.com', 'user.png', 'male', '2002-03-04', 'ABP', '8888888888', '9,surbhi colony sakri road dhule', 'student', '$2y$10$D1fI7JeDIjEPAQM8uNitiuLTogexyN3DD2NfxZINRG82TsUeYztJu', '', '09:01:06', '15-05-2023');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalappointment`
--

CREATE TABLE `hospitalappointment` (
  `id` int(11) NOT NULL,
  `hospitalid` varchar(255) NOT NULL,
  `hospitalappointmentid` varchar(255) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pemail` varchar(255) NOT NULL,
  `pdisease` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `pweight` varchar(255) NOT NULL,
  `pbloodgroup` varchar(255) NOT NULL,
  `doctorname` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendding',
  `bloodbag` varchar(255) NOT NULL,
  `bloodbankid` varchar(255) NOT NULL,
  `senddate` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `sendtime` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `accepttime` varchar(255) NOT NULL,
  `acceptdate` varchar(255) NOT NULL,
  `completetime` varchar(255) NOT NULL,
  `completedate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalappointment`
--

INSERT INTO `hospitalappointment` (`id`, `hospitalid`, `hospitalappointmentid`, `pname`, `pemail`, `pdisease`, `page`, `pweight`, `pbloodgroup`, `doctorname`, `status`, `bloodbag`, `bloodbankid`, `senddate`, `sendtime`, `accepttime`, `acceptdate`, `completetime`, `completedate`) VALUES
(1, '934111', '9346568', 'deven wagh', 'HOSPITAL1@GMAIL.COM', 'hello', '33', '22', 'ABP', '11', 'complete', '2', '197217', '15-05-2023', '09:13:52am', '09:21:05am', '15-05-2023', '09:15:08am', '15-05-2023'),
(3, '934111', '8797335', 'tushar sonawane', 'tushar9@gmail.com', 'ttt', '11', '45', 'BP', 'hhhh', 'accept', '2', '197217', '15-05-2023', '10:48:37pm', '11:41:05pm', '15-05-2023', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalregister`
--

CREATE TABLE `hospitalregister` (
  `id` int(11) NOT NULL,
  `hospitalname` varchar(255) NOT NULL,
  `hospitalid` varchar(255) NOT NULL,
  `hospitalemail` varchar(255) NOT NULL,
  `hospitalnumber` varchar(22) NOT NULL,
  `hospitalfile` varchar(255) NOT NULL,
  `hospitalLid` varchar(255) NOT NULL,
  `hospitaldrname` varchar(255) NOT NULL,
  `hospitaladdress` varchar(255) NOT NULL,
  `hospitalpassword` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp(),
  `hospitalotp` varchar(255) NOT NULL,
  `hospitalstatus` varchar(255) NOT NULL DEFAULT 'pendding',
  `hospitalprofile` varchar(255) NOT NULL DEFAULT 'hospital.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalregister`
--

INSERT INTO `hospitalregister` (`id`, `hospitalname`, `hospitalid`, `hospitalemail`, `hospitalnumber`, `hospitalfile`, `hospitalLid`, `hospitaldrname`, `hospitaladdress`, `hospitalpassword`, `date`, `time`, `hospitalotp`, `hospitalstatus`, `hospitalprofile`) VALUES
(1, 'hospital name 1', '934111', 'isttush@gmail.com', '222222', 'feature-4.jpg', '111111', 'dr.tms', 'dhule', '$2y$10$Vb6EXNXFXaH016QtScqTOO/7dGQs9sl8gP1A.rkKb237yDn7ApiHu', '2023-05-15', '09:02:41', '', 'accept', 'hospital.png');

-- --------------------------------------------------------

--
-- Table structure for table `hospitalrequest`
--

CREATE TABLE `hospitalrequest` (
  `id` int(11) NOT NULL,
  `requestid` varchar(255) NOT NULL,
  `hospitalname` varchar(255) NOT NULL,
  `hospitalid` varchar(255) NOT NULL,
  `donarid` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pendding',
  `senddate` varchar(255) NOT NULL,
  `sendtime` varchar(255) NOT NULL,
  `responsedate` varchar(255) NOT NULL,
  `responsetime` varchar(255) NOT NULL,
  `bloodbag` varchar(255) NOT NULL DEFAULT '0',
  `completetime` varchar(255) NOT NULL,
  `completedate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospitalrequest`
--

INSERT INTO `hospitalrequest` (`id`, `requestid`, `hospitalname`, `hospitalid`, `donarid`, `status`, `senddate`, `sendtime`, `responsedate`, `responsetime`, `bloodbag`, `completetime`, `completedate`) VALUES
(1, '36590596', 'hospital name 1', '934111', '487541', 'accept', '15-05-2023', '09:11:43am', '17-05-2023', '01:41:08pm', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userfeedback`
--

CREATE TABLE `userfeedback` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userfeedback`
--

INSERT INTO `userfeedback` (`id`, `firstname`, `lastname`, `email`, `mobileno`, `message`, `date`, `time`) VALUES
(1, 'tushar', 'sonawane', 'tushar@gmail.com', '8421652323', 'hi hello', '17-05-2023', '02:37:15pm');

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `id` int(11) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`id`, `useremail`, `usertype`, `userpassword`, `date`, `time`, `status`) VALUES
(1, 'tushar@gmail.com', 'new user', '', '15-May-2023', '09:00:26 pm', 'failed'),
(2, 'tushar@gmail.com', 'new user', '', '15-May-2023', '09:01:12 pm', 'failed'),
(3, 'tushar@gmail.com', 'admin', '', '15:May:2023', '05:31:48 pm', 'success'),
(4, 'tushar@gmail.com', 'admin', '111', '15:May:2023', '05:35:14 pm', 'success'),
(5, 'tushar@gmail.com', 'new user', '1111', '15-May-2023', '09:06:36 pm', 'failed'),
(6, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '15-May-2023', '09:06:50 pm', 'success'),
(7, 'tushar@gmail.com', 'admin', '111', '15:May:2023', '05:37:18 pm', 'success'),
(8, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '15-May-2023', '09:08:30 pm', 'success'),
(9, 'isttush@gmail.com', 'hospital', 'Null', '15-May-2023', '10:43:42 pm', 'success'),
(10, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '15-May-2023', '10:49:05 pm', 'success'),
(11, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '15-May-2023', '10:51:29 pm', 'success'),
(12, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '17-May-2023', '01:40:48 pm', 'success'),
(13, 'tushar@gmail.com', 'admin', '111', '17:May:2023', '10:11:31 am', 'success'),
(14, 'tushar@gmail.com', 'admin', '111', '17:May:2023', '11:07:28 am', 'success'),
(15, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '17-May-2023', '03:02:37 pm', 'success'),
(16, 'isttush@gmail.com', 'hospital', 'Null', '17-May-2023', '04:22:36 pm', 'success'),
(17, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '17-May-2023', '04:38:45 pm', 'success'),
(18, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '17-May-2023', '04:39:10 pm', 'success'),
(19, 'isttush@gmail.com', 'hospital', 'Null', '17-May-2023', '04:39:25 pm', 'success'),
(20, 'isttush@gmail.com', 'hospital', 'Null', '17-May-2023', '04:39:41 pm', 'success'),
(21, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '17-May-2023', '04:43:29 pm', 'success'),
(22, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '17-May-2023', '06:21:38 pm', 'success'),
(23, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '17-May-2023', '07:04:26 pm', 'success'),
(24, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '17-May-2023', '07:09:10 pm', 'success'),
(25, 'tushar@gmail.com', 'admin', '111', '17:May:2023', '03:40:44 pm', 'success'),
(26, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '17-May-2023', '11:03:08 pm', 'success'),
(27, 'tushar@gmail.com', 'new user', '1111', '18-May-2023', '08:47:55 pm', 'failed'),
(28, 'tusharmsonawane20@gmail.com', 'donar', 'Null', '18-May-2023', '08:48:03 pm', 'success'),
(29, 'tushar.sonawane@ssvpsengg.ac.in', 'bloodbank', 'Null', '18-May-2023', '08:50:50 pm', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `userregister`
--

CREATE TABLE `userregister` (
  `id` int(11) NOT NULL,
  `usertype` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `userid` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `usernumber` varchar(200) NOT NULL,
  `userotp` varchar(255) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `time` time NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userregister`
--

INSERT INTO `userregister` (`id`, `usertype`, `username`, `userpassword`, `userid`, `useremail`, `usernumber`, `userotp`, `date`, `time`) VALUES
(1, 'donar', 'tushar sonawane', '$2y$10$D1fI7JeDIjEPAQM8uNitiuLTogexyN3DD2NfxZINRG82TsUeYztJu', '487541', 'tusharmsonawane20@gmail.com', '8888888888', '', '2023-05-15', '09:01:32'),
(2, 'hospital', 'hospital name 1', '$2y$10$Vb6EXNXFXaH016QtScqTOO/7dGQs9sl8gP1A.rkKb237yDn7ApiHu', '934111', 'isttush@gmail.com', '222222', '', '2023-05-15', '09:03:54'),
(3, 'bloodbank', 'bloodbank name 1', '$2y$10$JuIVKVD9jo.9RYzi3GnyLu5m9brRpENSktTnnB.7rykBkAjP2sRye', '197217', 'tushar.sonawane@ssvpsengg.ac.in', '3333', '', '2023-05-15', '09:04:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminregister`
--
ALTER TABLE `adminregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodbankregister`
--
ALTER TABLE `bloodbankregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodcamp`
--
ALTER TABLE `bloodcamp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodcampstock`
--
ALTER TABLE `bloodcampstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bloodstock`
--
ALTER TABLE `bloodstock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donarappointment`
--
ALTER TABLE `donarappointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donarregister`
--
ALTER TABLE `donarregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalappointment`
--
ALTER TABLE `hospitalappointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalregister`
--
ALTER TABLE `hospitalregister`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hospitalrequest`
--
ALTER TABLE `hospitalrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userfeedback`
--
ALTER TABLE `userfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userregister`
--
ALTER TABLE `userregister`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminregister`
--
ALTER TABLE `adminregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `bloodbankregister`
--
ALTER TABLE `bloodbankregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bloodcamp`
--
ALTER TABLE `bloodcamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bloodcampstock`
--
ALTER TABLE `bloodcampstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodstock`
--
ALTER TABLE `bloodstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donarappointment`
--
ALTER TABLE `donarappointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donarregister`
--
ALTER TABLE `donarregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospitalappointment`
--
ALTER TABLE `hospitalappointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hospitalregister`
--
ALTER TABLE `hospitalregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hospitalrequest`
--
ALTER TABLE `hospitalrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userfeedback`
--
ALTER TABLE `userfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
