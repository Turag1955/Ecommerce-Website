-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2020 at 07:58 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `usersname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `usersname`, `email`, `password`, `mobile`, `role`, `status`) VALUES
(1, 'admin', 'radifkhondokar@gmail.com', 'admin', '01822010286', 0, 1),
(2, 'radif', 'radifkhondokar@gmail.com', 'radif', '54545454', 1, 1),
(3, 'ripa', 'ripa@gmail.com', 'ripa', '54446775444', 1, 1),
(4, 'anika', 'anika@gmail.com', 'anika', '544454454', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`, `status`) VALUES
(3, 'Diagital', 1),
(4, 'Men Fashion', 1),
(7, 'Electronic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `comment` text NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `mobile`, `comment`, `insertdate`) VALUES
(15, 'sdfdsfa', 'sfdf@fgfd', 'fgfd', 'fdgdf', '2011-07-19 22:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_master`
--

CREATE TABLE `coupon_master` (
  `id` int(11) NOT NULL,
  `coupon_name` varchar(50) NOT NULL,
  `coupon_amount` int(11) NOT NULL,
  `coupon_type` varchar(20) NOT NULL,
  `cart_min_total_amount` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `coupon_master`
--

INSERT INTO `coupon_master` (`id`, `coupon_name`, `coupon_amount`, `coupon_type`, `cart_min_total_amount`, `status`) VALUES
(1, 'turag30', 20, 'parcent', 1000, 1),
(2, 'shohag360', 300, 'amount', 2000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(20) NOT NULL,
  `price` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `order_id`, `product_id`, `qty`, `price`) VALUES
(1, 1, 8, '4', '499'),
(2, 1, 12, '2', '5000'),
(3, 2, 8, '1', '499'),
(4, 2, 12, '2', '5000'),
(5, 3, 8, '2', '499'),
(6, 3, 12, '2', '5000'),
(7, 4, 12, '5', '5000'),
(8, 5, 7, '10', '500'),
(9, 6, 7, '3', '500'),
(10, 6, 13, '1', '6799'),
(11, 7, 7, '5', '500'),
(12, 8, 10, '1', '35000'),
(13, 9, 9, '13', '255'),
(14, 10, 10, '1', '35000'),
(15, 11, 10, '1', '35000'),
(16, 12, 7, '1', '500'),
(17, 12, 8, '1', '499'),
(18, 12, 9, '1', '255'),
(19, 13, 8, '1', '499'),
(20, 13, 9, '1', '255'),
(21, 13, 7, '1', '500'),
(22, 14, 7, '1', '500'),
(23, 14, 8, '1', '499'),
(24, 15, 8, '1', '499'),
(25, 15, 7, '1', '500'),
(26, 16, 7, '1', '500'),
(27, 16, 8, '1', '499'),
(28, 17, 9, '1', '255'),
(29, 18, 10, '1', '35000'),
(30, 19, 9, '1', '255'),
(31, 20, 8, '1', '499'),
(32, 21, 7, '1', '500'),
(33, 23, 10, '1', '35000'),
(34, 24, 16, '1', '5454'),
(35, 25, 18, '2', '354'),
(36, 25, 17, '3', '677'),
(37, 26, 19, '1', '35444'),
(38, 26, 20, '1', '3544'),
(39, 27, 19, '1', '35444'),
(40, 27, 17, '1', '677'),
(41, 28, 18, '1', '354'),
(42, 28, 20, '1', '3544'),
(43, 29, 19, '1', '35444'),
(44, 29, 20, '1', '3544'),
(45, 30, 17, '2', '677'),
(46, 30, 18, '2', '354'),
(47, 31, 9, '5', '255'),
(48, 32, 8, '1', '499'),
(49, 32, 11, '1', '3000'),
(50, 32, 17, '1', '677'),
(51, 32, 12, '1', '5000'),
(52, 32, 20, '1', '3544');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `pyment_type` varchar(20) NOT NULL,
  `total_price` float NOT NULL,
  `pyment_status` varchar(20) NOT NULL,
  `orderstatus` int(11) NOT NULL,
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(100) NOT NULL,
  `discount_less` varchar(50) NOT NULL,
  `discount_price` varchar(50) NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `users_id`, `address`, `city`, `pincode`, `pyment_type`, `total_price`, `pyment_status`, `orderstatus`, `coupon_id`, `coupon_name`, `discount_less`, `discount_price`, `insertdate`) VALUES
(1, 1, 'fenin', 'feni', 39999, 'COD', 11996, 'success', 5, 0, '', '', '', '2020-07-23 11:57:08'),
(2, 1, 'chhagalinaiya', 'chhagalinaiya', 545, 'COD', 10499, 'success', 2, 0, '', '', '', '2020-07-23 12:03:57'),
(3, 5, 'sadar road', 'sadar road', 675, 'COD', 10998, 'success', 2, 0, '', '', '', '2020-07-23 12:09:12'),
(4, 5, 'acadamy road', 'acadamy road', 3677, 'COD', 25000, 'success', 2, 0, '', '', '', '2020-07-23 14:06:57'),
(5, 5, 'feni', 'feni', 545444, 'COD', 2000, 'success', 2, 0, '', '', '', '2020-07-23 14:20:04'),
(6, 1, 'Amin monjil', 'Feni', 3900, 'COD', 7999, 'success', 2, 2, 'shohag360', '300', '7999', '2020-07-27 09:43:55'),
(7, 1, 'feni', 'feni', 54544, 'COD', 0, 'success', 2, 0, '', '', '', '2020-07-27 10:01:58'),
(8, 1, 'dhaka', 'dhaka', 5467754, 'COD', 34700, 'success', 2, 2, 'shohag360', '300', '34700', '2020-07-27 10:09:52'),
(9, 1, 'dhaka', 'dhaka', 545677, 'COD', 2320.5, 'success', 2, 1, 'turag30', '994.5', '2320.5', '2020-07-27 10:12:46'),
(10, 1, 'gajipur', 'gajipur', 5677, 'COD', -34700, 'success', 2, 2, 'shohag360', '300', '34700', '2020-07-27 10:37:26'),
(11, 1, 'ramgar', 'ramgar', 5455, 'COD', 35000, 'success', 2, 0, '', '', '', '2020-07-27 10:38:28'),
(12, 1, 'mohammadpur', 'mohammadpur', 455, 'COD', -1003.2, 'success', 2, 1, 'turag30', '250.8', '1003.2', '2020-07-27 11:21:16'),
(13, 1, 'bocila', 'bocila', 444, 'COD', 1254, 'success', 2, 0, '', '', '', '2020-07-27 11:23:20'),
(14, 1, 'jafrabad', 'dhaka', 1200, 'COD', 999, 'success', 1, 0, '', '', '', '2020-07-27 19:33:21'),
(15, 1, 'feni', 'feni', 544677, 'COD', 999, 'success', 1, 0, '', '', '', '2020-07-27 19:59:39'),
(16, 1, 'feni', 'feni', 0, 'COD', 999, 'success', 1, 0, '', '', '', '2020-07-27 20:02:52'),
(17, 1, 'feni', 'feni', 5444, 'COD', 255, 'success', 1, 0, '', '', '', '2020-07-27 20:05:29'),
(18, 1, 'feni', 'feni', 0, 'COD', 35000, 'success', 1, 0, '', '', '', '2020-07-27 20:07:03'),
(19, 1, 'feni', 'feni', 0, 'COD', 255, 'success', 1, 0, '', '', '', '2020-07-27 20:08:50'),
(20, 1, 'feni', 'feni', 544677, 'COD', 499, 'success', 1, 0, '', '', '', '2020-07-28 04:28:08'),
(21, 1, 'delhi', 'delhi', 54454, 'COD', 500, 'success', 1, 0, '', '', '', '2020-07-28 04:30:28'),
(22, 1, 'delhi', 'delhi', 54454, 'COD', 0, 'success', 1, 0, '', '', '', '2020-07-28 04:32:58'),
(23, 1, 'feni', 'feni', 67454, 'COD', -28000, 'success', 1, 1, 'turag30', '7000', '28000', '2020-07-28 04:41:20'),
(24, 1, 'delhi', 'delhi', 5454454, 'COD', 5454, 'success', 1, 0, '', '', '', '2020-07-28 15:41:56'),
(29, 1, 'feni', 'feni', 35444, 'COD', 38988, 'success', 1, 0, '', '', '', '2020-07-28 17:16:51'),
(30, 1, 'feni', 'feni', 5454, 'COD', 2062, 'success', 1, 0, '', '', '', '2020-07-28 17:35:25'),
(31, 1, 'acadamy road chhagalniya,feni', 'chhagalniya', 3910, 'COD', 1275, 'success', 5, 0, '', '', '', '2020-08-02 04:44:05'),
(32, 1, 'acadamy road chhagalniya', 'chhagalniya', 3910, 'COD', -10176, 'success', 1, 1, 'turag30', '2544', '10176', '2020-08-02 04:50:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'pending'),
(2, 'processing'),
(3, 'shipped'),
(4, 'canceled'),
(5, 'complete');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `added_id` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL,
  `best_seller` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mrp` float NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `short_dec` varchar(2000) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `meta_title` varchar(2000) NOT NULL,
  `meta_description` varchar(2000) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `category_id`, `added_id`, `sub_category`, `best_seller`, `name`, `mrp`, `price`, `qty`, `image`, `short_dec`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `insertdate`) VALUES
(7, 3, 0, 0, 1, 'Head Phone', 100, 500, 200, 'Head Phone-09-07-20.jpg', 'Is good for listening', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at mi congue, sollicitudin diam id, semper nisi. Vivamus porta purus turpis, a sagittis diam finibus at. Mauris sed elit blandit, commodo dolor ac, mattis mi. Ut semper, magna id blandit placerat, tortor justo porttitor eros, non varius felis risus quis nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eg', 'Head Phone', 'habitant morbi tristique senectus et netus et malesuada fa', 'habitant morbi tristique senectus et netus et malesuada fa', 1, '2020-07-09 10:10:36'),
(8, 4, 0, 0, 1, 'T-shirt', 266, 499, 50, 'T-shirt-09-07-20.jpg', 'Trending T-shirt', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque at mi congue, sollicitudin diam id, semper nisi. Vivamus porta purus turpis, a sagittis diam finibus at. Mauris sed elit blandit, commodo dolor ac, mattis mi. Ut semper, magna id blandit placerat, tortor justo porttitor eros, non varius felis risus quis nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eg', 'T-shirt', 'd blandit placerat, tortor justo porttitor', 'd blandit placerat, tortor justo porttitor', 1, '2020-07-09 10:12:24'),
(9, 7, 0, 0, 1, 'Router', 200, 255, 25, 'Router-09-07-20.jpg', 'The router in Three Tower', 'tant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed sed egestas tortor, fermentum pharetra orci. Etiam sed nulla vel ligula tristique fermentum. Suspendisse viverra quis enim at congue. Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'Router in three tower', 'Router in three tower', 'Router in three tower', 1, '2020-07-09 10:15:54'),
(10, 3, 0, 0, 1, 'Apple Leptop', 167, 35000, 105, 'Apple Leptop-09-07-20.jpg', 'Now Trending Leptop', 's diam finibus at. Mauris sed elit blandit, commodo dolor ac, mattis mi. Ut semper, magna id blandit placerat, tortor justo porttitor eros, non varius felis risus quis nisl. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec eget me', 'Apple Leptop', 'Apple Leptop', 'Apple Leptop', 1, '2020-07-09 10:31:45'),
(11, 4, 0, 0, 0, 'Showes', 275, 3000, 20, 'Showes-09-07-20.jpg', 'The Real comfortable Showes', 'at volutpat. Sed ac consectetur arcu. Donec commodo a ipsum ac ullamcorper. Phasellus sit amet accumsan mi. Curabitur at tristique ex. Quis', 'Show', 'at volutpat. Sed ac consectetur arcu. Donec commodo a ipsum ac ullamcorper. Phasellus sit amet accumsan mi. Curabitur at tristique ex. Quis', 'at volutpat. Sed ac consectetur arcu. Donec commodo a ipsum ac ullamcorper. Phasellus sit amet accumsan mi. Curabitur at tristique ex. Quis', 1, '2020-07-09 10:33:52'),
(12, 4, 0, 0, 1, 'Full dress', 122, 5000, 28, 'Full dress-19-07-20.jpg', 'In All dress in populer now', '', '', '', '', 1, '2020-07-19 05:45:07'),
(13, 3, 0, 4, 1, 'camera', 35, 6799, 5, 'camera-25-07-20.jpg', 'test', 'test', 'test', 'test', 'test', 1, '2020-07-25 08:33:59'),
(14, 7, 0, 7, 0, 'Apple leptop', 545, 554545, 67677, 'leptop-25-07-20.jpg', 'dfg', '', '', '', '', 1, '2020-07-25 09:29:35'),
(15, 4, 0, 4, 0, 'Mask', 455, 545, 55, 'mobile-25-07-20.jpg', 'Staylish Mask', '', '', '', '', 1, '2020-07-25 09:30:47'),
(17, 4, 2, 3, 0, 'shows', 67, 677, 54, 'shows-28-07-20.jpeg', 'test', 'test', 'test', 'test', 'test', 1, '2020-07-28 16:30:41'),
(18, 7, 2, 5, 0, 'needed electroninc', 54, 354, 54, 'prodduc-28-07-20.jpg', 'test', 'test', '', '', '', 1, '2020-07-28 16:32:02'),
(19, 3, 2, 1, 0, 'chaire', 5445, 3544, 43, 'chaire-28-07-20.jpg', 'test', 'test', '', '', '', 1, '2020-07-28 16:47:37'),
(20, 4, 2, 3, 0, 't-shirt', 544, 3544, 45, 't-shirt-28-07-20.jpg', 'test', 'test', '', '', '', 1, '2020-07-28 16:48:33'),
(21, 3, 1, 1, 0, 'Apple Brand', 54, 89983, 4, 'Iphone brand-02-08-20.jpg', 'test', 'test', 'test', 'test', 'test', 1, '2020-08-02 05:19:15');

-- --------------------------------------------------------

--
-- Table structure for table `resigtration_users`
--

CREATE TABLE `resigtration_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `image_product_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `image_product_name`, `image`, `status`, `insertdate`) VALUES
(3, 'Apple Brand', 'Apple Brand-09-07-20.jpg', 1, '2020-07-08 17:06:17');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` varchar(100) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `sub_category`, `status`) VALUES
(1, 3, 'iphpne', 1),
(3, 4, 'shows', 1),
(4, 3, 'mobile', 1),
(5, 7, 'test1', 1),
(6, 7, 'test2', 1),
(7, 7, 'test3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `usersname` varchar(255) NOT NULL,
  `email` varchar(75) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `insertdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `usersname`, `email`, `mobile`, `password`, `insertdate`) VALUES
(1, 'Turag', 'radifkhondokar@gmail.com', '', 'admin', '2020-07-11 17:33:42'),
(5, 'anika', 'anika@gmail.com', '56546', 'anika', '2013-07-20 03:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `added_on`) VALUES
(1, 1, 8, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupon_master`
--
ALTER TABLE `coupon_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resigtration_users`
--
ALTER TABLE `resigtration_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `coupon_master`
--
ALTER TABLE `coupon_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
