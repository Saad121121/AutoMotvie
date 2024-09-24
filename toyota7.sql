-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2024 at 10:09 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toyota7`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` bigint UNSIGNED NOT NULL,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `showroom_id`, `name`, `description`, `price`, `created_at`, `updated_at`) VALUES
(1, 3, 'Spare Tire', 'Facere vel ratione ut quos ullam.', 101.57, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(2, 4, 'Car Charger', 'Et quia voluptas itaque fuga doloremque.', 720.29, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(3, 4, 'Phone Mount', 'Magnam fugit et minima rem dolores.', 438.56, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(4, 3, 'Sunshade', 'Quasi quas sint alias eum.', 96.91, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(5, 6, 'Front Grill', 'Aut velit dolore modi nulla.', 295.17, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(6, 3, 'Car Charger', 'Accusamus alias deleniti perspiciatis sit voluptatum a ipsum.', 523.60, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(7, 3, 'Custom Floor Mats', 'Aut tempora commodi praesentium natus veniam pariatur doloremque.', 679.23, '2024-09-09 02:27:59', '2024-09-09 02:27:59'),
(8, 4, 'Custom Floor Mats', 'Eveniet qui saepe quaerat aliquid.', 134.45, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(10, 4, 'Floor Mats', 'Quo in fugiat nihil consequatur excepturi sed itaque.', 780.95, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(11, 4, 'LED Headlights', 'Voluptas quis provident modi quo neque.', 257.54, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(12, 4, 'Trunk Organizer', 'Doloremque non id reiciendis atque necessitatibus quia.', 990.82, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(13, 3, 'Car Vacuum Cleaner', 'Excepturi at dicta distinctio unde et autem.', 255.92, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(14, 3, 'Phone Mount', 'Quam laborum voluptatem quis fuga sint dolores.', 984.58, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(17, 6, 'Tow Hitch', 'Sapiente tempore corrupti iure beatae qui repellat.', 414.17, '2024-09-09 02:28:00', '2024-09-09 02:28:00'),
(21, 6, 'Sunshade', 'Aut soluta eveniet sunt deleniti.', 735.53, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(22, 3, 'Parking Sensors', 'Error minus quaerat modi dolorem facilis magni beatae.', 566.46, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(23, 3, 'Air Freshener', 'Aspernatur veniam amet velit ut architecto quae.', 286.30, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(24, 4, 'Sunroof Visor', 'Tenetur sapiente et ea eaque aspernatur nihil libero repudiandae.', 541.77, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(25, 4, 'Roof Box', 'Sed repellat reiciendis doloribus ab omnis dolor.', 389.72, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(27, 3, 'Seat Covers', 'Amet voluptatum possimus in non eveniet omnis.', 775.04, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(28, 4, 'Tow Bar', 'Assumenda neque illo soluta sit ut.', 566.20, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(29, 6, 'Backup Camera', 'Nesciunt ratione aspernatur sapiente temporibus.', 571.09, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(30, 6, 'Custom Floor Mats', 'Dolores corporis earum optio suscipit veritatis.', 496.07, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(31, 6, 'Air Freshener', 'Repudiandae ut reprehenderit quis provident provident cupiditate ad hic.', 444.47, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(32, 3, 'Bluetooth Adapter', 'Perspiciatis ducimus maiores aperiam reiciendis.', 474.37, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(33, 6, 'Floor Mats', 'Hic dolor itaque atque odit.', 796.41, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(34, 4, 'Spare Tire', 'Distinctio fugiat molestiae aut et eaque.', 550.34, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(36, 6, 'Throttle Controller', 'Distinctio quo occaecati molestiae ut officiis.', 351.90, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(37, 4, 'Dash Cam', 'Ducimus porro eveniet quam quia cum voluptatem.', 274.77, '2024-09-09 02:28:01', '2024-09-09 02:28:01'),
(40, 6, 'Car Vacuum Cleaner', 'Nisi corrupti sit consequuntur alias rerum.', 910.42, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(42, 3, 'Keyless Entry System', 'Nobis quam commodi magnam id hic quae harum.', 810.67, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(43, 3, 'Windscreen Sun Protector', 'Nobis dolorem vel ipsum.', 53.35, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(45, 4, 'Car Toolkit', 'Ut officia error voluptas quaerat illo fugiat qui.', 463.87, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(46, 4, 'Car Battery Charger', 'In quasi aut aut enim omnis saepe.', 191.59, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(47, 4, 'Tinted Windows', 'Quod fugiat laboriosam in.', 314.20, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(48, 4, 'Car Vacuum Cleaner', 'Quae voluptatem est nam est harum asperiores.', 340.25, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(49, 3, 'Front Grill', 'Repellendus rem dicta voluptatem labore quod.', 499.45, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(50, 4, 'Performance Exhaust', 'Perspiciatis numquam et repellat dignissimos sit omnis.', 868.93, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(51, 4, 'Air Freshener', 'Perspiciatis sit autem ullam exercitationem velit.', 146.19, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(52, 6, 'Windshield Wipers', 'Ducimus similique et et mollitia est eaque.', 380.96, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(53, 3, 'Tinted Windows', 'Quo dignissimos corporis unde non.', 713.87, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(54, 4, 'Windscreen Sun Protector', 'Architecto enim est hic.', 518.63, '2024-09-09 02:28:02', '2024-09-09 02:28:02'),
(55, 6, 'Rearview Mirror Camera', 'Perferendis voluptatum voluptatem consequatur.', 689.68, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(56, 6, 'Roof Box', 'Sint et eum esse eligendi sapiente rerum architecto.', 684.07, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(59, 3, 'Throttle Controller', 'Id eos in occaecati praesentium.', 414.91, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(60, 6, 'Keyless Entry System', 'Illo qui et sed sed asperiores.', 110.63, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(62, 4, 'Sunshade', 'Magni dolorem quam sint qui.', 868.80, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(63, 4, 'Tow Hitch', 'Aliquid inventore saepe tenetur.', 41.31, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(64, 4, 'Oil Filter', 'Dolorum omnis ullam labore deserunt asperiores.', 353.01, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(65, 6, 'Sunroof Visor', 'Delectus quibusdam recusandae rerum velit.', 578.39, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(66, 4, 'Air Freshener', 'Quis quae natus voluptatum reiciendis ab vel.', 343.71, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(67, 6, 'GPS Navigation System', 'Pariatur enim velit qui est.', 977.36, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(68, 4, 'Keyless Entry System', 'Illo enim qui amet assumenda.', 996.52, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(73, 6, 'Performance Exhaust', 'Nam est atque harum inventore quo tempore.', 173.04, '2024-09-09 02:28:03', '2024-09-09 02:28:03'),
(74, 3, 'Air Filter', 'Omnis doloribus qui nam et.', 334.52, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(75, 4, 'Cargo Organizer', 'Saepe sequi totam quia illum non.', 878.93, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(77, 3, 'Sunshade', 'Rerum quia dolorum sed culpa autem.', 156.39, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(78, 3, 'Side Steps', 'Laudantium ut ex est exercitationem.', 241.34, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(79, 3, 'Suspension Kit', 'Nemo et facere voluptatem incidunt id tempore itaque doloribus.', 144.23, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(81, 6, 'Bluetooth Adapter', 'Hic aut quis placeat officiis totam aut.', 126.43, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(85, 4, 'Bluetooth Headset', 'Aliquid soluta qui dignissimos dignissimos iusto.', 642.23, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(87, 6, 'Suspension Kit', 'Ut quia nemo qui et.', 52.10, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(88, 4, 'Rearview Mirror Camera', 'Temporibus iste ut enim earum sint non qui.', 284.54, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(90, 6, 'Cargo Organizer', 'Aut hic aut distinctio consequatur neque esse.', 121.47, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(91, 6, 'Car Cover', 'Natus sint asperiores consequuntur tenetur aut.', 747.54, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(92, 3, 'Parking Sensors', 'Quo aspernatur non quo sed.', 901.28, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(94, 4, 'Roof Railing', 'Magnam id at odio numquam ut sunt omnis non.', 480.32, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(95, 6, 'Parking Sensors', 'Qui ratione asperiores non aut rerum.', 959.81, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(96, 3, 'Tow Bar', 'Et quia debitis dicta aperiam ut at.', 686.43, '2024-09-09 02:28:04', '2024-09-09 02:28:04'),
(97, 3, 'Windshield Wipers', 'Illo et sit voluptatem recusandae corrupti hic quasi.', 231.84, '2024-09-09 02:28:05', '2024-09-09 02:28:05'),
(98, 3, 'Floor Mats', 'Quo provident optio inventore.', 227.54, '2024-09-09 02:28:05', '2024-09-09 02:28:05'),
(100, 3, 'Headlight Covers', 'Dolores incidunt omnis sed rerum est.', 651.36, '2024-09-09 02:28:05', '2024-09-09 02:28:05');

-- --------------------------------------------------------

--
-- Table structure for table `accidents`
--

CREATE TABLE `accidents` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `accident_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accidents`
--

INSERT INTO `accidents` (`id`, `vehicle_id`, `description`, `accident_date`, `created_at`, `updated_at`) VALUES
(2, 11, 'dfasdadsasd', '2024-09-11 21:36:00', '2024-09-11 16:38:43', '2024-09-11 16:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `accident_images`
--

CREATE TABLE `accident_images` (
  `id` bigint UNSIGNED NOT NULL,
  `accident_id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accident_images`
--

INSERT INTO `accident_images` (`id`, `accident_id`, `vehicle_id`, `image_path`, `created_at`, `updated_at`) VALUES
(7, 2, 11, 'images/accident_images/mwRoG9luEgSDWEHk0nBp3vHRR4GGmHtGKEM7Qopn.jpg', '2024-09-11 16:38:44', '2024-09-11 16:38:44');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('michael@gmail.com|173.72.178.220', 'i:1;', 1725907432),
('michael@gmail.com|173.72.178.220:timer', 'i:1725907432;', 1725907432),
('saadkhanva@gmail.com|173.72.178.220', 'i:1;', 1725905705),
('saadkhanva@gmail.com|173.72.178.220:timer', 'i:1725905705;', 1725905705);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
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
(23, '2024_08_22_132441_add_new_columns_in_services_table', 15),
(24, '2024_08_27_102534_create_vehicle_images_table', 16),
(25, '2024_08_28_075640_create_accident_table', 17),
(26, '2024_08_28_080057_create_accident_images_table', 17),
(27, '2024_08_28_120559_add_accident_date_to_accidents_table', 18),
(28, '2024_09_03_232039_create_suppliers_table', 19),
(29, '2024_09_03_232017_create_parts_table', 20),
(30, '2024_09_03_232056_create_part_transactions_table', 20),
(31, '2024_09_03_232115_create_purchase_orders_table', 20),
(32, '2024_09_03_232134_create_purchase_order_items_table', 20),
(33, '2024_09_03_232150_create_returns_table', 20),
(34, '2024_09_03_232201_create_return_actions_table', 20),
(35, '2024_09_05_154802_alter_makes_table_add_columns', 21),
(36, '2024_09_05_165506_alter_vehicle_modelss_table_add_columns', 22),
(37, '2024_09_07_200259_create_promotions_table', 23),
(38, '2024_09_08_175416_create_sales_table', 24),
(40, '2024_09_08_192035_create_accessories_table', 25),
(42, '2024_09_08_211850_create_trade_in_requests_table', 26),
(43, '2024_09_13_160908_create_sell_my_cars_table', 27),
(44, '2024_09_17_185617_add_new_upload_image_to_sell_my_cars_table', 28);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `id` bigint UNSIGNED NOT NULL,
  `part_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `part_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price` decimal(10,0) DEFAULT NULL,
  `supplier_id` bigint UNSIGNED NOT NULL,
  `stock_level` int NOT NULL,
  `reorder_point` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`id`, `part_number`, `part_name`, `category`, `location`, `unit_price`, `supplier_id`, `stock_level`, `reorder_point`, `created_at`, `updated_at`) VALUES
(2, 'PART-KULT6XTX', 'Chain Spocker', 'Tools', 'Tempor labore odit v', 520, 1, 16, 5, '2024-09-05 02:08:33', '2024-09-05 02:08:50'),
(3, 'PART-JUDT6XBU', 'Silencer', 'Vehicle Parts', 'Share faisal', 640, 1, 220, 20, '2024-09-05 02:54:25', '2024-09-05 02:54:44'),
(4, 'PART-G9L2HACI', 'Car Battery Charger', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:39:25', '2024-09-10 02:39:25'),
(5, 'PART-EIJZW1OK', 'Cargo Organizer', 'Accessories', 'ABC', 829, 2, 200, 10, '2024-09-10 02:39:53', '2024-09-10 02:39:53'),
(6, 'PART-0ZMKBTUG', 'Air Freshener', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:40:20', '2024-09-10 02:40:20'),
(7, 'PART-1OX4QIYB', 'LED Headlights', 'Accessories', 'xyz', 829, 1, 200, 10, '2024-09-10 02:40:53', '2024-09-10 02:40:53'),
(8, 'PART-IHDWSD2V', 'Car Vacuum Cleaner', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:41:18', '2024-09-10 02:41:18'),
(9, 'PART-0WYSZ9FS', 'Dash Cam', 'Accessories', 'xyz', 829, 1, 200, 100, '2024-09-10 02:42:00', '2024-09-10 02:42:00'),
(10, 'PART-F86EGII0', 'Oil Filter', 'Accessories', 'xyz', 829, 1, 200, 10, '2024-09-10 02:42:23', '2024-09-10 02:42:23'),
(11, 'PART-D4JUZAAS', 'Keyless Entry System', 'Accessories', 'xyz', 829, 2, 200, 10, '2024-09-10 02:42:45', '2024-09-10 02:42:45'),
(12, 'PART-CBLF0Z7Z', 'Car Toolkit', 'Accessories', 'xyz', 829, 3, 200, 10, '2024-09-10 02:43:58', '2024-09-10 02:43:58'),
(13, 'PART-UCMTND8E', 'Car Vacuum Cleaner', 'Accessories', 'xyz', 829, 3, 200, 10, '2024-09-10 02:44:26', '2024-09-10 02:44:26'),
(14, 'PART-6DM7EFTF', 'Floor Mats', 'Accessories', 'xyz', 829, 2, 200, 10, '2024-09-10 02:44:56', '2024-09-10 02:44:56'),
(15, 'PART-QTO4RXR1', 'Performance Exhaust', 'Accessories', 'ABC', 829, 3, 200, 10, '2024-09-10 02:45:25', '2024-09-10 02:45:25'),
(16, 'PART-DRRSPCUS', 'Car Charger', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:45:44', '2024-09-10 02:45:44'),
(17, 'PART-MKMIHQJZ', 'Bluetooth Headset', 'Accessories', 'ABC', 829, 2, 200, 10, '2024-09-10 02:46:04', '2024-09-10 02:46:04'),
(18, 'PART-P8XU7LZH', 'Trunk Organizer', 'Accessories', 'ABC', 829, 3, 200, 10, '2024-09-10 02:47:19', '2024-09-10 02:47:19'),
(19, 'PART-ZSNXDFHG', 'Phone Mount', 'Accessories', 'xyz', 829, 1, 200, 10, '2024-09-10 02:47:39', '2024-09-10 02:47:39'),
(20, 'PART-ES9IUH8J', 'Windscreen Sun Protector', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:47:55', '2024-09-10 02:47:55'),
(21, 'PART-YBRSQXSK', 'Rearview Mirror Camera', 'Accessories', 'ABC', 829, 2, 200, 10, '2024-09-10 02:48:25', '2024-09-10 02:48:25'),
(23, 'PART-MDSYEUE1', 'Roof Box', 'Accessories', 'xyz', 829, 2, 200, 10, '2024-09-10 02:49:30', '2024-09-10 02:49:30'),
(24, 'PART-LQRNVCEN', 'Tow Hitch', 'Accessories', 'xyz', 829, 2, 200, 10, '2024-09-10 02:50:44', '2024-09-10 02:50:44'),
(25, 'PART-C5ZG8TU9', 'Tow Bar', 'Accessories', 'ABC', 829, 3, 200, 10, '2024-09-10 02:51:16', '2024-09-10 02:51:16'),
(26, 'PART-Y79MJ9UQ', 'Tinted Windows', 'Accessories', 'ABC', 829, 1, 200, 10, '2024-09-10 02:51:42', '2024-09-10 02:51:42'),
(27, 'PART-VFXRL0L0', 'Roof Railing', 'Accessories', 'xyz', 829, 3, 200, 10, '2024-09-10 02:53:09', '2024-09-10 02:53:09'),
(28, 'PART-OEFMMWUK', 'Spare Tire', 'Accessories', 'ABC', 829, 3, 200, 10, '2024-09-10 02:53:32', '2024-09-10 02:53:32'),
(29, 'PART-SE51Z4S7', 'Sunroof Visor', 'Accessories', 'ABC', 829, 3, 200, 10, '2024-09-10 02:53:47', '2024-09-10 02:53:47'),
(30, 'PART-60JMSUMJ', 'Sunshade', 'Accessories', 'xyz', 829, 1, 200, 10, '2024-09-10 02:54:13', '2024-09-10 02:54:13'),
(31, 'PART-AKX0O8RP', 'Engine', 'Vehicle Parts', 'xyz', 829, 1, 200, 10, '2024-09-10 03:02:21', '2024-09-10 03:02:21'),
(32, 'PART-PAMSUQZH', 'Transmission', 'Vehicle Parts', 'ABC', 829, 1, 200, 10, '2024-09-10 03:02:54', '2024-09-10 03:02:54'),
(33, 'PART-RYZ2J21J', 'Alternator', 'Vehicle Parts', 'ABC', 829, 2, 200, 10, '2024-09-10 03:03:21', '2024-09-10 03:03:21'),
(34, 'PART-H4RHGBOS', 'Brake Pads', 'Vehicle Parts', 'xyz', 829, 3, 200, 10, '2024-09-10 03:03:51', '2024-09-10 03:03:51'),
(35, 'PART-PSAAKNG2', 'Radiator', 'Vehicle Parts', 'ABC', 829, 1, 200, 10, '2024-09-10 03:04:12', '2024-09-10 03:04:12'),
(36, 'PART-CMMEHMOW', 'Starter Motor', 'Vehicle Parts', 'xyz', 829, 1, 200, 10, '2024-09-10 03:04:43', '2024-09-10 03:04:43'),
(37, 'PART-GUQFLYY6', 'Suspension Struts', 'Vehicle Parts', 'ABC', 829, 2, 200, 10, '2024-09-10 03:05:03', '2024-09-10 03:05:03'),
(38, 'PART-E7UK0PEW', 'Air Filter', 'Vehicle Parts', 'xyz', 829, 1, 200, 10, '2024-09-10 03:05:36', '2024-09-10 03:05:36'),
(39, 'PART-LPZXLXIJ', 'Timing Belt', 'Vehicle Parts', 'xyz', 829, 3, 200, 10, '2024-09-10 03:05:58', '2024-09-10 03:05:58'),
(40, 'PART-WGV7F3QK', 'Fuel Pump', 'Vehicle Parts', 'xyz', 829, 2, 200, 10, '2024-09-10 03:06:19', '2024-09-10 03:06:19'),
(41, 'PART-WOZ7V4UM', 'Display Stands', 'Showroom Supplies', 'pechs', 829, 3, 200, 10, '2024-09-10 03:06:54', '2024-09-10 03:06:54'),
(42, 'PART-I9ARWOUD', 'Lighting Fixtures', 'Showroom Supplies', 'pechs', 829, 2, 200, 10, '2024-09-10 03:07:12', '2024-09-10 03:07:12'),
(43, 'PART-MMYMBTPO', 'Brochures and Catalogs', 'Showroom Supplies', 'pechs', 829, 3, 200, 10, '2024-09-10 03:07:37', '2024-09-10 03:07:37'),
(44, 'PART-AFV8EXFE', 'Pricing Tags', 'Showroom Supplies', 'pechs', 829, 3, 200, 10, '2024-09-10 03:08:17', '2024-09-10 03:08:17'),
(45, 'PART-2OZW48A0', 'Cleaning Supplies', 'Showroom Supplies', 'xyz', 829, 1, 200, 10, '2024-09-10 03:08:34', '2024-09-10 03:08:34'),
(46, 'PART-GOKTJ26D', 'Customer Seating', 'Showroom Supplies', 'ABC', 829, 1, 200, 10, '2024-09-10 03:08:57', '2024-09-10 03:08:57'),
(47, 'PART-YD7ZVZBO', 'Showcase Cases', 'Showroom Supplies', 'pechs', 829, 1, 200, 10, '2024-09-10 03:09:38', '2024-09-10 03:09:38'),
(48, 'PART-AHVNRKCM', 'Signage', 'Showroom Supplies', 'xyz', 829, 3, 200, 10, '2024-09-10 03:10:02', '2024-09-10 03:10:02'),
(49, 'PART-NPEIB0HT', 'Product Information Boards', 'Showroom Supplies', 'pechs', 829, 1, 200, 10, '2024-09-10 03:10:24', '2024-09-10 03:10:24'),
(50, 'PART-A6OQQCFG', 'Socket Wrench Set', 'Tools', 'pechs', 829, 1, 200, 10, '2024-09-10 03:11:02', '2024-09-10 03:11:02'),
(51, 'PART-WKV6RARU', 'Screwdriver Set', 'Tools', 'pechs', 829, 2, 200, 10, '2024-09-10 03:11:28', '2024-09-10 03:11:28'),
(52, 'PART-SLLLHMPD', 'Torque Wrench', 'Tools', 'xyz', 829, 1, 200, 10, '2024-09-10 03:12:07', '2024-09-10 03:12:07'),
(53, 'PART-J2XO1XTN', 'Diagnostic Scanners', 'Other', 'ABC', 829, 3, 200, 10, '2024-09-10 03:12:33', '2024-09-10 03:12:33'),
(54, 'PART-OFFL3WHC', 'Tow Straps', 'Other', 'xyz', 829, 3, 200, 10, '2024-09-10 03:13:00', '2024-09-10 03:13:00'),
(55, 'PART-ZTIRHWOK', 'First Aid Kits', 'Other', 'pechs', 829, 3, 200, 10, '2024-09-10 03:13:37', '2024-09-10 03:13:37'),
(56, 'PART-HA2ME1RE', 'Pliers', 'Tools', 'pechs', 829, 2, 200, 10, '2024-09-10 03:14:07', '2024-09-10 03:14:07'),
(58, 'PART-GJ5YRD5I', 'Hydraulic Jack', 'Tools', 'pechs', 829, 3, 200, 10, '2024-09-10 03:15:46', '2024-09-10 03:15:46'),
(59, 'PART-9TOJBPL2', 'Vehicle Cleaning Kits', 'Other', 'pechs', 829, 1, 200, 10, '2024-09-10 03:16:44', '2024-09-10 03:16:44'),
(60, 'PART-MAVFLIQU', 'Diagnostic Scanners', 'Other', 'pechs', 829, 2, 200, 10, '2024-09-10 03:17:09', '2024-09-10 03:17:09'),
(61, 'PART-ZDHAO9TS', 'Jump Starters', 'Other', 'pechs', 829, 3, 200, 10, '2024-09-10 03:17:40', '2024-09-10 03:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `part_transactions`
--

CREATE TABLE `part_transactions` (
  `id` bigint UNSIGNED NOT NULL,
  `part_id` bigint UNSIGNED NOT NULL,
  `transaction_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `transaction_date` date NOT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `part_transactions`
--

INSERT INTO `part_transactions` (`id`, `part_id`, `transaction_type`, `quantity`, `transaction_date`, `notes`, `showroom_id`, `created_at`, `updated_at`) VALUES
(1, 3, 'Initial Stock', 123, '2024-09-04', 'Initial stock added when creating part.', 1, '2024-09-05 02:54:25', '2024-09-05 02:54:25'),
(2, 3, 'Stock Increase', 97, '2024-09-04', 'Stock level updated during part update.', 1, '2024-09-05 02:54:44', '2024-09-05 02:54:44'),
(3, 4, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:39:25', '2024-09-10 02:39:25'),
(4, 5, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:39:53', '2024-09-10 02:39:53'),
(5, 6, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:40:20', '2024-09-10 02:40:20'),
(6, 7, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:40:53', '2024-09-10 02:40:53'),
(7, 8, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:41:18', '2024-09-10 02:41:18'),
(8, 9, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:42:00', '2024-09-10 02:42:00'),
(9, 10, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:42:23', '2024-09-10 02:42:23'),
(10, 11, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:42:45', '2024-09-10 02:42:45'),
(11, 12, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:43:58', '2024-09-10 02:43:58'),
(12, 13, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:44:26', '2024-09-10 02:44:26'),
(13, 14, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:44:56', '2024-09-10 02:44:56'),
(14, 15, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:45:25', '2024-09-10 02:45:25'),
(15, 16, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:45:44', '2024-09-10 02:45:44'),
(16, 17, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:46:04', '2024-09-10 02:46:04'),
(17, 18, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:47:19', '2024-09-10 02:47:19'),
(18, 19, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:47:39', '2024-09-10 02:47:39'),
(19, 20, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:47:55', '2024-09-10 02:47:55'),
(20, 21, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:48:25', '2024-09-10 02:48:25'),
(22, 23, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:49:30', '2024-09-10 02:49:30'),
(23, 24, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:50:44', '2024-09-10 02:50:44'),
(24, 25, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:51:16', '2024-09-10 02:51:16'),
(25, 26, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:51:42', '2024-09-10 02:51:42'),
(26, 27, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:53:09', '2024-09-10 02:53:09'),
(27, 28, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:53:32', '2024-09-10 02:53:32'),
(28, 29, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:53:47', '2024-09-10 02:53:47'),
(29, 30, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 02:54:13', '2024-09-10 02:54:13'),
(30, 31, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:02:21', '2024-09-10 03:02:21'),
(31, 32, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:02:54', '2024-09-10 03:02:54'),
(32, 33, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:03:21', '2024-09-10 03:03:21'),
(33, 34, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:03:51', '2024-09-10 03:03:51'),
(34, 35, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:04:12', '2024-09-10 03:04:12'),
(35, 36, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:04:43', '2024-09-10 03:04:43'),
(36, 37, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:05:03', '2024-09-10 03:05:03'),
(37, 38, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:05:36', '2024-09-10 03:05:36'),
(38, 39, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:05:58', '2024-09-10 03:05:58'),
(39, 40, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:06:19', '2024-09-10 03:06:19'),
(40, 41, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:06:55', '2024-09-10 03:06:55'),
(41, 42, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:07:12', '2024-09-10 03:07:12'),
(42, 43, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:07:37', '2024-09-10 03:07:37'),
(43, 44, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:08:17', '2024-09-10 03:08:17'),
(44, 45, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:08:34', '2024-09-10 03:08:34'),
(45, 46, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:08:57', '2024-09-10 03:08:57'),
(46, 47, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:09:38', '2024-09-10 03:09:38'),
(47, 48, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:10:02', '2024-09-10 03:10:02'),
(48, 49, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:10:24', '2024-09-10 03:10:24'),
(49, 50, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:11:03', '2024-09-10 03:11:03'),
(50, 51, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:11:28', '2024-09-10 03:11:28'),
(51, 52, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:12:07', '2024-09-10 03:12:07'),
(52, 53, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:12:33', '2024-09-10 03:12:33'),
(53, 54, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:13:00', '2024-09-10 03:13:00'),
(54, 55, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:13:38', '2024-09-10 03:13:38'),
(55, 56, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:14:08', '2024-09-10 03:14:08'),
(57, 58, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:15:46', '2024-09-10 03:15:46'),
(58, 59, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:16:44', '2024-09-10 03:16:44'),
(59, 60, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:17:09', '2024-09-10 03:17:09'),
(60, 61, 'Initial Stock', 200, '2024-09-09', 'Initial stock added when creating part.', 1, '2024-09-10 03:17:40', '2024-09-10 03:17:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('monkeydmaaz@gmail.com', '$2y$12$pitATaeBOTvjNE7WAvyPrOJRMGs44uH0BXXeL0st4EymHY10CeCOC', '2024-08-22 15:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `promotions`
--

INSERT INTO `promotions` (`id`, `name`, `image`, `details`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(1, 'KARAHI KHAOO', 'jwIc7GYseFCT98f69oGmHfOujlusIXeI7MZxvMTB.jpg', 'saasSAdsaSDAddSASASAFdsfafsdfsdfsdsffds', '2024-09-07', '2024-09-27', '2024-09-08 05:31:01', '2024-09-08 05:31:01'),
(3, 'new test', 'Ln964RqIFYKGAFjrDzcDpalTasvX1Ncf7qy6vBIM.png', 'new promption', '2024-09-10', '2024-09-11', '2024-09-10 16:08:09', '2024-09-10 16:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `id` bigint UNSIGNED NOT NULL,
  `po` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `received_quantity` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`id`, `po`, `showroom_id`, `order_date`, `status`, `total_amount`, `received_quantity`, `created_at`, `updated_at`) VALUES
(6, 'PO-HKZXLBKO', 1, '2024-09-05', 'shipped', 3480.00, NULL, '2024-09-06 03:40:48', '2024-09-09 00:29:09'),
(7, 'PO-YTJJWQXF', 1, '2024-09-05', 'Pending', 4120.00, NULL, '2024-09-06 03:46:20', '2024-09-06 03:46:20'),
(8, 'PO-JD43ZFAP', 1, '2024-09-05', 'Pending', 1160.00, NULL, '2024-09-06 03:47:01', '2024-09-06 03:47:01'),
(9, 'PO-SVOZEMZM', 1, '2024-09-05', 'Pending', 2320.00, NULL, '2024-09-06 03:47:42', '2024-09-06 03:47:42'),
(10, 'PO-QOYCHJZ5', 1, '2024-09-05', 'Pending', 9520.00, NULL, '2024-09-06 03:50:38', '2024-09-06 03:50:38'),
(11, 'PO-RAGOTTRL', 1, '2024-09-06', 'delivered', 44200.00, '85', '2024-09-07 01:15:03', '2024-09-08 04:52:00'),
(12, 'PO-BDVB107C', 1, '2024-09-09', 'Pending', 259250.00, NULL, '2024-09-10 03:37:22', '2024-09-10 03:37:22'),
(13, 'PO-IYPNMHEI', 1, '2024-09-10', 'Pending', 20725.00, '25', '2024-09-10 17:15:09', '2024-09-10 17:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_items`
--

CREATE TABLE `purchase_order_items` (
  `id` bigint UNSIGNED NOT NULL,
  `purchase_order_id` bigint UNSIGNED NOT NULL,
  `part_id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchase_order_items`
--

INSERT INTO `purchase_order_items` (`id`, `purchase_order_id`, `part_id`, `quantity`, `created_at`, `updated_at`) VALUES
(7, 6, 2, 3, '2024-09-06 03:40:48', '2024-09-06 03:40:48'),
(8, 6, 3, 3, '2024-09-06 03:40:48', '2024-09-06 03:40:48'),
(9, 7, 2, 3, '2024-09-06 03:46:20', '2024-09-06 03:46:20'),
(10, 7, 3, 4, '2024-09-06 03:46:20', '2024-09-06 03:46:20'),
(11, 8, 2, 1, '2024-09-06 03:47:01', '2024-09-06 03:47:01'),
(12, 8, 3, 1, '2024-09-06 03:47:01', '2024-09-06 03:47:01'),
(13, 9, 2, 2, '2024-09-06 03:47:42', '2024-09-06 03:47:42'),
(14, 9, 3, 2, '2024-09-06 03:47:42', '2024-09-06 03:47:42'),
(15, 10, 2, 6, '2024-09-06 03:50:38', '2024-09-06 03:50:38'),
(16, 10, 3, 10, '2024-09-06 03:50:38', '2024-09-06 03:50:38'),
(17, 11, 2, 85, '2024-09-07 01:15:03', '2024-09-07 01:15:03'),
(18, 12, 2, 100, '2024-09-10 03:37:22', '2024-09-10 03:37:22'),
(19, 12, 10, 250, '2024-09-10 03:37:22', '2024-09-10 03:37:22'),
(20, 13, 11, 25, '2024-09-10 17:15:09', '2024-09-10 17:15:09');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` bigint UNSIGNED NOT NULL,
  `part_id` bigint UNSIGNED NOT NULL,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `return_date` date NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `return_actions`
--

CREATE TABLE `return_actions` (
  `id` bigint UNSIGNED NOT NULL,
  `return_id` bigint UNSIGNED NOT NULL,
  `action_taken` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `action_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(4, 'Customer', '2024-08-19 15:04:54', '2024-08-19 15:04:54'),
(5, 'Author', '2024-08-27 14:04:07', '2024-08-27 14:04:07');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_license` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_type` enum('new','returning','vip') COLLATE utf8mb4_unicode_ci NOT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mileage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `condition` enum('new','used') COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_features` text COLLATE utf8mb4_unicode_ci,
  `sales_person_name` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sales_date` date NOT NULL,
  `payment_method` enum('cash','financing','lease') COLLATE utf8mb4_unicode_ci NOT NULL,
  `financing_details` text COLLATE utf8mb4_unicode_ci,
  `trade_in_details` text COLLATE utf8mb4_unicode_ci,
  `discounts_offers` text COLLATE utf8mb4_unicode_ci,
  `total_price` decimal(10,2) NOT NULL,
  `warranty_type` enum('standard','extended','none') COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_plan` text COLLATE utf8mb4_unicode_ci,
  `scheduled_delivery_date` date DEFAULT NULL,
  `documents_required` text COLLATE utf8mb4_unicode_ci,
  `signed_contract` enum('yes','no') COLLATE utf8mb4_unicode_ci NOT NULL,
  `regulatory_compliance` text COLLATE utf8mb4_unicode_ci,
  `delivery_method` enum('pickup','delivery') COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `delivery_status` enum('pending','shipped','delivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_instructions` text COLLATE utf8mb4_unicode_ci,
  `comments` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `customer_id`, `invoice_number`, `full_name`, `contact_info`, `driver_license`, `customer_type`, `make`, `model`, `year`, `vin`, `color`, `mileage`, `condition`, `additional_features`, `sales_person_name`, `sales_date`, `payment_method`, `financing_details`, `trade_in_details`, `discounts_offers`, `total_price`, `warranty_type`, `warranty_duration`, `service_plan`, `scheduled_delivery_date`, `documents_required`, `signed_contract`, `regulatory_compliance`, `delivery_method`, `delivery_address`, `delivery_status`, `special_instructions`, `comments`, `created_at`, `updated_at`) VALUES
(2, 'CUST-0HU7N2HU', 'IN-P0NQRMVX', 'Kevin', '(202) 555-0167', 'F123-456-78-901-0', 'new', 'Ford', 'Mustang', '2023', '1FTFW1E57LFB12345', 'Red', '20000', 'used', NULL, 'James', '2024-09-09', 'cash', NULL, NULL, NULL, 4999.00, 'standard', NULL, NULL, '2024-12-09', NULL, 'yes', NULL, 'pickup', NULL, 'pending', NULL, NULL, '2024-09-10 16:44:06', '2024-09-10 16:44:06');

-- --------------------------------------------------------

--
-- Table structure for table `sell_my_cars`
--

CREATE TABLE `sell_my_cars` (
  `id` bigint UNSIGNED NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_area` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_info` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int NOT NULL,
  `price` int NOT NULL,
  `add_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_yaer` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Registered_user` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `upload_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sell_my_cars`
--

INSERT INTO `sell_my_cars` (`id`, `city`, `city_area`, `car_info`, `color`, `mileage`, `price`, `add_description`, `model_yaer`, `model_company`, `company_name`, `Registered_user`, `created_at`, `updated_at`, `upload_image`) VALUES
(1, 'Et dolorem adipisici', 'Cumque quo recusanda', 'Adipisicing duis vol', 'Quo mollitia corrupt', 66, 247, 'Aut dolor exercitati', '2012', 'Cultus', 'Alto', 'Quaerat id aut elige', '2024-09-18 01:53:12', '2024-09-18 01:53:12', NULL),
(2, 'Et dolore dolores fu', 'Amet anim explicabo', 'At atque est in impe', 'Cupiditate velit dol', 59, 24, 'Id veritatis volupta', '2012', 'Cultus', 'Alto', 'Aliquam repudiandae', '2024-09-18 01:57:48', '2024-09-18 01:57:48', 'images/1726581468.jpg'),
(3, 'Et obcaecati ut reic', 'Id tempore aute na', 'Dolor enim quidem re', 'Voluptas do ullamco', 44, 68, 'Modi aperiam ea quid', '2011', 'Honda', 'Corolla', 'Sit cupidatat ea ir', '2024-09-18 01:58:05', '2024-09-18 01:58:05', 'images/1726581485.ico'),
(4, 'Occaecat possimus e', 'Corrupti accusantiu', 'Architecto ducimus', 'Nobis quia eum dolor', 60, 123, 'Quis amet consequat', '2012', 'Cultus', 'Alto', 'Sit et architecto n', '2024-09-18 03:31:26', '2024-09-18 03:31:26', 'images/default_image.jpg'),
(5, 'Dolorem reprehenderi', 'Libero sunt aliqua', 'Amet incididunt ali', 'Et ducimus accusamu', 44, 992, 'Deleniti nihil exerc', '2012', 'Suzuki', 'Civic', 'Dolor ab dolorem eiu', '2024-09-18 03:32:26', '2024-09-18 03:32:26', 'images/default_image.jpg'),
(6, 'Obcaecati ipsa volu', 'Ipsum aute natus ius', 'Rerum duis at aut co', 'Ratione iste non qua', 68, 632, 'Nobis sapiente labor', '2013', 'Cultus', 'Corolla', 'Voluptate qui aliqua', '2024-09-18 04:38:19', '2024-09-18 04:38:19', 'images/1726591099.jpg'),
(7, 'Ut perspiciatis vol', 'Impedit voluptatem', 'Ipsa qui est saepe', 'Adipisicing dolor li', 98, 288, 'Excepteur quae volup', '2013', 'Honda', 'Civic', 'Esse cum mollitia ip', '2024-09-18 04:57:33', '2024-09-18 04:57:33', 'images/default_image.jpg'),
(8, 'Harum maxime aut rei', 'Dolor est voluptatem', 'Quod minima vero vol', 'Debitis veniam in v', 95, 294, 'Est aliquip in ea te', '2011', 'Suzuki', 'Alto', 'Eos necessitatibus', '2024-09-18 06:13:11', '2024-09-18 06:13:11', 'images/1726596791.jpg'),
(9, 'Reprehenderit volup', 'Esse aut sapiente o', 'Impedit aute iusto', 'Consequatur iusto ex', 98, 315, 'Ipsum et consequuntu', '2011', 'Cultus', 'Alto', 'Dolorem voluptatum qyyyyyyyyyyyyy', '2024-09-18 06:13:27', '2024-09-18 06:13:27', 'images/1726596807.jpg'),
(10, 'Labore explicabo Do', 'In iure mollit commo', 'Nihil qui quidem nih', 'Qui possimus laboru', 77, 135, 'Voluptatem error dol', '2012', 'Toyota', 'Civic', 'Qui in alias quidem', '2024-09-18 06:32:26', '2024-09-18 06:32:26', 'images/1726597946.jpg'),
(11, 'Est ipsam a explicab', 'Culpa magna ea offi', 'Sed fugiat soluta se', 'Ut architecto quis u', 41, 842, 'Magnam necessitatibu', '2011', 'Cultus', 'Corolla', 'Et illum in iure to', '2024-09-18 07:40:44', '2024-09-18 07:40:44', 'images/default_image.jpg'),
(12, 'Enim quia atque qui', 'Sit non autem nulla', 'Sit ipsa nulla eos', 'Duis eius est sit fu', 8, 990, 'Ipsum dignissimos qu', '2012', 'Cultus', 'Corolla', 'Nihil ullamco velit', '2024-09-18 09:03:31', '2024-09-18 09:03:31', 'images/1726607011.jpg'),
(13, 'Magnam obcaecati lab', 'Accusantium natus la', 'Qui reprehenderit en', 'Vitae aut natus veli', 26, 743, 'Quos temporibus aut', '2012', 'Honda', 'Corolla', 'Nulla quia iste alia', '2024-09-18 09:06:41', '2024-09-18 09:06:41', 'images/default_image.jpg'),
(14, 'ttttttttttttt', 'Dolorum amet quisqu', 'Dolor id in voluptat', 'A esse quasi beatae', 24, 270, 'Maxime autem aut ut', '2012', 'Honda', 'Civic', 'Laborum aliquid volu', '2024-09-18 09:07:17', '2024-09-18 09:07:17', 'images/default_image.jpg'),
(15, 'Corrupti consectetu', 'Architecto non a nes', 'Adipisicing aliquip', 'Cupiditate voluptate', 87, 24, 'Velit aliquam eiusmo', '2013', 'Suzuki', 'Corolla', 'Aliqua Nam ab modi', '2024-09-18 09:25:25', '2024-09-18 09:25:25', 'images/default_image.jpg'),
(16, 'Quia consequatur ni', 'Cillum quo molestiae', 'Obcaecati sed in fug', 'Sit nesciunt volupt', 37, 748, 'Laborum est aliqua', '2013', 'Civic', 'Toyota', 'Consectetur eum nemo', '2024-09-18 09:29:08', '2024-09-18 09:29:08', 'images/default_image.jpg'),
(17, 'Quam quia delectus', 'Velit facilis veniam', 'Aspernatur beatae de', 'Id veniam laborum e', 90, 578, 'Dolor dolorum sapien', '2013', 'Civic', 'Toyota', 'Amet ullam neque es', '2024-09-18 09:51:32', '2024-09-18 09:51:32', 'images/default_image.jpg'),
(18, 'Ut unde reiciendis i', 'Consequat Nihil ear', 'Nisi exercitationem', 'Quo Nam recusandae', 55, 740, 'Libero id elit id', '2012', 'Civic', 'Honda', 'Libero quis et vitae', '2024-09-18 09:54:39', '2024-09-18 09:54:39', 'images/default_image.jpg'),
(19, 'karachi', 'Cupidatat ut non exe', 'Nulla non laboriosam', 'Quis praesentium con', 90, 574, 'Commodo sint quisqua', '2014', 'Alto', 'Suzuki', 'Quis enim ut nisi di', '2024-09-18 09:56:13', '2024-09-18 09:56:13', 'images/default_image.jpg'),
(20, 'Lahore', 'Quasi earum iure exc', 'Cum et laboriosam s', 'Excepteur quod unde', 21, 625, 'Officiis sunt quisq', '2013', 'Alto', 'Toyota', 'Voluptas dolor sunt', '2024-09-18 09:57:06', '2024-09-18 09:57:06', 'images/default_image.jpg'),
(21, 'Islamaad', 'shahdman hagh', 'Architecto laudantiu', 'Facere ea quod et la', 19, 111, 'Cumque esse molesti', '2014', 'Civic', 'Toyota', 'Doloribus commodi ut', '2024-09-18 09:58:40', '2024-09-18 09:58:40', 'images/default_image.jpg'),
(22, 'Lahore', 'mughal pura', 'Voluptas cumque expe', 'Ut fugiat tempore r', 2, 516, 'Molestiae dolor et p', '2012', 'Corolla', 'Suzuki', 'Possimus provident', '2024-09-18 09:59:02', '2024-09-18 09:59:02', 'images/default_image.jpg'),
(23, 'Lahore', 'Shahdman', 'In molestiae quo neq', 'Fugiat provident c', 1, 978, 'Praesentium dolores', '2013', 'Civic', 'Cultus', 'Eligendi et tenetur', '2024-09-18 10:01:46', '2024-09-18 10:01:46', 'images/default_image.jpg'),
(24, 'Karachi', 'Model Colony', 'Consequatur Mollit', 'Ut nihil in consequa', 60, 769, 'Laudantium labore i', '2012', 'Civic', 'Cultus', 'Ullam et vel dolores', '2024-09-18 10:02:09', '2024-09-18 10:02:09', 'images/default_image.jpg'),
(25, 'Islamabad', 'G-6', 'Cupidatat odit occae', 'Aperiam adipisci at', 75, 567, 'Quia proident lorem', '2014', 'Civic', 'Toyota', 'Sapiente alias velit', '2024-09-18 10:02:45', '2024-09-18 10:02:45', 'images/default_image.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `service_date` date NOT NULL,
  `kilometers_driven` int NOT NULL,
  `service_type` enum('Routine maintenance','Repair','Specific request') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Completed','Upcoming') COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_requests` text COLLATE utf8mb4_unicode_ci,
  `estimated_completion_time` time DEFAULT NULL,
  `cost_estimate` decimal(8,2) DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `vehicle_id`, `showroom_id`, `service_date`, `kilometers_driven`, `service_type`, `status`, `additional_requests`, `estimated_completion_time`, `cost_estimate`, `remarks`, `created_at`, `updated_at`) VALUES
(18, 11, 1, '2010-06-14', 88, 'Repair', 'Completed', 'Corporis aperiam ali', '06:03:00', 15.00, 'Facilis facilis face', '2024-09-10 03:20:30', '2024-09-10 03:20:30'),
(19, 11, 1, '2009-06-28', 90, 'Specific request', 'Completed', 'Fuga Rerum illum c', '23:45:00', 39.00, 'Eligendi alias Nam i', '2024-09-10 04:34:07', '2024-09-10 04:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `service_items`
--

CREATE TABLE `service_items` (
  `id` bigint UNSIGNED NOT NULL,
  `service_id` bigint UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_items`
--

INSERT INTO `service_items` (`id`, `service_id`, `item`, `created_at`, `updated_at`) VALUES
(63, 18, 'Oil Change', '2024-09-10 03:20:30', '2024-09-10 03:20:30'),
(64, 18, 'Brake Inspection', '2024-09-10 03:20:30', '2024-09-10 03:20:30'),
(65, 18, 'Consectetur eu quia', '2024-09-10 03:20:31', '2024-09-10 03:20:31'),
(66, 19, 'Filter Replacement', '2024-09-10 04:34:07', '2024-09-10 04:34:07');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('NAuhkBTsj8C8T6rJvXd16SXnbvrweRJD4NLPUJfT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/128.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicWZlYWVuS2tXRkd2eHN0MER6NXJYNGhveWR2ME9VQXpyTWN4UGN3eCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvc2hvdyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1726610566);

-- --------------------------------------------------------

--
-- Table structure for table `showrooms`
--

CREATE TABLE `showrooms` (
  `id` bigint UNSIGNED NOT NULL,
  `shr_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shr_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shr_contact_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shr_contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `showrooms`
--

INSERT INTO `showrooms` (`id`, `shr_name`, `shr_location`, `shr_contact_number`, `shr_contact_email`, `created_at`, `updated_at`) VALUES
(1, 'Company', 'Desc', '(212) 555-0173', 'Mark@gmail.com', '2024-09-04 14:47:47', '2024-09-04 14:47:47'),
(3, 'Freedom Auto Center', '123 Main Street, Springfield, IL 62701', '(415) 555-0129', 'Freedom-autos@gmail.com', '2024-08-15 18:52:09', '2024-08-16 20:26:29'),
(4, 'Pioneer Motors', '456 Elm Avenue, Los Angeles, CA 90001', '(310) 555-0198', 'PioneerMotors@gmail.com', '2024-08-16 20:26:01', '2024-08-16 20:26:01'),
(6, 'Eagle Valley Auto Group', '789 Pine Street, Miami, FL 33101', '(646) 555-0145', 'Eagle@gmail.com', '2024-08-28 21:41:49', '2024-08-28 21:41:49'),
(7, 'Automall', '202 Oak Lane, Seattle, WA 98101', '(646) 555-0147', 'admin@automall.com', '2024-09-10 03:28:48', '2024-09-10 03:28:48'),
(8, 'dolmen', 'Ducimus aliquam dol', '890', 'dolmen@mailinator.com', '2024-09-11 14:48:54', '2024-09-11 14:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_info` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_time` int NOT NULL,
  `payment_terms` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_info`, `lead_time`, `payment_terms`, `created_at`, `updated_at`) VALUES
(1, 'Daniel', '(212) 555-0173', 33, 'Cash', '2024-09-05 01:40:15', '2024-09-10 16:40:35'),
(2, 'Brian', '(415) 555-0129', 24, 'Online', '2024-09-05 01:41:16', '2024-09-10 16:40:55'),
(3, 'Jonathan', '(646) 555-0145', 300, 'Cash', '2024-09-10 02:43:24', '2024-09-10 16:41:09');

-- --------------------------------------------------------

--
-- Table structure for table `trade_in_requests`
--

CREATE TABLE `trade_in_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` year NOT NULL,
  `mileage` int NOT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` enum('Excellent','Good','Fair','Poor') COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `current_market_value` decimal(10,2) DEFAULT NULL,
  `additional_comments` text COLLATE utf8mb4_unicode_ci,
  `preferred_contact_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trade_in_timing` date NOT NULL,
  `preferred_dealership_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_photos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `trade_in_requests`
--

INSERT INTO `trade_in_requests` (`id`, `full_name`, `email_address`, `phone_number`, `street_address`, `city`, `state`, `zip_code`, `make`, `model`, `year`, `mileage`, `vin`, `condition`, `color`, `current_market_value`, `additional_comments`, `preferred_contact_method`, `trade_in_timing`, `preferred_dealership_location`, `car_photos`, `created_at`, `updated_at`) VALUES
(3, 'Erasmus Sharp', 'mesibux@mailinator.com', '03132456121', 'Labore ducimus proi', 'Veritatis autem sunt', 'Sit cum ipsum occae', '46744', 'Honda', 'Voluptates facilis m', '2009', 10, '586', 'Poor', '#43b896', 81.00, 'Ad aute delectus do', 'Text', '1973-01-13', 'Doris Sears', '\"[\\\"tradeInpics\\\\\\/UmdI8aOGh68xpGi09acvIFk1mSM7qj2X0sIcenp8.png\\\",\\\"tradeInpics\\\\\\/4wTQ0CUlBSlG6zC7GvF7UfEwN6w8EOTSfIACshL0.png\\\",\\\"tradeInpics\\\\\\/vsgs0VUXv66CJ1Au2KBxBSjeBjVZ5rrsD8Kvq1MD.jpg\\\"]\"', '2024-09-09 05:17:27', '2024-09-09 05:17:27'),
(4, 'Victor Mercer', 'fosoja@mailinator.com', '03132465893', '`12AW', 'Karachi', 'Sindh', '123213', 'Ford', 'Mustang', '2021', 6, '668213', 'Excellent', '#000000', 2569322.00, 'Et nisi cum commodo', 'Phone', '2024-08-22', 'Toyota', '\"[\\\"tradeInpics\\\\\\/lY668PSWUNAIPieqAJBTJizdbXKa5Io5gmJtrcLO.jpg\\\",\\\"tradeInpics\\\\\\/5hTx6r1kFv9tju4kR8J3xjdnJqaTAHKvK6VbeE6V.jpg\\\",\\\"tradeInpics\\\\\\/cK22byykS33i6DTsDdGoIr6bvGpVVKjKSF7mms1q.jpg\\\"]\"', '2024-09-09 05:33:45', '2024-09-09 05:33:45'),
(5, 'Sarim ali', 'sarim.ali@gmail.com', '0321-2233654', '3rd street', 'LA', 'California', '90007', 'Honda', 'Civic', '2017', 6321, 'VL-4321', 'Excellent', '#000000', 150000.00, 'No touch ups, original condition', 'Phone', '2024-03-01', 'Automall', '\"[\\\"tradeInpics\\\\\\/xgHm3WCIRVcWqIfWKaukMLXeN8EsHQ4K78hwj98o.jpg\\\"]\"', '2024-09-10 03:57:24', '2024-09-10 03:57:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint UNSIGNED DEFAULT '4',
  `showroom_id` bigint UNSIGNED DEFAULT '6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `role_id`, `showroom_id`, `created_at`, `updated_at`) VALUES
(1, 'Maaz Khan', 'maaz@gmail.com', NULL, '$2y$12$lJWS3CpoNtGcaD..2GBaPeDeVzzogCKeBIGRdXoxw0PfMaZFf/8ay', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', '3es1x6WX0epDDD81zx7De6KqWtKTFjKWEEhTtz45TMhQsPslX35KP3veVC7o', 5, 1, '2024-08-13 17:35:53', '2024-09-18 00:53:08'),
(16, 'dealer', 'dealer@gmail.com', NULL, '$2y$12$bsvPLSb4gCQipmVRQ9DwF.zFG384Etc9Qr.0vnNrQM7L7z9EFmqZe', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 1, 4, '2024-08-20 22:56:42', '2024-09-11 14:51:40'),
(18, 'Company', 'company@gmail.com', NULL, '$2y$12$kZjLq7wVG/8JmBDctU1dguoGKHq9sICpWdRWHdqgJu/YwQboToi02', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', 'fJ9uhSuTajxYEeIRNwzOhKrNkOa0H458aTNFOSKft5FbZoKBuwjPBJMNG79c', 5, 1, '2024-09-05 03:12:30', '2024-09-11 17:09:08'),
(24, 'William James', 'william_james@gmail.com', NULL, '$2y$12$bsvPLSb4gCQipmVRQ9DwF.zFG384Etc9Qr.0vnNrQM7L7z9EFmqZe', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 2, 3, '2024-09-09 23:16:52', '2024-09-09 23:16:52'),
(25, 'Charlotte Elizabeth', 'charlotte_elizabeth@gmail.com', NULL, '$2y$12$IMCbYOeTGqjMxfNrLXncluju1zdzXI1H3gpsKqrBOJ8DZTuG5PjQa', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 3, 3, '2024-09-09 23:18:46', '2024-09-09 23:19:07'),
(26, 'Mason Oliver', 'Mason@gmail.com', NULL, '$2y$12$s14CZ8dzqkHfvageqTIyTu64V.HCpTiENwChPvv9vhkvtdA6kgrwO', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 4, 4, '2024-09-10 00:41:42', '2024-09-10 00:53:05'),
(27, 'David Miller', 'david@gmail.com', NULL, '$2y$12$oRGJlgKvRqeciqkf4c7Y1.ckPa/nSbGnGzq23Rc3ixiN21ChksRaO', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 4, 6, '2024-09-10 00:55:01', '2024-09-10 00:55:01'),
(28, 'Thomas', 'Thomas@gmail.com', NULL, '$2y$12$bsvPLSb4gCQipmVRQ9DwF.zFG384Etc9Qr.0vnNrQM7L7z9EFmqZe', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 4, 6, '2024-09-10 03:36:28', '2024-09-10 16:39:41'),
(29, 'Robert', 'Robert@gmail.com', NULL, '$2y$12$zWLKINrH3I3sbjFw7x/JQOxaxiO5cH6XUFTtgN29SMMtZ01Na4J.e', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 4, 6, '2024-09-10 05:25:37', '2024-09-10 16:39:32'),
(30, 'James', 'James@gmail.com', NULL, '$2y$12$bAd12Kpv7OSJDS.0N6150u2MkMkjLVCbqFohuK6qTLX/mx8qNn7/i', '5x41ZrV9xoO2kPOFTjAeoxbbvr20kUqG2NaTfXN3.png', NULL, 4, 7, '2024-09-09 18:04:13', '2024-09-10 16:39:08'),
(31, 'Dolmen', 'dolmen@gmail.com', NULL, '$2y$12$UHiYr88hT7nlDvE.XNiyUea90pftYLwiw1WH7NxadDJERHiN3/IPS', '4ffpRWToJtpfO55nnwsGcHfzNj8KTxYegJSuPV9B.png', NULL, 1, 8, '2024-09-11 14:53:16', '2024-09-11 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_logs`
--

CREATE TABLE `user_activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `showroom_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_activity_logs`
--

INSERT INTO `user_activity_logs` (`id`, `user_id`, `action`, `showroom_id`, `created_at`) VALUES
(1, 1, 'Updated user: Nafees Email : n@gmail.com', 4, '2024-08-20 15:37:42'),
(2, 1, 'Updated user: Manager Email : m@gmail.com', 4, '2024-08-20 15:39:17'),
(3, 1, 'Updated user: saqib Email : saqib.hussain@abitmuchco.com', 4, '2024-08-20 18:48:52'),
(6, 1, 'Updated user: Hanae Hall Email : rujyf@mailinator.com', 4, '2024-08-20 22:51:04'),
(7, 1, 'Created user: John DOe Email : mz@gmail.com', 4, '2024-08-20 22:56:42'),
(8, 1, 'Updated user: saad Email : saad@abitmuchco.com', 4, '2024-08-20 23:07:40'),
(9, 1, 'Updated user: Nafees Email : n@gmail.com', 3, '2024-08-21 18:17:00'),
(10, 1, 'Updated user: Nafees Email : n@gmail.com', 4, '2024-08-21 18:17:49'),
(11, 1, 'Created user: Saad KHan Email : saad@gmail.com', 3, '2024-08-22 17:59:06'),
(12, 1, 'Created vehicle: OCTAGRAM Registration Number : QWZ-9009', 3, '2024-08-27 18:44:42'),
(13, 1, 'Deleted vehicle: PENTAGRAM Registration Number : XYC-990', 3, '2024-08-27 19:09:50'),
(14, 1, 'Created vehicle: PENTAGRAM Registration Number : XDF-899', 3, '2024-08-27 19:12:58'),
(15, 1, 'Update vehicle: OCTAGRAM Registration Number : QWZ-9009', 3, '2024-08-27 20:30:22'),
(16, 1, 'Update vehicle: PENTAGRAM Registration Number : XDF-899', 3, '2024-08-27 20:32:49'),
(17, 1, 'Update vehicle: OCTAGRAM Registration Number : QWZ-9009', 3, '2024-08-27 20:45:45'),
(18, 1, 'Update vehicle: OCTAGRAM Registration Number : QWZ-9009', 3, '2024-08-27 21:28:08'),
(19, 1, 'Created Showroom Name: Doris Sears Contact Number : 03132569874', NULL, '2024-08-28 21:41:49'),
(20, 1, 'Updated user: David Beckham Email : David@gmail.com', 3, '2024-08-28 23:59:38'),
(21, 1, 'Created Vehicle Make: Lamborgni', NULL, '2024-09-04 00:40:00'),
(22, 1, 'Created Vehicle model: Urus', NULL, '2024-09-04 00:40:12'),
(23, 1, 'Created user: Company X Email : company@gmail.com', 1, '2024-09-05 03:12:30'),
(24, 1, 'Updated user: Dealer Email : Dealer@gmail.com', 1, '2024-09-05 03:13:25'),
(25, 1, 'Updated user: David Beckham Email : David@gmail.com', 1, '2024-09-05 03:14:34'),
(26, 18, 'Updated user: saad Email : saad@abitmuchco.com', 1, '2024-09-05 03:18:37'),
(27, 18, 'Deleted user: saad Email : saad@abitmuchco.com', 1, '2024-09-05 03:20:04'),
(28, 18, 'Updated user: Dealer Email : Dealer@gmail.com', 1, '2024-09-05 03:20:40'),
(29, 18, 'Updated user: Dealer Email : Dealer@gmail.com', 1, '2024-09-05 03:20:55'),
(30, 18, 'Created user: Kaleem ullah Email : Kaleem@gmail.com', 1, '2024-09-05 03:30:57'),
(31, 18, 'Created user: Zephania Levy Email : taforacunu@mailinator.com', 1, '2024-09-05 03:34:33'),
(32, 18, 'Created user: Burton Little Email : mulava@mailinator.com', 1, '2024-09-05 03:38:07'),
(33, 18, 'Deleted user: Burton Little Email : mulava@mailinator.com', 1, '2024-09-05 03:38:51'),
(34, 18, 'Deleted user: Zephania Levy Email : taforacunu@mailinator.com', 1, '2024-09-05 03:38:59'),
(35, 18, 'Created user: Benedict Hoffman Email : zupaziwa@mailinator.com', 1, '2024-09-05 03:43:50'),
(36, 1, 'Deleted Vehicle Make: GMC', 1, '2024-09-05 23:15:37'),
(37, 1, 'Updated Vehicle Make: Lamborgni', 1, '2024-09-05 23:15:52'),
(38, 1, 'Created Vehicle Make: Sasdadsa', 1, '2024-09-05 23:18:21'),
(39, 1, 'Deleted Vehicle Make: Sasdadsa', 1, '2024-09-05 23:19:45'),
(40, 1, 'Created Vehicle Make: Iris Goodwin', 1, '2024-09-05 23:19:53'),
(41, 1, 'Deleted Vehicle Make: Iris Goodwin', 1, '2024-09-05 23:20:47'),
(42, 1, 'Created Vehicle Make: Isabella Romero', 1, '2024-09-05 23:20:56'),
(43, 1, 'Updated Vehicle Make: Isabella Romero', 1, '2024-09-05 23:26:02'),
(44, 1, 'Updated Vehicle Make: Isabella Romero', 1, '2024-09-05 23:30:01'),
(45, 1, 'Updated Vehicle Make: Lamborgni', 1, '2024-09-05 23:38:10'),
(46, 1, 'Updated Vehicle Make: Isabella Romero', 1, '2024-09-05 23:38:15'),
(47, 1, 'Updated Vehicle Make: Lamborgni', 1, '2024-09-05 23:38:25'),
(48, 1, 'Updated Vehicle Make: Honda', 1, '2024-09-05 23:38:32'),
(49, 1, 'Updated Vehicle Make: Nissan', 1, '2024-09-05 23:38:40'),
(50, 1, 'Created Vehicle model: Passport', 1, '2024-09-06 00:08:36'),
(51, 1, 'Deleted Vehicle model: Passport', 1, '2024-09-06 00:16:48'),
(52, 1, 'Created Vehicle model: Passport', 1, '2024-09-06 00:17:35'),
(53, 1, 'Updated Vehicle model: Michael Stone', 1, '2024-09-06 01:00:25'),
(54, 1, 'Deleted Vehicle model: Michael Stone', 1, '2024-09-06 01:00:33'),
(55, 1, 'Created Vehicle model: Temerario', 1, '2024-09-06 01:08:57'),
(56, 1, 'Created user: Odette Chang Email : kolu@mailinator.com', 1, '2024-09-09 22:26:49'),
(57, 1, 'Deleted user: Odette Chang Email : kolu@mailinator.com', 1, '2024-09-09 22:31:49'),
(58, 1, 'Updated user: David Miller Email : David@gmail.com', 1, '2024-09-09 22:35:16'),
(59, 1, 'Updated user: David Miller Email : David@gmail.com', 1, '2024-09-09 22:37:55'),
(60, 1, 'Updated user: Company Email : company@gmail.com', 1, '2024-09-09 22:41:27'),
(61, 1, 'Updated user: David Miller Email : David@gmail.com', 1, '2024-09-09 22:46:13'),
(62, 1, 'Updated user: Michael Thompson Email : Michael@gmail.com', 1, '2024-09-09 22:46:24'),
(63, 1, 'Updated user: subhan kaManager Email : m@gmail.com', 1, '2024-09-09 22:46:35'),
(64, 1, 'Updated user: Carter Dillon Email : nesinuh@mailinator.com', 1, '2024-09-09 22:46:51'),
(65, 1, 'Updated user: Hanae Hall Email : rujyf@mailinator.com', 1, '2024-09-09 22:47:12'),
(66, 1, 'Updated user: Saleem11 Email : saleem@gmail.com', 1, '2024-09-09 22:47:24'),
(67, 1, 'Deleted user: subhan kaManager Email : m@gmail.com', 1, '2024-09-09 22:49:43'),
(68, 1, 'Created user: William James Email : william_james@gmail.com', 1, '2024-09-09 23:16:52'),
(69, 1, 'Created user: Charlotte Elizabeth Email : charlotte_elizabeth@gmail.com', 1, '2024-09-09 23:18:47'),
(70, 1, 'Updated user: Charlotte Elizabeth Email : charlotte_elizabeth@gmail.com', 1, '2024-09-09 23:19:07'),
(71, 1, 'Updated user: Michael Thompson Email : Michael@gmail.com', 1, '2024-09-09 23:45:26'),
(72, 1, 'Created user: Mason Oliver Email : Mason@gmail.com', 1, '2024-09-10 00:41:42'),
(73, 1, 'Updated user: Mason Oliverr Email : Mason@gmail.com', 1, '2024-09-10 00:52:33'),
(74, 1, 'Updated user: Mason Oliver Email : Mason@gmail.com', 1, '2024-09-10 00:53:05'),
(75, 1, 'Deleted user: David Miller Email : David@gmail.com', 1, '2024-09-10 00:53:38'),
(76, 1, 'Created user: David Miller Email : david@gmail.com', 1, '2024-09-10 00:55:01'),
(77, 1, 'Created vehicle: MNB-1223 Registration Number : XYZ-123', 1, '2024-09-10 01:22:44'),
(78, 1, 'Created Showroom Name: Automall Contact Number : 03132106653', NULL, '2024-09-10 03:28:48'),
(79, 1, 'Created user: Saqib Email : saqib@gmail.com', 1, '2024-09-10 03:36:28'),
(80, 1, 'Created user: Hadi again Email : hadiagain@gmail.com', 1, '2024-09-09 18:04:13'),
(81, 18, 'Updated user: James Email : James@gmail.com', 1, '2024-09-10 16:39:08'),
(82, 18, 'Updated user: Robert Email : Robert@gmail.com', 1, '2024-09-10 16:39:32'),
(83, 18, 'Updated user: Thomas Email : Thomas@gmail.com', 1, '2024-09-10 16:39:41'),
(84, 18, 'Created Showroom Name: dolmen Contact Number : 890', NULL, '2024-09-11 14:48:54'),
(85, 18, 'Updated user: dealer Email : dealer@gmail.com', 1, '2024-09-11 14:51:23'),
(86, 18, 'Updated user: dealer Email : dealer@gmail.com', 1, '2024-09-11 14:51:40'),
(87, 18, 'Created user: Dolmen Email : dolmen@gmail.com', 1, '2024-09-11 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` bigint UNSIGNED NOT NULL,
  `vin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_id` bigint UNSIGNED NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `year_of_manufacture` year NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engine_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mileage` int NOT NULL,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` bigint UNSIGNED NOT NULL,
  `showroom_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vin`, `make_id`, `model_id`, `year_of_manufacture`, `color`, `engine_type`, `mileage`, `registration_number`, `owner_id`, `showroom_id`, `created_at`, `updated_at`) VALUES
(11, 'MNB-1223', 7, 26, '2020', '#000000', 'Diesel', 1200, 'XYZ-123', 27, 1, '2024-09-10 01:22:43', '2024-09-10 01:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_images`
--

CREATE TABLE `vehicle_images` (
  `id` bigint UNSIGNED NOT NULL,
  `vehicle_id` bigint UNSIGNED NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_images`
--

INSERT INTO `vehicle_images` (`id`, `vehicle_id`, `image_path`, `created_at`, `updated_at`) VALUES
(9, 11, 'images/vehicle_images/vtUROYkAjNFrBnj7ndXRWGHuYz6K1pRiqWGECjRB.jpg', '2024-09-10 01:22:44', '2024-09-10 01:22:44'),
(10, 11, 'images/vehicle_images/6l5xVv8r1ezObEFFeCNznuMaTu8beJ0S7ffWwPXG.jpg', '2024-09-10 01:22:44', '2024-09-10 01:22:44');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_makes`
--

CREATE TABLE `vehicle_makes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_of_origin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year_established` int DEFAULT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_makes`
--

INSERT INTO `vehicle_makes` (`id`, `name`, `country_of_origin`, `year_established`, `vehicle_type`, `created_at`, `updated_at`) VALUES
(3, 'Toyota', 'Palestine', 1985, 'Convertible', '2024-08-15 20:30:42', '2024-08-15 20:30:42'),
(4, 'Nissan', 'Malaysia', 1986, 'Hatchback', '2024-08-15 20:30:49', '2024-09-05 23:38:40'),
(7, 'Honda', 'Germany', 1999, 'SUV', '2024-08-16 15:03:46', '2024-09-05 23:38:32'),
(8, 'Lamborghini', 'New Zealand', 1852, 'Truck', '2024-09-04 00:40:00', '2024-09-05 23:38:25');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_models`
--

CREATE TABLE `vehicle_models` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `make_id` bigint UNSIGNED NOT NULL,
  `year_of_release` int DEFAULT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transmission_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `body_style` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `engine_capacity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `horsepower` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `torque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_models`
--

INSERT INTO `vehicle_models` (`id`, `name`, `make_id`, `year_of_release`, `fuel_type`, `transmission_type`, `body_style`, `engine_type`, `engine_capacity`, `horsepower`, `torque`, `created_at`, `updated_at`) VALUES
(1, 'Camry', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:09:07', '2024-08-15 21:09:07'),
(2, 'Corolla', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:11:35', '2024-08-15 21:11:35'),
(3, 'RAV4', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:11:47', '2024-08-15 21:11:47'),
(4, 'Highlander', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:00', '2024-08-15 21:12:00'),
(5, 'Tacoma', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:12', '2024-08-15 21:12:12'),
(6, 'Tundra', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:20', '2024-08-15 21:12:20'),
(7, 'Sienna', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:27', '2024-08-15 21:12:27'),
(8, '4Runner', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:34', '2024-08-15 21:12:34'),
(9, 'Prius', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:42', '2024-08-15 21:12:42'),
(10, 'Venza', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:12:50', '2024-08-15 21:12:50'),
(11, 'Avalon', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:13:26', '2024-08-15 21:13:26'),
(12, 'Land Cruiser', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:13:52', '2024-08-15 21:13:52'),
(13, 'C-HR', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:14:26', '2024-08-15 21:14:26'),
(14, 'Supra', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:14:35', '2024-08-15 21:14:35'),
(15, 'Yaris', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:14:44', '2024-08-15 21:14:44'),
(16, 'Sequoia', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:14:53', '2024-08-15 21:14:53'),
(17, 'GR86', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:15:00', '2024-08-15 21:15:00'),
(18, 'Mirai', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:15:07', '2024-08-15 21:15:07'),
(19, 'Hilux', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:15:17', '2024-08-15 21:15:17'),
(20, 'Tundra TRD Pro', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:15:27', '2024-08-15 21:15:27'),
(21, 'GT-R', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:17:42', '2024-08-15 21:17:42'),
(22, 'Altima', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:17:49', '2024-08-15 21:17:49'),
(23, 'Rogue', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:17:54', '2024-08-15 21:17:54'),
(24, '370Z', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:18:00', '2024-08-15 21:24:39'),
(25, 'Titan', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-15 21:18:06', '2024-08-15 21:18:06'),
(26, 'Accord', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 15:03:58', '2024-08-16 15:03:58'),
(27, 'Civic', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 15:04:12', '2024-08-16 15:04:12'),
(28, 'CR-V', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 15:04:22', '2024-08-16 15:04:22'),
(29, 'Pilot', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 15:04:32', '2024-08-16 15:04:32'),
(30, 'Odyssey', 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-08-16 15:04:38', '2024-08-16 15:04:38'),
(33, 'Passport', 7, 1997, 'Diesel', 'Manual', 'Sedan', 'v9', '3.5', '220', '250', '2024-09-06 00:17:35', '2024-09-06 00:17:35'),
(34, 'Temerario', 8, 2020, 'Diesel', 'Automatic', 'Coupe', 'VX9', '3.3', '2500', '5000', '2024-09-06 01:08:57', '2024-09-06 01:08:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accessories_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `accidents`
--
ALTER TABLE `accidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accidents_vehicle_id_foreign` (`vehicle_id`);

--
-- Indexes for table `accident_images`
--
ALTER TABLE `accident_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accident_images_accident_id_foreign` (`accident_id`),
  ADD KEY `accident_images_vehicle_id_foreign` (`vehicle_id`);

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
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parts_part_number_unique` (`part_number`),
  ADD KEY `parts_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `part_transactions`
--
ALTER TABLE `part_transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_transactions_part_id_foreign` (`part_id`),
  ADD KEY `part_transactions_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_orders_po_unique` (`po`),
  ADD KEY `purchase_orders_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_items_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_order_items_part_id_foreign` (`part_id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `returns_part_id_foreign` (`part_id`),
  ADD KEY `returns_showroom_id_foreign` (`showroom_id`);

--
-- Indexes for table `return_actions`
--
ALTER TABLE `return_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_actions_return_id_foreign` (`return_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_vin_unique` (`vin`),
  ADD UNIQUE KEY `sales_sales_order_id_unique` (`sales_person_name`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `invoice_number` (`invoice_number`);

--
-- Indexes for table `sell_my_cars`
--
ALTER TABLE `sell_my_cars`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_in_requests`
--
ALTER TABLE `trade_in_requests`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_images_vehicle_id_foreign` (`vehicle_id`);

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
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `accidents`
--
ALTER TABLE `accidents`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `accident_images`
--
ALTER TABLE `accident_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `parts`
--
ALTER TABLE `parts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `part_transactions`
--
ALTER TABLE `part_transactions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `return_actions`
--
ALTER TABLE `return_actions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sell_my_cars`
--
ALTER TABLE `sell_my_cars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service_items`
--
ALTER TABLE `service_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `showrooms`
--
ALTER TABLE `showrooms`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `trade_in_requests`
--
ALTER TABLE `trade_in_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_activity_logs`
--
ALTER TABLE `user_activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vehicle_makes`
--
ALTER TABLE `vehicle_makes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accessories`
--
ALTER TABLE `accessories`
  ADD CONSTRAINT `accessories_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `accidents`
--
ALTER TABLE `accidents`
  ADD CONSTRAINT `accidents_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `accident_images`
--
ALTER TABLE `accident_images`
  ADD CONSTRAINT `accident_images_accident_id_foreign` FOREIGN KEY (`accident_id`) REFERENCES `accidents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `accident_images_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
  ADD CONSTRAINT `parts_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `part_transactions`
--
ALTER TABLE `part_transactions`
  ADD CONSTRAINT `part_transactions_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `part_transactions_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_order_items`
--
ALTER TABLE `purchase_order_items`
  ADD CONSTRAINT `purchase_order_items_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_items_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `returns`
--
ALTER TABLE `returns`
  ADD CONSTRAINT `returns_part_id_foreign` FOREIGN KEY (`part_id`) REFERENCES `parts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `returns_showroom_id_foreign` FOREIGN KEY (`showroom_id`) REFERENCES `showrooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `return_actions`
--
ALTER TABLE `return_actions`
  ADD CONSTRAINT `return_actions_return_id_foreign` FOREIGN KEY (`return_id`) REFERENCES `returns` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `vehicle_images`
--
ALTER TABLE `vehicle_images`
  ADD CONSTRAINT `vehicle_images_vehicle_id_foreign` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle_models`
--
ALTER TABLE `vehicle_models`
  ADD CONSTRAINT `vehicle_models_make_id_foreign` FOREIGN KEY (`make_id`) REFERENCES `vehicle_makes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
