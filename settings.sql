-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2021 lúc 03:56 AM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cmart`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key` varchar(191) NOT NULL,
  `plain_value` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `key`, `plain_value`, `created_at`, `updated_at`) VALUES
(1, 'store_name', 'CÔNG TY TNHH TM-DV C-MART', '2021-10-26 07:11:32', '2021-10-26 07:56:14'),
(2, 'store_email', 'truong@gmail.com', '2021-10-26 07:11:32', '2021-10-26 07:33:43'),
(3, 'store_phone', '0342909557', '2021-10-26 07:11:32', '2021-10-26 07:56:14'),
(4, 'store_address', '998/42/15 Quang Trung', '2021-10-26 07:11:32', '2021-10-26 08:06:47'),
(5, 'mail_from_address', 'cmart@gmail.com', '2021-10-26 07:11:32', '2021-10-26 07:58:36'),
(7, 'social_facebook', 'ittranvantruong', '2021-10-26 07:11:32', '2021-10-26 08:01:20'),
(8, 'social_zalo', '0342909557', '2021-10-26 07:11:32', '2021-10-26 08:01:20'),
(9, 'mail_from_name', 'CÔNG TY TNHH TM-DV C-MART', '2021-10-26 07:58:36', '2021-10-26 07:58:36');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
