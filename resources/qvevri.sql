-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2020 at 12:26 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qvevri`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `email` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`email`, `password`) VALUES
('admin@admin.com', '$2y$10$Jo10V6eOiSG9KC4ItjplI.3CbRk0Sl3XWKLT5xbEWSOQaCjFq9kyi');

-- --------------------------------------------------------

--
-- Table structure for table `descriptions`
--

CREATE TABLE `descriptions` (
  `id` int(11) NOT NULL,
  `en_title` varchar(50) NOT NULL,
  `ge_title` varchar(50) NOT NULL,
  `ru_title` varchar(50) NOT NULL,
  `en_subtitle` varchar(50) NOT NULL,
  `ge_subtitle` varchar(50) NOT NULL,
  `ru_subtitle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `img_name` varchar(10) NOT NULL,
  `page_name` varchar(10) NOT NULL,
  `type` varchar(10) NOT NULL,
  `descriptions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `img_name`, `page_name`, `type`, `descriptions_id`) VALUES
(7, '1.jpeg', 'menu', 'logo', 0);

-- --------------------------------------------------------

--
-- Table structure for table `image_descriptions`
--

CREATE TABLE `image_descriptions` (
  `images_id` int(11) NOT NULL,
  `descriptions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `ge_title` varchar(255) NOT NULL,
  `ru_title` varchar(255) NOT NULL,
  `en_subtitle` varchar(255) NOT NULL,
  `ge_subtitle` varchar(255) NOT NULL,
  `ru_subtitle` varchar(255) NOT NULL,
  `page` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `en_title` varchar(20) NOT NULL,
  `ge_title` varchar(50) NOT NULL,
  `ru_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `en_title`, `ge_title`, `ru_title`) VALUES
(1, 'HOM12', 'მთავარ', ''),
(2, 'HOTE1', 'სასტუმრ', ''),
(3, 'MUSEUM', 'მუზემუმო', ''),
(4, 'RESTAURANT', 'რესტორ', ''),
(5, 'activity', 'აქტივითი', ''),
(6, 'wine shop', 'ღვინის მაღაზოა', ''),
(7, 'lake', 'ტბა', ''),
(8, 'contact', 'კონტაკქოs', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `descriptions_id` (`descriptions_id`);

--
-- Indexes for table `image_descriptions`
--
ALTER TABLE `image_descriptions`
  ADD PRIMARY KEY (`images_id`,`descriptions_id`),
  ADD KEY `descriptions_id` (`descriptions_id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `descriptions`
--
ALTER TABLE `descriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `descriptions`
--
ALTER TABLE `descriptions`
  ADD CONSTRAINT `descriptions_ibfk_1` FOREIGN KEY (`id`) REFERENCES `images` (`descriptions_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `image_descriptions`
--
ALTER TABLE `image_descriptions`
  ADD CONSTRAINT `image_descriptions_ibfk_1` FOREIGN KEY (`descriptions_id`) REFERENCES `descriptions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
