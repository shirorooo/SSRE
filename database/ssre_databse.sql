-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2021 at 01:10 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ssre_databse`
--

-- --------------------------------------------------------

--
-- Table structure for table `admincredentials`
--

CREATE TABLE `admincredentials` (
  `id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admincredentials`
--

INSERT INTO `admincredentials` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `servicerep`
--

CREATE TABLE `servicerep` (
  `sID` int(11) NOT NULL,
  `sFName` varchar(45) DEFAULT NULL,
  `sMI` varchar(2) DEFAULT NULL,
  `sLName` varchar(45) DEFAULT NULL,
  `sAddress` varchar(500) DEFAULT NULL,
  `sCNum` varchar(12) DEFAULT NULL,
  `rFName` varchar(45) DEFAULT NULL,
  `rMI` varchar(2) DEFAULT NULL,
  `rLName` varchar(45) DEFAULT NULL,
  `rAddress` varchar(500) DEFAULT NULL,
  `rCNum` varchar(12) DEFAULT NULL,
  `courier` varchar(45) DEFAULT NULL,
  `deliveryDate` varchar(45) DEFAULT NULL,
  `dateReceived` varchar(45) DEFAULT NULL,
  `packContent` text DEFAULT NULL,
  `modePayment` varchar(45) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `receiptNo` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `servicerep`
--

INSERT INTO `servicerep` (`sID`, `sFName`, `sMI`, `sLName`, `sAddress`, `sCNum`, `rFName`, `rMI`, `rLName`, `rAddress`, `rCNum`, `courier`, `deliveryDate`, `dateReceived`, `packContent`, `modePayment`, `status`, `price`, `receiptNo`) VALUES
(1, 'Ricco Rowell', 'O.', 'Andres', 'Blk. 34 Lot 4, Diamond St., Holiday Homes, Biclatan, General Trias, Cavite', '09753366619', 'Jamie Rose', 'L.', 'Andres', 'Tagudin, Ilocos Sur', '09753366619', 'Motor Courier', '04/27/2021', '2021-04-27', 'Documents', 'Cash Upon Pick-up', 'Processing', 'Computing', '000002021MTRCL');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admincredentials`
--
ALTER TABLE `admincredentials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `servicerep`
--
ALTER TABLE `servicerep`
  ADD PRIMARY KEY (`sID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admincredentials`
--
ALTER TABLE `admincredentials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `servicerep`
--
ALTER TABLE `servicerep`
  MODIFY `sID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
