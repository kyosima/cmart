-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 30, 2022 lúc 10:58 AM
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
-- Cơ sở dữ liệu: `cmartfull`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `setting_payment_ninepay`
--

CREATE TABLE `setting_payment_ninepay` (
  `id` int(11) NOT NULL,
  `merchant_key` varchar(255) NOT NULL,
  `merchant_secret_key` text NOT NULL,
  `end_point` text NOT NULL,
  `key_checksum` text NOT NULL,
  `environment` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `setting_payment_ninepay`
--

INSERT INTO `setting_payment_ninepay` (`id`, `merchant_key`, `merchant_secret_key`, `end_point`, `key_checksum`, `environment`, `created_at`, `updated_at`) VALUES
(1, 'hlAiTJ', 'QDhGr06e9iRpccDIwUuShFotVypRbIVbEHz', 'https://sand-payment.9pay.vn', '4aOtrEVnGGdFF4RKoQW11IN5i2ZvnuzZ', 0, '2022-03-29 09:28:55', '2022-03-29 09:28:55'),
(2, 'hlAiTJ', 'QDhGr06e9iRpccDIwUuShFotVypRbIVbEHz', 'https://sand-payment.9pay.vn', '4aOtrEVnGGdFF4RKoQW11IN5i2ZvnuzZ', 1, '2022-03-29 09:28:55', '2022-03-29 09:28:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `setting_payment_ninepay`
--
ALTER TABLE `setting_payment_ninepay`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `setting_payment_ninepay`
--
ALTER TABLE `setting_payment_ninepay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
