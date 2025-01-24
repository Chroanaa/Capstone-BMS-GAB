-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 04:54 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_creds`
--
CREATE DATABASE IF NOT EXISTS `user_creds` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_creds`;

-- --------------------------------------------------------

--
-- Table structure for table `user_creds`
--

CREATE TABLE `user_creds` (
  `id` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `time_Created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_creds`
--

INSERT INTO `user_creds` (`id`, `Username`, `Password`, `time_Created`) VALUES
(11, 'test', 'test', NULL),
(12, 'test1', 'test', NULL),
(13, 'test', 'test', NULL),
(14, 'test', 'test', NULL),
(15, 'test', 'test', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_creds`
--
ALTER TABLE `user_creds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_creds`
--
ALTER TABLE `user_creds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- Database: `user_request`
--
CREATE DATABASE IF NOT EXISTS `user_request` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_request`;

-- --------------------------------------------------------

--
-- Table structure for table `document_requested`
--

CREATE TABLE `document_requested` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `documents_requested` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_requested`
--

INSERT INTO `document_requested` (`id`, `user_id`, `documents_requested`) VALUES
(1, 11, 'Barangay_clearance'),
(2, 11, 'Certificate_of_indigency');

-- --------------------------------------------------------

--
-- Table structure for table `document_requested_for_others`
--

CREATE TABLE `document_requested_for_others` (
  `id` int(11) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `documents_requested` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `document_requested_for_others`
--

INSERT INTO `document_requested_for_others` (`id`, `requestor_id`, `documents_requested`, `purpose`, `time_Created`) VALUES
(2, 11, 'Barangay_clearance', 'employment', '2024-11-22 14:50:05'),
(3, 11, 'Certificate_of_indigency', 'employment', '2024-11-22 14:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `requested_for_others_info`
--

CREATE TABLE `requested_for_others_info` (
  `id` int(11) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `requestor_id` int(11) NOT NULL,
  `HouseBldgFloorno` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `Age` varchar(255) NOT NULL,
  `place_of_birth` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `civil_status` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requested_for_others_info`
--

INSERT INTO `requested_for_others_info` (`id`, `Fullname`, `requestor_id`, `HouseBldgFloorno`, `Street`, `from`, `to`, `date_of_birth`, `Age`, `place_of_birth`, `contact_number`, `gender`, `civil_status`, `time_Created`) VALUES
(1, 'test others', 11, 'test', 'test', 'test', 'test', '2024-11-22', '0', 'test', 'test', 'Male', 'single', '2024-11-22 07:25:36'),
(2, 'test others', 11, 'test', 'test', 'test', 'test', '2024-11-22', '0', 'test', 'test', 'Male', 'single', '2024-11-22 07:27:07'),
(3, 'test others', 11, 'test', 'test', 'test', 'test', '2024-11-22', '0', 'test', 'test', 'Male', 'single', '2024-11-22 07:29:40'),
(4, 'test others', 11, 'test', 'test', 'test', 'test', '2024-11-22', '0', 'test', 'test', 'Male', 'single', '2024-11-22 07:44:39'),
(5, 'test', 11, 'test', 'test', 'test', 'tes', '2024-11-08', '0', 'tset', 'test', 'Male', 'single', '2024-11-22 07:44:56'),
(6, 'test', 11, 'test', 'test', 'test', 'tes', '2024-11-08', '0', 'tset', 'test', 'Male', 'single', '2024-11-22 07:50:05');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for table `document_requested`
--
ALTER TABLE `document_requested`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `document_requested_for_others`
--
ALTER TABLE `document_requested_for_others`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requested_for_others_info`
--
ALTER TABLE `requested_for_others_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_requestor_id` (`requestor_id`);

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
-- AUTO_INCREMENT for table `document_requested`
--
ALTER TABLE `document_requested`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_requested_for_others`
--
ALTER TABLE `document_requested_for_others`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `requested_for_others_info`
--
ALTER TABLE `requested_for_others_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `document_requested`
--
ALTER TABLE `document_requested`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `user_creds`.`user_creds` (`id`);

--
-- Constraints for table `requested_for_others_info`
--
ALTER TABLE `requested_for_others_info`
  ADD CONSTRAINT `fk_requestor_id` FOREIGN KEY (`requestor_id`) REFERENCES `user_creds`.`user_creds` (`id`);

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_creds_id` FOREIGN KEY (`creds_id`) REFERENCES `user_creds`.`user_creds` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
