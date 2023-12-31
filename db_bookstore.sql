-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 31, 2023 lúc 09:41 AM
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
-- Cơ sở dữ liệu: `db_bookstore`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `id_role`) VALUES
(4, 'admin', '$2y$10$QXkq4Nwz2tR2oieS7PIFjO859c.LZTNbnvo2QaNfmQ/6SM9hk5L.e', 'giangdang2k2@gmail.com', 1),
(5, 'mod', '$2y$10$rioX023GgdfrtFRinWjgzewJ0xJR3oRZgQAlGKSOhP3sO0KEQIQx.', 'giangdang2468@gmail.com', 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(9, 'Huỳnh Thái Học'),
(10, 'Claire Belton'),
(11, 'Thảo Trang');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Tiểu thuyết '),
(7, 'Thiếu nhi'),
(8, 'Kinh dị'),
(9, 'Kinh tế');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderProduct`
--

CREATE TABLE `orderProduct` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` float NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(150) NOT NULL,
  `createDate` date NOT NULL,
  `total` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `createDate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `createDate`, `status`, `id_author`, `id_category`) VALUES
(10, 'Thỏ Bảy Màu ', 89100, 'thobaymau.jpeg', 'Thỏ Bảy Màu Và Những Người Nghĩ Nó Là Bạn (Tái Bản 2023)\r\n\r\nThỏ Bảy Màu là fanpage sở hữu hơn 2,6tr lượt thích trên mạng xã hội. Với hình tượng nhân vật thú vị cùng phong cách sáng tạo độc đáo, Thỏ bảy màu vẫn luôn là thu hút được số lượng lớn người quan tâm thể hiện qua nhiều bài viết với hàng chục nghìn lượt like và share.\r\n\r\nThỏ Bảy Màu là một nhân vật hư cấu chẳng còn xa lạ gì với anh em dùng mạng xã hội với slogan “Nghe lời Thỏ, kiếp này coi như bỏ!”.\r\n\r\nThỏ Bảy Màu đơn giản chỉ là một con thỏ trắng với sự dở hơi, ngang ngược nhưng đáng yêu vô cùng tận. Nó luôn nghĩ rằng mình không có cuộc sống và không có bạn bè.', '2023-12-29', 1, 9, 7),
(11, 'Tớ Là Mèo Pusheen', 72000, 'tolameopusheen.jpeg', '&quot;Hài hước, kì lạ và vô cùng đáng yêu&quot;\r\n\r\n(Matthew Inman, người sáng lập website The Oatmeal)\r\n\r\nTớ là mèo Pusheen - Cuốn nhật ký xoay quanh cuộc sống của Pusheen - chú mèo Icon nổi tiếng trên mạng xã hội facebook với hơn 7 triệu người hâm mộ.\r\n\r\nHãy cùng tìm hiểu những điều khiến Pusheen thích thú và lí do hàng triệu người trót mết vẻ &quot;tung tăng&quot; của nàng mèo múp míp, mũm mĩm này nhé!', '2023-12-29', 1, 10, 7),
(12, 'Tết Ở Làng Địa Ngục', 169000, 'tetolangdianguc.jpeg', 'Năm đó, tại một ngôi làng xa xôi trên một ngọn núi hoang vu, người ta đón Tết trong sự kinh hãi tột độ, hoài nghi đau đáu và giận dữ khôn cùng trước sự ập tới của những bi kich tàn khốc.\r\n\r\nNgôi làng ấy vốn dĩ không có tên, nhưng những người nơi đây mặc định chốn này là địa ngục. Dân trong làng không ai dám tự ý băng rừng thoát khỏi làng, càng không biết thế giới bên ngoài rộng lớn như thế nào, bởi lẽ họ sợ người khác sẽ biết rằng bản thân mình vốn là hậu duệ của băng cướp khét tiếng ở truông nhà Hồ dưới thời chúa Nguyễn ở Đàng Trong.', '2023-12-30', 1, 11, 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Mod');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(14) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- Chỉ mục cho bảng `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderProduct`
--
ALTER TABLE `orderProduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_order` (`id_order`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`id_author`),
  ADD KEY `products_ibfk_2` (`id_category`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `orderProduct`
--
ALTER TABLE `orderProduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orderProduct`
--
ALTER TABLE `orderProduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
