-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 08, 2025 at 07:30 PM
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
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1747665698),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1747665698;', 1747665698);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updated_at`) VALUES
(1, 'Housekeeping Supplies', NULL, NULL),
(2, 'Office Supplies', NULL, NULL),
(3, 'Printer Ink', NULL, NULL),
(4, 'Personal Care', NULL, NULL),
(5, 'Property', NULL, NULL),
(6, '1 For 1 Exchange', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ics`
--

CREATE TABLE `ics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `inmate_number` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `date_found` date NOT NULL,
  `charged_101` tinyint(1) NOT NULL,
  `filed_with_inmate_accounts` tinyint(1) NOT NULL,
  `charged_by_inmate_accounts` tinyint(1) NOT NULL,
  `payment_status` tinyint(1) NOT NULL,
  `notes` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT 0,
  `low_stock_threshold` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `category_id`, `category_name`, `description`, `image`, `quantity`, `low_stock_threshold`, `created_at`, `updated_at`) VALUES
(1, 'Broom Head (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/broomhead.jpg', 0, 0, NULL, '2025-05-14 18:12:02'),
(2, 'Center Pull TOWELS (ro)', 1, 'Housekeeping Supplies', NULL, 'item-images/center-pull-towels.jpg', 0, 0, NULL, '2025-05-14 18:12:58'),
(3, 'Deck Brush 10\" (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/deck-brush.jpg', 0, 0, NULL, '2025-05-14 18:43:16'),
(4, 'Dust Mop HEAD (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/dust-mop.jpg', 0, 0, NULL, '2025-05-14 18:44:15'),
(5, 'Mop Head f/SEALER (ea)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(6, 'Cloth Rag (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/cloth-rag.jpg', 0, 0, NULL, '2025-05-14 18:16:14'),
(7, 'Spray Bottle 1 QT (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/spray-bottle.jpg', 0, 0, NULL, '2025-05-19 12:52:54'),
(8, 'Spray Head f/BT (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/spray-bottle-head.jpg', 0, 0, NULL, '2025-05-19 12:54:51'),
(9, 'Trash Bags SM (ro)', 1, 'Housekeeping Supplies', NULL, 'item-images/small-trash-bags.jpg', 0, 0, NULL, '2025-05-19 13:40:28'),
(10, 'Trash Bags MED (bx)', 1, 'Housekeeping Supplies', NULL, 'item-images/small-trash-bags.jpg', 0, 0, NULL, '2025-05-19 13:40:08'),
(11, 'Trash Bags LG (bx)', 1, 'Housekeeping Supplies', NULL, 'item-images/small-trash-bags.jpg', 0, 0, NULL, '2025-05-19 13:39:49'),
(12, 'Plastic Bags f/RECYCLING (ro)', 1, 'Housekeeping Supplies', NULL, 'item-images/recycling-bags.jpg', 0, 0, NULL, '2025-05-19 12:33:24'),
(13, 'Buff Pad CHAMPAGINE (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/buff-pad-champaign.jpg', 0, 0, NULL, '2025-05-14 18:12:31'),
(14, 'Polishing Pad WHITE (ea)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(15, 'Strip Pad BLACK (ea)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(16, 'Clean Pad GREEN (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/green-scrub-pad.jpg', 0, 0, NULL, '2025-05-14 18:13:21'),
(17, 'Paper Towels MFLD (cs)', 1, 'Housekeeping Supplies', NULL, 'item-images/paper-towels-fld.jpg', 0, 0, NULL, '2025-05-16 15:12:02'),
(18, 'Toilet Paper (cs)', 1, 'Housekeeping Supplies', NULL, 'item-images/toilet-paper.jpg', 0, 0, NULL, '2025-05-19 13:38:17'),
(19, 'Vinyl, Gloves, PF,MED (cs)', 1, 'Housekeeping Supplies', NULL, 'item-images/vinyl-gloves.jpg', 0, 0, NULL, '2025-05-19 12:35:42'),
(20, 'Vinyl, Gloves, PF, XL (cs)', 1, 'Housekeeping Supplies', NULL, 'item-images/vinyl-gloves.jpg', 0, 0, NULL, '2025-05-19 12:35:58'),
(21, 'Gloves - Food Handling (pk)', 1, 'Housekeeping Supplies', NULL, 'item-images/food-handling-gloves.jpg', 0, 0, NULL, '2025-05-16 15:03:03'),
(22, 'Melt-a-way Laundry BAGS (ro)', 1, 'Housekeeping Supplies', NULL, 'item-images/melt-away-laundry-bags.jpg', 0, 0, NULL, '2025-05-14 18:54:13'),
(23, 'Green Antibact HAND SOAP (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/green-hand-soap.jpg', 0, 0, NULL, '2025-05-14 19:02:25'),
(24, 'Antibacterial Foam Hand Soap (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/antibacterial-foam-hand-soap.jpg', 0, 0, NULL, '2025-05-14 18:06:12'),
(25, 'Razor (bx)', 4, 'Personal Care', NULL, 'item-images/razor.jpg', 0, 0, NULL, '2025-05-16 15:10:19'),
(26, 'Solar Brite (5gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/solarbrite.jpg', 0, 0, NULL, '2025-05-19 12:40:19'),
(27, 'Sanitary Napkins (bx)', 4, 'Personal Care', NULL, 'item-images/sanitary-napkin.jpg', 0, 0, NULL, '2025-05-14 19:08:19'),
(28, 'So Fresh (5gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/so-fresh.jpg', 0, 0, NULL, '2025-05-19 12:37:27'),
(29, 'Stain Blaster (cs)', 1, 'Housekeeping Supplies', NULL, 'item-images/stain-blaster.jpg', 0, 0, NULL, '2025-05-19 12:55:28'),
(30, 'Grout Safe (gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/grout-safe.jpg', 0, 0, NULL, '2025-05-16 15:04:28'),
(31, 'Glass Cleaner (bt)', 1, 'Housekeeping Supplies', NULL, 'item-images/glass-cleaner.jpg', 0, 0, NULL, '2025-05-16 15:02:24'),
(32, 'Nabc1 (bt)', 1, 'Housekeeping Supplies', NULL, 'item-images/nabc1.jpg', 0, 0, NULL, '2025-05-16 15:10:00'),
(33, 'Tri Base (gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/tribase.jpg', 0, 0, NULL, '2025-05-19 13:40:39'),
(34, 'Pump Spray (gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/pump-spray.jpg', 0, 0, NULL, '2025-05-19 12:38:48'),
(35, 'Scum B GONE (bt)', 1, 'Housekeeping Supplies', NULL, 'item-images/scum-b-gone.jpg', 0, 0, NULL, '2025-05-16 15:09:45'),
(36, 'RRJ Leave REQUEST FORM (pk)', 2, 'Office Supplies', NULL, 'item-images/leave-slip.jpg', 0, 0, NULL, '2025-05-19 12:45:51'),
(37, 'Tablet Standard (ea)', 2, 'Office Supplies', NULL, 'item-images/tablet-standard.jpg', 0, 0, NULL, '2025-05-19 13:36:20'),
(38, 'Steno Note BOOK (ea)', 2, 'Office Supplies', NULL, 'item-images/steno.jpg', 0, 0, NULL, '2025-05-14 19:22:02'),
(39, 'Post It LARGE (pk)', 2, 'Office Supplies', NULL, 'item-images/post-it-notes.jpg', 0, 0, NULL, '2025-05-19 12:38:32'),
(40, 'Log Book 300PG (ea)', 2, 'Office Supplies', NULL, 'item-images/logbook.jpg', 0, 0, NULL, '2025-05-14 19:17:22'),
(41, 'Envelope Coin (bx)', 2, 'Office Supplies', NULL, 'item-images/coin-envelope.jpg', 0, 0, NULL, '2025-05-14 18:45:39'),
(42, 'Envelope Inter OFFICE (ea)', 2, 'Office Supplies', NULL, 'item-images/inter-officeen-evelope.jpg', 0, 0, NULL, '2025-05-14 18:45:50'),
(43, 'Envelope Window (bx)', 2, 'Office Supplies', NULL, 'item-images/windowed-envelope.jpg', 0, 0, NULL, '2025-05-14 19:01:59'),
(44, 'Envelope 9 X 12 (bx)', 2, 'Office Supplies', NULL, 'item-images/9x12-envelope.jpg', 0, 0, NULL, '2025-05-14 18:45:24'),
(45, 'Envelope 10x15 (bx)', 2, 'Office Supplies', NULL, 'item-images/10x15-envelope.jpg', 0, 0, NULL, '2025-05-14 18:45:13'),
(46, 'Envelope Std. WHITE (bx)', 2, 'Office Supplies', NULL, 'item-images/standard-white-envelope.jpg', 0, 0, NULL, '2025-05-14 19:00:46'),
(47, 'Clip Plastic MEDIUM (bx)', 2, 'Office Supplies', NULL, 'item-images/medium-paper-clips.jpg', 0, 0, NULL, '2025-05-14 18:39:15'),
(48, 'Clip Plastic LARGE (bx)', 2, 'Office Supplies', NULL, 'item-images/large-paper-clips.jpg', 0, 0, NULL, '2025-05-14 18:17:15'),
(49, 'Clip Plastic XTRA-LG(bx)', 2, 'Office Supplies', NULL, 'item-images/clips-plastic.jpg', 0, 0, NULL, '2025-05-14 18:15:54'),
(50, 'Pen Black (bx)', 2, 'Office Supplies', NULL, 'item-images/black-pen.jpg', 0, 0, NULL, '2025-05-19 12:31:29'),
(51, 'Pen Red (bx)', 2, 'Office Supplies', NULL, 'item-images/red-pen.jpg', 0, 0, NULL, '2025-05-19 12:31:46'),
(52, 'Pencils (pk)', 2, 'Office Supplies', NULL, 'item-images/pencils.jpg', 0, 0, NULL, '2025-05-19 12:32:05'),
(53, 'Markers Black (ea)', 2, 'Office Supplies', NULL, 'item-images/black-marker.jpg', 0, 0, NULL, '2025-05-16 15:08:11'),
(54, 'Highlighter Yellow (EA)', 2, 'Office Supplies', NULL, 'item-images/yellow-highlighter.jpg', 0, 0, NULL, '2025-05-14 19:20:28'),
(55, 'Dry Erase Marker (PK)', 2, 'Office Supplies', NULL, 'item-images/dry-erase-marker.jpg', 0, 0, NULL, '2025-05-14 18:43:38'),
(56, 'Dry Eraser (ea)', 2, 'Office Supplies', NULL, 'item-images/dry-erasor.jpg', 0, 0, NULL, '2025-05-14 18:43:56'),
(57, 'Pocket Portfolio (ea)', 2, 'Office Supplies', NULL, 'item-images/pocket-portfolio.jpg', 0, 0, NULL, '2025-05-19 12:36:20'),
(58, 'Laser Labels 1/3 CUT (pk)', 2, 'Office Supplies', NULL, 'item-images/laser-labels.jpg', 0, 0, NULL, '2025-05-14 19:14:48'),
(59, 'Laser Labels MAILING (pk)', 2, 'Office Supplies', NULL, 'item-images/laser-labels.jpg', 0, 0, NULL, '2025-05-14 19:15:01'),
(60, 'Laser Labels 1\" X 2 5/8\" (bx)', 2, 'Office Supplies', NULL, 'item-images/laser-labels.jpg', 0, 0, NULL, '2025-05-14 19:14:34'),
(61, 'File Folder STD (bx)', 2, 'Office Supplies', NULL, 'item-images/file-folder.jpg', 0, 0, NULL, '2025-05-14 19:12:54'),
(62, 'Battery AA CELL (ea)', 2, 'Office Supplies', NULL, 'item-images/aa-battery.jpg', 0, 0, NULL, '2025-05-14 18:06:26'),
(63, 'Battery AAA CELL (ea)', 2, 'Office Supplies', NULL, 'item-images/aaa-battery.jpg', 0, 0, NULL, '2025-05-14 18:06:35'),
(64, 'Battery C CELL (ea)', 2, 'Office Supplies', NULL, 'item-images/c-cell-battery.jpg', 0, 0, NULL, '2025-05-14 18:05:30'),
(65, 'Battery D CELL (ea)', 2, 'Office Supplies', NULL, 'item-images/d-cell-battery.jpg', 0, 0, NULL, '2025-05-14 18:06:48'),
(66, 'Battery 9 VOLT (ea)', 2, 'Office Supplies', NULL, 'item-images/9-volt-battery.jpg', 0, 0, NULL, '2025-05-14 18:05:41'),
(67, 'Stapler (ea) (staple-less)', 2, 'Office Supplies', NULL, 'item-images/stapler.jpg', 0, 0, NULL, '2025-05-19 13:33:45'),
(68, 'Tape Transparent (ro)', 2, 'Office Supplies', NULL, 'item-images/tape-roll.jpg', 0, 0, NULL, '2025-05-19 13:36:37'),
(69, 'Rubber Bands (pk)', 2, 'Office Supplies', NULL, 'item-images/rubber-bands.jpg', 0, 0, NULL, '2025-05-19 12:46:43'),
(70, 'Whiteout Pen (ea)', 2, 'Office Supplies', NULL, 'item-images/whiteout-pen.jpg', 0, 0, NULL, '2025-05-14 18:03:49'),
(71, 'Whiteout (bt)', 2, 'Office Supplies', NULL, 'item-images/whiteout.jpg', 0, 0, NULL, '2025-05-14 18:04:05'),
(72, 'TNG/Class Record FOLDER (bx) 13775', 2, 'Office Supplies', NULL, NULL, 0, 0, NULL, '2025-05-08 17:59:38'),
(74, 'Supervisor Record FOLDER (bx)', 2, 'Office Supplies', NULL, 'item-images/supervisor-folder.jpg', 0, 0, NULL, '2025-05-19 13:35:44'),
(75, 'Copy Paper 8.5x11 (cs)', 2, 'Office Supplies', NULL, 'item-images/paper.jpg', 0, 0, NULL, '2025-05-14 18:42:45'),
(76, 'Banker Box, LTR, lg (ea)', 2, 'Office Supplies', NULL, 'item-images/banker-box.jpg', 0, 0, NULL, '2025-05-14 18:05:01'),
(77, 'Banker Box, LEGAL (ea)', 2, 'Office Supplies', NULL, 'item-images/banker-box.jpg', 0, 0, NULL, '2025-05-14 18:04:51'),
(78, 'Banker Box, LTR, sm (ea)', 2, 'Office Supplies', NULL, 'item-images/banker-box.jpg', 0, 0, NULL, '2025-05-14 18:05:10'),
(79, 'Q5949x (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/49x.jpg', 0, 0, NULL, '2025-05-19 12:42:47'),
(80, 'Cb436a (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/36a.jpg', 0, 0, NULL, '2025-05-16 14:42:53'),
(81, 'Ce278a (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/78a.jpg', 0, 0, NULL, '2025-05-16 14:59:02'),
(82, 'Q7553x (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/53x.jpg', 0, 0, NULL, '2025-05-19 12:44:31'),
(83, 'Ce505x (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/05x.jpg', 0, 0, NULL, '2025-05-16 15:02:05'),
(84, '0 C4127x (ea) Ink Cartridges', 3, 'Printer Ink', NULL, 'item-images/27x.jpg', 0, 0, NULL, '2025-05-14 19:22:28'),
(85, 'Cc364a (ea)', 3, 'Printer Ink', NULL, 'item-images/64a.jpg', 0, 0, NULL, '2025-05-16 14:43:08'),
(86, 'C8061x (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/61x.jpg', 0, 0, NULL, '2025-05-14 19:22:17'),
(87, '600 (ea) Ink Cartridge', 3, 'Printer Ink', NULL, 'item-images/epson-600-ink.jpg', 0, 0, NULL, '2025-05-16 15:01:00'),
(88, 'D130 (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, NULL, 0, 0, NULL, '2025-05-08 17:52:14'),
(89, 'Brother 350 (ea) Ink Cartridge', 3, 'Printer Ink', NULL, 'item-images/brother-tn-350.jpg', 0, 0, NULL, '2025-05-14 18:12:19'),
(90, '98x (ea) Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/98x.jpg', 0, 0, NULL, '2025-05-14 19:25:55'),
(91, 'Cf280a (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, NULL, 0, 0, NULL, '2025-05-08 17:52:02'),
(92, '92a (ea) Ink Cartridge', 3, 'Printer Ink', NULL, 'item-images/92a.jpg', 0, 0, NULL, '2025-05-14 19:25:43'),
(93, 'C7115x (ea) Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/15x-c7115x.jpg', 0, 0, NULL, '2025-05-14 19:26:53'),
(94, 'Q2613 (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/13a.jpg', 0, 0, NULL, '2025-05-19 12:41:36'),
(95, 'Straw Broom (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/strawbroom.jpg', 0, 0, NULL, '2025-05-19 13:34:05'),
(96, 'Sealer Way (gl)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(97, 'Stripper (gl)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(98, 'Bleach', 1, 'Housekeeping Supplies', NULL, 'item-images/bleach.jpg', 0, 0, NULL, '2025-05-14 18:07:09'),
(99, 'H2 Orange (gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/h2-orange.jpg', 0, 0, NULL, '2025-05-14 19:15:14'),
(100, 'Green Jumpers Med', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:11:47'),
(101, 'Green Jumpers LG', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:12:00'),
(102, 'Green Jumpers XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:11:35'),
(103, 'Green Jumpers 2XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:10:42'),
(104, 'Green Jumpers 3XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:10:52'),
(105, 'Green Jumpers 4XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:11:02'),
(106, 'Green Jumpers 5XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:11:14'),
(107, 'Green Jumpers 6XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:11:24'),
(108, 'Green Jumpers 7XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:12:29'),
(109, 'Green Jumpers 8XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:12:20'),
(110, 'Green Jumpers 9XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:12:09'),
(111, 'Green Jumpers 10XL', 5, 'Property', NULL, 'item-images/green-jump-suit.jpg', 0, 0, NULL, '2025-05-14 19:10:26'),
(112, 'Gym Shorts SM', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:14:02'),
(113, 'Gym Shorts MED', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:13:53'),
(114, 'Gym Shorts LG', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:13:45'),
(115, 'Gym Shorts XL', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:14:10'),
(116, 'Gym Shorts 2XL', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:13:17'),
(117, 'Gym Shorts 3XL', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:13:24'),
(118, 'Gym Shorts 4XL', 5, 'Property', NULL, 'item-images/gym-shorts.jpg', 0, 0, NULL, '2025-05-14 19:13:35'),
(119, 'Female Briefs SM/5', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:09:51'),
(120, 'Female Briefs MED/6', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:09:39'),
(121, 'Female Briefs LG/7', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:08:50'),
(122, 'Female Briefs XL/8', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:09:28'),
(123, 'Female Briefs 2XL/9', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:06:00'),
(124, 'Female Briefs 3XL/10', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:06:20'),
(125, 'Female Briefs 4XL/11', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:06:49'),
(126, 'Female Briefs 5XL/12', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:07:01'),
(127, 'Female Briefs 6XL/13', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:07:44'),
(128, 'Female Briefs 7XL/14', 5, 'Property', NULL, 'item-images/womens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:08:39'),
(129, 'Bra Size 32', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:07:20'),
(130, 'Bra Size 34', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:07:38'),
(131, 'Bra Size 36', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:07:48'),
(132, 'Bra Size 38', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:07:59'),
(133, 'Bra Size 40', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:08:12'),
(134, 'Bra Size 42', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:08:24'),
(135, 'Bra Size 44', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:08:35'),
(136, 'Bra Size 46', 5, 'Property', NULL, 'item-images/bra.jpg', 0, 0, NULL, '2025-05-14 18:08:48'),
(137, 'Mens Briefs SM', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:40'),
(138, 'Mens Briefs MED', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:32'),
(139, 'Mens Briefs LG', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:23'),
(140, 'Mens Briefs XL', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:47'),
(141, 'Mens Briefs 2XL', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:20:57'),
(142, 'Mens Briefs 3XL', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:05'),
(143, 'Mens Briefs 4XL', 5, 'Property', NULL, 'item-images/mens-briefs.jpg', 0, 0, NULL, '2025-05-14 19:21:13'),
(144, 'T-Shirts Sm', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:52:45'),
(145, 'T-Shirts Med', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:52:55'),
(146, 'T-Shirts Lg', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:08'),
(147, 'T-Shirts Xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:52:33'),
(148, 'T-Shirts 2xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:51:54'),
(149, 'T-Shirts 3xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:52:04'),
(150, 'T-Shirts 4xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:52:16'),
(151, 'T-Shirts 5xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:28'),
(152, 'T-Shirts 6xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:58'),
(153, 'T-Shirts 7xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:47'),
(154, 'T-Shirts 8xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:37'),
(155, 'T-Shirts 9xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:53:18'),
(156, 'T-Shirts 10xl', 5, 'Property', NULL, 'item-images/t-shits.jpg', 0, 0, NULL, '2025-05-14 18:51:42'),
(157, 'Sheets', 5, 'Property', NULL, 'item-images/sheets.jpg', 0, 0, NULL, '2025-05-19 13:33:18'),
(158, 'Blankets', 5, 'Property', NULL, 'item-images/blankets.jpg', 0, 0, NULL, '2025-05-14 18:06:59'),
(159, 'Gray Blankets', 5, 'Property', NULL, 'item-images/blankets.jpg', 0, 0, NULL, '2025-05-14 19:05:17'),
(160, 'Wash Clothes', 5, 'Property', NULL, 'item-images/cloth-rag.jpg', 0, 0, NULL, '2025-05-14 18:04:31'),
(161, 'Towels', 5, 'Property', NULL, 'item-images/towels.jpg', 0, 0, NULL, '2025-05-19 13:38:32'),
(162, 'Cups', 5, 'Property', NULL, 'item-images/cups.jpg', 0, 0, NULL, '2025-05-14 18:43:01'),
(163, 'Spoons', 5, 'Property', NULL, 'item-images/spoon.jpg', 0, 0, NULL, '2025-05-19 12:52:14'),
(164, 'Shoes Size 5', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:56:14'),
(165, 'Shoes Size 6', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:56:24'),
(166, 'Shoes Size 7', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:56:33'),
(167, 'Shoes Size 8', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:56:42'),
(168, 'Shoes Size 9', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:02'),
(169, 'Shoes Size 10', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:54:36'),
(170, 'Shoes Size 11', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:10'),
(171, 'Shoes Size 12', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:19'),
(172, 'Shoes Size 13', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:30'),
(173, 'Shoes Size 14', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:42'),
(174, 'Shoes Size 15', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:55:55'),
(175, 'Shoes Size 16', 5, 'Property', NULL, 'item-images/shoes.jpg', 0, 0, NULL, '2025-05-14 18:56:04'),
(176, 'Shower Shoes SM/5&6', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:57:31'),
(177, 'Shower Shoes MED/7&8', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:57:24'),
(178, 'Shower Shoes LG/9&10', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:57:16'),
(179, 'Shower Shoes XL/11&12', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:54:53'),
(180, 'Shower Shoes 2XL/13&14', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:57:00'),
(181, 'Shower Shoes 3XL/15&16', 5, 'Property', NULL, 'item-images/shower-shoes.jpg', 0, 0, NULL, '2025-05-14 18:57:08'),
(182, 'Inmate Request Forms', 2, 'Office Supplies', NULL, NULL, 0, 0, NULL, NULL),
(183, 'Nitrile Gloves', 1, 'Housekeeping Supplies', NULL, 'item-images/nitrile-gloves.jpg', 0, 0, NULL, '2025-05-19 12:38:14'),
(184, 'Socks', 5, 'Property', NULL, 'item-images/socks.jpg', 0, 0, NULL, '2025-05-19 12:51:57'),
(185, '55a, (ea) Ink cartridge', 3, 'Printer Ink', NULL, 'item-images/55a.jpg', 0, 0, NULL, '2025-05-14 19:23:11'),
(186, 'Broom Handle (ea)', 6, '1 for 1 Exchange', NULL, 'item-images/broom-handle.jpg', 0, 0, NULL, '2025-05-14 18:11:46'),
(187, '58a (ea) Ink cartridge', 3, 'Printer Ink', NULL, 'item-images/58a.jpg', 0, 0, NULL, '2025-05-14 19:23:51'),
(188, 'Laundry Destainer (bleach)', 1, 'Housekeeping Supplies', NULL, NULL, 0, 0, NULL, NULL),
(189, '83a (ea) Ink cartridge', 3, 'Printer Ink', NULL, 'item-images/83a.jpg', 0, 0, NULL, '2025-05-14 19:25:33'),
(190, 'Laundry Bags', 5, 'Property', NULL, 'item-images/laundry-mesh-bag.jpg', 0, 0, NULL, '2025-05-14 19:16:42'),
(191, 'Mop Handle', 6, '1 for 1 Exchange', NULL, 'item-images/mop-handle.jpg', 0, 0, NULL, '2025-05-16 15:09:30'),
(192, 'Scrub Brush (ea)', 6, '1 for 1 Exchange', NULL, 'item-images/scrub-brush.jpg', 0, 0, NULL, '2025-05-19 12:47:59'),
(193, 'Inmate Bar Soap', 1, 'Housekeeping Supplies', NULL, 'item-images/inmate-bar-soap.jpg', 0, 0, NULL, '2025-05-14 19:03:26'),
(194, 'Dust Pan (ea)', 6, '1 for 1 Exchange', NULL, 'item-images/dust-pan.jpg', 0, 0, NULL, '2025-05-14 18:58:47'),
(195, 'Toilet Brush (ea)', 6, '1 for 1 Exchange', NULL, 'item-images/toilet-brush.jpg', 0, 0, NULL, '2025-05-19 13:38:03'),
(196, 'Spray Buff (gl)', 1, 'Housekeeping Supplies', NULL, 'item-images/spray-buff.jpg', 0, 0, NULL, '2025-05-19 12:54:32'),
(197, 'Receipt Book (ea)', 2, 'Office Supplies', NULL, NULL, 0, 0, NULL, NULL),
(198, 'Personnel Record File Folders (bx) 14075', 2, 'Office Supplies', NULL, 'item-images/personnel-folder.jpg', 0, 0, NULL, '2025-05-19 12:32:39'),
(199, 'Supervisor File (bx) 14076', 2, 'Office Supplies', NULL, NULL, 0, 0, NULL, NULL),
(200, 'Inmate Flex Pen (ea)', 2, 'Office Supplies', NULL, 'item-images/inmate-flex-pen.jpg', 0, 0, NULL, '2025-05-14 19:04:27'),
(201, 'Mop Bucket (ea)', 1, 'Housekeeping Supplies', NULL, 'item-images/mop-bucket.jpg', 0, 0, NULL, '2025-05-19 12:30:36'),
(202, 'Hp148a/ Hp148x, (ea)  Ink Cartridge ', 3, 'Printer Ink', NULL, 'item-images/148a-148x.jpg', 0, 0, NULL, '2025-05-16 15:05:44'),
(203, 'Ce30a  Ink Cartridge ', 3, 'Printer Ink', NULL, NULL, 0, 0, NULL, '2025-05-08 17:51:32'),
(204, 'Bra Size 48', 5, NULL, NULL, 'item-images/bra.jpg', 120, 120, '2025-05-08 17:47:44', '2025-05-14 18:08:57'),
(205, 'Bra Size 50', 5, NULL, NULL, 'item-images/bra.jpg', 120, 120, '2025-05-08 17:48:04', '2025-05-14 18:09:08'),
(206, 'Bra Size 52', 5, NULL, NULL, 'item-images/bra.jpg', 120, 120, '2025-05-08 17:48:21', '2025-05-14 18:09:18'),
(207, 'Bra Size 54', 5, NULL, NULL, 'item-images/bra.jpg', 120, 120, '2025-05-08 17:48:43', '2025-05-14 18:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(19, 1, '2025-05-25', '21:11:00', '22:36:00', '22:45:00', '22:45:00', '21:38:00', '22:23:00', '21:36:00', '21:37:00', 1, 0, NULL, '2025-05-28 19:35:10', '2025-05-28 19:35:10', '21:12:00', '22:46:00'),
(20, 5, '2025-05-28', '05:19:00', '06:06:00', '06:17:00', '06:21:00', '05:34:00', '05:42:00', '06:01:00', '06:06:00', 1, 0, 'Waited 19 mins for the nurse', '2025-05-30 13:55:49', '2025-05-30 14:41:22', '05:23:00', '06:17:00'),
(21, 5, '2025-05-28', '12:56:00', '13:30:00', '13:37:00', '13:42:00', '13:19:00', '13:27:00', '13:13:00', '13:15:00', 1, 0, NULL, '2025-05-30 14:29:31', '2025-05-30 14:29:31', '13:02:00', '13:38:00'),
(22, 5, '2025-05-28', '18:53:00', '19:35:00', '19:40:00', '19:45:00', '18:57:00', '19:22:00', '19:31:00', '19:34:00', 1, 0, NULL, '2025-05-30 14:39:32', '2025-05-30 14:39:32', '18:56:00', '19:41:00'),
(23, 4, '2025-05-28', '20:08:00', '20:52:00', '21:02:00', '21:05:00', '20:29:00', '20:35:00', '20:49:00', '20:52:00', 1, 0, 'Waited 14 mins for the nurse', '2025-05-30 14:47:52', '2025-05-30 14:50:04', '20:10:00', '21:03:00'),
(24, 1, '2025-05-28', '23:23:00', '23:58:00', '00:11:00', '00:16:00', '23:33:00', '23:56:00', '23:55:00', '23:57:00', 1, 0, NULL, '2025-05-30 14:56:08', '2025-05-30 14:56:08', '23:17:00', '00:12:00'),
(25, 5, '2025-05-29', '01:32:00', '02:26:00', '02:38:00', '02:44:00', '01:50:00', '02:05:00', '02:23:00', '02:26:00', 1, 0, 'Waited 18 mins for the nurse', '2025-06-02 12:31:56', '2025-06-02 13:38:39', '01:34:00', '02:38:00'),
(26, 4, '2025-05-29', '04:26:00', NULL, NULL, '05:19:00', '04:36:00', '05:15:00', NULL, NULL, 1, 1, NULL, '2025-06-02 12:32:35', '2025-06-02 13:21:24', '04:28:00', '05:17:00'),
(27, 5, '2025-05-29', '04:57:00', '06:06:00', '06:17:00', '06:20:00', '05:15:00', '06:00:00', '06:04:00', '06:05:00', 1, 0, '', '2025-06-02 12:33:14', '2025-06-02 13:38:07', '04:57:00', '06:18:00'),
(28, 5, '2025-05-29', '11:59:00', '12:35:00', '12:40:00', '12:45:00', NULL, NULL, '12:09:00', '12:11:00', 6, 0, 'Wait due to other LEO\'s', '2025-06-02 12:33:55', '2025-06-02 14:49:17', '12:01:00', '12:41:00'),
(29, 2, '2025-05-29', '13:07:00', '13:30:00', '14:06:00', '14:11:00', NULL, NULL, '13:14:00', '13:30:00', 9, 0, NULL, '2025-06-02 12:35:00', '2025-06-02 14:04:22', '13:08:00', '14:07:00'),
(30, 5, '2025-05-29', '14:50:00', '15:29:00', '15:41:00', '15:47:00', NULL, NULL, '15:26:00', '15:29:00', 1, 0, 'Waited 36 mins for the nurse', '2025-06-02 12:35:42', '2025-06-02 14:50:52', '14:52:00', '15:42:00'),
(31, 5, '2025-05-29', '17:39:00', '18:18:00', '18:28:00', '18:32:00', '17:46:00', '18:00:00', '18:04:00', '18:07:00', 1, 0, NULL, '2025-06-02 12:36:20', '2025-06-02 14:26:40', '17:41:00', '18:29:00'),
(32, 5, '2025-05-29', '18:01:00', '18:29:00', '18:36:00', '18:43:00', NULL, NULL, '18:07:00', '18:09:00', 1, 0, NULL, '2025-06-02 12:36:47', '2025-06-02 14:42:58', '18:03:00', '18:37:00'),
(33, 3, '2025-05-29', '18:37:00', '19:00:00', '19:13:00', '19:16:00', NULL, NULL, '18:50:00', '18:56:00', 1, 0, NULL, '2025-06-02 12:37:14', '2025-06-02 14:37:25', '18:40:00', '19:13:00'),
(34, 4, '2025-05-30', '01:15:00', '02:51:00', '02:58:00', '03:01:00', '01:33:00', '02:10:00', '02:44:00', '02:51:00', 1, 0, 'Waited 34 mins for the nurse', '2025-06-02 12:37:54', '2025-06-02 15:05:35', '01:16:00', '02:59:00'),
(35, 1, '2025-05-30', '01:47:00', NULL, NULL, '03:01:00', '02:10:00', '02:56:00', NULL, NULL, 1, 1, NULL, '2025-06-02 12:38:34', '2025-06-02 15:08:51', '01:49:00', '02:56:00'),
(36, 5, '2025-05-30', '06:51:00', '07:07:00', '07:26:00', '07:30:00', NULL, NULL, '06:59:00', '07:03:00', 1, 0, NULL, '2025-06-02 12:39:10', '2025-06-02 15:12:41', '06:53:00', '07:27:00'),
(37, 1, '2025-05-30', '09:05:00', '09:52:00', '09:58:00', '10:03:00', '09:15:00', '09:46:00', '09:50:00', '09:52:00', 1, 0, NULL, '2025-06-02 12:39:36', '2025-06-02 18:19:16', '09:05:00', '09:59:00'),
(38, 3, '2025-05-30', '15:50:00', '16:18:00', '16:24:00', '16:27:00', NULL, NULL, '16:14:00', '16:16:00', 1, 0, NULL, '2025-06-02 12:42:14', '2025-06-02 18:28:47', '15:58:00', '16:24:00'),
(39, 7, '2025-05-30', '12:04:00', '12:25:00', '12:30:00', '12:35:00', NULL, NULL, '12:20:00', '12:25:00', 1, 0, 'Waited 16 mins for the nurse', '2025-06-02 12:43:38', '2025-06-02 18:29:09', '12:06:00', '12:32:00'),
(40, 1, '2025-06-01', '00:03:00', '00:44:00', '00:52:00', '00:54:00', '00:13:00', '00:43:00', '00:39:00', '00:41:00', 1, 0, NULL, '2025-06-02 12:44:44', '2025-06-02 18:48:16', '00:05:00', '00:53:00'),
(41, 1, '2025-06-01', '11:59:00', '12:43:00', '12:48:00', '12:53:00', '12:22:00', '12:40:00', '12:40:00', '12:42:00', 1, 0, NULL, '2025-06-02 12:45:16', '2025-06-02 18:52:05', '12:11:00', '12:48:00'),
(42, 2, '2025-05-31', '11:21:00', '12:01:00', '12:42:00', '12:46:00', NULL, NULL, '11:27:00', '11:39:00', 8, 0, NULL, '2025-06-02 12:47:47', '2025-06-02 18:32:34', '11:24:00', '12:43:00'),
(43, 5, '2025-05-31', '15:05:00', '15:33:00', '15:40:00', '15:44:00', NULL, NULL, '15:31:00', '15:33:00', 1, 0, NULL, '2025-06-02 12:48:15', '2025-06-02 18:34:39', '15:07:00', '15:41:00'),
(44, 2, '2025-05-31', '15:31:00', '16:16:00', '16:53:00', '16:58:00', NULL, NULL, '15:36:00', '15:46:00', 9, 0, NULL, '2025-06-02 12:48:43', '2025-06-02 18:38:45', '15:33:00', '16:54:00'),
(45, 1, '2025-06-02', '12:09:00', '12:52:00', '12:57:00', '13:00:00', '12:10:00', '12:25:00', '12:41:00', '12:46:00', 1, 0, 'Waited 16 mins for the nurse', '2025-06-03 10:38:26', '2025-06-03 11:21:21', '12:09:00', '12:58:00'),
(46, 5, '2025-06-02', '15:57:00', '16:33:00', '16:43:00', '16:46:00', NULL, NULL, '16:11:00', '16:13:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-03 10:39:02', '2025-06-03 11:31:11', '15:58:00', '16:43:00'),
(47, 1, '2025-06-02', '16:39:00', NULL, NULL, '17:18:00', '16:43:00', '17:14:00', NULL, NULL, 1, 1, NULL, '2025-06-03 10:39:38', '2025-06-03 11:39:12', '16:40:00', '17:15:00'),
(48, 5, '2025-06-02', '17:19:00', '17:46:00', '17:54:00', '17:59:00', NULL, NULL, '17:36:00', '17:40:00', 1, 0, 'Waited 17 mins for the nurse', '2025-06-03 10:40:21', '2025-06-03 11:50:54', '17:20:00', '17:55:00'),
(49, 5, '2025-06-02', '17:57:00', '18:56:00', '19:07:00', '19:11:00', NULL, NULL, '18:04:00', '18:07:00', 1, 0, 'Waited 52 mins for booking staff after the nurse', '2025-06-03 10:40:53', '2025-06-04 17:45:46', '17:59:00', '19:08:00'),
(50, 1, '2025-06-02', '18:39:00', '19:33:00', '19:47:00', '20:00:00', '18:41:00', '21:27:00', '18:54:00', '18:56:00', 1, 0, 'Officer on his laptop in the law enforcement waiting area.', '2025-06-03 10:41:30', '2025-06-04 17:51:07', '18:40:00', '19:56:00'),
(51, 4, '2025-06-02', '20:04:00', '21:12:00', '21:20:00', '21:23:00', '20:27:00', '20:51:00', '21:10:00', '21:12:00', 1, 0, 'Waited 19 mins for the nurse', '2025-06-03 10:42:08', '2025-06-04 17:56:19', '20:09:00', '21:21:00'),
(52, 3, '2025-06-02', '22:48:00', '23:12:00', '23:24:00', '23:27:00', NULL, NULL, '23:10:00', '23:11:00', 1, 0, NULL, '2025-06-03 10:42:40', '2025-06-04 17:59:56', '22:49:00', '23:24:00'),
(53, 5, '2025-06-03', '03:36:00', '04:49:00', '05:09:00', '05:16:00', NULL, NULL, '04:45:00', '04:49:00', 1, 0, 'Waited 1 hr 9 mins for the nurse', '2025-06-04 18:06:20', '2025-06-04 18:15:29', '03:49:00', '05:10:00'),
(54, 5, '2025-06-03', '10:30:00', '11:11:00', '11:15:00', '11:19:00', '10:33:00', '10:56:00', '11:02:00', '11:11:00', 1, 0, NULL, '2025-06-04 18:06:49', '2025-06-04 18:20:15', '10:31:00', '11:16:00'),
(55, 2, '2025-06-03', '11:57:00', '12:30:00', '13:10:00', '13:28:00', NULL, NULL, '12:07:00', '12:24:00', 10, 0, 'Dropped off 10 new intakes and picked up 2 inmates', '2025-06-04 18:07:24', '2025-06-05 10:44:34', '12:00:00', '13:23:00'),
(56, 4, '2025-06-03', '13:32:00', '14:27:00', '14:33:00', '14:37:00', '13:47:00', '14:09:00', '13:41:00', '13:44:00', 1, 0, '18 min wait due to court returns transportation staff helped bring in the intake', '2025-06-04 18:07:56', '2025-06-05 10:55:55', '13:33:00', '14:35:00'),
(57, 2, '2025-06-03', '14:49:00', '15:18:00', '15:22:00', '15:27:00', NULL, NULL, '15:12:00', '15:17:00', 1, 0, 'Waited 23 mins for the nurse', '2025-06-04 18:08:24', '2025-06-05 10:59:40', '14:52:00', '15:23:00'),
(58, 3, '2025-06-03', '23:06:00', '23:27:00', '23:40:00', '23:44:00', NULL, NULL, '23:24:00', '23:26:00', 1, 0, NULL, '2025-06-04 18:08:57', '2025-06-05 11:03:47', '23:08:00', '23:41:00'),
(59, 1, '2025-06-03', '23:24:00', '00:10:00', '00:28:00', '00:31:00', NULL, NULL, '23:30:00', '23:33:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-04 18:09:26', '2025-06-05 11:09:15', '23:26:00', '00:29:00'),
(60, 5, '2025-06-04', '00:42:00', '01:59:00', '02:14:00', '01:28:00', '01:02:00', '01:41:00', '01:57:00', '01:58:00', 1, 0, NULL, '2025-06-05 15:17:24', '2025-06-06 13:32:18', '00:49:00', '02:15:00'),
(61, 4, '2025-06-04', '05:43:00', '06:40:00', '06:53:00', '06:56:00', '05:51:00', '06:28:00', '06:38:00', '06:40:00', 1, 0, NULL, '2025-06-05 15:17:56', '2025-06-06 13:52:18', '05:47:00', '06:54:00'),
(62, 1, '2025-06-04', '06:43:00', '07:05:00', '07:28:00', '07:40:00', NULL, NULL, '07:04:00', '07:05:00', 1, 0, 'Waited 19 mins for the nurse. Intake assaulted booking officer Lands after restraints were removed.', '2025-06-05 15:18:27', '2025-06-06 14:23:04', '06:45:00', '07:30:00'),
(63, 4, '2025-06-04', '13:11:00', '14:23:00', '14:28:00', '14:33:00', '13:21:00', '13:39:00', '14:11:00', '14:12:00', 1, 0, 'Waited 32 mins for the nurse', '2025-06-05 15:18:54', '2025-06-06 14:45:21', '13:12:00', '14:28:00'),
(64, 4, '2025-06-05', '02:08:00', '03:12:00', '03:17:00', '03:18:00', '02:19:00', '03:05:00', '03:11:00', '03:12:00', 1, 0, NULL, '2025-06-09 12:14:30', '2025-06-09 12:54:13', '02:10:00', '03:17:00'),
(65, 1, '2025-06-05', '10:18:00', '11:26:00', '11:36:00', '11:43:00', '10:54:00', '11:24:00', '10:22:00', '10:27:00', 1, 0, 'Combative', '2025-06-09 12:15:09', '2025-06-09 18:55:45', '10:22:00', '11:37:00'),
(66, 2, '2025-06-05', '11:19:00', '12:17:00', '12:52:00', '13:49:00', NULL, NULL, '11:33:00', '11:47:00', 10, 0, 'Wait due to other LEO\'s', '2025-06-09 12:15:39', '2025-06-09 13:22:47', '11:21:00', '12:54:00'),
(67, 5, '2025-06-05', '12:40:00', '13:10:00', '13:42:00', '13:47:00', NULL, NULL, '12:57:00', '12:57:00', 8, 0, '7 Court returns and 1 intake waited due to other LEO\'s', '2025-06-09 12:16:11', '2025-06-09 13:41:56', '12:49:00', '13:43:00'),
(68, 1, '2025-06-05', '13:51:00', '14:38:00', '14:51:00', '15:02:00', '14:04:00', '14:20:00', '14:25:00', '14:28:00', 2, 0, 'Wait due to Other LEO\'s', '2025-06-09 12:16:44', '2025-06-11 11:27:03', '13:52:00', '14:53:00'),
(69, 1, '2025-06-05', '13:56:00', '14:53:00', '14:58:00', '15:02:00', '14:21:00', '14:30:00', '14:29:00', '14:31:00', 1, 0, 'Wait due to other LEO\'S', '2025-06-09 12:17:14', '2025-06-09 14:01:27', '13:58:00', '14:59:00'),
(70, 5, '2025-06-05', '15:11:00', '15:52:00', '15:59:00', '16:03:00', NULL, NULL, '15:49:00', '15:52:00', 1, 0, 'Waited 38 mins for the nurse', '2025-06-09 12:17:38', '2025-06-11 11:45:03', '15:16:00', '16:00:00'),
(71, 6, '2025-06-05', '19:17:00', '20:21:00', '20:27:00', '20:30:00', NULL, NULL, NULL, NULL, 1, 0, 'Did not enter the Law enforcement waiting area till 08:17pm only inside for 10 mins ', '2025-06-09 12:18:08', '2025-06-11 11:43:02', '20:19:00', '20:27:00'),
(72, 1, '2025-06-06', '02:33:00', '03:37:00', '03:43:00', '03:14:00', '02:55:00', '03:32:00', '03:35:00', '03:36:00', 1, 0, NULL, '2025-06-11 13:42:24', '2025-06-11 17:59:06', '02:39:00', '03:44:00'),
(73, 5, '2025-06-06', '05:38:00', '06:12:00', '06:21:00', '06:24:00', NULL, NULL, '06:08:00', '06:12:00', 1, 0, 'Waited 30 mins for the nurse', '2025-06-11 13:43:13', '2025-06-11 18:02:58', '05:42:00', '06:21:00'),
(74, 5, '2025-06-06', '08:27:00', '08:56:00', '09:03:00', '09:06:00', NULL, NULL, '08:40:00', '08:43:00', 1, 0, 'Waited 13 mins for the nurse and 13 mins for booking staff ', '2025-06-11 13:43:49', '2025-06-11 18:07:17', '08:30:00', '09:04:00'),
(75, 3, '2025-06-06', '09:03:00', '09:29:00', '09:36:00', '09:41:00', NULL, NULL, '09:25:00', '09:29:00', 1, 0, 'Waited 22 mins for the nurse', '2025-06-11 13:44:22', '2025-06-11 18:10:41', '09:05:00', '09:37:00'),
(76, 5, '2025-06-06', '14:54:00', '15:34:00', '15:51:00', '15:57:00', '15:07:00', '15:30:00', '15:00:00', '15:02:00', 1, 0, NULL, '2025-06-11 13:45:00', '2025-06-11 18:15:24', '14:56:00', '15:51:00'),
(77, 3, '2025-06-06', '17:18:00', '17:45:00', '17:54:00', '17:57:00', NULL, NULL, '17:28:00', '17:34:00', 1, 0, 'Waited 17 mins for booking staff ', '2025-06-11 13:46:04', '2025-06-11 18:32:37', '17:21:00', '17:54:00'),
(78, 3, '2025-06-06', '18:36:00', '19:15:00', '19:22:00', '19:26:00', NULL, NULL, '19:13:00', '19:15:00', 1, 0, 'Waited 39 mins for the nurse', '2025-06-11 13:46:37', '2025-06-11 18:39:09', '18:38:00', '19:22:00'),
(79, 5, '2025-06-07', '02:20:00', '04:07:00', '04:26:00', '04:28:00', NULL, NULL, '03:54:00', '04:06:00', 1, 0, 'Waited 1 hr 34 mins for the nurse', '2025-06-11 13:48:02', '2025-06-11 19:14:31', '02:24:00', '04:27:00'),
(80, 2, '2025-06-07', '11:34:00', '13:05:00', '13:32:00', '13:37:00', NULL, NULL, '11:45:00', '12:02:00', 12, 0, 'Wait due to booking staff searching intakes property', '2025-06-11 13:48:26', '2025-06-12 11:10:36', '11:36:00', '01:33:00'),
(81, 3, '2025-06-07', '18:23:00', '18:51:00', '19:01:00', '19:03:00', '18:29:00', '18:49:00', '18:32:00', '18:33:00', 1, 0, NULL, '2025-06-11 14:25:18', '2025-06-12 10:21:15', '18:26:00', '19:02:00'),
(82, 3, '2025-06-07', '20:21:00', '20:39:00', '20:49:00', '21:00:00', NULL, NULL, '20:37:00', '20:39:00', 1, 0, 'Officer went into booking after intake was cleared.', '2025-06-11 18:50:30', '2025-06-12 10:27:45', '20:23:00', '20:58:00'),
(83, 4, '2025-06-07', '21:38:00', '22:38:00', '22:48:00', '22:50:00', '21:48:00', '22:25:00', '22:33:00', '22:34:00', 1, 0, NULL, '2025-06-11 18:51:08', '2025-06-12 10:39:47', '21:40:00', '22:49:00'),
(84, 1, '2025-06-07', '22:18:00', '22:50:00', '23:07:00', '23:11:00', NULL, NULL, '22:35:00', '22:37:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 18:51:43', '2025-06-12 11:06:54', '22:22:00', '23:08:00'),
(85, 5, '2025-06-07', '23:02:00', '23:41:00', '23:56:00', '23:57:00', NULL, NULL, '23:35:00', '23:37:00', 1, 0, 'Waited 33 mins for the nurse', '2025-06-11 18:53:27', '2025-06-12 10:50:56', '23:04:00', '23:56:00'),
(86, 4, '2025-06-07', '23:26:00', '00:00:00', '00:18:00', '00:22:00', '23:30:00', '23:46:00', '23:39:00', '23:40:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 18:53:58', '2025-06-12 11:03:13', '23:30:00', '00:18:00'),
(87, 3, '2025-06-08', '00:04:00', '01:05:00', '01:25:00', '01:27:00', '00:17:00', '00:56:00', '00:37:00', '00:39:00', 1, 0, NULL, '2025-06-11 18:54:51', '2025-06-12 11:24:50', '00:07:00', '01:25:00'),
(88, 1, '2025-06-08', '02:47:00', '03:10:00', '03:27:00', '03:30:00', NULL, NULL, '03:08:00', '03:10:00', 1, 0, 'Waited 21 mins for the nurse', '2025-06-11 18:55:28', '2025-06-12 11:32:56', '02:50:00', '03:27:00'),
(89, 1, '2025-06-08', '04:29:00', '05:02:00', '05:16:00', '05:18:00', NULL, NULL, '04:58:00', '05:00:00', 1, 0, 'Waited 29 mins for the nurse', '2025-06-11 18:55:57', '2025-06-12 11:35:08', '04:32:00', '05:17:00'),
(90, 5, '2025-06-08', '04:33:00', '05:17:00', '05:28:00', '05:30:00', NULL, NULL, '05:00:00', '05:02:00', 1, 0, 'Waited 27 mins for the nurse', '2025-06-11 18:56:24', '2025-06-12 11:37:20', '04:37:00', '05:29:00'),
(91, 3, '2025-06-08', '05:47:00', '06:32:00', '06:44:00', '06:46:00', NULL, NULL, '06:31:00', '06:32:00', 1, 0, 'Waited 44 mins for the nurse', '2025-06-11 18:57:13', '2025-06-12 11:41:08', '05:50:00', '06:45:00'),
(92, 1, '2025-06-08', '08:00:00', '08:32:00', '08:53:00', '08:57:00', '08:11:00', '08:23:00', '08:30:00', '08:32:00', 2, 0, NULL, '2025-06-11 18:57:44', '2025-06-12 11:48:34', '08:02:00', '08:54:00'),
(93, 5, '2025-06-08', '15:09:00', '16:06:00', '16:11:00', '16:19:00', '15:45:00', '16:05:00', '15:14:00', '15:17:00', 1, 0, NULL, '2025-06-11 18:58:29', '2025-06-12 11:51:16', '15:12:00', '16:15:00'),
(94, 4, '2025-06-08', '20:39:00', '21:34:00', '21:43:00', '21:44:00', '21:21:00', '21:28:00', '21:33:00', '21:34:00', 1, 0, NULL, '2025-06-11 18:59:07', '2025-06-12 11:55:37', '20:42:00', '21:44:00'),
(95, 4, '2025-06-09', '00:21:00', '01:15:00', '01:19:00', '01:21:00', '00:30:00', '00:39:00', '01:09:00', '01:01:00', 1, 0, 'Waited 30 mins for the nurse', '2025-06-11 18:59:52', '2025-06-13 18:16:20', '00:24:00', '01:20:00'),
(96, 4, '2025-06-09', '13:58:00', '14:35:00', '14:40:00', '14:43:00', NULL, NULL, '14:30:00', '14:32:00', 1, 0, 'Waited 32 mins for the nurse', '2025-06-11 19:00:39', '2025-06-13 18:21:58', '14:03:00', '14:43:00'),
(97, 5, '2025-06-09', '22:32:00', '23:41:00', '23:47:00', '23:49:00', '23:20:00', '23:36:00', '23:39:00', '23:41:00', 1, 0, NULL, '2025-06-11 19:01:39', '2025-06-13 18:26:07', '22:36:00', '23:49:00'),
(98, 2, '2025-06-10', '11:52:00', '12:17:00', '12:39:00', '12:43:00', NULL, NULL, '12:02:00', '12:11:00', 6, 0, NULL, '2025-06-11 19:02:22', '2025-06-16 17:53:33', '11:56:00', '12:39:00'),
(99, 5, '2025-06-10', '12:50:00', '13:26:00', '13:32:00', '13:35:00', NULL, NULL, '12:53:00', '12:54:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 19:02:57', '2025-06-16 17:58:19', '12:53:00', '13:33:00'),
(100, 4, '2025-06-10', '13:40:00', '14:34:00', '14:36:00', '14:37:00', '14:20:00', '14:25:00', '14:29:00', '14:33:00', 1, 0, NULL, '2025-06-11 19:03:23', '2025-06-16 18:06:07', '14:06:00', '14:37:00'),
(101, 5, '2025-06-10', '15:33:00', '16:19:00', '16:35:00', '16:11:00', NULL, NULL, '15:53:00', '15:56:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 19:04:12', '2025-06-16 19:15:48', '15:37:00', '16:38:00'),
(102, 4, '2025-06-10', '15:23:00', '16:35:00', '17:48:00', '16:35:00', '15:35:00', '15:47:00', '15:56:00', '17:01:00', 1, 0, 'A 2nd intake dropped off to officer ', '2025-06-11 19:04:44', '2025-06-16 18:43:14', '15:27:00', '17:51:00'),
(103, 4, '2025-06-10', '16:03:00', '16:19:00', '16:35:00', '16:40:00', NULL, NULL, '16:08:00', '16:10:00', 1, 0, NULL, '2025-06-11 19:05:17', '2025-06-16 18:21:39', '16:07:00', '16:40:00'),
(104, 1, '2025-06-10', '16:11:00', '17:13:00', '17:21:00', '17:21:00', '16:29:00', '16:50:00', '16:29:00', '16:32:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 19:05:51', '2025-06-16 19:08:01', '16:21:00', '17:22:00'),
(105, 2, '2025-06-10', '16:48:00', '18:03:00', '18:13:00', '18:19:00', NULL, NULL, '17:36:00', '17:43:00', 3, 0, 'Wait due to other LEO\'s', '2025-06-11 19:06:33', '2025-06-16 19:07:53', '16:54:00', '18:20:00'),
(106, 5, '2025-06-10', '17:46:00', '18:44:00', '18:53:00', '18:56:00', NULL, NULL, '17:56:00', '17:58:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-11 19:07:08', '2025-06-16 19:08:07', '17:50:00', '18:54:00'),
(107, 3, '2025-06-11', '01:35:00', '01:55:00', '01:58:00', '02:12:00', NULL, NULL, '01:51:00', '01:54:00', 1, 0, 'Waited 16 mins for the nurse', '2025-06-17 13:28:20', '2025-06-18 15:30:14', '01:36:00', '01:59:00'),
(108, 4, '2025-06-11', '11:52:00', '12:18:00', '12:24:00', '12:29:00', NULL, NULL, '12:06:00', '12:08:00', 1, 0, NULL, '2025-06-17 13:28:53', '2025-06-18 18:12:39', '11:54:00', '12:25:00'),
(109, 5, '2025-06-11', '18:24:00', '18:56:00', '19:04:00', '19:06:00', NULL, NULL, '18:30:00', '18:31:00', 1, 0, 'Waited 26 mins for booking staff after the nurse', '2025-06-17 13:29:22', '2025-06-18 15:44:13', '18:26:00', '19:05:00'),
(110, 7, '2025-06-11', '21:28:00', '22:09:00', '22:16:00', '22:18:00', NULL, NULL, '22:07:00', '22:08:00', 1, 0, 'Waited 39 mins for the nurse', '2025-06-17 13:29:52', '2025-06-18 15:28:29', '21:31:00', '22:16:00'),
(111, 1, '2025-06-12', '00:08:00', '00:47:00', '00:56:00', '01:01:00', '00:21:00', '00:40:00', '00:45:00', '00:46:00', 1, 0, NULL, '2025-06-17 13:30:22', '2025-06-20 10:43:15', '00:20:00', '00:57:00'),
(112, 5, '2025-06-12', '11:07:00', '11:32:00', '11:39:00', '11:52:00', NULL, NULL, '11:17:00', '11:21:00', 1, 0, NULL, '2025-06-17 13:47:15', '2025-06-18 18:21:51', '11:11:00', '11:40:00'),
(113, 2, '2025-06-12', '11:32:00', '12:15:00', '12:30:00', '12:44:00', NULL, NULL, '11:56:00', '12:11:00', 6, 0, 'Waited 24 mins for the nurse', '2025-06-17 13:54:12', '2025-06-20 10:44:53', '11:35:00', '12:36:00'),
(114, 4, '2025-06-12', '16:53:00', '17:15:00', '17:22:00', '17:30:00', '16:56:00', '17:04:00', '17:13:00', '17:15:00', 1, 0, NULL, '2025-06-17 13:54:50', '2025-06-18 18:23:17', '16:55:00', '17:23:00'),
(115, 2, '2025-06-12', '17:32:00', '19:11:00', '19:17:00', '19:20:00', NULL, NULL, '17:52:00', '17:56:00', 1, 0, 'Waited 20 mins for the nurse and 1 he 15 mins for booking staff ', '2025-06-17 13:55:34', '2025-06-18 18:25:08', '17:35:00', '19:18:00'),
(116, 5, '2025-06-12', '21:01:00', '21:27:00', '21:41:00', '21:45:00', NULL, NULL, '21:24:00', '21:26:00', 1, 0, NULL, '2025-06-17 13:56:29', '2025-06-20 10:47:29', '21:05:00', '21:41:00'),
(117, 7, '2025-06-12', '21:23:00', '22:00:00', '22:21:00', '22:39:00', NULL, NULL, '21:27:00', '21:29:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-17 13:56:54', '2025-06-18 18:15:04', '21:26:00', '22:38:00'),
(118, 1, '2025-06-12', '21:25:00', '22:46:00', '22:53:00', '22:56:00', '22:06:00', '22:28:00', '22:42:00', '22:45:00', 1, 0, 'Waited 14mins for the nurse', '2025-06-17 13:57:13', '2025-06-18 18:20:32', '21:38:00', '22:54:00'),
(119, 1, '2025-06-13', '01:33:00', '02:37:00', '02:47:00', '02:49:00', '02:04:00', '02:17:00', '02:34:00', '02:36:00', 1, 0, 'Waited 17 mins for the nurse', '2025-06-17 13:57:49', '2025-06-20 10:49:08', '01:36:00', '02:47:00'),
(120, 4, '2025-06-13', '15:27:00', '16:10:00', '16:14:00', '16:27:00', '15:34:00', '16:03:00', '15:34:00', '15:36:00', 1, 0, NULL, '2025-06-17 13:58:16', '2025-06-20 10:50:28', '15:33:00', '16:15:00'),
(121, 5, '2025-06-14', '01:21:00', NULL, NULL, '02:26:00', '01:42:00', '02:14:00', NULL, NULL, 1, 1, NULL, '2025-06-17 13:59:18', '2025-06-20 10:55:26', '01:24:00', '02:25:00'),
(122, 1, '2025-06-14', '06:24:00', '06:58:00', '07:07:00', '07:17:00', NULL, NULL, '06:55:00', '06:57:00', 1, 0, 'Waited 31 mins for the nurse', '2025-06-17 13:59:49', '2025-06-20 10:58:24', '06:27:00', '07:08:00'),
(123, 1, '2025-06-14', '12:43:00', '13:35:00', '13:45:00', '13:50:00', '12:50:00', '13:03:00', '13:31:00', '13:32:00', 1, 0, 'Waited 28 mins for the nurse', '2025-06-17 14:00:34', '2025-06-20 10:57:13', '12:47:00', '13:46:00'),
(124, 2, '2025-06-14', '13:00:00', '13:46:00', '14:25:00', '15:09:00', NULL, NULL, '13:13:00', '13:29:00', 9, 0, 'Picked up 1 inmate ', '2025-06-17 14:01:04', '2025-06-20 10:59:55', '13:04:00', '15:04:00'),
(125, 4, '2025-06-15', '01:15:00', '02:00:00', '02:05:00', '02:10:00', '01:43:00', '01:55:00', '01:58:00', '02:00:00', 1, 0, NULL, '2025-06-17 14:01:41', '2025-06-20 11:03:34', '01:17:00', '02:09:00'),
(126, 5, '2025-06-15', '05:08:00', '06:47:00', '06:52:00', '06:55:00', '05:15:00', '06:39:00', '06:42:00', '06:45:00', 1, 0, NULL, '2025-06-17 14:02:19', '2025-06-20 11:02:09', '05:09:00', '06:52:00'),
(127, 1, '2025-06-15', '14:22:00', '15:08:00', '15:10:00', '15:20:00', '14:26:00', '15:08:00', '14:32:00', '14:34:00', 1, 0, NULL, '2025-06-17 14:02:53', '2025-06-20 11:01:13', '14:24:00', '15:17:00'),
(128, 5, '2025-06-15', '17:24:00', '17:42:00', '17:49:00', '18:06:00', NULL, NULL, '17:39:00', '17:41:00', 1, 0, NULL, '2025-06-17 14:03:32', '2025-06-20 11:04:33', '17:26:00', '17:56:00'),
(129, 1, '2025-06-16', '11:52:00', '12:26:00', '12:34:00', '12:31:00', '11:57:00', '12:14:00', '12:25:00', '12:26:00', 1, 0, NULL, '2025-06-17 14:04:10', '2025-06-20 10:52:46', '11:56:00', '12:35:00'),
(130, 7, '2025-06-16', '18:30:00', '18:54:00', '19:04:00', '19:07:00', NULL, NULL, '18:42:00', '18:44:00', 1, 0, 'waited 12 mins for the nurse', '2025-06-17 14:04:39', '2025-06-20 10:53:58', '18:31:00', '19:05:00'),
(131, 1, '2025-06-16', '19:19:00', NULL, NULL, '20:21:00', '19:49:00', '20:18:00', NULL, NULL, 1, 1, NULL, '2025-06-17 14:05:26', '2025-06-20 10:51:29', '19:22:00', '20:19:00'),
(132, 3, '2025-06-17', '02:29:00', '03:29:00', '03:37:00', '03:42:00', '02:47:00', '03:12:00', '03:25:00', '03:27:00', 1, 0, 'Waited 13 mins for the nurse', '2025-06-20 17:55:37', '2025-06-20 17:55:37', '02:38:00', '03:41:00'),
(133, 5, '2025-06-17', '03:20:00', '03:49:00', '03:55:00', '03:58:00', NULL, NULL, '03:27:00', '03:29:00', 1, 0, NULL, '2025-06-24 11:31:51', '2025-06-24 11:31:51', '03:22:00', '03:56:00'),
(134, 5, '2025-06-17', '11:55:00', '12:07:00', '12:34:00', '12:38:00', NULL, NULL, '12:00:00', '12:02:00', 8, 0, NULL, '2025-06-24 11:33:10', '2025-06-24 11:33:41', '11:59:00', '12:35:00'),
(135, 2, '2025-06-17', '11:59:00', '12:57:00', '13:23:00', '13:36:00', NULL, NULL, '12:30:00', '12:40:00', 8, 0, 'Picked up 1 ', '2025-06-24 11:35:43', '2025-06-24 11:35:43', '12:18:00', '13:33:00'),
(136, 1, '2025-06-17', '13:16:00', NULL, NULL, '14:15:00', NULL, NULL, NULL, NULL, 0, 0, 'Had no intakes but went to the inside magistrate window', '2025-06-24 11:37:22', '2025-06-24 13:17:50', '13:21:00', '14:12:00'),
(137, 5, '2025-06-17', '14:36:00', '15:29:00', '15:39:00', '15:42:00', NULL, NULL, '14:45:00', '14:46:00', 1, 0, 'waited 44 mins booking staff after the nurse', '2025-06-24 11:39:31', '2025-06-24 11:39:31', '14:38:00', '15:39:00'),
(138, 3, '2025-06-17', '16:14:00', '17:16:00', '17:24:00', '17:26:00', NULL, NULL, '16:23:00', '16:25:00', 1, 0, 'waited 53 mins booking staff due to court returns and drop offs from court', '2025-06-24 11:41:32', '2025-06-24 11:41:32', '16:16:00', '17:24:00'),
(139, 2, '2025-06-17', '16:42:00', '17:35:00', '17:52:00', '17:59:00', NULL, NULL, '16:50:00', '16:54:00', 1, 0, 'waited due to other LEO\'s', '2025-06-24 11:43:06', '2025-06-24 11:43:06', '16:50:00', '17:56:00'),
(140, 5, '2025-06-17', '18:35:00', '19:09:00', '19:18:00', '19:22:00', NULL, NULL, '18:55:00', '18:58:00', 1, 0, 'waited 20 mins for the nurse', '2025-06-24 11:44:27', '2025-06-24 11:44:27', '18:37:00', '19:19:00'),
(141, 5, '2025-06-18', '12:00:00', '12:29:00', '12:33:00', '13:18:00', NULL, NULL, '12:23:00', '12:28:00', 1, 0, 'Waited 20 mins for the nurse', '2025-06-24 11:46:09', '2025-06-25 18:20:57', '12:03:00', '12:34:00'),
(142, 1, '2025-06-18', '14:42:00', '15:36:00', '15:42:00', '15:50:00', '14:45:00', '15:33:00', '15:35:00', '15:36:00', 1, 0, NULL, '2025-06-24 11:46:35', '2025-06-25 18:24:20', '14:07:00', '15:47:00'),
(143, 1, '2025-06-18', '17:46:00', '19:03:00', '19:09:00', '19:16:00', '17:50:00', '19:01:00', '18:44:00', '18:59:00', 1, 0, NULL, '2025-06-24 11:47:20', '2025-06-25 18:23:08', '17:49:00', '19:15:00'),
(144, 5, '2025-06-18', '19:41:00', '21:23:00', '21:28:00', '21:30:00', '20:35:00', '21:18:00', '21:22:00', '21:23:00', 1, 0, NULL, '2025-06-24 11:48:31', '2025-06-25 18:25:56', '19:44:00', '21:28:00'),
(145, 1, '2025-06-18', '23:27:00', '00:50:00', '00:54:00', '00:55:00', '23:46:00', '00:41:00', '00:49:00', '00:50:00', 1, 0, NULL, '2025-06-24 11:49:05', '2025-06-24 13:34:31', '23:28:00', '00:56:00'),
(146, 3, '2025-06-19', '11:02:00', '12:03:00', '12:12:00', '12:15:00', NULL, NULL, '11:13:00', '11:20:00', 1, 0, 'Wait due to Ofc. Jenkins searching the intakes property', '2025-06-24 11:49:44', '2025-06-25 18:33:53', '11:04:00', '12:12:00'),
(147, 2, '2025-06-19', '11:27:00', '11:56:00', '12:51:00', '12:57:00', NULL, NULL, '11:35:00', '11:59:00', 10, 0, NULL, '2025-06-24 11:50:13', '2025-06-25 18:39:32', '11:32:00', '12:51:00'),
(148, 4, '2025-06-19', '12:50:00', '13:18:00', '13:28:00', '13:30:00', '12:57:00', '13:16:00', '13:16:00', '13:17:00', 1, 0, NULL, '2025-06-24 11:52:44', '2025-06-25 18:38:04', '12:51:00', '13:28:00'),
(149, 1, '2025-06-19', '16:45:00', '17:35:00', '17:46:00', '17:53:00', '17:05:00', '17:28:00', '17:33:00', '17:35:00', 1, 0, NULL, '2025-06-24 11:53:11', '2025-06-25 18:36:45', '16:47:00', '17:46:00'),
(150, 4, '2025-06-19', '16:49:00', '17:47:00', '17:55:00', '18:00:00', '16:52:00', '17:04:00', '17:35:00', '17:37:00', 1, 0, 'waited 31 min s for the nurse', '2025-06-24 11:53:36', '2025-06-25 18:35:32', '16:51:00', '17:56:00'),
(151, 4, '2025-06-19', '17:48:00', '18:47:00', '19:12:00', '19:12:00', '18:22:00', '18:41:00', '18:09:00', '18:27:00', 1, 0, 'Intake had to be adminstered narcam and went out by EMS', '2025-06-24 11:54:05', '2025-06-25 18:28:22', '17:50:00', '19:12:00'),
(152, 5, '2025-06-19', '22:20:00', '22:39:00', '22:43:00', '00:12:00', NULL, NULL, '22:35:00', '22:38:00', 1, 0, NULL, '2025-06-24 11:54:34', '2025-06-25 18:32:13', '22:28:00', '22:45:00'),
(153, 1, '2025-06-20', '11:53:00', '12:27:00', '12:32:00', '12:33:00', NULL, NULL, '12:17:00', '12:19:00', 1, 0, 'Waited 24 mins for the nurse', '2025-06-24 11:55:08', '2025-06-25 19:00:04', '11:54:00', '12:33:00'),
(154, 5, '2025-06-20', '14:07:00', '14:47:00', '14:51:00', '14:52:00', NULL, NULL, '14:43:00', '14:45:00', 2, 0, 'Waited 36 mins for the nurse', '2025-06-24 11:55:42', '2025-06-25 18:59:05', '14:09:00', '14:52:00'),
(155, 1, '2025-06-20', '14:56:00', '15:53:00', '15:59:00', '17:55:00', '15:11:00', '15:42:00', '15:05:00', '15:07:00', 1, 0, 'Intake screen completed @ 03:59pm the officer went into booking and was there for 1hr 56 mins', '2025-06-24 11:56:13', '2025-06-25 18:57:13', '14:59:00', '17:55:00'),
(156, 4, '2025-06-20', '14:31:00', '15:28:00', '15:37:00', '15:38:00', '14:38:00', '15:07:00', '14:45:00', '14:47:00', 1, 0, 'Waited 21 mins for booking staff', '2025-06-24 11:56:39', '2025-06-25 18:44:25', '14:33:00', '15:38:00'),
(157, 4, '2025-06-20', '16:38:00', '17:20:00', '17:28:00', '17:30:00', '16:43:00', '16:55:00', '17:18:00', '17:19:00', 1, 0, 'Waited 23 mins for the nurse', '2025-06-24 12:34:32', '2025-06-25 19:05:45', '16:40:00', '17:29:00'),
(158, 5, '2025-06-20', '16:48:00', '17:29:00', '17:37:00', '17:37:00', NULL, NULL, '17:16:00', '17:18:00', 1, 0, 'Waited 28 mins for the nurse then 13 mins for booking staff ', '2025-06-24 12:35:03', '2025-06-25 18:48:45', '16:50:00', '17:37:00'),
(159, 3, '2025-06-20', '18:46:00', '19:19:00', '19:29:00', '19:31:00', NULL, NULL, '18:58:00', '19:01:00', 1, 0, 'Waited 21 mins for booking staff after the nurse', '2025-06-24 12:35:28', '2025-06-25 19:02:18', '18:47:00', '19:29:00'),
(160, 1, '2025-06-20', '19:11:00', NULL, NULL, '20:19:00', NULL, NULL, NULL, NULL, 0, 0, 'Did not have an intake went into booking', '2025-06-24 12:35:53', '2025-06-25 18:41:34', '19:19:00', '20:15:00'),
(161, 5, '2025-06-20', '19:17:00', NULL, NULL, '20:19:00', NULL, NULL, NULL, NULL, 0, 0, 'Did not have an intake went into booking', '2025-06-24 12:36:27', '2025-06-25 19:04:32', '19:19:00', '20:15:00'),
(162, 4, '2025-06-20', '19:52:00', '21:07:00', '21:13:00', '21:16:00', '20:28:00', '20:39:00', '20:47:00', '20:50:00', 1, 0, 'waited 14 mins for booking staff after the nurse ', '2025-06-24 12:36:56', '2025-06-25 19:07:23', '19:54:00', '21:14:00'),
(163, 4, '2025-06-20', '20:33:00', NULL, NULL, '22:21:00', '21:55:00', '22:13:00', '20:54:00', '20:55:00', 1, 1, NULL, '2025-06-24 12:37:40', '2025-06-25 18:47:24', '20:37:00', '22:19:00'),
(164, 1, '2025-06-20', '21:20:00', '22:37:00', '22:43:00', '22:47:00', '22:13:00', '22:26:00', '22:34:00', '22:36:00', 1, 0, NULL, '2025-06-24 12:38:14', '2025-06-25 19:03:25', '21:21:00', '22:44:00'),
(165, 4, '2025-06-20', '22:51:00', NULL, NULL, '23:45:00', '23:23:00', '23:42:00', NULL, NULL, 1, 1, NULL, '2025-06-24 12:38:48', '2025-06-25 18:42:58', '22:54:00', '23:43:00'),
(166, 4, '2025-06-21', '03:41:00', NULL, NULL, '04:23:00', '03:46:00', '04:18:00', NULL, NULL, 1, 1, NULL, '2025-06-24 12:46:45', '2025-07-01 11:57:28', '03:42:00', '04:18:00'),
(167, 1, '2025-06-21', '05:05:00', '06:01:00', '06:07:00', '06:10:00', '05:13:00', '03:35:00', '05:56:00', '06:00:00', 1, 0, 'Waited 21 mins for the nurse', '2025-06-24 12:48:19', '2025-07-01 11:56:17', '05:11:00', '06:08:00'),
(168, 2, '2025-06-21', '10:42:00', '11:45:00', '12:21:00', '12:28:00', NULL, NULL, '10:52:00', '11:00:00', 7, 0, 'Waited 45 mins for booking staff after the nurse', '2025-06-24 12:48:42', '2025-07-01 12:00:55', '10:46:00', '12:23:00'),
(169, 4, '2025-06-21', '12:01:00', '13:04:00', '13:13:00', '13:16:00', NULL, NULL, '12:30:00', '12:32:00', 1, 0, 'Wait due to other LEO\'s', '2025-06-24 12:51:44', '2025-07-01 11:54:38', '12:05:00', '13:14:00'),
(170, 5, '2025-06-21', '13:31:00', '13:41:00', '13:48:00', '00:00:00', NULL, NULL, '13:39:00', '13:41:00', 1, 0, NULL, '2025-06-24 12:52:19', '2025-07-01 11:51:26', '13:33:00', '13:49:00'),
(171, 5, '2025-06-21', '12:31:00', '13:20:00', '13:39:00', '13:41:00', NULL, NULL, '13:16:00', '13:19:00', 1, 0, 'Waited 45 mins for the nurse', '2025-06-24 12:52:42', '2025-07-01 11:49:48', '12:34:00', '13:41:00'),
(172, 4, '2025-06-21', '17:46:00', '18:41:00', '18:46:00', '18:48:00', '17:58:00', '18:30:00', '18:40:00', '18:41:00', 1, 0, NULL, '2025-06-24 12:53:40', '2025-07-01 11:59:01', '17:49:00', '18:46:00'),
(173, 1, '2025-06-21', '22:43:00', NULL, NULL, '23:23:00', '22:46:00', '23:17:00', NULL, NULL, 1, 1, NULL, '2025-06-24 12:54:05', '2025-07-01 12:01:37', '22:45:00', '22:20:00'),
(174, 1, '2025-06-22', '16:44:00', '17:18:00', '17:42:00', '17:47:00', '16:57:00', '17:10:00', '17:17:00', '17:18:00', 1, 0, NULL, '2025-06-24 12:56:13', '2025-07-01 12:04:04', '16:57:00', '17:43:00'),
(175, 4, '2025-06-22', '23:02:00', '23:35:00', '23:44:00', '23:47:00', '23:08:00', '23:21:00', '23:32:00', '23:34:00', 1, 0, NULL, '2025-06-24 12:56:35', '2025-07-01 12:02:44', '23:04:00', '23:45:00'),
(176, 1, '2025-06-23', '03:38:00', '04:06:00', '04:18:00', '04:22:00', '03:40:00', '03:56:00', '04:03:00', '04:05:00', 1, 0, NULL, '2025-06-24 13:11:44', '2025-07-01 12:09:11', '03:40:00', '04:18:00'),
(177, 1, '2025-06-23', '07:34:00', '08:02:00', '08:10:00', '08:13:00', '07:38:00', '07:51:00', '07:59:00', '08:01:00', 1, 0, NULL, '2025-06-24 13:12:13', '2025-07-01 12:05:27', '07:35:00', '08:10:00'),
(178, 1, '2025-06-23', '08:48:00', '09:30:00', '09:42:00', '09:45:00', '08:50:00', '09:11:00', '09:25:00', '09:29:00', 1, 0, 'Waited 14 mins for the nurse', '2025-06-24 13:12:52', '2025-07-01 12:06:53', '08:50:00', '09:42:00'),
(179, 5, '2025-06-23', '13:24:00', '14:18:00', '14:25:00', '14:21:00', '13:43:00', '14:10:00', '14:14:00', '14:16:00', 1, 0, NULL, '2025-06-24 13:13:50', '2025-07-01 12:08:05', '13:32:00', '14:25:00'),
(180, 5, '2025-06-23', '13:54:00', '14:12:00', '14:17:00', '14:38:00', NULL, NULL, '14:11:00', '14:12:00', 1, 0, NULL, '2025-06-24 13:14:23', '2025-07-01 12:12:16', '13:56:00', '14:18:00'),
(181, 1, '2025-06-23', '18:18:00', '18:52:00', '18:57:00', '19:00:00', '18:26:00', '18:44:00', '18:50:00', '18:52:00', NULL, 0, NULL, '2025-06-24 13:14:47', '2025-07-01 12:13:09', '18:21:00', '18:58:00'),
(182, 5, '2025-06-24', '11:48:00', '12:02:00', '12:15:00', '00:00:00', NULL, NULL, '11:56:00', '11:59:00', 2, 0, NULL, '2025-06-25 14:26:30', '2025-07-01 12:14:10', '11:50:00', '12:15:00'),
(183, 1, '2025-06-24', '12:26:00', '13:00:00', '13:08:00', '13:12:00', NULL, NULL, '12:32:00', '12:34:00', 1, 0, 'waited 28 mins for booking staff after the nurse', '2025-06-25 14:27:09', '2025-07-01 12:25:39', '12:29:00', '13:19:00'),
(184, 5, '2025-06-24', '13:21:00', '13:46:00', '13:55:00', '13:58:00', NULL, NULL, '13:44:00', '13:45:00', 1, 0, 'Waited 23 mins for the nurse', '2025-06-25 14:27:44', '2025-07-01 12:16:43', '13:26:00', '13:55:00'),
(185, 2, '2025-06-24', '14:31:00', '15:04:00', '15:52:00', '15:55:00', NULL, NULL, '14:47:00', '15:03:00', 9, 0, NULL, '2025-06-25 14:28:13', '2025-07-01 12:27:39', '15:33:00', '15:53:00'),
(186, 6, '2025-06-24', '17:20:00', '17:44:00', '17:52:00', '18:00:00', NULL, NULL, '17:39:00', '17:42:00', 1, 0, NULL, '2025-06-25 14:28:39', '2025-07-01 12:26:36', '17:28:00', '17:53:00'),
(187, 3, '2025-06-25', '00:47:00', '00:56:00', '01:09:00', '01:44:00', NULL, NULL, '00:54:00', '00:55:00', 1, 0, NULL, '2025-06-26 10:28:21', '2025-07-01 17:04:07', '00:49:00', '01:12:00'),
(188, 5, '2025-06-25', '13:47:00', '13:51:00', '13:56:00', '14:00:00', NULL, NULL, NULL, NULL, 1, 0, 'No departure on log form master control', '2025-06-26 10:29:05', '2025-07-01 17:06:06', '13:49:00', '13:57:00'),
(189, 5, '2025-06-25', '17:51:00', '18:19:00', '18:37:00', '18:41:00', '18:02:00', '18:14:00', '18:17:00', '18:19:00', 1, 0, 'Medical Emergency called on intake', '2025-06-26 10:32:23', '2025-07-01 17:01:26', '17:57:00', '18:39:00'),
(190, 4, '2025-06-25', '14:07:00', '14:33:00', '14:48:00', '14:49:00', NULL, NULL, '14:18:00', '14:19:00', 1, 0, 'Waited 11 mins for the nurse then 15 mins for booking staff', '2025-06-26 10:33:24', '2025-07-01 17:02:59', '14:10:00', '14:48:00'),
(191, 1, '2025-06-25', '23:56:00', '00:49:00', '01:01:00', '01:05:00', '00:00:00', '00:34:00', '00:45:00', '00:48:00', 1, 0, NULL, '2025-06-26 10:33:56', '2025-07-01 16:58:46', '00:00:00', '01:01:00'),
(192, 1, '2025-06-25', '13:28:00', '14:23:00', '14:33:00', '13:55:00', '13:35:00', '14:14:00', '14:19:00', '14:22:00', 1, 0, NULL, '2025-06-26 10:51:00', '2025-07-01 17:08:15', '13:31:00', '14:34:00'),
(193, 2, '2025-06-26', '10:47:00', '11:17:00', '11:44:00', '11:48:00', NULL, NULL, '11:03:00', '11:16:00', 8, 0, NULL, '2025-06-27 18:28:34', '2025-07-01 17:12:38', '10:51:00', '11:46:00'),
(194, 5, '2025-06-26', '10:50:00', '11:44:00', '11:55:00', '11:49:00', NULL, NULL, '11:17:00', '11:21:00', 1, 0, 'Wait Due to CSO drop off', '2025-06-27 18:28:55', '2025-07-02 15:36:14', '10:53:00', '11:56:00'),
(195, 1, '2025-06-26', '13:49:00', '14:13:00', '14:24:00', '14:30:00', '13:54:00', '14:09:00', '14:02:00', '14:03:00', 1, 0, NULL, '2025-06-27 18:29:20', '2025-07-02 15:39:16', '13:53:00', '14:25:00'),
(196, 3, '2025-06-26', '15:36:00', '16:19:00', '16:25:00', '16:27:00', NULL, NULL, '15:47:00', '15:58:00', 1, 0, ' Waited 21 mins for the nurse', '2025-06-27 18:29:48', '2025-07-02 15:40:17', '15:45:00', '16:25:00'),
(197, 3, '2025-06-26', '15:54:00', '16:26:00', '16:38:00', '16:41:00', NULL, NULL, '16:01:00', '16:02:00', 1, 0, 'Wait Due to other LEO\'s', '2025-06-27 18:30:10', '2025-07-01 17:14:32', '16:00:00', '16:39:00'),
(198, 7, '2025-06-26', '20:48:00', '22:17:00', '22:22:00', '22:24:00', '21:15:00', '22:01:00', '22:11:00', '22:16:00', 1, 0, NULL, '2025-06-27 18:30:51', '2025-07-02 15:35:25', '20:50:00', '22:23:00'),
(199, 5, '2025-06-26', '22:22:00', '22:50:00', '22:58:00', '23:01:00', NULL, NULL, '22:47:00', '22:49:00', 1, 0, NULL, '2025-06-27 18:31:14', '2025-07-01 17:09:52', '22:24:00', '22:58:00'),
(200, 1, '2025-06-26', '23:18:00', '23:47:00', '00:09:00', '00:13:00', '23:30:00', '23:41:00', '23:43:00', '23:46:00', 1, 0, NULL, '2025-06-27 18:31:37', '2025-07-02 15:32:21', '23:23:00', '00:10:00'),
(201, 6, '2025-06-26', '23:21:00', '00:17:00', '00:30:00', '00:32:00', NULL, NULL, '23:41:00', '23:43:00', 1, 0, 'Waited 20 mins for the nurse and have a wait due to other LEO\'s', '2025-06-27 18:31:58', '2025-07-02 15:37:44', '23:25:00', '00:31:00'),
(202, 5, '2025-06-26', '23:57:00', '00:53:00', '01:13:00', '01:16:00', NULL, NULL, '00:48:00', '00:52:00', 1, 0, 'waited 51 mins for the nurse', '2025-06-27 18:32:21', '2025-07-02 15:33:46', '00:02:00', '01:14:00'),
(203, 1, '2025-06-27', '00:25:00', '01:30:00', '01:42:00', '01:47:00', '00:32:00', '01:24:00', '01:26:00', '01:29:00', 1, 0, NULL, '2025-07-01 11:29:49', '2025-07-02 15:42:51', '00:26:00', '01:45:00'),
(204, 5, '2025-06-27', '12:50:00', '13:26:00', '13:55:00', '13:58:00', NULL, NULL, '13:22:00', '13:28:00', 2, 0, 'Waited 32 mins for the nurse', '2025-07-01 11:30:22', '2025-07-02 15:49:29', '12:54:00', '13:56:00'),
(205, 4, '2025-06-27', '13:09:00', '13:43:00', '13:55:00', '13:58:00', NULL, NULL, '13:28:00', '13:31:00', 1, 0, NULL, '2025-07-01 11:31:21', '2025-07-02 15:43:39', '13:12:00', '13:56:00'),
(206, 4, '2025-06-27', '18:02:00', '19:11:00', '19:20:00', '19:22:00', '18:11:00', '19:02:00', '19:10:00', '19:11:00', 1, 0, NULL, '2025-07-01 11:31:58', '2025-07-02 15:50:33', '18:09:00', '19:21:00'),
(207, 4, '2025-06-27', '20:36:00', '21:39:00', '21:46:00', '21:50:00', '21:04:00', '21:22:00', '21:36:00', '21:39:00', 1, 0, NULL, '2025-07-01 11:32:30', '2025-07-02 15:44:50', '20:38:00', '21:50:00'),
(208, 1, '2025-06-28', '04:54:00', '05:28:00', '05:34:00', '05:35:00', '05:03:00', '05:07:00', '05:14:00', '05:21:00', 1, 0, NULL, '2025-07-01 11:32:59', '2025-07-02 15:51:59', '04:57:00', '05:35:00'),
(209, 2, '2025-06-28', '11:02:00', '11:35:00', '12:10:00', '12:14:00', NULL, NULL, '11:07:00', '11:27:00', 12, 0, NULL, '2025-07-01 11:33:23', '2025-07-02 15:52:43', '11:05:00', '12:10:00'),
(210, 1, '2025-06-29', '01:50:00', '02:18:00', '02:26:00', '02:28:00', '01:52:00', '02:17:00', '02:15:00', '02:18:00', 1, 0, NULL, '2025-07-01 11:33:57', '2025-07-02 15:53:49', '01:50:00', '02:27:00'),
(211, 5, '2025-06-29', '03:50:00', '04:01:00', '04:28:00', '04:28:00', NULL, NULL, '03:58:00', '04:03:00', 2, 0, NULL, '2025-07-01 11:34:20', '2025-07-02 15:54:50', '03:52:00', '04:28:00'),
(212, 1, '2025-06-30', '00:41:00', '01:13:00', '01:19:00', '01:25:00', '00:56:00', '01:06:00', '01:12:00', '01:13:00', 1, 0, NULL, '2025-07-01 11:34:44', '2025-07-02 15:56:14', '00:44:00', '01:20:00'),
(213, 1, '2025-06-30', '09:45:00', NULL, NULL, '10:26:00', '10:09:00', '10:19:00', NULL, NULL, 1, 1, NULL, '2025-07-01 11:35:08', '2025-07-02 16:02:21', '09:54:00', '10:22:00'),
(214, 3, '2025-06-30', '21:39:00', '22:20:00', '22:39:00', '22:42:00', NULL, NULL, '22:14:00', '22:18:00', 1, 0, 'Waited 35 mins for the nurse', '2025-07-01 11:35:47', '2025-07-02 16:00:35', '21:41:00', '22:39:00'),
(215, 5, '2025-06-30', '21:59:00', '22:39:00', '22:56:00', '22:57:00', NULL, NULL, '22:18:00', '22:20:00', 1, 0, 'Waited 19 mins for the nurse', '2025-07-01 11:36:11', '2025-07-02 15:58:30', '22:02:00', '22:56:00'),
(216, 3, '2025-06-30', '23:26:00', '23:54:00', '00:05:00', '00:07:00', '23:36:00', '23:41:00', '23:53:00', '23:54:00', 1, 0, NULL, '2025-07-01 11:36:44', '2025-07-02 15:57:19', '23:29:00', '00:05:00'),
(217, 1, '2025-06-30', '23:54:00', '00:34:00', '00:41:00', '00:46:00', '23:57:00', '00:28:00', '00:33:00', '00:34:00', 1, 0, NULL, '2025-07-01 11:37:07', '2025-07-02 16:01:37', '23:56:00', '00:42:00'),
(218, 2, '2025-07-01', '10:05:00', '10:38:00', '11:13:00', '11:21:00', NULL, NULL, '10:11:00', '10:22:00', 9, 0, NULL, '2025-07-02 10:47:31', '2025-07-02 16:07:04', '10:08:00', '11:14:00'),
(219, 5, '2025-07-01', '11:22:00', '11:41:00', '12:03:00', '12:07:00', NULL, NULL, '11:32:00', '11:39:00', 5, 0, NULL, '2025-07-02 10:48:17', '2025-07-02 16:04:39', '11:25:00', '12:05:00'),
(220, 4, '2025-07-01', '11:48:00', '12:16:00', '12:24:00', '12:27:00', '11:54:00', '12:11:00', '12:11:00', '12:12:00', 1, 0, NULL, '2025-07-02 10:48:40', '2025-07-02 16:07:52', '11:50:00', '12:25:00'),
(221, 1, '2025-07-01', '12:50:00', '13:23:00', '13:35:00', '13:39:00', '12:58:00', '13:15:00', '13:20:00', '13:23:00', 1, 0, NULL, '2025-07-02 10:49:17', '2025-07-02 16:05:30', '12:53:00', '13:36:00'),
(222, 1, '2025-07-01', '14:25:00', '14:59:00', '15:08:00', '15:10:00', NULL, NULL, '14:57:00', '14:58:00', NULL, 0, 'Waited 32 mins for the nurse', '2025-07-02 10:49:40', '2025-07-02 16:03:28', '14:28:00', '15:09:00'),
(223, 5, '2025-07-01', '17:17:00', '18:25:00', '18:39:00', '18:09:00', NULL, NULL, '17:36:00', '17:37:00', 1, 0, 'Waited 19 mins for the nurse then 48 mins for booking staff', '2025-07-02 10:50:20', '2025-07-02 16:13:30', '17:19:00', '18:50:00'),
(224, 5, '2025-07-01', '18:01:00', '18:44:00', '18:50:00', '18:54:00', NULL, NULL, '18:19:00', '18:20:00', 1, 0, 'Waited 18 mins for the nurse  ', '2025-07-02 10:50:43', '2025-07-02 16:10:30', '18:03:00', '18:50:00'),
(225, 1, '2025-07-01', '19:59:00', '20:35:00', '20:50:00', '20:53:00', '20:14:00', '20:26:00', '20:33:00', '20:35:00', 1, 0, NULL, '2025-07-02 10:51:13', '2025-07-02 16:12:25', '20:01:00', '20:50:00'),
(226, 4, '2025-07-01', '20:48:00', '21:24:00', '21:37:00', '21:43:00', '21:04:00', '21:10:00', '21:21:00', '21:24:00', 1, 0, NULL, '2025-07-02 10:51:46', '2025-07-02 16:06:21', '20:50:00', '21:38:00'),
(227, 5, '2025-07-01', '23:14:00', '23:47:00', '00:00:00', '00:04:00', NULL, NULL, '23:44:00', '23:46:00', 1, 0, 'Waited 25 mins for the nurse', '2025-07-02 10:52:11', '2025-07-02 15:41:20', '23:19:00', '00:01:00'),
(228, 5, '2025-07-02', '03:45:00', NULL, NULL, '04:38:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:49:14', '2025-07-08 10:49:14', NULL, NULL),
(229, 3, '2025-07-02', '12:36:00', NULL, NULL, '12:36:00', NULL, NULL, NULL, NULL, NULL, 0, 'fix depart', '2025-07-08 10:49:43', '2025-07-08 10:50:40', NULL, NULL),
(230, 5, '2025-07-02', '15:34:00', NULL, NULL, '16:45:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:50:20', '2025-07-08 10:50:20', NULL, NULL),
(231, 5, '2025-07-02', '15:55:00', NULL, NULL, '16:54:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:51:02', '2025-07-08 10:51:02', NULL, NULL),
(232, 1, '2025-07-04', '19:28:00', NULL, NULL, '20:16:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:51:48', '2025-07-08 10:51:48', NULL, NULL),
(233, 3, '2025-07-04', '23:49:00', NULL, NULL, '01:01:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:52:13', '2025-07-08 10:52:13', NULL, NULL),
(234, 5, '2025-07-05', '00:13:00', NULL, NULL, '01:29:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:52:49', '2025-07-08 10:52:49', NULL, NULL),
(235, 1, '2025-07-05', '00:38:00', NULL, NULL, '02:30:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:53:10', '2025-07-08 10:53:10', NULL, NULL),
(236, 5, '2025-07-05', '01:32:00', NULL, NULL, '03:10:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:53:31', '2025-07-08 10:53:31', NULL, NULL),
(237, 3, '2025-07-05', '02:38:00', NULL, NULL, '03:41:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:53:58', '2025-07-08 10:53:58', NULL, NULL),
(238, 2, '2025-07-05', '11:02:00', NULL, NULL, '12:28:00', NULL, NULL, NULL, NULL, 10, 0, NULL, '2025-07-08 10:54:20', '2025-07-08 10:54:20', NULL, NULL),
(239, 5, '2025-07-05', '15:00:00', NULL, NULL, '15:48:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:54:43', '2025-07-08 10:54:43', NULL, NULL),
(240, 5, '2025-07-05', '18:37:00', NULL, NULL, '19:37:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:55:16', '2025-07-08 10:55:16', NULL, NULL),
(241, 3, '2025-07-05', '19:04:00', NULL, NULL, '19:57:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:55:40', '2025-07-08 10:55:40', NULL, NULL),
(242, 5, '2025-07-06', '10:09:00', NULL, NULL, '10:53:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:56:13', '2025-07-08 10:56:13', NULL, NULL),
(243, 3, '2025-07-06', '11:01:00', NULL, NULL, '11:42:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:56:32', '2025-07-08 10:56:32', NULL, NULL),
(244, 1, '2025-07-06', '16:56:00', NULL, NULL, '18:24:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:56:59', '2025-07-08 10:56:59', NULL, NULL),
(245, 1, '2025-07-07', '03:30:00', NULL, NULL, '04:16:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:57:27', '2025-07-08 10:57:27', NULL, NULL),
(246, 5, '2025-07-07', '15:30:00', NULL, NULL, '16:11:00', NULL, NULL, NULL, NULL, 1, 0, NULL, '2025-07-08 10:57:56', '2025-07-08 10:57:56', NULL, NULL),
(247, 2, '2025-07-07', '16:05:00', NULL, NULL, '16:42:00', NULL, NULL, NULL, NULL, NULL, 0, NULL, '2025-07-08 10:58:27', '2025-07-08 10:58:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_users_table', 1),
(2, '0001_01_01_000002_create_cache_table', 1),
(3, '0001_01_01_000003_create_jobs_table', 1),
(4, '2024_09_29_125006_create_phone_directory_table', 1),
(5, '2024_12_09_192230_create_fleet_vehicle_maintenance_vehicle_table', 1),
(6, '2024_12_09_192235_create_fleet_vehicle_maintenance_table', 1),
(7, '2024_12_20_010459_create_ics_table', 1),
(8, '2024_12_22_180241_create_policies_table', 1),
(9, '2024_12_31_210000_create_categories_table', 1),
(10, '2024_12_31_210618_create_items_table', 1),
(11, '2025_01_02_141524_create_sections_table', 1),
(12, '2025_01_02_143659_create_orders_table', 1),
(13, '2025_05_02_130959_create_monthly_report_recipients_table', 2),
(14, '2025_05_22_122502_create_jurisdictions_table', 3),
(15, '2025_05_22_122503_create_jurisdiction_time_log_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_report_recipients`
--

CREATE TABLE `monthly_report_recipients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monthly_report_recipients`
--

INSERT INTO `monthly_report_recipients` (`id`, `first_name`, `last_name`, `email`, `created_at`, `updated_at`) VALUES
(2, 'Tojuanna', 'Mack', 'tmack@rrjva.org', '2025-05-14 17:55:40', '2025-05-14 17:55:40'),
(3, 'Charles', 'Armstrong', 'carmstrong@rrjva.org', '2025-05-14 17:55:58', '2025-05-14 17:55:58'),
(4, 'Dennis', 'Holmes', 'dholmes@rrjva.org', '2025-05-14 17:56:13', '2025-05-14 17:56:13'),
(5, 'Kawan', 'Peterson', 'peterson.kawan@rrjva.org', '2025-05-14 17:56:51', '2025-05-14 17:56:51'),
(7, 'Crystal', 'Reid', 'creid@rrjva.org', '2025-05-14 17:57:46', '2025-05-14 17:57:46'),
(8, 'Tim', 'Flexon', 'tflexon@rrjva.org', '2025-05-14 17:58:08', '2025-05-14 17:58:08'),
(9, 'Charles', 'Watson', 'watson.charles@rrjva.org', '2025-05-14 17:58:22', '2025-05-14 17:58:22'),
(10, 'Jeffrey', 'Smith', 'smith.jeffrey@rrjva.org', '2025-05-14 17:58:36', '2025-05-14 17:58:36'),
(11, 'Daryon', 'Jenkins', 'jenkins.daryon@rrjva.org', '2025-05-14 17:58:51', '2025-05-14 17:58:51'),
(12, 'Latonya', 'Mells', 'mells.latanya@rrjva.org', '2025-05-14 17:59:07', '2025-05-14 17:59:07'),
(13, 'Ray', 'Brown', 'rbrown@rrjva.org', '2025-05-14 17:59:18', '2025-05-14 17:59:18'),
(14, 'Jamece', 'Hobbs', 'jhobbs@rrjva.org', '2025-05-14 17:59:31', '2025-05-14 17:59:31'),
(15, 'LaKeisha', 'Mason', 'lmason@rrjva.org', '2025-05-14 17:59:47', '2025-05-14 17:59:47'),
(16, 'Michelle', 'Coleman', 'mcoleman@rrjva.org', '2025-05-14 18:00:02', '2025-05-14 18:00:02'),
(17, 'Jeffrey', 'Dillman', 'dillmanj@rrjva.org', '2025-05-14 18:00:17', '2025-05-14 18:00:17'),
(18, 'Montrell', 'Beasley', 'beasley.montrell@rrjva.org', '2025-05-14 18:00:32', '2025-05-14 18:00:32'),
(19, 'Adam', 'Mears', 'mears.adam@rrjva.org', '2025-05-14 18:00:44', '2025-05-14 18:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `supervisor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `supervisor_name` varchar(255) DEFAULT NULL,
  `originator` varchar(255) DEFAULT NULL,
  `section_id` bigint(20) UNSIGNED DEFAULT NULL,
  `section_name` varchar(255) DEFAULT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `status` varchar(255) NOT NULL,
  `approved_denied_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_denied_by_name` varchar(255) DEFAULT NULL,
  `approved_denied_at` datetime DEFAULT NULL,
  `note` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `supervisor_id`, `supervisor_name`, `originator`, `section_id`, `section_name`, `items`, `status`, `approved_denied_by`, `approved_denied_by_name`, `approved_denied_at`, `note`, `created_at`, `updated_at`) VALUES
(37, NULL, NULL, 146, 'Kenyatta Jones', 'Kenyatta Jones', 2, 'Housing Unit 2', '\"{\\\"191\\\":{\\\"id\\\":191,\\\"name\\\":\\\"Mop Handle\\\",\\\"quantity\\\":1},\\\"186\\\":{\\\"id\\\":186,\\\"name\\\":\\\"Broom Handle (ea)\\\",\\\"quantity\\\":1}}\"', 'pending_warehouse_exchange_approval', NULL, NULL, NULL, NULL, '2025-07-07 12:32:58', '2025-07-07 12:32:58'),
(38, NULL, NULL, 146, 'Kenyatta Jones', 'Kenyatta Jones', 2, 'Housing Unit 2', '\"{\\\"1\\\":{\\\"id\\\":1,\\\"name\\\":\\\"Broom Head (ea)\\\",\\\"quantity\\\":1},\\\"3\\\":{\\\"id\\\":3,\\\"name\\\":\\\"Deck Brush 10\\\\\\\" (ea)\\\",\\\"quantity\\\":1},\\\"91\\\":{\\\"id\\\":91,\\\"name\\\":\\\"Cf280a (ea)  Ink Cartridge \\\",\\\"quantity\\\":1}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-07 12:33:10', '2025-07-07 12:33:10'),
(39, NULL, NULL, 211, 'Latasha Winston', 'Latasha Winston', 13, 'Housekeeping', '\"{\\\"188\\\":{\\\"id\\\":188,\\\"name\\\":\\\"Laundry Destainer (bleach)\\\",\\\"quantity\\\":2},\\\"98\\\":{\\\"id\\\":98,\\\"name\\\":\\\"Bleach\\\",\\\"quantity\\\":1},\\\"33\\\":{\\\"id\\\":33,\\\"name\\\":\\\"Tri Base (gl)\\\",\\\"quantity\\\":1},\\\"32\\\":{\\\"id\\\":32,\\\"name\\\":\\\"Nabc1 (bt)\\\",\\\"quantity\\\":1},\\\"31\\\":{\\\"id\\\":31,\\\"name\\\":\\\"Glass Cleaner (bt)\\\",\\\"quantity\\\":1}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-07 14:15:01', '2025-07-08 13:31:22'),
(40, NULL, NULL, 159, 'Vicki Turner', 'Vicki Turner', 8, 'Administration', '\"{\\\"189\\\":{\\\"id\\\":189,\\\"name\\\":\\\"83a (ea) Ink cartridge\\\",\\\"quantity\\\":1},\\\"31\\\":{\\\"id\\\":31,\\\"name\\\":\\\"Glass Cleaner (bt)\\\",\\\"quantity\\\":1},\\\"47\\\":{\\\"id\\\":47,\\\"name\\\":\\\"Clip Plastic MEDIUM (bx)\\\",\\\"quantity\\\":1},\\\"48\\\":{\\\"id\\\":48,\\\"name\\\":\\\"Clip Plastic LARGE (bx)\\\",\\\"quantity\\\":1},\\\"49\\\":{\\\"id\\\":49,\\\"name\\\":\\\"Clip Plastic XTRA-LG(bx)\\\",\\\"quantity\\\":1},\\\"68\\\":{\\\"id\\\":68,\\\"name\\\":\\\"Tape Transparent (ro)\\\",\\\"quantity\\\":1}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-07 17:45:39', '2025-07-07 17:45:39'),
(41, NULL, NULL, 204, 'Chester Paluch', 'Chester Paluch', 4, 'Housing Unit 4', '\"{\\\"21\\\":{\\\"id\\\":21,\\\"name\\\":\\\"Gloves - Food Handling (pk)\\\",\\\"quantity\\\":5},\\\"193\\\":{\\\"id\\\":193,\\\"name\\\":\\\"Inmate Bar Soap\\\",\\\"quantity\\\":1},\\\"50\\\":{\\\"id\\\":50,\\\"name\\\":\\\"Pen Black (bx)\\\",\\\"quantity\\\":1},\\\"39\\\":{\\\"id\\\":39,\\\"name\\\":\\\"Post It LARGE (pk)\\\",\\\"quantity\\\":1},\\\"35\\\":{\\\"id\\\":35,\\\"name\\\":\\\"Scum B GONE (bt)\\\",\\\"quantity\\\":6},\\\"38\\\":{\\\"id\\\":38,\\\"name\\\":\\\"Steno Note BOOK (ea)\\\",\\\"quantity\\\":1},\\\"18\\\":{\\\"id\\\":18,\\\"name\\\":\\\"Toilet Paper (cs)\\\",\\\"quantity\\\":5},\\\"11\\\":{\\\"id\\\":11,\\\"name\\\":\\\"Trash Bags LG (bx)\\\",\\\"quantity\\\":2},\\\"10\\\":{\\\"id\\\":10,\\\"name\\\":\\\"Trash Bags MED (bx)\\\",\\\"quantity\\\":1}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-08 10:22:53', '2025-07-08 10:22:53'),
(42, NULL, NULL, 231, 'Maria Montijo', 'Maria Montijo', 6, 'Housing Unit 6', '\"{\\\"185\\\":{\\\"id\\\":185,\\\"name\\\":\\\"55a, (ea) Ink cartridge\\\",\\\"quantity\\\":2}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-08 11:11:05', '2025-07-08 11:11:05'),
(43, NULL, NULL, 150, 'Joseph LaVigne', 'Joseph LaVigne', 7, 'Booking', '\"{\\\"23\\\":{\\\"id\\\":23,\\\"name\\\":\\\"Green Antibact HAND SOAP (ea)\\\",\\\"quantity\\\":2},\\\"35\\\":{\\\"id\\\":35,\\\"name\\\":\\\"Scum B GONE (bt)\\\",\\\"quantity\\\":4},\\\"33\\\":{\\\"id\\\":33,\\\"name\\\":\\\"Tri Base (gl)\\\",\\\"quantity\\\":1},\\\"9\\\":{\\\"id\\\":9,\\\"name\\\":\\\"Trash Bags SM (ro)\\\",\\\"quantity\\\":4},\\\"10\\\":{\\\"id\\\":10,\\\"name\\\":\\\"Trash Bags MED (bx)\\\",\\\"quantity\\\":1},\\\"11\\\":{\\\"id\\\":11,\\\"name\\\":\\\"Trash Bags LG (bx)\\\",\\\"quantity\\\":2},\\\"75\\\":{\\\"id\\\":75,\\\"name\\\":\\\"Copy Paper 8.5x11 (cs)\\\",\\\"quantity\\\":2}}\"', 'pending_warehouse_approval', NULL, NULL, NULL, NULL, '2025-07-08 15:52:21', '2025-07-08 15:52:21'),
(44, NULL, NULL, 163, 'Nicole Fulton', 'Adam Mears', 20, 'Property', '\"{\\\"166\\\":{\\\"id\\\":166,\\\"name\\\":\\\"Shoes Size 7\\\",\\\"quantity\\\":12},\\\"168\\\":{\\\"id\\\":168,\\\"name\\\":\\\"Shoes Size 9\\\",\\\"quantity\\\":12},\\\"169\\\":{\\\"id\\\":169,\\\"name\\\":\\\"Shoes Size 10\\\",\\\"quantity\\\":12},\\\"170\\\":{\\\"id\\\":170,\\\"name\\\":\\\"Shoes Size 11\\\",\\\"quantity\\\":12},\\\"171\\\":{\\\"id\\\":171,\\\"name\\\":\\\"Shoes Size 12\\\",\\\"quantity\\\":12},\\\"172\\\":{\\\"id\\\":172,\\\"name\\\":\\\"Shoes Size 13\\\",\\\"quantity\\\":12},\\\"130\\\":{\\\"id\\\":130,\\\"name\\\":\\\"Bra Size 34\\\",\\\"quantity\\\":144},\\\"145\\\":{\\\"id\\\":145,\\\"name\\\":\\\"T-Shirts Med\\\",\\\"quantity\\\":72},\\\"146\\\":{\\\"id\\\":146,\\\"name\\\":\\\"T-Shirts Lg\\\",\\\"quantity\\\":72}}\"', 'approved', 144, 'Adam Mears', '2025-07-08 12:24:17', NULL, '2025-07-08 16:24:17', '2025-07-08 16:24:17'),
(45, NULL, NULL, 163, 'Nicole Fulton', 'Adam Mears', 20, 'Property', '\"{\\\"148\\\":{\\\"id\\\":148,\\\"name\\\":\\\"T-Shirts 2xl\\\",\\\"quantity\\\":72},\\\"120\\\":{\\\"id\\\":120,\\\"name\\\":\\\"Female Briefs MED\\\\\\/6\\\",\\\"quantity\\\":300},\\\"139\\\":{\\\"id\\\":139,\\\"name\\\":\\\"Mens Briefs LG\\\",\\\"quantity\\\":120}}\"', 'approved', 144, 'Adam Mears', '2025-07-08 12:27:34', NULL, '2025-07-08 16:27:34', '2025-07-08 16:27:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_directory`
--

CREATE TABLE `phone_directory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `extension` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policies`
--

CREATE TABLE `policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policies`
--

INSERT INTO `policies` (`id`, `title`, `pdf`, `text`, `created_at`, `updated_at`) VALUES
(1, '01.01.004 Operating Authority', 'policies/01.01.004 Operating Authority.pdf', 'policies/text/01.01.004 Operating Authority.txt', '2025-02-25 21:46:07', '2025-02-25 21:46:07'),
(2, '01.02.006 Mission, Vision, Values & Goals', 'policies/01.02.006 Mission, Vision, Values & Goals.pdf', 'policies/text/01.02.006 Mission, Vision, Values & Goals.txt', '2025-02-25 21:46:07', '2025-02-25 21:46:07'),
(3, '01.03.006 Written Directive System', 'policies/01.03.006 Written Directive System.pdf', 'policies/text/01.03.006 Written Directive System.txt', '2025-02-25 21:46:07', '2025-02-25 21:46:07'),
(4, '01.04.004 Delegation of Authority and Organizational Structure', 'policies/01.04.004 Delegation of Authority and Organizational Structure.pdf', 'policies/text/01.04.004 Delegation of Authority and Organizational Structure.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(5, '01.05.007 Office of Professional Review', 'policies/01.05.007 Office of Professional Review.pdf', 'policies/text/01.05.007 Office of Professional Review.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(6, '01.06.002 Staff and Inmate Communications', 'policies/01.06.002 Staff and Inmate Communications.pdf', 'policies/text/01.06.002 Staff and Inmate Communications.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(7, '01.07.003 Cooperation with Community Agencies Education Institutions', 'policies/01.07.003 Cooperation with Community Agencies Education Institutions.pdf', 'policies/text/01.07.003 Cooperation with Community Agencies Education Institutions.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(8, '01.08.005 Confidentiality Release of Public Information', 'policies/01.08.005 Confidentiality Release of Public Information.pdf', 'policies/text/01.08.005 Confidentiality Release of Public Information.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(9, '01.09.005 News Media Access', 'policies/01.09.005 News Media Access.pdf', 'policies/text/01.09.005 News Media Access.txt', '2025-02-25 21:46:08', '2025-02-25 21:46:08'),
(10, '01.10.008 Employee Rules of Conduct', 'policies/01.10.008 Employee Rules of Conduct.pdf', 'policies/text/01.10.008 Employee Rules of Conduct.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(11, '01.12.005 Staff Roll Call', 'policies/01.12.005 Staff Roll Call.pdf', 'policies/text/01.12.005 Staff Roll Call.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(12, '01.13.003 Staff Mail Distribution', 'policies/01.13.003 Staff Mail Distribution.pdf', 'policies/text/01.13.003 Staff Mail Distribution.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(13, '01.14.005 Staff Meals and Breaks', 'policies/01.14.005 Staff Meals and Breaks.pdf', 'policies/text/01.14.005 Staff Meals and Breaks.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(14, '01.15.004 Tobacco Use Policy', 'policies/01.15.004 Tobacco Use Policy.pdf', 'policies/text/01.15.004 Tobacco Use Policy.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(15, '01.16.004 Facility Tours', 'policies/01.16.004 Facility Tours.pdf', 'policies/text/01.16.004 Facility Tours.txt', '2025-02-25 21:46:09', '2025-02-25 21:46:09'),
(16, '01.17.011 Uniform and Grooming', 'policies/01.17.011 Uniform and Grooming.pdf', 'policies/text/01.17.011 Uniform and Grooming.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(18, '01.19.004 Legal Assistance for Staff', 'policies/01.19.004 Legal Assistance for Staff.pdf', 'policies/text/01.19.004 Legal Assistance for Staff.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(19, '01.20.005 Roles and Functions of Employees of Other Agencies', 'policies/01.20.005 Roles and Functions of Employees of Other Agencies.pdf', 'policies/text/01.20.005 Roles and Functions of Employees of Other Agencies.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(20, '01.21.003 Population & Contingency Plan', 'policies/01.21.003 Population & Contingency Plan.pdf', 'policies/text/01.21.003 Population & Contingency Plan.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(21, '01.22.003 Facility Budget', 'policies/01.22.003 Facility Budget.pdf', 'policies/text/01.22.003 Facility Budget.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(22, '01.24.006 Inmate Cash Management', 'policies/01.24.006 Inmate Cash Management.pdf', 'policies/text/01.24.006 Inmate Cash Management.txt', '2025-02-25 21:46:10', '2025-02-25 21:46:10'),
(24, '01.28.009 Facility Insurance Coverage and Accidents', 'policies/01.28.009 Facility Insurance Coverage and Accidents.pdf', 'policies/text/01.28.009 Facility Insurance Coverage and Accidents.txt', '2025-02-25 21:46:11', '2025-02-25 21:46:11'),
(25, '01.29.005 Travel Policy', 'policies/01.29.005 Travel Policy.pdf', 'policies/text/01.29.005 Travel Policy.txt', '2025-02-25 21:46:12', '2025-02-25 21:46:12'),
(26, '01.31.000 Color Guard Staff Funeral Detail', 'policies/01.31.000 Color Guard Staff Funeral Detail.pdf', 'policies/text/01.31.000 Color Guard Staff Funeral Detail.txt', '2025-02-25 21:46:12', '2025-02-25 21:46:12'),
(27, '01.32.001 Reduction-in-Force', 'policies/01.32.001 Reduction-in-Force.pdf', 'policies/text/01.32.001 Reduction-in-Force.txt', '2025-02-25 21:46:12', '2025-02-25 21:46:12'),
(28, '01.33.023 Employee Leave & Attendance', 'policies/01.33.023 Employee Leave & Attendance.pdf', 'policies/text/01.33.023 Employee Leave & Attendance.txt', '2025-02-25 21:46:13', '2025-02-25 21:46:13'),
(29, '01.34.003 Military Employee Leave and Benefits', 'policies/01.34.003 Military Employee Leave and Benefits.pdf', 'policies/text/01.34.003 Military Employee Leave and Benefits.txt', '2025-02-25 21:46:13', '2025-02-25 21:46:13'),
(30, '01.35.001 Administrative Duty Officer (ADO)', 'policies/01.35.001 Administrative Duty Officer (ADO).pdf', 'policies/text/01.35.001 Administrative Duty Officer (ADO).txt', '2025-02-25 21:46:13', '2025-02-25 21:46:13'),
(31, '1.23.009 Income, Purchases, Inventory and Audit', 'policies/1.23.009 Income, Purchases, Inventory and Audit.pdf', 'policies/text/1.23.009 Income, Purchases, Inventory and Audit.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(32, '1.25.004 Inmate Canteen Account Management', 'policies/1.25.004 Inmate Canteen Account Management.pdf', 'policies/text/1.25.004 Inmate Canteen Account Management.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(33, '1.27.004 Drug Freen Workplace', 'policies/1.27.004 Drug Freen Workplace.pdf', 'policies/text/1.27.004 Drug Freen Workplace.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(34, '1.30.004 Employee Leave Sharing', 'policies/1.30.004 Employee Leave Sharing.pdf', 'policies/text/1.30.004 Employee Leave Sharing.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(35, '2.1.003 Post Orders', 'policies/2.1.003 Post Orders.pdf', 'policies/text/2.1.003 Post Orders.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(36, '2.2 Watch Commander Post Order', 'policies/2.2 Watch Commander Post Order.pdf', 'policies/text/2.2 Watch Commander Post Order.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(37, '03.01.010 Recruitment, Selection and Hiring', 'policies/03.01.010 Recruitment, Selection and Hiring.pdf', 'policies/text/03.01.010 Recruitment, Selection and Hiring.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(38, '03.02.011 Probationary Employment', 'policies/03.02.011 Probationary Employment.pdf', 'policies/text/03.02.011 Probationary Employment.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(39, '03.03.008 Promotion, Transfer, Demotion and Resignation', 'policies/03.03.008 Promotion, Transfer, Demotion and Resignation.pdf', 'policies/text/03.03.008 Promotion, Transfer, Demotion and Resignation.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(40, '03.04.004 Personnel Files', 'policies/03.04.004 Personnel Files.pdf', 'policies/text/03.04.004 Personnel Files.txt', '2025-02-25 21:46:14', '2025-02-25 21:46:14'),
(41, '03.06.010 Performance Evaluations', 'policies/03.06.010 Performance Evaluations.pdf', 'policies/text/03.06.010 Performance Evaluations.txt', '2025-02-25 21:46:15', '2025-02-25 21:46:15'),
(42, '03.07.005 Secondary Employment, Overtime and Draft', 'policies/03.07.005 Secondary Employment, Overtime and Draft.pdf', 'policies/text/03.07.005 Secondary Employment, Overtime and Draft.txt', '2025-02-25 21:46:15', '2025-02-25 21:46:15'),
(43, '03.08.004 Equal Employment Opportunity Affirmative Action Plan', 'policies/03.08.004 Equal Employment Opportunity Affirmative Action Plan.pdf', 'policies/text/03.08.004 Equal Employment Opportunity Affirmative Action Plan.txt', '2025-02-25 21:46:15', '2025-02-25 21:46:15'),
(44, '03.09.006 Employee Discipline', 'policies/03.09.006 Employee Discipline.pdf', 'policies/text/03.09.006 Employee Discipline.txt', '2025-02-25 21:46:16', '2025-02-25 21:46:16'),
(45, '03.10.005 Shift Relief Factor Vacancy Rate', 'policies/03.10.005 Shift Relief Factor Vacancy Rate.pdf', 'policies/text/03.10.005 Shift Relief Factor Vacancy Rate.txt', '2025-02-25 21:46:16', '2025-02-25 21:46:16'),
(46, '03.11.004 Awards and Recognition', 'policies/03.11.004 Awards and Recognition.pdf', 'policies/text/03.11.004 Awards and Recognition.txt', '2025-02-25 21:46:16', '2025-02-25 21:46:16'),
(47, '03.13.000 Peer Support', 'policies/03.13.000 Peer Support.pdf', 'policies/text/03.13.000 Peer Support.txt', '2025-02-25 21:46:16', '2025-02-25 21:46:16'),
(48, '3.5.002 Employee Grievance', 'policies/3.5.002 Employee Grievance.pdf', 'policies/text/3.5.002 Employee Grievance.txt', '2025-02-25 21:46:16', '2025-02-25 21:46:16'),
(49, '3.12.004 Sexual Harassment and Misconduct', 'policies/3.12.004 Sexual Harassment and Misconduct.pdf', 'policies/text/3.12.004 Sexual Harassment and Misconduct.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(50, '3.15.000 Responsibilities of Captains', 'policies/3.15.000 Responsibilities of Captains.pdf', 'policies/text/3.15.000 Responsibilities of Captains.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(51, '3.16.000 Responsibilities of Lieutenants', 'policies/3.16.000 Responsibilities of Lieutenants.pdf', 'policies/text/3.16.000 Responsibilities of Lieutenants.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(52, '3.17.000 Responsibilities of Sergeants', 'policies/3.17.000 Responsibilities of Sergeants.pdf', 'policies/text/3.17.000 Responsibilities of Sergeants.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(53, '3.18.01 Limited and Light Duty', 'policies/3.18.01 Limited and Light Duty.pdf', 'policies/text/3.18.01 Limited and Light Duty.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(54, '04.11.000 Post-issuance Compliance for Tax-exempt Bond Issues', 'policies/04.11.000 Post-issuance Compliance for Tax-exempt Bond Issues.pdf', 'policies/text/04.11.000 Post-issuance Compliance for Tax-exempt Bond Issues.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(55, '4.1.008 Receipt of Inmate Funds', 'policies/4.1.008 Receipt of Inmate Funds.pdf', 'policies/text/4.1.008 Receipt of Inmate Funds.txt', '2025-02-25 21:46:17', '2025-02-25 21:46:17'),
(56, '4.2.008 Accounting of Inmate Funds', 'policies/4.2.008 Accounting of Inmate Funds.pdf', 'policies/text/4.2.008 Accounting of Inmate Funds.txt', '2025-02-25 21:46:18', '2025-02-25 21:46:18'),
(57, '4.3.004 General Accounting', 'policies/4.3.004 General Accounting.pdf', 'policies/text/4.3.004 General Accounting.txt', '2025-02-25 21:46:18', '2025-02-25 21:46:18'),
(58, '4.4.001 Control Over Cash Management and Negotiable Instruments', 'policies/4.4.001 Control Over Cash Management and Negotiable Instruments.pdf', 'policies/text/4.4.001 Control Over Cash Management and Negotiable Instruments.txt', '2025-02-25 21:46:18', '2025-02-25 21:46:18'),
(59, '4.5.004 Petty Cash', 'policies/4.5.004 Petty Cash.pdf', 'policies/text/4.5.004 Petty Cash.txt', '2025-02-25 21:46:19', '2025-02-25 21:46:19'),
(60, '4.6.005 Accounts Payable', 'policies/4.6.005 Accounts Payable.pdf', 'policies/text/4.6.005 Accounts Payable.txt', '2025-02-25 21:46:19', '2025-02-25 21:46:19'),
(61, '4.7.004 Payroll Accounting', 'policies/4.7.004 Payroll Accounting.pdf', 'policies/text/4.7.004 Payroll Accounting.txt', '2025-02-25 21:46:19', '2025-02-25 21:46:19'),
(62, '4.8.002 Cash Management Investment', 'policies/4.8.002 Cash Management Investment.pdf', 'policies/text/4.8.002 Cash Management Investment.txt', '2025-02-25 21:46:19', '2025-02-25 21:46:19'),
(63, '4.9.002 Fixed Assets', 'policies/4.9.002 Fixed Assets.pdf', 'policies/text/4.9.002 Fixed Assets.txt', '2025-02-25 21:46:20', '2025-02-25 21:46:20'),
(64, '4.10.005 Daily Incarceration Fee', 'policies/4.10.005 Daily Incarceration Fee.pdf', 'policies/text/4.10.005 Daily Incarceration Fee.txt', '2025-02-25 21:46:20', '2025-02-25 21:46:20'),
(65, '5.1.007 Staff Training', 'policies/5.1.007 Staff Training.pdf', 'policies/text/5.1.007 Staff Training.txt', '2025-02-25 21:46:39', '2025-02-25 21:46:39'),
(66, '5.2.006 Firearms, Electronic Devices and Munitions', 'policies/5.2.006 Firearms, Electronic Devices and Munitions.pdf', 'policies/text/5.2.006 Firearms, Electronic Devices and Munitions.txt', '2025-02-25 21:46:39', '2025-02-25 21:46:39'),
(67, '5.3.004 Field Training Program', 'policies/5.3.004 Field Training Program.pdf', 'policies/text/5.3.004 Field Training Program.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(68, '6.1.002 Management Information System', 'policies/6.1.002 Management Information System.pdf', 'policies/text/6.1.002 Management Information System.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(69, '6.2.002 Daily Records Reports', 'policies/6.2.002 Daily Records Reports.pdf', 'policies/text/6.2.002 Daily Records Reports.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(70, '6.3.004 NCIC and VCIN', 'policies/6.3.004 NCIC and VCIN.pdf', 'policies/text/6.3.004 NCIC and VCIN.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(71, '6.4.003 Research Projects and Inmate Participation', 'policies/6.4.003 Research Projects and Inmate Participation.pdf', 'policies/text/6.4.003 Research Projects and Inmate Participation.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(72, '6.5.006 Email, Internet Access and Social Media', 'policies/6.5.006 Email, Internet Access and Social Media.pdf', 'policies/text/6.5.006 Email, Internet Access and Social Media.txt', '2025-02-25 21:46:40', '2025-02-25 21:46:40'),
(73, '7.1.004 Jail Record Management', 'policies/7.1.004 Jail Record Management.pdf', 'policies/text/7.1.004 Jail Record Management.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(74, '7.2.004 Jail Time Computation', 'policies/7.2.004 Jail Time Computation.pdf', 'policies/text/7.2.004 Jail Time Computation.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(75, '7.3.004 Local Inmate Data System', 'policies/7.3.004 Local Inmate Data System.pdf', 'policies/text/7.3.004 Local Inmate Data System.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(76, '7.4.002 Jail Contract Bed Program', 'policies/7.4.002 Jail Contract Bed Program.pdf', 'policies/text/7.4.002 Jail Contract Bed Program.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(77, '8.1.008 Inmate Housing Area', 'policies/8.1.008 Inmate Housing Area.pdf', 'policies/text/8.1.008 Inmate Housing Area.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(78, '8.2.003 Emergency Generator', 'policies/8.2.003 Emergency Generator.pdf', 'policies/text/8.2.003 Emergency Generator.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(79, '8.3.003 Vermin Pest Control', 'policies/8.3.003 Vermin Pest Control.pdf', 'policies/text/8.3.003 Vermin Pest Control.txt', '2025-02-25 21:46:41', '2025-02-25 21:46:41'),
(80, '8.4.003 Preventive Maintenance Facility Maintenance Program', 'policies/8.4.003 Preventive Maintenance Facility Maintenance Program.pdf', 'policies/text/8.4.003 Preventive Maintenance Facility Maintenance Program.txt', '2025-02-25 21:46:42', '2025-02-25 21:46:42'),
(81, '8.5.005 Inmate Environment Conditions', 'policies/8.5.005 Inmate Environment Conditions.pdf', 'policies/text/8.5.005 Inmate Environment Conditions.txt', '2025-02-25 21:46:42', '2025-02-25 21:46:42'),
(82, '8.6.005 Disabled Staff and Visitors', 'policies/8.6.005 Disabled Staff and Visitors.pdf', 'policies/text/8.6.005 Disabled Staff and Visitors.txt', '2025-02-25 21:46:42', '2025-02-25 21:46:42'),
(83, '8.7.000 Lockout Tagout Procedures', 'policies/8.7.000 Lockout Tagout Procedures.pdf', 'policies/text/8.7.000 Lockout Tagout Procedures.txt', '2025-02-25 21:46:42', '2025-02-25 21:46:42'),
(84, '8.8.000 Water Tower', 'policies/8.8.000 Water Tower.pdf', 'policies/text/8.8.000 Water Tower.txt', '2025-02-25 21:46:42', '2025-02-25 21:46:42'),
(85, '8.9.005 Staff and Visitor Areas', 'policies/8.9.005 Staff and Visitor Areas.pdf', 'policies/text/8.9.005 Staff and Visitor Areas.txt', '2025-02-25 21:46:43', '2025-02-25 21:46:43'),
(86, '9.1.003 Compliance with Fire Safety Codes', 'policies/9.1.003 Compliance with Fire Safety Codes.pdf', 'policies/text/9.1.003 Compliance with Fire Safety Codes.txt', '2025-02-25 21:46:43', '2025-02-25 21:46:43'),
(87, '9.2.000 Chemical Control', 'policies/9.2.000 Chemical Control.pdf', 'policies/text/9.2.000 Chemical Control.txt', '2025-02-25 21:46:43', '2025-02-25 21:46:43'),
(88, '9.3.001 Safety and Sanitation Inspections', 'policies/9.3.001 Safety and Sanitation Inspections.pdf', 'policies/text/9.3.001 Safety and Sanitation Inspections.txt', '2025-02-25 21:46:43', '2025-02-25 21:46:43'),
(89, '9.4.001 Facility Housekeeping', 'policies/9.4.001 Facility Housekeeping.pdf', 'policies/text/9.4.001 Facility Housekeeping.txt', '2025-02-25 21:46:44', '2025-02-25 21:46:44'),
(90, '9.5.001 Liquid and Solid Waste Disposal', 'policies/9.5.001 Liquid and Solid Waste Disposal.pdf', 'policies/text/9.5.001 Liquid and Solid Waste Disposal.txt', '2025-02-25 21:46:44', '2025-02-25 21:46:44'),
(91, '9.6.002 Inmate Personal Hygiene', 'policies/9.6.002 Inmate Personal Hygiene.pdf', 'policies/text/9.6.002 Inmate Personal Hygiene.txt', '2025-02-25 21:46:44', '2025-02-25 21:46:44'),
(92, '10.1.004 Control Centers', 'policies/10.1.004 Control Centers.pdf', 'policies/text/10.1.004 Control Centers.txt', '2025-02-25 21:47:02', '2025-02-25 21:47:02'),
(93, '10.2.005 Radio Procedures', 'policies/10.2.005 Radio Procedures.pdf', 'policies/text/10.2.005 Radio Procedures.txt', '2025-02-25 21:47:02', '2025-02-25 21:47:02'),
(94, '10.3.003 Inmate Movement', 'policies/10.3.003 Inmate Movement.pdf', 'policies/text/10.3.003 Inmate Movement.txt', '2025-02-25 21:47:02', '2025-02-25 21:47:02'),
(95, '10.04.006 Inmate Supervision', 'policies/10.04.006 Inmate Supervision.pdf', 'policies/text/10.04.006 Inmate Supervision.txt', '2025-02-25 21:47:02', '2025-02-25 21:47:02'),
(96, '10.5.002 Logs and Reports', 'policies/10.5.002 Logs and Reports.pdf', 'policies/text/10.5.002 Logs and Reports.txt', '2025-02-25 21:47:03', '2025-02-25 21:47:03'),
(97, '10.6.001 Staff and Visitor Identification', 'policies/10.6.001 Staff and Visitor Identification.pdf', 'policies/text/10.6.001 Staff and Visitor Identification.txt', '2025-02-25 21:47:03', '2025-02-25 21:47:03'),
(98, '10.7.005 Inmate Counts', 'policies/10.7.005 Inmate Counts.pdf', 'policies/text/10.7.005 Inmate Counts.txt', '2025-02-25 21:47:03', '2025-02-25 21:47:03'),
(99, '10.8.006 Contraband Control', 'policies/10.8.006 Contraband Control.pdf', 'policies/text/10.8.006 Contraband Control.txt', '2025-02-25 21:47:04', '2025-02-25 21:47:04'),
(100, '10.09.009 Physical Searches', 'policies/10.09.009 Physical Searches.pdf', 'policies/text/10.09.009 Physical Searches.txt', '2025-02-25 21:47:05', '2025-02-25 21:47:05'),
(101, '10.10.007 Use of Force', 'policies/10.10.007 Use of Force.pdf', 'policies/text/10.10.007 Use of Force.txt', '2025-02-25 21:47:07', '2025-02-25 21:47:07'),
(102, '10.11.009 Use of Restraints', 'policies/10.11.009 Use of Restraints.pdf', 'policies/text/10.11.009 Use of Restraints.txt', '2025-02-25 21:47:07', '2025-02-25 21:47:07'),
(103, '10.12.006 Key Control', 'policies/10.12.006 Key Control.pdf', 'policies/text/10.12.006 Key Control.txt', '2025-02-25 21:47:08', '2025-02-25 21:47:08'),
(104, '10.13.004 Tool Control', 'policies/10.13.004 Tool Control.pdf', 'policies/text/10.13.004 Tool Control.txt', '2025-02-25 21:47:08', '2025-02-25 21:47:08'),
(105, '10.14.001 Inmate Line-Up', 'policies/10.14.001 Inmate Line-Up.pdf', 'policies/text/10.14.001 Inmate Line-Up.txt', '2025-02-25 21:47:08', '2025-02-25 21:47:08'),
(106, '10.15.008 Inmate Death Notification of Next of Kin', 'policies/10.15.008 Inmate Death Notification of Next of Kin.pdf', 'policies/text/10.15.008 Inmate Death Notification of Next of Kin.txt', '2025-02-25 21:47:09', '2025-02-25 21:47:09'),
(107, '10.16.001 Receipt of Court Clothing', 'policies/10.16.001 Receipt of Court Clothing.pdf', 'policies/text/10.16.001 Receipt of Court Clothing.txt', '2025-02-25 21:47:09', '2025-02-25 21:47:09'),
(108, '10.17.003 Perimeter Security', 'policies/10.17.003 Perimeter Security.pdf', 'policies/text/10.17.003 Perimeter Security.txt', '2025-02-25 21:47:09', '2025-02-25 21:47:09'),
(109, '10.18.003 Facility Shakedowns', 'policies/10.18.003 Facility Shakedowns.pdf', 'policies/text/10.18.003 Facility Shakedowns.txt', '2025-02-25 21:47:09', '2025-02-25 21:47:09'),
(110, '10.19.011 Inmate Discipline', 'policies/10.19.011 Inmate Discipline.pdf', 'policies/text/10.19.011 Inmate Discipline.txt', '2025-02-25 21:47:10', '2025-02-25 21:47:10'),
(111, '10.20.004 Security Inspections', 'policies/10.20.004 Security Inspections.pdf', 'policies/text/10.20.004 Security Inspections.txt', '2025-02-25 21:47:11', '2025-02-25 21:47:11'),
(112, '10.21.004 Preservation of Evidence', 'policies/10.21.004 Preservation of Evidence.pdf', 'policies/text/10.21.004 Preservation of Evidence.txt', '2025-02-25 21:47:11', '2025-02-25 21:47:11'),
(113, '10.22.004 Vehicle Operations', 'policies/10.22.004 Vehicle Operations.pdf', 'policies/text/10.22.004 Vehicle Operations.txt', '2025-02-25 21:47:11', '2025-02-25 21:47:11'),
(114, '10.23.003 Federal Prisoners', 'policies/10.23.003 Federal Prisoners.pdf', 'policies/text/10.23.003 Federal Prisoners.txt', '2025-02-25 21:47:11', '2025-02-25 21:47:11'),
(115, '10.24.004 Criteria for Accepting Inmates from other Jurisdictions', 'policies/10.24.004 Criteria for Accepting Inmates from other Jurisdictions.pdf', 'policies/text/10.24.004 Criteria for Accepting Inmates from other Jurisdictions.txt', '2025-02-25 21:47:12', '2025-02-25 21:47:12'),
(116, '10.25.006 Incarceration of Juveniles', 'policies/10.25.006 Incarceration of Juveniles.pdf', 'policies/text/10.25.006 Incarceration of Juveniles.txt', '2025-02-25 21:47:13', '2025-02-25 21:47:13'),
(117, '10.26.000 Staff Searches', 'policies/10.26.000 Staff Searches.pdf', 'policies/text/10.26.000 Staff Searches.txt', '2025-02-25 21:47:13', '2025-02-25 21:47:13'),
(118, '10.27.000 Gang Security Threat Group', 'policies/10.27.000 Gang Security Threat Group.pdf', 'policies/text/10.27.000 Gang Security Threat Group.txt', '2025-02-25 21:47:13', '2025-02-25 21:47:13'),
(119, '11.1.002 Sexual Misconduct', 'policies/11.1.002 Sexual Misconduct.pdf', 'policies/text/11.1.002 Sexual Misconduct.txt', '2025-02-25 21:47:13', '2025-02-25 21:47:13'),
(120, '11.2.002 Sexual Assault Response Team (SART) Protocols', 'policies/11.2.002 Sexual Assault Response Team (SART) Protocols.pdf', 'policies/text/11.2.002 Sexual Assault Response Team (SART) Protocols.txt', '2025-02-25 21:47:13', '2025-02-25 21:47:13'),
(121, '12.1.006 Food Service Operations', 'policies/12.1.006 Food Service Operations.pdf', 'policies/text/12.1.006 Food Service Operations.txt', '2025-02-25 21:47:14', '2025-02-25 21:47:14'),
(122, '12.2.001 Facility Dietary Allowance and Menu Evaluations', 'policies/12.2.001 Facility Dietary Allowance and Menu Evaluations.pdf', 'policies/text/12.2.001 Facility Dietary Allowance and Menu Evaluations.txt', '2025-02-25 21:47:14', '2025-02-25 21:47:14'),
(123, '12.03.004 Special Diets', 'policies/12.03.004 Special Diets.pdf', 'policies/text/12.03.004 Special Diets.txt', '2025-02-25 21:47:14', '2025-02-25 21:47:14'),
(124, '12.4.001 Food Service Employee Health and Safety Standards', 'policies/12.4.001 Food Service Employee Health and Safety Standards.pdf', 'policies/text/12.4.001 Food Service Employee Health and Safety Standards.txt', '2025-02-25 21:47:15', '2025-02-25 21:47:15'),
(125, '12.5.004 Food Preparation and Delivery', 'policies/12.5.004 Food Preparation and Delivery.pdf', 'policies/text/12.5.004 Food Preparation and Delivery.txt', '2025-02-25 21:47:15', '2025-02-25 21:47:15'),
(127, '13.2.001 Contaminated Laundry', 'policies/13.2.001 Contaminated Laundry.pdf', 'policies/text/13.2.001 Contaminated Laundry.txt', '2025-02-25 21:47:15', '2025-02-25 21:47:15'),
(129, '14.1.007 General Warehouse Operations', 'policies/14.1.007 General Warehouse Operations.pdf', 'policies/text/14.1.007 General Warehouse Operations.txt', '2025-02-25 21:47:16', '2025-02-25 21:47:16'),
(130, '14.2.006 Canteen Operations', 'policies/14.2.006 Canteen Operations.pdf', 'policies/text/14.2.006 Canteen Operations.txt', '2025-02-25 21:47:16', '2025-02-25 21:47:16'),
(131, '15.1.009 Health Care Services', 'policies/15.1.009 Health Care Services.pdf', 'policies/text/15.1.009 Health Care Services.txt', '2025-02-25 21:47:17', '2025-02-25 21:47:17'),
(132, '15.03.005 Suicide Prevention', 'policies/15.03.005 Suicide Prevention.pdf', 'policies/text/15.03.005 Suicide Prevention.txt', '2025-02-25 21:47:17', '2025-02-25 21:47:17'),
(133, '15.07.005 Mental Health Services', 'policies/15.07.005 Mental Health Services.pdf', 'policies/text/15.07.005 Mental Health Services.txt', '2025-02-25 21:47:17', '2025-02-25 21:47:17'),
(134, '16.01.005 Inmate Rights and Grievances', 'policies/16.01.005 Inmate Rights and Grievances.pdf', 'policies/text/16.01.005 Inmate Rights and Grievances.txt', '2025-02-25 21:47:17', '2025-02-25 21:47:17'),
(135, '17.1.008 Emergency Plan', 'policies/17.1.008 Emergency Plan.pdf', 'policies/text/17.1.008 Emergency Plan.txt', '2025-02-25 21:47:20', '2025-02-25 21:47:20'),
(136, '17.2.001 Fire Emergency Plan', 'policies/17.2.001 Fire Emergency Plan.pdf', 'policies/text/17.2.001 Fire Emergency Plan.txt', '2025-02-25 21:47:21', '2025-02-25 21:47:21'),
(137, '17.3.001 Situational Response Plans', 'policies/17.3.001 Situational Response Plans.pdf', 'policies/text/17.3.001 Situational Response Plans.txt', '2025-02-25 21:47:21', '2025-02-25 21:47:21'),
(138, '17.04.001 Disaster Recovery Plan', 'policies/17.04.001 Disaster Recovery Plan.pdf', 'policies/text/17.04.001 Disaster Recovery Plan.txt', '2025-02-25 21:47:21', '2025-02-25 21:47:21'),
(139, '18.01.011 Inmate Mail', 'policies/18.01.011 Inmate Mail.pdf', 'policies/text/18.01.011 Inmate Mail.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(140, '18.02.002 Inmate Telephone Access', 'policies/18.02.002 Inmate Telephone Access.pdf', 'policies/text/18.02.002 Inmate Telephone Access.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(141, '18.03.008 Visitation', 'policies/18.03.008 Visitation.pdf', 'policies/text/18.03.008 Visitation.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(142, '18.04.00 Inmate Tablets', 'policies/18.04.00 Inmate Tablets.pdf', 'policies/text/18.04.00 Inmate Tablets.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(143, '18.5.000 Inmate Handbook', 'policies/18.5.000 Inmate Handbook.pdf', 'policies/text/18.5.000 Inmate Handbook.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(144, '19.01.005 Sally Port Operations', 'policies/19.01.005 Sally Port Operations.pdf', 'policies/text/19.01.005 Sally Port Operations.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(145, '19.02.001 Use of Alcohol Testing Equipment', 'policies/19.02.001 Use of Alcohol Testing Equipment.pdf', 'policies/text/19.02.001 Use of Alcohol Testing Equipment.txt', '2025-02-25 21:47:22', '2025-02-25 21:47:22'),
(146, '19.03.001 Inmate Commitment Information', 'policies/19.03.001 Inmate Commitment Information.pdf', 'policies/text/19.03.001 Inmate Commitment Information.txt', '2025-02-25 21:47:23', '2025-02-25 21:47:23'),
(147, '19.04.008 Booking of Newly Received Inmates', 'policies/19.04.008 Booking of Newly Received Inmates.pdf', 'policies/text/19.04.008 Booking of Newly Received Inmates.txt', '2025-02-25 21:47:23', '2025-02-25 21:47:23'),
(148, '19.05.005 Intake Medical Screening', 'policies/19.05.005 Intake Medical Screening.pdf', 'policies/text/19.05.005 Intake Medical Screening.txt', '2025-02-25 21:47:23', '2025-02-25 21:47:23'),
(149, '19.06.002 Withdrawal Protocol and Holding Cells', 'policies/19.06.002 Withdrawal Protocol and Holding Cells.pdf', 'policies/text/19.06.002 Withdrawal Protocol and Holding Cells.txt', '2025-02-25 21:47:23', '2025-02-25 21:47:23'),
(150, '19.07.005 Inmate Personal Property', 'policies/19.07.005 Inmate Personal Property.pdf', 'policies/text/19.07.005 Inmate Personal Property.txt', '2025-02-25 21:47:24', '2025-02-25 21:47:24'),
(151, '19.08.005 Inmate Identification', 'policies/19.08.005 Inmate Identification.pdf', 'policies/text/19.08.005 Inmate Identification.txt', '2025-02-25 21:47:24', '2025-02-25 21:47:24'),
(152, '19.09.005 Inmate Transports', 'policies/19.09.005 Inmate Transports.pdf', 'policies/text/19.09.005 Inmate Transports.txt', '2025-02-25 21:47:24', '2025-02-25 21:47:24'),
(153, '19.10.006 Inmate Release', 'policies/19.10.006 Inmate Release.pdf', 'policies/text/19.10.006 Inmate Release.txt', '2025-02-25 21:47:25', '2025-02-25 21:47:25'),
(154, '19.11.002 Video Arraignment Hearings', 'policies/19.11.002 Video Arraignment Hearings.pdf', 'policies/text/19.11.002 Video Arraignment Hearings.txt', '2025-02-25 21:47:25', '2025-02-25 21:47:25'),
(155, '19.12.004 Inmate Handbook', 'policies/19.12.004 Inmate Handbook.pdf', 'policies/text/19.12.004 Inmate Handbook.txt', '2025-02-25 21:47:25', '2025-02-25 21:47:25'),
(156, '19.14.001 Victim Notification', 'policies/19.14.001 Victim Notification.pdf', 'policies/text/19.14.001 Victim Notification.txt', '2025-02-25 21:47:25', '2025-02-25 21:47:25'),
(157, '20.01.010 Classification', 'policies/20.01.010 Classification.pdf', 'policies/text/20.01.010 Classification.txt', '2025-02-25 21:47:39', '2025-02-25 21:47:39'),
(158, '20.2.002 At-Risk Inmate Populations', 'policies/20.2.002 At-Risk Inmate Populations.pdf', 'policies/text/20.2.002 At-Risk Inmate Populations.txt', '2025-02-25 21:47:40', '2025-02-25 21:47:40'),
(159, '20.03.012 Restrictive Housing', 'policies/20.03.012 Restrictive Housing.pdf', 'policies/text/20.03.012 Restrictive Housing.txt', '2025-02-25 21:47:41', '2025-02-25 21:47:41'),
(160, '21.01.004 Inmate Workforce Program', 'policies/21.01.004 Inmate Workforce Program.pdf', 'policies/text/21.01.004 Inmate Workforce Program.txt', '2025-02-25 21:47:42', '2025-02-25 21:47:42'),
(161, '21.02.002 Community Service Program', 'policies/21.02.002 Community Service Program.pdf', 'policies/text/21.02.002 Community Service Program.txt', '2025-02-25 21:47:42', '2025-02-25 21:47:42'),
(162, '21.03.000 Barbershop Procedures', 'policies/21.03.000 Barbershop Procedures.pdf', 'policies/text/21.03.000 Barbershop Procedures.txt', '2025-02-25 21:47:42', '2025-02-25 21:47:42'),
(163, '22.1.001 Pre Release Center', 'policies/22.1.001 Pre Release Center.pdf', 'policies/text/22.1.001 Pre Release Center.txt', '2025-02-25 21:47:42', '2025-02-25 21:47:42'),
(164, '22.02.002 Pre-Release Center Intakes', 'policies/22.02.002 Pre-Release Center Intakes.pdf', 'policies/text/22.02.002 Pre-Release Center Intakes.txt', '2025-02-25 21:47:43', '2025-02-25 21:47:43'),
(165, '22.3.004 Pre Release Emergency Procedures', 'policies/22.3.004 Pre Release Emergency Procedures.pdf', 'policies/text/22.3.004 Pre Release Emergency Procedures.txt', '2025-02-25 21:47:43', '2025-02-25 21:47:43'),
(166, '22.4.001 Pre-Release Center Sally Port Operations', 'policies/22.4.001 Pre-Release Center Sally Port Operations.pdf', 'policies/text/22.4.001 Pre-Release Center Sally Port Operations.txt', '2025-02-25 21:47:43', '2025-02-25 21:47:43'),
(167, '22.5.001 Pre-Release Center Food Service', 'policies/22.5.001 Pre-Release Center Food Service.pdf', 'policies/text/22.5.001 Pre-Release Center Food Service.txt', '2025-02-25 21:47:43', '2025-02-25 21:47:43'),
(168, '22.6.005 Work, Education and Rehabilitative Release Home Electronic Monitoring', 'policies/22.6.005 Work, Education and Rehabilitative Release Home Electronic Monitoring.pdf', 'policies/text/22.6.005 Work, Education and Rehabilitative Release Home Electronic Monitoring.txt', '2025-02-25 21:47:44', '2025-02-25 21:47:44'),
(169, '22.7.001 Pre-Release Center Perimeter Security', 'policies/22.7.001 Pre-Release Center Perimeter Security.pdf', 'policies/text/22.7.001 Pre-Release Center Perimeter Security.txt', '2025-02-25 21:47:45', '2025-02-25 21:47:45'),
(170, '22.08.001 Weekenders', 'policies/22.08.001 Weekenders.pdf', 'policies/text/22.08.001 Weekenders.txt', '2025-02-25 21:47:45', '2025-02-25 21:47:45'),
(171, '22.09.001 Federal Bureau of Prisons Work, Education, Rehabilitation Release Home Electronic Monitoring', 'policies/22.09.001 Federal Bureau of Prisons Work, Education, Rehabilitation Release Home Electronic Monitoring.pdf', 'policies/text/22.09.001 Federal Bureau of Prisons Work, Education, Rehabilitation Release Home Electronic Monitoring.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(172, '22.10.000 Community Reentry Work Program', 'policies/22.10.000 Community Reentry Work Program.pdf', 'policies/text/22.10.000 Community Reentry Work Program.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(173, '23.1.008 Inmate Programs and Services', 'policies/23.1.008 Inmate Programs and Services.pdf', 'policies/text/23.1.008 Inmate Programs and Services.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(174, '23.2.007 Inmate Religious Programs', 'policies/23.2.007 Inmate Religious Programs.pdf', 'policies/text/23.2.007 Inmate Religious Programs.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(175, '23.3.004 Inmate Recreational Activities', 'policies/23.3.004 Inmate Recreational Activities.pdf', 'policies/text/23.3.004 Inmate Recreational Activities.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(176, '23.4.001 Inmate Education Program', 'policies/23.4.001 Inmate Education Program.pdf', 'policies/text/23.4.001 Inmate Education Program.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(177, '23.5.008 Library Services', 'policies/23.5.008 Library Services.pdf', 'policies/text/23.5.008 Library Services.txt', '2025-02-25 21:47:49', '2025-02-25 21:47:49'),
(178, '23.6.003 Treatment Programs and Case Management', 'policies/23.6.003 Treatment Programs and Case Management.pdf', 'policies/text/23.6.003 Treatment Programs and Case Management.txt', '2025-02-25 21:47:50', '2025-02-25 21:47:50'),
(179, '23.7 Barbershop Procedures', 'policies/23.7 Barbershop Procedures.pdf', 'policies/text/23.7 Barbershop Procedures.txt', '2025-02-25 21:47:50', '2025-02-25 21:47:50'),
(180, '24.01.002 Release Preparation', 'policies/24.01.002 Release Preparation.pdf', 'policies/text/24.01.002 Release Preparation.txt', '2025-02-25 21:47:50', '2025-02-25 21:47:50'),
(181, '25.1.006 Volunteers', 'policies/25.1.006 Volunteers.pdf', 'policies/text/25.1.006 Volunteers.txt', '2025-02-25 21:47:51', '2025-02-25 21:47:51'),
(182, '25.2.000 Internship Program', 'policies/25.2.000 Internship Program.pdf', 'policies/text/25.2.000 Internship Program.txt', '2025-02-25 21:47:51', '2025-02-25 21:47:51'),
(183, '26.01.000 Post-issuance Compliance for Tax-exempt Bond Issues', 'policies/26.01.000 Post-issuance Compliance for Tax-exempt Bond Issues.pdf', 'policies/text/26.01.000 Post-issuance Compliance for Tax-exempt Bond Issues.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(184, '26.02.000 Audit Committee', 'policies/26.02.000 Audit Committee.pdf', 'policies/text/26.02.000 Audit Committee.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(185, '26.03.000 Capital Improvement Plan', 'policies/26.03.000 Capital Improvement Plan.pdf', 'policies/text/26.03.000 Capital Improvement Plan.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(186, '26.04.000 Debt Management', 'policies/26.04.000 Debt Management.pdf', 'policies/text/26.04.000 Debt Management.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(187, '26.5.002 Late Per Diem Payments from Member Jurisdictions', 'policies/26.5.002 Late Per Diem Payments from Member Jurisdictions.pdf', 'policies/text/26.5.002 Late Per Diem Payments from Member Jurisdictions.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(188, '26.06.000 Accounting and Auditing Complaints', 'policies/26.06.000 Accounting and Auditing Complaints.pdf', 'policies/text/26.06.000 Accounting and Auditing Complaints.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(189, '26.07.002 Riverside Regional Jail Authority Fund Policy', 'policies/26.07.002 Riverside Regional Jail Authority Fund Policy.pdf', 'policies/text/26.07.002 Riverside Regional Jail Authority Fund Policy.txt', '2025-02-25 21:47:52', '2025-02-25 21:47:52'),
(190, 'Accreditation Manager', 'policies/Accreditation Manager.pdf', 'policies/text/Accreditation Manager.txt', '2025-02-25 21:48:07', '2025-02-25 21:48:07'),
(191, 'Booking LieutenantOLD', 'policies/Booking LieutenantOLD.pdf', 'policies/text/Booking LieutenantOLD.txt', '2025-02-25 21:48:07', '2025-02-25 21:48:07'),
(192, 'Booking Officer Pre-Release', 'policies/Booking Officer Pre-Release.pdf', 'policies/text/Booking Officer Pre-Release.txt', '2025-02-25 21:48:07', '2025-02-25 21:48:07'),
(193, 'Booking Officer', 'policies/Booking Officer.pdf', 'policies/text/Booking Officer.txt', '2025-02-25 21:48:07', '2025-02-25 21:48:07'),
(194, 'Booking SergeantOLD', 'policies/Booking SergeantOLD.pdf', 'policies/text/Booking SergeantOLD.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(195, 'Canteen Officer', 'policies/Canteen Officer.pdf', 'policies/text/Canteen Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(196, 'Canteen Supervisor', 'policies/Canteen Supervisor.pdf', 'policies/text/Canteen Supervisor.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(197, 'Classification Housing Unit Manager', 'policies/Classification Housing Unit Manager.pdf', 'policies/text/Classification Housing Unit Manager.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(198, 'Classification Housing Unit Officer', 'policies/Classification Housing Unit Officer.pdf', 'policies/text/Classification Housing Unit Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(199, 'Classification Housing Unit SergeantOLD', 'policies/Classification Housing Unit SergeantOLD.pdf', 'policies/text/Classification Housing Unit SergeantOLD.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(200, 'Classification Officer', 'policies/Classification Officer.pdf', 'policies/text/Classification Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(201, 'Community Service Detail Officer', 'policies/Community Service Detail Officer.pdf', 'policies/text/Community Service Detail Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(202, 'Core Housekeeping Officer', 'policies/Core Housekeeping Officer.pdf', 'policies/text/Core Housekeeping Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(203, 'Core Supervisor', 'policies/Core Supervisor.pdf', 'policies/text/Core Supervisor.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(204, 'Escort Officer', 'policies/Escort Officer.pdf', 'policies/text/Escort Officer.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(205, 'Fire Command Center', 'policies/Fire Command Center.pdf', 'policies/text/Fire Command Center.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(206, 'Hospital Detail', 'policies/Hospital Detail.pdf', 'policies/text/Hospital Detail.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(207, 'Housekeeping LieutenantOLD', 'policies/Housekeeping LieutenantOLD.pdf', 'policies/text/Housekeeping LieutenantOLD.txt', '2025-02-25 21:48:08', '2025-02-25 21:48:08'),
(208, 'Housing Unit SergeantOLD', 'policies/Housing Unit SergeantOLD.pdf', 'policies/text/Housing Unit SergeantOLD.txt', '2025-02-25 21:48:09', '2025-02-25 21:48:09'),
(209, 'ID BADGES', 'policies/ID BADGES.pdf', 'policies/text/ID BADGES.txt', '2025-02-25 21:48:09', '2025-02-25 21:48:09'),
(210, 'Inmate Activities Coordinator', 'policies/Inmate Activities Coordinator.pdf', 'policies/text/Inmate Activities Coordinator.txt', '2025-02-25 21:48:09', '2025-02-25 21:48:09'),
(211, 'Inmate Handbook 7.15.24', 'policies/Inmate Handbook 7.15.24.pdf', 'policies/text/Inmate Handbook 7.15.24.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(212, 'Inmate Work Force Supervisor', 'policies/Inmate Work Force Supervisor.pdf', 'policies/text/Inmate Work Force Supervisor.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(213, 'Internal Affairs', 'policies/Internal Affairs.pdf', 'policies/text/Internal Affairs.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(214, 'Juvenile Housing Officer', 'policies/Juvenile Housing Officer.pdf', 'policies/text/Juvenile Housing Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(215, 'Kitchen Officer', 'policies/Kitchen Officer.pdf', 'policies/text/Kitchen Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(216, 'Landscape Detail Officer', 'policies/Landscape Detail Officer.pdf', 'policies/text/Landscape Detail Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(217, 'Laundry Officer', 'policies/Laundry Officer.pdf', 'policies/text/Laundry Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(218, 'Library Officer', 'policies/Library Officer.pdf', 'policies/text/Library Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(219, 'Loading Dock Control Officer', 'policies/Loading Dock Control Officer.pdf', 'policies/text/Loading Dock Control Officer.txt', '2025-02-25 21:48:12', '2025-02-25 21:48:12'),
(220, 'Lobby Officer', 'policies/Lobby Officer.pdf', 'policies/text/Lobby Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(221, 'Mail Room Officer', 'policies/Mail Room Officer.pdf', 'policies/text/Mail Room Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(222, 'Major Hearings Chairperson', 'policies/Major Hearings Chairperson.pdf', 'policies/text/Major Hearings Chairperson.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(223, 'Master Control Officer', 'policies/Master Control Officer.pdf', 'policies/text/Master Control Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(224, 'Master Control SupervisorOLD', 'policies/Master Control SupervisorOLD.pdf', 'policies/text/Master Control SupervisorOLD.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(225, 'Medical Housing Unit Officer', 'policies/Medical Housing Unit Officer.pdf', 'policies/text/Medical Housing Unit Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(226, 'Medical Unit Control Officer', 'policies/Medical Unit Control Officer.pdf', 'policies/text/Medical Unit Control Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(227, 'Medical Unit Security Officer', 'policies/Medical Unit Security Officer.pdf', 'policies/text/Medical Unit Security Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(228, 'Movement Control Officer', 'policies/Movement Control Officer.pdf', 'policies/text/Movement Control Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(229, 'Perimeter Security Officer Pre-Release', 'policies/Perimeter Security Officer Pre-Release.pdf', 'policies/text/Perimeter Security Officer Pre-Release.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(230, 'Perimeter Security Officer', 'policies/Perimeter Security Officer.pdf', 'policies/text/Perimeter Security Officer.txt', '2025-02-25 21:48:13', '2025-02-25 21:48:13'),
(231, 'Pod Officer', 'policies/Pod Officer.pdf', 'policies/text/Pod Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(232, 'Post Orders', 'policies/Post Orders.pdf', 'policies/text/Post Orders.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(233, 'Primary Control', 'policies/Primary Control.pdf', 'policies/text/Primary Control.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(234, 'Professional Visitation Officer', 'policies/Professional Visitation Officer.pdf', 'policies/text/Professional Visitation Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(235, 'Programs Manager', 'policies/Programs Manager.pdf', 'policies/text/Programs Manager.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(236, 'Property Officer Pre-Release', 'policies/Property Officer Pre-Release.pdf', 'policies/text/Property Officer Pre-Release.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(237, 'Property Officer', 'policies/Property Officer.pdf', 'policies/text/Property Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(238, 'Property Supervisor', 'policies/Property Supervisor.pdf', 'policies/text/Property Supervisor.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(239, 'Records Clerk Pre-Release', 'policies/Records Clerk Pre-Release.pdf', 'policies/text/Records Clerk Pre-Release.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(240, 'Records Supervisor', 'policies/Records Supervisor.pdf', 'policies/text/Records Supervisor.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(241, 'Special Management Control Officer', 'policies/Special Management Control Officer.pdf', 'policies/text/Special Management Control Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(242, 'Special Management Pod Officer', 'policies/Special Management Pod Officer.pdf', 'policies/text/Special Management Pod Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(243, 'Special Management SupervisorOLD', 'policies/Special Management SupervisorOLD.pdf', 'policies/text/Special Management SupervisorOLD.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(244, 'Training Officer', 'policies/Training Officer.pdf', 'policies/text/Training Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(245, 'Training SupervisorOLD', 'policies/Training SupervisorOLD.pdf', 'policies/text/Training SupervisorOLD.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(246, 'Transfer Release Officer', 'policies/Transfer Release Officer.pdf', 'policies/text/Transfer Release Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(247, 'Transportation Officer', 'policies/Transportation Officer.pdf', 'policies/text/Transportation Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(248, 'Transportation SupervisorOLD', 'policies/Transportation SupervisorOLD.pdf', 'policies/text/Transportation SupervisorOLD.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(249, 'Unit Control Officer', 'policies/Unit Control Officer.pdf', 'policies/text/Unit Control Officer.txt', '2025-02-25 21:48:14', '2025-02-25 21:48:14'),
(250, 'Video Arraignment Officer', 'policies/Video Arraignment Officer.pdf', 'policies/text/Video Arraignment Officer.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(251, 'Watch Commander Officer', 'policies/Watch Commander Officer.pdf', 'policies/text/Watch Commander Officer.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(252, 'Watch Commander Pre-Release', 'policies/Watch Commander Pre-Release.pdf', 'policies/text/Watch Commander Pre-Release.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(253, 'Watch Commander Sergeant', 'policies/Watch Commander Sergeant.pdf', 'policies/text/Watch Commander Sergeant.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(254, 'Watch Commander', 'policies/Watch Commander.pdf', 'policies/text/Watch Commander.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(255, 'Work Release Officer', 'policies/Work Release Officer.pdf', 'policies/text/Work Release Officer.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(256, 'Workforce Supervisor', 'policies/Workforce Supervisor.pdf', 'policies/text/Workforce Supervisor.txt', '2025-02-25 21:48:15', '2025-02-25 21:48:15'),
(258, '01.26.033 Salary, Benefits and Compensation', 'policies/01.26.033 Salary, Benefits and Compensation.pdf', 'policies/text/01.26.033 Salary, Benefits and Compensation.txt', '2025-03-08 01:04:49', '2025-03-08 01:04:49'),
(259, '13.1 Inmate Clothing and Linen Exchange 3.6.25', 'policies/13.1 Inmate Clothing and Linen Exchange 3.6.25.pdf', 'policies/text/13.1 Inmate Clothing and Linen Exchange 3.6.25.txt', '2025-03-10 18:40:25', '2025-03-10 18:40:25'),
(260, '13.3 Laundry Operations 3.6.25', 'policies/13.3 Laundry Operations 3.6.25.pdf', 'policies/text/13.3 Laundry Operations 3.6.25.txt', '2025-03-10 18:40:43', '2025-03-10 18:40:43'),
(262, '01.18.008 Employee Handbook', 'policies/01.18.008 Employee Handbook.pdf', 'policies/text/01.18.008 Employee Handbook.txt', '2025-05-16 11:02:24', '2025-05-16 11:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section`, `created_at`, `updated_at`) VALUES
(1, 'Housing Unit 1', NULL, NULL),
(2, 'Housing Unit 2', NULL, NULL),
(3, 'Housing Unit 3', NULL, NULL),
(4, 'Housing Unit 4', NULL, NULL),
(5, 'Housing Unit 5', NULL, NULL),
(6, 'Housing Unit 6', NULL, NULL),
(7, 'Booking', NULL, NULL),
(8, 'Administration', NULL, NULL),
(9, 'Medical Housing', NULL, NULL),
(10, 'Classification', NULL, NULL),
(11, 'Records', NULL, NULL),
(12, 'Maintenance', NULL, NULL),
(13, 'Housekeeping', NULL, NULL),
(14, 'HUM', NULL, NULL),
(15, 'Programs', NULL, NULL),
(16, 'SEC', NULL, NULL),
(17, 'C&T', NULL, NULL),
(18, 'Warehouse', NULL, NULL),
(19, 'Compliance', NULL, NULL),
(20, 'Property', NULL, NULL),
(21, 'SHU-A', NULL, NULL),
(22, 'SHU-B', NULL, NULL),
(23, 'Movement', NULL, NULL),
(24, 'Captains Hall', NULL, NULL),
(25, 'OPR', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `phone` tinyint(1) NOT NULL DEFAULT 0,
  `vfm` tinyint(1) NOT NULL DEFAULT 0,
  `vfm30` tinyint(1) NOT NULL DEFAULT 0,
  `vfm_tech` tinyint(1) NOT NULL DEFAULT 0,
  `ics` tinyint(1) NOT NULL DEFAULT 0,
  `policy` tinyint(1) NOT NULL DEFAULT 0,
  `warehouse_role` enum('Warehouse Supervisor','Warehouse Technician','Property','Supervisor','Requestor') DEFAULT 'Requestor',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `password`, `admin`, `phone`, `vfm`, `vfm30`, `vfm_tech`, `ics`, `policy`, `warehouse_role`, `created_at`, `updated_at`) VALUES
(1, 'Tuggle', 'Mark', 'tugglem@rrjva.org', '$2y$12$uYhqB/PAISc9qGm9AHv39e/S2XLMULTXRABb8XsLzB8tEflt05M16', 1, 0, 0, 0, 0, 0, 0, 'Supervisor', NULL, '2025-06-04 17:51:50'),
(6, 'Watson', 'Charles', 'watson.charles@rrjva.org', '$2y$12$mJx8i0iUHGneHv9FwEpO6O8QLyVai2jNdGvuU8G3nGy23dIZAcqoG', 0, 0, 0, 0, 0, 0, 0, 'Warehouse Supervisor', NULL, '2025-04-18 16:10:40'),
(27, 'Feury', 'Lonnie', 'feury.lonnie@rrjva.org', '$2y$12$r5LATwwoyDSMTRHUimROdukaT.YYP9S2j7W3deA9o82ITvy.Qp0Xy', 0, 0, 0, 0, 1, 0, 0, 'Supervisor', NULL, '2025-03-25 20:55:16'),
(28, 'McDaniel', 'Mark', 'mmcdaniel@rrjva.org', '$2y$10$6EjsOs/lMa1oM19Vn5IhdeZlNgPf3tcCMUtRHeWuYmmf5Nq2Zhjb.', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', NULL, NULL),
(29, 'Flexon', 'Tim', 'tflexon@rrjva.org', '$2y$12$/TsQ.iuzeTHz/2hgWWkuZuG5oxhA/KIPmYz1bkA5rhB54x6rxS4oq', 0, 0, 1, 1, 1, 0, 0, 'Supervisor', NULL, '2025-03-03 19:21:31'),
(142, 'Payne', 'Warren', 'payne.warren@rrjva.org', '$2y$12$yjgW7nsZYMqpeMiJYzeuge3IJ4/iI9zo/Xc7v63Kv4yvEYvkID50C', 0, 0, 0, 0, 1, 0, 0, 'Requestor', NULL, NULL),
(144, 'Mears', 'Adam', 'mears.adam@rrjva.org', '$2y$12$g5ZB84gelpttG1kI4oABEueKfegUKPcSuzj2yLc3AfOENvUVS/6oG', 0, 0, 0, 0, 0, 0, 0, 'Warehouse Supervisor', '2025-05-07 15:48:25', '2025-07-08 09:54:18'),
(145, 'Smith', 'Jeffrey', 'smith.jeffrey@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:03:52', '2025-05-07 16:03:52'),
(146, 'Jones', 'Kenyatta', 'jones.kenyatta@rrjva.org', '$2y$12$Zhp8GaViPuHl80utRCQvlev0USjKg3wNiMlDwnD4AdqnNPHxl4zhO', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:05:13', '2025-07-07 12:28:54'),
(147, 'Fotias', 'Princess', 'fotias.princess@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:06:28', '2025-05-07 16:06:28'),
(149, 'Hobbs', 'Jamece', 'jhobbs@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:08:44', '2025-05-07 16:48:07'),
(150, 'LaVigne', 'Joseph', 'lavigne.joseph@rrjva.org', '$2y$12$2fqZNc0XUcIU4TRvvb8kL.RHftA5o2/0OHLU3LPV9Tf8S1wjyVyS6', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:10:08', '2025-07-08 15:43:03'),
(151, 'Mayes', 'Lynnette', 'mayes.lynnette@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:11:21', '2025-05-07 16:11:21'),
(152, 'Jones', 'Charlene', 'jones.charlene@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:49:15', '2025-05-07 16:49:15'),
(153, 'Brown', 'Shanta', 'brown.shanta@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:50:15', '2025-05-07 16:50:15'),
(154, 'Coleman', 'Garry', 'gcoleman@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:51:10', '2025-05-07 16:51:10'),
(155, 'Coleman', 'Babette', 'bcoleman@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:51:56', '2025-05-07 16:51:56'),
(156, 'Spratley', 'Viola', 'spratley.viola@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:53:17', '2025-05-07 16:53:17'),
(157, 'Whirley', 'Stoney', 'whirley.stoney@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:54:08', '2025-05-07 16:54:08'),
(158, 'Trisvan', 'Shakalan', 'trisvan.shakalan@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:55:28', '2025-05-07 16:55:28'),
(159, 'Turner', 'Vicki', 'turner.vicki@rrjva.org', '$2y$12$kFxrC58IuQ1GI2v5yZ/F7O5EZHEUFEwGky58MPm9zsJVP4Qkvld32', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:56:14', '2025-07-07 14:45:31'),
(160, 'Ward', 'Shelia', 'sward@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:57:07', '2025-05-07 16:57:07'),
(161, 'Peterson', 'Kawan', 'peterson.kawan@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:58:04', '2025-05-07 16:58:04'),
(162, 'Reedy', 'Laura', 'REEDY.LAURA@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 16:58:51', '2025-05-07 16:58:51'),
(163, 'Fulton', 'Nicole', 'fultonn@rrjva.org', '$2y$12$BXucSP8/vrZMUAi5DKy1wutm.qUNEdaaG1fH.WajVYnYWQSurn3e6', 0, 0, 0, 0, 0, 0, 0, 'Property', '2025-05-07 17:00:22', '2025-07-08 15:44:18'),
(164, 'Dolan', 'Stacey', 'dolan.stacey@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 17:04:19', '2025-05-07 17:04:19'),
(165, 'Evans', 'Athena', 'evans.athena@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-07 17:05:10', '2025-05-07 17:05:10'),
(166, 'Jenkins', 'Daryon', 'jenkins.daryon@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:24:22', '2025-05-08 13:24:22'),
(167, 'Mason', 'Lakeisha', 'lmason@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:25:13', '2025-05-08 13:25:13'),
(168, 'Mells', 'LaTanya', 'mells.latanya@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:26:00', '2025-05-08 13:26:00'),
(169, 'Brown', 'Ray', 'rbrown@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:26:39', '2025-05-08 13:26:39'),
(170, 'Beasley', 'Montrell', 'beasley.montrell@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:27:30', '2025-05-08 13:27:30'),
(171, 'Brown', 'Bryan', 'brown.bryan@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:28:24', '2025-05-08 13:28:24'),
(172, 'Culver', 'Mark', 'culverm@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:29:11', '2025-05-08 13:29:11'),
(173, 'Greenway', 'Lofton', 'greenway.lofton@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:29:53', '2025-05-08 13:29:53'),
(174, 'Jordan', 'Leon', 'ljordan@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:31:57', '2025-05-08 13:31:57'),
(175, 'Leabough', 'Edward', 'leabough.edward@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:32:51', '2025-05-08 13:32:51'),
(176, 'Nickelberry', 'Raven', 'nickelberry.raven@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:33:39', '2025-05-08 13:33:39'),
(177, 'Puryear', 'Dawn', 'puryear.dawn@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:34:25', '2025-05-08 13:34:25'),
(178, 'Sample', 'Nicholas', 'sample.nicholas@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:35:12', '2025-05-08 13:35:12'),
(179, 'Whitebread', 'Gerald', 'gwhitebread@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:36:09', '2025-05-08 13:36:09'),
(180, 'Augustus', 'Karen', 'augustus.karen@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:37:00', '2025-05-08 13:37:00'),
(181, 'Baines', 'Darrell', 'bainesd@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:38:02', '2025-05-08 13:38:02'),
(182, 'Brewton', 'Nichole', 'brewton.nichole@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:39:16', '2025-05-08 13:39:16'),
(183, 'Brown', 'Damarcus', 'brown.damarcus@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:40:06', '2025-05-08 13:40:06'),
(184, 'Bryant', 'Tammy', 'bryant.tammy@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:41:19', '2025-05-08 13:41:19'),
(185, 'Butler', 'Steven', 'butler.steven@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:42:12', '2025-05-08 13:42:12'),
(186, 'Dabney', 'Jevon', 'dabney.jevon@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:50:10', '2025-05-08 13:50:10'),
(187, 'Dix', 'Jonathan', 'dixj@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:50:54', '2025-05-08 13:50:54'),
(188, 'Eley', 'Takeita', 'eley.takeita@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:51:41', '2025-05-08 13:51:41'),
(189, 'Enos', 'Andrew', 'enos.andrew@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:52:26', '2025-05-08 13:52:26'),
(190, 'Evans', 'Alicia', 'evans.alicia@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:53:17', '2025-05-08 13:53:17'),
(191, 'Ferguson', 'Michael', 'fergusonm@rrjva.org', '$2y$12$IydepP58hQTlueW5U2INFOwL3kLeGXGk.NzWqKNAcrKRwKVTW4pHG', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:57:25', '2025-07-07 15:49:54'),
(192, 'Gregory', 'Timothy', 'gregory.timothy@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:58:34', '2025-05-08 13:58:34'),
(193, 'Halpain', 'Mark', 'halpain.mark@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 13:59:36', '2025-05-08 13:59:36'),
(194, 'Hartsell', 'Dana', 'hartsell.dana@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:00:16', '2025-05-08 14:00:16'),
(195, 'Higgins', 'Wendy', 'higgins.wendy@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:01:07', '2025-05-08 14:01:07'),
(196, 'Jones', 'Alfonzo', 'jones.alfonzo@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:02:00', '2025-05-08 14:02:00'),
(197, 'Jones', 'Ashley', 'jonesa@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:02:41', '2025-05-08 14:02:41'),
(198, 'Jones', 'Kristonta', 'jones.kristonta@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:03:38', '2025-05-08 14:03:38'),
(199, 'Jones', 'Markeisha', 'jones.markeisha@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:04:26', '2025-05-08 14:04:26'),
(200, 'Marlowe', 'Neil', 'nmarlowe@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:06:06', '2025-05-08 14:06:06'),
(201, 'Mayes', 'Skylar', 'mayes.skylar@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:06:51', '2025-05-08 14:06:51'),
(202, 'McCauley', 'Brittney', 'mccauley.brittney@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:07:45', '2025-05-08 14:07:45'),
(203, 'Nightengale', 'Brittney', 'nightengale.brittany@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:08:28', '2025-05-08 14:08:28'),
(204, 'Paluch', 'Chester', 'paluch.chester@rrjva.org', '$2y$12$udh0CMejMUKW.nmVmgzlmu1Ja3giMygBDFgWrcqaVa.uWjTrVymn2', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:09:13', '2025-07-08 10:19:16'),
(205, 'Price', 'Jamie', 'price.jamie@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:09:44', '2025-05-08 14:09:44'),
(206, 'Reincke', 'Steven ', 'reincke.steven@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:10:33', '2025-05-08 14:10:33'),
(207, 'Scott', 'Latica', 'scott.latica@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:11:21', '2025-05-08 14:11:21'),
(208, 'Tawhid', 'Jawad', 'tawhidj@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:12:07', '2025-05-08 14:12:07'),
(209, 'Taylor', 'Thurman', 'taylor.thurman@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:12:44', '2025-05-08 14:12:44'),
(210, 'Williams', 'Tyrone', 'williams.tyrone@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:13:46', '2025-05-08 14:13:46'),
(211, 'Winston', 'Latasha', 'winston.latasha@rrjva.org', '$2y$12$H5UJ3K4aOmAmNQDYgWv91eb7.0K0DEE1mS0AkHNLMvlTYhE6hw/RG', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 14:14:28', '2025-05-21 16:50:13'),
(212, 'Yeborah', 'Gloria', 'yeboahg@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:30:24', '2025-05-08 16:30:24'),
(213, 'Vasser', 'Dominque', 'vasserd@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:31:20', '2025-05-08 16:31:20'),
(214, 'Tanner', 'Kayla', 'tanner.kayla@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:32:06', '2025-05-08 16:32:06'),
(215, 'Hinson', 'Franklin', 'hinsonf@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:32:42', '2025-05-08 16:32:42'),
(216, 'Greene', 'Ardrice', 'greenea@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:33:18', '2025-05-08 16:33:18'),
(217, 'Bond', 'Shanel', 'bonds@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:34:01', '2025-05-08 16:34:01'),
(218, 'Breeden', 'Kimberly', 'breeden.kimberly@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:34:48', '2025-05-08 16:34:48'),
(219, 'White', 'Courtney', 'white.courtney@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:35:27', '2025-05-08 16:35:27'),
(220, 'Hill', 'DaNesha', 'hilld@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:36:29', '2025-05-08 16:36:29'),
(221, 'Jenkins', 'Fara', 'jenkinsf@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:37:17', '2025-05-08 16:37:17'),
(222, 'Dillman', 'Jeffrey', 'dillmanj@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:38:43', '2025-05-08 16:38:43'),
(223, 'Armstrong', 'Charles', 'carmstrong@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:39:18', '2025-05-08 16:39:18'),
(224, 'Holmes', 'Dennis', 'dholmes@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:40:05', '2025-05-08 16:40:05'),
(225, 'Mack', 'Tojuanna', 'tmack@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:41:21', '2025-05-08 16:41:21'),
(226, 'Reid', 'Crystal', 'creid@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:42:06', '2025-05-08 16:42:06'),
(227, 'Coleman', 'Michelle', 'mcoleman@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:44:34', '2025-05-08 16:44:34'),
(228, 'Marlowe', 'Lisa', 'lmarlowe@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:45:26', '2025-05-08 16:45:26'),
(229, 'Strubel', 'Kimberly', 'strubel.kimberly@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:46:24', '2025-05-08 16:46:24'),
(230, 'Bowen', 'Anita', 'bowena@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:47:23', '2025-05-08 16:47:23'),
(231, 'Montijo', 'Maria', 'mmontijo@rrjva.org', '$2y$12$1KSSM/Viw3DHLVRfjlK3aeAT4dG76znq1eWjeMD6T87AgjYu8Sc/2', 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:48:21', '2025-07-08 11:03:50'),
(232, 'Jackson', 'Michelle', 'mjackson@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:49:15', '2025-05-08 16:49:15'),
(233, 'McGee', 'Trina', 'mcgeet@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:50:05', '2025-05-08 16:50:05'),
(234, 'Leabough', 'Sandra', 'leabough.sandra@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:52:48', '2025-05-08 16:52:48'),
(235, 'Swift', 'Katherine', 'swift.katherine@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:53:41', '2025-05-08 16:53:41'),
(237, 'Watson', 'Shakita', 'watson.shakita@rrjva.org', NULL, 0, 0, 0, 0, 0, 0, 0, 'Supervisor', '2025-05-08 16:56:51', '2025-05-08 16:56:51');

-- --------------------------------------------------------

--
-- Table structure for table `vfm`
--

CREATE TABLE `vfm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vfm_vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_make` varchar(255) NOT NULL,
  `vehicle_model` varchar(255) NOT NULL,
  `vehicle_vin` varchar(255) NOT NULL,
  `vehicle_license_plate` varchar(255) NOT NULL,
  `vehicle_year` varchar(255) NOT NULL,
  `date_in` date NOT NULL,
  `date_out` date NOT NULL,
  `state_inspection` date NOT NULL,
  `mileage` int(11) NOT NULL,
  `air_filter` tinyint(1) NOT NULL DEFAULT 0,
  `antifreeze` tinyint(1) NOT NULL DEFAULT 0,
  `battery` tinyint(1) NOT NULL DEFAULT 0,
  `battery_booster` tinyint(1) NOT NULL DEFAULT 0,
  `belts` tinyint(1) NOT NULL DEFAULT 0,
  `brake_fluid` tinyint(1) NOT NULL DEFAULT 0,
  `brakes_front` tinyint(1) NOT NULL DEFAULT 0,
  `brakes_rear` tinyint(1) NOT NULL DEFAULT 0,
  `detention_equipment` tinyint(1) NOT NULL DEFAULT 0,
  `diagnostic_scan` tinyint(1) NOT NULL DEFAULT 0,
  `engine_oil` tinyint(1) NOT NULL DEFAULT 0,
  `exhaust` tinyint(1) NOT NULL DEFAULT 0,
  `hoses` tinyint(1) NOT NULL DEFAULT 0,
  `lights` tinyint(1) NOT NULL DEFAULT 0,
  `mirrors` tinyint(1) NOT NULL DEFAULT 0,
  `power_steering_fluid` tinyint(1) NOT NULL DEFAULT 0,
  `safety_restraints` tinyint(1) NOT NULL DEFAULT 0,
  `shocks_struts` tinyint(1) NOT NULL DEFAULT 0,
  `tires` tinyint(1) NOT NULL DEFAULT 0,
  `transmission_fluid` tinyint(1) NOT NULL DEFAULT 0,
  `vehicle_jump_starter` tinyint(1) NOT NULL DEFAULT 0,
  `washer_fluid` tinyint(1) NOT NULL DEFAULT 0,
  `window_operation` tinyint(1) NOT NULL DEFAULT 0,
  `windshield` tinyint(1) NOT NULL DEFAULT 0,
  `wiper_blades` tinyint(1) NOT NULL DEFAULT 0,
  `fire_extinguisher` tinyint(1) NOT NULL DEFAULT 0,
  `description_of_service` text DEFAULT NULL,
  `maintenance_technician` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vfm`
--

INSERT INTO `vfm` (`id`, `vfm_vehicle_id`, `vehicle_make`, `vehicle_model`, `vehicle_vin`, `vehicle_license_plate`, `vehicle_year`, `date_in`, `date_out`, `state_inspection`, `mileage`, `air_filter`, `antifreeze`, `battery`, `battery_booster`, `belts`, `brake_fluid`, `brakes_front`, `brakes_rear`, `detention_equipment`, `diagnostic_scan`, `engine_oil`, `exhaust`, `hoses`, `lights`, `mirrors`, `power_steering_fluid`, `safety_restraints`, `shocks_struts`, `tires`, `transmission_fluid`, `vehicle_jump_starter`, `washer_fluid`, `window_operation`, `windshield`, `wiper_blades`, `fire_extinguisher`, `description_of_service`, `maintenance_technician`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ford', 'Transit', '1FBAX2C86RKA02788', '236115L', '2024', '2025-02-28', '2025-02-28', '2026-02-01', 47608, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'State inspection completed at West End Service Center', 'Tim Flexon', '2025-04-03 14:28:05', '2025-04-03 14:58:03'),
(2, 2, 'Chevrolet', '3500 Express', '1GCHG39U961249275', '124296L', '2006', '2025-02-28', '2025-02-28', '2026-02-01', 202654, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'State inspection performed at West End Service center', 'Tim Flexon', '2025-04-03 14:28:51', '2025-04-03 14:58:25'),
(3, 3, 'Nissan', 'Versa', '3N1CN7AP9CL924286', '161966L', '2012', '2025-02-28', '2025-02-28', '2026-02-01', 139445, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'State inspection performed at West End Service Center', 'Tim Flexon', '2025-04-03 14:29:37', '2025-04-03 14:58:45'),
(4, 4, 'Ford', 'Transit', '1FBAX2Y89LKA26275', '223681L', '2020', '2025-02-28', '2025-02-28', '2026-02-01', 139076, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'State Inspection performed at West End Service Center', 'Tim Flexon', '2025-04-03 14:30:57', '2025-04-03 15:00:05'),
(5, 5, 'Chevrolet', 'Malibu', '1G1ZB5ST8NF205956', '223680L', '2022', '2025-02-28', '2025-02-28', '2026-02-01', 8650, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'State inspection completed by West End Service Center', 'Tim Flexon', '2025-04-03 14:32:16', '2025-04-03 15:00:33'),
(6, 6, 'Ford', 'Transit', '1FTYR2CM5KKA87971', '222811L', '2019', '2025-02-05', '2025-02-05', '2025-10-01', 129815, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'New front brake pads installed. Windshield has chip located driver side center / pass inspection.', 'Tim Flexon', '2025-04-03 14:34:43', '2025-04-03 14:34:43'),
(7, 7, 'Ford', 'E-350', '1FTSS34L79DA82632', '146774L', '2009', '2025-02-18', '2025-02-18', '2025-12-01', 189977, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'Motor oil and filter changed.\nHVAC Blower fan and operation switch replaced.\nRock chip in lower driver side of windshield. Passable for inspection.', 'Tim Flexon', '2025-04-03 14:37:47', '2025-04-03 14:37:47'),
(8, 8, 'Ford', 'Explorer', '1FMSK8BB0MGB21572', '218609L', '2021', '2025-03-25', '2025-03-25', '2026-03-25', 20528, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Oil/Filter Change\nRear Wiper Blade Replaced\nJump Box Assigned', 'Tim Flexon', '2025-04-03 14:40:12', '2025-04-03 14:40:12'),
(9, 9, 'Chevrolet', 'Impala', '2G1WC5E30C1332166', '27979L', '2012', '2025-03-15', '2025-03-16', '2025-06-01', 61437, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Low Oil Correction 1.5 quart.\nDash Light was not reset during last visit, No oil change required.\nTPMS Good\n4 Tires Replaced at Leete Tire (Tire Discounters)\nFront End Alignment\\nPassenger side head light replaced (Bulb)\nEmergency Strobes restored.  (Fuse)', 'Tim Flexon', '2025-04-03 14:47:06', '2025-04-03 14:47:06'),
(10, 10, 'Chevrolet', 'Express 2500', '1GCWGBFG1K1218791', '201694L', '2019', '2025-03-16', '2025-03-16', '2025-10-01', 141676, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Inspected/Cleaned Brakes.  Pads are not worn. (Squeaking Complaint)\nInspected/Dressed Drive Belt. Belt in perfect condition. (Squeaking Complaint) Belt Dressing Application Corrected Squeaking Noise.', 'Tim Flexon', '2025-04-03 14:49:02', '2025-04-03 14:49:02'),
(11, 11, 'GMC', 'Savanna', '1GTZ7UCG2F118699', '203443L', '2015', '2025-03-25', '2025-03-25', '2025-04-01', 182328, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Oil Change', 'Tim Flexon', '2025-04-03 14:51:50', '2025-04-03 14:51:50'),
(12, 12, 'Chevrolet', 'Express 2500', '1GCWGBFG1K1179359', '201679', '2019', '2025-03-25', '2025-02-05', '2025-01-01', 148455, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'Oil Change\nNeeds TPMS LF Wheel', 'Tim Flexon', '2025-04-03 14:54:16', '2025-04-03 14:54:16'),
(13, 13, 'Ford', 'Transit', '1FBAX2C86RKA02788', '236155L', '2024', '2025-03-26', '2025-03-26', '2026-02-01', 51147, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, 'Tim Flexon', '2025-04-03 14:55:37', '2025-04-03 14:55:37'),
(14, 14, 'Ford', 'Explorer', '1FM5K8B89JGB59363', '140-149L', '2018', '2025-03-27', '2025-03-27', '2025-04-27', 67017, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '-Added Coolant\\n-Sending off site for front tires\n-air filters are being ordered\n-inspection 7/25', 'Tim Flexon', '2025-04-03 14:57:26', '2025-04-03 14:57:26'),
(15, 11, 'GMC', 'Savanna', '1GTZ7UCG2F118699', '203443L', '2015', '2025-04-04', '2025-04-04', '2025-03-01', 182879, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '25 point inspection done\nstate inspection', 'Warren Payne', '2025-04-14 12:19:05', '2025-04-14 12:19:05'),
(16, 10, 'Chevrolet', 'Express 2500', '1GCWGBFG1K1218791', '201694L', '2019', '2025-04-04', '2025-04-04', '2025-10-01', 142190, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '25 point inspection done\noil change\nrepaired damaged vacuum line for a/c controls ', 'Warren Payne', '2025-04-14 12:22:34', '2025-04-14 12:22:34'),
(17, 15, 'Ram', 'ProMaster', '3C6LRVDG8RE107445', '236175L', '2024', '2025-04-17', '2025-04-17', '2025-05-01', 15483, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '25 POINT INSPECTION AND OIL CHANGE', 'Tim Flexon', '2025-04-17 13:06:36', '2025-04-17 13:06:36'),
(18, 16, 'Chevrolet', 'Malibu', '1G1ZC5STXSF119105', '258-487L', '2025', '2025-04-17', '2025-04-17', '2025-12-31', 970, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '25 POINT INSPECTION', 'Tim Flexon', '2025-04-17 13:30:47', '2025-04-17 13:30:47'),
(19, 6, 'Ford', 'Transit', '1FTYR2CM5KKA87971', '222811L', '2019', '2025-04-21', '2025-04-21', '2025-10-01', 115602, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '-added a little Antifreeze.\n-small chip in windshield on driver side and 8\" crack on the bottom of passenger side.\n- installed vehicle jump box', 'Tim Flexon', '2025-04-21 17:53:01', '2025-04-21 17:53:01'),
(20, 2, 'Chevrolet', '3500 Express', '1GCHG39U961249275', '124296L', '2006', '2025-04-21', '2025-04-22', '2026-02-01', 203802, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '- windshield is chipped on passenger side\n-installed Vehicle Jump Starter\n-added power steering fluid', 'Tim Flexon', '2025-04-22 11:07:04', '2025-04-22 11:07:04'),
(21, 17, 'Chevrolet', 'Malibu', '1G1ZC5ST6SF118520', '230-542L', '2025', '2025-04-22', '2025-04-22', '2025-09-01', 50, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 'New Vehicle: Admin Sedan', 'Tim Flexon', '2025-04-22 16:13:42', '2025-04-22 16:13:42'),
(22, 11, 'GMC', 'Savanna', '1GTZ7UCG2F118699', '203443L', '2015', '2025-04-23', '2025-04-24', '2026-04-01', 183294, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Air was not switching between vents and defrost, found a vacuum hose came close. Reattached vacuum line and taped lines out of the way.', 'Tim Flexon', '2025-04-24 11:27:20', '2025-04-24 11:27:20'),
(23, 5, 'Chevrolet', 'Malibu', '1G1ZB5ST8NF205956', '223680L', '2022', '2025-04-25', '2025-04-29', '2026-02-01', 9038, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'oil change\nadded jump pack', 'Warren Payne', '2025-04-29 11:35:32', '2025-04-29 11:35:32'),
(24, 4, 'Ford', 'Transit', '1FBAX2Y89LKA26275', '223681L', '2020', '2025-04-30', '2025-04-30', '2026-02-01', 142782, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'replaced broken molding clips on pass sliding door and 5 broken roof vents', 'Warren Payne', '2025-04-30 13:50:01', '2025-04-30 13:50:01'),
(25, 18, 'chevy', 'silverado', '3GCPKSEA4DG113439', '173-976L', '2013', '2025-05-08', '2025-05-08', '2025-11-01', 83539, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 'topped oil off it was a half of quart low. also did the 25 point inspection', 'Warren Payne', '2025-05-08 15:46:40', '2025-05-08 15:46:40'),
(26, 13, 'Ford', 'Transit', '1FBAX2C86RKA02788', '236155L', '2024', '2025-05-12', '2025-05-12', '2026-02-01', 60731, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '25 point inspection\n', 'Warren Payne', '2025-05-12 22:08:21', '2025-05-12 22:08:21'),
(27, 3, 'Nissan', 'Versa', '3N1CN7AP9CL924286', '161966L', '2012', '2025-05-13', '2025-05-13', '2026-02-01', 139538, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '25 point inspection', 'Warren Payne', '2025-05-13 22:06:46', '2025-05-13 22:06:46'),
(28, 19, 'Ford', 'F-150', '1FTDF17W7YNC29017', '43-574L', '2000', '2025-05-13', '2025-05-13', '2025-05-01', 81644, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '25 point inspection', 'Warren Payne', '2025-05-13 22:12:16', '2025-05-13 22:12:16'),
(29, 15, 'Ram', 'ProMaster', '3C6LRVDG8RE107445', '236175L', '2024', '2025-05-14', '2025-05-15', '2025-05-01', 18668, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '25 point inspection', 'Warren Payne', '2025-05-15 20:04:20', '2025-05-15 20:04:20'),
(30, 14, 'Ford', 'Explorer', '1FM5K8B89JGB59363', '140-149L', '2018', '2025-05-18', '2025-05-18', '2025-07-01', 69212, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'replaced air filter\nadded a half quart or oil\nadded wiper fluid ', 'Warren Payne', '2025-05-18 16:41:34', '2025-05-18 16:41:34'),
(31, 20, 'Ford', 'E-250', '1FTNS24L44HA32277', '120-012L', '2004', '2025-05-18', '2025-05-18', '2026-04-01', 44694, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'ADDED A HALF QUART OF OIL\ncleared check engine light (occurred with last battery failure)', 'Warren Payne', '2025-05-18 17:07:21', '2025-05-18 17:07:21'),
(32, 7, 'Ford', 'E-350', '1FTSS34L79DA82632', '146774L', '2009', '2025-05-18', '2025-05-18', '2025-12-01', 190974, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'replaced driver wiper blade\nadded 1 quart oil\n', 'Warren Payne', '2025-05-18 18:23:28', '2025-05-18 18:23:28'),
(33, 21, 'Ford', 'E350', '1FTSS34L99DA82633', '146-775L', '2009', '2025-05-19', '2025-05-19', '2025-08-01', 166663, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'Replaced all missing pop rivets form side security door\nReplaced pass side headlight\nreplaced door seal on drivers door \nGreased all front end components \n ', 'Warren Payne', '2025-05-19 12:13:14', '2025-05-19 12:13:14'),
(34, 5, 'Chevrolet', 'Malibu', '1G1ZB5ST8NF205956', '223680L', '2022', '2025-05-19', '2025-05-19', '2026-02-01', 9569, 1, 1, 1, 0, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, '25 point inspection\nfilled wiper fluid', 'Warren Payne', '2025-05-19 16:31:09', '2025-05-19 16:31:09'),
(35, 2, 'Chevrolet', '3500 Express', '1GCHG39U961249275', '124296L', '2006', '2025-05-28', '2025-05-28', '2026-02-01', 203820, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'replaced pass side wiper blade', 'Warren Payne', '2025-05-28 18:23:42', '2025-05-28 18:23:42'),
(36, 6, 'Ford', 'Transit', '1FTYR2CM5KKA87971', '222811L', '2019', '2025-05-29', '2025-05-31', '2025-10-01', 118944, 1, 1, 1, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 'oil change', 'Warren Payne', '2025-05-31 12:35:39', '2025-05-31 12:35:39');

-- --------------------------------------------------------

--
-- Table structure for table `vfm_vehicle`
--

CREATE TABLE `vfm_vehicle` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `license_plate` varchar(255) NOT NULL,
  `vehicle_year` int(11) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `vin` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vfm_vehicle`
--

INSERT INTO `vfm_vehicle` (`id`, `license_plate`, `vehicle_year`, `make`, `model`, `vin`, `created_at`, `updated_at`) VALUES
(1, '236115L', 2024, 'Ford', 'Transit', '1FBAX2C86RKA02788', '2025-04-03 15:11:11', '2025-04-03 14:24:20'),
(2, '124296L', 2006, 'Chevrolet', '3500 Express', '1GCHG39U961249275', '2025-04-03 15:11:11', '2025-04-03 14:24:02'),
(3, '161966L', 2012, 'Nissan', 'Versa', '3N1CN7AP9CL924286', '2025-04-03 15:11:11', '2025-04-03 14:25:03'),
(4, '223681L', 2020, 'Ford', 'Transit', '1FBAX2Y89LKA26275', '2025-04-03 15:11:11', '2025-04-03 14:24:32'),
(5, '223680L', 2022, 'Chevrolet', 'Malibu', '1G1ZB5ST8NF205956', '2025-04-03 15:11:11', '2025-04-03 14:23:46'),
(6, '222811L', 2019, 'Ford', 'Transit', '1FTYR2CM5KKA87971', '2025-04-03 15:11:11', '2025-04-03 14:24:51'),
(7, '146774L', 2009, 'Ford', 'E-350', '1FTSS34L79DA82632', '2025-04-03 15:11:11', '2025-04-03 14:25:12'),
(8, '218609L', 2021, 'Ford', 'Explorer', '1FMSK8BB0MGB21572', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(9, '27979L', 2012, 'Chevrolet', 'Impala', '2G1WC5E30C1332166', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(10, '201694L', 2019, 'Chevrolet', 'Express 2500', '1GCWGBFG1K1218791', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(11, '203443L', 2015, 'GMC', 'Savanna', '1GTZ7UCG2F118699', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(12, '201679', 2019, 'Chevrolet', 'Express 2500', '1GCWGBFG1K1179359', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(13, '236155L', 2024, 'Ford', 'Transit', '1FBAX2C86RKA02788', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(14, '140-149L', 2018, 'Ford', 'Explorer', '1FM5K8B89JGB59363', '2025-04-03 15:11:11', '2025-04-03 15:11:11'),
(15, '236175L', 2024, 'Ram', 'ProMaster', '3C6LRVDG8RE107445', '2025-04-17 12:40:09', '2025-04-17 12:40:09'),
(16, '258-487L', 2025, 'Chevrolet', 'Malibu', '1G1ZC5STXSF119105', '2025-04-17 13:24:06', '2025-04-17 13:24:06'),
(17, '230-542L', 2025, 'Chevrolet', 'Malibu', '1G1ZC5ST6SF118520', '2025-04-22 16:06:38', '2025-04-22 16:06:38'),
(18, '173-976L', 2013, 'chevy', 'silverado', '3GCPKSEA4DG113439', '2025-05-08 13:39:43', '2025-05-08 13:39:43'),
(19, '43-574L', 2000, 'Ford', 'F-150', '1FTDF17W7YNC29017', '2025-05-13 22:09:44', '2025-05-13 22:09:44'),
(20, '120-012L', 2004, 'Ford', 'E-250', '1FTNS24L44HA32277', '2025-05-18 16:56:42', '2025-05-18 16:56:42'),
(21, '146-775L', 2009, 'Ford', 'E350', '1FTSS34L99DA82633', '2025-05-19 12:07:08', '2025-05-19 12:07:08'),
(22, '161-970L', 2012, 'Chevrolet', 'Express 2500', '1GCWGGCG9C1199636', '2025-06-03 12:52:00', '2025-06-03 12:52:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_unique` (`category`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ics`
--
ALTER TABLE `ics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_category_id_foreign` (`category_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurisdictions`
--
ALTER TABLE `jurisdictions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jurisdictions_name_unique` (`name`);

--
-- Indexes for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jurisdiction_time_log_jurisdiction_id_foreign` (`jurisdiction_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_report_recipients`
--
ALTER TABLE `monthly_report_recipients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `monthly_report_recipients_email_unique` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_supervisor_id_foreign` (`supervisor_id`),
  ADD KEY `orders_section_id_foreign` (`section_id`),
  ADD KEY `orders_approved_denied_by_foreign` (`approved_denied_by`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `phone_directory`
--
ALTER TABLE `phone_directory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE `policies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vfm`
--
ALTER TABLE `vfm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vfm_vfm_vehicle_id_foreign` (`vfm_vehicle_id`);

--
-- Indexes for table `vfm_vehicle`
--
ALTER TABLE `vfm_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ics`
--
ALTER TABLE `ics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=208;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurisdictions`
--
ALTER TABLE `jurisdictions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=248;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `monthly_report_recipients`
--
ALTER TABLE `monthly_report_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `phone_directory`
--
ALTER TABLE `phone_directory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=238;

--
-- AUTO_INCREMENT for table `vfm`
--
ALTER TABLE `vfm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `vfm_vehicle`
--
ALTER TABLE `vfm_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  ADD CONSTRAINT `jurisdiction_time_log_jurisdiction_id_foreign` FOREIGN KEY (`jurisdiction_id`) REFERENCES `jurisdictions` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_approved_denied_by_foreign` FOREIGN KEY (`approved_denied_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_supervisor_id_foreign` FOREIGN KEY (`supervisor_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `vfm`
--
ALTER TABLE `vfm`
  ADD CONSTRAINT `vfm_vfm_vehicle_id_foreign` FOREIGN KEY (`vfm_vehicle_id`) REFERENCES `vfm_vehicle` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
