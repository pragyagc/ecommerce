-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2025 at 08:17 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`, `image_path`) VALUES
(1, 'Crop top', 600, 'img/f1.jpg'),
(2, 'leather jacket', 850, 'img/f2.jpg\r\n'),
(3, 't-shirt', 500, 'img/f3.jpg\r\n'),
(4, 'tight jeans', 800, 'img/f4.jpg'),
(5, 'hot pant', 555, 'img/f5.jpg'),
(6, 'frock', 880, 'img/f6.jpg'),
(7, 'baggy pant', 1000, 'img/f7.jpg'),
(8, 'printed skirt', 1800, 'img/f8.jpg'),
(9, 'kurta', 900, 'img/f12.jpg'),
(10, 'one piece', 1000, 'img/f11.jpg'),
(11, 'green saree', 900, 'img/f15.jpg'),
(12, 'saree', 1200, 'img/f16.jpg'),
(13, 'frock', 200, 'img/f14.jpg'),
(51, 'yoyo', 400, 'uploads/IMG_1734.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `customer_name`, `customer_address`, `payment_method`, `order_date`) VALUES
(1, 1, 'sammy', 'lalitpur', 'cod', '2025-01-21 18:17:52'),
(2, 2, 'sammy', 'lalitpur', 'cod', '2025-01-21 18:38:44'),
(3, 1, 'sammy', 'lalitpur', 'cod', '2025-01-21 21:16:55'),
(4, 1, 'sammy', 'ktm', 'cod', '2025-01-22 05:12:17'),
(5, 1, 'sammy', 'ktm', 'cod', '2025-01-23 04:48:35'),
(6, 1, 'sharada', 'lalitpur', 'cod', '2025-01-23 04:57:15'),
(7, 1, 'sammy', 'ktm', 'cod', '2025-01-25 11:55:33'),
(8, 11, 'pragya', 'gundu', 'card', '2025-02-21 06:07:16'),
(9, 9, 'pragya', 'aalu', 'cod', '2025-02-26 02:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image_url` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `admin_approved` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `product_image_url`, `price`, `admin_approved`) VALUES
(12, 'saree', 'uploads/t7.png', 600.00, 1),
(13, 'saree', 'uploads/t6.png', 700.00, 1),
(14, 'saree', 'uploads/t6.png', 1000.00, 1),
(15, 'couple dress', 'uploads/t7.png', 4000.00, 1),
(18, 'yoyo', 'uploads/IMG_1734.jpg', 400.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `review` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`id`, `product_id`, `rating`, `review`, `created_at`) VALUES
(1, 1, 5, 'Great product!', '2025-02-25 08:49:15'),
(2, 1, 3, 'Great product!', '2025-02-25 08:50:54'),
(3, 1, 2, 'good', '2025-02-25 08:53:46'),
(4, 2, 2, 'good', '2025-02-25 08:56:03'),
(5, 2, 4, 'nice', '2025-02-25 08:56:17'),
(6, 3, 4, 'not bad', '2025-02-25 09:08:49'),
(7, 10, 4, 'good', '2025-02-25 12:33:50'),
(8, 1, 2, 'not good', '2025-02-25 16:36:13'),
(9, 2, 4, 'no', '2025-02-26 02:27:09'),
(10, 6, 3, 'nice', '2025-02-26 16:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`, `profile_image`) VALUES
(5, 'shardha', 'shardha@gmail.com', 'e4fefc41ad64072998a20d3a1114ed27', '9800000056', 'janakpur', 'janakpur', NULL),
(6, 'Sonee', 'sonee21@gmail.com', '8375b0fbad247b79832241c7c6c27c0f', '9845072417', 'ktm', 'gundu', NULL),
(13, 'sammy', 'sammy12@gmail.com', 'a1e74f7bc3e425fe823d9a30db513738', '980007656', 'kailai', 'tikapur', NULL),
(15, 'pragya', 'pragyagc5@gmail.com', 'a41ff3769f6b2a417a588dab979afe89', '9845072417', 'kathmandu', 'gundu', 'uploads/IMG_1672.jpg'),
(25, 'prabhat', 'prabhat@gmail.com', '96a8528881058213465ae9a195965c11', '9841327650', 'Tokyo', 'gundu', 'uploads/20211113_165613.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users_items`
--

CREATE TABLE `users_items` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_items`
--

INSERT INTO `users_items` (`id`, `user_id`, `item_id`, `status`, `name`, `city`, `address`, `contact`, `created_at`, `updated_at`, `quantity`) VALUES
(18, 5, 11, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 04:45:43', '2025-02-19 08:15:47', 2),
(20, 5, 4, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 04:52:57', '2024-04-19 04:52:57', 1),
(23, 5, 3, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:00:42', '2024-04-19 05:00:42', 1),
(24, 5, 10, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:04:07', '2024-04-19 05:04:07', 1),
(25, 5, 10, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:04:14', '2024-04-19 05:04:14', 1),
(26, 5, 10, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:04:18', '2024-04-19 05:04:18', 1),
(27, 5, 9, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:04:21', '2024-04-19 05:04:21', 1),
(28, 5, 8, 'Added to cart', 'shardha', 'janakpur', 'janakpur', '9800000056', '2024-04-19 05:04:27', '2024-04-19 05:04:27', 1),
(61, 13, 2, 'Added to cart', NULL, NULL, NULL, NULL, '2025-01-27 14:56:49', '2025-01-27 14:56:49', 1),
(62, 13, 1, 'Added to cart', NULL, NULL, NULL, NULL, '2025-01-28 05:26:00', '2025-01-28 05:26:00', 1),
(63, 13, 2, 'Added to cart', NULL, NULL, NULL, NULL, '2025-01-28 05:26:02', '2025-01-28 05:26:02', 1),
(76, 25, 3, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 06:42:56', '2025-02-26 06:42:56', 1),
(81, 15, 3, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 08:01:13', '2025-02-26 08:01:13', 1),
(82, 15, 6, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 08:01:21', '2025-02-26 08:01:21', 1),
(83, 15, 4, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 08:01:24', '2025-02-26 08:01:24', 1),
(84, 15, 10, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 08:01:29', '2025-02-26 08:01:29', 1),
(85, 15, 6, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-26 16:21:10', '2025-02-26 16:21:10', 1),
(86, 15, 1, 'Added to cart', NULL, NULL, NULL, NULL, '2025-02-27 02:12:49', '2025-02-27 02:12:49', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_items`
--
ALTER TABLE `users_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `user_item_index` (`user_id`,`item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_items`
--
ALTER TABLE `users_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_items`
--
ALTER TABLE `users_items`
  ADD CONSTRAINT `users_items_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_items_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
