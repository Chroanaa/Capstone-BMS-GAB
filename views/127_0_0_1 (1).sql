-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2025 at 05:49 PM
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
-- Table structure for table `admin_creds`
--

CREATE TABLE `admin_creds` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `time_Created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_creds`
--

INSERT INTO `admin_creds` (`id`, `username`, `password`, `time_Created`) VALUES
(1, 'admin', 'admin', '2025-02-22 05:40:56');

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
(29, 'test', '$2y$10$NllcOlo/Juh.sAiR/LoOoeGuzffSGiJYfo32ynkVO3/tagkY.DT/m', '2025-03-16 23:09:02'),
(30, 'Menard', '$2y$10$1bbJ5ox0aK0qxANXTgBEseH3O/IaO1JF9dxn3M9TbXWeZX5upWxlO', '2025-03-18 07:07:16'),
(31, 'test1', '$2y$10$2ZTeKGZV2owea8V/X0bUwOKu9wMFaNAy9g6cR4XER.Wwd/t3nM80m', '2025-03-18 07:35:43'),
(32, 'Perez', '$2y$10$jGr6ISmofFCFgxpaeoP92.RHpqyoct5X4j.UxZOx8z8Ex86GIwN56', '2025-03-19 04:44:48'),
(33, 'tests', '$2y$10$BCFJQCItvbsfXyNyOml.qeshwtPHauPBNJgFwt68c9FWjOucSZRBm', '2025-04-06 05:26:01'),
(34, 'tests', '$2y$10$LieSXIqpnILgJMVnKXFqde3buyBtXo8XmjY3YVsWgpKzHCZQKaU8S', '2025-04-06 05:26:28'),
(35, 'menmen', '$2y$10$S6vUXSRWcrWbD/VROZz7jei9bnJ5Yt1Q.AeApvNiK6GFh0mMpeHOe', '2025-04-17 05:24:22'),
(36, 'testes', '$2y$10$78YErDOsOOmKAFj9qkH9bOoQnO3YI1lxluhZYp8zz1NpCkQlFDPT2', '2025-04-22 14:28:42'),
(40, 'testest', '$2y$10$HS5lDqWMgQziG2eMKiQcA.n0l3T3wXahCiX6d7JrtcRrKYQ6CQ6T6', '2025-04-22 14:30:17'),
(41, 'testest', '$2y$10$fMlUV/84GlmGxSENjxy51emPqntRS2uOXNNFaA.86.E1mRCu3n5Xu', '2025-04-22 14:30:36'),
(42, 'testestes', '$2y$10$fpSglsr4sVMJ1zCJpF4MLOBBSBhwMTFSqSNGei2Jfy4u07297n.ma', '2025-04-22 14:30:59'),
(43, 'testestes', '$2y$10$TKUJxKHYOHESuJzzD/xVPeJXuLJVhkdXr4XM3ro0GYZHodC9155Bi', '2025-04-22 14:32:20'),
(44, 'testestes', '$2y$10$4lptVNO7OrW.Uje1IcRYder/u/y/bFKH1cm7ig/4pZmVEegHUCzNK', '2025-04-22 14:32:38'),
(45, 'admin', '$2y$10$qr1To20rxxg4/J0VgymWbOTKyaeIsHokztQo4oiEUqsnn/QMZOHOC', '2025-04-22 14:33:27'),
(46, 'admin', '$2y$10$36MyMmWBphDoQp.GBmpQU.m1LN0Qy8Y3xHBC0WAIwdVNRvhjsvZwW', '2025-04-22 14:35:30'),
(47, 'admin', '$2y$10$BTkzByvCA7JdgoowCiGWDeb91Nhe/0mvrT3PZ9ep4NJbLNDgRlO.u', '2025-04-22 14:35:50'),
(53, 'etstestests', '$2y$10$nbUDf.bkE60MQ9JmEeEnx.MEq1jl.eKL3GX8dZ20sCASnLjuii3Tu', '2025-04-22 14:47:48'),
(54, '35423523523', '$2y$10$G6T42RR9fOIxQjfvr/PpcuZjmUwunT4per0RRrHCfdNAjW7100NCa', '2025-04-22 14:48:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_creds`
--
ALTER TABLE `admin_creds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_creds`
--
ALTER TABLE `user_creds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_creds`
--
ALTER TABLE `admin_creds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_creds`
--
ALTER TABLE `user_creds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
