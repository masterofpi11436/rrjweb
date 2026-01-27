-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2026 at 02:10 PM
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
-- Database: `rrjweb2`
--

-- --------------------------------------------------------

--
-- Table structure for table `tablet`
--

CREATE TABLE `tablet` (
  `id` int(255) NOT NULL,
  `inmate_number` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `date_found` date DEFAULT NULL,
  `is_reported` tinyint(1) DEFAULT NULL,
  `is_filed` tinyint(1) DEFAULT NULL,
  `is_charged` tinyint(1) DEFAULT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tablet`
--

INSERT INTO `tablet` (`id`, `inmate_number`, `first_name`, `middle_name`, `last_name`, `date_found`, `is_reported`, `is_filed`, `is_charged`, `is_paid`, `note`, `created_at`) VALUES
(19, 45991, 'MICHAEL', 'ERIC', 'JENKINS', NULL, 0, 0, 0, 0, 'Broke 2 tablets.', NULL),
(20, 85476, 'BENJAMIN', 'DALE', 'LAUTERBACH', NULL, 1, 0, 0, 0, '', NULL),
(22, 81601, 'IOSHA', 'NACHELLE', 'MORGAN', NULL, 0, 0, 0, 0, '', NULL),
(24, 82529, 'Jorge', 'M', 'PALAEZ AUILA', NULL, 0, 0, 0, 0, '', NULL),
(25, 77381, 'NEIL', NULL, 'HOOPER', NULL, 0, 0, 0, 0, '', NULL),
(26, 25980, 'ALONZA', 'ANTHONY', 'ELLIS', NULL, 0, 0, 0, 0, '', NULL),
(27, 83429, 'YAHIR', 'ESTUARDO', 'BARRIENTOS', NULL, 1, 1, 1, 0, '', NULL),
(28, 85238, 'BRANDON', 'LEE', 'TANNER', NULL, 0, 0, 0, 0, 'Burned a hole in assigned Tablet', NULL),
(29, 74009, 'SHAWN', 'TIMOTHY', 'GIRARD', NULL, 1, 1, 1, 0, '', NULL),
(30, 21707, 'MICHAEL', 'KENNETH', 'DAWSON', NULL, 1, 0, 0, 0, '', NULL),
(31, 85351, 'DENZEL', 'KADEEM', 'GAINES', NULL, 0, 0, 0, 0, '', NULL),
(32, 10539, 'JAMES', 'WILLIAM', 'HILL', NULL, 0, 0, 0, 0, '', NULL),
(33, 73162, 'RAYVAUGHN', 'TELVIN', 'JOHNSON', NULL, 1, 0, 0, 0, '', NULL),
(34, 65203, 'BRADLEY', 'JAMES', 'HALL', NULL, 0, 0, 0, 0, '', NULL),
(35, 81610, 'DAVID', 'LEE', 'HINES', NULL, 1, 0, 0, 0, '', NULL),
(36, 86181, 'WISDOM', 'EMMANUEL', 'PIRTLE', NULL, 0, 0, 0, 0, '', NULL),
(37, 83324, 'TAMMARA', 'DENAY', 'PEACE', NULL, 1, 1, 1, 0, '', NULL),
(38, 84406, 'LOPEZ', NULL, 'HECTOR', '2024-05-20', 0, 0, 0, 0, '', NULL),
(39, 70822, 'RAQUAN', 'TERELL', 'BETHEA', '2024-05-20', 0, 0, 0, 0, '', NULL),
(40, 31945, 'TYESHA', 'DENISE', 'MALONE', '2024-05-20', 0, 0, 0, 0, '', NULL),
(41, 81949, 'EJIYA', 'LAMARCUS', 'CARSON', '2024-05-20', 1, 1, 1, 0, '', NULL),
(42, 86230, 'VERNON', NULL, 'HARRISON', '2024-05-21', 1, 1, 1, 0, '', NULL),
(43, 36096, 'LEONARD', 'BRANDON', 'BOGAN', '2024-05-20', 1, 1, 1, 0, '', NULL),
(44, 84111, 'DESHAWN', 'LAMONT', 'LYONS', NULL, 0, 0, 0, 0, '', NULL),
(45, 42962, 'DONALD', 'RAY', 'COOKE', NULL, 1, 0, 0, 0, '', NULL),
(46, 85272, 'VASQUEZ', NULL, 'MORALES', NULL, 0, 0, 0, 0, '', NULL),
(47, 82068, 'MARLON', 'MAURICE', 'JOHNSON', NULL, 1, 0, 0, 0, '', NULL),
(48, 86291, 'JACOB', NULL, 'MIDKIFF', NULL, 0, 0, 0, 0, '', NULL),
(49, 84432, 'JESSIE', 'SCOTT', 'HICKS', NULL, 0, 0, 0, 0, '', NULL),
(50, 82382, 'DAVID', 'CHARLES', 'JOHNSON', NULL, 0, 0, 0, 0, '', NULL),
(51, 85973, 'ERIC', NULL, 'SUCHOMELLY', NULL, 1, 0, 0, 0, '', NULL),
(52, 82474, 'JESIAH', NULL, 'FLOWERS', NULL, 0, 0, 0, 0, '', NULL),
(53, 81180, 'JUMON', 'DIAMONTE', 'BELTON', NULL, 0, 0, 0, 0, '', NULL),
(54, 76255, 'MATTHEW', 'S', 'PERKINS', NULL, 0, 0, 0, 0, '', NULL),
(55, 33045, 'BRANDON', 'LEE', 'CRUTCHFIELD', NULL, 1, 0, 0, 0, '', NULL),
(56, 84405, 'JOHNNY', 'DANIEL', 'FUQUA', '2024-04-01', 0, 0, 0, 0, '', NULL),
(57, 86049, 'DARIAN', 'LAVEY', 'HERRING', '2024-04-17', 1, 0, 0, 0, 'Broke inmate Shannons tablet.', NULL),
(58, 67149, 'JEFFREY', 'DANIEL', 'CONNER', '2024-04-23', 1, 1, 1, 0, '', NULL),
(59, 69960, 'MELVIN', 'LEON', 'MYRICK', '2024-04-23', 1, 1, 1, 0, '', NULL),
(60, 39171, 'BRYANT', 'KYLE', 'SAUNDERS', NULL, 0, 0, 0, 0, '', NULL),
(61, 86902, 'SHELTON', NULL, 'JONES', NULL, 0, 0, 0, 0, '', NULL),
(62, 19590, 'ANTHONY', 'JAMES', 'ANGELINA', NULL, 1, 1, 1, 0, '', NULL),
(63, 56902, 'SUSAN', 'MICHELLE', 'ARCHER', NULL, 1, 1, 1, 0, '', NULL),
(64, 66091, 'MELVYN', 'PERRY', 'CHATMAN', NULL, 0, 0, 0, 0, '', NULL),
(65, 86782, 'JACOB', NULL, 'BELLAMY', NULL, 0, 0, 0, 0, '', NULL),
(66, 13026, 'ALGIA', 'WEBSTER', 'BAILEY', '2024-04-30', 1, 0, 0, 0, '', NULL),
(67, 63517, 'JAMES', 'M', 'MCGRATH', '2024-04-30', 0, 0, 0, 0, '', NULL),
(68, 85222, 'NERY', NULL, 'ESTRADA', '2024-05-20', 0, 0, 0, 0, '', NULL),
(69, 81857, 'ALEXANDER', NULL, 'NELSON', '2024-05-21', 0, 0, 0, 0, '', NULL),
(70, 87016, 'ANDRE', NULL, 'GLOVER', '2024-05-28', 0, 0, 0, 0, '', NULL),
(71, 86957, 'LARRY', NULL, 'STONE', '2024-05-28', 0, 0, 0, 0, 'Burned a hole in the tablet', NULL),
(72, 12602, 'JASON', 'LEE', 'MEEKINS', '2024-05-28', 1, 0, 0, 0, 'Broken Screen', NULL),
(73, 81034, 'TRAVIS', 'DALTON', 'VAUGHAN', '2024-05-28', 1, 1, 0, 0, 'Back Broken', '0000-00-00'),
(75, 85670, 'JAMARCUS', 'VYSHAWN', 'WATKINS', '2024-05-28', 1, 0, 0, 0, '', NULL),
(76, 47372, 'GENE', 'RAY', 'BROWDER', NULL, 1, 1, 1, 0, '', NULL),
(77, 55254, 'RONALD', 'LEE', 'HUNT', '2024-06-13', 1, 1, 0, 0, 'Tablet was destroyed and all that was found was the battery.', NULL),
(78, 87249, 'CORY', 'LEE', 'JACOBS', '2024-06-10', 0, 0, 0, 0, 'Tablet was broken in half and parts removed', NULL),
(79, 75434, 'ANDRE', 'CORTEZ', 'SCOTT', '2024-06-21', 1, 1, 1, 0, 'Kiosk broken', '0000-00-00'),
(80, 75434, 'ANDRE', 'CORTEZ', 'SCOTT', NULL, 1, 0, 0, 0, 'Tablet broken', NULL),
(82, 83359, 'DARRICK', NULL, 'BARNES', '2024-06-26', 1, 0, 0, 0, 'Broken Screen', '2024-07-01'),
(83, 76683, 'JORDAN', 'CHASE', 'MARKHAM', '2024-06-27', 1, 0, 0, 0, 'Broken tablet', '2024-07-01'),
(84, 63713, 'DUSTIN', 'THOMAS', 'BRINKLEY', '2024-07-01', 1, 0, 0, 0, 'Broken tablet', '2024-07-01'),
(85, 67716, 'GREGORY', 'DARNELL', 'COOK', '2024-07-15', 0, 0, 0, 0, 'Smashed screen', '2024-07-15'),
(86, 74813, 'KENDRICK', 'DEANGLO', 'TILLAR', NULL, 0, 0, 0, 0, 'Broken screen', '2024-07-15'),
(87, 18445, 'MICHAEL', 'EVERETT', 'SIMONSON', NULL, 0, 0, 0, 0, 'Broken screen', '2024-07-15'),
(88, 74813, 'KENDRICK', 'DEANGLO', 'TILLAR', '2024-07-18', 0, 0, 0, 0, 'Broken screen', '2024-07-29'),
(89, 45985, 'JEFFREY', 'S', 'SMITH', '2024-07-18', 0, 0, 0, 0, 'Broken Screen', '2024-07-29'),
(90, 87247, 'TYREK', 'K', 'KELLY', '2024-07-18', 0, 0, 0, 0, 'Broken screen', '2024-07-29'),
(91, 66633, 'DEVON', 'ZACHARAIUS', 'ROBINSON', '2024-07-30', 0, 0, 0, 0, 'Burned back of tablet', '2024-07-30'),
(92, 87703, 'MICHAEL', 'R', 'WHITE', NULL, 0, 0, 0, 0, '', '2024-08-20'),
(93, 87184, 'NATHAN', NULL, 'POTTER', '2024-07-18', 0, 0, 0, 0, 'Screen Broken', '2024-09-06'),
(95, 87247, 'TYREK', 'K', 'KELLY', '2024-07-18', 0, 0, 0, 0, 'Hole in back.', '2024-09-06'),
(96, 84218, 'JAMYLES', 'KHALIQ', 'JOHNSON', '2024-08-20', 0, 0, 0, 0, '', '2024-09-06'),
(97, 81429, 'BRIAN', 'KEITH', 'WILLS', '2024-08-28', 0, 0, 0, 0, '', '2024-09-06'),
(98, 60788, 'TAMESHA', 'BERNICE', 'TAYLOR', NULL, 1, 0, 0, 0, '', '2024-09-06'),
(99, 87724, 'ALOYSUISE', 'SEXTER', 'ROYAL', '2024-08-29', 0, 0, 0, 0, '', '2024-09-06'),
(100, 62967, 'Quincy', 'Kim', 'CURTIS MCKENSIE', '2024-08-16', 0, 0, 0, 0, '', '0000-00-00'),
(101, 84218, 'JAMYLES', 'KHALIQ', 'JOHNSON', '2024-08-20', 0, 0, 0, 0, '', '2024-09-30'),
(103, 54768, 'CHRISTOPHER', 'GLENN', 'STARNES', '2024-09-09', 0, 0, 0, 0, '', '2024-09-30'),
(104, 65080, 'ALEX', 'ROBERT', 'SHEAFFER', '2024-09-29', 0, 0, 0, 0, '', '2024-09-30'),
(106, 48357, 'JESSIE', 'ANTOINE', 'RANKINS', NULL, 0, 0, 0, 0, '', '2024-10-16'),
(107, 75684, 'JIMELL', 'L', 'TOWNES', '2024-09-18', 0, 0, 0, 0, '', '2024-10-16'),
(108, 87629, 'MARCO', NULL, 'FLORES-OROPEZA', NULL, 0, 0, 0, 0, '', '2024-10-16'),
(109, 54057, 'ROBERT', 'CHAD', 'WRIGHT', NULL, 0, 0, 0, 0, '', '2024-10-16'),
(110, 84107, 'DURIEL', 'SYLVESTER', 'SMITH', '2024-10-01', 0, 0, 0, 0, '', '2024-10-16'),
(111, 87854, 'RAIQUAN', 'LOREZ', 'SIMMS', '2024-10-07', 0, 0, 0, 0, '', '2024-10-16'),
(112, 86219, 'NAQUANE', 'KAREME', 'HAYDEN', '2024-10-15', 0, 0, 0, 0, '', '2024-10-16'),
(113, 72982, 'JOSHUA', 'XAVIER', 'KNOX', '2024-10-15', 0, 1, 0, 0, '', '2024-10-16'),
(114, 86101, 'LEVAR', 'KEITH', 'LONEY', '2024-10-17', 0, 0, 0, 0, '', '2024-11-04'),
(115, 24947, 'JASON', 'ANTHONY', 'STOKES', '2024-10-22', 0, 0, 0, 0, '', '2024-11-04'),
(116, 60327, 'MALIK', 'ELSHADDAU', 'CROCKER', '2024-10-25', 0, 0, 0, 0, '', '2024-11-04'),
(117, 27500, 'CARLESSIO', 'JOVON', 'PETTICOLAS', '2024-10-25', 0, 0, 0, 0, '', '2024-11-04'),
(118, 65401, 'DEON', 'TREVONTE', 'BEASLEY', '2024-10-25', 0, 0, 0, 0, '', '2024-11-04'),
(119, 87183, 'ANTHONY', 'M', 'LOPEZ CABRERA', '2024-10-25', 0, 0, 0, 0, '', '2024-11-04'),
(120, 75548, 'CHARLES', 'WAYNE', 'PIERCE', '2024-10-25', 0, 0, 0, 0, '', '2024-11-04'),
(121, 87447, 'MAURICE', NULL, 'EPPS', '2024-12-17', 0, 0, 0, 0, 'Screen broken', '2024-12-17'),
(122, 47023, 'BRANDON', 'RAFAEL', 'SNEAD', '2024-12-17', 0, 0, 0, 0, '', '2024-12-17'),
(123, 84269, 'JABRIL', NULL, 'JACKSON', '2024-12-17', 0, 0, 0, 0, '', '2024-12-17'),
(124, 88674, 'MICHAEL', NULL, 'BROOKS', '2024-12-16', 0, 0, 0, 0, '', '2024-12-17'),
(125, 85531, 'ZHECOUR', 'XAVIER', 'ROSS', '2024-12-20', 0, 0, 0, 0, '102C6BD37574 Mac Address', '2024-12-31'),
(126, 52366, 'RICHARD', 'TYLER', 'WALL', '2025-01-01', 0, 0, 0, 0, 'MAC: C678', '2025-01-03'),
(127, 88583, 'SAMUEL', 'J', 'BIEBER', '2025-02-10', 0, 0, 0, 0, 'broken screen', '2025-02-10'),
(128, 56773, 'JONATHAN', 'SCOTT', 'OSTERBIND', '2025-02-10', 0, 0, 0, 0, 'broken screen', '2025-02-10'),
(129, 81978, 'OLANDER', 'DEWAYNE', 'BROOKS', '2025-02-10', 0, 0, 0, 0, 'broken screen', '2025-02-10'),
(130, 46601, 'GARY', 'RAY', 'JONES', '2025-02-10', 0, 0, 0, 0, 'broken screen', '2025-02-10'),
(131, 86582, 'WARREN', 'DARNELL', 'FIELDS', '2025-02-10', 0, 0, 0, 0, 'broken screen', '2025-02-10'),
(132, 87062, 'RYAN', 'ALEXANDER', 'BIRCKHEAD', '2025-02-13', 0, 0, 0, 0, 'Broken screen and no battery', '2025-02-13'),
(133, 76165, 'TYLER', 'MITCHELL', 'FARIS', '2025-02-24', 0, 0, 0, 0, 'tablet back was removed, and wires are cut to battery\r\nmac: 08:FB:EA:E8:68:68', '2025-02-24'),
(134, 85878, 'JAHEIM', NULL, 'CLEMENTS HUTTERSONN', '2025-04-09', 0, 0, 0, 0, 'No Battery and tablet had a hole burned in the back', '2025-04-09'),
(135, 87151, 'JAREIN', 'AARON', 'STONE', '2025-04-01', 0, 0, 0, 0, 'Broken screen', '2025-04-09'),
(136, 80282, 'JAMARI', 'ANTONIO', 'TAYLOR', '2025-04-01', 0, 0, 0, 0, 'Broken screen', '2025-04-09'),
(137, 36096, 'LEONARD', 'BRANDON', 'BOGAN', '2025-04-01', 0, 0, 0, 0, 'Burned a hole in the back. 994E', '2025-04-09'),
(138, 62494, 'MICHAEL', 'DOUGLAS', 'BURROWS', '2025-04-01', 0, 0, 0, 0, 'Back of tablet was removed and the inside parts were removed. Mac 4DDC', '2025-04-09'),
(139, 88589, 'BENJAMIN', 'AMIR', 'WRIGHT', '2025-04-01', 0, 0, 0, 0, 'Burned hole in tablet. Mac 92F6', '2025-04-09'),
(140, 87062, 'RYAN', 'ALEXANDER', 'BIRCKHEAD', '2025-04-01', 0, 0, 0, 0, 'Back of tablet was removed and parts were removed. MAC A6ce', '2025-04-09'),
(141, 88406, 'oscar', 'issac', 'CARTAGENA BANEGA', '2025-04-16', 0, 0, 0, 0, 'broke screen MAC:08FBEA36BD76', '2025-04-16'),
(142, 87699, 'JOHNNY', 'EUGENE', 'QUICK', NULL, 0, 0, 0, 0, 'Mac: CC4B73FA53FC\r\nScreen broken', '2025-04-16'),
(143, 63355, 'PATRICK', 'W', 'GREGORY', '2025-06-13', 0, 0, 0, 0, 'Inmate broke the screen on the tablet assigned to him', '2025-06-13'),
(144, 58798, 'DEMONTA', 'TYQUAIL', 'BELL', '2025-07-01', 0, 0, 0, 0, 'Returned with broken screen', '2025-07-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tablet`
--
ALTER TABLE `tablet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tablet`
--
ALTER TABLE `tablet`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
