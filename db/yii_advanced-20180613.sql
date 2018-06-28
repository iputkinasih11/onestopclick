-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2018 at 07:33 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii_advanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Ew5lQlqhxvkciNPYSzZ1vIhu6Ds4j7em', '$2y$13$T4gi.7mzrelVxxRh7dXqL.lW0jf8Yz.bCgUkzvjUw4BG0Cjs2rxLC', NULL, 'iputkinasih@gmail.com', 10, 1528341206, 1528341206);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `picture` varchar(256) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`, `description`, `status`, `picture`, `created_at`, `updated_at`) VALUES
(0, 'All Category', 'all-category', 'All Category', 0, '', '2018-06-13 02:57:42', '2018-06-13 02:57:42'),
(1, 'book', 'book', 'Category for book collections', 1, 'uploads/book-1528774975.jpg', '2018-06-07 03:08:57', '2018-06-12 08:34:42'),
(2, 'music', 'music', 'Category for music collections', 1, 'uploads/music-1528775036.png', '2018-06-07 03:37:42', '2018-06-12 03:43:56'),
(3, 'movie', 'movie', 'Category for Movie Collections', 1, 'uploads/movie-1528775043.jpg', '2018-06-07 03:41:06', '2018-06-12 03:44:03'),
(4, 'app', 'app', 'Category for App Collections', 1, 'uploads/app-1528775050.jpg', '2018-06-11 04:07:57', '2018-06-12 03:44:10');

-- --------------------------------------------------------

--
-- Table structure for table `forget_password`
--

CREATE TABLE `forget_password` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `encryption_key` varchar(64) NOT NULL,
  `code` varchar(254) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forget_password`
--

INSERT INTO `forget_password` (`id`, `user`, `encryption_key`, `code`, `created_at`, `updated_at`, `status`) VALUES
(3, 4, 'ZBdQ_VXBY-Rz4YP_MWj0yVJPSxGpP2QL', 'Wu1Nw4etfGa2MMObyQtTg-iXhUC693ba', '2018-06-13 03:56:49', '2018-06-13 03:56:49', 0),
(4, 4, '-iys83pWVgTCgLcwbRC4paaxjWftrWpK', 'NAwONICHGHtUxRIbnOiioj5ex2Q0qmsS', '2018-06-13 03:57:20', '2018-06-13 03:57:20', 0),
(5, 4, 'ZCYH5xYNz8XQUQFhTWOTDphVZtJR0rWE', '8EiaOHPOFzXSJBWDAnp4FGXcF4AsJmLT', '2018-06-13 03:59:38', '2018-06-13 03:59:38', 0),
(6, 4, 'D2PbJNhR9DFNgoE2LjdMBaS0l_wxSU3o', 'LzfLDXaWhn3QFDhvHl4LjtZ3dxgFeZrt', '2018-06-13 04:00:42', '2018-06-13 04:00:42', 0),
(7, 4, 'RTD7IuW6CuNnS0FdtA6oB1w9QVnbaRgP', 'YQYkfi5OGhvsOh4CYbRdjnmvWSZCtOmj', '2018-06-13 04:01:38', '2018-06-13 04:01:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1528340411),
('m130524_201442_init', 1528340413);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `author` varchar(200) NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` varchar(200) NOT NULL,
  `picture` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `slug`, `description`, `author`, `category_id`, `price`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BKA0001', 'The Murder of Roger Ackroyd', 'the-murder-of-roger-ackroyd', 'The Murder of Roger Ackroyd is a work of detective fiction by Agatha Christie, first published in June 1926 in the United Kingdom by William Collins, Sons and in the United States by Dodd, Mead and Company on 19 June 1926.', 'Agatha Christie', 1, '60000', 'uploads/the-murder-of-roger-ackroyd-1528774116.jpg', 1, '2018-06-07 06:58:59', '2018-06-12 03:28:36'),
