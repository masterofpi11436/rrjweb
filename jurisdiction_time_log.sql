-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2025 at 03:18 PM
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
-- Database: `rrj`
--

-- --------------------------------------------------------

--
-- Table structure for table `jurisdiction_time_log`
--

CREATE TABLE `jurisdiction_time_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurisdiction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_visit` date NOT NULL,
  `arrival_time` time NOT NULL,
  `booking_start` time DEFAULT NULL,
  `booking_end` time DEFAULT NULL,
  `departure_time` time NOT NULL,
  `magistrate_start` time DEFAULT NULL,
  `magistrate_end` time DEFAULT NULL,
  `nurse_start` time DEFAULT NULL,
  `nurse_end` time DEFAULT NULL,
  `inmate_count` int(255) DEFAULT NULL,
  `did_not_get_committed` tinyint(1) NOT NULL DEFAULT 0,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `officer_start` time DEFAULT NULL,
  `officer_end` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurisdiction_time_log`
--

INSERT INTO `jurisdiction_time_log` (`id`, `jurisdiction_id`, `date_of_visit`, `arrival_time`, `booking_start`, `booking_end`, `departure_time`, `magistrate_start`, `magistrate_end`, `nurse_start`, `nurse_end`, `inmate_count`, `did_not_get_committed`, `note`, `created_at`, `updated_at`, `officer_start`, `officer_end`) VALUES
(5, 1, '2025-05-24', '10:22:00', '11:18:00', '11:31:00', '11:35:00', '10:38:00', '11:16:00', '10:42:00', '10:43:00', 1, 0, NULL, '2025-05-28 12:26:15', '2025-05-28 16:31:57', '10:24:00', '11:32:00'),
(7, 2, '2025-05-24', '12:00:00', '12:51:00', '13:34:00', '13:41:00', NULL, NULL, '12:20:00', '12:30:00', 10, 0, NULL, '2025-05-28 12:27:57', '2025-05-28 16:33:51', NULL, NULL),
(8, 1, '2025-05-24', '12:09:00', '12:34:00', '12:44:00', '12:47:00', '12:11:00', '12:21:00', '12:31:00', '12:33:00', 1, 0, 'Wait due to CSO drop off', '2025-05-28 12:28:40', '2025-05-28 15:29:38', NULL, NULL),
(9, 6, '2025-05-24', '12:15:00', '12:44:00', '12:51:00', '12:53:00', NULL, NULL, '12:30:00', '12:31:00', 1, 0, 'Wait due to CSO drop off', '2025-05-28 12:29:14', '2025-05-28 15:30:05', NULL, NULL),
(11, 1, '2025-05-24', '20:14:00', '20:56:00', '21:08:00', '21:13:00', '20:17:00', '20:49:00', '20:52:00', '20:55:00', 1, 0, NULL, '2025-05-28 12:31:15', '2025-05-28 15:35:48', NULL, NULL),
(13, 2, '2025-05-24', '12:00:00', '12:09:00', '12:14:00', '13:41:00', NULL, NULL, '12:06:00', '12:08:00', 1, 0, 'Intake 10-96 Officer brought the intake in by their self. Then got the rest of the load.', '2025-05-28 15:13:18', '2025-05-28 15:21:31', NULL, NULL),
(14, 5, '2025-05-25', '01:54:00', '02:23:00', '02:32:00', '02:43:00', NULL, NULL, '02:17:00', '02:22:00', 2, 0, 'Waited 23 mins for the nurse', '2025-05-28 19:24:19', '2025-05-28 19:24:19', '01:56:00', '02:38:00'),
(15, 5, '2025-05-25', '04:39:00', '05:09:00', '05:21:00', '05:25:00', NULL, NULL, '04:59:00', '05:02:00', 1, 0, 'Waited 20 mins for the nurse', '2025-05-28 19:26:16', '2025-05-28 19:26:16', '04:40:00', '05:21:00'),
(16, 4, '2025-05-25', '15:14:00', '15:34:00', '15:42:00', '15:49:00', '15:24:00', '15:32:00', '15:33:00', '15:34:00', 1, 0, NULL, '2025-05-28 19:28:26', '2025-05-28 19:28:26', '15:15:00', '15:43:00'),
(17, 5, '2025-05-25', '18:34:00', '18:57:00', '19:13:00', '19:17:00', NULL, NULL, '18:56:00', '18:57:00', 1, 0, 'Waited 22 mins for the nurse', '2025-05-28 19:29:27', '2025-05-28 19:31:08', '18:36:00', '19:15:00'),
(18, 1, '2025-05-25', '19:35:00', '20:37:00', '20:49:00', '20:50:00', '20:07:00', '20:33:00', '20:34:00', '20:37:00', 1, 0, NULL, '2025-05-28 19:33:15', '2025-05-28 19:33:15', '19:37:00', '20:49:00'),
(19, 1, '2025-05-25', '21:11:00', '22:36:00', '22:45:00', '22:45:00', '21:38:00', '22:23:00', '21:36:00', '21:37:00', 1, 0, NULL, '2025-05-28 19:35:10', '2025-05-28 19:35:10', '21:12:00', '22:46:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurisdiction_time_log_jurisdiction_id_foreign` (`jurisdiction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  ADD CONSTRAINT `jurisdiction_time_log_jurisdiction_id_foreign` FOREIGN KEY (`jurisdiction_id`) REFERENCES `jurisdictions` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
