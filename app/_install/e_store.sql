-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2020 at 01:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `cat_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_active`) VALUES
(1, 'Electronics', 1),
(2, 'Clothes', 1),
(3, 'Food', 1),
(4, 'Canned goods', 1),
(5, 'delete me!', 0);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `currency_id` int(11) NOT NULL,
  `currency_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `currency_code` varchar(4) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `currency_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`currency_id`, `currency_name`, `currency_code`, `currency_active`) VALUES
(1, 'Pesos Mexicanos', 'MXN', 1),
(2, 'Dolares Americanos', 'USD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `email_id` int(11) NOT NULL,
  `email_from` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email_name` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email_message` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `losses`
--

CREATE TABLE `losses` (
  `loss_id` int(11) NOT NULL,
  `loss_product_id` int(11) NOT NULL,
  `loss_qty` float NOT NULL,
  `loss_user_id` int(11) NOT NULL,
  `loss_date` datetime NOT NULL,
  `loss_note` text COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `losses`
--

INSERT INTO `losses` (`loss_id`, `loss_product_id`, `loss_qty`, `loss_user_id`, `loss_date`, `loss_note`) VALUES
(1, 2, 1, 21, '2020-11-02 18:06:23', '1'),
(2, 2, 1, 21, '2020-11-02 18:06:31', '1'),
(3, 2, 5, 21, '2020-11-02 18:06:48', '5'),
(4, 3, 5, 21, '2020-11-02 18:25:14', 'broken on arrival from online store'),
(5, 2, 1, 21, '2020-11-02 18:25:58', 'broken ');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number_products` float NOT NULL,
  `order_client` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `order_client_email` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `order_client_phone` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `order_client_address` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `order_client_notes` text COLLATE utf8mb4_spanish2_ci NOT NULL,
  `order_date` datetime NOT NULL,
  `order_status` int(1) NOT NULL DEFAULT 0 COMMENT '0 order\r\n1 confirmed\r\n2 processing\r\n3 sent',
  `order_sent_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_product_id` int(11) NOT NULL,
  `order_product_number` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `product_description` text COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `product_price` float NOT NULL,
  `product_currency_code_id` int(11) NOT NULL,
  `product_image` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL DEFAULT 'uploads/products/noimage.png',
  `product_category` int(11) NOT NULL,
  `product_qty` float NOT NULL,
  `product_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_price`, `product_currency_code_id`, `product_image`, `product_category`, `product_qty`, `product_active`) VALUES
(1, '', '', 0, 0, '', 0, 0, 0),
(2, 'image test new', 'description', 1, 1, 'uploads/products/447029982people.png', 3, 989, 1),
(3, 'no image product', 'description', 10, 1, 'uploads/products/528239164new.png', 1, 50, 1),
(4, 'image test edit', 'description', 1, 1, 'uploads/products/noimage.png', 3, 1000, 0),
(5, 'image test 2', 'description', 1, 1, 'uploads/products/noimage.png', 3, 1000, 1),
(6, 'image test 33', 'description', 1, 1, 'uploads/products/noimage.png', 3, 1000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `purchase_product_id` int(11) NOT NULL,
  `purchase_qty` float NOT NULL,
  `purchase_date` datetime NOT NULL,
  `purchase_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL COMMENT 'auto incrementing user_id of each user, unique index',
  `user_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s name, unique',
  `user_password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
  `user_email` varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
  `user_first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_employee_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_date` datetime DEFAULT NULL,
  `user_last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_phone` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_areacode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_level` int(1) NOT NULL DEFAULT 0,
  `user_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uploads/user_img/noimage.png',
  `user_locked` int(1) NOT NULL DEFAULT 0,
  `user_suspend` int(1) NOT NULL DEFAULT 0,
  `user_active` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_password_hash`, `user_email`, `user_first_name`, `user_last_name`, `user_employee_number`, `user_date`, `user_last_update`, `user_phone`, `user_areacode`, `user_level`, `user_image`, `user_locked`, `user_suspend`, `user_active`) VALUES
(21, 'jgomez', '$2y$10$RGMkMwWiYmbJZjU/vzpOaOC4JAFxKiCV/rCpmE40wwBo.31MGhCTK', 'jgomez@martechmedical.com', 'Jose Luis', 'Gomez Cecena', '43044', '2018-08-09 00:00:00', '2020-10-30 22:36:13', '(686)259-4318', '+52', 0, 'uploads/user_img/noimage.jpg', 0, 0, 1),
(127, 'roxgomez', '$2y$10$qgf22DBmrov86YrRobr/Oeg1C2V/3dXgHQuZXD2TogeX/HGaCdhqO', 'rox@mail.net', 'Roxana Patricia', 'Gomez Cecena', '43045', '0000-00-00 00:00:00', '2020-10-30 22:36:16', '555897521', '+1', 0, 'uploads/user_img/noimage.jpg', 0, 1, 1),
(129, 'jmorimoto', '$2y$10$D5JHU5GkhlCki.eeBtcQP.0iTUAcFwxLnDKx6TEl/Q2A0SKfSvY.u', 'jmorimoto@martechmedical.com', 'Jose Francisco', 'Morimoto', '44312', '2020-10-24 01:39:00', '2020-10-30 22:36:18', '6862594318', '+52', 0, 'uploads/user_img/noimage.jpg', 0, 0, 1),
(131, 'jmorimoto2', '$2y$10$D5JHU5GkhlCki.eeBtcQP.0iTUAcFwxLnDKx6TEl/Q2A0SKfSvY.u', 'jmorimoto@martechmedical.com1', 'Jose Francisco', 'Morimoto', '44312', '2020-10-24 01:39:00', '2020-10-30 22:37:53', '6862594318', '+52', 0, 'uploads/user_img/noimage.jpg', 0, 0, 0),
(132, 'test1', '$2y$10$MduH/5V9o/AfL1oRKutLtukqkyJaZppv2Jbo3axytlgBYm.ytIUf2', 'test@mail.com', 'name', 'last', '45', '2020-10-31 00:07:22', '2020-10-30 23:14:11', '555659812', '+1', 0, 'uploads/user_img/noimage.png', 0, 0, 0),
(133, 'new', '$2y$10$LJ1IKwVlPUItBtSBcQblbeM.nuEIgw3U80QVzMuocY75s3kaV/xSi', 'new@mail.com', 'new', 'new2', '65156', '2020-10-30 16:12:14', '2020-10-30 23:14:19', '686985265', '+52', 0, 'uploads/user_img/noimage.png', 0, 0, 0),
(134, 'new2', '$2y$10$RQvdnF6XsC1gx8Vo7VrHUe5fmooXIi6oWGNfdeg6wHLxKEI.2pNBu', 'new2@mail.com', 'nnn', 'nnn', '7864556', '2020-10-30 16:13:50', '2020-10-30 23:13:50', '686212561', '+52', 0, 'uploads/user_img/noimage.png', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`email_id`);

--
-- Indexes for table `losses`
--
ALTER TABLE `losses`
  ADD PRIMARY KEY (`loss_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD PRIMARY KEY (`order_product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `email_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `losses`
--
ALTER TABLE `losses`
  MODIFY `loss_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_products`
--
ALTER TABLE `order_products`
  MODIFY `order_product_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'auto incrementing user_id of each user, unique index', AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
