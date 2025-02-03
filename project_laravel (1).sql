-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2025 at 08:38 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL DEFAULT '#',
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `position` varchar(100) DEFAULT 'top-banner',
  `prioty` tinyint(4) DEFAULT 0,
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `link`, `image`, `description`, `position`, `prioty`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Fresh Meet', '#', 'banner_bg.png', '', 'top-banner', 0, 1, '2024-07-30', NULL),
(2, 'gallery 1', '#', 'gallery_img01.png', '', 'gallery', 3, 1, '2024-07-30', NULL),
(3, 'gallery 2', '#', 'gallery_img02.png', '', 'gallery', 2, 1, '2024-07-30', NULL),
(4, 'gallery 3', '#', 'gallery_img03.png', '', 'gallery', 1, 1, '2024-07-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`customer_id`, `product_id`, `price`, `quantity`) VALUES
(16, 8, 90000.00, 1),
(16, 11, 80000.00, 1),
(19, 12, 80000.00, 1),
(19, 13, 75000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(10, 'Thịt', 1, '2024-11-14', '2025-01-16'),
(11, 'Sườn', 1, '2024-11-14', '2025-01-16'),
(12, 'Cá', 1, '2024-11-14', '2025-01-16'),
(13, 'Rau củ quả', 1, '2024-11-14', '2025-01-16'),
(14, 'Xúc xích', 1, '2024-11-14', '2025-01-16'),
(15, 'Rau', 1, '2025-01-18', '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0,
  `password` varchar(200) NOT NULL,
  `email_verified_at` date DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `gender`, `password`, `email_verified_at`, `created_at`, `updated_at`) VALUES
(16, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh hoa', 1, '$2y$12$50M/Bq5bxhKYRRRI8LETM.quPU2lVUaFlW/q2l6mwBULdK85XPRoe', '2024-08-04', '2024-08-04', '2025-01-16'),
(19, 'Thanglv', 'thanglv229@gmail.com', '0345638915', 'ha noi', 1, '$2y$12$dO3Z/giJCojHrCvmTO0mKuGGf6s.lGYFqm4WIxhb9R1LHkOrWC0gC', '2024-11-06', '2024-11-06', '2025-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `customer_reset_tokens`
--

CREATE TABLE `customer_reset_tokens` (
  `email` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_reset_tokens`
--

INSERT INTO `customer_reset_tokens` (`email`, `token`, `created_at`, `updated_at`) VALUES
('thanglevan2k2@gmail.com', 'LbFpJKOazzlXBdxhm0M1hTbTaJ6UaN7YXUZorrbL', '2024-08-05', '2024-08-05'),
('thanglv229@gmail.com', 'oxw5METxbwbWNMe4WybVJBU7RfIKRMnhbh4VIpEa', '2025-01-17', '2025-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `customer_id`, `product_id`, `created_at`, `updated_at`) VALUES
(14, 16, 12, '2024-12-02', '2024-12-02'),
(16, 19, 13, '2025-01-18', '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `customer_id`, `status`, `token`, `created_at`, `updated_at`) VALUES
(32, 'anh thắng dz', 'thanglv229@gmail.com', '0344786805', 'quang trung', NULL, 2, NULL, '2024-12-14', '2024-12-14'),
(33, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh ho', 16, 1, NULL, '2024-12-14', '2024-12-14'),
(34, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh ho', 16, 1, NULL, '2024-12-14', '2024-12-14'),
(35, 'Thanglv', 'thanglv229@gmail.com', '0345638915', 'ha noi', 19, 1, NULL, '2025-01-18', '2025-01-18'),
(36, 'Duy', 'duylv@gmail.com', '0392240313', 'hh', NULL, 2, NULL, '2025-01-18', '2025-01-18'),
(37, 'Thanglv', 'thanglv229@gmail.com', '0345638915', 'ha noi', 19, 1, NULL, '2025-01-18', '2025-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` tinyint(4) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`order_id`, `product_id`, `quantity`, `price`) VALUES
(32, 8, 1, 100000),
(32, 9, 1, 50000),
(33, 8, 1, 90000),
(33, 12, 1, 80000),
(34, 11, 1, 80000),
(35, 13, 1, 75000),
(36, 13, 1, 100000),
(37, 12, 1, 80000),
(37, 13, 1, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `price` float(10,2) NOT NULL,
  `sale_price` float(10,2) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale_price`, `category_id`, `description`, `status`, `created_at`, `updated_at`, `quantity`) VALUES
(8, 'Thịt bò', 'uKr2faCLjvAJCbCNymj4jQp3s1xe9UOUcGkyDgH4.png', 100000.00, 90000.00, 10, 'Meat is an essential food', 1, '2024-11-14', '2025-01-17', 3),
(9, 'Đùi gà', 'AMTvuKXH4fvXnbyjko12JN6FBXQXD1nsCdBr3wOs.png', 50000.00, 45000.00, 10, 'Meat is an essential food', 1, '2024-11-14', '2025-01-16', 12),
(10, 'Sườn heo', 'fIYl6T1bS0VULF4UleXoSqJV6KokkVlNTnPsgY6g.png', 100000.00, 90000.00, 10, 'Meat Beef&nbsp', 1, '2024-11-14', '2025-01-16', 4),
(11, 'Xúc xích', 'OWLya7qkqFElUghuZFQl6ZtiyKgA0BHvLrxwHRme.png', 95000.00, 80000.00, 14, 'Sausages are delicious good', 1, '2024-11-14', '2025-01-16', 3),
(12, 'Thịt trâu', 'OiKUh3LfGX75eJQomV7Nf60UgdAjkAyENzET0SBd.png', 100000.00, 80000.00, 10, 'dddd', 1, '2024-11-30', '2025-01-18', 3),
(13, 'Cá mè', '3g7zWd1lJmtBzc4BYA20aFo1oFEB1qaXSvkUwI7g.png', 100000.00, 75000.00, 12, '<p>Cá mè đen</p>', 1, '2025-01-17', '2025-01-18', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `product_id` int(11) NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `image`, `product_id`, `status`, `created_at`, `updated_at`) VALUES
(48, 'jnYBnxyDywiPFS6JZpOjsB6c9sAP9sxMQWwOUXtJ.png', 8, 0, '2024-11-14', '2024-11-14'),
(49, 'o6SgIOF5rhiroF3ipU29iSs6DG9Ee9QmLPZjXCbW.png', 9, 0, '2024-11-14', '2024-11-14'),
(50, 'LNprChmrorP5Mm5Anq9L2pkJInf42hnWryuZPTw1.png', 10, 0, '2024-11-14', '2024-11-14'),
(51, 'LI6estX6yLWF1dtVYUL8OGdBK8IUGKEEooCvMPTw.png', 11, 0, '2024-11-14', '2024-11-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(3, 'Admin Thang', 'admin@gmail.com', '$2y$12$OPR9rIQJuyqFAebHpgX8Tu0Y4nzZ5cmj6e0oq66QIwOHPezHGnDja', '2024-08-06', '2024-08-06');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_transactions`
--

CREATE TABLE `warehouse_transactions` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `transaction_type` enum('import') NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost_price` float(10,2) NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `note` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `import_code` longtext DEFAULT NULL,
  `quantity_import` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_transactions`
--

INSERT INTO `warehouse_transactions` (`id`, `product_id`, `transaction_type`, `quantity`, `cost_price`, `expiration_date`, `note`, `created_at`, `import_code`, `quantity_import`) VALUES
(98, 8, 'import', 4, 13000.00, '2025-01-04 00:00:00', 'a', '2024-12-14 22:21:45', '\"IMP-oOaG-20241214,IMP-raUf-20241214,IMP-8SDO-20241214,IMP-ozhr-20241214\"', 5),
(99, 9, 'import', 2, 23000.00, '2025-01-11 00:00:00', 'b', '2024-12-14 22:22:02', '\"IMP-MI7y-20241214,IMP-56JS-20241214\"', 3),
(100, 10, 'import', 4, 15000.00, '2024-12-28 00:00:00', 'ad', '2024-12-14 22:22:28', '[\"IMP-QOPj-20241214\",\"IMP-gpRI-20241214\",\"IMP-r22g-20241214\",\"IMP-kKzo-20241214\"]', 4),
(101, 11, 'import', 1, 12000.00, '2025-01-10 00:00:00', 'a', '2024-12-14 22:22:46', '\"IMP-Xrsy-20241214\"', 2),
(102, 9, 'import', 10, 45.00, '2024-12-19 00:00:00', 'e', '2024-12-14 22:23:03', '[\"IMP-eEww-20241214\",\"IMP-UZVZ-20241214\",\"IMP-iRgk-20241214\",\"IMP-KLEs-20241214\",\"IMP-1ANS-20241214\",\"IMP-78JP-20241214\",\"IMP-0Snq-20241214\",\"IMP-NfG0-20241214\",\"IMP-EtSM-20241214\",\"IMP-N5f0-20241214\"]', 10),
(103, 11, 'import', 2, 15000.00, '2025-01-03 00:00:00', 'v', '2024-12-14 22:24:55', '[\"IMP-wXIY-20241214\",\"IMP-gPKr-20241214\"]', 2),
(104, 12, 'import', 4, 14000.00, '2024-12-28 00:00:00', 'cho', '2024-12-14 22:43:26', '\"IMP-e9gX-20241214,IMP-Z5V0-20241214,IMP-e3FT-20241214,IMP-cyi8-20241214\"', 5),
(105, 13, 'import', 9, 70000.00, '2025-03-31 00:00:00', 'tháng 3 hết hạn', '2025-01-17 23:08:43', '\"IMP-0Zfv-20250117,IMP-iZIy-20250117,IMP-3CRg-20250117,IMP-rhw8-20250117,IMP-MenW-20250117,IMP-96Us-20250117,IMP-JQFX-20250117,IMP-szyI-20250117,IMP-vojZ-20250117\"', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`customer_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `customer_reset_tokens`
--
ALTER TABLE `customer_reset_tokens`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `warehouse_transactions`
--
ALTER TABLE `warehouse_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warehouse_transactions`
--
ALTER TABLE `warehouse_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `warehouse_transactions`
--
ALTER TABLE `warehouse_transactions`
  ADD CONSTRAINT `warehouse_transactions_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
