-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2023 at 01:00 AM
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
-- Database: `e`
--

-- --------------------------------------------------------

--
-- Table structure for table `criptbl`
--

CREATE TABLE `criptbl` (
  `crip_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `crip_remarks` varchar(255) NOT NULL,
  `crip_result` varchar(255) NOT NULL DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criptbl`
--

INSERT INTO `criptbl` (`crip_id`, `product_id`, `crip_remarks`, `crip_result`) VALUES
(21, 'PRO_18219_192', 'good', 'send'),
(22, 'PRO_36637_193', 'very good', 'send'),
(23, 'PRO_53741_198', 'excellent ', 'reture'),
(24, 'PRO_85314_194', 'good', 'reture'),
(25, 'PRO_57520_201', 'bad', 'reture'),
(26, 'PRO_72898_202', 'good', 'send'),
(27, 'PRO_47933_195', 'bad', 'reture'),
(28, 'PRO_85314_194', 'very good', 'reture'),
(29, 'PRO_47933_195', 'excellent ', 'reture');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `p_name` varchar(50) NOT NULL,
  `p_price` int(11) NOT NULL,
  `p_desc` varchar(50) NOT NULL,
  `p_img` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_id`, `p_name`, `p_price`, `p_desc`, `p_img`, `status`) VALUES
(192, 'PRO_18219_192', 'Capacitor Ajc 472m', 500, 'Ajc 472m Ceramic Capacitors, Safety Standard Ceram', 'c1.jpg', 'sending'),
(193, 'PRO_36637_193', 'Safety Capacitor 680nf', 20, 'The correction capacitor generally refers to a cap', 'c2.jpg', 'sending'),
(194, 'PRO_85314_194', 'Capacitor cl21', 56, 'Cl21 Metallized Polyester Film Capacitor 400V', 'c3.jpg', 'sending'),
(195, 'PRO_47933_195', 'Capacitor CBB20', 67, 'Axial metallized polypropylene film capacitor CBB2', 'c4.jpg', 'sending'),
(196, 'PRO_82653_196', 'Polypropylene Capacitor', 71, 'Ks Pinge 0.35UF 3.3UF 3.9UF 250VDC 400V 630V Axial', 'c5.jfif', 'Default'),
(197, 'PRO_32524_197', 'Capacitor MKP64 310', 82, '\r\nNew and original X1 MKP64 104M 310V ~ 0.1UF dc 2', 'C6.jpg', 'pending'),
(198, 'PRO_53741_198', '450V 22UF 22UF 450V Electrolytic Capacitor ', 22, '450V 22UF 22UF 450V Electrolytic Capacitor volume ', 'c10.jpg', 'sending'),
(199, 'PRO_89177_199', 'Keltron Capacitor 470uf 25v', 19, 'Polarized design: the longer lead is positive elec', 'c9.jpg', 'pending'),
(200, 'PRO_27061_200', 'Sitor fuse', 200, 'Siemens 3NE1333 - 0 - 450A 690V AC 3NE1 TYPE SITOR', 'f2.jfif', 'sending'),
(201, 'PRO_57520_201', 'Blade Fuse 80V', 199, '166.7000 Series Littelfuse 3A 4A 5A 7.5A 10A 15A 2', 'f9.jfif', 'sending'),
(202, 'PRO_72898_202', 'Littelfuse BLF-2 BLF002', 999, 'A fuse is an electrical safety device that operate', 'f10.jfif', 'sending'),
(203, 'PRO_616_203', 'Bussmann Fuse FRN-R', 499, 'Bussmann Fuse 500V 500A EV40-500c Fast Fuses Categ', 'f1.jfif', 'Default'),
(204, 'PRO_99293_204', 'DC fuse ', 199, 'ANL type DC fuse from 50A to 500A to protect your ', 'f7.jfif', 'pending'),
(205, 'PRO_88859_205', 'Dolphin Maytronics Fuse', 200, 'Dolphin Maytronics Fuse 2.5A 5X20 1930251', 'f5.jfif', 'Default'),
(206, 'PRO_44433_206', 'pmx fuse holders', 599, 'Standard system by DF Electric: 3 clips and 1 pin ', 'f6.jfif', 'sending'),
(207, 'PRO_49639_207', 'BUSSMANN Fuse', 599, 'BUSSMANN Fuse: 1,000 A Amps, 600V AC, 10-3/4 in L ', 'f8.jfif', 'Default'),
(208, 'PRO_35773_208', 'Film Resistor ', 99, 'Unique Bargains 100pcs Axial Metal Oxide Film Resi', 'r1.jfif', 'pending'),
(209, 'PRO_87962_209', 'Aexit Ceramic Resistors', 101, 'Aexit 10 Pcs Fixed Resistors Ceramic Cement Power ', 'r2.jpg', 'sending'),
(210, 'PRO_21_210', 'Carbon Film Resistor', 49, 'RS PRO 10Ω Carbon Film Resistor 0.25W ±5%', 'r3.jpg', 'Default'),
(211, 'PRO_1289_211', 'Varistor 10d 220k', 39, '2pcs: MOV-220k/10D (Metal Oxide Varistor) [10D 220', 'r6.jpg', 'sending'),
(212, 'PRO_14330_212', 'Resistor 33r e96', 29, '5 W Metal Film 33R / 33 Ohm E96 Resistor 1 % , Met', 'r10.jpg', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `srstbl`
--

CREATE TABLE `srstbl` (
  `srs_id` int(11) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `srs_result` varchar(255) NOT NULL DEFAULT 'Default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `srstbl`
--

INSERT INTO `srstbl` (`srs_id`, `product_id`, `remarks`, `srs_result`) VALUES
(33, 'PRO_18219_192', 'good', 'pass'),
(34, 'PRO_36637_193', 'Very good', 'pass'),
(35, 'PRO_85314_194', 'to bad', 'fail'),
(36, 'PRO_1289_211', 'fear', 'fail'),
(37, 'PRO_53741_198', 'excellent', 'pass'),
(38, 'PRO_85314_194', 'good', 'pass'),
(39, 'PRO_1289_211', 'bad', 'fail'),
(40, 'PRO_87962_209', 'Very good', 'pass'),
(41, 'PRO_72898_202', 'excellent', 'pass'),
(42, 'PRO_57520_201', 'bad', 'fail'),
(43, 'PRO_27061_200', 'very bad', 'fail'),
(44, 'PRO_27061_200', 'excellent', 'pass'),
(45, 'PRO_53741_198', 'bad', 'fail'),
(46, 'PRO_47933_195', 'e', 'pass'),
(47, 'PRO_47933_195', 'excellent', 'pass'),
(48, 'PRO_57520_201', 'good', 'pass');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `role_type` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `status`, `role_type`, `photo`) VALUES
(1, 'Muhammad Fahad', 'crip@gmail.com', 'f38f00dfbd05fd3ea2da3191b37f5720d280e58b', 'connected', 'crip', 'profile/1652507040.jpg'),
(2, 'Corunes bahtti', 'bhatti@gmail.com', 'e697ef18d3fa82e0fcd427a989a86c694b547c64', 'connected', 'admin', 'profile/1652647933.jpg'),
(3, 'Amna', 'srs@gmail.com', 'd3583d2cd52c6032dd97fff2f442739d44074a79', 'connected', 'srs', 'profile/1652507552.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criptbl`
--
ALTER TABLE `criptbl`
  ADD PRIMARY KEY (`crip_id`),
  ADD KEY `crip-testing_fk` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `srstbl`
--
ALTER TABLE `srstbl`
  ADD PRIMARY KEY (`srs_id`),
  ADD KEY `srs_fk` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criptbl`
--
ALTER TABLE `criptbl`
  MODIFY `crip_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `srstbl`
--
ALTER TABLE `srstbl`
  MODIFY `srs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `criptbl`
--
ALTER TABLE `criptbl`
  ADD CONSTRAINT `crip-testing_fk` FOREIGN KEY (`product_id`) REFERENCES `srstbl` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `srstbl`
--
ALTER TABLE `srstbl`
  ADD CONSTRAINT `srs_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
