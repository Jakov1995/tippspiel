-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2020 at 08:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `m133`
--

-- --------------------------------------------------------

--
-- Table structure for table `highscores`
--

CREATE TABLE `highscores` (
  `Id` int(11) NOT NULL,
  `Erzeugungszeitstempel` date NOT NULL DEFAULT current_timestamp(),
  `Alias` varchar(40) NOT NULL DEFAULT 'guest',
  `Sekunden` int(11) NOT NULL,
  `Tippzahl` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `highscores`
--

INSERT INTO `highscores` (`Id`, `Erzeugungszeitstempel`, `Alias`, `Sekunden`, `Tippzahl`) VALUES
(1, '2020-01-07', 'jakov', 10, 4),
(2, '2020-01-07', 'günter', 10, 3),
(3, '2020-01-07', 'kaka', 5, 3),
(4, '2020-01-07', 'peter', 9, 3),
(5, '2020-01-07', 'w', 4, 3),
(6, '2020-01-07', 'ss', 12, 4),
(7, '2020-01-07', 'd', 11, 8),
(8, '2020-01-07', 'abcd', 8, 10),
(9, '2020-01-07', 'jesus', 16, 5),
(10, '2020-01-07', 'sdsd', 4, 3),
(11, '2020-01-07', 'hansueli', 5, 4),
(12, '2020-01-07', 'sdsd', 15, 3),
(13, '2020-01-07', 'wd', 43, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `highscores`
--
ALTER TABLE `highscores`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Tippzahl` (`Tippzahl`),
  ADD KEY `Sekunden` (`Sekunden`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `highscores`
--
ALTER TABLE `highscores`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
