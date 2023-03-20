-- Adminer 4.8.1 MySQL 5.5.5-10.4.21-MariaDB-log dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE DATABASE `inventory_management` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `inventory_management`;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categories` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3,	'Beverage',	1,	1,	NULL,	'2022-12-07 18:07:50',	NULL),
(4,	'Chips',	1,	1,	NULL,	'2022-12-07 18:07:56',	NULL),
(5,	'Biscuits',	1,	1,	NULL,	'2022-12-07 18:08:19',	NULL),
(6,	'Cement',	1,	1,	NULL,	'2022-12-10 13:18:03',	NULL);

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `customers` (`id`, `name`, `customer_image`, `mobile_no`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2,	'Maybelle Mitchell',	'upload/customer/2022_12_02_1629.png',	'+1.443.312.3948',	'olson.lillian@auer.biz',	'97821 Lowe FallsCummingstown, NV 24822',	1,	1,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 16:29:00'),
(3,	'Antwon Feil',	'upload/customer/2022_12_02_1631.png',	'+1-667-688-6193',	'annamarie.ledner@kreiger.com',	'903 Hirthe Camp Apt. 393New Jesus, UT 97332-6785',	1,	1,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 16:31:22'),
(4,	'Margret Rolfson',	'upload/customer/2022_12_02_1623.png',	'484.506.8681',	'cerdman@gmail.com',	'118 Ruthie Junctions Suite 359D\'angeloton, IN 35952',	1,	1,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 16:23:27'),
(5,	'Everette Hagenes',	'upload/customer/2022_12_02_1530.jpg',	'+1-520-374-6433',	'andres43@marvin.com',	'72771 Guadalupe HollowArdenshire, AL 12008-7522',	1,	1,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:30:11'),
(7,	'Ashraful',	NULL,	'+93232424300',	'ashraf@gmail.com',	NULL,	1,	NULL,	NULL,	'2022-12-23 18:37:22',	'2022-12-23 18:37:22'),
(8,	'rafid',	NULL,	'+93232424000',	'rafid@outlook.com',	NULL,	1,	NULL,	NULL,	'2022-12-24 14:51:31',	'2022-12-24 14:51:31'),
(9,	'marko',	NULL,	'+07344353890',	NULL,	NULL,	1,	NULL,	NULL,	'2022-12-26 14:23:25',	'2022-12-26 14:23:25'),
(10,	'sharif',	NULL,	'02323423289',	NULL,	NULL,	1,	NULL,	NULL,	'2022-12-26 14:30:13',	'2022-12-26 14:30:13');

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoices` (`id`, `invoice_no`, `date`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(12,	'1',	'2022-12-24',	NULL,	0,	1,	NULL,	'2022-12-23 19:00:35',	'2022-12-23 19:00:35'),
(13,	'2',	'2022-12-23',	NULL,	1,	1,	1,	'2022-12-23 19:02:51',	'2022-12-26 13:17:42'),
(14,	'3',	'2022-12-23',	'parital paid',	0,	1,	NULL,	'2022-12-23 19:10:14',	'2022-12-23 19:10:14'),
(16,	'4',	'2022-12-24',	'partial paid',	1,	1,	1,	'2022-12-24 14:51:31',	'2022-12-26 14:34:33'),
(17,	'5',	'2022-12-26',	'pepsi 12 piece at 59.50 taka',	1,	1,	1,	'2022-12-26 14:23:25',	'2022-12-26 14:23:51'),
(18,	'6',	'2022-12-26',	'Bashundhara Cement at 20 piece',	1,	1,	1,	'2022-12-26 14:30:13',	'2022-12-26 14:30:29');

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE `invoice_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `product_id` bigint(20) unsigned DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `selling_price` double DEFAULT NULL,
  `selling_quantity` double DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_details_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_details_category_id_foreign` (`category_id`),
  KEY `invoice_details_product_id_foreign` (`product_id`),
  CONSTRAINT `invoice_details_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `invoice_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`),
  CONSTRAINT `invoice_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoice_details` (`id`, `date`, `invoice_id`, `category_id`, `product_id`, `unit_price`, `selling_price`, `selling_quantity`, `status`, `created_at`, `updated_at`) VALUES
(7,	'2022-12-24',	12,	3,	2,	60,	1200,	20,	1,	'2022-12-23 19:00:35',	'2022-12-23 19:00:35'),
(8,	'2022-12-23',	13,	3,	3,	59,	1770,	30,	1,	'2022-12-23 19:02:51',	'2022-12-23 19:02:51'),
(9,	'2022-12-23',	14,	6,	5,	600,	12000,	20,	1,	'2022-12-23 19:10:14',	'2022-12-23 19:10:14'),
(11,	'2022-12-24',	16,	6,	5,	580,	11600,	20,	1,	'2022-12-24 14:51:31',	'2022-12-24 14:51:31'),
(12,	'2022-12-26',	17,	3,	2,	59.5,	714,	12,	1,	'2022-12-26 14:23:25',	'2022-12-26 14:23:25'),
(13,	'2022-12-26',	18,	6,	5,	580,	11600,	20,	1,	'2022-12-26 14:30:13',	'2022-12-26 14:30:13');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7,	'2014_10_12_000000_create_users_table',	1),
(8,	'2014_10_12_100000_create_password_resets_table',	1),
(9,	'2019_08_19_000000_create_failed_jobs_table',	1),
(10,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(11,	'2022_11_29_144724_create_suppliers_table',	1),
(12,	'2022_11_30_153828_create_customers_table',	1),
(13,	'2022_12_07_143526_create_units_table',	2),
(14,	'2022_12_07_151806_create_categories_table',	3),
(15,	'2022_12_08_095113_create_products_table',	4),
(16,	'2022_12_09_085403_create_purchases_table',	5),
(25,	'2022_12_17_142451_create_invoices_table',	6),
(26,	'2022_12_17_142521_create_invoice_details_table',	6),
(27,	'2022_12_17_142543_create_payments_table',	6),
(28,	'2022_12_17_142602_create_payment_details_table',	6);

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `customer_id` bigint(20) unsigned DEFAULT NULL,
  `paid_status` varchar(51) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `due_amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `discount_amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  KEY `payments_customer_id_foreign` (`customer_id`),
  CONSTRAINT `payments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payments` (`id`, `invoice_id`, `customer_id`, `paid_status`, `paid_amount`, `due_amount`, `total_amount`, `discount_amount`, `created_at`, `updated_at`) VALUES
(6,	12,	7,	'partial_paid',	900,	290,	1190,	10,	'2022-12-23 19:00:35',	'2022-12-23 19:00:35'),
(7,	13,	5,	'full_paid',	1760,	0,	1760,	10,	'2022-12-23 19:02:51',	'2023-03-02 16:52:53'),
(8,	14,	3,	'full_paid',	11950,	0,	11950,	50,	'2022-12-23 19:10:14',	'2023-03-06 15:27:18'),
(10,	16,	8,	'partial_paid',	11000,	580,	11580,	20,	'2022-12-24 14:51:31',	'2022-12-24 14:51:31'),
(11,	17,	9,	'full_paid',	709,	0,	709,	5,	'2022-12-26 14:23:25',	'2022-12-26 14:23:25'),
(12,	18,	10,	'partial_paid',	11000,	580,	11580,	20,	'2022-12-26 14:30:13',	'2022-12-26 14:30:13');

DROP TABLE IF EXISTS `payment_details`;
CREATE TABLE `payment_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned DEFAULT NULL,
  `current_paid_amount` double DEFAULT NULL,
  `date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_details_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `payment_details_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `payment_details` (`id`, `invoice_id`, `current_paid_amount`, `date`, `updated_by`, `created_at`, `updated_at`) VALUES
(6,	12,	900,	'2022-12-24',	NULL,	'2022-12-23 19:00:35',	'2022-12-23 19:00:35'),
(7,	13,	900,	'2022-12-23',	NULL,	'2022-12-23 19:02:51',	'2022-12-23 19:02:51'),
(8,	14,	11000,	'2022-12-23',	NULL,	'2022-12-23 19:10:14',	'2022-12-23 19:10:14'),
(10,	16,	11000,	'2022-12-24',	NULL,	'2022-12-24 14:51:31',	'2022-12-24 14:51:31'),
(11,	17,	709,	'2022-12-26',	NULL,	'2022-12-26 14:23:25',	'2022-12-26 14:23:25'),
(12,	18,	11000,	'2022-12-26',	NULL,	'2022-12-26 14:30:13',	'2022-12-26 14:30:13'),
(13,	13,	800,	'2023-03-02',	2,	'2023-03-02 16:50:48',	'2023-03-02 16:50:48'),
(14,	13,	60,	'2023-03-02',	2,	'2023-03-02 16:52:30',	'2023-03-02 16:52:30'),
(15,	13,	0,	'2023-03-02',	2,	'2023-03-02 16:52:53',	'2023-03-02 16:52:53'),
(16,	14,	950,	'2023-03-06',	2,	'2023-03-06 15:27:18',	'2023-03-06 15:27:18');

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `products` (`id`, `name`, `supplier_id`, `category_id`, `unit_id`, `quantity`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2,	'pepsi',	2,	3,	6,	138,	1,	1,	'2022-12-08 12:49:14',	'2022-12-26 14:23:51'),
(3,	'CocaCola',	3,	3,	5,	320,	1,	NULL,	'2022-12-08 12:49:42',	'2022-12-26 13:17:41'),
(4,	'Pran Toast',	1,	5,	6,	120,	1,	1,	'2022-12-08 12:49:59',	'2022-12-08 12:51:02'),
(5,	'Bashundhara Cement',	6,	6,	5,	460,	1,	NULL,	'2022-12-10 14:36:18',	'2022-12-26 14:34:33'),
(6,	'Pran Potato Chips',	2,	4,	5,	500,	1,	NULL,	'2022-12-24 11:06:41',	'2022-12-24 11:06:41');

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `purchase_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_quantity` double NOT NULL,
  `unit_price` double NOT NULL,
  `buying_price` double NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=pending, 1=approved',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `purchases` (`id`, `supplier_id`, `category_id`, `product_id`, `purchase_no`, `date`, `description`, `buying_quantity`, `unit_price`, `buying_price`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(3,	3,	3,	3,	'erw-231',	'2022-12-03',	NULL,	50,	60,	3000,	1,	1,	NULL,	'2022-12-12 13:27:09',	'2022-12-12 16:09:17'),
(4,	3,	3,	2,	'erwew34',	'2022-12-08',	NULL,	50,	65,	3250,	1,	1,	NULL,	'2022-12-12 16:23:00',	'2022-12-12 16:24:42');

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `suppliers` (`id`, `name`, `mobile_no`, `email`, `address`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1,	'Dr. Felton Kulas',	'1-321-298-5020',	'gboyle@lowe.net',	'64341 Bauch Place Apt. 685\nPort Altachester, OH 38643',	1,	NULL,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:02:37'),
(2,	'Korey Ratke',	'534-440-2811',	'santa51@kulas.info',	'7559 Emile Rapids Suite 178\nNorth Fletcherland, NE 48969-0064',	1,	NULL,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:02:37'),
(3,	'Kadin Kuhlman',	'702-423-0125',	'burley.heller@bogan.com',	'234 Fritsch Ridge Apt. 918\nCarterchester, AK 75363-9878',	1,	NULL,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:02:37'),
(4,	'Mallie Von',	'(860) 930-0251',	'hcollier@klocko.com',	'87389 Karson Mews\nNew Dennis, OR 36480-8573',	1,	NULL,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:02:37'),
(5,	'Einar Nicolas MD',	'1-904-860-4489',	'kendra40@hotmail.com',	'15806 Huel Street\nRaetown, SD 48264',	1,	NULL,	NULL,	'2022-12-02 15:02:37',	'2022-12-02 15:02:37'),
(6,	'Bashundhara',	'+073234234255',	'bashundhara@gmail.com',	'Dhaka',	1,	1,	NULL,	'2022-12-10 13:17:41',	NULL);

DROP TABLE IF EXISTS `units`;
CREATE TABLE `units` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `units` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(4,	'kg',	1,	1,	1,	'2022-12-07 15:14:20',	'2022-12-07 15:15:03'),
(5,	'piece',	1,	1,	NULL,	'2022-12-07 18:00:04',	NULL),
(6,	'box',	1,	1,	NULL,	'2022-12-08 12:27:12',	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `profile_image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Jamil',	'jamilpk',	'2022_11_11_1226u3.png',	'jamil@gmail.com',	'2022-11-07 17:20:30',	'$2y$10$097ICaoX1ujbE3mnPVxkJeXuuu4DISenOu.XsiPHofB5nKKByUIMC',	'mP9Y1osbVrVo5pqYw5fPalLiVoYSLkjQAwWI4j1gIXG7zep2DWUAYeUCNBm4',	'2022-11-07 17:20:10',	'2022-11-11 14:09:58'),
(2,	'Ashraf',	'ashraf5',	'2022_11_11_1214u2.png',	'ashraf@gmail.com',	'2022-11-09 13:39:19',	'$2y$10$qPTpvocHgKHJQit1160l4.WdoszxVB58UmOQ0R3cYhNC.ortt1tfy',	'P1Y3OfGA4rvyhtlXuxcpEkKG4ADxyYqbJ6CpfBfPj5iXmIguwxZGvnTe0cQw',	'2022-11-09 13:38:53',	'2022-11-11 14:10:48'),
(3,	'samim',	'samim5',	'2022_11_11_1401u6.jpg',	'samim@gmail.com',	'2022-11-11 14:00:51',	'$2y$10$nxuSoSEu8P7gRM75sYtxlu/1Ak.gICPUFqU2OM33drTbXV1926wdG',	'4aKmxsnZ71hVTCXSY7fEnbMTiahBohNg0sNUtvNI2JJVAzG0d07o4QsTpx0H',	'2022-11-11 14:00:13',	'2022-11-11 14:11:30'),
(4,	'rakib',	'rakib2',	'2022_11_11_1406u5.png',	'rakib@gmail.com',	'2022-11-11 14:05:07',	'$2y$10$VYZ19D0w/xU4iV3H5FQbr.nM/8WCDF7AxWGvZdFuWPydx6rLdivYe',	NULL,	'2022-11-11 14:04:48',	'2022-11-11 14:06:50');

-- 2023-03-20 15:52:31
