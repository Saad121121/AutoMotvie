-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2024 at 06:00 PM
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
-- Database: `toyota`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_08_13_140853_add_image_to_users_table', 2),
(5, '2024_08_15_082812_add_owners_table', 3),
(7, '2024_08_15_095709_add_showroom_table', 5),
(8, '2024_08_15_095514_add_manager_table', 6),
(9, '2024_08_15_123116_create_vehicle_makes_table', 7),
(10, '2024_08_15_123116_create_vehicle_models_table', 7),
(12, '2024_08_15_123419_create_vehicles__table', 8),
(13, '2024_08_19_114044_create_user_activity_logs_table', 9),
(15, '2024_08_19_114115_create_staff_table', 10),
(16, '2024_08_20_075857_add_showroom_id_to_users_table', 11),
(17, '2024_08_21_125157_add_showroom_id_to_activity_log_table', 12),
(18, '2024_08_21_132424_remove_owner_table_from_vechilces_table', 13),
(19, '2024_08_22_124732_add_table_services', 14),
(20, '2024_08_22_125304_add_table_service_items', 14),
(23, '2024_08_22_132441_add_new_columns_in_services_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('monkeydmaaz@gmail.com', '$2y$12$pitATaeBOTvjNE7WAvyPrOJRMGs44uH0BXXeL0st4EymHY10CeCOC', '2024-08-22 15:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-08-13 12:37:27', '2024-08-19 15:04:45'),
(2, 'Showroom Manager', '2024-08-13 19:55:29', '2024-08-19 15:04:36'),
(3, 'Staff', '2024-08-19 15:04:54', '2024-08-19 15:04:54'),
(4, 'User', '2024-08-19 15:04:54', '2024-08-19 15:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vehicle_id` bigint(20) UNSIGNED NOT NULL,
  `showroom_id` bigint(20) UNSIGNED NOT NULL,
  `service_date` date NOT NULL,
  `kilometers_driven` int(11) NOT NULL,
  `service_type` enum('Routine maintenance','Repair','Specific request') NOT NULL,
  `status` enum('Pending','Completed','Upcoming') NOT NULL,
  `additional_requests` text DEFAULT NULL,
  `estimated_completion_time` time DEFAULT NULL,
  `cost_estimate` decimal(8,2) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vehicle_id`, `showroom_id`, `service_date`, `kilometers_driven`, `service_type`, `status`, `additional_requests`, `estimated_completion_time`, `cost_estimate`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2024-08-15', 1200, 'Routine maintenance', 'Completed', 'addtional_requestssssssss', '24:16:55', 12000.20, 'remarks goooddd', '2024-08-22 15:16:55', '2024-08-22 15:16:55'),
(2, 2, 4, '2024-08-07', 20, 'Routine maintenance', 'Completed', 'sasdsdasda', '14:35:00', 231.34, 'All good', '2024-08-23 17:27:17', '2024-08-23 17:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `item`, `created_at`, `updated_at`) VALUES
(1, 1, 'Oil CHange, kkaa ,SSsada, asddsadas,asdasddsa,asdas', NULL, NULL),
(2, 2, 'Oil Change', '2024-08-23 17:27:17', '2024-08-23 17:27:17'),
(3, 2, 'Filter Replacement', '2024-08-23 17:27:17', '2024-08-23 17:27:17'),
(4, 2, 'Engine Tuning', '2024-08-23 17:27:18', '2024-08-23 17:27:18'),
(5, 2, 'Brake Inspection', '2024-08-23 17:27:18', '2024-08-23 17:27:18'),
(6, 2, 'Tire Rotation', '2024-08-23 17:27:18', '2024-08-23 17:27:18'),
(7, 2, 'Battery Check', '2024-08-23 17:27:18', '2024-08-23 17:27:18'),
(8, 2, 'Fuild suspension', '2024-08-23 17:27:19', '2024-08-23 17:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lXo5YICrU2efZob5f3DzIjKwzxMTOd0eO2QQyPCZ', 1, '192.168.128.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:129.0) Gecko/20100101 Firefox/129.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieE5oNng2bXNuWnFpU2M2a3V4MDBuSkRwM3RVYk9RWXUyQkdlUGhrOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTkyLjE2OC4xMjguNjE6ODAwNy9zZXJ2aWNlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1724428671),
('qu2oy9WI1okXaOeU9QsJfXZQkCvNko3hYeLHB4YS', NULL, '192.168.128.23', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiMVZQejd1QTZudjBicEJKZWVmRHFqNEVCeHZwbkpLUlluWm9JOEF6WiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xOTIuMTY4LjEyOC42MTo4MDA3Ijt9fQ==', 1724428772);

-- --------------------------------------------------------

--
-- Table structure for table `showrooms`
--

CREATE TABLE `showrooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shr_name` varchar(255) NOT NULL,
  `shr_location` varchar(255) NOT NULL,
  `shr_contact_number` varchar(255) NOT NULL,
  `shr_contact_email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showrooms`
--

INSERT INTO `showrooms` (`id`, `shr_name`, `shr_location`, `shr_contact_number`, `shr_contact_email`, `created_at`, `updated_at`) VALUES
(3, 'Toyota', 'bvasfsafafdfsa', '+923636452452', 'toyota_motors@gmail.com', '2024-08-15 18:52:09', '2024-08-16 20:26:29'),
(4, 'Suban Motors', 'A-43 M PECHS Society Block-2 Near Sharah e Faisal,Karachi', '03132456985', 'subhan.motors@gmail.com', '2024-08-16 20:26:01', '2024-08-16 20:26:01');

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
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `showroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `role_id`, `showroom_id`, `created_at`, `updated_at`) VALUES
(1, 'Maaz Khan', 'maaz@gmail.com', NULL, '$2y$12$zMyU9RAmiCut5nlkxHeSzulwpLHhWFqsnZUSDOpqPEvrXpgDBC68e', 'build/assets/images/users/sZhlfOuzvB2KTNSXyUhiBIcboGo3D1dvo0KDzpY5.jpg', NULL, 1, 3, '2024-08-13 17:35:53', '2024-08-22 16:15:51'),
(3, 'saad', 'saad@abitmuchco.com', NULL, '$2y$12$6Cpx79Y8M9jp8t6P1crRQOOPj8Abn.RgVjkskjBrniBHFzSw6HEdu', 'build/assets/images/users/htvv3xONrBbDEe0Os2j29KLjId630iCYv1QK6lyF.jpg', NULL, 1, 4, '2024-08-15 19:48:08', '2024-08-20 23:07:40'),
(4, 'Saleem11', 'saleem@gmail.com', NULL, '$2y$12$zMyU9RAmiCut5nlkxHeSzulwpLHhWFqsnZUSDOpqPEvrXpgDBC68e', 'build/assets/images/users/QonaONti1ShFhqCVkE3hNqG7aM2gshtvGNn7xVIx.jpg', NULL, 4, 4, '2024-08-15 20:10:33', '2024-08-15 20:14:19'),
(5, 'Hanae Hall', 'rujyf@mailinator.com', NULL, '$2y$12$mFm3FkHEuuRtOxqqQ047g.OJTyuM9zXIVQldjnj06r.pZOHBqvZ5G', 'build/assets/images/users/BSUFycrGp4ucieCHVsWjtUx56dklRp6BTOKz81Gn.jpg', NULL, 3, 3, '2024-08-15 20:23:18', '2024-08-20 22:51:04'),
(6, 'Carter Dillon', 'nesinuh@mailinator.com', NULL, '$2y$12$/ChtjOdrmfz84O8B78jBt.BBBXN0KR9GQMJoe5LV4B2w0U4rm92PS', 'build/assets/images/users/G3Q1itLqHD806lV9AYVc6J8RnhwKXCrpvvLXemQJ.jpg', NULL, 4, 4, '2024-08-15 20:27:23', '2024-08-15 20:27:23'),
(7, 'subhan kaManager', 'm@gmail.com', NULL, '$2y$12$LdiLNZtYpAxytzXK93EefuXSeInZA6sclWOd2FovbISrXG3r3rCfi', 'build/assets/images/users/fSnBHz8gOfMXhDmgaZo3cdJv5DXqo3cfd0B7WSja.jpg', NULL, 2, 4, '2024-08-19 19:46:22', '2024-08-20 15:39:17'),
(15, 'Nafees', 'n@gmail.com', NULL, '$2y$12$siBeANAXsFgh5oSgqXEiXuvQAzjdg7GfYe5m2hUdnyuC7hnJTIdDa', 'build/assets/images/users/z0AWJR3H6ioDzNpjgk7Le56LUQcfIf2FQWNaPL2c.jpg', NULL, 3, 4, '2024-08-19 21:04:53', '2024-08-21 18:17:49'),
(16, 'John DOe', 'mz@gmail.com', NULL, '$2y$12$Ds/vFcTPtWWczvdad9mUquw1DclQLwgY1oFdE83inW.z/s7y6d.4a', 'build/assets/images/users/5UVSW8M6AQSo4l7GCd69ggIGXoLY6UXyq895fRsA.jpg', NULL, 2, 3, '2024-08-20 22:56:42', '2024-08-20 22:56:42'),
(17, 'Saad KHan', 'saad@gmail.com', NULL, '$2y$12$xIJNXkOUomtocI30KVzt6OEoOkmZ0lkhx.fFf6QuRBB9hG7zuf9pu', 'build/assets/images/users/zClhVpRJuC0WZyVsC8wprXizCfsaQexYb3I6mzh1.jpg', NULL, 4, 3, '2024-08-22 17:59:06', '2024-08-22 17:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `showroom_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activity_logs`
--

INSERT INTO `user_activity_logs` (`id`, `user_id`, `action`, `showroom_id`, `created_at`) VALUES
(1, 1, 'Updated user: Nafees Email : n@gmail.com', 4, '2024-08-20 15:37:42'),
(2, 1, 'Updated user: Manager Email : m@gmail.com', 4, '2024-08-20 15:39:17'),
(3, 1, 'Updated user: saqib Email : saqib.hussain@abitmuchco.com', 4, '2024-08-20 18:48:52'),
(4, 7, 'Created vehicle: 558 Registration Number : 677', 4, '2024-08-20 22:20:43'),
(5, 7, 'Update vehicle: 55822 Registration Number : 677', 4, '2024-08-20 22:21:29'),
(6, 1, 'Updated user: Hanae Hall Email : rujyf@mailinator.com', 4, '2024-08-20 22:51:04'),
(7, 1, 'Created user: John DOe Email : mz@gmail.com', 4, '2024-08-20 22:56:42'),
(8, 1, 'Updated user: saad Email : saad@abitmuchco.com', 4, '2024-08-20 23:07:40'),
(9, 1, 'Updated user: Nafees Email : n@gmail.com', 3, '2024-08-21 18:17:00'),
(10, 1, 'Updated user: Nafees Email : n@gmail.com', 4, '2024-08-21 18:17:49'),
(11, 1, 'Created user: Saad KHan Email : saad@gmail.com', 3, '2024-08-22 17:59:06');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vin` varchar(255) NOT NULL,
  `make_id` bigint(20) UNSIGNED NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `year_of_manufacture` year(4) NOT NULL,
  `color` varchar(255) NOT NULL,
  `engine_type` varchar(255) NOT NULL,
  `mileage` int(11) NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `showroom_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vin`, `make_id`, `model_id`, `year_of_manufacture`, `color`, `engine_type`, `mileage`, `registration_number`, `owner_id`, `showroom_id`, `created_at`, `updated_at`) VALUES
(2, '2HBNG5678OPLI', 4, 21, '2020', '#f20b39', 'Hybrid', 1000, 'XYZ-987', 4, 3, '2024-08-15 22:46:12', '2024-08-16 19:27:20'),
(3, '1hexagonmkae2324sad', 7, 27, '2022', '#56efe8', 'Hybrid', 15200, 'XBC-234', 4, 4, '2024-08-16 17:12:14', '2024-08-16 22:24:16'),
(4, '1HIKUO908YH5643', 3, 14, '2005', '#020692', 'Petrol', 9999, '165-X', 6, 4, '2024-08-16 21:12:43', '2024-08-16 21:12:43'),
(6, '488', 7, 29, '1973', '#d58ab3', 'Eos aliquam distinc', 63, '386', 5, 3, '2024-08-16 22:36:22', '2024-08-16 22:36:22'),
(7, '55822', 7, 28, '1998', '#560004', 'Doloremque esse prov', 4422, '677', 4, 4, '2024-08-20 22:20:43', '2024-08-20 22:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_makes`
--

CREATE TABLE `vehicle_makes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_makes`
--

INSERT INTO `vehicle_makes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Toyota', '2024-08-15 20:30:42', '2024-08-15 20:30:42'),
(4, 'Nissan', '2024-08-15 20:30:49', '2024-08-15 20:30:49'),
(7, 'Honda', '2024-08-16 15:03:46', '2024-08-16 15:03:46');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `make_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `name`, `make_id`, `created_at`, `updated_at`) VALUES
(1, 'Camry', 3, '2024-08-15 21:09:07', '2024-08-15 21:09:07'),
(2, 'Corolla', 3, '2024-08-15 21:11:35', '2024-08-15 21:11:35'),
(3, 'RAV4', 3, '2024-08-15 21:11:47', '2024-08-15 21:11:47'),
(4, 'Highlander', 3, '2024-08-15 21:12:00', '2024-08-15 21:12:00'),
(5, 'Tacoma', 3, '2024-08-15 21:12:12', '2024-08-15 21:12:12'),
(6, 'Tundra', 3, '2024-08-15 21:12:20', '2024-08-15 21:12:20'),
(7, 'Sienna', 3, '2024-08-15 21:12:27', '2024-08-15 21:12:27'),
(8, '4Runner', 3, '2024-08-15 21:12:34', '2024-08-15 21:12:34'),
(9, 'Prius', 3, '2024-08-15 21:12:42', '2024-08-15 21:12:42'),
(10, 'Venza', 3, '2024-08-15 21:12:50', '2024-08-15 21:12:50'),
(11, 'Avalon', 3, '2024-08-15 21:13:26', '2024-08-15 21:13:26'),
(12, 'Land Cruiser', 3, '2024-08-15 21:13:52', '2024-08-15 21:13:52'),
(13, 'C-HR', 3, '2024-08-15 21:14:26', '2024-08-15 21:14:26'),
(14, 'Supra', 3, '2024-08-15 21:14:35', '2024-08-15 21:14:35'),
(15, 'Yaris', 3, '2024-08-15 21:14:44', '2024-08-15 21:14:44'),
(16, 'Sequoia', 3, '2024-08-15 21:14:53', '2024-08-15 21:14:53'),
(17, 'GR86', 3, '2024-08-15 21:15:00', '2024-08-15 21:15:00'),
(18, 'Mirai', 3, '2024-08-15 21:15:07', '2024-08-15 21:15:07'),
(19, 'Hilux', 3, '2024-08-15 21:15:17', '2024-08-15 21:15:17'),
(20, 'Tundra TRD Pro', 3, '2024-08-15 21:15:27', '2024-08-15 21:15:27'),
(21, 'GT-R', 4, '2024-08-15 21:17:42', '2024-08-15 21:17:42'),
(22, 'Altima', 4, '2024-08-15 21:17:49', '2024-08-15 21:17:49'),
(23, 'Rogue', 4, '2024-08-15 21:17:54', '2024-08-15 21:17:54'),
(24, '370Z', 4, '2024-08-15 21:18:00', '2024-08-15 21:24:39'),
(25, 'Titan', 4, '2024-08-15 21:18:06', '2024-08-15 21:18:06'),
(26, 'Accord', 7, '2024-08-16 15:03:58', '2024-08-16 15:03:58'),
(27, 'Civic', 7, '2024-08-16 15:04:12', '2024-08-16 15:04:12'),
(28, 'CR-V', 7, '2024-08-16 15:04:22', '2024-08-16 15:04:22'),
(29, 'Pilot', 7, '2024-08-16 15:04:32', '2024-08-16 15:04:32'),
(30, 'Odyssey', 7, '2024-08-16 15:04:38', '2024-08-16 15:04:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `services_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `service_items`
--
ALTER TABLE `service_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_items_service_id_foreign` (`service_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `showrooms`
--
ALTER TABLE `showrooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `showrooms_shr_contact_number_unique` (`shr_contact_number`),
  ADD UNIQUE KEY `showrooms_shr_contact_email_unique` (`shr_contact_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `user_activity_logs_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicles_vin_unique` (`vin`),
  ADD UNIQUE KEY `vehicles_registration_number_unique` (`registration_number`),
  ADD KEY `vehicles_make_id_foreign` (`make_id`),
  ADD KEY `vehicles_model_id_foreign` (`model_id`),
  ADD KEY `vehicles_showroom_id_foreign` (`showroom_id`),
  ADD KEY `vehicles_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `vehicle_makes`
--
ALTER TABLE `vehicle_makes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_makes_name_unique` (`name`);

--
-- Indexes for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_models_make_id_foreign` (`make_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `showrooms`
--
ALTER TABLE `showrooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle_makes`
--
ALTER TABLE `vehicle_makes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_items`
--
ALTER TABLE `service_items`
  ADD CONSTRAINT `service_items_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `users_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`);

--
-- Constraints for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  ADD CONSTRAINT `user_activity_logs_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `user_activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `vehicle_makes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_model_id_foreign` FOREIGN KEY (`model_id`) REFERENCES `vehicle_models` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `vehicles_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD CONSTRAINT `vehicle_models_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `vehicle_makes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
