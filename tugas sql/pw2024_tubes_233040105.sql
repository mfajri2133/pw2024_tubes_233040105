-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 13, 2024 at 04:19 PM
-- Server version: 8.0.34
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040105`
--

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, '*', '2024-05-10 04:54:46', '2024-05-10 04:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', '2024-05-10 04:54:46', '2024-05-10 04:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles_permissions`
--

CREATE TABLE `roles_permissions` (
  `id` int NOT NULL,
  `permission_id` int DEFAULT NULL,
  `role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `roles_permissions`
--

INSERT INTO `roles_permissions` (`id`, `permission_id`, `role_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `img_profile_path` varchar(255) DEFAULT NULL,
  `role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `is_admin`, `is_active`, `password`, `created_at`, `updated_at`, `img_profile_path`, `role_id`) VALUES
(1, 'Superadmin', 'admin@admin.com', 1, 1, '$2y$10$pSQnYanqJeveQzekfnZT4u9oh.hO7mwgSCn4Ind1HsHfR4hi0k1ni', '2024-05-06 16:04:15', '2024-05-10 09:48:18', NULL, NULL),
(2, 'Jhone', 'jhone@example.com', 0, 1, '$2y$10$..4RvIwyy1DOP0XYk9gPRuOaFrOA3e3ttwyI6vhQ9C/524tIgjFbS', '2024-05-06 16:04:15', '2024-05-10 09:47:04', NULL, NULL),
(3, 'sujono', 'superrradmin@examplae.com', 0, 1, '$2y$10$1I3bsl.GAVsxw/tvyi1bp.5AZxum.qYxfEi4SWUraGenLaJAl.vei', '2024-05-07 05:08:38', '2024-05-10 09:47:04', NULL, NULL),
(4, 'abdul user', 'user@gmail.com', 0, 1, '$2y$10$UqZtJ17anb3E83zlow9DU.bf0cFMcMMk9Fnf5bNx9DKJO5UTL9ise', '2024-05-07 05:10:14', '2024-05-10 09:47:04', NULL, NULL),
(5, 'User Test 1', 'userSuper@gmail.com', 0, 1, '$2y$10$9Uc45643akmlBKYkyYDEBOq9.DnJtOQlg9oPRo8Byu7ZXeiLciO7a', '2024-05-07 05:13:42', '2024-05-10 09:47:04', NULL, NULL),
(6, 'User Test 2', 'user2@gmail.com', 0, 1, '$2y$10$OCK4Y.nZVA2TuxwkJJ.gruMhPubvIoyUhBabO.lvCnuvvlZls39ty', '2024-05-07 06:39:49', '2024-05-10 09:47:04', NULL, NULL),
(7, 'User Test abdoel', 'user3@gmail.com', 0, 1, '$2y$10$v/tdl6APrUvsMYcWjXEXi.pFXPkrRSvTtcpy5e7SB0KkBZ.iaKPpW', '2024-05-07 06:40:28', '2024-05-10 09:47:04', NULL, NULL),
(8, 'User Test somad', 'user4@gmail.com', 0, 1, '$2y$10$Bb3hc6vsujus6Jj6a9wGDOjYtPuD7A/yFdmvwxWn9jHASjKuXftPK', '2024-05-07 06:41:37', '2024-05-10 09:47:04', NULL, NULL),
(9, 'User Test gugun', 'gugunbalap@gmail.com', 0, 1, '$2y$10$nINCVQiHOtv0YYhwkxKmyO2pogDSXwfFeaJCZgATWtQnakExc/cxK', '2024-05-07 06:43:02', '2024-05-10 09:47:04', NULL, NULL),
(10, 'Superadminaaa', 'admin@admin.combro', 0, 1, NULL, '2024-05-13 15:45:00', '2024-05-13 15:45:00', NULL, NULL),
(18, 'Superadmin', 'admin@admin.comaaa', 0, 1, NULL, '2024-05-13 16:02:25', '2024-05-13 16:02:25', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_users_roles` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `roles_permissions`
--
ALTER TABLE `roles_permissions`
  ADD CONSTRAINT `roles_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `roles_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
