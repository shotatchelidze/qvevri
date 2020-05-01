-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 01:30 AM
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
-- Table structure for table `imagebgs`
--

CREATE TABLE `imagebgs` (
  `id` int(11) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `page_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `imagebgs`
--

INSERT INTO `imagebgs` (`id`, `image_name`, `page_name`) VALUES
(2, 'eso1907a.jpg', 'index'),
(3, 'download.jpg', 'news');

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

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `img_name`, `en_title`, `ge_title`, `ru_title`, `en_subtitle`, `ge_subtitle`, `ru_subtitle`, `page`) VALUES
(9, 'asatvirtisurati.png', 'asdas', 'dasdas', 'asdasd', 'dadsa', 'dasdasd', 'asd', 'index'),
(11, '1.jpeg', 'adasd', 'sdasdsad', 'sdasdas', 'asdasda', 'asdasda', 'dasdasdads', 'menu');

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

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `bg_img_name` varchar(255) NOT NULL,
  `icon_img_name` varchar(255) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `en_text` text NOT NULL,
  `ge_title` varchar(255) NOT NULL,
  `ge_text` text NOT NULL,
  `ru_title` varchar(255) NOT NULL,
  `ru_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `img_name`, `bg_img_name`, `icon_img_name`, `en_title`, `en_text`, `ge_title`, `ge_text`, `ru_title`, `ru_text`) VALUES
(1, 'images (1).jpg', 'photo-1532767153582-b1a0e5145009.jpg', 'images.jpg', 'aa', 'aa', 'aa', 'aa', 'aaa', 'aaa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `imagebgs`
--
ALTER TABLE `imagebgs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `imagebgs`
--
ALTER TABLE `imagebgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
