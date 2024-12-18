-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2024 at 03:48 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aristino`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `tel_user` varchar(15) NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `tongtien` varchar(255) DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `id` int(10) NOT NULL,
  `id_cart` int(10) UNSIGNED NOT NULL,
  `idsp` int(10) UNSIGNED NOT NULL,
  `name_sp` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` enum('S','M','L','XL') DEFAULT NULL,
  `masp` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `giatien` varchar(255) NOT NULL,
  `soluong` int(3) NOT NULL,
  `thanhtien` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `danhmuc`
--

CREATE TABLE `danhmuc` (
  `id` int(4) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `img_dm` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `danhmuc`
--

INSERT INTO `danhmuc` (`id`, `name`, `img_dm`, `created_time`, `last_updated`) VALUES
(1, 'Áo sơ mi', 'somi.png', 1700915721, 1700915721),
(2, 'Áo polo', 'polo.png', 1700915721, 1700915721),
(3, 'Quần', 'quanau.png', 1700915721, 1700915721),
(4, 'Suit', 'suit.png', 1700915721, 1700915721),
(5, 'Giảm giá', 'blackfriday.png', 1700915721, 1700915721);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `name_user` varchar(255) NOT NULL,
  `tel_user` varchar(255) NOT NULL,
  `address_user` varchar(255) NOT NULL,
  `dongia` varchar(255) NOT NULL,
  `thanhtienint` int(255) NOT NULL,
  `status` enum('0','1','2','3') NOT NULL DEFAULT '0',
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `id_user`, `name_user`, `tel_user`, `address_user`, `dongia`, `thanhtienint`, `status`, `created_time`, `last_updated`) VALUES
(72, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '0', 1701165661, 1701165661),
(74, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '10,844,000', 10844000, '1', 1701191059, 1701191059),
(75, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 955000, '0', 1701413403, 1701413403),
(76, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '2,985,000', 2985000, '2', 1701413430, 1701413430),
(77, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '0', 1701961749, 1701961749),
(78, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '3', 1702005180, 1702005180),
(79, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '3,000,000', 3000000, '0', 1702005357, 1702005357),
(80, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '75,000,000', 75000000, '0', 1702005415, 1702005415),
(81, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '2', 1702005485, 1702005485),
(82, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '0', 1702041005, 1702041005),
(83, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '13,930,000', 13930000, '0', 1702041629, 1702041629),
(84, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '0', 1702041855, 1702041855),
(85, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '61,690,000', 61690000, '0', 1702041865, 1702041865),
(86, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '0', 1702089565, 1702089565),
(87, 74, 'Doan Van Huy', '0389315421', 'Viet Nam', '650,000', 650000, '0', 1702100670, 1702100670),
(88, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '1,300,000', 1300000, '0', 1702100784, 1702100784),
(89, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '0', 1702101378, 1702101378),
(90, 1, 'admin', 'admin', 'Hà Nội', '895,000', 895000, '2', 1702141513, 1702141513),
(91, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '5,950,000', 5950000, '0', 1702195319, 1702195319),
(92, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '5,410,000', 5410000, '0', 1702195366, 1702195366),
(94, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '25,500,000', 25500000, '0', 1702272930, 1702272930),
(95, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '2,975,000', 2975000, '0', 1702290474, 1702290474),
(96, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '31,800,000', 31800000, '0', 1702290867, 1702290867),
(97, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '995,000', 995000, '0', 1702290963, 1702290963),
(98, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '4,750,000', 4750000, '0', 1702291424, 1702291424),
(99, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '2,440,000', 2440000, '0', 1702292172, 1702292172),
(100, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '34,000,000', 34000000, '0', 1702292317, 1702292317),
(101, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '3,250,000', 3250000, '0', 1702292422, 1702292422),
(102, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '3,250,000', 3250000, '0', 1702292563, 1702292563),
(103, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '2,495,000', 2495000, '0', 1702292806, 1702292806),
(104, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '0', 1702294982, 1702294982),
(105, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '0', 1702295203, 1702295203),
(106, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '1,190,000', 1190000, '0', 1702302468, 1702302468),
(107, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '650,000', 650000, '0', 1702572558, 1702572558),
(108, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '2,685,000', 2685000, '0', 1702652044, 1702652044),
(109, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '10,944,000', 10944000, '0', 1702652054, 1702652054),
(110, 1, 'admin', 'admin', 'Hà Nội', '895,000', 895000, '2', 1702659834, 1702659834),
(111, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '10,045,000', 10045000, '0', 1702660117, 1702660117),
(112, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '1,945,000', 1945000, '0', 1702701283, 1702701283),
(113, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '8,500,000', 8500000, '0', 1702701429, 1702701429),
(114, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '895,000', 895000, '0', 1702701492, 1702701492),
(115, 71, 'Doan Van Huy', '0389315420', 'Nam Giang, Nam Trực, Nam Định', '895,000', 895000, '0', 1703513281, 1703513281);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_purchase` int(10) UNSIGNED NOT NULL,
  `idsp` int(10) UNSIGNED NOT NULL,
  `name_sp` varchar(255) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` enum('S','M','L','XL') NOT NULL,
  `masp` varchar(50) NOT NULL,
  `img` varchar(255) NOT NULL,
  `giatien` varchar(255) NOT NULL,
  `soluong` int(3) NOT NULL,
  `thanhtien` varchar(255) NOT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`id`, `id_purchase`, `idsp`, `name_sp`, `color`, `size`, `masp`, `img`, `giatien`, `soluong`, `thanhtien`, `created_time`, `last_updated`) VALUES
