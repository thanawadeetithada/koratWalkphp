-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2025 at 01:38 PM
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
-- Database: `koratwalk`
--

-- --------------------------------------------------------

--
-- Table structure for table `gps_logs`
--

CREATE TABLE `gps_logs` (
  `user_id` int(11) NOT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gps_logs`
--

INSERT INTO `gps_logs` (`user_id`, `latitude`, `longitude`, `timestamp`) VALUES
(2, 13.7658368, 100.5420544, '2025-06-07 18:14:23'),
(2, 13.7658368, 100.5420544, '2025-06-07 18:14:28'),
(2, 13.7658368, 100.5420544, '2025-06-07 18:37:18'),
(2, 13.7658368, 100.5420544, '2025-06-07 18:37:23'),
(2, 13.7658368, 100.5420544, '2025-06-07 18:44:01'),
(2, 13.7658368, 100.5420544, '2025-06-07 18:44:06'),
(3, 13.7658368, 100.5420544, '2025-06-07 18:46:36'),
(3, 13.7658368, 100.5420544, '2025-06-07 18:52:02'),
(3, 13.7658368, 100.5420544, '2025-06-07 18:52:07'),
(5, 13.7658368, 100.5420544, '2025-06-07 18:55:27'),
(5, 13.7658368, 100.5420544, '2025-06-07 18:55:32'),
(5, 13.7658368, 100.5420544, '2025-06-07 18:55:48'),
(5, 13.7658368, 100.5420544, '2025-06-07 18:55:53'),
(9, 13.7527296, 100.5584384, '2025-06-20 18:19:51'),
(9, 13.7527296, 100.5584384, '2025-06-20 19:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `weight` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `weight`) VALUES
(1, 'test', 'ww', 15),
(2, 'fff', 'ff', 33),
(3, 'w', 'w', 55),
(4, 's', 'sss', 558),
(5, 'w', 'w', 55),
(6, 'test1', 'ww', 15),
(7, 'ss', 'ss', 33),
(8, 'ww', 'ww', 22),
(9, 'dd', 'e', 58);

-- --------------------------------------------------------

--
-- Table structure for table `walk_summary`
--

CREATE TABLE `walk_summary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `distance` float NOT NULL,
  `steps` int(11) NOT NULL,
  `calories` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `walk_summary`
--

INSERT INTO `walk_summary` (`id`, `user_id`, `distance`, `steps`, `calories`, `created_at`) VALUES
(8, 2, 1234, 1800, 85, '2025-06-07 18:13:36'),
(9, 2, 1234, 1800, 85, '2025-06-07 18:13:56'),
(10, 2, 0, 0, 0, '2025-06-07 18:45:59'),
(11, 3, 0, 0, 0, '2025-06-07 18:46:40'),
(12, 3, 0, 0, 0, '2025-06-07 18:52:10'),
(13, 5, 0, 0, 0, '2025-06-07 18:55:34'),
(14, 5, 0, 0, 0, '2025-06-07 18:55:56'),
(15, 9, 0, 0, 0, '2025-06-21 09:10:10'),
(16, 9, 0, 0, 0, '2025-06-21 09:11:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gps_logs`
--
ALTER TABLE `gps_logs`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walk_summary`
--
ALTER TABLE `walk_summary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `walk_summary`
--
ALTER TABLE `walk_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gps_logs`
--
ALTER TABLE `gps_logs`
  ADD CONSTRAINT `gps_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
