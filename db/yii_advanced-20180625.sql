-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2018 at 11:10 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

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
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(256) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uploads/dummy.jpg',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `firstname`, `lastname`, `picture`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `role`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', '', 'uploads/dummy.jpg', 'Ew5lQlqhxvkciNPYSzZ1vIhu6Ds4j7em', '$2y$13$T4gi.7mzrelVxxRh7dXqL.lW0jf8Yz.bCgUkzvjUw4BG0Cjs2rxLC', NULL, 'iputkinasih@gmail.com', 0, 10, 1528341206, 1528341206);

-- --------------------------------------------------------

--
-- Table structure for table `backend_feature`
--

CREATE TABLE `backend_feature` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_feature`
--

INSERT INTO `backend_feature` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Category', 'category', 1, '2018-06-22 01:39:19', '2018-06-22 01:39:19'),
(2, 'Sub Category', 'subcategory', 1, '2018-06-22 01:41:44', '2018-06-22 01:41:44'),
(3, 'Product', 'product', 1, '2018-06-22 01:41:51', '2018-06-22 01:41:51'),
(4, 'Voucher', 'voucher', 1, '2018-06-22 01:41:57', '2018-06-22 01:41:57'),
(5, 'User', 'user', 1, '2018-06-22 01:42:03', '2018-06-22 01:42:03'),
(6, 'Feature', 'feature', 1, '2018-06-22 01:42:09', '2018-06-22 01:42:09'),
(7, 'Role', 'role', 1, '2018-06-22 01:42:15', '2018-06-22 01:42:15');

-- --------------------------------------------------------

--
-- Table structure for table `backend_permission`
--

CREATE TABLE `backend_permission` (
  `id` int(11) NOT NULL,
  `roles` int(11) NOT NULL,
  `feature` int(11) NOT NULL,
  `access` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_permission`
--

