-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2021 at 03:07 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practice`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `idM` int(11) NOT NULL,
  `idI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `Comment`, `idM`, `idI`) VALUES
(1, 'Zadatak je OK', 1, 1),
(2, 'Preuredi zadatak', 1, 1),
(3, 'Neki komentar', 1, 1),
(4, 'Neki komentar', 1, 1),
(5, 'Neki komentar', 1, 1),
(6, 'Neki komentar', 1, 1),
(7, 'Neki komentar', 1, 1),
(8, 'Neki komentar2', 1, 1),
(9, 'Neki komentar2', 1, 2),
(10, 'Neki komentar3', 1, 2),
(11, 'Neki komentar3', 1, 2),
(12, 'Neki komentar3', 1, 2),
(13, 'Neki komentar3', 1, 2),
(14, 'Neki komentar4', 1, 2),
(15, 'Neki komentar4', 1, 2),
(16, 'Neki komentar4', 1, 2),
(17, 'Neki komentar45', 1, 2),
(18, 'Neki komentar45', 1, 2),
(19, 'Neki komentar45', 1, 2),
(20, 'radi!!!', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `Title` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `Title`) VALUES
(1, 'Nis'),
(2, 'Beograd'),
(3, 'Novi Sad'),
(4, 'Kragujevac');

-- --------------------------------------------------------

--
-- Table structure for table `interns`
--

CREATE TABLE `interns` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Surname` varchar(45) NOT NULL,
  `idG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `interns`
--

INSERT INTO `interns` (`id`, `Name`, `Surname`, `idG`) VALUES
(1, 'Ivana', 'Orlovic', 1),
(2, 'Dalibor', 'Marinkovic', 1),
(3, 'Petar', 'Nikolic', 2),
(4, 'Uros', 'Davidovic', 2),
(9, 'Predrag', 'Simic', 3);

-- --------------------------------------------------------

--
-- Table structure for table `mentors`
--

CREATE TABLE `mentors` (
  `id` int(11) NOT NULL,
  `Name` varchar(45) NOT NULL,
  `Surname` varchar(45) NOT NULL,
  `idG` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mentors`
--

INSERT INTO `mentors` (`id`, `Name`, `Surname`, `idG`) VALUES
(1, 'Aleksandra', 'Ceranic', 1),
(2, 'Bosko', 'Stupar', 2),
(3, 'Nevena', 'Mitrovic', 3),
(4, 'Petar', 'Nenadovic', 4),
(5, 'Sanja', 'Savic', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interns`
--
ALTER TABLE `interns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Intern` (`idG`);

--
-- Indexes for table `mentors`
--
ALTER TABLE `mentors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_Mentor` (`idG`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interns`
--
ALTER TABLE `interns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `mentors`
--
ALTER TABLE `mentors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `interns`
--
ALTER TABLE `interns`
  ADD CONSTRAINT `FK_Intern` FOREIGN KEY (`idG`) REFERENCES `groups` (`id`);

--
-- Constraints for table `mentors`
--
ALTER TABLE `mentors`
  ADD CONSTRAINT `FK_Mentor` FOREIGN KEY (`idG`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
