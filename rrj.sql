-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2026 at 04:54 PM
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
-- Table structure for table `camera_future_ip_address`
--

CREATE TABLE `camera_future_ip_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `camera_number` varchar(255) NOT NULL,
  `future_ip_address` varchar(45) NOT NULL,
  `is_used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `camera_statuses`
--

CREATE TABLE `camera_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `camera_number` varchar(255) NOT NULL,
  `camera_name` varchar(255) NOT NULL,
  `encoder_switch_location` varchar(255) NOT NULL,
  `encoder_switch_name` varchar(255) NOT NULL,
  `encoder_port` varchar(255) DEFAULT NULL,
  `camera_model` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) NOT NULL,
  `firmware_version` varchar(255) DEFAULT NULL,
  `credentials` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`credentials`)),
  `nvr` enum('nvr_1','nvr_2','nvr_3','nvr_4') NOT NULL,
  `notes` text DEFAULT NULL,
  `camera_type` enum('analog','digital','unknown') NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` enum('good','no_video','blurry','iris','adjust','clean','pending_digital_upgrade') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(6, '1 for 1 Exchange', NULL, NULL);

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
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `low_stock_threshold` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `jurisdiction_time_log`
--

CREATE TABLE `jurisdiction_time_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jurisdiction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_of_visit` date NOT NULL,
  `department` tinyint(1) NOT NULL DEFAULT 0,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `booking_start` time DEFAULT NULL,
  `booking_end` time DEFAULT NULL,
  `magistrate_start` time DEFAULT NULL,
  `magistrate_end` time DEFAULT NULL,
  `nurse_start` time DEFAULT NULL,
  `nurse_end` time DEFAULT NULL,
  `officer_start` time DEFAULT NULL,
  `officer_end` time DEFAULT NULL,
  `inmate_count` int(11) DEFAULT NULL,
  `did_not_get_committed` tinyint(1) NOT NULL DEFAULT 0,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(7, '2024_12_22_180241_create_policies_table', 1),
(8, '2024_12_31_210000_create_categories_table', 1),
(9, '2024_12_31_210618_create_items_table', 1),
(10, '2025_01_02_141524_create_sections_table', 1),
(11, '2025_01_02_143659_create_orders_table', 1),
(12, '2025_05_02_130959_create_monthly_report_recipients_table', 1),
(13, '2025_05_22_122502_create_jurisdictions_table', 1),
(14, '2025_05_22_122503_create_jurisdiction_time_log_table', 1),
(15, '2026_05_04_150736_create_policy_builders_table', 1),
(16, '2026_05_07_084707_create_policy_chapters_table', 1),
(17, '2026_05_07_085204_create_policy_chapter_sections_table', 1),
(18, '2026_05_07_091742_create_policy_chapter_paragraphs_table', 1),
(19, '2026_05_07_092714_create_policy_chapter_paragraph_bullets_table', 1),
(20, '2026_05_07_092715_create_policy_chapter_paragraph_bullet_bullets_table', 1),
(21, '2026_05_15_132946_create_camera_statuses_table', 1),
(22, '2026_05_29_125511_create_camera_future_ip_address_table', 1),
(23, '2026_06_09_100347_create_policy_references_table', 1),
(24, '2026_06_09_100500_create_policy_reference_paragraphs_table', 1),
(25, '2026_06_09_100508_create_policy_reference_paragraph_bullets_table', 1),
(26, '2026_06_11_103200_create_policy_definitions_table', 1),
(27, '2026_07_22_101817_create_training_books_table', 2),
(28, '2026_07_22_101832_create_training_book_parts_table', 2),
(29, '2026_07_22_101845_create_training_book_part_modules_table', 2),
(30, '2026_07_22_101846_create_training_book_part_module_signoff_requirements_table', 2),
(31, '2026_07_22_101847_create_training_book_assignments_table', 2),
(32, '2026_07_22_101848_create_training_book_assignment_modules_table', 2),
(33, '2026_07_22_101849_create_training_book_assignment_module_items_table', 2),
(34, '2026_07_22_101850_create_training_book_assignment_signoffs_table', 2),
(35, '2026_07_23_072120_create_training_book_part_module_paragraphs_table', 2),
(36, '2026_07_23_072121_create_training_book_part_module_paragraph_sections_table', 2),
(37, '2026_07_23_072122_create_training_book_part_module_paragraph_contents_table', 2),
(38, '2026_07_23_072122_create_training_book_part_module_paragraph_lists_table', 2),
(39, '2026_07_23_072123_create_training_book_part_module_paragraph_list_items_table', 2),
(40, '2026_07_23_100825_create_training_book_part_module_forms_table', 2),
(41, '2026_07_23_100826_create_training_book_part_module_form_documents_table', 2),
(42, '2026_07_23_100941_create_training_book_part_module_media_table', 2),
(43, '2026_07_23_100942_create_training_book_part_module_media_files_table', 2),
(44, '2026_07_23_101159_create_training_book_part_module_tests_table', 2),
(45, '2026_07_23_101160_create_training_book_part_module_test_questions_table', 2),
(46, '2026_07_23_101161_create_training_book_part_module_test_question_options_table', 2),
(47, '2026_07_23_101347_create_training_book_part_module_sop_checklists_table', 2),
(48, '2026_07_23_101348_create_training_book_part_module_sop_checklist_groups_table', 2),
(49, '2026_07_23_101349_create_training_book_part_module_sop_checklist_policies_table', 2),
(50, '2026_07_23_115333_create_training_book_part_module_checklists_table', 2),
(51, '2026_08_17_095821_create_training_book_part_module_evaluations_table', 2),
(52, '2026_08_17_095822_create_training_book_part_module_evaluation_fields_table', 2),
(53, '2026_08_27_191243_create_training_book_assignment_evaluations_table', 2),
(54, '2026_08_27_192517_create_training_book_part_module_checklist_groups_table', 2),
(55, '2026_08_27_192828_create_training_book_part_module_checklist_items_table', 2),
(56, '2026_09_23_124051_create_training_book_module_categories_table', 2),
(57, '2026_09_23_124421_create_training_module_category_assignments_table', 2);

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

-- --------------------------------------------------------

--
-- Table structure for table `policy_builders`
--

CREATE TABLE `policy_builders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `policy_statement` longtext NOT NULL,
  `policy_purpose` longtext NOT NULL,
  `standards` longtext DEFAULT NULL,
  `american_correctional_association` longtext DEFAULT NULL,
  `va_board_of_local_and_regional_jails` longtext DEFAULT NULL,
  `prison_rape_and_elimination_act` longtext DEFAULT NULL,
  `ncchc` longtext DEFAULT NULL,
  `policy_cross_reference` longtext DEFAULT NULL,
  `forms` longtext DEFAULT NULL,
  `policy_effective_date` date DEFAULT NULL,
  `policy_revision_dates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`policy_revision_dates`)),
  `policy_owner_signature` blob DEFAULT NULL,
  `policy_owner_date` date DEFAULT NULL,
  `policy_reviewer_signature` blob DEFAULT NULL,
  `policy_reviewer_date` date DEFAULT NULL,
  `superintendent_approval_signature` blob DEFAULT NULL,
  `superintendent_approval_date` date DEFAULT NULL,
  `table_of_contents` longtext DEFAULT NULL,
  `definitions` longtext DEFAULT NULL,
  `revised` tinyint(1) NOT NULL DEFAULT 0,
  `approved` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_chapters`
--

CREATE TABLE `policy_chapters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_id` bigint(20) UNSIGNED NOT NULL,
  `chapter_title` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_chapter_paragraphs`
--

CREATE TABLE `policy_chapter_paragraphs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `paragraph` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_chapter_paragraph_bullets`
--

CREATE TABLE `policy_chapter_paragraph_bullets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`list`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_chapter_paragraph_bullet_bullets`
--

CREATE TABLE `policy_chapter_paragraph_bullet_bullets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bullet_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`list`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_chapter_sections`
--

CREATE TABLE `policy_chapter_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chapter_id` bigint(20) UNSIGNED NOT NULL,
  `section_title` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_definitions`
--

CREATE TABLE `policy_definitions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_id` bigint(20) UNSIGNED NOT NULL,
  `word` varchar(255) DEFAULT NULL,
  `definition` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_references`
--

CREATE TABLE `policy_references` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `policy_id` bigint(20) UNSIGNED NOT NULL,
  `reference_title` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_reference_paragraphs`
--

CREATE TABLE `policy_reference_paragraphs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference_id` bigint(20) UNSIGNED NOT NULL,
  `aca_reference` varchar(255) DEFAULT NULL,
  `paragraph` longtext NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_reference_paragraph_bullets`
--

