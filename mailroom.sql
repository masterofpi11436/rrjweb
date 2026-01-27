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
-- Table structure for table `mailroom`
--

CREATE TABLE `mailroom` (
  `id` int(11) NOT NULL,
  `inmate_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mailroom`
--

INSERT INTO `mailroom` (`id`, `inmate_number`, `first_name`, `last_name`) VALUES
(5, '73044', 'Marvin', 'Wilkins'),
(6, '', 'Enoch', 'Brown'),
(7, '', 'Marquis', 'Coleman Jr.'),
(8, '', 'Armani', 'Myrick'),
(9, '74877', 'Jerrell A', 'Crawley'),
(10, '81750', 'Mike', 'Stewart'),
(11, '82784', 'Joseph', 'Lopardo'),
(12, '', 'Bobby', 'Mills'),
(13, '', 'Crystal', 'LaRose'),
(14, '82178', 'Bradley', 'Bell'),
(15, '52193', 'Mikal', 'Lawton'),
(16, '49267', 'Tequan', 'Taylor'),
(17, '74080', 'Joshua', 'Cabaniss'),
(18, '77144', 'Jalen', 'Perez'),
(19, '80282', 'Jamari', 'Taylor'),
(20, '84816', 'Kristopher', 'Miller'),
(21, '83047', 'Kanequia', 'Walton'),
(22, '79382', 'Daryl', 'Willis'),
(23, '86712', 'Joshua', 'Harris'),
(24, '5011', 'Raymond', 'Tasco'),
(26, '87217', 'Brandon', 'Warner'),
(27, '31647', 'Reynard', 'Moore'),
(29, '86636', 'Deonte', 'Jones'),
(30, '69261', 'Alsherman', 'Davis'),
(31, '77180', 'Carlos', 'Carcamo-DeLeon'),
(32, '87183', 'Antony', 'Lopez-Cabrera'),
(33, '88346', 'Shaquan', 'Mills'),
(34, '75660', 'Earnest', 'Vines'),
(35, '86154', 'Jehmel', 'Williams');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mailroom`
--
ALTER TABLE `mailroom`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mailroom`
--
ALTER TABLE `mailroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
