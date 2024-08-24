-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2024 at 09:03 PM
-- Server version: 8.0.37
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eimbox_databasesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankinfo`
--

CREATE TABLE `bankinfo` (
  `id` int NOT NULL,
  `sccode` int DEFAULT NULL,
  `slot` varchar(20) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `accno` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `acctype` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `bankname` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `branch` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `openingdate` date DEFAULT NULL,
  `closingdate` date DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `bankinfo`
--

INSERT INTO `bankinfo` (`id`, `sccode`, `slot`, `accno`, `acctype`, `bankname`, `branch`, `openingdate`, `closingdate`, `status`) VALUES
(61, 103187, 'School', '0100058538854', 'General', 'Janata Bank Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(62, 103187, 'School', '0100058649206', 'Scout', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(63, 103187, 'School', '0100254943708', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(64, 103187, 'College', '0100254943686', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(65, 103187, 'College', '0100254943759', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(66, 103187, 'School', '0200006775848', 'Tution Fee', 'Agroni Bank  Limited', 'Bancharampur Br., Bancharampur, Brahmanbaria.', NULL, NULL, 1),
(67, 103187, 'School', '1403100018138', 'Ed. Board', 'Sonali Bank  Limited', 'Bancharampur Br., Bancharampur, Brahmanbaria.', NULL, NULL, 1),
(68, 103187, 'College', '0100242823219', 'College', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(69, 103187, 'College', '0100254943619', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, NULL, 1),
(70, 103187, 'School', '0100210456184', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, '2024-03-24', 1),
(71, 103187, NULL, '0100210426544', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, '2024-03-24', 1),
(72, 103187, NULL, '0100227124525', 'FDR', 'Janata Bank  Limited', 'Ramkrishnopur Br., Homna, Cumilla.', NULL, '2024-03-24', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankinfo`
--
ALTER TABLE `bankinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankinfo`
--
ALTER TABLE `bankinfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
