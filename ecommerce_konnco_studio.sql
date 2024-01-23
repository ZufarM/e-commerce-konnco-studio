-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3308
-- Generation Time: Jan 23, 2024 at 08:39 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_konnco_studio`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (uuid()),
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_01_22_045713_create_products_table', 1),
(6, '2024_01_22_055057_create_cart_items_table', 1),
(7, '2024_01_22_055454_create_orders_table', 1),
(8, '2024_01_22_055505_create_order_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (uuid()),
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `va_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_total` int NOT NULL,
  `delivery_fee` int NOT NULL,
  `total` int NOT NULL,
  `order_status` enum('waiting_payment','processing','in_delivery','delivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` enum('waiting_payment','paid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_id`, `user_id`, `delivery_address`, `bank`, `va_number`, `sub_total`, `delivery_fee`, `total`, `order_status`, `payment_status`, `created_at`, `updated_at`) VALUES
('10fa8adf-b9c2-11ee-8fc6-9828a63b44e5', '9aeb522d-f709-4ac1-aee1-6ff7f87b4a3a', 'f494ea5f-b9c1-11ee-8fc6-9828a63b44e5', 'Betokan Tirtoadi Mlati Sleman YK', 'bni', '9886865096107224', 55000000, 10000, 55010000, 'processing', 'paid', '2024-01-23 00:36:05', '2024-01-23 00:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (uuid()),
  `product_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `product_name`, `product_price`, `qty`, `user_id`, `order_id`, `created_at`, `updated_at`) VALUES
('11109bc8-b9c2-11ee-8fc6-9828a63b44e5', 'e0317d36-b9c1-11ee-8fc6-9828a63b44e5', 'Jazzmaster', '25000000', '1', 'f494ea5f-b9c1-11ee-8fc6-9828a63b44e5', '9aeb522d-f709-4ac1-aee1-6ff7f87b4a3a', '2024-01-23 00:36:05', '2024-01-23 00:36:05'),
('111433fa-b9c2-11ee-8fc6-9828a63b44e5', 'e02db75f-b9c1-11ee-8fc6-9828a63b44e5', 'Fender Telecaster', '15000000', '2', 'f494ea5f-b9c1-11ee-8fc6-9828a63b44e5', '9aeb522d-f709-4ac1-aee1-6ff7f87b4a3a', '2024-01-23 00:36:05', '2024-01-23 00:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (uuid()),
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `stock`, `price`, `created_at`, `updated_at`) VALUES
('e02a1bd5-b9c1-11ee-8fc6-9828a63b44e5', 'Fender Stratocaster', 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of todays working player.', 100, 20000000, '2024-01-23 00:34:43', '2024-01-23 00:34:43'),
('e02db75f-b9c1-11ee-8fc6-9828a63b44e5', 'Fender Telecaster', 'Fusing classic Fender® design with player-centric features and exciting new finishes,\n            the Player Plus Telecaster® delivers superb playability and unmistakable style.\n            Powered by a set of Player Plus Noiseless™ pickups, the Player Plus Tele® delivers warm,\n            sweet Tele® twang without hum. A push-pull switch on the tone control engages both\n            pickups in series operation, delivering increased output and body.', 100, 15000000, '2024-01-23 00:34:43', '2024-01-23 00:34:43'),
('e0317d36-b9c1-11ee-8fc6-9828a63b44e5', 'Jazzmaster', 'The American Professional II Stratocaster® draws from more than sixty years of innovation, inspiration and evolution to meet the demands of todays working player.', 100, 25000000, '2024-01-23 00:34:43', '2024-01-23 00:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT (uuid()),
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` enum('customer','admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `delivery_address`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
('e017d989-b9c1-11ee-8fc6-9828a63b44e5', 'Zufar', 'muhamad.zufar2@gmail.com', NULL, '$2y$10$z4iSmelNh7XiH/Z/rNfBKu3q1/LZxXwHdcYDPSsWmIr9pzLBjfHuO', 'Betokan Tirtoadi Mlati Sleman Yogyakarta', 'customer', 'YYyMPewAe2CihVwatj3ZGTW7EOk3WfYT', '2024-01-23 00:34:43', '2024-01-23 00:34:43'),
('e02649de-b9c1-11ee-8fc6-9828a63b44e5', 'Admin', 'admin@gmail.com', NULL, '$2y$10$iZ4nYMXe8XeTsydDL7VBMesPgqS3ji4r7UvD5hdyOWLqGBcHpY6HW', 'Betokan Tirtoadi Mlati Sleman Yogyakarta', 'admin', 'MmUNoBPIo6Ugr4sAn8WCqvl2WIrvH563', '2024-01-23 00:34:43', '2024-01-23 00:34:43'),
('f494ea5f-b9c1-11ee-8fc6-9828a63b44e5', 'M Zufar Taqiuddin', 'mrrafuzz.co@gmail.com', NULL, '$2y$10$/t3291xxQL87RipAnAlZneTcpmIqjRJ/yaTGn5DufjF8oPBsebJT2', 'Betokan Tirtoadi Mlati Sleman YK', 'customer', NULL, '2024-01-23 00:35:17', '2024-01-23 00:35:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
