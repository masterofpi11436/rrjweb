--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_type` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `item_type`, `image`, `quantity`) VALUES
(4, 'BROOM HEAD (ea)', 1, '/public/images/broomhead.jpg', 0),
(5, 'CENTER PULL TOWELS (ro)', 1, '/public/images/centertowels.jpg', 0),
(6, 'DECK BRUSH 10\" (ea)', 1, '/public/images/deckbrush.jpg', 0),
(7, 'DUST MOP HEAD (ea) ', 1, '/public/images/dustmop.jpg', 0),
(9, 'MOP HEAD f/SEALER (ea) ', 1, '/public/images/mophead.jpg', 0),
(10, 'CLOTH RAG (ea)', 1, '/public/images/clothrag.jpg', 0),
(14, 'SPRAY BOTTLE 1 QT (ea) ', 1, '/public/images/spraybottle.jpg', 0),
(15, 'SPRAY HEAD f/BT (ea) ', 1, '/public/images/sprayhead.jpg', 0),
(16, 'TRASH BAGS SM (ro) ', 1, '/public/images/trashbagsmall.jpg', 0),
(17, 'TRASH BAGS MED (bx) ', 1, '/public/images/trashbagsmall.jpg', 0),
(18, 'TRASH BAGS LG (bx) ', 1, '/public/images/trashbagsmall.jpg', 0),
(19, 'PLASTIC BAGS f/RECYCLING (ro) ', 1, '/public/images/recycle.jpg', 0),
(21, 'BUFF PAD CHAMPAGINE (ea)', 1, '/public/images/buffpadchamp.jpg', 0),
(22, 'POLISHING PAD WHITE (ea) ', 1, '', 0),
(23, 'STRIP PAD BLACK (ea)', 1, '', 0),
(24, 'CLEAN PAD GREEN (ea) ', 1, '/public/images/greenpad.jpg', 0),
(25, 'PAPER TOWELS MFLD (cs) ', 1, '/public/images/brownpapertowels.jpg', 0),
(26, 'TOILET PAPER (cs) ', 1, '/public/images/toiletpaper.jpg', 0),
(27, 'VINYL, GLOVES, PF,MED (bx) ', 1, '/public/images/gloves.png', 0),
(29, 'VINYL, GLOVES, PF, XL (bx) ', 1, '/public/images/gloves.png', 0),
(30, 'GLOVES FOOD HANDLING (pk)', 1, '/public/images/foodhandling.jpg', 0),
(31, 'MELT-A-WAY LAUNDRY BAGS (ro)', 1, '/public/images/meltaway.jpg', 0),
(32, 'GREEN ANTIBACT HAND SOAP (ea)', 1, '/public/images/greenhandsoap.jpg', 0),
(33, 'ANTIBACT FOAM HAND SOAP (ea)', 1, '/public/images/foaminghandsoap.jpg', 0),
(34, 'RAZOR (bx', 9, '/public/images/razor.jpg', 0),
(36, 'SOLAR BRITE (5gl) ', 1, '/public/images/solarbrite.jpg', 0),
(37, 'SANITARY NAPKINS (bx)', 9, '/public/images/sanitary_napkin.jpg', 0),
(38, 'SO FRESH (5gl)', 1, '/public/images/so_fresh.jpg', 0),
(39, 'STAIN BLASTER (pk) ', 1, '/public/images/stainblaster.jpg', 0),
(40, 'GROUT SAFE (gl)', 1, '/public/images/H2 Orange.jpg', 0),
(41, 'GLASS CLEANER (bt) ', 1, '/public/images/glass_cleaner.jpg', 0),
(42, 'NABC1 (bt) ', 1, '/public/images/nabc1.jpg', 0),
(43, 'TRI BASE (gl)', 1, '/public/images/tribase.jpg', 0),
(44, 'PUMP SPRAY (gl)', 1, '/public/images/pump_spray.jpg', 0),
(45, 'SCUM B GONE (bt)', 1, '/public/images/scum_b_gone.jpg', 0),
(46, 'RRJ LEAVE REQUEST FORM (pk)', 2, '/public/images/leave_slip.png', 0),
(47, 'TABLET STANDARD (ea)', 2, '/public/images/tablet_standard.jpg', 0),
(48, 'STENO NOTE BOOK (ea) ', 2, '/public/images/steno.jpg', 0),
(49, 'POST IT LARGE (pk)', 2, '/public/images/post_it.jpg', 0),
(50, 'LOG BOOK 300PG (ea)', 2, '/public/images/logbook.jpg', 0),
(51, 'ENVELOPE COIN (bx)', 2, '/public/images/coinenvelope.jpg', 0),
(52, 'ENVELOPE INTER OFFICE (ea) ', 2, '/public/images/interofficeenevelope.jpg', 0),
(53, 'ENVELOPE WINDOW (bx) ', 2, '/public/images/windowenvelope.jpg', 0),
(54, 'ENVELOPE 9 X 12 (bx)', 2, '/public/images/9x12envelope.jpg', 0),
(55, 'ENVELOPE 10X15 (bx)', 2, '/public/images/10x15envelope.jpg', 0),
(56, 'ENVELOPE STD. WHITE (bx)', 2, '/public/images/envelopes.jpg', 0),
(57, 'CLIP PLASTIC MEDIUM (bx) ', 2, '/public/images/paperclips.jpg', 0),
(58, 'CLIP PLASTIC LARGE (bx) ', 2, '/public/images/paperclips.jpg', 0),
(59, 'CLIP PLASTIC XTRA-LG(bx) ', 2, '/public/images/paperclips.jpg', 0),
(60, 'PEN BLACK (bx)', 2, '/public/images/blackpen.jpg', 0),
(61, 'PEN RED (bx) ', 2, '/public/images/redpen.jpg', 0),
(62, 'PENCILS (pk) ', 2, '/public/images/pencils.jpg', 0),
(63, 'MARKERS BLACK (ea) ', 2, '/public/images/blackmarker.jpg', 0),
(64, 'HIGHLITER YEL (ea) ', 2, '/public/images/highlighter-yellow.jpg', 0),
(65, 'DRY ERASE MKR (PK) ', 2, '/public/images/dryerasemarker.png', 0),
(66, 'DRY ERASER (ea) ', 2, '/public/images/dryeraser.jpg', 0),
(67, 'POCKET PORTFOLIO (ea)', 2, '/public/images/pocket_portfolio.jpg', 0),
(68, 'LASER LABELS 1/3 CUT (pk)', 2, '/public/images/laserlabels.jpg', 0),
(69, 'LASER LABELS MAILING (pk)', 2, '/public/images/laserlabels.jpg', 0),
(70, 'LASER LABELS 1\" X 2 5/8\" (bx)', 2, '/public/images/laserlabels.jpg', 0),
(71, 'FILE FOLDER STD (bx)', 2, '/public/images/file_folder.jpg', 0),
(72, 'BATTERY AA CELL (ea)', 2, '/public/images/AA-battery.jpg', 0),
(73, 'BATTERY AAA CELL (ea)', 2, '/public/images/AAA-battery.jpg', 0),
(74, 'BATTERY C CELL (ea)', 2, '/public/images/c-cellbattery.jpg', 0),
(75, 'BATTERY D CELL (ea)', 2, '/public/images/d-cellbattery.jpg', 0),
(76, 'BATTERY 9 VOLT (ea)', 2, '/public/images/9-volt.jpg', 0),
(77, 'STAPLER (ea) (staple-less)', 2, '/public/images/stapler.jpg', 0),
(78, 'TAPE TRANSPARENT (ro)', 2, '/public/images/tape_roll.jpg', 0),
(79, 'RUBBER BANDS (pk)', 2, '/public/images/rubber_bands.jpg', 0),
(80, 'WHITEOUT PEN (ea)', 2, '/public/images/whiteoutpen.jpg', 0),
(81, 'WHITEOUT (bt)', 2, '/public/images/whiteout.jpg', 0),
(82, 'TNG/CLASS RECORD FOLDER (bx) 13775', 2, '', 0),
(83, 'PERSONNEL RECORD FOLDER (bx)', 2, '/public/images/personnel_folder.jpg', 0),
(84, 'SUPERVISOR RECORD FOLDER (bx)', 2, '/public/images/supervisor_folder.jpg', 0),
(87, 'COPY PAPER 8.5x11 (cs)', 2, '/public/images/paper.jpg', 0),
(88, 'BANKER BOX, LTR, lg (ea)', 2, '/public/images/bankerbox.jpg', 0),
(89, 'BANKER BOX, LEGAL (ea)', 2, '/public/images/bankerbox.jpg', 0),
(90, 'BANKER BOX, LTR, sm (ea)', 2, '/public/images/bankerbox.jpg', 0),
(91, 'Q5949X (ea)', 3, '/public/images/49x', 0),
(92, 'CB436A (ea)', 3, '/public/images/36a.jpg', 0),
(93, 'CE278A (ea)', 3, '/public/images/78a.png', 0),
(94, 'Q7553X (ea)', 3, '/public/images/53x.png', 0),
(95, 'CE505X (ea)', 3, '/public/images/05x.jpg', 0),
(96, '0 C4127X (ea)', 3, '/public/images/0 C4127.jpg', 0),
(97, 'CC364A (ea)', 3, '/public/images/64a.png', 0),
(98, 'C8061X (ea)', 3, '/public/images/61x.png', 0),
(99, '600 (ea)', 3, '/public/images/90a.jpg', 0),
(100, 'D130 (ea)', 3, '', 0),
(101, 'BROTHER 350 (ea)', 3, '/public/images/brother350.jpg', 0),
(102, '98X (ea)', 3, '/public/images/98X.jpg', 0),
(103, 'CF280A (ea)', 3, '/public/images/80a.jpg', 0),
(104, '92A (ea)', 3, '/public/images/92a.jpg', 0),
(105, 'C7115X (ea)', 3, '/public/images/C7115X.jpg', 0),
(106, 'Q2613 (ea)', 3, '/public/images/13a.jpg', 0),
(110, 'Straw Broom (ea)', 1, '/public/images/strawbroom.jpg', 0),
(116, 'SEALER WAY (gl)', 1, '', 0),
(117, 'STRIPPER (gl)', 1, '', 0),
(118, 'BLEACH', 1, '/public/images/bleach.jpg', 0),
(119, 'H2 ORANGE (gl)', 1, '/public/images/H2 Orange.jpg', 0),
(157, 'Green Jumpers Med', 4, '/public/images/greenjumpsuit.jpg', 0),
(158, 'Green Jumpers LG', 4, '/public/images/greenjumpsuit.jpg', 0),
(159, 'Green Jumpers XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(160, 'Green Jumpers 2XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(161, 'Green Jumpers 3XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(162, 'Green Jumpers 4XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(163, 'Green Jumpers 5XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(164, 'Green Jumpers 6XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(165, 'Green Jumpers 7XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(166, 'Green Jumpers 8XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(167, 'Green Jumpers 9XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(168, 'Green Jumpers 10XL', 4, '/public/images/greenjumpsuit.jpg', 0),
(169, 'GYM SHORTS SM', 4, '/public/images/gymshorts.jpg', 0),
(170, 'GYM SHORTS MED', 4, '/public/images/gymshorts.jpg', 0),
(171, 'GYM SHORTS LG', 4, '/public/images/gymshorts.jpg', 0),
(172, 'GYM SHORTS XL', 4, '/public/images/gymshorts.jpg', 0),
(173, 'GYM SHORTS 2XL', 4, '/public/images/gymshorts.jpg', 0),
(174, 'GYM SHORTS 3XL', 4, '/public/images/gymshorts.jpg', 0),
(175, 'GYM SHORTS 4XL', 4, '/public/images/gymshorts.jpg', 0),
(176, 'FEMAL BRIEFS SM/5', 4, '/public/images/womenbriefs.jpg', 0),
(177, 'FEMAL BRIEFS MED/6', 4, '/public/images/womenbriefs.jpg', 0),
(178, 'FEMAL BRIEFS LG/7', 4, '/public/images/womenbriefs.jpg', 0),
(179, 'FEMAL BRIEFS XL/8', 4, '/public/images/womenbriefs.jpg', 0),
(180, 'FEMAL BRIEFS 2XL/9', 4, '/public/images/womenbriefs.jpg', 0),
(181, 'FEMAL BRIEFS 3XL/10', 4, '/public/images/womenbriefs.jpg', 0),
(182, 'FEMAL BRIEFS 4XL/11', 4, '/public/images/womenbriefs.jpg', 0),
(183, 'FEMAL BRIEFS 5XL/12', 4, '/public/images/womenbriefs.jpg', 0),
(184, 'FEMAL BRIEFS 6XL/13', 4, '/public/images/womenbriefs.jpg', 0),
(185, 'FEMAL BRIEFS 7XL/14', 4, '/public/images/womenbriefs.jpg', 0),
(186, 'BRA SIZE 32', 4, '/public/images/bra.jpg', 0),
(187, 'BRA SIZE 34', 4, '/public/images/bra.jpg', 0),
(188, 'BRA SIZE 36', 4, '/public/images/bra.jpg', 0),
(189, 'BRA SIZE 38', 4, '/public/images/bra.jpg', 0),
(190, 'BRA SIZE 40', 4, '/public/images/bra.jpg', 0),
(191, 'BRA SIZE 42', 4, '/public/images/bra.jpg', 0),
(192, 'BRA SIZE 44', 4, '/public/images/bra.jpg', 0),
(193, 'BRA SIZE 46', 4, '/public/images/bra.jpg', 0),
(194, 'MENS BRIEFS SM', 4, '/public/images/mensbriefs.jpg', 0),
(195, 'MENS BRIEFS MED', 4, '/public/images/mensbriefs.jpg', 0),
(196, 'MENS BRIEFS LG', 4, '/public/images/mensbriefs.jpg', 0),
(197, 'MENS BRIEFS XL', 4, '/public/images/mensbriefs.jpg', 0),
(198, 'MENS BRIEFS 2XL', 4, '/public/images/mensbriefs.jpg', 0),
(199, 'MENS BRIEFS 3XL', 4, '/public/images/mensbriefs.jpg', 0),
(200, 'MENS BRIEFS 4XL', 4, '/public/images/mensbriefs.jpg', 0),
(201, 'T-SHIRTS SM', 4, '/public/images/t-shirts.jpg', 0),
(202, 'T-SHIRTS MED', 4, '/public/images/t-shirts.jpg', 0),
(203, 'T-SHIRTS LG', 4, '/public/images/t-shirts.jpg', 0),
(204, 'T-SHIRTS XL', 4, '/public/images/t-shirts.jpg', 0),
(205, 'T-SHIRTS 2XL', 4, '/public/images/t-shirts.jpg', 0),
(206, 'T-SHIRTS 3XL', 4, '/public/images/t-shirts.jpg', 0),
(207, 'T-SHIRTS 4XL', 4, '/public/images/t-shirts.jpg', 0),
(208, 'T-SHIRTS 5XL', 4, '/public/images/t-shirts.jpg', 0),
(209, 'T-SHIRTS 6XL', 4, '/public/images/t-shirts.jpg', 0),
(210, 'T-SHIRTS 7XL', 4, '/public/images/t-shirts.jpg', 0),
(211, 'T-SHIRTS 8XL', 4, '/public/images/t-shirts.jpg', 0),
(212, 'T-SHIRTS 9XL', 4, '/public/images/t-shirts.jpg', 0),
(213, 'T-SHIRTS 10XL', 4, '/public/images/t-shirts.jpg', 0),
(214, 'SHEETS', 4, '/public/images/sheets.jpg', 0),
(215, 'BLANKETS', 4, '/public/images/inmateblankets.jpg', 0),
(216, 'GRAY BLANKETS', 4, '/public/images/blankets.jpg', 0),
(217, 'WASH CLOTHES', 4, '/public/images/clothrag.jpg', 0),
(218, 'TOWELS', 4, '/public/images/towels.jpg', 0),
(219, 'CUPS', 4, '/public/images/cups.webp', 0),
(220, 'SPOONS', 4, '/public/images/spoon.jpg', 0),
(221, 'SHOES SIZE 5', 4, '/public/images/shoes.jpg', 0),
(222, 'SHOES SIZE 6', 4, '/public/images/shoes.jpg', 0),
(223, 'SHOES SIZE 7', 4, '/public/images/shoes.jpg', 0),
(224, 'SHOES SIZE 8', 4, '/public/images/shoes.jpg', 0),
(225, 'SHOES SIZE 9', 4, '/public/images/shoes.jpg', 0),
(226, 'SHOES SIZE 10', 4, '/public/images/shoes.jpg', 0),
(227, 'SHOES SIZE 11', 4, '/public/images/shoes.jpg', 0),
(228, 'SHOES SIZE 12', 4, '/public/images/shoes.jpg', 0),
(229, 'SHOES SIZE 13', 4, '/public/images/shoes.jpg', 0),
(230, 'SHOES SIZE 14', 4, '/public/images/shoes.jpg', 0),
(231, 'SHOES SIZE 15', 4, '/public/images/shoes.jpg', 0),
(232, 'SHOES SIZE 16', 4, '/public/images/shoes.jpg', 0),
(233, 'SHOWER SHOES SM/5&6', 4, '/public/images/showershoes.jpg', 0),
(234, 'SHOWER SHOES MED/7&8', 4, '/public/images/showershoes.jpg', 0),
(235, 'SHOWER SHOES LG/9&10', 4, '/public/images/showershoes.jpg', 0),
(236, 'SHOWER SHOES XL/11&12', 4, '/public/images/showershoes.jpg', 0),
(237, 'SHOWER SHOES 2XL/13&14', 4, '/public/images/showershoes.jpg', 0),
(238, 'SHOWER SHOES 3XL/15&16', 4, '/public/images/showershoes.jpg', 0),
(244, 'Inmate Request Forms', 2, '', 0),
(247, 'Nitrile Gloves', 1, '', 0),
(248, 'Socks', 4, '', 0),
(249, '55a, ink cartridge', 3, '', 0),
(250, 'Broom Handle', 8, '', 0),
(251, '58a ink cartridge', 3, '', 0),
(252, 'Laundry Destainer (bleach)', 1, '', 5),
(253, '83a ink cartridge', 3, '', 0),
(254, 'Laundry Bags', 4, '', 0),
(255, 'Mop Handle', 8, '', 0),
(256, 'Scrub Brush', 8, '', 0),
(257, 'Inmate Bar Soap', 1, '', 0),
(258, 'Dust Pan', 8, '', 0),
(259, 'Toilet Brush', 8, '', 0),
(260, 'Spray Buff (gl)', 1, '', 0),
(261, 'Receipt Book (ea)', 2, '', 0),
(262, 'Personnel File (bx) 14075', 2, '', 0),
(263, 'Supervisor File (bx) 14076', 2, '', 0),
(264, 'Inmate Flex Pen (ea)', 2, '', 0),
(265, 'Mop Bucket (ea)', 1, '', 0),
(266, 'HP148a/ HP148x', 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE `item_type` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `type`) VALUES
(1, 'Housekeeping Supplies'),
(2, 'Office Supplies'),
(3, 'Printer Ink'),
(4, 'Property'),
(8, '1 for 1 Exchange'),
(9, 'Personal Care');

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
(1, '12345', 'John', 'Doe');

-- --------------------------------------------------------

--
-- Table structure for table `monthly`
--

CREATE TABLE `monthly` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `monthly`
--

INSERT INTO `monthly` (`id`, `first_name`, `last_name`, `email`) VALUES
(2, 'Mark', 'Tuggle', 'tugglem@rrjva.org');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `supervisor_id` int(255) NOT NULL,
  `section_id` int(255) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `status` enum('pending supervisor approval','pending warehouse approval','approved','denied','in progress') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `approved_denied_at` datetime DEFAULT NULL,
  `approved_denied_by` int(255) DEFAULT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `supervisor_id`, `section_id`, `items`, `status`, `created_at`, `approved_denied_at`, `approved_denied_by`, `note`) VALUES
(39, 80, 80, 6, '{\"73\":{\"id\":73,\"name\":\"BATTERY AAA CELL (ea)\",\"item_type\":2,\"image\":\"\",\"quantity\":4}}', 'approved', '2024-08-01 11:20:42', '2024-08-01 12:37:04', 37, 'you need 4 not 1, sold in each not pack');

-- --------------------------------------------------------

--
-- Table structure for table `phone`
--

CREATE TABLE `phone` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `section` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'tablet'),
(3, 'phone'),
(4, 'mailroom'),
(5, 'program'),
(6, 'contractor'),
(7, 'volunteer'),
(8, 'warehouse manager'),
(9, 'supervisor'),
(10, 'user'),
(11, 'warehouse supervisor'),
(12, 'property');

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`) VALUES
(1, 'Housing Unit 1'),
(2, 'Housing Unit 2'),
(3, 'Housing Unit 3'),
(4, 'Housing Unit 4'),
(5, 'Housing Unit 5'),
(6, 'Housing Unit 6'),
(7, 'Booking'),
(8, 'Administration'),
(9, 'Medical Housing'),
(10, 'Classification'),
(11, 'Records'),
(12, 'Maintenance'),
(13, 'Housekeeping'),
(14, 'HUM'),
(15, 'Programs'),
(16, 'SEC'),
(17, 'C&T'),
(18, 'Warehouse'),
(19, 'Compliance'),
(20, 'Property'),
(21, 'SHU-A'),
(22, 'SHU-B'),
(23, 'Movement'),
(24, 'Captains Hall'),
(25, 'OPR');

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
(1, 123454, 'John', 'Smith', 'Doe', NULL, 0, 0, 0, 0, 'Broke 2 tablets.', NULL);