(45, 72, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 1, '995,000', 1701165661, 1701165661),
(46, 74, 0, 'Áo polo nam ngắn tay ', 'Be 78', 'S', 'APS165S3', 'APS165S3_1.jpg', '499,000', 1, '499,000', 1701191059, 1701191059),
(47, 74, 0, 'Quần âu nam', 'Đen', 'S', 'ATRR16', 'ATRR16_1.jpg', '1,050,000', 1, '1,050,000', 1701191059, 1701191059),
(48, 74, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 1, '8,500,000', 1701191059, 1701191059),
(49, 74, 0, 'Áo sơ mi nam dài tay', 'Trắng in chấm xanh', 'S', 'ALS02903', 'ALS02903_1.jpg', '795,000', 1, '795,000', 1701191059, 1701191059),
(50, 75, 0, 'Áo sơ mi nam dài tay ', 'Xanh in kẻ', 'S', 'ALS26202', 'ALS26202_1.jpg', '995,000', 1, '995,000', 1701413403, 1701413403),
(51, 76, 0, 'Áo sơ mi nam dài tay ', 'Xanh in kẻ', 'S', 'ALS26202', 'ALS26202_1.jpg', '995,000', 1, '995,000', 1701413430, 1701413430),
(52, 76, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 2, '1,990,000', 1701413430, 1701413430),
(53, 77, 0, 'Áo sơ mi nam dài tay ', 'Xanh in kẻ', 'S', 'ALS26202', 'ALS26202_1.jpg', '995,000', 1, '995,000', 1701961749, 1701961749),
(54, 78, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702005180, 1702005180),
(55, 79, 0, 'Quần âu nam', 'Đen 21 solid dobby', 'S', 'ATR00503', 'ATR00503_1.jpg', '750,000', 4, '3,000,000', 1702005357, 1702005357),
(56, 80, 0, 'Quần âu nam', 'Đen 21 solid dobby', 'S', 'ATR00503', 'ATR00503_1.jpg', '750,000', 100, '75,000,000', 1702005415, 1702005415),
(57, 81, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 1, '995,000', 1702005485, 1702005485),
(58, 82, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 1, '995,000', 1702041005, 1702041005),
(59, 83, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 14, '13,930,000', 1702041629, 1702041629),
(60, 84, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 1, '995,000', 1702041855, 1702041855),
(61, 85, 0, 'Áo sơ mi dài tay', 'Đen kẻ cam', 'S', 'ALS01903', 'ALS01903_1.jpg', '995,000', 62, '61,690,000', 1702041865, 1702041865),
(62, 86, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702089565, 1702089565),
(63, 87, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702100670, 1702100670),
(64, 88, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 2, '1,300,000', 1702100784, 1702100784),
(65, 89, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702101378, 1702101378),
(66, 90, 0, 'Áo sơ mi dài tay ', 'Trắng dệt jacquard h', 'S', 'ALS17403', 'ALS17403_1.jpg', '895,000', 1, '895,000', 1702141513, 1702141513),
(67, 91, 0, 'Áo thun có cổ ngắn tay', 'Xanh cổ vịt', 'S', 'APS157S3', 'APS157S3_1.jpg', '595,000', 10, '5,950,000', 1702195319, 1702195319),
(68, 92, 0, 'Áo thun có cổ ngắn tay', 'Xanh cổ vịt', 'S', 'APS157S3', 'APS157S3_1.jpg', '595,000', 8, '4,760,000', 1702195366, 1702195366),
(69, 92, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702195366, 1702195366),
(71, 94, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 3, '25,500,000', 1702272930, 1702272930),
(72, 95, 0, 'Áo thun có cổ ngắn tay', 'Xanh cổ vịt', 'S', 'APS157S3', 'APS157S3_1.jpg', '595,000', 5, '2,975,000', 1702290474, 1702290474),
(73, 96, 0, 'Quần âu nam', 'Đen', 'M', 'ATRR16', 'ATRR16_1.jpg', '1,050,000', 2, '2,100,000', 1702290867, 1702290867),
(74, 96, 0, 'Quần âu nam', 'Đen', 'S', 'ATRR16', 'ATRR16_1.jpg', '1,050,000', 4, '4,200,000', 1702290867, 1702290867),
(75, 96, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 3, '25,500,000', 1702290867, 1702290867),
(76, 97, 0, 'Áo sơ mi dài tay', 'Trắng', 'S', 'ALSR39', 'ALSR39_1.jpg', '995,000', 1, '995,000', 1702290963, 1702290963),
(77, 98, 0, 'Quần âu ', 'Xanh tím than 66', 'S', 'ATR03003', 'ATR03003_1.jpg', '950,000', 5, '4,750,000', 1702291424, 1702291424),
(78, 99, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702292172, 1702292172),
(79, 99, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 2, '1,790,000', 1702292172, 1702292172),
(80, 100, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 4, '34,000,000', 1702292317, 1702292317),
(81, 101, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 5, '3,250,000', 1702292422, 1702292422),
(82, 102, 0, 'Áo sơ mi dài tay', 'Trắng 4', 'S', 'ALSR07', 'ALSR07_1.jpg', '650,000', 5, '3,250,000', 1702292563, 1702292563),
(83, 103, 0, 'Áo polo nam ngắn tay', 'Trắng 6', 'S', 'APS169S3', 'APS169S3_1.jpg', '499,000', 5, '2,495,000', 1702292806, 1702292806),
(84, 104, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702294982, 1702294982),
(85, 105, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702295203, 1702295203),
(86, 106, 0, 'Áo thun có cổ ngắn tay', 'Xanh cổ vịt', 'S', 'APS157S3', 'APS157S3_1.jpg', '595,000', 2, '1,190,000', 1702302468, 1702302468),
(87, 107, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702572558, 1702572558),
(88, 108, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 3, '2,685,000', 1702652044, 1702652044),
(89, 109, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 1, '895,000', 1702652054, 1702652054),
(90, 109, 0, 'Áo polo nam ngắn tay ', 'Be 78', 'S', 'APS165S3', 'APS165S3_1.jpg', '499,000', 1, '499,000', 1702652054, 1702652054),
(91, 109, 0, 'Quần âu nam', 'Đen', 'S', 'ATRR16', 'ATRR16_1.jpg', '1,050,000', 1, '1,050,000', 1702652054, 1702652054),
(92, 109, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 1, '8,500,000', 1702652054, 1702652054),
(93, 110, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 1, '895,000', 1702659834, 1702659834),
(94, 111, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 1, '8,500,000', 1702660117, 1702660117),
(95, 111, 0, 'Áo polo nam ngắn tay', 'Đen', 'S', 'APS168S3', 'APS168S3_1.jpg', '650,000', 1, '650,000', 1702660117, 1702660117),
(96, 111, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 1, '895,000', 1702660117, 1702660117),
(97, 112, 0, 'Quần âu nam', 'Đen', 'S', 'ATRR16', 'ATRR16_1.jpg', '1,050,000', 1, '1,050,000', 1702701283, 1702701283),
(98, 112, 0, 'Áo sơ mi dài tay ', 'Trắng dệt jacquard h', 'S', 'ALS17403', 'ALS17403_1.jpg', '895,000', 1, '895,000', 1702701283, 1702701283),
(99, 113, 0, 'Bộ suit nam B', 'trắng', 'S', '1SU00202', '1SU00202_1.jpg', '8,500,000', 1, '8,500,000', 1702701429, 1702701429),
(100, 114, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 1, '895,000', 1702701492, 1702701492),
(101, 115, 0, 'Quần Khaki', 'Be 70 solid', 'S', 'AKK00202', 'AKK00202_1.jpg', '895,000', 1, '895,000', 1703513281, 1703513281);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `masp` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `gianhap` varchar(255) NOT NULL,
  `giaban` varchar(255) NOT NULL,
  `soluong` int(3) NOT NULL DEFAULT 0,
  `img1` varchar(255) NOT NULL,
  `img2` varchar(255) DEFAULT NULL,
  `img3` varchar(255) DEFAULT NULL,
  `img4` varchar(255) DEFAULT NULL,
  `img5` varchar(255) DEFAULT NULL,
  `ghichu` text DEFAULT NULL,
  `iddm` int(4) UNSIGNED NOT NULL,
  `best_seller` int(3) NOT NULL DEFAULT 0,
  `created_time` int(11) DEFAULT NULL,
  `last_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`id`, `name`, `masp`, `color`, `gianhap`, `giaban`, `soluong`, `img1`, `img2`, `img3`, `img4`, `img5`, `ghichu`, `iddm`, `best_seller`, `created_time`, `last_updated`) VALUES
(1, 'Áo sơ mi dài tay', 'ALSR39', 'Trắng', '500,000', '995,000', 96, 'ALSR39_1.jpg', 'ALSR39_2.jpg', 'ALSR39_3.jpg', 'ALSR39_4.jpg', 'ALSR39_5.jpg', '<h2>Kiểu dáng:</h2>\r\n<p> Regular Fit </p>\r\n<h2>Thiết kế:</h2>\r\n<p - Áo thiết kế đơn giản, tà lượn, có túi ngực tiện lợi, cùng gam màu trắng tuy đơn giản nhưng vẫn mang đến phong cách thời thượng và lịch lãm cho các quý ông</p>\r\n<p> - Áo sơ mi dài tay phom Regular Fit có độ suông rộng vừa đủ mà vẫn đảm bảo vừa vặn hình thể người mặc.</p>\r\n<h2>Chất liệu:</h2>\r\n<p> - 46% Modal từ sợi sồi thiên nhiên cho bề mặt vải mềm mại, nhẹ và thoáng khí</p>\r\n<p - 45% Polyester giúp áo bền màu, sắc nét và độ trơn trượt, mỏng nhẹ.</p>\r\n<p> - 9% Tencel giúp vải mềm mát, thoáng khí, ít co rút khi sử dụng.</p>\r\n<h2>Màu sắc:</h2>\r\n<p> Trắng</p>\r\n<h2>Size:</h2>\r\n<p> 38/39/40/41/42/43</p>', 1, 2, 1700585721, 1701975396),
(2, 'Áo sơ mi dài tay', 'ALS27702', 'xanh biển', '400,000', '850,000', 0, 'ALS27702_1.jpg', 'ALS27702_2.jpg', 'ALS27702_3.jpg', 'ALS27702_4.jpg', 'ALS27702_5.jpg', 'ádfg', 1, 100, 1700584721, 1700591721),
(3, 'Áo sơ mi dài tay', 'ALS01903', 'Đen kẻ cam', '600,000', '995,000', 0, 'ALS01903_1.jpg', 'ALS01903_2.jpg', 'ALS01903_3.jpg', 'ALS01903_4.jpg', 'ALS01903_5.jpg', '<h2>FORM DÁNG: </h2> \r\n<p> Regular Fit:</p>\r\n<h2>THIẾT KẾ:</h2>\r\n<p>- Áo thun ngắn tay phom Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc</p>\r\n<p>- Thiết kế khỏe khoắn, màu sắc cơ bản dễ kết hợp với nhiều trang phục khác mang tới diện mạo trẻ trung, lịch lãm cho người mặc.</p>\r\n<h2>CHẤT LIỆU:</h2>\r\n<p>- 95% Cotton thấm hút tốt, thoáng khí, thân thiện với làn da</p>\r\n<p>- 5% Spandex tạo độ co giãn nhẹ khi hoạt động</p>\r\n<h2>MÀU SẮC:</h2>\r\n<p>Đen kẻ cam</p>\r\n<h2>SIZE:</h2>\r\n<p>S/M/L/XL/XXL</p>\r\n', 1, 100, 1700590721, 1701974022),
(4, 'Bộ suit nam B', '1SU00202', 'trắng', '5,000,000', '8,500,000', 86, '1SU00202_1.jpg', '1SU00202_2.jpg', '1SU00202_3.jpg', '1SU00202_4.jpg', '1SU00202_5.jpg', '<h2>Kiểu dáng:</h2>\r\n<p>Premio</p>\r\n<h2>Thiết kế:</h2>\r\n<p>- Bộ suit phom Premio phù hợp mọi dáng người, luôn giữ được phần ve áo ổn định ngay cả khi mở cúc, và tạo được phần thắt eo tôn dáng người mặc.</p>\r\n<p>- Thiết kế cổ điển với 2 khuy cài, 4 khuy tay áo, 2 đường xẻ tà, độn vai vừa phải, cùng chất liệu cao cấp mang đến vẻ lịch lãm, sang trọng nhưng vẫn trẻ trung. </p>\r\n<p>- Quần thiết kế cơ bản với túi xẻ phía trước, túi cài khuy sau, kết hợp gấu chờ tiện lợi để may vừa vặn theo số đo và yêu cầu riêng của từng khách hàng. </p>\r\n<h2>Chất liệu:</h2>\r\n<p>- 50% Wool len cao cấp, được dệt hoàn toàn từ lông cừu tự nhiên. </p>\r\n<p>- 50% Polyester tạo độ sắc nét, bền màu và đứng dáng cho bộ suit. </p>\r\n<h2>Màu sắc:</h2>\r\n<p>Xám 291 solid</p>\r\n<h2>Size:</h2>\r\n<p>S/M/L/XL</p>\r\n', 4, 14, 1700590721, 1701974961),
(5, 'Quần âu nam', 'ATRR16', 'Đen', '600,000', '1,050,000', 90, 'ATRR16_1.jpg', 'ATRR16_2.jpg', '', '', '', '<h2>Kiểu dáng:</h2>\r\n<p> Regular Fit </p>\r\n<h2>Thiết kế:</h2>\r\n<p- Quần âu phom dáng Regular Fit suông vừa, màu sắc trung tính dễ kết hợp trang phục khác </p>\r\n<h2>Chất liệu:</h2>\r\n<p- 80% Polyester giúp quần siêu mỏng nhẹ, bề mặt vải trơn bóng, màu sắc sắc nét và bền màu qua quá trình sử dụng.</p>\r\n<p>- 20% Rayon đem đến độ mềm mại, mát mẻ và bay rũ tự nhiên.</p>\r\n<h2>Màu sắc:</h2>\r\n<p> Đen 1; Xanh tím than 31; Xanh tím than 42; Xám 172</p>\r\n<h2>Size:</h2>\r\n<p>29,30,31,32,33,34,35</p>\r\n', 3, 10, 1700590721, 1701975129),
(6, 'Áo sơ mi nam dài tay', 'ALS16303', 'Trắng', '500,000', '950,000', 98, 'ALS16303_1.jpg', 'ALS16303_2.jpg', 'ALS16303_3.jpg', 'ALS16303_4.jpg', 'ALS16303_5.', '<h2>FORM DÁNG: </h2> \n<p> Regular Fit:</p>\n<h2>THIẾT KẾ:</h2>\n<p>- Áo thun ngắn tay phom Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc</p>\n<p>- Thiết kế khỏe khoắn, màu sắc cơ bản dễ kết hợp với nhiều trang phục khác mang tới diện mạo trẻ trung, lịch lãm cho người mặc.</p>\n<h2>CHẤT LIỆU:</h2>\n<p>- 95% Cotton thấm hút tốt, thoáng khí, thân thiện với làn da</p>\n<p>- 5% Spandex tạo độ co giãn nhẹ khi hoạt động</p>\n<h2>MÀU SẮC:</h2>\n<p>Đen 1; Trắng 6; Xanh tím than 24; Đỏ 86; Be 2; Vàng 42</p>\n<h2>SIZE:</h2>\n<p>S/M/L/XL/XXL</p>\n', 1, 2, 1700585721, 1700591721),
(7, 'Áo sơ mi nam dài tay', 'ALS02903', 'Trắng in chấm xanh', '500,000', '795,000', 99, 'ALS02903_1.jpg', 'ALS02903_2.jpg', 'ALS02903_3.jpg', 'ALS02903_4.jpg', 'ALS02903_5.jpg', '\n\n<h2>FORM DÁNG: </h2>\n<p> Regular Fit </p>\n<h2>THIẾT KẾ:</h2>\n<p>- Áo sơ mi dài tay phom dáng Regular Fit suông nhẹ, vừa vặn tôn dáng</p>\n<p>- Áo thiết kế đơn giản cùng màu trắng in chấm xanh mang đến phong cách thời thượng và lịch lãm cho các quý ông. </p>\n\n<h2>CHẤT LIỆU: </h2>\n<p> - 48% Bamboo từ sợi tre thiên nhiên mang đến sự thoáng mát, thấm hút tốt và tạo cảm giác thoải mái</p>\n<p>- 48% Polyester giúp áo bền màu, sắc nét và độ trơn trượt, mỏng nhẹ</p>\n<p>- 4% Spandex giúp áo co giãn thoải mái</p>\n\n<h2>MÀU SẮC: </h2>\n<p>- Trắng in chấm xanh</p>\n\n<h2>SIZE: </h2>\n<p>- 38/39/40/41/42/43</p>\n\n\n\n', 1, 1, 1700585721, 1700591721),
(8, 'Áo sơ mi dài tay ', 'ALS17403', 'Trắng dệt jacquard h', '500,000', '895,000', 98, 'ALS17403_1.jpg', 'ALS17403_2.jpg', 'ALS17403_3.jpg', 'ALS17403_4.jpg', 'ALS17403_5.jpg', 'FORM DÁNG: Slim fit\r\n\r\nTHIẾT KẾ:\r\n- Áo sơ mi dài tay phom Slim Fit ôm nhẹ vừa vặn mà vẫn thoải mái vận động\r\n- Áo thiết kế đơn giản, tà lượn không túi, cùng màu trắng dệt jacquard họa tiết đơn giản nhưng tinh tế, ấn tượng, mang đến phong cách thời thượng và lịch lãm cho các quý ông.\r\n\r\nCHẤT LIỆU:\r\n- 49% Bamboo. 49% Polyester. 2% spandex\r\n\r\nMÀU SẮC: Trắng dệt jacquard họa tiết\r\n\r\nSIZE: 38/39/40/41/42/43', 1, 2, 1700590721, 1700591721),
(9, 'Áo sơ mi dài tay', 'ALSR07', 'Trắng 4', '500,000', '650,000', 95, 'ALSR07_1.jpg', 'ALSR07_2.jpg', 'ALSR07_3.jpg', 'ALSR07_4.jpg', 'ALSR07_5.jpg', '<h2>FORM DÁNG:</h2> \r\n<p>Regular fit</p>\r\nTHIẾT KẾ:</h2>\r\n<p>- Áo sơ mi dài tay phom dáng regular fit suông vừa, không ôm sát cơ thể, tạo sự thoải mái cho người mặc</p>\r\n<p>- Được thiết kế cơ bản với tà lượn, túi ngực tiện lợi đem lại sự lịch lãm, thời thượng tạo nên dấu ấn thanh lịch cho quý ông công sở</p>\r\n\r\n<h2>CHẤT LIỆU:</h2>\r\n<p>- 50% Bamboo từ sợi tre thiên nhiên mang đến sự thoáng mát, thấm hút tốt và tạo cảm giác thoải mái.</p>\r\n<p>- 50% Polyspun giúp tiết kiệm tối đa thời gian cho chuyện là ủi nhờ khả năng đàn hồi tự nhiên và ít nhăn co trong suốt quá trình sử dụng</p>\r\n\r\n<h2>MÀU SẮC: </h2>\r\n<p>Trắng 4</p>\r\n<h2>SIZE:</h2>\r\n<p>38,39,40,41,42,43</p>', 1, 5, 1700585721, 1702269833),
(10, 'Áo sơ mi nam dài tay ', 'ALS26202', 'Xanh in kẻ', '500,000', '995,000', 97, 'ALS26202_1.jpg', 'ALS26202_2.jpg', 'ALS26202_3.jpg', 'ALS26202_4.jpg', 'ALS26202_5.jpg', 'FORM DÁNG: Regular fit\r\nTHIẾT KẾ:\r\n- Áo sơ mi dài tay phom dáng regular fit suông vừa, không ôm sát cơ thể, tạo sự thoải mái cho người mặc\r\n- Được thiết kế cơ bản với gam màu xanh và hoạ tiết kẻ đem lại sự lịch lãm, thời thượng cho quý ông công sở\r\n\r\nCHẤT LIỆU:\r\n- 66% Polyester giúp áo mỏng nhẹ, có độ trơn trượt, màu sắc nét và giữ màu tốt theo thời gian.\r\n- 32% Modal từ sợi sồi thiên nhiên cho bề mặt vải mềm mại, nhẹ và thoáng khí.\r\n- 2% Spandex tạo độ co giãn thoải mái khi mặc.\r\n\r\nMÀU SẮC: Xanh in kẻ\r\nSIZE: 38/39/40/41/42/43', 1, 3, 1700590721, 1700591721),
(11, 'Áo polo nam ngắn tay', 'APS169S3', 'Trắng 6', '300,000', '499,000', 95, 'APS169S3_1.jpg', 'APS169S3_2.jpg', 'APS169S3_3.jpg', 'APS169S3_4.jpg', 'APS169S3_5.jpg', 'FORM DÁNG: Regular Fit\r\nTHIẾT KẾ:\r\n- Áo thun ngắn tay phom Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc\r\n- Thiết kế khỏe khoắn, màu sắc cơ bản dễ kết hợp với nhiều trang phục khác mang tới diện mạo trẻ trung, lịch lãm cho người mặc.\r\n\r\nCHẤT LIỆU:\r\n- 95% Cotton thấm hút tốt, thoáng khí, thân thiện với làn da\r\n- 5% Spandex tạo độ co giãn nhẹ khi hoạt động\r\n\r\nMÀU SẮC: Đen 1; Xanh tím than 24; Be 78; Trắng 6\r\n\r\nSIZE: S/M/L/XL/XXL', 2, 5, 1700585721, 1700591721),
(12, 'Áo polo nam ngắn tay ', 'APS167S3', 'Trắng 6', '300,000', '499,000', 100, 'APS167S3_1.jpg', 'APS167S3_2.jpg', 'APS167S3_3.jpg', 'APS167S3_4.jpg', 'APS167S3_5.jpg', 'FORM DÁNG: Regular Fit\r\nTHIẾT KẾ:\r\n- Áo thun ngắn tay phom Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc\r\n- Thiết kế khỏe khoắn, màu sắc cơ bản dễ kết hợp với nhiều trang phục khác mang tới diện mạo trẻ trung, lịch lãm cho người mặc.\r\n\r\nCHẤT LIỆU:\r\n- 95% Cotton thấm hút tốt, thoáng khí, thân thiện với làn da\r\n- 5% Spandex tạo độ co giãn nhẹ khi hoạt động\r\n\r\n\r\nMÀU SẮC: Đen 1; Trắng 6; Đỏ 86; Vàng 42; Be 78\r\n\r\nSIZE: S/M/L/XL/XXL', 2, 0, 1700585721, 1700591721),
(13, 'Áo polo nam ngắn tay ', 'APS165S3', 'Be 78', '300,000', '499,000', 97, 'APS165S3_1.jpg', 'APS165S3_2.jpg', 'APS165S3_3.jpg', 'APS165S3_4.jpg', 'APS165S3_5.jpg', 'FORM DÁNG: Regular Fit\r\n\r\nTHIẾT KẾ:\r\n- Áo Polo phom dáng Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc\r\n- Thiết kế basic với cổ dệt jacquard phối màu nổi bật, chỉn chu, tay áo bo rib trẻ trung, tạo nên dấu ấn thanh lịch, thời thượng cho quý ông.\r\n\r\nCHẤT LIỆU:\r\n- 95% Cotton Organic thoáng khí, thấm mồ hôi vượt trội và thân thiện với làn da\r\n- 5% Spandex đem đến độ co giãn nhẹ\r\n\r\nMÀU SẮC: Xanh tím than 24; Be 78; Trắng 6; Đỏ booc đô 6\r\n\r\nSIZE: S/M/L/XL/XXL', 2, 3, 1700590721, 1700591721),
(14, 'Áo polo nam ngắn tay', 'APS166S3', 'Đỏ 86', '300,000', '499,000', 100, 'APS166S3_1.jpg', 'APS166S3_2.jpg', 'APS166S3_3.jpg', 'APS166S3_4.jpg', 'APS166S3_5.jpg', 'FORM DÁNG: Regular Fit\r\nTHIẾT KẾ:\r\n- Áo Polo phom dáng Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc\r\n- Thiết kế basic với cổ dệt bo viền nổi bật, chỉn chu, tay áo bo rib trẻ trung, màu sắc thời thượng, tạo nên dấu ấn thanh lịch, thời thượng cho quý ông.\r\n\r\nCHẤT LIỆU:\r\n- 95% Cotton Organic thoáng khí, thấm mồ hôi vượt trội và thân thiện với làn da\r\n- 5% Spandex đem đến độ co giãn nhẹ\r\n\r\nMÀU SẮC: Đen1; Xanh tím than 24; Trắng 6; Đỏ 86; Be 78\r\n\r\nSIZE: S/M/L/XL/XXL\r\n ', 2, 0, 1700585721, 1700591721),
(15, 'Áo polo nam ngắn tay', 'APS170S3', 'Be 2', '300,000', '499,000', 100, 'APS170S3_1.jpg', 'APS170S3_2.jpg', 'APS170S3_3.jpg', 'APS170S3_4.jpg', 'APS170S3_5.jpg', 'FORM DÁNG: Regular Fit\r\nTHIẾT KẾ:\r\n- Áo Polo phom dáng Regular fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc\r\n- Thiết kế basic với cổ dệt jacquard nổi bật, chỉn chu, tay áo bo rib trẻ trung, màu sắc thời thượng, tạo nên dấu ấn thanh lịch, thời thượng cho quý ông.\r\n\r\nCHẤT LIỆU:\r\n- 95% Cotton Organic thoáng khí, thấm mồ hôi vượt trội và thân thiện với làn da\r\n- 5% Spandex đem đến độ co giãn nhẹ\r\n\r\nMÀU SẮC: Be 2; Xanh tím than 24; Trắng 6; Đỏ booc đô 6\r\n\r\nSIZE: S/M/L/XL/XXL', 2, 0, 1700585721, 1700591721),
(16, 'Quần âu ', 'ATR03003', 'Xanh tím than 66', '450,000', '950,000', 95, 'ATR03003_1.jpg', 'ATR03003_2.jpg', 'ATR03003_3.jpg', 'ATR03003_4.jpg', 'ATR03003_5.jpg', 'FORM DÁNG: Slim fit\r\nTHIẾT KẾ:\r\n- Quần âu phom dáng Slim fit ôm vừa vặn hình thể người mặc, nhằm tôn lên dáng vẻ nam tính.\r\n- Quần được thiết kế cơ bản với túi chéo 2 bên, màu sắc trung tính kết hợp họa tiết kẻ nổi bật, đem đến diện mạo tự tin và trẻ trung cho người mặc.\r\n\r\nCHẤT LIỆU:\r\n- 68% Polyester giúp quần bền màu, sắc nét, mặt vải trơn trượt, mỏng nhẹ.\r\n- 29% Rayon giúp quần có độ mềm mại, mát mẻ và bay rũ tự nhiên.\r\n- 3% Spandex tạo độ co giãn nhẹ.\"\r\n\r\nMÀU SẮC: Xám 32 KẺ\r\n\r\nSIZE: 29,30,31,32,33,34,35', 3, 5, 1700590721, 1700591721),
(17, 'Quần âu nam', 'ATR00503', 'Đen 21 solid dobby', '450,000', '750,000', 50, 'ATR00503_1.jpg', 'ATR00503_2.jpg', 'ATR00503_3.jpg', 'ATR00503_4.jpg', 'ATR00503_5.jpg', 'FORM DÁNG: Regular Fit\r\n\r\nTHIẾT KẾ:\r\n- Quần âu Aristino phom Regular Fit suông nhẹ, đứng dáng.\r\n- Quần âu dệt hiệu ứng kẻ dobby tinh tế, màu sắc đơn giản nhưng nam tính, dễ kết hợp trang phục nơi công sở.\r\n\r\nCHẤT LIỆU:\r\n- 100% Polyester giúp quần bền màu, sắc nét và độ trơn trượt, mỏng nhẹ.\r\n\r\nMÀU SẮC: Đen 21 solid dobby; Xanh tím than 86 solid dobby; Xám 39 solid dobby\r\n\r\nSIZE: 29/30/31/32/33/34/35', 3, 105, 1700585721, 1702265719),
(18, 'Quần âu nam', 'ATR00203', 'Xanh tím than 50 kẻ', '450,000', '895,000', 100, 'ATR00203_1.jpg', 'ATR00203_2.jpg', 'ATR00203_3.jpg', 'ATR00203_4.jpg', 'ATR00203_5.jpg', 'FORM DÁNG: Slim fit\r\nTHIẾT KẾ:\r\n- Quần âu phom Slim Fit ôm nhẹ vừa vặn mà vẫn thoải mái vận động.\r\n- Quần thiết kế cơ bản, màu sắc trung tính họa tiết kẻ chìm, dễ dàng kết hợp với nhiều loại trang phục, đem lại diện mạo lịch lãm và tự tin cho người mặc.\r\n\r\nCHẤT LIỆU:\r\n- 72% Polyester giúp quần bền màu, sắc nét, mặt vải trơn trượt, mỏng nhẹ.\r\n- 26% Rayon giúp quần có độ mềm mại, mát mẻ và bay rũ tự nhiên.\r\n- 2% Spandex tạo độ co giãn thoải mái khi mặc.\r\n\r\nMÀU SẮC: Xám 72 kẻ chìm; Xanh tím than 50 kẻ chìm\r\n\r\nSIZE: 29/30/31/32/33/34/35\r\n ', 3, 0, 1700585721, 1700591721),
(19, 'Quần âu', 'ATR00803', 'Xanh tím than kẻ chì', '450,000', '895,000', 100, 'ATR00803_1.jpg', 'ATR00803_2.jpg', 'ATR00803_3.jpg', 'ATR00803_4.jpg', 'ATR00803_5.jpg', 'FORM DÁNG: Cropped\r\nTHIẾT KẾ:\r\n- Quần âu phom dáng Cropped ôm vừa, trẻ trung\r\n- Quần thiết kế họa tiết kẻ chìm tinh tế, đem đến diện mạo chỉn chu, lịch lãm khi mặc. Gam màu trung tính, dễ kết hợp với nhiều loại trang phục, nhiều phong cách khác nhau.\r\n\r\nCHẤT LIỆU:\r\n- 72% Polyester giúp quần bền màu, sắc nét, mặt vải trơn trượt, mỏng nhẹ.\r\n- 26% Rayon giúp quần có độ mềm mại, mát mẻ và bay rũ tự nhiên.\r\n- 2% Spandex tạo độ co giãn nhẹ.\r\n\r\n\r\nMÀU SẮC: Xanh tím than 46 kẻ chìm; Xám 303 kẻ chìm\r\n\r\nSIZE: 29/30/31/32/33/34/35', 3, 0, 1700585721, 1700591721),
(20, 'Quần âu', 'ATRG1603', 'Xanh tím than', '700,000', '1,600,000', 100, 'ATRG1603_1.jpg', 'ATRG1603_2.jpg', 'ATRG1603_3.jpg', 'ATRG1603_4.jpg', 'ATRG1603_5.jpg', 'FORM DÁNG: Golf Fit\r\nTHIẾT KẾ:\r\n- Quần âu phom Golf Fit, có phần ống suông rộng thoải mái đồng thời vẫn đảm bảo sự vừa vặn như may đo.\r\n- Thiết kế thể thao khỏe khoắn, phù hợp với mọi dáng người khi mặc. Quần có màu sắc trung tính dễ kết hợp trang phục.\r\n\r\nCHẤT LIỆU:\r\n- 92% Polyester giúp quần mỏng nhẹ, có độ trơn trượt, màu sắc nét và giữ màu tốt theo thời gian\r\n- 8% Spandex tạo độ co giãn nhẹ\r\n\r\nMÀU SẮC: Xanh aqua 58; Xám 288; Xanh tím than 24\r\n\r\nSIZE: 29/30/31/32/33/34/35', 3, 0, 1700585721, 1700591721),
(21, 'Bộ suit nam', 'ASUR01', 'Xám', '1,500,000', '4,500,000', 100, 'ASUR01_1.jpg', 'ASUR01_2.jpg', 'ASUR01_3.jpg', 'ASUR01_4.jpg', 'ASUR01_5.jpg', 'KIỂU DÁNG: SLIM FIT\r\n\r\nCHI TIẾT:\r\n\r\n- Bộ suit phom Slim fit ôm vừa vặn như may đo, tôn dáng tối đa khi mặc.\r\n\r\n- Thiết kế cổ điển với 1 khuy cài, 3 khuy tay áo, 2 đường xẻ tà, độn vai vừa phải mang đến vẻ lịch lãm, sang trọng nhưng vẫn trẻ trung.\r\n\r\n- Quần thiết kế cơ bản với túi xẻ phía trước, túi cài khuy sau, kết hợp gấu chờ tiện lợi để may vừa vặn theo số đo và yêu cầu riêng của từng khách hàng.\r\n\r\nCHẤT LIỆU:\r\n\r\n- 70% Polyester giúp quần áo bền màu, sắc nét, giữ phom tốt, hạn chế co nhăn.\r\n\r\n- 28% Rayon giúp quần áo có độ mềm mại, thoáng khí và bay rũ tự nhiên.\r\n\r\n- 2% Spandex tạo độ co giãn, thoải mái khi cử động\r\n\r\nMÀU SẮC: Xanh tím than 42, Xanh biển 43, Đen 1, Xám 288\r\n\r\nSIZE: S,M,L,XL,XL', 4, 0, 1700585721, 1700591721),
(22, 'Bộ Suit nam', ' ASUR02', 'Xám', '1,500,000', '4,200,000', 100, 'ASUR02_1.jpg', 'ASUR02_2.jpg', 'ASUR02_3.jpg', 'ASUR02_4.jpg', 'ASUR02_5.jpg', 'KIỂU DÁNG: REGULAR FIT\r\n\r\nCHI TIẾT:\r\n\r\n- Bộ suit phom Regular fit ôm nhẹ, thoải mái nhưng vẫn đảm bảo vừa vặn như may đo, tôn dáng tối đa khi mặc.\r\n\r\n- Thiết kế cổ điển với 2 khuy cài, 4 khuy tay áo, 2 đường xẻ tà, độn vai vừa phải mang đến vẻ lịch lãm, sang trọng nhưng vẫn trẻ trung.\r\n\r\n- Quần thiết kế cơ bản với túi xẻ phía trước, túi cài khuy sau, kết hợp gấu chờ tiện lợi để may vừa vặn theo số đo và yêu cầu riêng của từng khách hàng.\r\n\r\nCHẤT LIỆU:\r\n\r\n- 70% Polyester giúp quần áo bền màu, sắc nét, giữ phom tốt, hạn chế co nhăn.\r\n\r\n- 28% Rayon giúp quần áo có độ mềm mại, thoáng khí và bay rũ tự nhiên.\r\n\r\n- 2% Spandex tạo độ co giãn, thoải mái khi cử động\r\n\r\nMÀU SẮC: Đen 01 Xám 90 Xanh tím than 41 Xám 199 -\r\n\r\nSIZE: S, M, L, XL', 4, 0, 1700585721, 1700591721),
(23, 'Bộ vest nam', 'ASU00302', 'Đen ', '4,000,000', '7,500,000', 100, 'ASU00302_1.jpg', 'ASU00302_2.jpg', 'ASU00302_3.jpg', 'ASU00302_4.jpg', 'ASU00302_5.jpg', 'Kiểu dáng: Premio\r\n\r\nThiết kế:\r\n- Bộ suit phom Premio phù hợp mọi dáng người, luôn giữ được phần ve áo ổn định ngay cả khi mở cúc, và tạo được phần thắt eo tôn dáng người mặc.\r\n- Thiết kế cổ điển với 2 khuy cài, 4 khuy tay áo, 2 đường xẻ tà, độn vai vừa phải, cùng chất liệu cao cấp mang đến vẻ lịch lãm, sang trọng nhưng vẫn trẻ trung.\r\n- Quần thiết kế cơ bản với túi xẻ phía trước, túi cài khuy sau, kết hợp gấu chờ tiện lợi để may vừa vặn theo số đo và yêu cầu riêng của từng khách hàng.\r\n\r\nChất liệu:\r\n- 85% Polyester giúp quần bền màu, sắc nét, ít nhăn co.\r\n- 15% Rayon đem đến độ mềm mại, mát mẻ, bay rũ tự nhiên và thoải mái khi cử động\r\n\r\nMàu sắc: Xanh tím than 166 Solid, Đen 24 Solid\r\n\r\nSize: S/M/L/XL', 4, 0, 1700585721, 1700591721),
(24, 'Bộ Suit nam', 'ASU00501', 'Xám 39 kẻ', '1,500,000', '4,500,000', 99, 'ASU00501_1.jpg', 'ASU00501_2.jpg', 'ASU00501_3.jpg', 'ASU00501_4.jpg', 'ASU00501_5.jpg', 'KIỂU DÁNG: SLIM FIT\r\n\r\nCHI TIẾT:\r\n\r\n- Bộ suit phom Slim fit ôm vừa vặn với cơ thể như may đo, tôn dáng người mặc.\r\n\r\n- Thiết kế cổ điển với 2 khuy cài, 3 khuy tay áo, 2 đường xẻ tà, độn vai vừa phải mang đến vẻ lịch lãm, sang trọng nhưng vẫn trẻ trung.\r\n\r\n- Quần thiết kế cơ bản với túi xẻ phía trước, túi cài khuy sau, kết hợp gấu chờ tiện lợi để may vừa vặn theo số đo và yêu cầu riêng của từng khách hàng.\r\n\r\nCHẤT LIỆU:\r\n\r\n- 85% Polyester giúp bộ suit bền màu, sắc nét, mặt vải trơn trượt, mỏng nhẹ.\r\n\r\n- 13% Rayon giúp bộ suit có độ mềm mại, mát mẻ và bay rũ tự nhiên.\r\n\r\n- 2% Spandex tạo độ co giãn nhẹ.\r\n\r\nMÀU SẮC: Xanh tím than 50 kẻ, Xám 39 kẻ\r\n\r\nSIZE: S,M,L,XL,XXL', 4, 1, 1700590721, 1700591721),
(42, 'Áo polo nam ngắn tay', 'APS168S3', 'Đen', '399,000', '650,000', 83, 'APS168S3_1.jpg', 'APS168S3_2.jpg', 'APS168S3_3.jpg', 'APS168S3_4.jpg', 'APS168S3_5.jpg', '', 2, 17, 1701978129, 1701978129),
(44, 'Áo thun có cổ ngắn tay', 'APS157S3', 'Xanh cổ vịt', '300,000', '595,000', 75, 'APS157S3_1.jpg', 'APS157S3_2.jpg', 'APS157S3_3.jpg', 'APS157S3_4.jpg', 'APS157S3_5.jpg', '<h2>FORM DÁNG:</h2> \r\n<p>Regular Fit</p>\r\n\r\n<p>THIẾT KẾ:</h2>\r\n<p>- Áo Polo phom dáng Regular Fit suông nhẹ nhưng vẫn vừa vặn, tôn dáng tối đa khi mặc</p>\r\n<p>- Thiết kế được lấy cảm hứng từ họa tiết logo Aristino cách điệu tạo nên ấn tượng mạnh mẽ. </p>\r\n<p>- Màu sắc nam tính dễ dàng phối hợp với các trang phục khác nhau để tạo nên diện mạo lịch lãm</p>\r\n\r\n<h2>CHẤT LIỆU:</h2>\r\n<p>- 87.6% Nylon cho bề mặt vải độ mịn mượt, mỏng nhẹ</p>\r\n<p>- 12.4% Spandex tạo độ co giãn nhẹ</p>\r\n\r\n<h2>MÀU SẮC:</h2>\r\n<p>Xanh cổ vịt</p>\r\n\r\n<h2>SIZE:</h2>\r\n<p>S/M/L/XL/XXL</p>\r\n', 2, 25, 1702171326, 1702171326),
(45, 'Quần Khaki', 'AKK00202', 'Be 70 solid', '340,000', '895,000', 89, 'AKK00202_1.jpg', 'AKK00202_2.jpg', 'AKK00202_3.jpg', 'AKK00202_4.jpg', 'AKK00202_5.jpg', '<h2>FORM DÁNG:</h2>\r\n<p>Fiero</p>\r\nTHIẾT KẾ:</h2>\r\n<p>- Quần khaki form dáng Fiero suông rộng thoải mái, nhưng vẫn tôn dáng người mặc, tôn lên dáng vẻ nam tính, thời trang. </p>\r\n<p>- Quần được thiết kế cơ bản với túi chéo 2 bên, ống đứng, phần eo và mông rộng hơn giúp che khuyết điểm tốt. Màu sắc nam tính đem đến diện mạo tự tin và trẻ trung cho người mặc. </p>\r\n<h2>CHẤT LIỆU:</h2>\r\n<p>- 58% Cotton giúp quần mềm mại, xốp nhẹ và thoáng khí. </p>\r\n<p>- 40% Polyamide mềm mịn, thấm hút mồ hôi và thoát ẩm tốt</p>\r\n<p>- 2% Spandex đem đến độ co giãn nhẹ</p>\r\n<h2>MÀU SẮC:</h2>\r\n<p>Xanh tím than 150 solid; Be 70 solid</p>\r\n<h2>SIZE:</h2>\r\n<p>29/30/31/32/33/34/35</p>', 3, 11, 1702232703, 1702235003);

-- --------------------------------------------------------

--
-- Table structure for table `thongke`
--

CREATE TABLE `thongke` (
  `id` int(10) UNSIGNED NOT NULL,
  `masp` varchar(255) NOT NULL,
  `iddm` int(4) UNSIGNED NOT NULL,
  `daban` int(255) NOT NULL,
  `doanhthu` int(255) NOT NULL,
  `created_time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `thongke`
