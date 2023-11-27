-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 27, 2023 at 11:31 PM
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
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `productlist`
--

CREATE TABLE `productlist` (
  `id` int NOT NULL,
  `ProductName` text NOT NULL,
  `ProductPrice` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_cartlist`
--

CREATE TABLE `shopping_cartlist` (
  `id` int NOT NULL,
  `product_added` text NOT NULL,
  `date` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlist`
--

CREATE TABLE `userlist` (
  `id` int NOT NULL,
  `staff_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `userlist`
--

INSERT INTO `userlist` (`id`, `staff_name`) VALUES
(1, 'John Doe'),
(2, 'Jane Smith'),
(3, 'Bob Johnson');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `token` text NOT NULL,
  `status` text NOT NULL,
  `role` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `token`, `status`, `role`, `created_at`) VALUES
(1, 'john_doe', 'hashed_password_123', 'random_token_abc', 'active', 'user', '2023-11-27 12:34:56'),
(2, 'jane_smith', 'hashed_password_xyz', 'another_token_def', 'inactive', 'admin', '2023-11-27 14:45:00'),
(3, 'bob_jackson', 'hashed_password_789', 'yet_another_token_ghi', 'active', 'user', '2023-11-28 08:00:00'),
(4, '123', '$2y$10$f/bCF.J0QYbn8jyU.956bu/aPN0E34XsqvmegvVf3sMy67Tkz4gRq', 'Q5734VtZDMT2YXco60pjeaALldxvBOqhrFuUSbPW9gICn8isfw', 'active', 'user', '0000-00-00 00:00:00'),
(5, '123', '$2y$10$Wd92necAVtWXeLtLhqxWIOsQT5/58imjzTeBGbMLEkjGswSwRASUC', 'j0yvpUPBCX9lstF7uVeRQnhYGoqzTScIAb1Ogfi2W3Zx54kHM8', 'active', 'user', '0000-00-00 00:00:00'),
(6, '123', '$2y$10$XmRUze8iJBpENqirSnzjxurwtCvvsR6qCewzH7FNmGbk.9Bsx.l9y', '4NRonO5vqaBjSbz1eJPygEfrZ2mMLwXIpYd8WHiDuQAlUh3st9', 'active', 'user', '0000-00-00 00:00:00'),
(7, '123', '$2y$10$jJHFrQAdX60WLzYHRuEW/Oj9.bS187N6GMdv/TBwqwV80m4LEAtJi', 'hEXCJiWH8dbAk7leuT5jcnx3Ny0MgoBSmD2a64IFz1QrRKsGLP', 'active', 'user', '0000-00-00 00:00:00'),
(8, '123', '$2y$10$./tWikgmZ3HJV/phAAPHR.AgcoIfmS3HrLvlQDkfIfAl8eUvYdsDW', 'NcJhoOXjU8Dz3MtI42qnGKsCxeQAwfuv1abRpklHWm7T9i0yLE', 'active', 'admin', '0000-00-00 00:00:00'),
(9, '1', '$2y$10$5xrDKLWcjXVCHJ362Qz2Ru8GPo4gp8dbNoW1HPlKCqgGs2C.Nepwy', '8C1bAiqxLZPjtkMhwgIHolv3UsamXVK6n2F9YE5ry70DRTuzOc', 'active', 'admin', '0000-00-00 00:00:00'),
(10, '123', '$2y$10$X4.tdKrFLVMESWc.M6Z77eUUS1WIfJh.vH8DGNvLMwk2a6Rvc1Uoi', 'ATW357CDjMLRf9gHy8rbIS1JeEdNsUwkoaVKY2vXGFQmOxpPZz', 'active', 'user', '0000-00-00 00:00:00'),
(11, '123', '$2y$10$kTR5tk5GlIyAY4eQzBGy9eH2E2YZOHEB0FLvMghambYawZLM3KCPW', '50Wzl4DxXnJRwMOqjQAmYfahN7sdy6eiZBCuLHkrKo3EF1UITv', 'active', 'user', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `productlist`
--
ALTER TABLE `productlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `userlist`
--
ALTER TABLE `userlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `productlist`
--
ALTER TABLE `productlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlist`
--
ALTER TABLE `userlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
