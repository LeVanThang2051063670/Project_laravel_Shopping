-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 12:21 PM
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
(1, 'Banner 1', '#', 'banner_bg.png', '', 'top-banner', 0, 1, '2024-07-30', NULL),
(2, 'gallery 1', '#', 'gallery_img01.png', '', 'gallery', 3, 1, '2024-07-30', NULL),
(3, 'gallery 2', '#', 'gallery_img02.png', '', 'gallery', 2, 1, '2024-07-30', NULL),
(4, 'gallery 3', '#', 'gallery_img03.png', '', 'gallery', 1, 1, '2024-07-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL DEFAULT '#',
  `image` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `position` varchar(100) DEFAULT 'top-banner',
  `status` tinyint(1) DEFAULT 0,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(16, 6, 50000.00, 4);

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
(1, 'Dưa hấu', 1, '2024-07-30', NULL),
(2, 'Cà chua', 1, '2024-07-30', NULL),
(3, 'Chuối tiến vua', 1, '2024-07-30', NULL),
(4, 'Nho mỹ', 1, '2024-07-30', NULL),
(5, 'Cà pháo', 1, '2024-08-20', '2024-08-20');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` text DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(11, 'Lê Văn Thắng', 'thanglv229@gmail.com', '0344786805', 'ha noi', 0, '$2y$12$b.5MNvuHPJfJChiiP7IQ8uK8zuwQ8otZjnJKzJBhRXHQogBTu6LKG', NULL, '2024-08-03', '2024-08-03'),
(16, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh ho', 1, '$2y$12$50M/Bq5bxhKYRRRI8LETM.quPU2lVUaFlW/q2l6mwBULdK85XPRoe', '2024-08-04', '2024-08-04', '2024-08-05'),
(18, 'Thang adas', 'daucatmoilinux@gmail.com', '0344786803', 'thanh hoa', 1, '$2y$12$VJ4znL185kovhxk.88zkXOvYuJGVYgO2nqhuaB.ThCxA2dkULpLka', NULL, '2024-08-04', '2024-08-04');

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
('thanglevan2k2@gmail.com', 'LbFpJKOazzlXBdxhm0M1hTbTaJ6UaN7YXUZorrbL', '2024-08-05', '2024-08-05');

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
(9, 16, 1, '2024-08-13', '2024-08-13'),
(10, 16, 2, '2024-08-13', '2024-08-13'),
(11, 16, 3, '2024-08-13', '2024-08-13'),
(12, 16, 6, '2024-08-16', '2024-08-16');

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
  `customer_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `token` varchar(50) DEFAULT NULL,
  `created_at` date DEFAULT current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `customer_id`, `status`, `token`, `created_at`, `updated_at`) VALUES
(1, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh ho', 16, 1, NULL, '2024-08-16', '2024-08-16'),
(2, 'Lê Văn Thắng', 'thanglevan2k2@gmail.com', '0345638912', 'thanh ho', 16, 2, NULL, '2024-08-19', '2024-08-19');

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
(1, 1, 1, 350000),
(1, 3, 1, 350000),
(1, 6, 3, 50000),
(2, 6, 4, 50000);

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
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale_price`, `category_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Product 22', 'CVAjbSL7J4pviKov3SiUc04reHrysTYmg7RUJZSZ.png', 500000.00, 350000.00, 1, 'DASDASDAS', 0, '2024-08-08', '2024-08-08'),
(2, 'Product 13', 'h2_product02.png', 500000.00, 350000.00, 2, 'ASDSADSAD', 0, '2024-08-08', '2024-08-08'),
(3, 'Product 4', 'h2_product03.png', 500000.00, 350000.00, 1, '131312312312321', 0, '2024-08-08', '2024-08-08'),
(6, 'Product 51', 'gjPJxZaDTtQP7ZudOHqu0c1D7Dni0bvoglvh4i2g.png', 100000.00, 50000.00, 1, 'dsadasd', 1, '2024-08-10', '2024-08-12');

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
(33, 'ZEb4tmv8kKHprPIEF5jHvxQZv6yv4sxXDXYc6ECf.png', 6, 0, '2024-08-10', '2024-08-10'),
(34, 'PoetqRZEZRZthQTvLK3jUQiwHNdWxv4LpCPJYWUe.png', 6, 0, '2024-08-10', '2024-08-10'),
(35, '7eWrSR7gKuHEKZvbqvarc7p6M8hsxfTKnL5f8iQw.png', 6, 0, '2024-08-10', '2024-08-10'),
(36, '6r5zQnjTqrXgDYqhPmaJJJQIYSRByXhkeeA4369p.png', 6, 0, '2024-08-10', '2024-08-10'),
(37, 'yWMcTfMQUb9kcZ6DFtZK2rE0kP4upWQuhARfJXbD.png', 3, 0, '2024-08-12', '2024-08-12'),
(38, '0Gq25uSGdWuCyUKVr5ZSjlsC0UIBhaNaC5y0ZLUT.png', 3, 0, '2024-08-12', '2024-08-12'),
(39, '3iwRl02euM2ac5fRSpLdA7RZClWHs8SLwL4o04ef.png', 3, 0, '2024-08-12', '2024-08-12'),
(40, 'YyWMRlTB0bs3aTekvvIZjKku4iK5WHb2h1gJHLpp.png', 3, 0, '2024-08-12', '2024-08-12'),
(41, 'vILddKgSdIR74bprWZyNBLE05i3xZ53v9KolrzHT.png', 2, 0, '2024-08-12', '2024-08-12'),
(42, 'QcQ3pwL4pFCrkbFML9vgSQIQfiQK9hWVYAbtnMLT.png', 2, 0, '2024-08-12', '2024-08-12'),
(43, 'Cj3SOwTeOT0XYKIZ5Q0dVapQsp8xi2pxnm9Aw4xZ.png', 2, 0, '2024-08-12', '2024-08-12'),
(44, 'g5KtgQNIy3xwoPBeIjOgANNpbW53GKgN6zhh4rnI.png', 1, 0, '2024-08-12', '2024-08-12'),
(45, 'N4flMwUp1KdJItlHh90jhQRo6Akh1n1VSxDpu7Mp.png', 1, 0, '2024-08-12', '2024-08-12');

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
(3, 'Admin Manager', 'admin@gmail.com', '$2y$12$OPR9rIQJuyqFAebHpgX8Tu0Y4nzZ5cmj6e0oq66QIwOHPezHGnDja', '2024-08-06', '2024-08-06'),
(4, 'Admin Manager1', 'admin1@gmail.com', '$2y$12$nqIo5UJhN5ztwjfEGKIMredysJHjBfm5txTcs2ThipvBcbs95l5mK', '2024-08-07', '2024-08-07');

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
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
