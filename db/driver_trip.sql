-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2021 at 06:30 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ride`
--

-- --------------------------------------------------------

--
-- Table structure for table `driver_trip`
--

CREATE TABLE `driver_trip` (
  `trip_id` int(11) NOT NULL,
  `driver_emailid` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver_trip`
--

INSERT INTO `driver_trip` (`trip_id`, `driver_emailid`) VALUES
(10001, 'def@gmail.com'),
(10003, 'def@gmail.com'),
(10007, 'def@gmail.com'),
(10008, 'abc@gmail.com'),
(10036, 'abc@gmail.com'),
(10049, 'aaaa'),
(10050, 'aaaa'),
(10051, 'abc@gmail.com'),
(10052, 'abc@gmail.com'),
(10053, 'abc@gmail.com'),
(10054, 'abc@gmail.com'),
(10055, 'abc@gmail.com'),
(10056, 'abc@gmail.com'),
(10057, 'abc@gmail.com'),
(10058, 'abc@gmail.com'),
(10059, 'abc@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driver_trip`
--
ALTER TABLE `driver_trip`
  ADD PRIMARY KEY (`trip_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
