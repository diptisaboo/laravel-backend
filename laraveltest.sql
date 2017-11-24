-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2017 at 01:18 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laraveltest`
--

-- --------------------------------------------------------

--
-- Table structure for table `films`
--

CREATE TABLE `films` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `realease_date` datetime NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `ticket_price` int(11) NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1 - Active , 2 - Inactive, 3 - Deleted'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `films`
--

INSERT INTO `films` (`id`, `user_id`, `name`, `description`, `realease_date`, `rating`, `ticket_price`, `country`, `genre`, `photo`, `created_at`, `updated_at`, `status`) VALUES
(1, 3, 'name name', 'description description', '2017-01-01 00:00:00', 5, 100, 'india', 'Music, Song', '1511515587.jpg', '2017-11-24 03:56:27', '2017-11-24 03:56:27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_28_091319_create_roles_table', 1),
(4, '2017_03_29_035841_create_emailtemplates_table', 1),
(7, '2017_11_23_133517_create_films_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 'Super Admin', 'superadmin', '2017-03-27 18:30:00', 1, '2017-03-27 18:30:00', 1, 1),
(2, 'User', 'user', '2017-03-27 18:30:00', 1, '2017-03-27 18:30:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT '0',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `address`, `phone`, `remember_token`, `created_at`, `created_by`, `updated_at`, `updated_by`, `status`) VALUES
(1, 1, 'Super Admin', 'admin@admin.com', '$2y$10$tNxqWWEbEfHksxeJDFkRgeZN09naxQTvRAhRbdEdrfnuxFuc2rlwK', '', '', 'jY7NjziqmClC97YJ8WxwZOjRfVbbmxf7fRBOqoxzNxda99Ki15KaiP3aYQMV', '2017-11-23 06:23:47', 0, '2017-11-23 07:12:19', 0, 1),
(2, 2, 'admin', 'admin@admin.cosm', '$2y$10$wJ33MOwySpdOUJe/TF85hOzJVaCbRTfJDKVhNSs056leZg346IvrK', NULL, NULL, NULL, '2017-11-24 01:06:26', 0, '2017-11-24 01:06:26', 0, 1),
(3, 2, 'Jaimin', 'jaimin@admin.com', '$2y$10$AChNZw5LMnI5II82kT2XEeYUvulFyjks.Sex261Sr3KVv9Zp8EvFK', NULL, NULL, NULL, '2017-11-24 03:00:29', 0, '2017-11-24 03:00:29', 0, 1),
(4, 2, 'Jaimin', 'asd@asd.com', '$2y$10$TGave.tWZvngRf2vBtGeTOW.XYaDZ5v62CxLj9fojMjLCr1wQDOEm', NULL, NULL, NULL, '2017-11-24 04:46:53', 0, '2017-11-24 04:46:53', 0, 1),
(5, 2, 'User', 'user@gmail.com', '$2y$10$eONrg2Mu2YGR4KNwoQfTme4MGkABBh8zl9ByElM6259JeQJbUKvZ6', NULL, NULL, NULL, '2017-11-24 04:49:46', 0, '2017-11-24 04:49:46', 0, 1),
(6, 2, 'User', 'userfilm@gmail.com', '$2y$10$tkfI6dRHfIGl/L9scxIC/u9T2OOdw7sZ4Sv39bRuEEtMQqxKkXUgu', NULL, NULL, NULL, '2017-11-24 04:50:26', 0, '2017-11-24 04:50:26', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

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
-- AUTO_INCREMENT for table `films`
--
ALTER TABLE `films`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
