-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 06:55 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
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
  `AP` varchar(255) DEFAULT '0',
  `BP` varchar(255) DEFAULT '0',
  `ABP` varchar(255) DEFAULT '0',
  `OP` varchar(255) DEFAULT '0',
  `OM` varchar(255) DEFAULT '0',
  `AM` varchar(255) DEFAULT '0',
  `BM` varchar(255) DEFAULT '0',
  `ABM` varchar(255) DEFAULT '0'
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodbankregister`
--
ALTER TABLE `bloodbankregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodcamp`
--
ALTER TABLE `bloodcamp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodcampstock`
--
ALTER TABLE `bloodcampstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bloodstock`
--
ALTER TABLE `bloodstock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donarappointment`
--
ALTER TABLE `donarappointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donarregister`
--
ALTER TABLE `donarregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitalappointment`
--
ALTER TABLE `hospitalappointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitalregister`
--
ALTER TABLE `hospitalregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hospitalrequest`
--
ALTER TABLE `hospitalrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userfeedback`
--
ALTER TABLE `userfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userregister`
--
ALTER TABLE `userregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
