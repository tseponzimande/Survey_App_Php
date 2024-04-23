-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 01:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblsurvey`
--

CREATE TABLE `tblsurvey` (
  `survey_id` int(100) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `contactNo` varchar(255) NOT NULL,
  `fav_food` tinyint(1) NOT NULL,
  `watch_movies` varchar(255) NOT NULL,
  `listen_radio` varchar(255) NOT NULL,
  `eat_out` varchar(255) NOT NULL,
  `watch_tv` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsurvey`
--

INSERT INTO `tblsurvey` (`survey_id`, `fullName`, `email`, `dateOfBirth`, `contactNo`, `fav_food`, `watch_movies`, `listen_radio`, `eat_out`, `watch_tv`) VALUES
(1, 'ti', 'ti@gmail.com', '1994-01-01', '0789654322', 0, 'Neutral', 'Agree', 'Agree', 'Strongly Disagree'),
(2, 'qa', 'qa@gmail.com', '2012-04-01', '0798989888', 0, 'Neutral', 'Strongly Agree', 'Strongly Agree', 'Agree'),
(3, 'pil', 'pil@yahoo.com', '1988-12-20', '0890890000', 0, 'Strongly Agree', 'Strongly Agree', 'Disagree', 'Disagree'),
(4, 'jon', 'jon@gamil.com', '1966-07-13', '0790982345', 0, 'Strongly Agree', 'Strongly Agree', 'Strongly Agree', 'Strongly Agree'),
(5, 'jam', 'jam@gmail.com', '1908-02-02', '0890890011', 0, 'Strongly Agree', 'Strongly Agree', 'Strongly Disagree', 'Strongly Agree'),
(6, 'as', 'as@gmail.com', '2015-01-01', '0792289888', 0, 'Strongly Agree', 'Strongly Agree', 'Strongly Agree', 'Strongly Agree'),
(7, 'ni', 'ni@gmail.com', '2002-11-08', '0890897721', 0, 'Strongly Agree', 'Strongly Agree', 'Strongly Agree', 'Disagree');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblsurvey`
--
ALTER TABLE `tblsurvey`
  ADD PRIMARY KEY (`survey_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblsurvey`
--
ALTER TABLE `tblsurvey`
  MODIFY `survey_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
