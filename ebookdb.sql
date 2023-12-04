-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 05:09 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ebookdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `nhaxb`
--

CREATE TABLE `nhaxb` (
  `MaNXB` tinyint(4) NOT NULL,
  `TenNXB` varchar(40) NOT NULL,
  `DiaChi` varchar(40) NOT NULL,
  `DienThoai` varchar(15) DEFAULT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhaxb`
--

INSERT INTO `nhaxb` (`MaNXB`, `TenNXB`, `DiaChi`, `DienThoai`, `Email`) VALUES
(1, 'Gi&aacute;o D&#7909;c', '33 H&agrave;m Nghi', '02412346789', 'nxbgiaoduc@email.com'),
(2, 'Khoa H&#7885;c K&#7929; Thu&#7853;t', '24 Chu V&#259;n An', '02437899456', 'nxbkhoahockythuat@email.com'),
(3, 'Kim &#272;&#7891;ng', '169 Nguy&#7877;n Th&#7883; Minh Khai', '02456789123', 'nxbkimdong@email.com'),
(4, 'Thanh Ni&ecirc;n', '210 L&ecirc; Lai', '02889123456', 'nxbthanhnien@email.com');

-- --------------------------------------------------------

--
-- Table structure for table `sach`
--

CREATE TABLE `sach` (
  `ISBN` varchar(10) NOT NULL,
  `Tua` varchar(40) NOT NULL,
  `TacGia` varchar(50) NOT NULL,
  `NamXB` smallint(6) NOT NULL,
  `LanXB` tinyint(4) NOT NULL,
  `SoTrang` smallint(6) NOT NULL,
  `GiaBia` int(11) NOT NULL,
  `GiaBan` int(11) NOT NULL,
  `DacBiet` bit(1) NOT NULL,
  `Hinh` varchar(30) DEFAULT NULL,
  `MaTheLoai` tinyint(4) DEFAULT NULL,
  `MaNXB` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sach`
--

INSERT INTO `sach` (`ISBN`, `Tua`, `TacGia`, `NamXB`, `LanXB`, `SoTrang`, `GiaBia`, `GiaBan`, `DacBiet`, `Hinh`, `MaTheLoai`, `MaNXB`) VALUES
('12123412', 'Java Lập trình mạng', 'Ho&agrave;ng An', 2010, 2, 300, 55000, 45000, b'1', 'Java.jpg', 2, 1),
('12123413', 'Lập trình Visual C++', 'Nh&#7845;t B&igrave;nh', 2012, 1, 200, 50000, 40000, b'1', '20.jpg', 2, 1),
('12123414', 'Java Script', 'L&ecirc; Anh D&#361;ng', 2017, 1, 250, 40000, 40000, b'1', 'Javascript.jpg', 2, 2),
('13143516', 'Toán rời rạc', 'Ho&agrave;ng &#272;&#7913;c H&#7843;i', 2016, 1, 270, 35000, 30000, b'0', '21.jpg', 1, 2),
('13143517', 'Bộ Luật Hình Sự', 'Minh Nh&#7845;t', 2005, 3, 150, 60000, 55000, b'0', 'BOLUAT.JPG', 10, 1),
('13143520', 'Tiếu Ngạo Giang Hồ', 'Khang Nguy&ecirc;n', 2010, 2, 200, 70000, 80000, b'1', 'LHX.JPG', 6, 3),
('13143526', 'Lịch Sử Âm Nhạc', 'Kh&aacute;nh Loan', 2016, 1, 150, 90000, 85000, b'0', 'LSUAMN~1.JPG', 7, 4),
('15343443', 'Hạt cơ bản', 'Nguy&#7877;n Ng&#7885;c Giao', 2014, 1, 230, 25000, 25000, b'0', '22.jpg', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `thanhvien`
--

CREATE TABLE `thanhvien` (
  `MaTV` int(11) NOT NULL,
  `TenDangNhap` varchar(20) NOT NULL,
  `MatKhau` varchar(20) NOT NULL,
  `HoLot` varchar(35) NOT NULL,
  `Ten` varchar(10) NOT NULL,
  `NgaySinh` datetime NOT NULL,
  `GioiTinh` bit(1) NOT NULL DEFAULT b'1',
  `DienThoai` varchar(15) DEFAULT NULL,
  `Email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `theloai`
--

CREATE TABLE `theloai` (
  `MaTheLoai` tinyint(4) NOT NULL,
  `TenTheLoai` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `theloai`
--

INSERT INTO `theloai` (`MaTheLoai`, `TenTheLoai`) VALUES
(12, '&#272;&#7883;a l&yacute;'),
(14, '&Acirc;m nh&#7841;c'),
(9, 'Anh v&#259;n'),
(19, 'Ch&iacute;nh tr&#7883;'),
(13, 'Gi&aacute;o d&#7909;c'),
(4, 'H&oacute;a h&#7885;c'),
(6, 'K&#7929; thu&#7853;t'),
(17, 'Khoa h&#7885;c'),
(16, 'Kinh t&#7871;'),
(8, 'L&#7883;ch s&#7917;'),
(15, 'M&#7929; thu&#7853;t'),
(18, 'N&ocirc;ng nghi&#7879;p'),
(11, 'Ph&aacute;p lu&#7853;t'),
(5, 'Sinh h&#7885;c'),
(20, 'Th&#7875; d&#7909;c'),
(21, 'Th&#7901;i trang'),
(10, 'Th&#7921;c ph&#7849;m'),
(2, 'Tin h&#7885;c'),
(1, 'To&aacute;n h&#7885;c'),
(7, 'V&#259;n h&#7885;c'),
(3, 'V&#7853;t l&yacute;');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nhaxb`
--
ALTER TABLE `nhaxb`
  ADD PRIMARY KEY (`MaNXB`);

--
-- Indexes for table `sach`
--
ALTER TABLE `sach`
  ADD PRIMARY KEY (`ISBN`),
  ADD KEY `MaTheLoai` (`MaTheLoai`),
  ADD KEY `MaNXB` (`MaNXB`);

--
-- Indexes for table `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`MaTV`),
  ADD UNIQUE KEY `TenDangNhap` (`TenDangNhap`);

--
-- Indexes for table `theloai`
--
ALTER TABLE `theloai`
  ADD PRIMARY KEY (`MaTheLoai`),
  ADD UNIQUE KEY `TenTheLoai` (`TenTheLoai`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `MaTV` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sach`
--
ALTER TABLE `sach`
  ADD CONSTRAINT `sach_ibfk_1` FOREIGN KEY (`MaTheLoai`) REFERENCES `theloai` (`MaTheLoai`),
  ADD CONSTRAINT `sach_ibfk_2` FOREIGN KEY (`MaNXB`) REFERENCES `nhaxb` (`MaNXB`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;