INSERT INTO `backend_permission` (`id`, `roles`, `feature`, `access`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 1, 4, 2),
(5, 1, 5, 2),
(6, 1, 6, 2),
(7, 1, 7, 2),
(8, 2, 1, 2),
(9, 2, 2, 2),
(10, 2, 3, 2),
(11, 2, 4, 2),
(12, 2, 5, 0),
(13, 2, 6, 0),
(14, 2, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `backend_user`
--

CREATE TABLE `backend_user` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `password` varchar(254) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `roles` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_user`
--

INSERT INTO `backend_user` (`id`, `email`, `name`, `password`, `status`, `roles`, `created_at`) VALUES
(1, 'iputkinasih@gmail.com', 'iput', 'e10adc3949ba59abbe56e057f20f883e', 1, 1, '2018-06-21 15:25:48'),
(2, 'a@gmail.com', 'test', '96e79218965eb72c92a549dd5a330112', 1, 2, '2018-06-21 16:40:57');

-- --------------------------------------------------------

--
-- Table structure for table `backend_user_roles`
--

CREATE TABLE `backend_user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backend_user_roles`
--

INSERT INTO `backend_user_roles` (`id`, `name`, `description`, `status`) VALUES
(1, 'Super Admin', 'Full permission (create, update, delete, view)', 1),
(2, 'Content Provider', 'User can only create, update, view, and delete their own product', 1);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total` decimal(10,2) NOT NULL,
  `total_usd` decimal(10,2) NOT NULL,
  `voucher_id` varchar(256) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `grand_total_usd` decimal(10,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = ''waiting verification'', 1 = ''confirmed''',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `date`, `total`, `total_usd`, `voucher_id`, `discount`, `grand_total`, `grand_total_usd`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PAY1806250001', '2018-06-24 16:00:00', '200000.00', '14.15', '', '0.00', '200000.00', '14.15', 1, '2018-06-24 23:37:20', '2018-06-24 23:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `payment_detail`
--

CREATE TABLE `payment_detail` (
  `id` int(11) NOT NULL,
  `payment_id` varchar(200) NOT NULL,
  `product_id` int(11) NOT NULL,
  `data` text NOT NULL,
  `sell_price` double(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment_detail`
--

INSERT INTO `payment_detail` (`id`, `payment_id`, `product_id`, `data`, `sell_price`, `created_at`, `updated_at`) VALUES
(1, 'PAY1806250001', 3, '{\"code\":\"BKA0003\",\"name\":\"Breaking Dawn\",\"slug\":\"breaking-dawn\",\"image\":\"uploads\\/breaking-dawn-1529483738.jpg\",\"qty\":1}', 150000.00, '2018-06-24 23:37:20', '2018-06-24 23:37:20'),
(2, 'PAY1806250001', 4, '{\"code\":\"MCA0001\",\"name\":\"Almost Is Never Enough\",\"slug\":\"almost-is-never-enough\",\"image\":\"uploads\\/almost-is-never-enough-1529479991.jpg\",\"qty\":1}', 50000.00, '2018-06-24 23:37:20', '2018-06-24 23:37:20');

-- --------------------------------------------------------

--
-- Table structure for table `paypal_detail`
--

CREATE TABLE `paypal_detail` (
  `id` int(11) NOT NULL,
  `ltransaction_id` varchar(200) DEFAULT NULL,
  `lpayment_type` varchar(100) DEFAULT NULL,
  `lcurrency` varchar(10) DEFAULT NULL,
  `lpayer_email` varchar(100) DEFAULT NULL,
  `lpayer_id` varchar(100) DEFAULT NULL,
  `paypal_payment_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `payment_id` varchar(200) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `lamount` double DEFAULT NULL,
  `created_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paypal_detail`
--

INSERT INTO `paypal_detail` (`id`, `ltransaction_id`, `lpayment_type`, `lcurrency`, `lpayer_email`, `lpayer_id`, `paypal_payment_id`, `payment_id`, `lamount`, `created_at`) VALUES
(1, '8K464513RL9695601', NULL, NULL, 'iputkinasih-buyer@gmail.com', 'TC23GW7B3XHUG', 'PAY-1K349593LD4467909LMYH7FI', 'PAY1806250001', 14.15, 1529905103);

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
  `picture` varchar(256) NOT NULL DEFAULT 'uploads/dummy.jpg',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `slug`, `description`, `author`, `category_id`, `price`, `picture`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BKA0001', 'The Murder of Roger Ackroyd', 'the-murder-of-roger-ackroyd', 'The Murder of Roger Ackroyd is a work of detective fiction by Agatha Christie, first published in June 1926 in the United Kingdom by William Collins, Sons and in the United States by Dodd, Mead and Company on 19 June 1926.', 'Agatha Christie', 1, '60000', 'uploads/the-murder-of-roger-ackroyd-1529482301.jpg', 1, '2018-06-07 06:58:59', '2018-06-20 08:11:41'),
(2, 'BKA0002', 'The Murder on the Orient Express', 'the-murder-on-the-orient-express', 'Murder on the Orient Express is a detective novel by Agatha Christie featuring the Belgian detective Hercule Poirot. It was first published in the United Kingdom by the Collins Crime Club on 1 January 1934.', 'Agatha Christie', 1, '100000', 'uploads/the-murder-on-the-orient-express-1529483613.jpg', 1, '2018-06-07 07:21:10', '2018-06-20 08:33:33'),
(3, 'BKA0003', 'Breaking Dawn', 'breaking-dawn', 'Breaking Dawn is the fourth and second to final novel in The Twilight Saga by American author Stephenie Meyer.', 'Stephenie Meyer', 1, '150000', 'uploads/breaking-dawn-1529483738.jpg', 1, '2018-06-11 07:27:35', '2018-06-20 08:35:38'),
(4, 'MCA0001', 'Almost Is Never Enough', 'almost-is-never-enough', '\"Almost Is Never Enough\" is a song recorded by American singer Ariana Grande and English singer Nathan Sykes. The pop and soul-influenced track was written by Grande, Harmony Samuels, Carmen Reece, Al Sherrod Lambert, Olaniyi-Akinpelu, and its producer, Moses Samuels. Two official versions of the song exist. The soundtrack version is included on the official soundtrack for the 2013 fantasy film The Mortal Instruments: City of Bones and was released August 19, 2013 via Republic Records as a second promotional single from the same, following Colbie Caillat\'s \"When the Darkness Comes\" on July 10, and a longer version was remastered for inclusion on Grande\'s debut studio album, Yours Truly (2013).', 'Ariana Grande', 10, '50000', 'uploads/almost-is-never-enough-1529479991.jpg', 1, '2018-06-12 03:32:27', '2018-06-20 07:33:11'),
(5, 'MVA0001', 'Incredibles 2', 'incredibles-2', 'Everyone’s favorite family of superheroes is back in “Incredibles 2” – but this time Helen (voice of Holly Hunter) is in the spotlight, leaving Bob (voice of Craig T. Nelson) at home with Violet (voice of Sarah Vowell) and Dash (voice of Huck Milner) to navigate the day-to-day heroics of “normal” life. It’s a tough transistion for everyone, made tougher by the fact that the family is still unaware of baby Jack-Jack’s emerging superpowers. When a new villain hatches a brilliant and dangerous plot, the family and Frozone (voice of Samuel L. Jackson) must find a way to work together again—which is easier said than done, even when they’re all Incredible.', 'Walt Disney Studios', 13, '250000', 'uploads/incredibles-2-1529483793.jpg', 1, '2018-06-18 02:14:10', '2018-06-20 08:36:33'),
(6, 'APA0001', 'Candy Crush Saga', 'candy-crush-saga', 'Candy Crush Saga is a free-to-play match-three puzzle video game released by King on April 12, 2012, for Facebook; other versions for iOS, Android, Windows Phone, and Windows 10 followed. It is a variation of their browser game Candy Crush.', 'King', 14, '50000', 'uploads/candy-crush-saga-1529483837.jpg', 1, '2018-06-18 02:16:19', '2018-06-20 08:37:17');

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
(2, 'pop', 'pop', 1, 2, '2018-06-07 05:20:31', '2018-06-07 05:20:31'),
(3, 'teenlit', 'teenlit', 1, 1, '2018-06-20 07:29:08', '2018-06-20 07:29:08'),
(4, 'comic', 'comic', 1, 1, '2018-06-20 07:29:41', '2018-06-20 07:29:41'),
(5, 'biography', 'biography', 1, 1, '2018-06-20 07:29:55', '2018-06-20 07:29:55'),
(6, 'rock', 'rock', 1, 2, '2018-06-20 07:30:02', '2018-06-20 07:30:02'),
(7, 'jazz', 'jazz', 1, 2, '2018-06-20 07:30:18', '2018-06-20 07:30:18'),
(8, 'blues', 'blues', 1, 2, '2018-06-20 07:30:25', '2018-06-20 07:30:25'),
(9, 'reggae', 'reggae', 1, 2, '2018-06-20 07:30:37', '2018-06-20 07:30:37'),
(10, 'R&B', 'rb', 1, 2, '2018-06-20 07:30:45', '2018-06-20 07:30:45'),
(11, 'fairy tale', 'fairy-tale', 1, 1, '2018-06-20 07:31:24', '2018-06-20 07:31:24'),
(12, 'action', 'action', 1, 3, '2018-06-20 08:36:10', '2018-06-20 08:36:10'),
(13, 'animation', 'animation', 1, 3, '2018-06-20 08:36:18', '2018-06-20 08:36:18'),
(14, 'game', 'game', 1, 4, '2018-06-20 08:37:07', '2018-06-20 08:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `user` (`id`, `username`, `firstname`, `lastname`, `phone`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(5, 'iput', '', '', '', 'gxmuzM7zU__0a_LjUPyWZS0ED8famQQO', '$2y$13$CbWRGBCFbe/0R6Ce8eLg...QmTZXmh1Kd3c8uTdOtk1NQ0ewrjS0i', NULL, 'iputkinasih@gmail.com', 10, 1529899176, 1529904902);

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
  `code` varchar(256) NOT NULL,
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

INSERT INTO `voucher` (`id`, `name`, `slug`, `code`, `description`, `discount_prosentase`, `discount_price`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Book Discount', 'book-discount', 'BOOK123', 'Lorem ipsum dolor sit amet, ad ludus doming sed, quas mandamus argumentum te ius, ex dico libris incorrupte nec. Illud falli atomorum vis ut, te mei ipsum oporteat delicatissimi, in quem diceret partiendo has. Salutatus honestatis interpretaris an mea, dicunt latine minimum ut has. Mei alia quaeque volumus te, eu eros voluptatum eum.', 0, 10000, '2018-06-18 00:34:24', '2018-06-18 00:34:24', 1, '2018-06-13 05:27:18', '2018-06-13 05:27:18');

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
-- Indexes for table `backend_feature`
--
ALTER TABLE `backend_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_permission`
--
ALTER TABLE `backend_permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_permission_feature` (`feature`) USING BTREE,
  ADD KEY `fk_permission_roles` (`roles`) USING BTREE;

--
-- Indexes for table `backend_user`
--
ALTER TABLE `backend_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_user_roles`
--
ALTER TABLE `backend_user_roles`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_detail`
--
ALTER TABLE `payment_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paypal_detail`
--
ALTER TABLE `paypal_detail`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `backend_feature`
--
ALTER TABLE `backend_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `backend_permission`
--
ALTER TABLE `backend_permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `backend_user`
--
ALTER TABLE `backend_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `backend_user_roles`
--
ALTER TABLE `backend_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forget_password`
--
ALTER TABLE `forget_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_detail`
--
ALTER TABLE `payment_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `paypal_detail`
--
ALTER TABLE `paypal_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usernew`
--
ALTER TABLE `usernew`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `fk_category_subcategory` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
