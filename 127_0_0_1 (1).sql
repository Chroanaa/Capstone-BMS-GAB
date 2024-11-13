-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2024 at 04:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_request`
--
CREATE DATABASE IF NOT EXISTS `user_request` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_request`;

-- --------------------------------------------------------

--
-- Table structure for table `certificate_of_indigency`
--

CREATE TABLE `certificate_of_indigency` (
  `id` int(11) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Middlename` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) NOT NULL,
  `Birthday` varchar(255) NOT NULL,
  `Contact_number` varchar(255) NOT NULL,
  `Monthly_income` varchar(255) NOT NULL,
  `Number_of_dependents` varchar(255) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `time_Created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document_requested`
--

CREATE TABLE `document_requested` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `documents_requested` varchar(255) NOT NULL,
  `requestor_name` varchar(255) DEFAULT NULL,
  `requestor_id` int(11) DEFAULT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `creds_id` int(11) NOT NULL,
  `House/floor/bldgno.` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `Age` int(10) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `Fullname`, `creds_id`, `House/floor/bldgno.`, `Street`, `from`, `to`, `date_of_birth`, `Age`, `place_of_birth`, `contact_number`, `gender`, `civil_status`, `time_Created`) VALUES
(23, 'test', 11, 'test', 'test', 'test', 'test', '2024-11-01', 0, 'test', 'test', 'Male', 'single', '2024-11-02 03:36:52'),
(24, 'test', 12, 'test', 'test', 'test', 'test', '2024-11-01', 0, 'test', 'test', 'Male', 'single', '2024-11-02 03:57:36'),
(25, 'test ', 13, 'test', 'test', 'test', 'test', '2024-11-01', 0, 'test', 'test', 'Male', 'single', '2024-11-02 04:18:21'),
(26, 'test', 14, 'test', 'test', 'test', 'test', '2014-07-04', 10, 'dito', '09274615182', 'Male', 'single', '2024-11-03 21:01:56'),
(27, 'test', 15, 'test', 'test', 'test', 'test', '2024-11-01', 0, 'Quezon City', 'test', 'Male', 'single', '2024-11-13 08:12:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificate_of_indigency`
--
ALTER TABLE `certificate_of_indigency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_requested`
--
ALTER TABLE `document_requested`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_creds_id` (`creds_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificate_of_indigency`
--
ALTER TABLE `certificate_of_indigency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `document_requested`
--
ALTER TABLE `document_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_creds_id` FOREIGN KEY (`creds_id`) REFERENCES `user_creds`.`user_creds` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
