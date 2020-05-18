-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2020 at 05:22 PM
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
  `item_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `page` varchar(20) NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `item_id`, `img_name`, `title`, `subtitle`, `page`, `language`) VALUES
(54, 54, 'LOGO_ge.png', 'Twins Wine Cellar', 'Kakheti-Everything\r\nIn One Space', 'welcome', 'en'),
(55, 54, 'LOGO_ge.png', 'ტყუპების ღვინის მარანი', 'კახეთი-ყველაფერი\r\nერთ სივრცეში', 'welcome', 'ge'),
(56, 54, 'LOGO_ge.png', 'Винный погреб Твинс', 'Кахетия-все\r\nВ одном пространстве', 'welcome', 'ru'),
(57, 57, 'logohistory.png', 'Our History', 'Family Of\r\nGamtkitsulashvili', 'welcome', 'en'),
(58, 57, 'logohistory.png', 'ჩვენი ისტორია', 'ოჯახი\r\nგამყრწულაშვილი', 'welcome', 'ge'),
(59, 57, 'logohistory.png', 'Наша история', 'Семья О\r\nGamtkitsulashvili', 'welcome', 'ru'),
(60, 60, 'logo2.png', 'Blog', 'Qvevri\r\nAnd Qvevri Wine', 'welcome', 'en'),
(61, 60, 'logo2.png', 'ბლოგი', 'ქვევრი\r\nდა ქვევრის ღვინო', 'welcome', 'ge'),
(62, 60, 'logo2.png', 'Блог', 'Qvevri\r\nИ вино квеври', 'welcome', 'ru'),
(63, 63, 'LOGO1.png', 'Twins Wine House', 'Ancient Art\r\nOf Wine Making', 'welcome', 'en'),
(64, 63, 'LOGO1.png', 'ტყუპების ღვინის სახლი', 'უძველესი ხელოვნება\r\nღვინის წარმოების', 'welcome', 'ge'),
(65, 63, 'LOGO1.png', 'Винный Дом Близнецов', 'Древнее искусство\r\nВиноделия', 'welcome', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `item_id`, `title`, `language`) VALUES
(1, 1, 'HOME3', 'en'),
(2, 1, 'მთავარი3', 'ge'),
(3, 1, '', 'ru'),
(4, 4, 'Hotel', 'en'),
(5, 4, 'ჰოტელი', 'ge'),
(6, 4, '', 'ru'),
(7, 7, 'Museum', 'en'),
(8, 7, 'მუზეუმი', 'ge'),
(9, 7, '', 'ru'),
(10, 10, 'restaurant', 'en'),
(11, 10, 'რესტორანი', 'ge'),
(12, 10, '', 'ru'),
(13, 13, 'activity', 'en'),
(14, 13, 'აქტივითი', 'ge'),
(15, 13, '', 'ru'),
(16, 16, 'wineshop', 'en'),
(17, 16, 'ღვინი მაღაზია', 'ge'),
(18, 16, '', 'ru'),
(19, 19, 'lake', 'en'),
(20, 19, 'ტბა', 'ge'),
(21, 19, '', 'ru'),
(22, 22, 'contact', 'en'),
(23, 22, 'კონტაკქტი', 'ge'),
(24, 22, '', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `news_img_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `language` varchar(2) NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `item_id`, `news_img_name`, `title`, `subtitle`, `text`, `created_at`, `language`) VALUES
(14, 14, '', 'English Title:', 'English Subtitle:', 'English Text:', '2020-05-10 23:44:16', 'en'),
(15, 14, '', 'Georgian Title:', 'Georgian Subtitle:', 'Georgian Text:', '2020-05-10 23:44:16', 'ge'),
(16, 14, '', 'Russian Title:', 'Russian Subtitle:', 'Russian Text:', '2020-05-10 23:44:16', 'ru'),
(17, 17, '', 'English Title:2', 'English Subtitle:2', 'English Text:2', '2020-05-10 23:45:28', 'en'),
(18, 17, '', 'Georgian Title:2', 'Georgian Subtitle:2', 'Georgian Text:2', '2020-05-10 23:45:28', 'ge'),
(19, 17, '', 'Russian Title:2', 'Russian Subtitle:2', 'Russian Text:2', '2020-05-10 23:45:28', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `news_imgs`
--

CREATE TABLE `news_imgs` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paginations`
--

CREATE TABLE `paginations` (
  `id` int(11) NOT NULL,
  `result_per_page` smallint(1) NOT NULL,
  `page_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paginations`
--

INSERT INTO `paginations` (`id`, `result_per_page`, `page_name`) VALUES
(2, 10, 'news'),
(3, 15, 'products');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `item_id`, `product_name`, `img_name`, `title`, `text`, `quantity`, `serial_number`, `created_at`, `language`) VALUES
(4, 4, 'adad', '', 'ad', 'ada', 126111, 'wqeqwe', '2020-05-16 23:44:01', 'en'),
(5, 4, 'asdasd', '', 'dasd', '222', 126111, 'wqeqwe', '2020-05-16 23:44:01', 'ge'),
(6, 4, 'ad', '', 'ds', 'asdad', 126111, 'wqeqwe', '2020-05-16 23:44:01', 'ru'),
(7, 7, 'ss', '1.jpeg', 'asdasd', 'asdasd', 2, 'ww', '2020-05-17 20:50:33', 'en'),
(8, 7, 'adasd', '1.jpeg', 'asd', 'adas', 2, 'ww', '2020-05-17 20:50:33', 'ge'),
(9, 7, 'das', '1.jpeg', 'dad', 'asd', 2, 'ww', '2020-05-17 20:50:33', 'ru'),
(10, 10, 'dasd', '1.jpeg', 'asd', 'sd', 2, 'ds', '2020-05-17 20:50:49', 'en'),
(11, 10, '', '1.jpeg', 'dasd', 'asd', 2, 'ds', '2020-05-17 20:50:49', 'ge'),
(12, 10, 'asd', '1.jpeg', 'dasd', 'asd', 2, 'ds', '2020-05-17 20:50:49', 'ru'),
(13, 13, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:42', 'en'),
(14, 13, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:42', 'ge'),
(15, 13, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:43', 'ru'),
(16, 16, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:43', 'en'),
(17, 16, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:43', 'ge'),
(18, 16, '', '1.jpeg', '', '', 0, '', '2020-05-17 20:54:43', 'ru'),
(19, 19, '', '', 'ada', 'da', 0, '', '2020-05-17 20:56:09', 'en'),
(20, 19, 'sd', '', '', 'asd', 0, '', '2020-05-17 20:56:09', 'ge'),
(21, 19, '', '', '', '', 0, '', '2020-05-17 20:56:09', 'ru');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `bg_img_name` varchar(255) NOT NULL,
  `icon_img_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `language` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `item_id`, `img_name`, `bg_img_name`, `icon_img_name`, `title`, `text`, `language`) VALUES
(13, 13, '1.jpeg', '', '', 'adasdasdd2', 'asdasdds2', 'en'),
(14, 13, '1.jpeg', '', '', 'qweqweeqw2', 'addsd2', 'ge'),
(15, 13, '1.jpeg', '', '', 'adasd2', 'adasddas2', 'ru'),
(16, 16, '', '', '', 'adasdasdd3', 'asdasdds2', 'en'),
(17, 16, '', '', '', 'qweqweeqw3', 'addsd2', 'ge'),
(18, 16, '', '', '', 'adasd3', 'adasddas2', 'ru');

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
-- Indexes for table `paginations`
--
ALTER TABLE `paginations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `news_imgs`
--
ALTER TABLE `news_imgs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `paginations`
--
ALTER TABLE `paginations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
