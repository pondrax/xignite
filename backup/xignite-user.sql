-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2018 at 09:05 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xignite`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `grup_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `grup_id`, `username`, `email`, `password`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', 'admin@xigni.te', '$2y$10$dSzZ4QbT1nxlIrVJFc9TBuvmWvJoRXVQWg9Al.ofQIXShAm.92F16', '2018-09-16 02:43:45', '2018-09-18 13:26:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users__groups`
--

CREATE TABLE `users__groups` (
  `id` int(11) NOT NULL,
  `nama_grup` varchar(255) NOT NULL,
  `modul_read` varchar(255) NOT NULL,
  `modul_write` varchar(255) NOT NULL,
  `modul_delete` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users__groups`
--

INSERT INTO `users__groups` (`id`, `nama_grup`, `modul_read`, `modul_write`, `modul_delete`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Administrator', '1,2,3,4,5', '1,2,3,4,5', '1,2,3,4,5', NULL, NULL, NULL),
(2, 'Officer', '1,2,3,4,5', '1,2,3,4,5', '2,3,4', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users__modules`
--

CREATE TABLE `users__modules` (
  `id` int(11) NOT NULL,
  `nama_modul` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users__modules`
--

INSERT INTO `users__modules` (`id`, `nama_modul`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Users', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users__groups`
--
ALTER TABLE `users__groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users__modules`
--
ALTER TABLE `users__modules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users__groups`
--
ALTER TABLE `users__groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users__modules`
--
ALTER TABLE `users__modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
