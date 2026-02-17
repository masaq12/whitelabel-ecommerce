-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2026 at 03:20 PM
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
-- Database: `whitelabel_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', 'electronics', 'Electronic devices and gadgets', 1, '2026-02-17 08:14:28', '2026-02-17 08:14:28'),
(2, 'Clothings', 'clothings', 'Fashion and apparel', 1, '2026-02-17 08:14:29', '2026-02-17 08:29:44'),
(3, 'Books', 'books', 'Books and literature', 1, '2026-02-17 08:14:29', '2026-02-17 08:14:29'),
(4, 'Home & Garden', 'home-garden', 'Home decor and garden supplies', 1, '2026-02-17 08:14:29', '2026-02-17 08:14:29'),
(5, 'Sports', 'sports', 'Sports equipment and accessories', 1, '2026-02-17 08:14:29', '2026-02-17 08:14:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_01_01_000000_create_users_table', 1),
(2, '2024_01_01_000001_create_categories_table', 1),
(3, '2024_01_01_000002_create_products_table', 1),
(4, '2024_01_01_000003_create_carts_table', 1),
(5, '2024_01_01_000004_create_orders_table', 1),
(6, '2024_01_01_000005_create_order_items_table', 1),
(7, '2024_01_01_000006_create_white_label_settings_table', 1),
(8, '2024_01_01_000007_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `payment_status` enum('pending','success','failed') NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL DEFAULT 'cash_on_delivery',
  `shipping_address` text NOT NULL,
  `shipping_city` varchar(255) NOT NULL,
  `shipping_state` varchar(255) NOT NULL,
  `shipping_zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_number`, `total_amount`, `status`, `payment_status`, `payment_method`, `shipping_address`, `shipping_city`, `shipping_state`, `shipping_zip`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 'ORD-699477C10C580', 19.99, 'cancelled', 'failed', 'debit_card', '456 User Avenue', 'User City', 'User State', '54321', NULL, '2026-02-17 08:44:25', '2026-02-17 08:47:04'),
(2, 2, 'ORD-699477D2CF735', 19.99, 'delivered', 'success', 'cash_on_delivery', '456 User Avenue', 'User City', 'User State', '54321', NULL, '2026-02-17 08:44:42', '2026-02-17 08:46:52'),
(3, 2, 'ORD-69947813A0B49', 59.98, 'shipped', 'success', 'cash_on_delivery', '456 User Avenue', 'User City', 'User State', '54321', NULL, '2026-02-17 08:45:47', '2026-02-17 08:46:43');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 1, 19.99, 19.99, '2026-02-17 08:44:25', '2026-02-17 08:44:25'),
(2, 2, 7, 1, 19.99, 19.99, '2026-02-17 08:44:42', '2026-02-17 08:44:42'),
(3, 3, 10, 2, 29.99, 59.98, '2026-02-17 08:45:47', '2026-02-17 08:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `sale_price` decimal(10,2) DEFAULT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `sku` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`images`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `description`, `price`, `sale_price`, `stock`, `sku`, `image`, `images`, `is_active`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 1, 'Laptop Pro 15', 'laptop-pro-15', 'High-performance laptop with 16GB RAM and 512GB SSD', 1299.99, 1199.99, 50, 'LAP-PRO-15', 'products/kYVjKTv4os4rEIAA9zEKrHOMxUgnCcL48mw4p3rL.webp', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:37:43'),
(2, 1, 'Wireless Mouse', 'wireless-mouse', 'Ergonomic wireless mouse with precision tracking', 29.99, NULL, 100, 'MOUSE-WL-01', 'products/6cEMxLuSwBYwFG3cMuWfNJ7ER20LsIhRPNwxJq0J.jpg', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:38:17'),
(3, 1, 'Mechanical Keyboard', 'mechanical-keyboard', 'RGB mechanical keyboard with cherry MX switches', 149.99, 129.99, 75, 'KB-MECH-RGB', 'products/ruax4HqMRLaU03DMu8LiBLEGA3SWji89LxkQ5rew.jpg', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:39:02'),
(4, 2, 'Cotton T-Shirt', 'cotton-t-shirt', '100% cotton comfortable t-shirt', 19.99, NULL, 200, 'TSHIRT-COT-01', 'products/BBBoYk1IQFfWU7c8DNQ0eTqfNkG3037yj8BH8Oyf.webp', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:39:38'),
(5, 2, 'Denim Jeans', 'denim-jeans', 'Classic blue denim jeans', 49.99, 39.99, 150, 'JEANS-DEN-01', 'products/6W3001AYhf80It1J6KRLeIQVLv8eUQ5quk56Rr6Z.webp', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:40:07'),
(6, 3, 'Programming Guide', 'programming-guide', 'Complete guide to modern programming', 39.99, NULL, 80, 'BOOK-PROG-01', 'products/yfSguWwF6JkVnQ8Q5qjCybd81bKhEcJ5MrnYedQq.jpg', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:40:41'),
(7, 3, 'Mystery Novel', 'mystery-novel', 'Bestselling mystery thriller', 24.99, 19.99, 118, 'BOOK-MYS-01', 'products/WCzsN4qNa0v99IJCcbGgZD039C0OsEXIaeJY838P.jpg', NULL, 1, 1, '2026-02-17 08:14:29', '2026-02-17 08:44:42'),
(8, 4, 'Garden Tool Set', 'garden-tool-set', 'Complete set of essential garden tools', 89.99, NULL, 40, 'GARDEN-TOOL-01', 'products/4A9xS0FceSyczKU7l7s7s902nrvQ7xcMTcvTSPjm.webp', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:41:55'),
(9, 4, 'LED Table Lamp', 'led-table-lamp', 'Modern LED desk lamp with adjustable brightness', 34.99, 29.99, 90, 'LAMP-LED-01', 'products/s1Gw9oe9OvgekgReUCkRu5rjDXNzsrQd3lur7ErI.jpg', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:42:26'),
(10, 5, 'Yoga Mat', 'yoga-mat', 'Non-slip yoga mat with carrying strap', 29.99, NULL, 108, 'YOGA-MAT-01', 'products/2WqY4iiliS9KecC6HM4DDvjExvARjn6r7ZO5MVSW.jpg', NULL, 1, 0, '2026-02-17 08:14:29', '2026-02-17 08:45:48'),
(11, 5, 'Dumbell Set', 'dumbell-set', 'Adjustable dumbell set 5-25kg', 79.99, 39.99, 50, 'DUMB-SET-01', 'products/vySYpkVR4eOl6g10zHD7lOOX3oVUaGgcedjH2epY.jpg', NULL, 1, 0, '2026-02-17 08:14:30', '2026-02-17 08:30:56'),
(12, 1, 'Smartphone X', 'smartphone-x', '5G smartphone with 128GB storage', 699.99, 649.99, 85, 'PHONE-X-128', 'products/L4dBTWapHk6zczeu191V82nEiHhYrHiGlTLswAVS.webp', NULL, 1, 1, '2026-02-17 08:14:30', '2026-02-17 08:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `city`, `state`, `zip_code`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', NULL, '$2y$12$VHEnyWrigvc1enSE3oCyvOqwoaZ/0hrjmd7d.eb5kcjROy6GD0bN2', '1234567890', '123 Admin Street', 'Admin City', 'Admin State', '12345', 'admin', '1fR3Odrp06pRk5wXP3qRCm74egbmALhGM8vFsl7kjRVC2wix3mCojQJHEmAk', '2026-02-17 08:14:28', '2026-02-17 08:14:28'),
(2, 'Test User', 'user@example.com', NULL, '$2y$12$zDXUGeMIcq0X6UI1JmpDUuuFqosp8NxXwkrkUQMBWIimuzarAUmNi', '9876543210', '456 User Avenue', 'User City', 'User State', '54321', 'user', NULL, '2026-02-17 08:14:28', '2026-02-17 08:14:28');

-- --------------------------------------------------------

--
-- Table structure for table `white_label_settings`
--

CREATE TABLE `white_label_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_name` varchar(255) NOT NULL DEFAULT 'E-Commerce Store',
  `logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `primary_color` varchar(255) NOT NULL DEFAULT '#007bff',
  `secondary_color` varchar(255) NOT NULL DEFAULT '#6c757d',
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `footer_text` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `white_label_settings`
--

INSERT INTO `white_label_settings` (`id`, `site_name`, `logo`, `favicon`, `primary_color`, `secondary_color`, `contact_email`, `contact_phone`, `footer_text`, `created_at`, `updated_at`) VALUES
(1, 'White Label Store', NULL, NULL, '#007bff', '#6c757d', 'contact@whitelabelstore.com', '+1 (555) 123-4567', '© 2024 White Label Store. All rights reserved.', '2026-02-17 08:14:30', '2026-02-17 08:14:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

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
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD UNIQUE KEY `products_sku_unique` (`sku`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `white_label_settings`
--
ALTER TABLE `white_label_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `white_label_settings`
--
ALTER TABLE `white_label_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