(2, 'BKA0002', 'The Murder on the Orient Express', 'the-murder-on-the-orient-express', 'Murder on the Orient Express is a detective novel by Agatha Christie featuring the Belgian detective Hercule Poirot. It was first published in the United Kingdom by the Collins Crime Club on 1 January 1934.', 'Agatha Christie', 1, '100000', 'uploads/the-murder-on-the-orient-express-1528774613.jpg', 1, '2018-06-07 07:21:10', '2018-06-12 03:36:53'),
(3, 'BKA0003', 'Breaking Dawn', 'breaking-dawn', 'Breaking Dawn is the fourth and second to final novel in The Twilight Saga by American author Stephenie Meyer.', 'Stephenie Meyer', 1, '150000', 'uploads/breaking-dawn-1528774649.jpg', 1, '2018-06-11 07:27:35', '2018-06-12 03:37:29'),
(4, 'MCA0001', 'Almost Is Never Enough', 'almost-is-never-enough', '\"Almost Is Never Enough\" is a song recorded by American singer Ariana Grande and English singer Nathan Sykes. The pop and soul-influenced track was written by Grande, Harmony Samuels, Carmen Reece, Al Sherrod Lambert, Olaniyi-Akinpelu, and its producer, Moses Samuels. Two official versions of the song exist. The soundtrack version is included on the official soundtrack for the 2013 fantasy film The Mortal Instruments: City of Bones and was released August 19, 2013 via Republic Records as a second promotional single from the same, following Colbie Caillat\'s \"When the Darkness Comes\" on July 10, and a longer version was remastered for inclusion on Grande\'s debut studio album, Yours Truly (2013).', 'Ariana Grande', 2, '50000', 'uploads/almost-is-never-enough-1528774347.jpg', 1, '2018-06-12 03:32:27', '2018-06-12 03:32:27');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `slug`, `status`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'novel', 'novel', 1, 1, '2018-06-07 03:09:23', '2018-06-07 07:23:05'),
(2, 'pop', 'pop', 1, 2, '2018-06-07 05:20:31', '2018-06-07 05:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'iput', 'Ew5lQlqhxvkciNPYSzZ1vIhu6Ds4j7em', '$2y$13$T4gi.7mzrelVxxRh7dXqL.lW0jf8Yz.bCgUkzvjUw4BG0Cjs2rxLC', 'SZbgBGejv6ZiIDM-NDB09btrW3qy8uJu_1528849535', 'iputkinasih@gmail.com', 10, 1528341206, 1528849535);

-- --------------------------------------------------------

--
-- Table structure for table `usernew`
--

CREATE TABLE `usernew` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `address` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `picture` varchar(128) NOT NULL,
  `social_media_type` tinyint(1) DEFAULT NULL,
  `social_media_id` varchar(64) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usernew`
--

INSERT INTO `usernew` (`id`, `name`, `address`, `email`, `picture`, `social_media_type`, `social_media_id`, `password`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(4, 'iput', 'Jalan Bedugul Gang Yehning', 'iputkinasih@gmail.com', '', NULL, NULL, 'e10adc3949ba59abbe56e057f20f883e', '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `discount_prosentase` int(3) NOT NULL DEFAULT '0',
  `discount_price` int(11) NOT NULL DEFAULT '0',
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `voucher`
--

INSERT INTO `voucher` (`id`, `name`, `slug`, `description`, `discount_prosentase`, `discount_price`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Book Discount', 'book-discount', 'Lorem ipsum dolor sit amet, ad ludus doming sed, quas mandamus argumentum te ius, ex dico libris incorrupte nec. Illud falli atomorum vis ut, te mei ipsum oporteat delicatissimi, in quem diceret partiendo has. Salutatus honestatis interpretaris an mea, dicunt latine minimum ut has. Mei alia quaeque volumus te, eu eros voluptatum eum.', 0, 10000, '2018-06-12 16:00:00', '2018-06-19 16:00:00', 1, '2018-06-13 05:27:18', '2018-06-13 05:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `voucher_detail`
--

CREATE TABLE `voucher_detail` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forget_password`
--
ALTER TABLE `forget_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_product` (`category_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_category_subcategory` (`category_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- Indexes for table `usernew`
--
ALTER TABLE `usernew`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher_detail`
--
ALTER TABLE `voucher_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_voucher_voucher_detail` (`voucher_id`),
  ADD KEY `fk_category_voucher_detail` (`category_id`),
  ADD KEY `fk_product_voucher_detail` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usernew`
--
ALTER TABLE `usernew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voucher_detail`
--
ALTER TABLE `voucher_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_category_product` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_category_subcategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);

--
-- Constraints for table `voucher_detail`
--
ALTER TABLE `voucher_detail`
  ADD CONSTRAINT `fk_category_voucher_detail` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `fk_product_voucher_detail` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `fk_voucher_voucher_detail` FOREIGN KEY (`voucher_id`) REFERENCES `voucher` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
