-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 15, 2022 lúc 11:06 AM
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
-- Cấu trúc bảng cho bảng `setting_payment_payme`
--

CREATE TABLE `setting_payment_payme` (
  `id` int(11) NOT NULL,
  `private_key` text DEFAULT NULL,
  `public_key` text DEFAULT NULL,
  `accessToken` text DEFAULT NULL,
  `app_id` varchar(255) DEFAULT NULL,
  `store_id` int(11) NOT NULL,
  `domain` text DEFAULT NULL,
  `environment` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `setting_payment_payme`
--

INSERT INTO `setting_payment_payme` (`id`, `private_key`, `public_key`, `accessToken`, `app_id`, `store_id`, `domain`, `environment`, `created_at`, `updated_at`) VALUES
(1, '-----BEGIN RSA PRIVATE KEY-----\r\nMIIBOwIBAAJBAL8k/xiHJHKAvZSQUCy9GG3vfl3ejMlOsUI9a4o/sm5MjtGX1uJZ\r\nUCOykr6f3NnJi+8gyFySoPDCL1qj84fv93ECAwEAAQJBAJY4DCcJpnI6jUNhezD9\r\n12Imsugwy/I1XweQ36BB2Qfm0YjiMR/d7XnEd/6tcBC73k8c+WQ87aOVjraoaqQf\r\nmGUCIQD/sjJSIyllby9OysWajEjJa4fh+qABIYbNYAMCjt78FwIhAL9fKHjfTPUF\r\nLCui/LSAaPioF+u1tlBrfDSA+5ChDzW3AiA44nf3dgMboeSwbsQPYe4/gUC1sYAv\r\nQDoxLo783rQU+QIgUSv1qL9ejxcwkxnBAnbtD3uNGeerexT8S/Dhw4jtQKUCIQDq\r\nFDRGO+WCRf4VpdfG0fxWa8Av6XuCho7zonmVyutCCg==\r\n-----END RSA PRIVATE KEY-----', '-----BEGIN PUBLIC KEY-----\r\nMFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBAIvcdo7xrkLeGjI8pYr+wOW8dIizA4Ui\r\nkT5wdnE6b3pvmyIcT81NfiezWllBbcFQkP/0FQzLAp2LWlsaPrCZys0CAwEAAQ==\r\n-----END PUBLIC KEY-----', 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6NTIxOCwiYXBwSWQiOiIwMDcxMTUwMjM1ODQiLCJtZXJjaGFudElkIjoxMjg1MDUsInN0b3JlSWQiOjEwNTgxMjA3LCJhY2NvdW50SWQiOjQ0NywidHlwZSI6IkFQUCIsImlhdCI6MTYyMTY2MzQyN30.Y0jP1REH42l_gHjKUiMgXSkbiywNR1CpdnMfuskiO0I', '007115023584', 10581207, 'https://sbx-gapi.payme.vn/', 0, '2022-02-14 10:00:07', '2022-02-14 10:00:07');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `setting_payment_payme`
--
ALTER TABLE `setting_payment_payme`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `setting_payment_payme`
--
ALTER TABLE `setting_payment_payme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
