-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2025 at 03:17 PM
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
-- Table structure for table `jurisdictions`
--

CREATE TABLE `jurisdictions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurisdictions`
--

INSERT INTO `jurisdictions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Prince George PD', '2025-05-27 11:30:06', '2025-05-27 11:30:06'),
(2, 'Chesterfield County', '2025-05-27 11:34:29', '2025-05-27 11:34:29'),
(3, 'Colonial Heights City', '2025-05-27 11:34:42', '2025-05-27 11:34:42'),
(4, 'Hopewell City', '2025-05-27 11:34:51', '2025-05-27 11:34:51'),
(5, 'Petersburg City', '2025-05-28 12:22:35', '2025-05-28 12:22:35'),
(6, 'Charles City County', '2025-05-28 12:22:55', '2025-05-28 12:22:55'),
(7, 'Surry County', '2025-05-28 12:23:07', '2025-05-28 12:23:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jurisdictions`
--
ALTER TABLE `jurisdictions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurisdictions_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurisdictions`
--
ALTER TABLE `jurisdictions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;