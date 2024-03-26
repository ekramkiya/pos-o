-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 07:44 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posdb_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `address` varchar(191) DEFAULT NULL,
  `avatar` varchar(191) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `description`, `amount`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'barq', 110, 1, '2024-03-24 14:03:40', '2024-03-24 14:03:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_04_19_081616_create_products_table', 1),
(6, '2020_04_22_181602_add_quantity_to_products_table', 1),
(7, '2020_04_24_170630_create_customers_table', 1),
(8, '2020_04_27_054355_create_settings_table', 1),
(9, '2020_04_30_053758_create_user_cart_table', 1),
(10, '2020_05_04_165730_create_orders_table', 1),
(11, '2020_05_04_165749_create_order_items_table', 1),
(12, '2020_05_04_165822_create_payments_table', 1),
(13, '2022_03_21_125336_change_price_column', 1),
(14, '2024_03_09_180155_create_roles_table', 1),
(15, '2024_03_09_191825_create_permissions_table', 1),
(16, '2024_03_09_193332_create_roles_permission_table', 1),
(17, '2024_03_13_151554_create_expenses_table', 1),
(18, '2024_03_16_103537_create_productbuy_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(14,4) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(14,4) NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'home view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(2, 'product view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(3, 'product create', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(4, 'product update', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(5, 'product delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(6, 'order view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(7, 'order edit', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(8, 'order delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(9, 'customer view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(10, 'customer create', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(11, 'customer update', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(12, 'customer delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(13, 'employe view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(14, 'employe create', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(15, 'employe update', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(16, 'employe delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(17, 'cart view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(18, 'role view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(19, 'role create', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(20, 'role edit', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(21, 'role update', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(22, 'role delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(23, 'expenses view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(24, 'expenses create', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(25, 'expenses edit', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(26, 'expenses delete', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(27, 'backup ', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(28, 'setting view', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(29, 'setting update', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(31, 'purchase view', NULL, NULL),
(32, 'purchase create', NULL, NULL),
(33, 'purchase update', NULL, NULL),
(34, 'purchase delete', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productbuy`
--

CREATE TABLE `productbuy` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `barcode` varchar(191) NOT NULL,
  `price` decimal(14,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image`, `barcode`, `price`, `quantity`, `status`, `created_at`, `updated_at`) VALUES
(14, 'sjd', NULL, 'products/cKhnBTzDiqu9JrIQfnwVWWuBDpsdKhITnt3Fh1iw.jpg', '69486', '100.00', 1, 1, '2024-03-24 13:50:48', '2024-03-24 13:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(2, ' Admin', '2024-03-24 11:16:46', '2024-03-24 11:16:46'),
(3, 'Seller', '2024-03-24 11:16:46', '2024-03-24 11:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permission`
--

CREATE TABLE `roles_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles_permission`
--

INSERT INTO `roles_permission` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 2, NULL, NULL),
(3, 1, 3, NULL, NULL),
(4, 1, 4, NULL, NULL),
(5, 1, 5, NULL, NULL),
(6, 1, 6, NULL, NULL),
(7, 1, 7, NULL, NULL),
(8, 1, 8, NULL, NULL),
(9, 1, 9, NULL, NULL),
(10, 1, 10, NULL, NULL),
(11, 1, 11, NULL, NULL),
(12, 1, 12, NULL, NULL),
(13, 1, 13, NULL, NULL),
(14, 1, 14, NULL, NULL),
(15, 1, 15, NULL, NULL),
(16, 1, 16, NULL, NULL),
(17, 1, 17, NULL, NULL),
(18, 1, 18, NULL, NULL),
(19, 1, 19, NULL, NULL),
(20, 1, 20, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 22, NULL, NULL),
(23, 1, 23, NULL, NULL),
(24, 1, 24, NULL, NULL),
(25, 1, 25, NULL, NULL),
(26, 1, 26, NULL, NULL),
(28, 1, 28, NULL, NULL),
(29, 1, 29, NULL, NULL),
(30, 2, 1, NULL, NULL),
(31, 2, 2, NULL, NULL),
(32, 2, 3, NULL, NULL),
(33, 2, 4, NULL, NULL),
(34, 2, 5, NULL, NULL),
(35, 2, 6, NULL, NULL),
(36, 2, 7, NULL, NULL),
(37, 2, 8, NULL, NULL),
(38, 2, 9, NULL, NULL),
(39, 2, 10, NULL, NULL),
(40, 2, 11, NULL, NULL),
(41, 2, 12, NULL, NULL),
(42, 2, 13, NULL, NULL),
(43, 2, 14, NULL, NULL),
(44, 2, 15, NULL, NULL),
(45, 2, 16, NULL, NULL),
(46, 2, 17, NULL, NULL),
(48, 2, 23, NULL, NULL),
(49, 2, 24, NULL, NULL),
(50, 2, 25, NULL, NULL),
(51, 2, 26, NULL, NULL),
(52, 2, 28, NULL, NULL),
(53, 2, 29, NULL, NULL),
(54, 3, 1, NULL, NULL),
(55, 3, 2, NULL, NULL),
(56, 3, 3, NULL, NULL),
(57, 3, 4, NULL, NULL),
(58, 3, 6, NULL, NULL),
(59, 3, 7, NULL, NULL),
(60, 3, 9, NULL, NULL),
(61, 3, 10, NULL, NULL),
(62, 3, 11, NULL, NULL),
(63, 3, 17, NULL, NULL),
(64, 3, 23, NULL, NULL),
(65, 3, 24, NULL, NULL),
(66, 3, 25, NULL, NULL),
(67, 3, 26, NULL, NULL),
(70, 1, 32, NULL, NULL),
(71, 1, 33, NULL, NULL),
(72, 1, 34, NULL, NULL),
(73, 1, 31, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'app_name', 'ASA SYSTEM', '2024-03-24 11:16:46', '2024-03-24 11:40:01'),
(2, 'currency_symbol', 'AF', '2024-03-24 11:16:46', '2024-03-24 11:40:01'),
(3, 'app_description', 'afg', '2024-03-24 11:40:01', '2024-03-24 11:52:12'),
(4, 'warning_quantity', '5', '2024-03-24 11:40:01', '2024-03-24 11:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `user_role` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `user_role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$MCMcmLmkdsVxfWMPBDutPuEjcShhYHZnzV5ygwn6We7EamKtypPEK', '1', NULL, '2024-03-24 11:16:46', '2024-03-24 11:16:46');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `productbuy`
--
ALTER TABLE `productbuy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_barcode_unique` (`barcode`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permission`
--
ALTER TABLE `roles_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD KEY `user_cart_user_id_foreign` (`user_id`),
  ADD KEY `user_cart_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productbuy`
--
ALTER TABLE `productbuy`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles_permission`
--
ALTER TABLE `roles_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
