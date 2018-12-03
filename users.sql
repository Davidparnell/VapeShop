-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 05:55 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groupproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(30) COLLATE tis620_bin NOT NULL,
  `Address` varchar(150) COLLATE tis620_bin NOT NULL,
  `Username` varchar(12) COLLATE tis620_bin NOT NULL,
  `Password` varchar(15) COLLATE tis620_bin NOT NULL,
  `Email` varchar(50) COLLATE tis620_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=tis620 COLLATE=tis620_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Address`, `Username`, `Password`, `Email`) VALUES
('Jihye', '8 Parker House Myrtle Court The Coast, Baldoyle Du', 'Jihye', '123456', 'd18123446@mydit.ie'),
('Tanya Tompson', 'unknown', 'TanyaT', '123456', 'davidandjiyhe@highmark.com'),
('David Parnell', '223 Orwell Park Heights, Templeogue', 'davidparnell', '123456789', 'davidpcao5@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
