-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 29, 2021 lúc 03:02 PM
-- Phiên bản máy phục vụ: 10.4.11-MariaDB
-- Phiên bản PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code_customer` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'NONE',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoten` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(500) CHARACTER SET utf8mb4 DEFAULT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `level` tinyint(4) DEFAULT 0,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_tinhthanh` int(9) DEFAULT NULL,
  `id_phuongxa` int(9) DEFAULT NULL,
  `id_quanhuyen` int(9) DEFAULT NULL,
  `type_cmnd` int(9) DEFAULT 0,
  `cmnd` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cmnd_image2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `check_kyc` int(9) DEFAULT 0,
  `tichluyC` int(9) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `code_customer`, `avatar`, `hoten`, `password`, `email`, `phone`, `level`, `address`, `id_tinhthanh`, `id_phuongxa`, `id_quanhuyen`, `type_cmnd`, `cmnd`, `cmnd_image`, `cmnd_image2`, `check_kyc`, `tichluyC`, `created_at`, `updated_at`) VALUES
(1, 'truong', 'NONE', NULL, NULL, '$2y$10$GpRjtByq.8BL20XQ8aXWP.jD6P/EDOYzILU9BlIYNx.E1U1Tjd9Hq', 'truong@gmail.com', '1231324', 0, '998 Quang Trung asfas', NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 1000, '2021-10-01 02:27:58', '2021-11-02 23:45:14'),
(13, 'thinh3', 'NONE', 'GettyImages-1036106366-5c58ee26c9e77c00016b4152.jpg', 'Thinh nguyen', '$2y$10$9qzQ.LDsbPeMJAizEnHqnOL3I/j2bvnM1amPqPQQA6IBTj6p6BaI.', 'thinhnguyen01165@gmail.com', '01235221111', 1, '114 Quang Trung', NULL, NULL, NULL, 2, '215440000', 'cmnd.jpg', NULL, 1, 5400000, '2021-11-02 07:15:49', '2021-11-21 19:38:02'),
(14, 'thinh4', 'NONE', NULL, NULL, '$2y$10$3LlJGvvRHNlC6YvT5RfZjudl7aZm5XTDcAkqrC.m9cZQSU5W4u4ji', 'thinh4@gmail.com', '0852211167', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-11-03 07:07:51', '2021-11-03 07:07:51'),
(15, 'thinh3', 'NONE', NULL, NULL, '$2y$10$5hYsnLLcFmc7ObBlu1b4oOYAYsbH0kChIffclx.FjABu.tYXofjPC', 'thinhnguyen065@gmail.com', '12345678912312', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-11-04 07:47:44', '2021-11-04 07:47:44'),
(16, 'thinh3', 'NONE', NULL, NULL, '$2y$10$yRF53CKEej7ntKVWpYBuSuXzQBK0atd146V/mZjmOFlOm1CJNwK6e', '124@gmail.com', '12345678912312', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-11-04 07:49:09', '2021-11-04 07:49:09'),
(17, 'thinh5', 'NONE', NULL, 'Thinh', '$2y$10$CcOnF1dpPKeP4lL5NK6UMeO8FrJd6mVYtiDNcrmOMXIgbB3Cj5I2.', 'thinhnguyen01144@gmail.com', '1234567890', 0, '115 Quang Trung', NULL, NULL, NULL, 0, '21526600', NULL, NULL, 0, 0, '2021-11-04 07:58:04', '2021-11-04 09:03:38'),
(18, 'thinh6', 'NONE', 'call.png', 'Thinh nguyen day', '$2y$10$Zy9uIlkM2kpCYJr8RDhuvOOjlzQZiHAx7kbE2GH2ehCe8Fb1rCFBW', 'thinh6@gmail.com', '0123455789', 0, '114 Quang Trung', 23, 23539, 2353, 1, '215266001', 'cmnd.jpg', 'call.png', 1, 0, '2021-11-21 19:44:45', '2021-11-22 03:39:20'),
(20, 'thinh7', 'NONE', NULL, 'Thinh nguyen', '$2y$10$YKrYHPuS5W9ZD9TYUhKnM.JXl6jhUc5VE72auzgg33lcIPlkcUjiq', 'thinh7@gmail.com', '0907777777', 0, '116 Quang Trung', 10, 18831, 1883, 0, '21526609', 'cmnd.jpg', 'cmnd.jpg', 0, 0, '2021-11-22 07:40:34', '2021-11-22 07:42:51'),
(21, 'thinh8', 'NONE', NULL, NULL, '$2y$10$NDdFppR4mKCtn8.SDo6YZ.K11Cw4q8mGj5qTR2mchD6sLdTPzFlT6', 'thinh8@gmail.com', '0569999999', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-03 06:56:23', '2021-12-03 06:56:23'),
(22, 'thinh9', 'NONE', NULL, 'thinh day', '$2y$10$y2QlHE6c.Zu5zZ/cPnpMJOLAGp4nR/bLFfGGq4DLRvEvUdr7Llk4.', NULL, '0914241456', 0, '14355 thinh', 20, 20775, 2075, 1, '215445354', 'z2907591883518_062f411f6f0d3c91abcf42472994e8cc.jpg', 'z2907591901305_a8e93604b204c4160e898a3c72516cb5.jpg', 0, 0, '2021-12-03 07:22:54', '2021-12-03 07:24:03'),
(23, 'kirabboy', 'NONE', NULL, NULL, '$2y$10$i71vfLZv.mJ94TS.K3qlFOe8a.x.M9hYDvl6m10.N1XP1ioaNXPWy', 'nc.hung0806@gmail.com', '0338927456', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-04 07:28:11', '2021-12-04 07:28:11'),
(24, 'Le Dai Cuong', 'NONE', NULL, NULL, '$2y$10$/cJs5v6.HpbKZ3CebLTsrej9K7OEVBstQa/3gvRFPFMcRfrWQtTvC', NULL, '0888826027', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, '2021-12-08 02:48:28', '2021-12-08 02:49:15'),
(25, NULL, 'NONE', NULL, NULL, '$2y$10$zoeGtv3mdVjXtCdkx40/B.mUxlR3CbL.rOu21zBfzhOu4N6YrdFRG', NULL, '0899302323', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-08 03:05:39', '2021-12-08 03:05:39'),
(26, NULL, 'NONE', NULL, NULL, '$2y$10$yIUWp1MAHUwUFIRviWMHoeOBCx1/6OOlg1Nogh.IElc9vuvmIHt1S', NULL, '0905361059', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, '2021-12-08 03:07:06', '2021-12-08 03:07:35'),
(28, 'cmart', 'NONE', NULL, NULL, '$2y$10$TwqsDAZIoQdGfzsbdX0TZe08s3ogKBkLlWTWUfGxO5.1GP1dQHTTG', NULL, NULL, 2, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 1, 0, '2021-12-13 08:21:58', '2021-12-25 07:40:32'),
(29, 'truongvietan', 'NONE', NULL, NULL, '$2y$10$HShiK8bo64Wr.jpIhkpUnuf6ssPkqqaHWpghPo4dKDEQEH9s.qLoy', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-13 09:11:57', '2021-12-13 09:11:57'),
(31, 'testingfinal', 'NONE', NULL, 'Thinh nguyen', '$2y$10$Fb8oCYYBe1tjB6dfI.ivK.SA3HAKV5LDG6Us.iBlv.0/ioH1q16He', NULL, '01235225465', 1, '114 Quang Trung5', 17, 17620, 1761, 1, NULL, NULL, NULL, 1, 0, '2021-12-13 09:31:59', '2021-12-13 09:43:29'),
(32, '0849082949', 'NONE', NULL, NULL, '$2y$10$JpSswKPp8BgoqLTBDruOLu8agOEiPfOpkceZ3SS.Ebwt3YXOtuCtq', NULL, '0849082949', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 2, 0, '2021-12-20 11:53:58', '2021-12-24 02:41:36'),
(33, 'Đoàn quyết', 'NONE', NULL, 'Đoàn quyết', '$2y$10$EdwdV3/6RZ32jYnrAunlh.8EUah2lzsQ6aYoxFNgh05C6hf2m9vSu', NULL, '0942290942', 0, '185/9/1 nguyễn phúc chu', 70, 73690, 7360, 0, NULL, NULL, NULL, 1, 0, '2021-12-22 00:01:26', '2021-12-22 00:29:26'),
(34, 'kira3', 'NONE', NULL, NULL, '$2y$10$xcRNZved8UvfSgZL/mjhEOvv2v/OEJMrybyYPD15jXvoCKR3Hz8e.', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-24 03:11:32', '2021-12-24 03:11:32'),
(35, '01239999999', 'NONE', NULL, NULL, '$2y$10$deQ6ScJ8wO4vMp2D3mXqIe72Qzs31b0NlH/qEgFHFBW4QBM2RkPC.', NULL, NULL, 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, 0, 0, '2021-12-24 04:45:31', '2021-12-24 04:45:31'),
(36, 'demoio', 'NONE', NULL, 'Le Dai Cuong', '$2y$10$3m4Q8vyaQniI7FObcQLD/O.rir4M.VDgGgGpT0cX2M2.tnEwtrfF2', NULL, '0905361058', 0, 'Thôn Triêm Trung 1', 23, 23419, 2340, 1, NULL, NULL, NULL, 0, 0, '2021-12-24 13:14:46', '2021-12-29 04:00:21'),
(49, NULL, '202112290001', NULL, 'Thinh nguyen', '$2y$10$IQiepErS5EYppyBIgo4fNOcqgIqK1FrIHlvDnoYop7QBMZE7yq/ai', NULL, '0123123123', 0, '115 Quang Trung', 33, 33161, 3316, 1, NULL, '1640786286.png', '1640786286.png', 0, 0, '2021-12-29 13:58:06', '2021-12-29 13:58:06');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
