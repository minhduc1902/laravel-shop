-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 14, 2023 lúc 03:52 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `online_shop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(9, 'Việt Nam', 'viet-nam', 1, '2023-10-25 21:30:27', '2023-11-21 02:54:03'),
(10, 'Nhật Bản', 'nhat-ban', 1, '2023-10-25 21:37:46', '2023-11-21 02:54:15'),
(11, 'Hàn Quốc', 'han-quoc', 1, '2023-10-25 21:50:32', '2023-11-21 02:56:07'),
(12, 'Đức', 'duc', 1, '2023-10-25 23:47:37', '2023-11-21 02:56:21'),
(13, 'Mỹ', 'my', 0, '2023-10-25 23:53:13', '2023-11-21 02:56:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(43, 'Áo nam', 'ao-nam', 1, 'Yes', '2023-11-06 20:52:25', '2023-11-06 20:53:50'),
(44, 'Áo nữ', 'ao-nu', 1, 'Yes', '2023-11-06 20:52:34', '2023-11-06 20:53:59'),
(45, 'Quần nam', 'quan-nam', 1, 'Yes', '2023-11-06 20:52:42', '2023-11-06 20:54:08'),
(46, 'Quần nữ', 'quan-nu', 1, 'Yes', '2023-11-06 20:54:16', '2023-11-06 20:54:16'),
(47, 'Trẻ em', 'tre-em', 0, 'Yes', '2023-11-06 20:54:27', '2023-11-06 20:54:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `country`, `address`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', 'admin', 'minhduc190201@gmail.com', 'admin', 'hai bà trưng', '0981371108', '2023-11-02 09:07:24', '2023-11-03 01:57:00'),
(2, 3, 'Nguyen', 'Nam', 'asd@gmail.com', 'Ha Noi', '55 Giai phong', '012345679', '2023-11-23 03:40:16', '2023-11-23 03:40:16'),
(3, 5, 'Nam', 'Man', 'nam@gmail.com', 'HCM', '798 Thanh pho HCM', '987654321', '2023-11-23 07:02:06', '2023-11-23 07:02:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_10_18_024653_alter_users_table', 2),
(6, '2023_10_18_063820_create_categories_table', 3),
(14, '2023_10_19_065845_create_sub_categories_table', 7),
(15, '2023_10_19_075334_create_brands_table', 8),
(16, '2023_10_19_095839_create_products_table', 9),
(17, '2023_10_19_095907_create_product_image_table', 9),
(18, '2023_10_24_024400_create_temp_images', 10),
(19, '2023_10_25_092813_alter_categories_table', 11),
(20, '2023_10_25_093936_alter_products_table', 12),
(21, '2023_10_25_095036_alter_sub_categories_table', 13),
(22, '2023_10_27_091035_alter_products_table', 14),
(23, '2023_11_01_093123_alter_users_table', 15),
(24, '2023_11_02_033620_create_orders_table', 16),
(25, '2023_11_02_033659_create_customer_addresses_table', 17),
(26, '2023_11_02_143157_create_order_items_table', 17),
(27, '2023_11_03_094205_alter_orders_table', 18),
(28, '2023_11_06_085853_alter_orders_table', 19),
(29, '2023_11_09_114937_alter_users_table', 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `grand_total` int(10) NOT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `grand_total`, `payment_status`, `status`, `last_name`, `email`, `country`, `address`, `mobile`, `first_name`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 400000, 'not paid', 'delivered', 'bcd', 'minhduc190201@gmail.com', 'bcd', 'hai bà trưng', '0981371108', 'bcd', 'bcd', '2023-11-03 01:42:17', '2023-11-16 05:02:52'),
(2, 1, 600000, 'not paid', 'shipped', 'admin', 'minhduc190201@gmail.com', 'admin', 'hai bà trưng', '0981371108', 'admin', 'admin', '2023-11-03 01:57:00', '2023-11-16 05:02:36'),
(3, 3, 1184000, 'not paid', 'pending', 'Nam', 'asd@gmail.com', 'Ha Noi', '55 Giai phong', '012345679', 'Nguyen', NULL, '2023-11-23 03:40:17', '2023-11-23 03:40:17'),
(4, 3, 422000, 'not paid', 'pending', 'Nam', 'asd@gmail.com', 'Ha Noi', '55 Giai phong', '012345679', 'Nguyen', NULL, '2023-11-23 06:44:45', '2023-11-23 06:44:45'),
(5, 3, 1011000, 'not paid', 'pending', 'Nam', 'asd@gmail.com', 'Ha Noi', '55 Giai phong', '012345679', 'Nguyen', NULL, '2023-11-23 06:45:27', '2023-11-23 06:45:27'),
(6, 1, 765000, 'not paid', 'pending', 'admin', 'minhduc190201@gmail.com', 'admin', 'hai bà trưng', '0981371108', 'admin', NULL, '2023-11-23 06:46:43', '2023-11-23 06:46:43'),
(7, 1, 1129000, 'not paid', 'pending', 'admin', 'minhduc190201@gmail.com', 'admin', 'hai bà trưng', '0981371108', 'admin', NULL, '2023-11-23 06:47:03', '2023-11-23 06:47:03'),
(8, 1, 1040000, 'not paid', 'shipped', 'admin', 'minhduc190201@gmail.com', 'admin', 'hai bà trưng', '0981371108', 'admin', NULL, '2023-11-23 06:48:39', '2023-12-13 19:39:36'),
(9, 5, 2100000, 'paid', 'cancelled', 'Man', 'nam@gmail.com', 'HCM', '798 Thanh pho HCM', '987654321', 'Nam', NULL, '2023-11-23 07:02:06', '2023-11-23 07:08:04'),
(10, 5, 1226000, 'not paid', 'pending', 'Man', 'nam@gmail.com', 'HCM', '798 Thanh pho HCM', '987654321', 'Nam', NULL, '2023-12-13 19:40:23', '2023-12-13 19:40:23'),
(11, 5, 0, 'paid', 'pending', 'Man', 'nam@gmail.com', 'HCM', '798 Thanh pho HCM', '987654321', 'Nam', NULL, '2023-12-13 19:40:42', '2023-12-13 19:40:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(5, 3, 35, 'Áo Thun Nam Tay Ngắn Cotton Cổ Tròn In Hình Form Regular', 1, 343000, 343000, '2023-11-23 03:40:17', '2023-11-23 03:40:17'),
(6, 3, 62, 'Áo Thun Nữ Lửng Tay Ngắn In Hình Phối Chỉ Form Fitted Crop', 2, 249000, 498000, '2023-11-23 03:40:17', '2023-11-23 03:40:17'),
(7, 3, 60, 'Áo Thun Tay Dài Nữ Vải Jacquard Trơn Form Fitted', 1, 343000, 343000, '2023-11-23 03:40:17', '2023-11-23 03:40:17'),
(8, 4, 31, 'Áo thun nam tay ngắn S.Cafe', 1, 422000, 422000, '2023-11-23 06:44:45', '2023-11-23 06:44:45'),
(9, 5, 30, 'Áo thun nam tay ngắn hoạ tiết thêu', 1, 589000, 589000, '2023-11-23 06:45:27', '2023-11-23 06:45:27'),
(10, 5, 32, 'Áo Thun Nam Tay Ngắn Coffee Trơn S.Café Form Fitted', 1, 422000, 422000, '2023-11-23 06:45:27', '2023-11-23 06:45:27'),
(11, 6, 35, 'Áo Thun Nam Tay Ngắn Cotton Cổ Tròn In Hình Form Regular', 1, 343000, 343000, '2023-11-23 06:46:43', '2023-11-23 06:46:43'),
(12, 6, 31, 'Áo thun nam tay ngắn S.Cafe', 1, 422000, 422000, '2023-11-23 06:46:43', '2023-11-23 06:46:43'),
(13, 7, 50, 'Quần Jean Nam Ống Rộng Trơn Form Straight Crop', 1, 540000, 540000, '2023-11-23 06:47:03', '2023-11-23 06:47:03'),
(14, 7, 49, 'Quần Jean Nam Ống Đứng Diễu Thân Trơn Form Straight', 1, 589000, 589000, '2023-11-23 06:47:04', '2023-11-23 06:47:04'),
(15, 8, 39, 'Áo Polo Nam Interlock Pique Phối Bo Và Tay Form Regular', 1, 520000, 520000, '2023-11-23 06:48:39', '2023-11-23 06:48:39'),
(16, 8, 37, 'Áo Polo Nam Vải Gân Phối Bo Nẹp Trang Trí Form Fitted', 1, 520000, 520000, '2023-11-23 06:48:40', '2023-11-23 06:48:40'),
(17, 9, 36, 'Áo Polo Nam Tay Bo Cổ Gài Nút Sọc Gân Phối Viền Form Fitted', 1, 589000, 589000, '2023-11-23 07:02:06', '2023-11-23 07:02:06'),
(18, 9, 38, 'Áo Polo Nam Tay Bo Cổ Mao Phối Viền Trơn Form Fitted', 1, 471000, 471000, '2023-11-23 07:02:06', '2023-11-23 07:02:06'),
(19, 9, 37, 'Áo Polo Nam Vải Gân Phối Bo Nẹp Trang Trí Form Fitted', 1, 520000, 520000, '2023-11-23 07:02:06', '2023-11-23 07:02:06'),
(20, 9, 39, 'Áo Polo Nam Interlock Pique Phối Bo Và Tay Form Regular', 1, 520000, 520000, '2023-11-23 07:02:06', '2023-11-23 07:02:06'),
(21, 10, 35, 'Áo Thun Nam Tay Ngắn Cotton Cổ Tròn In Hình Form Regular', 2, 343000, 686000, '2023-12-13 19:40:23', '2023-12-13 19:40:23'),
(22, 10, 34, 'Áo Thun Nam Coffee Phối Sọc Tay S.Café Form Loose', 1, 540000, 540000, '2023-12-13 19:40:23', '2023-12-13 19:40:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `price` int(10) NOT NULL,
  `compare_price` int(11) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `track_qty` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(30, 'Áo thun nam tay ngắn hoạ tiết thêu', 'ao-thun-nam-tay-ngan-hoa-tiet-theu', NULL, NULL, 589000, NULL, 43, 10, NULL, 'Yes', '10F23TSS001L', 'Yes', 9, 1, '2023-11-06 21:21:07', '2023-11-23 06:45:27'),
(31, 'Áo thun nam tay ngắn S.Cafe', 'ao-thun-nam-tay-ngan-scafe', NULL, NULL, 422000, NULL, 43, 10, NULL, 'No', '10F23TSS030', 'Yes', 10, 1, '2023-11-06 21:25:51', '2023-11-23 06:46:43'),
(32, 'Áo Thun Nam Tay Ngắn Coffee Trơn S.Café Form Fitted', 'ao-thun-nam-tay-ngan-coffee-tron-scafe-form-fitted', NULL, NULL, 422000, NULL, 43, 10, NULL, 'No', '10F23TSS013', 'Yes', 12, 1, '2023-11-06 21:27:04', '2023-11-23 06:45:27'),
(33, 'Áo Thun Nam S.Café Thêu chữ Coffee Lovers Form Loose', 'ao-thun-nam-scafe-theu-chu-coffee-lovers-form-loose', NULL, NULL, 520000, 900000, 43, 10, NULL, 'No', '10F23TSS062', 'Yes', 0, 1, '2023-11-06 21:28:40', '2023-11-23 05:03:01'),
(34, 'Áo Thun Nam Coffee Phối Sọc Tay S.Café Form Loose', 'ao-thun-nam-coffee-phoi-soc-tay-scafe-form-loose', NULL, NULL, 540000, NULL, 43, 10, NULL, 'Yes', '10F23TSS082', 'Yes', 9, 1, '2023-11-06 21:30:01', '2023-12-13 19:40:23'),
(35, 'Áo Thun Nam Tay Ngắn Cotton Cổ Tròn In Hình Form Regular', 'ao-thun-nam-tay-ngan-cotton-co-tron-in-hinh-form-regular', NULL, NULL, 343000, NULL, 43, 10, 9, 'Yes', '10S23TSS017', 'Yes', 6, 1, '2023-11-06 21:30:43', '2023-12-13 19:40:23'),
(36, 'Áo Polo Nam Tay Bo Cổ Gài Nút Sọc Gân Phối Viền Form Fitted', 'ao-polo-nam-tay-bo-co-gai-nut-soc-gan-phoi-vien-form-fitted', NULL, NULL, 589000, NULL, 43, 12, NULL, 'Yes', '10F23POL011P', 'Yes', 9, 1, '2023-11-06 21:33:00', '2023-11-23 07:02:06'),
(37, 'Áo Polo Nam Vải Gân Phối Bo Nẹp Trang Trí Form Fitted', 'ao-polo-nam-vai-gan-phoi-bo-nep-trang-tri-form-fitted', NULL, NULL, 520000, NULL, 43, 12, NULL, 'No', '10F23POL017', 'Yes', 13, 1, '2023-11-06 21:34:39', '2023-11-23 07:02:06'),
(38, 'Áo Polo Nam Tay Bo Cổ Mao Phối Viền Trơn Form Fitted', 'ao-polo-nam-tay-bo-co-mao-phoi-vien-tron-form-fitted', NULL, NULL, 471000, NULL, 43, 12, NULL, 'No', '10S23POL004', 'Yes', 4, 1, '2023-11-06 21:35:53', '2023-11-23 07:02:06'),
(39, 'Áo Polo Nam Interlock Pique Phối Bo Và Tay Form Regular', 'ao-polo-nam-interlock-pique-phoi-bo-va-tay-form-regular', NULL, NULL, 520000, NULL, 43, 12, NULL, 'No', '10S23POL037', 'Yes', 1, 1, '2023-11-06 21:37:08', '2023-11-23 07:02:06'),
(40, 'Áo Sơ Mi Nam Tay Dài Trơn Cổ Mao Phối Nẹp 1/2 Form Loose', 'ao-so-mi-nam-tay-dai-tron-co-mao-phoi-nep-12-form-loose', NULL, NULL, 520000, NULL, 43, 17, NULL, 'No', '10S23SHL013', 'Yes', 4, 1, '2023-11-06 21:38:16', '2023-11-06 21:46:12'),
(41, 'Áo Sơ Mi Nam Tay Ngắn Trơn Rayon Dây Rút Form Loose', 'ao-so-mi-nam-tay-ngan-tron-rayon-day-rut-form-loose', NULL, NULL, 540000, NULL, 43, 17, NULL, 'Yes', '10S23SHS029', 'Yes', 2, 1, '2023-11-06 21:39:29', '2023-11-06 21:46:02'),
(42, 'Áo Sơ Mi Nam Tay Dài Sợi Coffee Cổ Gài Nút Trơn Form Fitted', 'ao-so-mi-nam-tay-dai-soi-coffee-co-gai-nut-tron-form-fitted', NULL, NULL, 490000, NULL, 43, 17, NULL, 'No', '10F23SHL090', 'Yes', 1, 1, '2023-11-06 21:41:27', '2023-11-06 21:45:50'),
(43, 'Áo Khoác Bomber Nam Da Lộn Trơn Dây Kéo Form Regular', 'ao-khoac-bomber-nam-da-lon-tron-day-keo-form-regular', NULL, NULL, 1178000, NULL, 43, 16, NULL, 'Yes', '10F23JAC001', 'Yes', 1, 1, '2023-11-06 21:43:16', '2023-11-06 21:43:16'),
(44, 'Áo Khoác Nam Flannel Tay Dài Khóa Kéo Kẻ Caro Form Regular', 'ao-khoac-nam-flannel-tay-dai-khoa-keo-ke-caro-form-regular', NULL, NULL, 981000, NULL, 43, 16, NULL, 'Yes', '10F23JAC002', 'Yes', 5, 1, '2023-11-06 21:51:15', '2023-11-06 21:51:15'),
(45, 'Áo Hoodie Unisex Tay Dài Có Túi Mũ In Hình Form Loose', 'ao-hoodie-unisex-tay-dai-co-tui-mu-in-hinh-form-loose', NULL, NULL, 638000, NULL, 43, 14, NULL, 'Yes', '10F23HODU003', 'Yes', 3, 1, '2023-11-07 00:43:38', '2023-11-07 00:43:38'),
(46, 'Áo Hoodie Nam Tay Dài Có Mũ Texture Trơn Form Regular', 'ao-hoodie-nam-tay-dai-co-mu-texture-tron-form-regular', NULL, '<p>asd</p>', 589000, NULL, 43, 14, NULL, 'Yes', '10S23HOD009', 'Yes', 3, 1, '2023-11-20 20:08:14', '2023-11-20 20:08:14'),
(47, 'Áo Khoác Bomber Nam Nylon Chần Bông Phối Màu Form Regular', 'ao-khoac-bomber-nam-nylon-chan-bong-phoi-mau-form-regular', NULL, NULL, 981000, NULL, 43, 16, NULL, 'Yes', '10F23JAC006', 'Yes', 3, 1, '2023-11-20 20:15:33', '2023-11-20 20:15:33'),
(48, 'Quần Jean Nam Ống Ôm Trơn Form Slim', 'quan-jean-nam-ong-om-tron-form-slim', NULL, NULL, 540000, NULL, 45, 19, NULL, 'Yes', '10S21DPA006CR2', 'Yes', 4, 1, '2023-11-20 20:22:46', '2023-11-20 20:22:46'),
(49, 'Quần Jean Nam Ống Đứng Diễu Thân Trơn Form Straight', 'quan-jean-nam-ong-dung-dieu-than-tron-form-straight', NULL, NULL, 589000, NULL, 45, 19, NULL, 'Yes', '10F23DPA010', 'Yes', 4, 1, '2023-11-20 20:25:44', '2023-11-23 06:47:04'),
(50, 'Quần Jean Nam Ống Rộng Trơn Form Straight Crop', 'quan-jean-nam-ong-rong-tron-form-straight-crop', NULL, NULL, 540000, NULL, 45, 19, NULL, 'Yes', '10F23DPA022', 'Yes', 5, 1, '2023-11-20 20:28:07', '2023-11-23 06:47:04'),
(51, 'Quần Kaki Nam Texture Xếp Ly Trơn Form Slim', 'quan-kaki-nam-texture-xep-ly-tron-form-slim', NULL, NULL, 540000, NULL, 45, 20, NULL, 'Yes', '10S23PCA009', 'Yes', 6, 1, '2023-11-20 20:29:45', '2023-11-20 20:29:45'),
(52, 'Quần Kaki Nam Ống Đứng Xếp Ly Trơn Form Straight Crop', 'quan-kaki-nam-ong-dung-xep-ly-tron-form-straight-crop', NULL, NULL, 569000, NULL, 45, 20, NULL, 'Yes', '10S23PCA011', 'Yes', 1, 1, '2023-11-20 20:31:24', '2023-11-20 20:31:24'),
(53, 'Quần Kaki Nam Ống Rộng Lưng Thun Cotton Trơn Form Relax', 'quan-kaki-nam-ong-rong-lung-thun-cotton-tron-form-relax', NULL, NULL, 540000, NULL, 45, 20, NULL, 'Yes', '10S23PCA016', 'Yes', 2, 1, '2023-11-20 20:33:35', '2023-11-20 20:33:35'),
(54, 'Quần dài gân phối chỉ', 'quan-dai-gan-phoi-chi', NULL, NULL, 569000, NULL, 45, 21, NULL, 'Yes', '10S23PFO006', 'Yes', 3, 1, '2023-11-20 20:58:21', '2023-11-20 20:58:21'),
(55, 'Quần Âu Nam Twill Ống Ôm Xếp Ly Trơn', 'quan-au-nam-twill-ong-om-xep-ly-tron', NULL, NULL, 540000, NULL, 45, 21, NULL, 'Yes', '10F23PFO001', 'Yes', 4, 1, '2023-11-20 20:59:58', '2023-11-20 20:59:58'),
(56, 'Quần Vải Nam Lưng Thun Polyester Trơn', 'quan-vai-nam-lung-thun-polyester-tron', NULL, NULL, 569000, NULL, 45, 21, NULL, 'Yes', '10S23PFO008', 'Yes', 5, 1, '2023-11-20 21:02:20', '2023-11-20 21:02:20'),
(57, 'Quần Short Nỉ Unisex Trơn Ống Rộng Form Relax', 'quan-short-ni-unisex-tron-ong-rong-form-relax', NULL, NULL, 422000, NULL, 45, 22, NULL, 'Yes', '10F23PKS016', 'Yes', 7, 1, '2023-11-20 21:10:37', '2023-11-20 21:10:37'),
(58, 'Quần Short Nam Kaki Ống Rộng Lưng Thun Trơn Form Relax', 'quan-short-nam-kaki-ong-rong-lung-thun-tron-form-relax', NULL, NULL, 422000, NULL, 45, 22, NULL, 'Yes', '10S23PSH009', 'Yes', 2, 1, '2023-11-21 02:14:03', '2023-11-21 02:14:03'),
(59, 'Quần Short Nam Kẻ Sọc Dọc Phối Dây Rút Form Relax', 'quan-short-nam-ke-soc-doc-phoi-day-rut-form-relax', NULL, NULL, 422000, NULL, 45, 22, NULL, 'Yes', '10S23PSH018', 'Yes', 3, 1, '2023-11-21 02:16:01', '2023-11-21 02:16:01'),
(60, 'Áo Thun Tay Dài Nữ Vải Jacquard Trơn Form Fitted', 'ao-thun-tay-dai-nu-vai-jacquard-tron-form-fitted', NULL, NULL, 343000, NULL, 44, 9, NULL, 'Yes', '10S23TSLW001', 'Yes', 2, 1, '2023-11-21 02:44:28', '2023-11-23 03:40:17'),
(61, 'Áo Thun Nữ Tay Ngắn Trơn Vải Dệt Lỗ Form Slim', 'ao-thun-nu-tay-ngan-tron-vai-det-lo-form-slim', NULL, NULL, 274000, NULL, 44, 9, NULL, 'Yes', '10S23TSSW010', 'Yes', 4, 1, '2023-11-21 02:46:37', '2023-11-21 02:46:37'),
(62, 'Áo Thun Nữ Lửng Tay Ngắn In Hình Phối Chỉ Form Fitted Crop', 'ao-thun-nu-lung-tay-ngan-in-hinh-phoi-chi-form-fitted-crop', NULL, NULL, 249000, 329000, 44, 9, NULL, 'Yes', '10S23TSSW013', 'Yes', 3, 1, '2023-11-21 02:49:55', '2023-11-23 03:40:17'),
(63, 'Áo Sơ Mi Nữ Tay Dài Polyester Trơn Nhún Nẹp Form Regular', 'ao-so-mi-nu-tay-dai-polyester-tron-nhun-nep-form-regular', NULL, NULL, 520000, NULL, 44, 11, 9, 'Yes', '10F23SHLW008', 'Yes', 5, 1, '2023-11-21 03:10:03', '2023-11-21 03:10:03'),
(64, 'Áo Sơ Mi Nữ Sát Nách Thắt Nơ Cổ Trơn Form Regular', 'ao-so-mi-nu-sat-nach-that-no-co-tron-form-regular', NULL, NULL, 490000, NULL, 44, 11, 10, 'Yes', '10F23SHSW005', 'Yes', 4, 1, '2023-11-21 03:11:55', '2023-11-21 03:11:55'),
(65, 'Áo Sơ Mi Nữ Tay Dài Linen Túi Thêu Form Regular Crop', 'ao-so-mi-nu-tay-dai-linen-tui-theu-form-regular-crop', NULL, NULL, 356000, 549000, 44, 11, 9, 'Yes', '10S23SHLW010', 'Yes', 6, 1, '2023-11-21 04:04:32', '2023-11-26 05:06:00'),
(66, 'Áo Khoác Chần Bông Nữ Nylon Phối Màu Form Regular', 'ao-khoac-chan-bong-nu-nylon-phoi-mau-form-regular', NULL, NULL, 1178000, NULL, 44, 13, 10, 'Yes', '10F23JACW004', 'Yes', 3, 1, '2023-11-21 04:18:51', '2023-11-21 04:18:51'),
(67, 'Áo Khoác Gió Nữ Có Mũ Túi Đắp Trơn Form Cargo', 'ao-khoac-gio-nu-co-mu-tui-dap-tron-form-cargo', NULL, NULL, 324000, 499000, 44, 13, NULL, 'Yes', '10S23WJAW001', 'Yes', 3, 1, '2023-11-21 04:20:42', '2023-11-21 04:21:07'),
(68, 'Áo Khoác Jean Nữ Tay Dài Trơn Form Regular', 'ao-khoac-jean-nu-tay-dai-tron-form-regular', NULL, NULL, 389000, 599000, 44, 13, 12, 'Yes', '10F22DJAW001', 'Yes', 4, 1, '2023-11-21 04:22:22', '2023-11-21 04:22:22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(31, 30, '30-31-1699330901.jpg', NULL, '2023-11-06 21:21:41', '2023-11-06 21:21:41'),
(32, 31, '31-32-1699331152.jpg', NULL, '2023-11-06 21:25:52', '2023-11-06 21:25:52'),
(33, 32, '32-33-1699331224.jpg', NULL, '2023-11-06 21:27:04', '2023-11-06 21:27:04'),
(34, 33, '33-34-1699331320.jpg', NULL, '2023-11-06 21:28:40', '2023-11-06 21:28:40'),
(35, 34, '34-35-1699331401.jpg', NULL, '2023-11-06 21:30:01', '2023-11-06 21:30:01'),
(36, 35, '35-36-1699331484.jpg', NULL, '2023-11-06 21:31:24', '2023-11-06 21:31:24'),
(37, 36, '36-37-1699331580.jpg', NULL, '2023-11-06 21:33:00', '2023-11-06 21:33:00'),
(38, 37, '37-38-1699331679.jpg', NULL, '2023-11-06 21:34:39', '2023-11-06 21:34:39'),
(39, 38, '38-39-1699331753.jpg', NULL, '2023-11-06 21:35:53', '2023-11-06 21:35:53'),
(40, 39, '39-40-1699331828.jpg', NULL, '2023-11-06 21:37:08', '2023-11-06 21:37:08'),
(41, 40, '40-41-1699331896.jpg', NULL, '2023-11-06 21:38:16', '2023-11-06 21:38:16'),
(42, 41, '41-42-1699332035.jpg', NULL, '2023-11-06 21:40:35', '2023-11-06 21:40:35'),
(43, 42, '42-43-1699332087.jpg', NULL, '2023-11-06 21:41:27', '2023-11-06 21:41:27'),
(44, 43, '43-44-1699332196.jpg', NULL, '2023-11-06 21:43:16', '2023-11-06 21:43:16'),
(45, 44, '44-45-1699332676.jpg', NULL, '2023-11-06 21:51:16', '2023-11-06 21:51:16'),
(46, 45, '45-46-1699343018.jpg', NULL, '2023-11-07 00:43:38', '2023-11-07 00:43:38'),
(47, 46, '46-47-1700536095.jpg', NULL, '2023-11-20 20:08:15', '2023-11-20 20:08:15'),
(48, 46, '46-48-1700536096.jpg', NULL, '2023-11-20 20:08:16', '2023-11-20 20:08:16'),
(49, 46, '46-49-1700536097.jpg', NULL, '2023-11-20 20:08:17', '2023-11-20 20:08:17'),
(50, 47, '47-50-1700536533.jpg', NULL, '2023-11-20 20:15:33', '2023-11-20 20:15:33'),
(51, 47, '47-51-1700536534.jpg', NULL, '2023-11-20 20:15:34', '2023-11-20 20:15:34'),
(52, 47, '47-52-1700536535.jpg', NULL, '2023-11-20 20:15:35', '2023-11-20 20:15:35'),
(53, 48, '48-53-1700536966.jpg', NULL, '2023-11-20 20:22:46', '2023-11-20 20:22:46'),
(54, 48, '48-54-1700536968.jpg', NULL, '2023-11-20 20:22:48', '2023-11-20 20:22:48'),
(55, 48, '48-55-1700536970.jpg', NULL, '2023-11-20 20:22:50', '2023-11-20 20:22:50'),
(56, 49, '49-56-1700537144.jpg', NULL, '2023-11-20 20:25:44', '2023-11-20 20:25:44'),
(57, 49, '49-57-1700537145.jpg', NULL, '2023-11-20 20:25:45', '2023-11-20 20:25:45'),
(58, 49, '49-58-1700537146.jpg', NULL, '2023-11-20 20:25:46', '2023-11-20 20:25:46'),
(59, 50, '50-59-1700537287.jpg', NULL, '2023-11-20 20:28:07', '2023-11-20 20:28:07'),
(60, 50, '50-60-1700537288.jpg', NULL, '2023-11-20 20:28:08', '2023-11-20 20:28:08'),
(61, 50, '50-61-1700537288.jpg', NULL, '2023-11-20 20:28:08', '2023-11-20 20:28:08'),
(62, 51, '51-62-1700537385.jpg', NULL, '2023-11-20 20:29:45', '2023-11-20 20:29:45'),
(63, 51, '51-63-1700537386.jpg', NULL, '2023-11-20 20:29:46', '2023-11-20 20:29:46'),
(64, 51, '51-64-1700537387.jpg', NULL, '2023-11-20 20:29:47', '2023-11-20 20:29:47'),
(65, 52, '52-65-1700537485.jpg', NULL, '2023-11-20 20:31:25', '2023-11-20 20:31:25'),
(66, 52, '52-66-1700537485.jpg', NULL, '2023-11-20 20:31:25', '2023-11-20 20:31:25'),
(67, 52, '52-67-1700537486.jpg', NULL, '2023-11-20 20:31:26', '2023-11-20 20:31:26'),
(68, 53, '53-68-1700537615.jpg', NULL, '2023-11-20 20:33:35', '2023-11-20 20:33:35'),
(70, 53, '53-70-1700537617.jpg', NULL, '2023-11-20 20:33:37', '2023-11-20 20:33:37'),
(71, 54, '54-71-1700539101.jpg', NULL, '2023-11-20 20:58:21', '2023-11-20 20:58:21'),
(72, 54, '54-72-1700539102.jpg', NULL, '2023-11-20 20:58:22', '2023-11-20 20:58:22'),
(73, 54, '54-73-1700539103.jpg', NULL, '2023-11-20 20:58:23', '2023-11-20 20:58:23'),
(74, 55, '55-74-1700539199.jpg', NULL, '2023-11-20 20:59:58', '2023-11-20 20:59:59'),
(75, 55, '55-75-1700539200.jpg', NULL, '2023-11-20 21:00:00', '2023-11-20 21:00:00'),
(76, 55, '55-76-1700539201.jpg', NULL, '2023-11-20 21:00:01', '2023-11-20 21:00:01'),
(77, 56, '56-77-1700539340.jpg', NULL, '2023-11-20 21:02:20', '2023-11-20 21:02:20'),
(78, 56, '56-78-1700539341.jpg', NULL, '2023-11-20 21:02:21', '2023-11-20 21:02:21'),
(79, 56, '56-79-1700539342.jpg', NULL, '2023-11-20 21:02:22', '2023-11-20 21:02:22'),
(80, 57, '57-80-1700539837.jpg', NULL, '2023-11-20 21:10:37', '2023-11-20 21:10:37'),
(81, 57, '57-81-1700539838.jpg', NULL, '2023-11-20 21:10:38', '2023-11-20 21:10:38'),
(82, 57, '57-82-1700539839.jpg', NULL, '2023-11-20 21:10:39', '2023-11-20 21:10:39'),
(83, 58, '58-83-1700558043.jpg', NULL, '2023-11-21 02:14:03', '2023-11-21 02:14:03'),
(84, 58, '58-84-1700558044.jpg', NULL, '2023-11-21 02:14:04', '2023-11-21 02:14:04'),
(85, 58, '58-85-1700558045.jpg', NULL, '2023-11-21 02:14:05', '2023-11-21 02:14:05'),
(86, 59, '59-86-1700558161.jpg', NULL, '2023-11-21 02:16:01', '2023-11-21 02:16:01'),
(87, 59, '59-87-1700558162.jpg', NULL, '2023-11-21 02:16:02', '2023-11-21 02:16:02'),
(88, 59, '59-88-1700558163.jpg', NULL, '2023-11-21 02:16:03', '2023-11-21 02:16:03'),
(89, 60, '60-89-1700559868.jpg', NULL, '2023-11-21 02:44:28', '2023-11-21 02:44:28'),
(90, 60, '60-90-1700559869.jpg', NULL, '2023-11-21 02:44:29', '2023-11-21 02:44:29'),
(91, 60, '60-91-1700559870.jpg', NULL, '2023-11-21 02:44:30', '2023-11-21 02:44:30'),
(92, 61, '61-92-1700560047.jpg', NULL, '2023-11-21 02:47:27', '2023-11-21 02:47:27'),
(93, 61, '61-93-1700560048.jpg', NULL, '2023-11-21 02:47:28', '2023-11-21 02:47:28'),
(94, 61, '61-94-1700560049.jpg', NULL, '2023-11-21 02:47:29', '2023-11-21 02:47:29'),
(95, 62, '62-95-1700560195.jpg', NULL, '2023-11-21 02:49:55', '2023-11-21 02:49:55'),
(96, 62, '62-96-1700560196.jpg', NULL, '2023-11-21 02:49:55', '2023-11-21 02:49:56'),
(97, 62, '62-97-1700560196.jpg', NULL, '2023-11-21 02:49:56', '2023-11-21 02:49:56'),
(98, 63, '63-98-1700561403.jpg', NULL, '2023-11-21 03:10:03', '2023-11-21 03:10:03'),
(99, 63, '63-99-1700561404.jpg', NULL, '2023-11-21 03:10:04', '2023-11-21 03:10:04'),
(100, 63, '63-100-1700561405.jpg', NULL, '2023-11-21 03:10:05', '2023-11-21 03:10:05'),
(101, 64, '64-101-1700561515.jpg', NULL, '2023-11-21 03:11:55', '2023-11-21 03:11:55'),
(102, 64, '64-102-1700561516.jpg', NULL, '2023-11-21 03:11:56', '2023-11-21 03:11:56'),
(103, 64, '64-103-1700561517.jpg', NULL, '2023-11-21 03:11:57', '2023-11-21 03:11:57'),
(104, 65, '65-104-1700564673.jpg', NULL, '2023-11-21 04:04:33', '2023-11-21 04:04:33'),
(105, 65, '65-105-1700564673.jpg', NULL, '2023-11-21 04:04:33', '2023-11-21 04:04:33'),
(106, 65, '65-106-1700564675.jpg', NULL, '2023-11-21 04:04:35', '2023-11-21 04:04:35'),
(107, 66, '66-107-1700565531.jpg', NULL, '2023-11-21 04:18:51', '2023-11-21 04:18:51'),
(108, 66, '66-108-1700565533.jpg', NULL, '2023-11-21 04:18:52', '2023-11-21 04:18:53'),
(109, 66, '66-109-1700565534.jpg', NULL, '2023-11-21 04:18:54', '2023-11-21 04:18:54'),
(111, 68, '68-111-1700565742.jpg', NULL, '2023-11-21 04:22:22', '2023-11-21 04:22:22'),
(112, 35, '35-112-1700565985.jpg', NULL, '2023-11-21 04:26:25', '2023-11-21 04:26:25'),
(113, 35, '35-113-1700565987.jpg', NULL, '2023-11-21 04:26:27', '2023-11-21 04:26:27');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(9, 'Áo thun nữ', 'ao-thun-nu', 1, 'Yes', 44, '2023-11-06 20:55:47', '2023-11-21 02:18:28'),
(10, 'Áo thun', 'ao-thun', 1, 'Yes', 43, '2023-11-06 20:56:28', '2023-11-06 20:56:28'),
(11, 'Áo sơ mi nữ', 'ao-so-mi-nu', 1, 'Yes', 44, '2023-11-06 20:56:46', '2023-11-21 02:53:12'),
(12, 'Áo polo', 'ao-polo', 1, 'Yes', 43, '2023-11-06 20:57:06', '2023-11-06 20:57:06'),
(13, 'Áo khoác nữ', 'ao-khoac-nu', 1, 'Yes', 44, '2023-11-06 20:57:20', '2023-11-21 04:06:19'),
(14, 'Áo hoodie', 'ao-hoodie', 1, 'Yes', 43, '2023-11-06 20:58:37', '2023-11-07 00:42:36'),
(16, 'Áo khoác', 'ao-khoac', 1, 'Yes', 43, '2023-11-06 20:59:20', '2023-11-06 21:42:06'),
(17, 'Áo sơ mi', 'ao-so-mi', 1, 'Yes', 43, '2023-11-06 20:59:39', '2023-11-06 21:38:35'),
(19, 'Quần Jean', 'quan-jean', 1, 'Yes', 45, '2023-11-07 00:44:39', '2023-11-07 00:44:39'),
(20, 'Quần kaki', 'quan-kaki', 1, 'Yes', 45, '2023-11-07 00:45:29', '2023-11-07 00:45:29'),
(21, 'Quần vải', 'quan-vai', 1, 'Yes', 45, '2023-11-07 00:45:41', '2023-11-07 00:45:41'),
(22, 'Quần short', 'quan-short', 1, 'Yes', 45, '2023-11-07 00:45:57', '2023-11-07 00:45:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '0123456789', 1, 1, NULL, '$2y$10$FNdzdh7T7N.ef2G5PRCJj.sjLcXsONNHTC.6cdW0IAJEh2kJLzq6i', NULL, '2023-10-17 19:53:19', '2023-11-07 02:53:53'),
(2, 'Duc', 'nmd@gmail.com', '011123456', 2, 1, NULL, '$2y$10$BRIcO6f7Ywo6RDnrI0y0nudPUdWQI5kfoO6W6MAp9a0jSUrr4eTFS', NULL, '2023-10-17 19:54:41', '2023-11-16 05:11:16'),
(3, 'asd', 'asd@gmail.com', '0123456', 1, 1, NULL, '$2y$10$FNdzdh7T7N.ef2G5PRCJj.sjLcXsONNHTC.6cdW0IAJEh2kJLzq6i', NULL, '2023-11-01 02:49:28', '2023-11-10 06:10:47'),
(5, 'nam', 'nam@gmail.com', '0123789456', 1, 1, NULL, '$2y$10$Wn9YcHA8fcDT.htz1XDSKeulVjlkUJjlu4S0XCh1NwEiZWQ3BKsoC', NULL, '2023-11-22 02:47:20', '2023-11-22 02:47:20');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_image_product_id_foreign` (`product_id`);

--
-- Chỉ mục cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Chỉ mục cho bảng `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_image_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
