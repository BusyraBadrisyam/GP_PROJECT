-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2025 at 09:31 AM
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
-- Database: `knicks`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Name`, `Email`, `Phone`, `Password`) VALUES
(8001, 'Hani Batrisyia Binti Ahmad', 'Hani@gmail.com', '01111899930', '$2y$10$Koux/DUv9cC0Gs/to3Xzm./8pb0SKw9.GXNKNoheCsEXOl/S2AVWS'),
(8002, 'Asyikin Binti Zailan', 'Asyikin@gmail.com', '01111289581', '$2y$10$Koux/DUv9cC0Gs/to3Xzm./8pb0SKw9.GXNKNoheCsEXOl/S2AVWS'),
(8003, 'Nurin Afrina Binti Rostam', 'Nurin@gmail.com', '0134785746', '$2y$10$Koux/DUv9cC0Gs/to3Xzm./8pb0SKw9.GXNKNoheCsEXOl/S2AVWS'),
(8004, 'Aminur Shuhada Binti Asri', 'Aminur@gmail.com', '0197865674', '$2y$10$Koux/DUv9cC0Gs/to3Xzm./8pb0SKw9.GXNKNoheCsEXOl/S2AVWS');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `MemberID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `MembershipStatus` enum('Active','Inactive') DEFAULT 'Active',
  `ExpiryDate` timestamp NULL DEFAULT NULL,
  `DateJoined` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`MemberID`, `Name`, `Email`, `Phone`, `Address`, `Password`, `MembershipStatus`, `ExpiryDate`, `DateJoined`) VALUES
(1, 'Afrina Binti Ahmad', 'Afrina@gmail.com', '0123456758', 'Puncak Alam', '$2y$10$U83ZoZ8CYX4Nv/h/ertQWet9jlQKIwca4/Zo7n2Q9t7.Ome8EqIRa', 'Inactive', '2025-01-23 04:11:31', '2025-01-13 14:24:26'),
(2, 'Badrisyam Bin Ramli', 'Badrisyam@gmail.com', '01965755847', 'Bandar', '$2y$10$idfEzakKMG5aAnsbIVA3HOIYA3m.G/C.FpUMZkKoYQiUNEiJ7u8cm', 'Inactive', '2025-01-22 18:54:14', '2025-01-13 15:31:03'),
(3, 'Nur Asyikin', 'nour@gmail.com', '0123456758', 'Shah Alam', '$2y$10$vkT90icW/JMWEIKV7U0bZ.T6A6rGCbFlcexLnDdkYMXLTYSaQaEqK', 'Inactive', '2025-01-16 04:34:59', '2025-01-16 04:32:59'),
(4, 'Amina Binti Rahim', 'Amina@gmail.com', '0196755846', 'Bandar Putra', '$2y$10$Voi1ouxDbw7n8ygcG0xSx.g0KDARo6eaGSoMEdgD.9gLnaVSiX3Ya', 'Inactive', '2025-01-22 09:21:24', '2025-01-22 09:19:24'),
(5, 'Alia Binti Omran', 'Alia@gmail.com', '0176854673', 'Sabak Bernam', '$2y$10$0R1oSbCIf4CPxjJ1IwcdueMvVoDUZJDdK/jTdYHp2.fXrqyMI3Fr2', 'Active', '2025-01-22 18:46:49', '2025-01-22 18:44:49'),
(6, 'Aima Binti Idris', 'Aima@gmail.com', '0123456759', 'Puchong', '$2y$10$L4Fm9pQpmNJSdJeF36UfjeqMAfeJ/1xDEzvbAWTF3US/9Rnp5gUx.', 'Active', '2025-01-23 04:10:02', '2025-01-23 04:08:02'),
(7, 'Nur Batrisyia Busyra Binti Badrisyam', 'B@gmail.com', '01234', 'Puchong', '$2y$10$ZlzX0TXlY7sDK3eVPHHinemqwcnqsBCj/j9vwbaMelUTYD1st0uta', 'Active', '2025-01-23 04:28:10', '2025-01-23 04:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `membertournament`
--

CREATE TABLE `membertournament` (
  `MemberTournamentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `TournamentID` int(11) NOT NULL,
  `RegistrationDate` date NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `MemberID` int(11) NOT NULL,
  `PaymentType` enum('Registration','Renewal') NOT NULL,
  `Amount` decimal(10,2) NOT NULL DEFAULT 100.00,
  `PaymentDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `NextDueDate` date DEFAULT NULL,
  `PaymentStatus` enum('Completed','Pending') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `MemberID`, `PaymentType`, `Amount`, `PaymentDate`, `NextDueDate`, `PaymentStatus`) VALUES
(1, 1, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-13', 'Completed'),
(2, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-13', 'Completed'),
(3, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-13', 'Completed'),
(4, 2, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-13', 'Completed'),
(5, 2, '', 100.00, '0000-00-00 00:00:00', '2025-01-13', 'Completed'),
(6, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-14', 'Completed'),
(7, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-15', 'Completed'),
(8, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-15', 'Completed'),
(9, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-15', 'Completed'),
(10, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-16', 'Completed'),
(11, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-16', 'Completed'),
(12, 3, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-16', 'Completed'),
(13, 4, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-22', 'Completed'),
(14, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-22', 'Completed'),
(15, 5, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-23', 'Completed'),
(16, 2, '', 100.00, '0000-00-00 00:00:00', '2025-01-23', 'Completed'),
(17, 6, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-23', 'Completed'),
(18, 1, '', 100.00, '0000-00-00 00:00:00', '2025-01-23', 'Completed'),
(19, 7, 'Registration', 100.00, '0000-00-00 00:00:00', '2026-01-23', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `tournament`
--

CREATE TABLE `tournament` (
  `TournamentID` int(11) NOT NULL,
  `TournamentName` varchar(100) NOT NULL,
  `TournamentDate` date NOT NULL,
  `ImageURL` varchar(255) NOT NULL,
  `AdminID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament`
--

INSERT INTO `tournament` (`TournamentID`, `TournamentName`, `TournamentDate`, `ImageURL`, `AdminID`) VALUES
(1, 'Dexxe', '2025-02-03', 'image/dexxegame.jpg', NULL),
(2, 'Westport', '2025-02-25', 'image/Westport Tournament.png', NULL),
(3, 'UiTM Lions League', '2025-01-25', 'image/lionsleague.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`MemberID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Email_2` (`Email`);

--
-- Indexes for table `membertournament`
--
ALTER TABLE `membertournament`
  ADD PRIMARY KEY (`MemberTournamentID`),
  ADD KEY `MemberID` (`MemberID`),
  ADD KEY `TournamentID` (`TournamentID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `MemberID` (`MemberID`);

--
-- Indexes for table `tournament`
--
ALTER TABLE `tournament`
  ADD PRIMARY KEY (`TournamentID`),
  ADD KEY `fk_AdminID` (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8005;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `MemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `membertournament`
--
ALTER TABLE `membertournament`
  MODIFY `MemberTournamentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tournament`
--
ALTER TABLE `tournament`
  MODIFY `TournamentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `membertournament`
--
ALTER TABLE `membertournament`
  ADD CONSTRAINT `membertournament_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`),
  ADD CONSTRAINT `membertournament_ibfk_2` FOREIGN KEY (`TournamentID`) REFERENCES `tournament` (`TournamentID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`MemberID`) REFERENCES `member` (`MemberID`);

--
-- Constraints for table `tournament`
--
ALTER TABLE `tournament`
  ADD CONSTRAINT `fk_AdminID` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
