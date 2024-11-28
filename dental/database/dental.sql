-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2024 at 05:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `name`, `email`) VALUES
(1, 'admin', '123456', 'Admin', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `dentist_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `date`, `time`, `dentist_id`, `client_id`, `status`) VALUES
(1, '09/16/2024', '8:00 AM', 1, 2, 2),
(2, '09/16/2024', '9:00 AM', 1, 3, 0),
(3, '09/16/2024', '10:00 AM', 1, 4, 0),
(4, '09/26/2024', '3:00 PM', 2, 2, 0),
(5, '09/24/2024', '1:00 PM', 1, 2, 0),
(6, '09/25/2024', '1:00 PM', 2, 7, 0),
(7, '09/27/2024', '11:00 AM', 1, 7, 0),
(8, '09/27/2024', '2:00 PM', 4, 7, 0),
(9, '09/25/2024', '4:00 PM', 6, 7, 0),
(10, '09/30/2024', '3:00 PM', 1, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `email`, `password`, `name`, `phone`, `address`, `status`) VALUES
(1, 'client1@gmail.com', '123456', 'Client 1', '09123456789', 'Client 1 Address', 1),
(2, 'client2@gmail.com', '123456', 'Client 2', '09123456789', 'Client 2 Address', 1),
(3, 'client3@gmail.com', '123456', 'Client 3', '09123456789', 'Client 3 Address', 1),
(4, 'client4@gmail.com', '123456', 'Client 4', '09123456789', 'Client 4 Address', 0),
(5, 'client5@gmail.com', '123456', 'Client 5', '09123456789', 'Client 5 Address', 1),
(6, 'client6@gmail.com', '123456', 'Client 6', '09123456789', 'Client 6 Address', 1),
(7, 'client7@gmail.com', '123456', 'Client 7', '09123456789', 'Client 7 Address', 1),
(8, 'client8@gmail.com', '123456', 'Client 8', '09123456789', 'Client 8 Address', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dentists`
--

CREATE TABLE `dentists` (
  `dentist_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `schedule_id` varchar(100) NOT NULL,
  `status` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dentists`
--

INSERT INTO `dentists` (`dentist_id`, `email`, `password`, `name`, `address`, `phone`, `picture`, `schedule_id`, `status`) VALUES
(1, 'dentist1@gmail.com', '123456', 'Dentist 1', 'Dentist 1 Address', '09123456789', 'profile-img.jpg', '1', 1),
(2, 'dentist2@gmail.com', '123456', 'Dentist 2', 'Dentist 2 Address', '09123456789', 'profile-img.jpg', '4', 1),
(3, 'dentist3@gmail.com', '123456', 'Dentist 3', 'Dentist 3 Address', '09123456789', 'profile-img.jpg', '0', 0),
(4, 'dentist4@gmail.com', '123456', 'Dentist 4', 'Dentist 4 Address', '09123456789', 'profile-img.jpg', '12', 1),
(5, 'dentist5@gmail.com', '123456', 'Dentist 5', 'Dentist 5 Address', '09123456789', 'profile-img.jpg', '0', 0),
(6, 'dentist6@gmail.com', 'brightbite2024', 'Dentist 6', 'Dentist 6 Address', '09123456789', 'profile-img.jpg', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `schedule_id` int(11) NOT NULL,
  `day` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`schedule_id`, `day`, `time`) VALUES
(1, 'Mon-Fri', '8:00 AM - 12:00 PM'),
(2, 'Mon-Fri', '1:00 PM - 3:00 PM'),
(3, 'Mon-Fri', '3:00 PM - 5:00 PM'),
(4, 'Mon,Wed,Fri', '8:00 AM - 11:00 AM'),
(5, 'Mon,Wed,Fri', '1:00 PM - 3:00 PM'),
(6, 'Mon,Wed,Fri', '3:00 PM - 5:00 PM'),
(7, 'Tues,Thu,Sat', '8:00 AM - 11:00 AM'),
(8, 'Tues,Thu,Sat', '1:00 PM - 3:00 PM'),
(9, 'Tues,Thu,Sat', '3:00 PM - 5:00 PM'),
(10, 'Mon-Sat', '8:00 AM - 11:00 AM'),
(11, 'Mon-Sat', '1:00 PM - 3:00 PM'),
(12, 'Mon-Sat', '3:00 PM - 5:00 PM');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `dentists`
--
ALTER TABLE `dentists`
  ADD PRIMARY KEY (`dentist_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `dentists`
--
ALTER TABLE `dentists`
  MODIFY `dentist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
