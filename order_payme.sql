-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 15, 2022 lúc 11:07 AM
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
-- Cấu trúc bảng cho bảng `order_payme`
--

CREATE TABLE `order_payme` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `transaction_partner_id` varchar(255) DEFAULT NULL,
  `link_payment` text DEFAULT NULL,
  `transaction_payme_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order_payme`
--

INSERT INTO `order_payme` (`id`, `order_id`, `status`, `transaction_partner_id`, `link_payment`, `transaction_payme_id`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'CMART-81644917110', 'http://sbx.payme.vn/g/payment/3443281680', '3443281680', '2022-02-15 09:25:11', '2022-02-15 09:33:21'),
(2, 9, 1, 'CMART-91644917718', 'http://sbx.payme.vn/g/payment/9508993383', '9508993383', '2022-02-15 09:35:18', '2022-02-15 09:42:40');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `order_payme`
--
ALTER TABLE `order_payme`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_partner_id` (`transaction_partner_id`),
  ADD UNIQUE KEY `transaction_payme_id` (`transaction_payme_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `order_payme`
--
ALTER TABLE `order_payme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
