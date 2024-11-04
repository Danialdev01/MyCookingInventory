-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 04, 2024 at 01:12 AM
-- Server version: 10.11.3-MariaDB
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MyCookingInventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id_ingredient` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name_ingredient` text NOT NULL,
  `unit_ingredient` varchar(100) NOT NULL,
  `min_unit_ingredient` int(11) NOT NULL DEFAULT 1,
  `status_ingredient` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderings`
--

CREATE TABLE `orderings` (
  `id_ordering` int(11) NOT NULL,
  `date_ordering` date NOT NULL,
  `val_ordering` text NOT NULL,
  `status_ordering` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_analytics`
--

CREATE TABLE `report_analytics` (
  `id_report_analytic` int(11) NOT NULL,
  `create_date_report_analytic` date NOT NULL,
  `status_report_analytic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_values`
--

CREATE TABLE `report_values` (
  `id_report_value` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `id_report_analytic` int(11) DEFAULT NULL,
  `cost_ingredient` int(11) NOT NULL DEFAULT 0,
  `status_ingredient` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id_stock` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ingredient` int(11) NOT NULL,
  `cost_stock` varchar(100) NOT NULL,
  `val_stock` int(11) NOT NULL,
  `exp_date_stock` date NOT NULL,
  `created_date_stock` date NOT NULL,
  `status_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name_user` varchar(100) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password_user` text NOT NULL,
  `create_date_user` date NOT NULL,
  `status_user` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id_ingredient`);

--
-- Indexes for table `orderings`
--
ALTER TABLE `orderings`
  ADD PRIMARY KEY (`id_ordering`);

--
-- Indexes for table `report_values`
--
ALTER TABLE `report_values`
  ADD PRIMARY KEY (`id_report_value`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderings`
--
ALTER TABLE `orderings`
  MODIFY `id_ordering` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_values`
--
ALTER TABLE `report_values`
  MODIFY `id_report_value` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
