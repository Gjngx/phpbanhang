-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2024 at 10:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `id_role`) VALUES
(6, 'admin123', '$2y$10$JxBagWqqKHV6Af5VwiK4f.6I1uS59SMhJ0AQs.k/KVvVKmqUJCGFW', 'giangdang2k2@gmail.com', 1),
(8, 'mod', '$2y$10$b9DdL6JgALjEDL9ld.ZD.epCxS5vG5bzK6PkWp8wUPirvrPy/hXvK', 'mod123@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(9, 'Huỳnh Thái Học'),
(10, 'Claire Belton'),
(11, 'Thảo Trang'),
(13, 'B R O Group'),
(14, 'Phùng Quán'),
(15, 'Giản Tư Trung'),
(16, 'Sarah Wood'),
(17, 'Mặc Thư Bạch'),
(18, 'Gosho Aoyama'),
(19, 'Riichiro Inagaki, Boichi');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, 'Tiểu thuyết '),
(7, 'Thiếu nhi'),
(8, 'Kinh dị'),
(9, 'Kinh tế'),
(10, 'manga');

-- --------------------------------------------------------

--
-- Table structure for table `orderproduct`
--

CREATE TABLE `orderproduct` (
  `id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderproduct`
--

INSERT INTO `orderproduct` (`id`, `amount`, `id_product`, `id_order`) VALUES
(2, 1, 10, 6),
(3, 1, 11, 6),
(9, 1, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customerName`, `email`, `phone`, `address`, `createDate`, `total`, `status`, `id_user`) VALUES
(6, 'Test', 'giangdang2k2@gmail.com', '0378687955', 'Bình thạnh', '2024-01-01', 161100, 1, 4),
(11, 'giang', 'giangdang2k2@gmail.com', '0378687955', '123', '2024-01-02', 89100, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
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
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `description`, `createDate`, `status`, `id_author`, `id_category`) VALUES
(10, 'Thỏ Bảy Màu ', 89100, 'thobaymau.jpeg', 'Thỏ Bảy Màu Và Những Người Nghĩ Nó Là Bạn (Tái Bản 2023)\r\n\r\nThỏ Bảy Màu là fanpage sở hữu hơn 2,6tr lượt thích trên mạng xã hội. Với hình tượng nhân vật thú vị cùng phong cách sáng tạo độc đáo, Thỏ bảy màu vẫn luôn là thu hút được số lượng lớn người quan tâm thể hiện qua nhiều bài viết với hàng chục nghìn lượt like và share.\r\n\r\nThỏ Bảy Màu là một nhân vật hư cấu chẳng còn xa lạ gì với anh em dùng mạng xã hội với slogan “Nghe lời Thỏ, kiếp này coi như bỏ!”.\r\n\r\nThỏ Bảy Màu đơn giản chỉ là một con thỏ trắng với sự dở hơi, ngang ngược nhưng đáng yêu vô cùng tận. Nó luôn nghĩ rằng mình không có cuộc sống và không có bạn bè.', '2023-12-29', 1, 9, 7),
(11, 'Tớ Là Mèo Pusheen', 72000, 'tolameopusheen.jpeg', '&quot;Hài hước, kì lạ và vô cùng đáng yêu&quot;\r\n\r\n(Matthew Inman, người sáng lập website The Oatmeal)\r\n\r\nTớ là mèo Pusheen - Cuốn nhật ký xoay quanh cuộc sống của Pusheen - chú mèo Icon nổi tiếng trên mạng xã hội facebook với hơn 7 triệu người hâm mộ.\r\n\r\nHãy cùng tìm hiểu những điều khiến Pusheen thích thú và lí do hàng triệu người trót mết vẻ &quot;tung tăng&quot; của nàng mèo múp míp, mũm mĩm này nhé!', '2023-12-29', 1, 10, 7),
(12, 'Tết Ở Làng Địa Ngục', 169000, 'tetolangdianguc.jpeg', 'Năm đó, tại một ngôi làng xa xôi trên một ngọn núi hoang vu, người ta đón Tết trong sự kinh hãi tột độ, hoài nghi đau đáu và giận dữ khôn cùng trước sự ập tới của những bi kich tàn khốc.\r\n\r\nNgôi làng ấy vốn dĩ không có tên, nhưng những người nơi đây mặc định chốn này là địa ngục. Dân trong làng không ai dám tự ý băng rừng thoát khỏi làng, càng không biết thế giới bên ngoài rộng lớn như thế nào, bởi lẽ họ sợ người khác sẽ biết rằng bản thân mình vốn là hậu duệ của băng cướp khét tiếng ở truông nhà Hồ dưới thời chúa Nguyễn ở Đàng Trong.', '2023-12-30', 0, 11, 8),
(14, 'Lớp Học Mật Ngữ 1', 25500, 'lhmn-phienbanmoi-tap2-1165_1.jpg', 'HHT - Khi cạ cứng tự nhiên quay ra giận đùng đùng. Là có thân dữ chưa? Nếu bạn đã hoặc đang rơi vào tình huống bực bội với bạn mình, Lớp Học Mật Ngữ phiên bản mới Tập 2 chính là cẩm nang để xóa tan hiểu lầm và nạp thêm năng lượng cho chuyến xe tình bạn lại lao đi vun vút.\r\n\r\nHẹn gặp nhau ở “Bùng binh giận dỗi”', '2024-01-03', 1, 13, 7),
(15, 'Lớp Học Mật Ngữ ', 21500, 'z4113307553305_aa5e027926d792b10f.jpg', 'LỚP HỌC MẬT NGỮ\r\n\r\nPHIÊN BẢN NHỎ MÀ CÓ VÕ!\r\n\r\nChào năm mới, Lớp Học Mật Ngữ sẽ trình làng một phiên bản siêu xịn sò: Nhẹ ví hơn, phát hành đều đặn hơn và gay cấn hơn, cùng khám phá nhé!\r\n\r\nThì ra mùa Xuân hoa nở là vì Lớp Học Mật Ngữ MỚI', '2024-01-03', 1, 13, 7),
(16, 'Tuổi Thơ Dữ Dội', 20600, 'image_187162.jpg', '“Tuổi Thơ Dữ Dội” là một câu chuyện hay, cảm động viết về tuổi thơ. Sách dày 404 trang mà người đọc không bao giờ muốn ngừng lại, bị lôi cuốn vì những nhân vật ngây thơ có, khôn ranh có, anh hùng có, vì những sự việc khi thì ly kỳ, khi thì hài hước, khi thì gây xúc động đến ứa nước mắt...', '2024-01-03', 1, 14, 7),
(17, 'Quản Trị Bằng Văn Hóa', 50000, '8935280401068.jpg', 'Thông qua cuốn sách, TS Giản Tư Trung cũng mong muốn góp phần cổ vũ và thúc đẩy cho sự phát triển của một phương cách quản trị mới, vừa nhân văn, vừa hiệu quả, đó là “Quản trị bằng Văn hóa / Quản trị bằng Tự trị”', '2024-01-03', 1, 15, 9),
(18, 'Phiên chợ sách cũ Nhà Quản Lý 4.0', 20000, 'image_189772_thanh_ly.jpg', '“Nhà quản lý 4.0” của Sarah Wood đưa độc giả bước vào một hành trình lãnh đạo gồm 5 bước: Từ việc thấu hiểu sự thay đổi của thế giới hiện nay, đến xác lập sứ mệnh lãnh đạo cá nhân, phát triển bộ công cụ lãnh đạo, xây dựng đội ngũ ưu tú và trao quyền để họ tạo ra thành quả xuất sắc. Thật vậy, chúng ta đang sống ở một kỷ nguyên mà công nghệ đã làm thay đổi quá nhiều điều, từ cách sinh hoạt, cách giao tiếp, cách xây dựng mối quan hệ đến cách làm việc. Triết lý lãnh đạo đã biến chuyển rất nhiều, và những giả thuyết, phương pháp cũ sẽ không thể bắt kịp một thế giới đầy ắp đổi thay.', '2024-01-03', 1, 10, 9),
(19, 'Trường Phong Độ', 500000, 'tr_ng-phong-_-1.jpg', 'ặc Thư Bạch - Tác giả của mạng văn học Tấn Giang, được đông đảo độc giả yêu thích bởi tài năng viết lách sắc bén, cảm xúc tinh tế và xây dựng nhân vật sâu sắc. Tác phẩm nổi bật:', '2024-01-03', 1, 17, 6),
(20, 'Vì Con Gái Tôi ', 85100, 'vi-con-gai-toi-co-the-danh-bai-ca-ma-vuong-5_1.jpg', 'Sau phần kết tập 4 đầy ngọt ngào với việc Dale và Latina đã chính thức xác nhận mối quan hệ, tập 5 mở ra với những tháng ngày hạnh phúc của cặp đôi tại Lều Cẩm miêu Vũ ở thị trấn Kreuz. Tuy nhiên, ngày vui ngắn chẳng tày gang, cuộc tái ngộ với Chrysos - người gắn liền với những hồi ức tốt đẹp ít ỏi mà Latina có được khi còn ở Vassilios đã chấm dứt hoàn toàn chuỗi ngày bình yên.', '2024-01-03', 1, 11, 6),
(21, 'Vì Cậu Là Bạn Nhỏ Của Tớ', 78100, 'v_-c_u-l_-b_n-nh_-c_a-t_.jpg', 'Vì cậu là bạn nhỏ của tớ” là cuốn sách đầu tay đánh dấu chặng hành trình phát triển, nỗ lực không ngừng nghỉ của Tác giả, MC, Content Creator Tun Phạm.\r\n\r\nNhờ vào góc nhìn và tâm tư sâu sắc, quyển sách như cẩm nang đồng hành cùng thế hệ trẻ vượt qua cơn bão “overthinking” với những cảm xúc, suy nghĩ tiêu cực trong các vấn đề khó khăn thường gặp.', '2024-01-03', 1, 14, 6),
(22, 'Thám Tử Lừng Danh Conan', 105000, 'tham-tu-lung-danh-conan_bia_tap-101.jpg', 'Mật mã Akemi Miyano để lại ẩn chứa gợi ý về vị trí chôn chiếc hộp thời gian ở trường tiểu học!? Conan dẽ cùng nhóm Haibara hợp sức giải mã!!', '2024-01-03', 1, 18, 10),
(23, 'Dr.STONE', 51900, 'dr.-stone_bia_tap-21.jpg', 'Cuộc đua xuyên Nam Mĩ hướng tới “tâm chấn” của hiện tượng hóa đá đã tiến vào rừng rậm Amazon! Tại vùng đất khởi nguồn của đại thảm họa, thứ ánh sáng kinh khủng tràn ngập ác ý mà nhóm Senku tận mắt chứng kiến là gì...!? Ở “thánh địa đá” nằm tại nơi tận cùng của Amazon, trận quyết chiến cuối cùng với Stanley sắp sửa ập đến!!', '2024-01-03', 1, 19, 10);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Mod');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `phone`, `address`) VALUES
(4, 'aa', '$2y$10$3bEnlV/bQCwAlR6/NdrDlOO6TeaR/3HI6C77ijnFrmro20I2wP/2C', 'giang', 'giangdang2k2@gmail.com', '0378687955', 'Bình thạnh'),
(5, 'admin', '$2y$10$6vEorgOy7MkfUUX0FPwx8u6oCkjzH5ngTN2MU6JD6u3VIaQHBbnDW', '', 'giangdang2k2@gmail.com', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orderproduct_ibfk_1` (`id_product`),
  ADD KEY `orderproduct_ibfk_2` (`id_order`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_ibfk_1` (`id_author`),
  ADD KEY `products_ibfk_2` (`id_category`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orderproduct`
--
ALTER TABLE `orderproduct`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orderproduct`
--
ALTER TABLE `orderproduct`
  ADD CONSTRAINT `orderproduct_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orderproduct_ibfk_2` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_author`) REFERENCES `authors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