CREATE TABLE `policy_reference_paragraph_bullets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`list`)),
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Administration', NULL, NULL),
(2, 'Booking', NULL, NULL),
(3, 'C&T', NULL, NULL),
(4, 'Captains Hall', NULL, NULL),
(5, 'Classification', NULL, NULL),
(6, 'Compliance', NULL, NULL),
(7, 'Housekeeping', NULL, NULL),
(8, 'HUM', NULL, NULL),
(9, 'Housing Unit 1', NULL, NULL),
(10, 'Housing Unit 2', NULL, NULL),
(11, 'Housing Unit 3', NULL, NULL),
(12, 'Housing Unit 4', NULL, NULL),
(13, 'Housing Unit 5', NULL, NULL),
(14, 'Housing Unit 6', NULL, NULL),
(15, 'Maintenance', NULL, NULL),
(16, 'Medical Housing', NULL, NULL),
(17, 'Movement', NULL, NULL),
(18, 'OPR', NULL, NULL),
(19, 'Programs', NULL, NULL),
(20, 'Property', NULL, NULL),
(21, 'Records', NULL, NULL),
(22, 'SEC', NULL, NULL),
(23, 'SHU-A', NULL, NULL),
(24, 'SHU-B', NULL, NULL),
(25, 'Warehouse', NULL, NULL);

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('JA8dGveUzQv4yrW4DzDuLlhhTZAOwFkpq2tW12lW', 1, '128.168.122.163', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/154.0.0.0 Safari/537.36', 'ZXlKcGRpSTZJazFZVXk4M2NFbFBlVUUwVVdaR01WUnNaRUpCVWxFOVBTSXNJblpoYkhWbElqb2llRXRDYmtNMU4yZElkVmxLYUZNMEswdzJOV2hRVlhGQ2VtMDVUSEZxY1ZZMVEyRkNlRkZEY0dKMFVGTXdjV2RZTkZOVFVrdEhRVkZHZVhaMVV6WkxkbVpJY3k4MVN6UTROWGR2U0hOWFVuaGhVeTl3WWxGMGJVVnRLMmR1WjFoR1pGcERhbmhVWVc5UlJqTmFVVmxFYUVkbVZtbEtTRmg2WlRaSU1Ia3diR05PYWpKYVluaHlVVlpKYUV4WFNrUmhVRGN3TkhWWEsyVmtTa3R5YlZkUFMxaDVPU3R1UldsMkwweG9aSFp5Y1ZwM1ZXRjNXRUUwZHk5MU1pOVJTV3BwV21kT2VYTTNURzFsTTNFdmFHVnNNU3RvT1cxVFJFMWpTVVZhU1RaNVZXcFRUMlUzV1U4M1F6RXpSR1JvT1haV1VEQkdVbUpwTWxWbVZqTkxXV3BrSzJwMFNrc3JRbFpvVTJGQ2QxVk1SaXN6WTJkQ01tbEdlR3RqTlZRd1IwODVWMFJxTTIxRVkzUnBjMlpWVGtSWU9XVnJaM0pHYjI5eGJVNHZValYyTDJacFZuSktObXhzWmtRd2NFNHdaU3RtVlVkVlpWTTRTMEpxUXpJdlZWcGxUVVJTYVV0NE1qQnVNeTlTVFd4WlQzTjJTVmc1UW1WNVdWVlVWems0TWs5NVJUVlpaeko2WTI5d1pHRTVRMDV1ZWpJeFQyNXZURlpFUzJOT2VWZEVVMWhXWmtwWGEwWktOM1JFWXowaUxDSnRZV01pT2lKbU5HTXdNalV4T1dNMU16TXpNemcxTTJaaE9HSXpNRE13TWpNMk5USTRZV0V3T1RRM1pqWTFaVEk1TmpoaE9EY3lPVEZtTURrNU9UQXhPRE15TURGaUlpd2lkR0ZuSWpvaUluMD0=', 1791226894);

-- --------------------------------------------------------

--
-- Table structure for table `training_books`
--

CREATE TABLE `training_books` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_books`
--

INSERT INTO `training_books` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'On the Job Training Manual Sworn Staff Security/Housing Unit Operations', '2026-10-05 17:55:47', '2026-10-05 17:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_assignments`
--

CREATE TABLE `training_book_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('assigned','in_progress','completed') NOT NULL DEFAULT 'assigned',
  `assigned_at` timestamp NULL DEFAULT NULL,
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_assignments`
--

