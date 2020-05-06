-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 07:31 PM
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
(9, 'asatvirtisurati.png', 'asdas', 'dasdas', 'asdasd', 'dadsa', 'dasdasd', 'asd', 'menu'),
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
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `news_img_name` varchar(255) NOT NULL,
  `en_title` varchar(255) NOT NULL,
  `en_subtitle` varchar(255) NOT NULL,
  `en_text` text NOT NULL,
  `ge_title` varchar(255) NOT NULL,
  `ge_subtitle` varchar(255) NOT NULL,
  `ge_text` text NOT NULL,
  `ru_title` varchar(255) NOT NULL,
  `ru_subtitle` varchar(255) NOT NULL,
  `ru_text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `language` varchar(2) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `item_id`, `news_img_name`, `en_title`, `en_subtitle`, `en_text`, `ge_title`, `ge_subtitle`, `ge_text`, `ru_title`, `ru_subtitle`, `ru_text`, `created_at`, `language`) VALUES
(5, 5, 'news_table.jpg', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', '', '2020-05-04 18:30:48', 'en'),
(6, 6, '', 'News/Blogs2', 'News/Blogs2', '2News/Blogs2', 'News/Blogs2', 'News/Blogs2', '', '', 'News/Blogs2', 'News/Blogs2', '2020-05-05 19:04:42', 'en'),
(7, 7, '', 'News/Blogs3', 'News/Blogs3', 's/Blogs3', 'Ns/Blogs3', 's/Blogs3', 's/Blogs3', 's/Blogs3', 's/Blogs3', '', '2020-05-05 19:05:03', 'en'),
(8, 8, '', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', 'ws/Blogs4', '', '2020-05-05 19:05:19', 'en'),
(9, 9, '', 's/Blogs5', 's/Blogs5', 's/Blogs5', 's/Blogs5s/Blogs5', 's/Blogs5', 's/Blogs5', 's/Blogs5', '', '', '2020-05-05 19:05:30', 'en'),
(10, 10, '', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', 'ews/Blog6', '', '2020-05-05 19:05:45', 'en'),
(11, 11, 'a3.jpg', '', '', '', '', '', '', '', '', '', '2020-05-06 00:35:54', 'en'),
(12, 12, 'eso1907a.jpg', '', '', '', '', '', '', '', '', '', '2020-05-06 00:37:02', 'en'),
(13, 5, 'news_table.jpg', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', 'News/Blogs', '', '2020-05-04 18:30:48', 'ge');

-- --------------------------------------------------------

--
-- Table structure for table `news_imgs`
--

CREATE TABLE `news_imgs` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_imgs`
--

INSERT INTO `news_imgs` (`id`, `news_id`, `img_name`) VALUES
(9, 5, 'newsImgstable.png'),
(10, 10, '1 - Copy - Copy.jpeg'),
(11, 10, 'dowssssnload.jpg'),
(12, 12, 'a3.jpg');

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
(9, 'images (1).jpg', '', 'images.jpg', 'Section', 'Section', 'Section', 'Section', 'Section', 'Section');

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
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news_imgs`
--
ALTER TABLE `news_imgs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

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
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `news_imgs`
--
ALTER TABLE `news_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `news_imgs`
--
ALTER TABLE `news_imgs`
  ADD CONSTRAINT `news_imgs_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
