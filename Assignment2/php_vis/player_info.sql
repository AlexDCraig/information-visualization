-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 05:28 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nba`
--

-- --------------------------------------------------------

--
-- Table structure for table `player_info`
--

CREATE TABLE `player_info` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `age` int(11) NOT NULL,
  `team_name` varchar(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `loss` int(11) NOT NULL,
  `ppg` float NOT NULL,
  `rpg` float NOT NULL,
  `bpg` float NOT NULL,
  `apg` float NOT NULL,
  `tpg` float NOT NULL,
  `spg` float NOT NULL,
  `games` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `player_info`
--

INSERT INTO `player_info` (`id`, `name`, `age`, `team_name`, `wins`, `loss`, `ppg`, `rpg`, `bpg`, `apg`, `tpg`, `spg`, `games`) VALUES
(1, 'James Harden', 27, 'HOU', 54, 27, 36.4, 8.1, 5.7, 11.2, 5.7, 1.5, 81),
(2, 'Danilo Gallinari', 28, 'DEN', 31, 32, 33.9, 5.2, 1.3, 2.1, 1.3, 0.6, 63),
(3, 'Jordan Clarkson', 24, 'LAL', 26, 56, 29.2, 3, 2, 2.6, 2, 1.1, 82),
(4, 'Jeremy Lin', 28, 'BKN', 13, 23, 24.5, 3.8, 2.4, 5.1, 2.4, 1.2, 36),
(5, 'Jordan Crawford', 28, 'NOP', 9, 10, 23.3, 1.8, 1.3, 3, 1.3, 0.6, 19),
(6, 'Nick Young', 31, 'LAL', 19, 41, 25.9, 2.3, 0.6, 1, 0.6, 0.6, 60),
(7, 'Tyreke Evans', 27, 'SAC', 17, 23, 19.7, 3.4, 1.5, 3.1, 1.5, 0.9, 40);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `player_info`
--
ALTER TABLE `player_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `player_info`
--
ALTER TABLE `player_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