INSERT INTO `training_book_assignments` (`id`, `user_id`, `book_id`, `status`, `assigned_at`, `started_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'assigned', '2026-10-05 04:00:00', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_assignment_evaluations`
--

CREATE TABLE `training_book_assignment_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_module_id` bigint(20) UNSIGNED NOT NULL,
  `strengths` text DEFAULT NULL,
  `weaknesses` text DEFAULT NULL,
  `areas_of_improvement` text DEFAULT NULL,
  `completed_by` bigint(20) UNSIGNED DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_book_assignment_modules`
--

CREATE TABLE `training_book_assignment_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_id` bigint(20) UNSIGNED NOT NULL,
  `book_part_module_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('not_started','in_progress','completed') NOT NULL DEFAULT 'not_started',
  `started_at` timestamp NULL DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_assignment_modules`
--

INSERT INTO `training_book_assignment_modules` (`id`, `assignment_id`, `book_part_module_id`, `status`, `started_at`, `completed_at`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(2, 1, 3, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(3, 1, 4, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(4, 1, 6, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(5, 1, 7, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(6, 1, 5, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(7, 1, 8, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(8, 1, 9, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36'),
(9, 1, 10, 'not_started', NULL, NULL, '2026-10-05 18:00:36', '2026-10-05 18:00:36');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_assignment_module_items`
--

CREATE TABLE `training_book_assignment_module_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assignment_module_id` bigint(20) UNSIGNED NOT NULL,
  `module_item_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('not_started','completed') NOT NULL DEFAULT 'not_started',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_book_assignment_signoffs`
--

CREATE TABLE `training_book_assignment_signoffs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `signable_type` varchar(255) NOT NULL,
  `signable_id` bigint(20) UNSIGNED NOT NULL,
  `signoff_requirement_id` bigint(20) UNSIGNED NOT NULL,
  `signed_by` bigint(20) UNSIGNED NOT NULL,
  `signed_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_book_parts`
--

CREATE TABLE `training_book_parts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_parts`
--

INSERT INTO `training_book_parts` (`id`, `title`, `book_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 'Introduction', 1, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(3, 'Familiarization', 1, 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(4, 'Training the Trainee', 1, 2, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(5, 'Housing Unit Operations', 1, 3, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(6, 'Daily Forms', 1, 4, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(7, 'Standard Operating Procedure Acceptance and Acknowledgement', 1, 5, '2026-10-05 17:59:44', '2026-10-05 17:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_modules`
--

CREATE TABLE `training_book_part_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_part_id` bigint(20) UNSIGNED NOT NULL,
  `module_type` varchar(255) NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_modules`
--

INSERT INTO `training_book_part_modules` (`id`, `book_part_id`, `module_type`, `module_id`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 2, 'paragraph', 1, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(3, 3, 'checklist', 1, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(4, 4, 'checklist', 2, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(5, 5, 'test', 1, 2, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(6, 5, 'checklist', 3, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(7, 5, 'checklist', 4, 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(8, 5, 'evaluation', 1, 3, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(9, 6, 'form', 1, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(10, 7, 'sop_checklist', 1, 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_checklists`
--

CREATE TABLE `training_book_part_module_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_checklists`
--

INSERT INTO `training_book_part_module_checklists` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Familiarization Checklist', 'This module will guide the Trainee of the areas to get familiar with parts of the jail they may be assigned', '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(2, 'Supervisor Development Training', 'Each Supervisor responsible for an OJT Officer assigned to his or her shift or section and must spend a minimum of 16 hours coaching and training. This includes daily reviews of the Officer\'s Field Training Packet and grading of test. The Supervisor will also review and evaluate the following areas.', '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(3, 'Housing Unit Operations', 'The Field Training Officer will be assigned to the OJT Officer for the entire training period. They will work a like shift and rotation. The Supervisor will grade the test and document weaknesses on the Daily Evaluation Form. The FTO will evaluate and train the OJT in the following areas of Housing Unit Operations.', '2026-10-05 17:24:43', '2026-10-05 17:24:43'),
(4, 'Unit Control', 'The Field Training Officer will train and evaluate areas listed below. The Trainee will be scored in accordance with the scale set in the beginning of this manual.', '2026-10-05 17:31:59', '2026-10-05 17:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_checklist_groups`
--

CREATE TABLE `training_book_part_module_checklist_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `checklist_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_checklist_groups`
--

INSERT INTO `training_book_part_module_checklist_groups` (`id`, `checklist_id`, `title`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Areas', NULL, 0, '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(2, 2, 'Inmate Grievance', NULL, 0, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(3, 2, 'Report Writing', NULL, 1, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(4, 2, 'Use of Force', 'Have the Trainee explain the policy/procedure on the following', 2, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(5, 2, 'Use of Restraints', 'Have the Trainee demonstrate the proper method of using the following', 3, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(6, 2, 'Miscellaneous', 'Have the Trainee demonstrate and tell the uses of the following', 4, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(24, 3, 'Security Inspections', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(25, 3, 'Inmate Supervision', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(26, 3, 'Inmate Movement', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(27, 3, 'Inmate Counts', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(28, 3, 'Documentation', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(29, 3, 'Meal Service', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(30, 3, 'Inmate Hygiene', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(31, 3, 'Safety and Sanitation', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(32, 3, 'Medical', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(33, 3, 'AED Machines', NULL, 9, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(34, 3, 'Inmate Discipline', NULL, 10, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(35, 3, 'Radio/Intercom Communications', NULL, 11, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(36, 3, 'Inmate Mail', NULL, 12, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(37, 3, 'Emergency Procedures', NULL, 13, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(38, 3, 'Searches (Pat Search)', 'The Trainee shall demonstrate the ability to make a complete search of all persons and their personal clothing and property for contraband. The search shall include the following', 14, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(39, 3, 'Searches (Strip Search)', 'The Trainee shall demonstrate the ability to make a complete visual inspection of the same sex inmate and their personal clothing and property for contraband. The search shall include the following', 15, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(40, 3, 'Searches (Cell Search)', 'The Trainee shall demonstrate the ability to make a complete inspection of the inmate and their living area to detect contraband items and possible escape attempts. The search shall be thorough and systematic and include the following', 16, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(41, 4, 'General', NULL, 0, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(42, 4, 'Radio/Intercom Communications', NULL, 1, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(43, 4, 'Control Centers', NULL, 2, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(44, 4, 'The Trainee Will Perform Working Knowledge Of', NULL, 3, '2026-10-05 17:31:59', '2026-10-05 17:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_checklist_items`
--

CREATE TABLE `training_book_part_module_checklist_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `item` text NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_checklist_items`
--

INSERT INTO `training_book_part_module_checklist_items` (`id`, `group_id`, `item`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Medical Housing', NULL, 0, '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(2, 1, 'Booking/Property', NULL, 1, '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(3, 1, 'Pre-Release/HU-6 Operations', NULL, 2, '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(4, 1, 'Kitchen/Housekeeping', NULL, 3, '2026-10-05 17:00:09', '2026-10-05 17:00:09'),
(5, 2, 'The Trainee attempts to resolve inmate complaints', NULL, 0, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(6, 2, 'The Trainee explains the grievance procedures to inmates', NULL, 1, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(7, 2, 'The Trainee informs Supervisor of inmates requesting grievances', NULL, 2, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(8, 2, 'The Trainee follows-up to ensure all grievances and appeals are submitted promptly', NULL, 3, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(9, 3, 'Accuracy', NULL, 0, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(10, 3, 'Free of spelling errors', NULL, 1, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(11, 3, 'Completeness', NULL, 2, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(12, 3, 'Clarity Legibility', NULL, 3, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(13, 3, 'Grammatically correct', NULL, 4, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(14, 3, 'Facts organized in chronological order', NULL, 5, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(15, 3, 'Facts related in appropriate sentence form', NULL, 6, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(16, 3, 'Form is completed correctly', NULL, 7, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(17, 3, 'Properly establishing who, what, when, where, how, how many, and action taken', NULL, 8, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(18, 3, 'Reports submitted within the time frame specified by policy and procedure', NULL, 9, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(19, 4, 'Use of Force', NULL, 0, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(20, 4, 'Use of Electronic Devices', NULL, 1, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(21, 4, 'Use of Firearms', NULL, 2, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(22, 4, 'Use of Restraints', NULL, 3, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(23, 4, 'Use of Chemical Agents', NULL, 4, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(24, 5, 'Handcuffs', NULL, 0, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(25, 5, 'Leg Restraints', NULL, 1, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(26, 5, 'Waist Chain or Belt', NULL, 2, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(27, 5, 'Box (Blue)', NULL, 3, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(28, 5, 'Flex Cuff', NULL, 4, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(29, 5, 'The Trainee Applies restraints when necessary to restrain violent and/or disorderly inmates.', NULL, 5, '2026-10-05 17:05:30', '2026-10-05 17:05:30'),
(30, 5, 'The Trainee notifies medical when restraints are applied to inmate(s).', NULL, 6, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(31, 6, 'Simplex B Key', NULL, 0, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(32, 6, 'Pull Stations', NULL, 1, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(33, 6, 'Pull Station Locations', NULL, 2, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(34, 6, 'What the key looks like', NULL, 3, '2026-10-05 17:05:31', '2026-10-05 17:05:31'),
(133, 24, 'The Trainee performs security and observation rounds, with a minimum of two (2) rounds every hour, no more than 40 minutes apart. Preventing escapes, riots, assaults, fires, or any other security breaches', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(134, 24, 'The Trainee inspects all cell doors and windows to ensure they are functioning and securing properly', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(135, 24, 'The Trainee inspects all security equipment daily and submits a maintenance request for necessary repairs', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(136, 24, 'Reports all security breaches or unsound security practices on the Officers Log and/or Security and Observation Log and notifies their immediate Supervisor.', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(137, 25, 'Keeping abreast of pertinent security information concerning the inmates and facility', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(138, 25, 'Maintains a safe distance when approaching inmates and takes control of the situation', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(139, 25, 'Effectively manages the housing unit pod to maintain the orderly operation and acceptable noise level', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(140, 25, 'Makes security and observation rounds twice per hour to verify inmates’ presence to ensure signs of life, breathing, flesh, movement, etc. and ascertain the physical condition of inmates and pod area', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(141, 25, 'If there is a concern with the inmate’s presence in the cell, the Officer will knock on the cell door in an attempt to to clarify the concern. If the concern can not be clarified, the Officer will make contact with the appropriate Supervisor while maintaining a visual of the inmate. The Officer will call a 10 Code, if needed for assistance', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(142, 25, 'Possible signs of death:\nThere is no breathing or heartbeat\nThey cannot be woken up\nTheir skin is pale and waxy\nTheir eyelids might be half open\nTheir pupils are fixed\nTheir mouth may fall open', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(143, 25, 'Not allowing inmates to enter in the Officer’s Station at any time, or the triage area, or janitorial closets', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(144, 25, 'Keeps juveniles separate from adult inmates (sight and sound)', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(145, 25, 'Keeps females separate from male inmates', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(146, 25, 'The Trainee supervises inmate workers cleaning within their assigned post.', NULL, 9, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(147, 25, 'Supervises the exchange of laundry to inmates', NULL, 10, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(148, 25, 'Shown Release of Enemies Contract, how to complete and where to send it when completed.', NULL, 11, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(149, 26, 'Prioritize and coordinates inmate movement and activities in assigned area or post', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(150, 26, 'Escorting inmates to inmate programs, recreation, library, visitation, etc., in a safe manner', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(151, 26, 'Supervises inmate programs, recreation, church services, and other activities of the assigned area', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(152, 26, 'Ensures that court inmates are ready for transport to Booking', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(153, 26, 'Notifies security staff to transport inmates to other locations within the facility', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(154, 26, 'Conducts searches of inmates going to and from programs, recreation, library, visitation, etc', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(155, 26, 'Shown Law Library Roster, how it is completed and where forwarded to', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(156, 27, 'Conducts accurate inmate standing headcount at scheduled and irregular count time', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(157, 27, 'Conducts and reports re-counts in a timely manner.', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(158, 27, 'Maintains an accurate count of all inmates housed in his/her assigned post, which includes a listing of all inmates participating in programs, recreation, library, visitation, etc., away from the housing area.', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(159, 27, 'How to complete Inmate Count Sheet', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(160, 28, 'The Trainee collects inmate request forms and forwards them to the appropriate department', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(161, 28, 'Ensuring that inmate movements and activities are entered in the Offender Management System daily, and update changes to inmate status as needed', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(162, 28, 'The Trainee documents all security checks, programs, recreation, library, visitation, meal counts, and other information on the Officer’s Log or Security and Observation Log', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(163, 29, 'The Trainee collects accurate inmate meal counts and forwards them at the scheduled times', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(164, 29, 'The Trainee supervises the delivery of meals ensuring all inmates receive a meal', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(165, 29, 'Ensures that special diets are served to the designated inmates', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(166, 29, 'Contacts on-duty Supervisor when there are mistakes in the meal service', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(167, 29, 'Counts and collects food trays in an efficient and timely manner', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(168, 30, 'Ensures that inmates observe acceptable hygiene practices daily', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(169, 30, 'Distributes razors and documents the distribution and collection on the Officer’s Log and/or Security and Observation Log', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(170, 30, 'Upon retrieving the razor, the Officer thoroughly inspect the razor', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(171, 31, 'The Trainee attempts to correct any condition observed to be hazardous to the health and safety of any person and notifies immediate Supervisor', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(172, 31, 'The Trainee inventories and request cleaning and sanitation supplies daily', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(173, 31, 'The Trainee checks electrical wiring plugs, etc., for wear to maintain safe operation', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(174, 31, 'The Trainee inspects cells for cleanliness and excess trash', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(175, 32, 'Shown functions of Psych-Counseling Referral Form', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(176, 32, 'The Trainee demonstrates the ability to identify inmates who show signs of mental or emotional disorders', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(177, 32, 'The Trainee reports to their Supervisor any unusual behavior which might indicate a suicide attempt', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(178, 32, 'The Trainee inventories the First Aid Kit when taking over their assigned post', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(179, 32, 'The Trainee investigates and documents injuries to staff and inmates that may occur, and ensure reports are written and submitted before the end of tour of shift', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(180, 32, 'The Trainee supervises the delivery of meds ensuring all inmates called receive them', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(181, 32, 'The Trainee documents inmates who refuse meds', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(182, 32, 'Shown functions of Inmate Medical Refusal Form', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(183, 33, 'The Trainee is aware of the location of all AED Machines', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(184, 34, 'Conducts orientations with newly assigned inmates on inmate rules and regulations', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(185, 34, 'The Trainee keeps abreast of the Inmate Rules of Conduct, the sanctions available and take disciplinary actions as needed', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(186, 34, 'Remains alert to possible dangers, maintains and provides professional verbal commands to calm inmates', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(187, 34, 'Observes inmate behavior for conformity to the rules and regulations outlined in the Inmate Handbook', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(188, 34, 'Recognizes abnormal inmate behavior and takes appropriate action', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(189, 34, 'Resolves inmate conflicts and concerns either verbally or on an Inmate Request Form', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(190, 34, 'Endures verbal and mental abuse professionally when confronted with hostile views and opinions form inmates', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(191, 34, 'The Trainee reprimands inmates for inmate rule violation(s) using personal discretion to decide when an inmate deserves disciplinary action to be taken', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(192, 34, 'The Trainee prepares a Disciplinary Report when disciplinary action is to be taken against an inmate and forward to Supervisor before the end of tour of duty', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(193, 34, 'Call for immediate assistance to place disruptive inmates in lockdown.', NULL, 9, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(194, 35, 'The Trainee demonstrates familiarity with the phonetic alphabet and radio 10-codes for dispatching emergency staff.', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(195, 35, 'The Trainee waits until the air is clear before pressing the radio transmit button', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(196, 35, 'The Trainee presses the radio transmit button firmly and speaks calmly and clearly into the microphone', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(197, 35, 'The Trainee understands when to activate the ANI Button and what to do if it is activated accidentally', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(198, 35, 'The Trainee uses discretion and courtesy whenever communicating by radio', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(199, 35, 'The Trainee identifies his/herself when utilizing the intercom system', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(200, 35, 'The Trainee properly asks for the correct door when requesting access', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(201, 36, 'The Trainee examines and distributes incoming and outgoing mail for contraband', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(202, 36, 'The Trainee opens and inspects all mail in front of the inmate receiving mail', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(203, 36, 'The Trainee distributes inmate mail in a timely manner', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(204, 36, 'The Trainee collects all inmate funds received, completes a receipt and document the amount, inmate name, ID number, and assigned cell on the receipt', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(205, 36, 'The Trainee notifies a Security Officer to pick up funds received through inmate mail and forwards to a Supervisor to deposit in safe', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(206, 36, 'Shown Property Release Form and functions of it', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(207, 37, 'The Trainee shall explain the policies regarding emergency procedures in the facility', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(208, 37, 'The Trainee shall identify the locations of first aid, fire protection, evacuation routes, and emergency security equipment', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(209, 37, 'Demonstrates the ability to properly use all safety and security equipment', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(210, 37, 'The Trainee checks fire extinguishers and breathing apparatuses for the charge status', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(211, 37, 'The Trainee demonstrates the proper use of fire extinguisher', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(212, 37, 'The Trainee retrieves the correct emergency keys in the event of an emergency', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(213, 37, 'The Trainee calls for assistance in emergencies', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(214, 37, 'The Trainee knows the procedures for evacuating inmates, staff, and/or visitors in the event of emergency', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(215, 37, 'Is the Trainee knowledgeable of the procedures to be followed in the event of a bomb threat, escapes, hostages, and fire drills?', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(216, 38, 'Demonstrates proper techniques to ensure the safety of all', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(217, 38, 'Knowledge of areas commonly used to hide contraband', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(218, 38, 'Knowledge of items considered being contraband', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(219, 38, 'Performs personal search of inmates to detect contraband', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(220, 38, 'Searches one side completely then the other, beginning at the inmates head', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(221, 38, 'Searches lower torso and legs', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(222, 38, 'Searches bra for contraband (female officer)', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(223, 38, 'Searches belt, shoes, socks clothing, etc., for contraband', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(224, 38, 'Searches all items removed from the inmate (wallet, cigarette packs, etc.)', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(225, 39, 'Remove items from inmate’s clothing and place them out of reach', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(226, 39, 'Knowledge of the circumstances under which a strip search may be legally conducted internally for concealed items', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(227, 39, 'Knowledge of proper handling of evidence seized during the search', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(228, 39, 'Trainee demonstrates systematic and consistent search of inmates', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(229, 39, 'Visual inspection of eyes, nose, ears, and month', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(230, 40, 'Proper techniques to ensure the safety of all involved', NULL, 0, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(231, 40, 'Proper use of tools and equipment needed to conduct a search', NULL, 1, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(232, 40, 'Knowledge of areas commonly used to hide contraband', NULL, 2, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(233, 40, 'Knowledge of items considered to be contraband', NULL, 3, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(234, 40, 'Observes cell before entering noting anything unusual', NULL, 4, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(235, 40, 'Started search systematically from left to right', NULL, 5, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(236, 40, 'Searched walls for items placed in cracks or holes and for tampering', NULL, 6, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(237, 40, 'Searched floors for holes and cracks to store contraband', NULL, 7, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(238, 40, 'Search washbasin, toilets, sinks, drains for tampering and contraband', NULL, 8, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(239, 40, 'Searched inmate’s personal items to include hygiene bottles for contraband', NULL, 9, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(240, 40, 'Search Shower stalls', NULL, 10, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(241, 40, 'Search dayroom area (tables, chairs, televisions) for contraband', NULL, 11, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(242, 40, 'Searched cell doors, locks, light fixtures, pipe chase, bunk, and drains, to detect tempering', NULL, 12, '2026-10-05 17:26:11', '2026-10-05 17:26:11'),
(243, 41, 'Properly issues equipment', NULL, 0, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(244, 41, 'Properly monitors Officer in Housing Unit Pods', NULL, 1, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(245, 41, 'Makes appropriate log entries during shift operations', NULL, 2, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(246, 41, 'Uses professional phone skills', NULL, 3, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(247, 41, 'Properly monitors inmates on the Recreation Yards', NULL, 4, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(248, 41, 'Makes appropriate notifications in emergency situations', NULL, 5, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(249, 41, 'Properly monitors inmate in Housing Unit Hallway', NULL, 6, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(250, 41, 'Properly monitors civilian traffic on Visitation Hallway', NULL, 7, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(251, 41, 'Makes appropriate documentation of inmates on count sheet', NULL, 8, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(252, 41, 'Properly monitors inmate traffic after lockdowns', NULL, 9, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(253, 41, 'Logs inmates on Out Count Sheet prior to leaving Unit Control area', NULL, 10, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(254, 42, 'Demonstrates familiarity with the phonetic code alphabet, radio 10-codes to include codes for dispatching emergency assistance', NULL, 0, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(255, 42, 'Waits until the air is clear before pressing the transmit button', NULL, 1, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(256, 42, 'Presses the transmit button firmly; speaks calmly and clear', NULL, 2, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(257, 42, 'Understands when to activate the AN! Button and what to do if it is activated accidentally', NULL, 3, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(258, 42, 'Uses discretion and courtesy when communication by radio', NULL, 4, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(259, 42, 'Correctly identifies his/herself when utilizing the intercom system', NULL, 5, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(260, 43, 'Can activate and deactivate the Unit Control Panel when not in use to forward power to Master Control', NULL, 0, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(261, 43, 'Controls and monitors inmate movement in and out of corridors', NULL, 1, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(262, 43, 'Allows access through security doors; when access is authorized', NULL, 2, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(263, 43, 'Conducts inspections of Unit Control area for safety and sanitation', NULL, 3, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(264, 43, 'The Trainee prohibits inmates from entering the Unit Control Station', NULL, 4, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(265, 43, 'Trainee identifies and retrieves emergency keys during an emergency', NULL, 5, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(266, 43, 'The Trainee ensures all security and related keys are accounted for and secured properly when not in use', NULL, 6, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(267, 43, 'Monitors the status of the pods at all times by using CCTV Screen', NULL, 7, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(268, 43, 'Conducts inventory of security and life safety equipment at post', NULL, 8, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(269, 43, 'Conducts radio check in the Housing Unit at the beginning of each shift', NULL, 9, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(270, 43, 'Notifies Movement Control Officer of inmate’s destination', NULL, 10, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(271, 44, 'CCTV (Closed Circuit Television) operation', NULL, 0, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(272, 44, 'Turning on and off the elevator', NULL, 1, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(273, 44, 'Paging System', NULL, 2, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(274, 44, 'Telephone Procedures; Transferring Calls', NULL, 3, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(275, 44, 'Touch Screen and Reset', NULL, 4, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(276, 44, 'Emergency Procedures', NULL, 5, '2026-10-05 17:31:59', '2026-10-05 17:31:59'),
(277, 44, 'Intercom System', NULL, 6, '2026-10-05 17:31:59', '2026-10-05 17:31:59');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_evaluations`
--

CREATE TABLE `training_book_part_module_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_evaluations`
--

INSERT INTO `training_book_part_module_evaluations` (`id`, `title`, `description`, `days`, `created_at`, `updated_at`) VALUES
(1, 'Housing Unit Evaluations', NULL, 14, '2026-10-05 17:38:57', '2026-10-05 17:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_evaluation_fields`
--

CREATE TABLE `training_book_part_module_evaluation_fields` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluation_id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) NOT NULL,
  `type` enum('text','textarea') NOT NULL DEFAULT 'textarea',
  `required` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_evaluation_fields`
--

INSERT INTO `training_book_part_module_evaluation_fields` (`id`, `evaluation_id`, `label`, `type`, `required`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Strengths', 'textarea', 0, 0, '2026-10-05 17:38:57', '2026-10-05 17:38:57'),
(2, 1, 'Weaknesses', 'textarea', 0, 1, '2026-10-05 17:38:57', '2026-10-05 17:38:57'),
(3, 1, 'Improvement on Previous Noted Weakneses', 'textarea', 0, 2, '2026-10-05 17:38:57', '2026-10-05 17:38:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_forms`
--

CREATE TABLE `training_book_part_module_forms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_forms`
--

INSERT INTO `training_book_part_module_forms` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Daily Forms', NULL, '2026-10-05 17:40:28', '2026-10-05 17:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_form_documents`
--

CREATE TABLE `training_book_part_module_form_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `form_module_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `original_file_name` varchar(255) NOT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_form_documents`
--

INSERT INTO `training_book_part_module_form_documents` (`id`, `form_module_id`, `title`, `file_path`, `original_file_name`, `file_size`, `sort_order`, `created_at`, `updated_at`) VALUES
(5, 1, 'EXPECTATION SPEECH', 'training/forms/AtySNp1qrAvgnuidKedR7pi3J8xlNuX2bpLtjzpI.pdf', 'EXPECTATION SPEECH.pdf', 273628, 1, '2026-10-05 19:25:30', '2026-10-05 19:25:30'),
(6, 1, 'f139c', 'training/forms/y5BO7JukJdOwuoFWsjUGm35PNEEZUFe1kHPHgSf2.pdf', 'f139c.pdf', 110999, 2, '2026-10-05 19:25:30', '2026-10-05 19:25:30'),
(7, 1, 'f214', 'training/forms/93lR2HG9RWDWBwvbfO2w0het6hMjGevf4hSDZJgD.pdf', 'f214.pdf', 191822, 3, '2026-10-05 19:25:30', '2026-10-05 19:25:30'),
(8, 1, 'f270b', 'training/forms/keyOrWlWALc4UYGDVm4WS2jj11AOclZrzYznh5Ip.pdf', 'f270b.pdf', 71261, 4, '2026-10-05 19:25:30', '2026-10-05 19:25:30');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_media`
--

CREATE TABLE `training_book_part_module_media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_media_files`
--

CREATE TABLE `training_book_part_module_media_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `media_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` enum('image','video') NOT NULL,
  `file` varchar(255) NOT NULL,
  `original_file_name` varchar(255) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `file_size` bigint(20) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_paragraphs`
--

CREATE TABLE `training_book_part_module_paragraphs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_paragraphs`
--

INSERT INTO `training_book_part_module_paragraphs` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Introduction', NULL, '2026-10-05 16:13:56', '2026-10-05 16:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_paragraph_contents`
--

CREATE TABLE `training_book_part_module_paragraph_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `section_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_paragraph_contents`
--

INSERT INTO `training_book_part_module_paragraph_contents` (`id`, `section_id`, `content`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'The initial Orientation begins with Human Resources providing and collecting information on the following: Personnel Forms, Job Descriptions and/or Post Orders, taking the Oath of Duties, signing the Code of Ethics, Facility Tour, Staff Identification, and Uniform/Equipment Issue.', 0, '2026-10-05 16:13:56', '2026-10-06 11:11:05'),
(2, 1, 'A copy of the Employee Handbook will be given to all during the process for all new employees and must be completed prior to the officer being assigned to a post. All new employees and Human Resources will sign and date Policy Number 1.18, “Employee Handbook,” on the Acceptance and Acknowledgement Form, indicating they have received Orientation. Human Resources will forward this packet and any additional information to the Training Department.', 1, '2026-10-05 16:13:56', '2026-10-06 11:11:05'),
(3, 1, 'During their first 10 days of employment, Training Staff will discuss Hazardous Materials, Infectious Diseases,  Blood and Bodily Fluid Protection, Rules of Conduct, Sexual Harassment, Cultural Diversity, Ethics in Corrections, and Universal Health Precautions.', 2, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(4, 2, 'Field Training: A structured On-The-Job Training and evaluation for any newly hired or recently transferred employee from another division within the facility.', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(5, 2, 'Field Training Officer: An experienced and qualified Jail Officer assigned to properly train and evaluate Trainees in their newly appointed assignments. The title Field Training Officer (FTO) refers to a designated post assignment within the Riverside Regional Jail and not a rank. Once selected he or she will be referred to as an FTO and will assume an active role only when assigned a Trainee. When a FTO is not currently assigned a Trainee, he or she may retain the title of FTO but shall perform other required duties as assigned.', 1, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(6, 2, 'Trainee: Any newly hired or recently transferred employee requiring On-The-Job Training and currently assigned to an FTO or Senior Officer.', 2, '2026-10-05 16:13:56', '2026-10-06 11:14:39'),
(7, 2, 'Remedial Training: Any training provided in the form of one-on-one counseling, classroom instruction, and/or field training that is in addition to the regularly scheduled instruction.', 3, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(8, 3, 'The goal of the Field Training Program is to establish a structured On-The-Job Training System. This program will continually provide the Riverside Regional Jail with sufficiently trained employees who can safely and competently perform all assigned duties. Furthermore, it is the goal of the training program that after four to six weeks of field training, the Trainee will be proficient enough to perform the duties of a Jail Officer for the Riverside Regional Jail on his/her own.', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(9, 3, 'All new Jail Officers will be trained in two major steps: Field and Academy Training. Each Trainee will successfully complete minimum standards training (400) hours at a Basic Jailor Academy as mandated by the Department of Criminal Justice Services. Initial Field Training will include (80) hours new employee orientation training in a classroom environment. New Officers will also complete a minimum of (80) hours training in their assigned area for a total of (160) hours.', 1, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(10, 4, '', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(11, 5, '', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(12, 6, 'The purpose of the evaluation process is twofold: It allows the FTO to communicate to the Trainee the duties functions to be performed during the shift. This also allows the FTO, Supervisor and Trainee an opportunity to discuss the employee’s strengths, weaknesses, and set daily goals for the next evaluation and determine if Remedial Training is needed.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(13, 7, 'Individual counseling or training in any specific areas of deficiencies may be provided in conjunction with the Field Training. Such counseling or training may occur during post assignments and also during the daily evaluation segments.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(14, 8, 'Questions will be addressed through the Chain of Command. The Trainee is responsible for having the OJT Book with them each day. The Trainee is required to sign the Daily Evaluation Sheets on a daily basis.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_paragraph_lists`
--

CREATE TABLE `training_book_part_module_paragraph_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('bullet','ordered','alphabetical') NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_paragraph_lists`
--

INSERT INTO `training_book_part_module_paragraph_lists` (`id`, `paragraph_id`, `type`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 10, 'bullet', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(2, 11, 'alphabetical', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(3, 12, 'alphabetical', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(4, 13, 'alphabetical', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_paragraph_list_items`
--

CREATE TABLE `training_book_part_module_paragraph_list_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `list_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_paragraph_list_items`
--

INSERT INTO `training_book_part_module_paragraph_list_items` (`id`, `list_id`, `content`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Completes the Daily Evaluation Forms on the Trainee', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(2, 1, 'Reviews the Daily Evaluations with the Trainee', 1, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(3, 1, 'Completes the OJT Checklists as the Trainee completes each task assigned', 2, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(4, 1, 'Conducts job related counseling on the Trainee’s performance', 3, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(5, 1, 'Recommends and provides Remedial Training (if needed)', 4, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(6, 1, 'Documents strengths and weaknesses of the Trainee and forward such to the Shift Supervisor and Lieutenant', 5, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(7, 1, 'Evaluates the Trainee’s compliance with review of Standard Operating Procedures', 6, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(8, 1, 'Evaluates review and demonstration of duties required of the Post Order(s)', 7, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(9, 2, 'The Trainee will be assigned to a Field Training Officer and/or Senior Officer for a minimum of two weeks (80) hours. Field Training may also be initiated following a transfer to another unfamiliar post assignment. The length of Field Training for a recently transferred employee may be less than two weeks.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(10, 2, 'The Trainee will be assigned a 35 question exam thru Relias in which he/she will have to receive a score of 100%.', 1, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(11, 2, 'Prior to the completion of the initial two weeks of training, the Trainee shall have been assigned to and performed under direct supervision of the FTO all required post assignments.', 2, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(12, 2, 'Besides the daily training and evaluation during shift assignments, the Trainee shall be additionally trained, evaluated and/or counseled by the FTO prior to the conclusion of each work shift. This will be conducted after the FTO and the Trainee is relieved of all post responsibilities and will consist of one-on-one sessions between the two.', 3, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(13, 2, 'The FTO shall evaluate and document the Trainee’s Daily Performance and schedule Remedial Training as needed.', 4, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(14, 2, 'No more than two Trainees will be assigned simultaneously to any Field Training Officer. The one-on-one ratio between FTO and Trainee shall be maintained unless otherwise approved and directed by the Lieutenant. However, in the event of an FTO shortage the additional Trainee will be assigned to a Senior Officer or a Supervisor until a FTO becomes available. Furthermore, a team of one FTO and one Trainee shall be assigned to only one post at a time.', 5, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(15, 3, 'Evaluations will be documented on the Daily Evaluation Forms. The Trainee must have reviewed the designated Standard Operating Procedures, Post Order, and this OJT Checklist.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(16, 3, 'The Supervisor shall continue to monitor the Trainee’s performance while the Trainee is assigned to a FTO and offer Remedial Training in the event that it is needed. Upon successful completion of the (80) hours of Field Training, the Trainee will be assigned to the post for an additional two weeks without the FTO’s Direct Supervision.', 1, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(17, 3, 'The Trainee will be observed and evaluated by their immediate Supervisor. The Supervisor shall be particularly concerned with the Trainee’s ability to work the assigned post independently without direct and constant supervision. After two weeks of satisfactory performance, the Supervisor shall complete the Daily Evaluation Form and review this with the Trainee. The Supervisor may certify the Trainee for independent assignment or recommend further Remedial Training.', 2, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(18, 3, 'Strengths: Allows the FTO, Supervisor and Trainee an opportunity to discuss the employee’s strengths. The Daily Evaluation is used to evaluate the Trainee’s performance. A written statement documenting the most acceptable performances observed by the FTO and Supervisor during training.', 3, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(19, 3, 'Weaknesses: Allows the FTO, Supervisor and Trainee an opportunity to discuss the employee’s weaknesses, and set goals to determine if Remedial Training is needed. The Daily Evaluation is used to evaluate the Trainee’s performance. A written statement documenting the least acceptable area of performance (Deficiencies) observed by the FTO and Supervisor during training.', 4, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(20, 3, 'Remedial Training: Allows the FTO, Supervisor and Trainee an opportunity to discuss with the Trainee the weaknesses and areas of deficiencies to be corrected during Remedial Training.', 5, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(21, 3, 'Recommendation: The overall recommendation is based on the evaluations conducted for the duration of the On-The-Job-Training. A written statement documenting the most and least acceptable performances and deficiencies observed by the FTO and Supervisor at the conclusion of training. The entire OJT Packet will be forwarded to the Superintendent through the Chain of Command for approval.', 6, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(22, 4, 'Any FTO, at the conclusion of the (80) hours of Field Training may recommend the Trainee for Remedial Training. Trainees may be scheduled for up to four weeks of Remedial Training, this training will run in two-week increments. When Remedial Training is scheduled, the Trainee will be assigned to a different FTO or Senior Officer who has not made the recommendation for Remedial Training.', 0, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(23, 4, 'Any FTO who is assigned a Trainee for Remedial Training may recommend termination at the end of the two or four weeks of training. If any Trainee is recommended for additional four weeks of Remedial Training, the Supervisor may suspend the Trainee’s OJT (field training) and forward the recommendation(s) for approval or termination to the Superintendent through the Chain of Command.', 1, '2026-10-05 16:13:57', '2026-10-05 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_paragraph_sections`
--

CREATE TABLE `training_book_part_module_paragraph_sections` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paragraph_module_id` bigint(20) UNSIGNED NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_paragraph_sections`
--

INSERT INTO `training_book_part_module_paragraph_sections` (`id`, `paragraph_module_id`, `heading`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Orientation', 0, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(2, 1, 'Definitions', 1, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(3, 1, 'Goals and Objectives of the Field Training Program', 2, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(4, 1, 'Responsibilities of the Field Training Officer (FTO)', 3, '2026-10-05 16:13:56', '2026-10-05 16:13:56'),
(5, 1, 'On-The-Job Training', 4, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(6, 1, 'Evaluations', 5, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(7, 1, 'Remedial Training', 6, '2026-10-05 16:13:57', '2026-10-05 16:13:57'),
(8, 1, 'Expectations of Training', 7, '2026-10-05 16:13:57', '2026-10-05 16:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_signoff_requirements`
--

CREATE TABLE `training_book_part_module_signoff_requirements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `book_part_module_id` bigint(20) UNSIGNED NOT NULL,
  `signer_role` varchar(255) NOT NULL,
  `scope` enum('module','item') NOT NULL DEFAULT 'module',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_signoff_requirements`
--

INSERT INTO `training_book_part_module_signoff_requirements` (`id`, `book_part_module_id`, `signer_role`, `scope`, `sort_order`, `created_at`, `updated_at`) VALUES
(2, 2, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(3, 3, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(4, 3, 'fto', 'module', 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(5, 4, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(6, 4, 'fto', 'module', 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(7, 6, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(8, 6, 'fto', 'module', 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(9, 7, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(10, 7, 'fto', 'module', 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(11, 8, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(12, 8, 'fto', 'module', 1, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(13, 8, 'supervisor', 'module', 2, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(14, 9, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44'),
(15, 10, 'trainee', 'module', 0, '2026-10-05 17:59:44', '2026-10-05 17:59:44');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_sop_checklists`
--

CREATE TABLE `training_book_part_module_sop_checklists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_sop_checklists`
--

INSERT INTO `training_book_part_module_sop_checklists` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Standard Operating Procedure Acceptance and Acknowledgement', NULL, '2026-10-05 17:54:21', '2026-10-05 17:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_sop_checklist_groups`
--

CREATE TABLE `training_book_part_module_sop_checklist_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sop_checklist_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `section_number` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_sop_checklist_groups`
--

INSERT INTO `training_book_part_module_sop_checklist_groups` (`id`, `sop_checklist_id`, `title`, `section_number`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Administration/Management', '1', NULL, 0, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(2, 1, 'Personnel', '3.0', NULL, 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(3, 1, 'Training/Staff Development', '5', NULL, 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(4, 1, 'Management Information/Research', '6', NULL, 3, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(5, 1, 'Safety/Sanitation/Hygeine', NULL, NULL, 4, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(6, 1, 'Security/Control/Inmate Discipline', NULL, NULL, 5, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(7, 1, 'Special Management Inmates', '11', NULL, 6, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(8, 1, 'Inmate Rights', '16', NULL, 7, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(9, 1, 'Emergency Plans', '17', NULL, 8, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(10, 1, 'Communication/Mail/Visitation', '18', NULL, 9, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(11, 1, 'Admission/Property Control/Release', '19', NULL, 10, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(12, 1, 'Classification', '20', NULL, 11, '2026-10-05 17:54:22', '2026-10-05 17:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_sop_checklist_policies`
--

CREATE TABLE `training_book_part_module_sop_checklist_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `policy_number` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_sop_checklist_policies`
--

INSERT INTO `training_book_part_module_sop_checklist_policies` (`id`, `group_id`, `policy_number`, `title`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, '1.5', 'Office of Professional Review', 0, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(2, 1, '1.6', 'Staff and Inmate Communications', 1, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(3, 1, '1.10', 'Employee Rules of Conduct', 2, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(4, 1, '1.12', 'Staff Roll Call', 3, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(5, 1, '1.14', 'Staff Breaks and Meals', 4, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(6, 1, '1.15', 'Tobacco Use Policy', 5, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(7, 1, '1.17', 'Uniform and Grooming', 6, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(8, 1, '1.18', 'Employee Handbook', 7, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(9, 1, '1.26', 'Employee Salary & Benefits', 8, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(10, 1, '1.27', 'Drug-Free Workplace', 9, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(11, 1, '1.33', 'Employee Leave', 10, '2026-10-05 17:54:21', '2026-10-05 17:54:21'),
(12, 2, '3.2', 'Probationary Employment', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(13, 2, '3.3', 'Promotion, Transfer, Demotion and Resignation', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(14, 2, '3.5', 'Employee Grievance', 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(15, 2, '3.6', 'Performance Evaluations', 3, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(16, 2, '3.9', 'Employee Discipline', 4, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(17, 2, '3,12', 'Workplace Harassment & Violence', 5, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(18, 2, '3.13', 'Peer Support', 6, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(19, 3, '5.1', 'Staff Training', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(20, 3, '5.2', 'Firearms, Electronic Devices and Munitions', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(21, 3, '5.3', 'Field Training Program', 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(22, 4, '6.5', 'E-Mail and Internet Access', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(23, 5, '9.6', 'Inmate Personal Hygiene', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(24, 6, '10.1', 'Control Centers', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(25, 6, '10.2', 'Radio Procedures', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(26, 6, '10.3', 'Inmate Movement', 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(27, 6, '10.4', 'Inmate Supervision', 3, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(28, 6, '10.5', 'Logs and Reports', 4, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(29, 6, '10.7', 'Inmate Counts', 5, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(30, 6, '10.8', 'Contraband Control', 6, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(31, 6, '10.9', 'Physical Searches', 7, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(32, 6, '10.10', 'Use of Force', 8, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(33, 6, '10.11', 'Use of Restraints', 9, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(34, 6, '10.12', 'Key Control', 10, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(35, 6, '10.18', 'Facility Shakedowns', 11, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(36, 6, '10.19', 'Inmate Conduct and Discipline', 12, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(37, 6, '10.20', 'Security Inspections', 13, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(38, 6, '10.27', 'Gang/Security Threat Group', 14, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(39, 6, '10.28', 'Reporting of Violent Offenses', 15, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(40, 7, '11.1', 'Sexual Misconduct', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(41, 7, '11.2', 'Sexual Assault Team (SART) Protocols', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(42, 8, '16.1', 'Inmate Rights and Grievances', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(43, 9, '17.1', 'Emergency Plan', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(44, 9, '17.2', 'Fire Emergency Plan', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(45, 9, '17.3', 'Situational Response Plans', 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(46, 9, '17.4', 'Disaster Recovery Plan', 3, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(47, 10, '18.2', 'Inmate Telephone Access', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(48, 10, '18.3', 'Visitation', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(49, 10, '18.4', 'Inmate Tablets', 2, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(50, 10, '18.5', 'Inmate Handbook', 3, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(51, 11, '19.8', 'Inmate Identification', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(52, 11, '19:9', 'Inmate Transports', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(53, 12, '20.2', 'At-Risk Inmate Populations', 0, '2026-10-05 17:54:22', '2026-10-05 17:54:22'),
(54, 12, '20.3', 'Segregated Housing', 1, '2026-10-05 17:54:22', '2026-10-05 17:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_tests`
--

CREATE TABLE `training_book_part_module_tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `passing_score` int(10) UNSIGNED DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_tests`
--

INSERT INTO `training_book_part_module_tests` (`id`, `title`, `description`, `passing_score`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Scenario Worksheet', NULL, NULL, 0, '2026-10-05 17:38:00', '2026-10-05 17:38:00');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_test_questions`
--

CREATE TABLE `training_book_part_module_test_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `test_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('multiple_choice','true_false','free_form') NOT NULL,
  `question` text NOT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_book_part_module_test_questions`
--

INSERT INTO `training_book_part_module_test_questions` (`id`, `test_id`, `type`, `question`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'free_form', 'While sitting at the officer station you hear Inmate Murray and Inmate Rhodes arguing in the dayroom area. The argument continues to get louder and both inmates use profanity toward one another. Explain how you would handle this situation.', 0, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(2, 1, 'free_form', 'You are conducting a round on the top tier when you here a loud noise near the microwave suddenly a large amount of smoke comes from the microwave area. Explain how you would handle this situation.', 1, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(3, 1, 'free_form', 'During your security and observation round you notice two inmates enter the same shower area. Explain how you would handle this situation.', 2, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(4, 1, 'free_form', 'Inmate Douglas is very upset this morning. Once you open the cell doors to give your expectation speech (pod meeting), Inmate Douglas begins yelling and throwing items out of the cell. You asked Inmate Douglas to lockdown and he/she refused. Explain how you would handle this situation.', 3, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(5, 1, 'free_form', 'During the security and observation round you see large amounts of water flowing from the sprinkler head in cell #32. Explain how you would handle this situation.', 4, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(6, 1, 'free_form', 'List all possible options you can use as the Pod Officer to discipline the inmates.', 5, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(7, 1, 'free_form', 'You are conducting medication in the pod. Inmate Berry comes up to receive his/her medication. When you check Inmate Berry’s mouth you notice a pill in his/her cheek. Explain how you would handle this situation.', 6, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(8, 1, 'free_form', 'You are conducting your round on the bottom tier, when you hear Inmate Owens and Inmate Nelson cursing and yelling at one another. Inmate Nelson hits Inmate Owens in the face and the two inmates begin to fight. Explain how you would handle this situation.', 7, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(9, 1, 'free_form', 'Inmate Davis lives on the bottom tier and you find Inmate Davis inside cell #43 going through a bin. Explain how you would handle this situation.', 8, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(10, 1, 'free_form', 'Medication enters your pod to conduct medication. You notice the medication line is very long. You need to stop medication in order to make a round. You notice two inmates are tattooing each other. Explain how you would handle this situation.', 9, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(11, 1, 'free_form', 'As the Pod Officer list some things you should look for when looking inside of the cells making your security and observation rounds.', 10, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(12, 1, 'free_form', 'What are some things you should do in the pod as the Pod Officer to be security conscious (to protect yourself and other inmates)?', 11, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(13, 1, 'free_form', 'Explain how to put an incident/misconduct report into the OMS.', 12, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(14, 1, 'free_form', 'Explain the difference between the minor misconduct report and major misconduct report. Describe the process that needs to be performed in order to put the report into the OMS System.', 13, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(15, 1, 'free_form', 'Describe how to perform Canteen. (List what the inmates are required to do).', 14, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(16, 1, 'free_form', 'Describe how to perform Laundry. (List what the inmates are required to do)', 15, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(17, 1, 'free_form', 'Describe how to perform medication. (List what the inmates are required to do).', 16, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(18, 1, 'free_form', 'Write your expectation speech', 17, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(19, 1, 'free_form', 'What is the importance of having a clean pod, desk, and making sure the inmates have a clean cell?', 18, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(20, 1, 'free_form', 'Describe how command inspection is performed and list some things that need to be done in preparation for command inspection.', 19, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(21, 1, 'free_form', 'While you are serving meal trays an inmate falls onto the floor and his body starts shaking profusely. What would you do?', 20, '2026-10-05 17:38:00', '2026-10-05 17:38:00'),
(22, 1, 'free_form', 'What items are you required to bring with you before evacuating your pod in the event of an emergency?', 21, '2026-10-05 17:38:01', '2026-10-05 17:38:01'),
(23, 1, 'free_form', 'Explain the procedure for inmates and family to schedule visitation.', 22, '2026-10-05 17:38:01', '2026-10-05 17:38:01'),
(24, 1, 'free_form', 'Describe the procedure for new intakes in your pod.', 23, '2026-10-05 17:38:01', '2026-10-05 17:38:01'),
(25, 1, 'free_form', 'What is updated monthly in the pod and the Housing Units?', 24, '2026-10-05 17:38:01', '2026-10-05 17:38:01'),
(26, 1, 'free_form', 'You see an inmate walking around the day room area without an ID Card, explain how you would handle this situation.', 25, '2026-10-05 17:38:01', '2026-10-05 17:38:01');

-- --------------------------------------------------------

--
-- Table structure for table `training_book_part_module_test_question_options`
--

CREATE TABLE `training_book_part_module_test_question_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `option` text NOT NULL,
  `is_correct` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `training_module_categories`
--

CREATE TABLE `training_module_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_module_categories`
--

INSERT INTO `training_module_categories` (`id`, `name`, `description`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'OJT Handbook', 'Modules that are covered in the OJT Handbook for new hires.', 0, '2026-10-05 15:58:35', '2026-10-05 15:58:35');

-- --------------------------------------------------------

--
-- Table structure for table `training_module_category_assignments`
--

CREATE TABLE `training_module_category_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `module_type` varchar(255) NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `training_module_category_assignments`
--

INSERT INTO `training_module_category_assignments` (`id`, `category_id`, `module_type`, `module_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'paragraph', 1, NULL, NULL),
(2, 1, 'checklist', 1, NULL, NULL),
(3, 1, 'checklist', 2, NULL, NULL),
(4, 1, 'checklist', 3, NULL, NULL),
(5, 1, 'checklist', 4, NULL, NULL),
(6, 1, 'test', 1, NULL, NULL),
(7, 1, 'evaluation', 1, NULL, NULL),
(8, 1, 'form', 1, NULL, NULL);

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
  `warehouse_role` enum('Warehouse Supervisor','Warehouse Technician','Property','Supervisor','Requestor') DEFAULT NULL,
  `jurisdiction` tinyint(1) NOT NULL DEFAULT 0,
  `camera` tinyint(1) NOT NULL DEFAULT 0,
  `training_role` enum('admin','director','unit','supervisor','sergeant','fto','trainee') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `password`, `admin`, `phone`, `vfm`, `vfm30`, `vfm_tech`, `ics`, `policy`, `warehouse_role`, `jurisdiction`, `camera`, `training_role`, `created_at`, `updated_at`) VALUES
(1, 'Tuggle', 'Mark', 'tugglem@rrjva.org', '$2y$12$UPRe6kpDEG7OfY02TU.uGOnPoE1g/822rbgmSXuer0cCo5KzDa0Ve', 1, 0, 0, 0, 0, 0, 0, 'Warehouse Supervisor', 0, 0, 'trainee', '2026-09-29 11:31:26', '2026-10-05 18:00:22'),
(2, 'Marlowe', 'Neil', 'nmarlowe@rrjva.org', '$2y$12$fVSJ/7TMPxzXIGMPl9TRjuAnaG2oVToE1fu4hjBGC97izq4ccOTOy', 1, 0, 0, 0, 0, 0, 0, 'Warehouse Supervisor', 0, 0, 'admin', '2026-09-29 11:31:27', '2026-09-29 11:31:27'),
(3, 'Hartsell', 'Dana', 'hartsell.dana@rrjva.org', '$2y$12$ewVqLDugySsKtTaWzEwFEOJWOVZJl22Bj9Hdswb.ahome/M8hMJP.', 0, 0, 0, 0, 0, 0, 0, 'Requestor', 0, 0, 'admin', '2026-09-29 11:31:28', '2026-09-29 11:31:28'),
(4, 'Michael', 'DeVaughn', 'devaughnm@rrjva.org', '$2y$12$of2ntnDQHEgk3fqOokPhqO8.APRcxo67V66iVZLW7wX3CUCAjVnJy', 0, 0, 0, 0, 0, 0, 0, 'Requestor', 0, 0, 'admin', '2026-09-29 11:31:29', '2026-09-29 11:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `vfm`
--

CREATE TABLE `vfm` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vfm_vehicle_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vehicle_make` varchar(255) DEFAULT NULL,
  `vehicle_model` varchar(255) DEFAULT NULL,
  `vehicle_vin` varchar(255) DEFAULT NULL,
  `vehicle_license_plate` varchar(255) DEFAULT NULL,
  `vehicle_year` int(11) DEFAULT NULL,
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
-- Indexes for table `camera_future_ip_address`
--
ALTER TABLE `camera_future_ip_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `camera_statuses`
--
ALTER TABLE `camera_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `camera_statuses_camera_number_unique` (`camera_number`),
  ADD UNIQUE KEY `camera_statuses_camera_name_unique` (`camera_name`);

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
-- Indexes for table `policy_builders`
--
ALTER TABLE `policy_builders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `policy_chapters`
--
ALTER TABLE `policy_chapters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_chapters_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `policy_chapter_paragraphs`
--
ALTER TABLE `policy_chapter_paragraphs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_chapter_paragraphs_section_id_foreign` (`section_id`);

--
-- Indexes for table `policy_chapter_paragraph_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_chapter_paragraph_bullets_paragraph_id_foreign` (`paragraph_id`);

--
-- Indexes for table `policy_chapter_paragraph_bullet_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullet_bullets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_chapter_paragraph_bullet_bullets_bullet_id_foreign` (`bullet_id`);

--
-- Indexes for table `policy_chapter_sections`
--
ALTER TABLE `policy_chapter_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_chapter_sections_chapter_id_foreign` (`chapter_id`);

--
-- Indexes for table `policy_definitions`
--
ALTER TABLE `policy_definitions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_definitions_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `policy_references`
--
ALTER TABLE `policy_references`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_references_policy_id_foreign` (`policy_id`);

--
-- Indexes for table `policy_reference_paragraphs`
--
ALTER TABLE `policy_reference_paragraphs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_reference_paragraphs_reference_id_foreign` (`reference_id`);

--
-- Indexes for table `policy_reference_paragraph_bullets`
--
ALTER TABLE `policy_reference_paragraph_bullets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `policy_reference_paragraph_bullets_paragraph_id_foreign` (`paragraph_id`);

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
-- Indexes for table `training_books`
--
ALTER TABLE `training_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_assignments`
--
ALTER TABLE `training_book_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_assignment_user_fk` (`user_id`),
  ADD KEY `book_assignment_book_fk` (`book_id`);

--
-- Indexes for table `training_book_assignment_evaluations`
--
ALTER TABLE `training_book_assignment_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_evaluation_module_fk` (`assignment_module_id`),
  ADD KEY `training_book_assignment_evaluations_completed_by_foreign` (`completed_by`);

--
-- Indexes for table `training_book_assignment_modules`
--
ALTER TABLE `training_book_assignment_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignment_module_unique` (`assignment_id`,`book_part_module_id`),
  ADD KEY `assign_module_part_module_fk` (`book_part_module_id`);

--
-- Indexes for table `training_book_assignment_module_items`
--
ALTER TABLE `training_book_assignment_module_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignment_module_item_unique` (`assignment_module_id`,`module_item_id`);

--
-- Indexes for table `training_book_assignment_signoffs`
--
ALTER TABLE `training_book_assignment_signoffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `assignment_signoff_unique` (`signable_type`,`signable_id`,`signoff_requirement_id`),
  ADD KEY `assignment_signoff_req_fk` (`signoff_requirement_id`),
  ADD KEY `assignment_signoff_user_fk` (`signed_by`),
  ADD KEY `assignment_signable_idx` (`signable_type`,`signable_id`);

--
-- Indexes for table `training_book_parts`
--
ALTER TABLE `training_book_parts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_book_parts_book_id_foreign` (`book_id`);

--
-- Indexes for table `training_book_part_modules`
--
ALTER TABLE `training_book_part_modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_book_part_modules_book_part_id_foreign` (`book_part_id`),
  ADD KEY `training_book_part_modules_module_type_module_id_index` (`module_type`,`module_id`);

--
-- Indexes for table `training_book_part_module_checklists`
--
ALTER TABLE `training_book_part_module_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_checklist_groups`
--
ALTER TABLE `training_book_part_module_checklist_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_book_part_module_checklist_groups_checklist_id_foreign` (`checklist_id`);

--
-- Indexes for table `training_book_part_module_checklist_items`
--
ALTER TABLE `training_book_part_module_checklist_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_book_part_module_checklist_items_group_id_foreign` (`group_id`);

--
-- Indexes for table `training_book_part_module_evaluations`
--
ALTER TABLE `training_book_part_module_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_evaluation_fields`
--
ALTER TABLE `training_book_part_module_evaluation_fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_field_eval_fk` (`evaluation_id`);

--
-- Indexes for table `training_book_part_module_forms`
--
ALTER TABLE `training_book_part_module_forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_form_documents`
--
ALTER TABLE `training_book_part_module_form_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_document_module_fk` (`form_module_id`);

--
-- Indexes for table `training_book_part_module_media`
--
ALTER TABLE `training_book_part_module_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_media_files`
--
ALTER TABLE `training_book_part_module_media_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `training_book_part_module_media_files_media_id_foreign` (`media_id`);

--
-- Indexes for table `training_book_part_module_paragraphs`
--
ALTER TABLE `training_book_part_module_paragraphs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_paragraph_contents`
--
ALTER TABLE `training_book_part_module_paragraph_contents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paragraph_content_section_fk` (`section_id`);

--
-- Indexes for table `training_book_part_module_paragraph_lists`
--
ALTER TABLE `training_book_part_module_paragraph_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paragraph_list_paragraph_fk` (`paragraph_id`);

--
-- Indexes for table `training_book_part_module_paragraph_list_items`
--
ALTER TABLE `training_book_part_module_paragraph_list_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paragraph_list_item_list_fk` (`list_id`);

--
-- Indexes for table `training_book_part_module_paragraph_sections`
--
ALTER TABLE `training_book_part_module_paragraph_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paragraph_section_module_fk` (`paragraph_module_id`);

--
-- Indexes for table `training_book_part_module_signoff_requirements`
--
ALTER TABLE `training_book_part_module_signoff_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `signoff_req_module_fk` (`book_part_module_id`);

--
-- Indexes for table `training_book_part_module_sop_checklists`
--
ALTER TABLE `training_book_part_module_sop_checklists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_sop_checklist_groups`
--
ALTER TABLE `training_book_part_module_sop_checklist_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_group_checklist_fk` (`sop_checklist_id`);

--
-- Indexes for table `training_book_part_module_sop_checklist_policies`
--
ALTER TABLE `training_book_part_module_sop_checklist_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sop_policy_group_fk` (`group_id`);

--
-- Indexes for table `training_book_part_module_tests`
--
ALTER TABLE `training_book_part_module_tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `training_book_part_module_test_questions`
--
ALTER TABLE `training_book_part_module_test_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_questions_test_fk` (`test_id`);

--
-- Indexes for table `training_book_part_module_test_question_options`
--
ALTER TABLE `training_book_part_module_test_question_options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `test_options_question_fk` (`question_id`);

--
-- Indexes for table `training_module_categories`
--
ALTER TABLE `training_module_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `training_module_categories_name_unique` (`name`);

--
-- Indexes for table `training_module_category_assignments`
--
ALTER TABLE `training_module_category_assignments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_category_unique` (`category_id`,`module_type`,`module_id`),
  ADD KEY `module_category_module_idx` (`module_type`,`module_id`);

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
-- AUTO_INCREMENT for table `camera_future_ip_address`
--
ALTER TABLE `camera_future_ip_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `camera_statuses`
--
ALTER TABLE `camera_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurisdictions`
--
ALTER TABLE `jurisdictions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurisdiction_time_log`
--
ALTER TABLE `jurisdiction_time_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `monthly_report_recipients`
--
ALTER TABLE `monthly_report_recipients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_directory`
--
ALTER TABLE `phone_directory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE `policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_builders`
--
ALTER TABLE `policy_builders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_chapters`
--
ALTER TABLE `policy_chapters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_chapter_paragraphs`
--
ALTER TABLE `policy_chapter_paragraphs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_chapter_paragraph_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_chapter_paragraph_bullet_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullet_bullets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_chapter_sections`
--
ALTER TABLE `policy_chapter_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_definitions`
--
ALTER TABLE `policy_definitions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_references`
--
ALTER TABLE `policy_references`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_reference_paragraphs`
--
ALTER TABLE `policy_reference_paragraphs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_reference_paragraph_bullets`
--
ALTER TABLE `policy_reference_paragraph_bullets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `training_books`
--
ALTER TABLE `training_books`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_assignments`
--
ALTER TABLE `training_book_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_assignment_evaluations`
--
ALTER TABLE `training_book_assignment_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_book_assignment_modules`
--
ALTER TABLE `training_book_assignment_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `training_book_assignment_module_items`
--
ALTER TABLE `training_book_assignment_module_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_book_assignment_signoffs`
--
ALTER TABLE `training_book_assignment_signoffs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_book_parts`
--
ALTER TABLE `training_book_parts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `training_book_part_modules`
--
ALTER TABLE `training_book_part_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `training_book_part_module_checklists`
--
ALTER TABLE `training_book_part_module_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_book_part_module_checklist_groups`
--
ALTER TABLE `training_book_part_module_checklist_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `training_book_part_module_checklist_items`
--
ALTER TABLE `training_book_part_module_checklist_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=278;

--
-- AUTO_INCREMENT for table `training_book_part_module_evaluations`
--
ALTER TABLE `training_book_part_module_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_part_module_evaluation_fields`
--
ALTER TABLE `training_book_part_module_evaluation_fields`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `training_book_part_module_forms`
--
ALTER TABLE `training_book_part_module_forms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_part_module_form_documents`
--
ALTER TABLE `training_book_part_module_form_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `training_book_part_module_media`
--
ALTER TABLE `training_book_part_module_media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_book_part_module_media_files`
--
ALTER TABLE `training_book_part_module_media_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_book_part_module_paragraphs`
--
ALTER TABLE `training_book_part_module_paragraphs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_part_module_paragraph_contents`
--
ALTER TABLE `training_book_part_module_paragraph_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `training_book_part_module_paragraph_lists`
--
ALTER TABLE `training_book_part_module_paragraph_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `training_book_part_module_paragraph_list_items`
--
ALTER TABLE `training_book_part_module_paragraph_list_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `training_book_part_module_paragraph_sections`
--
ALTER TABLE `training_book_part_module_paragraph_sections`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `training_book_part_module_signoff_requirements`
--
ALTER TABLE `training_book_part_module_signoff_requirements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `training_book_part_module_sop_checklists`
--
ALTER TABLE `training_book_part_module_sop_checklists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_part_module_sop_checklist_groups`
--
ALTER TABLE `training_book_part_module_sop_checklist_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `training_book_part_module_sop_checklist_policies`
--
ALTER TABLE `training_book_part_module_sop_checklist_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `training_book_part_module_tests`
--
ALTER TABLE `training_book_part_module_tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `training_book_part_module_test_questions`
--
ALTER TABLE `training_book_part_module_test_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `training_book_part_module_test_question_options`
--
ALTER TABLE `training_book_part_module_test_question_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `training_module_categories`
--
ALTER TABLE `training_module_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_module_category_assignments`
--
ALTER TABLE `training_module_category_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vfm`
--
ALTER TABLE `vfm`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vfm_vehicle`
--
ALTER TABLE `vfm_vehicle`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- Constraints for table `policy_chapters`
--
ALTER TABLE `policy_chapters`
  ADD CONSTRAINT `policy_chapters_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `policy_builders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_chapter_paragraphs`
--
ALTER TABLE `policy_chapter_paragraphs`
  ADD CONSTRAINT `policy_chapter_paragraphs_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `policy_chapter_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_chapter_paragraph_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullets`
  ADD CONSTRAINT `policy_chapter_paragraph_bullets_paragraph_id_foreign` FOREIGN KEY (`paragraph_id`) REFERENCES `policy_chapter_paragraphs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_chapter_paragraph_bullet_bullets`
--
ALTER TABLE `policy_chapter_paragraph_bullet_bullets`
  ADD CONSTRAINT `policy_chapter_paragraph_bullet_bullets_bullet_id_foreign` FOREIGN KEY (`bullet_id`) REFERENCES `policy_chapter_paragraph_bullets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_chapter_sections`
--
ALTER TABLE `policy_chapter_sections`
  ADD CONSTRAINT `policy_chapter_sections_chapter_id_foreign` FOREIGN KEY (`chapter_id`) REFERENCES `policy_chapters` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_definitions`
--
ALTER TABLE `policy_definitions`
  ADD CONSTRAINT `policy_definitions_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `policy_builders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_references`
--
ALTER TABLE `policy_references`
  ADD CONSTRAINT `policy_references_policy_id_foreign` FOREIGN KEY (`policy_id`) REFERENCES `policy_builders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_reference_paragraphs`
--
ALTER TABLE `policy_reference_paragraphs`
  ADD CONSTRAINT `policy_reference_paragraphs_reference_id_foreign` FOREIGN KEY (`reference_id`) REFERENCES `policy_references` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `policy_reference_paragraph_bullets`
--
ALTER TABLE `policy_reference_paragraph_bullets`
  ADD CONSTRAINT `policy_reference_paragraph_bullets_paragraph_id_foreign` FOREIGN KEY (`paragraph_id`) REFERENCES `policy_reference_paragraphs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_assignments`
--
ALTER TABLE `training_book_assignments`
  ADD CONSTRAINT `book_assignment_book_fk` FOREIGN KEY (`book_id`) REFERENCES `training_books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `book_assignment_user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_assignment_evaluations`
--
ALTER TABLE `training_book_assignment_evaluations`
  ADD CONSTRAINT `assignment_evaluation_module_fk` FOREIGN KEY (`assignment_module_id`) REFERENCES `training_book_assignment_modules` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `training_book_assignment_evaluations_completed_by_foreign` FOREIGN KEY (`completed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `training_book_assignment_modules`
--
ALTER TABLE `training_book_assignment_modules`
  ADD CONSTRAINT `assign_module_assignment_fk` FOREIGN KEY (`assignment_id`) REFERENCES `training_book_assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_module_part_module_fk` FOREIGN KEY (`book_part_module_id`) REFERENCES `training_book_part_modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_assignment_module_items`
--
ALTER TABLE `training_book_assignment_module_items`
  ADD CONSTRAINT `assign_item_module_fk` FOREIGN KEY (`assignment_module_id`) REFERENCES `training_book_assignment_modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_assignment_signoffs`
--
ALTER TABLE `training_book_assignment_signoffs`
  ADD CONSTRAINT `assignment_signoff_req_fk` FOREIGN KEY (`signoff_requirement_id`) REFERENCES `training_book_part_module_signoff_requirements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_signoff_user_fk` FOREIGN KEY (`signed_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `training_book_parts`
--
ALTER TABLE `training_book_parts`
  ADD CONSTRAINT `training_book_parts_book_id_foreign` FOREIGN KEY (`book_id`) REFERENCES `training_books` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_modules`
--
ALTER TABLE `training_book_part_modules`
  ADD CONSTRAINT `training_book_part_modules_book_part_id_foreign` FOREIGN KEY (`book_part_id`) REFERENCES `training_book_parts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_checklist_groups`
--
ALTER TABLE `training_book_part_module_checklist_groups`
  ADD CONSTRAINT `training_book_part_module_checklist_groups_checklist_id_foreign` FOREIGN KEY (`checklist_id`) REFERENCES `training_book_part_module_checklists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_checklist_items`
--
ALTER TABLE `training_book_part_module_checklist_items`
  ADD CONSTRAINT `training_book_part_module_checklist_items_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `training_book_part_module_checklist_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_evaluation_fields`
--
ALTER TABLE `training_book_part_module_evaluation_fields`
  ADD CONSTRAINT `evaluation_field_eval_fk` FOREIGN KEY (`evaluation_id`) REFERENCES `training_book_part_module_evaluations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_form_documents`
--
ALTER TABLE `training_book_part_module_form_documents`
  ADD CONSTRAINT `form_document_module_fk` FOREIGN KEY (`form_module_id`) REFERENCES `training_book_part_module_forms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_media_files`
--
ALTER TABLE `training_book_part_module_media_files`
  ADD CONSTRAINT `training_book_part_module_media_files_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `training_book_part_module_media` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_paragraph_contents`
--
ALTER TABLE `training_book_part_module_paragraph_contents`
  ADD CONSTRAINT `paragraph_content_section_fk` FOREIGN KEY (`section_id`) REFERENCES `training_book_part_module_paragraph_sections` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_paragraph_lists`
--
ALTER TABLE `training_book_part_module_paragraph_lists`
  ADD CONSTRAINT `paragraph_list_paragraph_fk` FOREIGN KEY (`paragraph_id`) REFERENCES `training_book_part_module_paragraph_contents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_paragraph_list_items`
--
ALTER TABLE `training_book_part_module_paragraph_list_items`
  ADD CONSTRAINT `paragraph_list_item_list_fk` FOREIGN KEY (`list_id`) REFERENCES `training_book_part_module_paragraph_lists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_paragraph_sections`
--
ALTER TABLE `training_book_part_module_paragraph_sections`
  ADD CONSTRAINT `paragraph_section_module_fk` FOREIGN KEY (`paragraph_module_id`) REFERENCES `training_book_part_module_paragraphs` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_signoff_requirements`
--
ALTER TABLE `training_book_part_module_signoff_requirements`
  ADD CONSTRAINT `signoff_req_module_fk` FOREIGN KEY (`book_part_module_id`) REFERENCES `training_book_part_modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_sop_checklist_groups`
--
ALTER TABLE `training_book_part_module_sop_checklist_groups`
  ADD CONSTRAINT `sop_group_checklist_fk` FOREIGN KEY (`sop_checklist_id`) REFERENCES `training_book_part_module_sop_checklists` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_sop_checklist_policies`
--
ALTER TABLE `training_book_part_module_sop_checklist_policies`
  ADD CONSTRAINT `sop_policy_group_fk` FOREIGN KEY (`group_id`) REFERENCES `training_book_part_module_sop_checklist_groups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_test_questions`
--
ALTER TABLE `training_book_part_module_test_questions`
  ADD CONSTRAINT `test_questions_test_fk` FOREIGN KEY (`test_id`) REFERENCES `training_book_part_module_tests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_book_part_module_test_question_options`
--
ALTER TABLE `training_book_part_module_test_question_options`
  ADD CONSTRAINT `test_options_question_fk` FOREIGN KEY (`question_id`) REFERENCES `training_book_part_module_test_questions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `training_module_category_assignments`
--
ALTER TABLE `training_module_category_assignments`
  ADD CONSTRAINT `training_module_category_assignments_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `training_module_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vfm`
--
ALTER TABLE `vfm`
  ADD CONSTRAINT `vfm_vfm_vehicle_id_foreign` FOREIGN KEY (`vfm_vehicle_id`) REFERENCES `vfm_vehicle` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