--

INSERT INTO `thongke` (`id`, `masp`, `iddm`, `daban`, `doanhthu`, `created_time`) VALUES
(1, 'APS157S3', 2, 5, 2975000, 1694514474),
(2, 'ATRR16', 3, 2, 2100000, 1694514234),
(3, 'ATRR16', 3, 4, 4200000, 1702290867),
(4, '1SU00202', 4, 3, 25500000, 1702290867),
(5, 'ALSR39', 1, 1, 995000, 1702290963),
(6, 'ATR03003', 3, 5, 2500000, 1702291424),
(7, 'APS168S3', 2, 1, 251000, 1702292172),
(8, 'AKK00202', 3, 2, 1110000, 1702292172),
(9, '1SU00202', 4, 4, 14000000, 1702292317),
(10, 'APS168S3', 2, 5, 1255000, 1702292422),
(11, 'ALSR07', 1, 5, 750000, 1702292563),
(12, 'APS169S3', 2, 5, 995000, 1702292806),
(13, 'APS168S3', 2, 1, 251000, 1702294982),
(14, 'APS168S3', 2, 1, 251000, 1702295203),
(15, 'APS157S3', 2, 2, 590000, 1702302468),
(16, 'APS168S3', 2, 1, 251000, 1702572558),
(17, 'AKK00202', 3, 3, 1665000, 1702652044),
(18, 'AKK00202', 3, 1, 555000, 1702652054),
(19, 'APS165S3', 2, 1, 199000, 1702652054),
(20, 'ATRR16', 3, 1, 450000, 1702652054),
(21, '1SU00202', 4, 1, 3500000, 1702652054),
(22, 'AKK00202', 3, 1, 555000, 1702659834),
(23, '1SU00202', 4, 1, 3500000, 1702660117),
(24, 'APS168S3', 2, 1, 251000, 1702660117),
(25, 'AKK00202', 3, 1, 555000, 1702660117),
(26, 'ATRR16', 3, 1, 450000, 1702701283),
(27, 'ALS17403', 1, 1, 395000, 1702701283),
(28, '1SU00202', 4, 1, 3500000, 1702701429),
(29, 'AKK00202', 3, 1, 555000, 1702701492),
(30, 'AKK00202', 3, 1, 555000, 1703513281);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `tel` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('0','1') NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('nam','nu','khac') DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `created_time` int(11) NOT NULL,
  `last_updated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `tel`, `password`, `role`, `name`, `email`, `address`, `gender`, `birthdate`, `created_time`, `last_updated`) VALUES
(1, 'admin', '', '1', 'admin', 'admin', 'Hà Nội', 'nam', '2003-04-04', 1700915721, 1702174400),
(71, '0389315420', '1', '0', 'Doan Van Huy', 'Huy4403nd@gmail.com', 'Nam Giang, Nam Trực, Nam Định', 'nam', '2003-04-04', 0, 1702194691),
(74, '0389315421', '1', '0', 'Doan Van Huy', 'huy4403nd@gmail.com', 'Viet Nam', NULL, '0000-00-00', 0, 1702194699),
(75, '0389315422', '1', '0', 'Doan Huy', 'xinggai123@gmail.com', 'Việt Nam', NULL, '0000-00-00', 1702171476, 1702194704);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_ibfk_1` (`id_user`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_details_ibfk_1` (`id_cart`),
  ADD KEY `cart_details_ibfk_2` (`idsp`);

--
-- Indexes for table `danhmuc`
--
ALTER TABLE `danhmuc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_ibfk_1` (`id_user`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_details_ibfk_1` (`id_purchase`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddm` (`iddm`);

--
-- Indexes for table `thongke`
--
ALTER TABLE `thongke`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iddm` (`iddm`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tel` (`tel`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=522;

--
-- AUTO_INCREMENT for table `cart_details`
--
ALTER TABLE `cart_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;

--
-- AUTO_INCREMENT for table `danhmuc`
--
ALTER TABLE `danhmuc`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `purchase_details`
--
ALTER TABLE `purchase_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `thongke`
--
ALTER TABLE `thongke`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD CONSTRAINT `cart_details_ibfk_1` FOREIGN KEY (`id_cart`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_details_ibfk_2` FOREIGN KEY (`idsp`) REFERENCES `sanpham` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`id_purchase`) REFERENCES `purchase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_sanpham_danhmuc` FOREIGN KEY (`iddm`) REFERENCES `danhmuc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thongke`
--
ALTER TABLE `thongke`
  ADD CONSTRAINT `thongke_ibfk_1` FOREIGN KEY (`iddm`) REFERENCES `danhmuc` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
