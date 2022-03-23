-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 23, 2022 lúc 06:12 AM
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
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(73, 'Tất cả quyền', 'admin', '2022-03-23 04:02:29', '2022-03-23 04:02:29'),
(74, 'Truy cập CH', 'admin', '2022-03-23 04:02:50', '2022-03-23 04:02:50'),
(75, 'Chỉnh sửa Tồn kho cho CH chỉ định', 'admin', '2022-03-23 04:03:08', '2022-03-23 04:20:24'),
(76, 'Tạo+xóa+sửa CH', 'admin', '2022-03-23 04:18:04', '2022-03-23 04:18:04'),
(77, 'Truy cập mục Admin', 'admin', '2022-03-23 04:27:13', '2022-03-23 04:30:26'),
(78, 'Tạo+sửa+xóa Admin', 'admin', '2022-03-23 04:27:19', '2022-03-23 04:33:06'),
(79, 'Truy cập+tạo+sửa+xóa+ẩn mục Trang', 'admin', '2022-03-23 04:35:44', '2022-03-23 04:36:14'),
(80, 'Truy cập+tạo+sửa+xóa+ẩn mục Banner', 'admin', '2022-03-23 04:36:56', '2022-03-23 04:36:56'),
(81, 'Truy cập mục TTSP', 'admin', '2022-03-23 04:39:29', '2022-03-23 04:39:29'),
(82, 'Tạo+sửa+xóa SP', 'admin', '2022-03-23 04:41:29', '2022-03-23 04:41:29'),
(83, 'Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng', 'admin', '2022-03-23 04:46:02', '2022-03-23 04:46:02'),
(84, 'Truy cập mục HTTT + ẩn', 'admin', '2022-03-23 04:49:55', '2022-03-23 04:49:55'),
(85, 'Truy cập mục KH', 'admin', '2022-03-23 04:53:30', '2022-03-23 04:53:30'),
(86, 'Sửa+ẩn KH', 'admin', '2022-03-23 04:56:39', '2022-03-23 04:56:39'),
(87, 'Truy cập mục Ưu đãi', 'admin', '2022-03-23 05:00:17', '2022-03-23 05:00:17'),
(88, 'Tạo+sửa Ưu đãi', 'admin', '2022-03-23 05:01:40', '2022-03-23 05:01:40'),
(89, 'Truy cập mục Đơn hàng', 'admin', '2022-03-23 05:05:11', '2022-03-23 05:05:11'),
(90, 'Chỉnh sửa Ghi chú đơn hàng', 'admin', '2022-03-23 05:06:00', '2022-03-23 05:06:00'),
(91, 'Chuyển trạng thái đơn hàng', 'admin', '2022-03-23 05:06:10', '2022-03-23 05:06:10'),
(92, 'Truy cập mục TTL', 'admin', '2022-03-23 05:08:11', '2022-03-23 05:08:11'),
(93, 'Chuyển C từ TK C-Mart', 'admin', '2022-03-23 05:10:25', '2022-03-23 05:10:25'),
(94, 'Nạp thêm C vào tk C-Mart', 'admin', '2022-03-23 05:10:42', '2022-03-23 05:10:42');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
