
ALTER TABLE `salarydetails` ADD `refnoextra` VARCHAR(20) NULL DEFAULT NULL AFTER `refnopf`;
ALTER TABLE `cashbook` ADD `refno` VARCHAR(20) NULL DEFAULT NULL AFTER `type`;

ALTER TABLE `cashbook` ADD `month` INT NOT NULL DEFAULT '0' AFTER `sessionyear`, ADD `year` INT NOT NULL DEFAULT '0' AFTER `month`;


-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2024 at 12:24 AM
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
-- Database: `eimbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `refbook`
--

CREATE TABLE `refbook` (
  `id` int(11) NOT NULL,
  `sccode` int(11) DEFAULT NULL,
  `sessionyear` int(11) DEFAULT NULL,
  `refno` varchar(30) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `descrip` varchar(500) DEFAULT NULL,
  `entryby` varchar(100) DEFAULT NULL,
  `entrytime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `refbook`
--
ALTER TABLE `refbook`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `refbook`
--
ALTER TABLE `refbook`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- --------------------------------------------------------
-- --------------------------------------------------------
-- --------------------------------------------------------
