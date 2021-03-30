-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2021 at 06:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `serverside`
--

-- --------------------------------------------------------

--
-- Table structure for table `race`
--

CREATE TABLE `race` (
  `race_id` int(2) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `race`
--

INSERT INTO `race` (`race_id`, `name`) VALUES
(1, 'protoss'),
(2, 'terran'),
(3, 'zerg');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_id` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `requirements` varchar(50) DEFAULT NULL,
  `built_from` varchar(50) NOT NULL,
  `cost_minerals` varchar(50) NOT NULL,
  `cost_gas` varchar(50) DEFAULT NULL,
  `cost_supply` varchar(50) DEFAULT NULL,
  `attributes` varchar(100) DEFAULT NULL,
  `targets` varchar(50) DEFAULT NULL,
  `damage` varchar(50) DEFAULT NULL,
  `dps` varchar(100) DEFAULT NULL,
  `attack_cooldown` varchar(50) DEFAULT NULL,
  `attack_range` varchar(50) DEFAULT NULL,
  `health` varchar(50) NOT NULL,
  `shields` varchar(50) DEFAULT NULL,
  `armor` varchar(50) DEFAULT NULL,
  `sight` varchar(50) DEFAULT NULL,
  `speed` varchar(50) DEFAULT NULL,
  `transport_capacity` varchar(50) DEFAULT NULL,
  `image` longblob DEFAULT NULL,
  `race_id` int(2) NOT NULL,
  `race` varchar(50) NOT NULL,
  `strong_against` varchar(50) DEFAULT NULL,
  `weak_against` varchar(50) DEFAULT NULL,
  `description` varchar(150) DEFAULT NULL,
  `other` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_id`, `name`, `type`, `requirements`, `built_from`, `cost_minerals`, `cost_gas`, `cost_supply`, `attributes`, `targets`, `damage`, `dps`, `attack_cooldown`, `attack_range`, `health`, `shields`, `armor`, `sight`, `speed`, `transport_capacity`, `image`, `race_id`, `race`, `strong_against`, `weak_against`, `description`, `other`) VALUES
(1, 'Zergling', 'Ground', 'Spawning Pool', 'Hatchery', '25', '', '0.5', 'Biological - Light', 'Ground', '5(+1)', '10(+2)', '0.497', '0.1', '35', '0', '0(+1)', '8', '4.13', '1', NULL, 3, 'Zerg', 'Marauder - Stalker - Hydralisk', 'Hellion - Collossus - Baneling', 'Fast melee creature. Can morph into a Baneling.', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(11, 'admin', '$2y$10$KQT7l3bAsq0XJS75IfcDKuHz.jLuC5HTsOjJl41SEGTJFsXjUMb32', '2021-03-24'),
(12, 'snoah', '$2y$10$F21rBUqmEA.IMKpN3hyaVuN9gXKCG58ffy2FcWUzl4nh3ln.899eS', '2021-03-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `race`
--
ALTER TABLE `race`
  ADD PRIMARY KEY (`race_id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
