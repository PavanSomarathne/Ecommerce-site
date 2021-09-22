-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2021 at 07:20 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gadgetshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `uId` int(11) DEFAULT NULL,
  `coupon` int(11) DEFAULT NULL,
  `time` varchar(20) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cartorders`
--

CREATE TABLE `cartorders` (
  `id` int(11) NOT NULL,
  `cartId` int(11) DEFAULT NULL,
  `pID` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(5, 'Foods'),
(6, 'Cosmetics'),
(7, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `body` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `product_id`, `rating`, `display_name`, `body`, `time`) VALUES
(8, 10, 74, 5, 'Saman', 'Great', '2020-08-07 00:18:10'),
(11, 9, 74, 5, 'Pavan', 'test', '2020-08-07 01:09:49'),
(12, 9, 75, 3, 'Pavan', 'Good', '2020-08-07 13:02:23'),
(18, 9, 127, 3, 'Dulitha Lansakara', 'goods\n', '2021-02-02 15:41:59'),
(19, 9, 130, 1, 'Pavan', 'Patta gona 1\n', '2021-02-13 17:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(50) NOT NULL,
  `coupon_discount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_name`, `coupon_discount`) VALUES
(1, 'p_fam', 10),
(5, 'pan', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orderproducts`
--

CREATE TABLE `orderproducts` (
  `opId` int(11) NOT NULL,
  `oId` int(11) DEFAULT NULL,
  `pId` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderproducts`
--

INSERT INTO `orderproducts` (`opId`, `oId`, `pId`, `qty`, `total`) VALUES
(146, 90, 127, 2, 3000),
(147, 91, 127, 1, 1500),
(148, 92, 127, 1, 1500),
(149, 92, 130, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `oId` int(11) NOT NULL,
  `uID` int(11) DEFAULT NULL,
  `payMethod` varchar(100) DEFAULT NULL,
  `shipMethod` varchar(100) NOT NULL,
  `shipPrice` int(11) DEFAULT NULL,
  `o_coupon` int(11) NOT NULL,
  `oStatus` varchar(50) NOT NULL DEFAULT 'Pending',
  `time` varchar(40) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`oId`, `uID`, `payMethod`, `shipMethod`, `shipPrice`, `o_coupon`, `oStatus`, `time`) VALUES
(90, 9, 'Cash on Delivery', 'LocalPost', 150, 0, 'Sent', '2021-02-02 15:44:42'),
(91, 9, 'Cash on Delivery', 'Pick Up', 150, 0, 'Pending', '2021-09-04 17:08:54'),
(92, 9, 'Cash on Delivery', 'Pick Up', 150, 0, 'Pending', '2021-09-22 16:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pId` int(11) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(100) NOT NULL,
  `price` varchar(30) DEFAULT NULL,
  `date` varchar(100) NOT NULL DEFAULT current_timestamp(),
  `tags` varchar(255) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Draft',
  `pkeys` varchar(255) DEFAULT NULL,
  `pvals` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pId`, `pname`, `description`, `category`, `price`, `date`, `tags`, `images`, `status`, `pkeys`, `pvals`) VALUES
(82, 'aa', 'asd', '2', '2500', '2020-08-08 01:25:45', 'sss', '042.jpg', 'Publish', 'Brand@@Dimentions@@Compatible Devices', '@@asd@@asd'),
(127, 'Pavan', 'asd', '5', '1500', '2020-10-19 23:36:31', 'sss', '0pp (1).jpg', 'Publish', 'Brand@@Dimentions@@Compatible Devices', '@@asd@@asd'),
(128, 'R.P.A.B Somarathne', 'sdf', '5', '2500', '2020-10-20 01:07:08', 'sss', '0IMG-5676.jpg|1pp (1).jpg|2Untitled-2.jpg', 'Publish', 'Brand@@Dimentions@@Compatible Devices', 'Testing@@Testing@@Testing'),
(130, 'senula', 'Mongal buwa', '6', '.000001', '2021-02-13 16:59:44', '', '0IMG_20180727_085336.jpg', 'Publish', 'Brand@@Dimentions@@Compatible Devices', 'Good@@@@');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `uID` int(30) DEFAULT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'User',
  `username` varchar(255) NOT NULL,
  `email` varchar(60) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `zipCode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `uID`, `role`, `username`, `email`, `name`, `address`, `district`, `phone`, `zipCode`) VALUES
(9, 11, 'Admin', 'Pavan', 'pavanpabs@gmail.com', 'R.P.A.B@@Somarathne', '421/5 Paragahamulla, Hindagolla', '', '0714387452', '60034'),
(10, 12, 'User', 'Pavan', 'pavan@gmail.com', '', NULL, NULL, '', NULL),
(19, 21, 'User', 'Pavan1', 'pavanpabs1@gmail.com', '', NULL, NULL, '', NULL),
(22, 23, 'User', 'Suranjith Ratnayake', 'admin@gmail.com', NULL, NULL, NULL, NULL, NULL),
(23, 24, 'User', 'Dulitha Lansakara', 'Dsblansakara@gmail.com', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `uId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userlogin`
--

INSERT INTO `userlogin` (`uId`, `username`, `email`, `password`) VALUES
(11, 'Pavan', 'pavanpabs@gmail.com', '1234'),
(12, 'Pavan', 'pavan@gmail.com', '1234'),
(21, 'Pavan1', 'pavanpabs1@gmail.com', '123'),
(23, 'Suranjith Ratnayake', 'admin@gmail.com', '1234'),
(24, 'Dulitha Lansakara', 'Dsblansakara@gmail.com', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `FK_cart` (`uId`);

--
-- Indexes for table `cartorders`
--
ALTER TABLE `cartorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `pID` (`pID`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD PRIMARY KEY (`opId`),
  ADD KEY `oId` (`oId`),
  ADD KEY `pId` (`pId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`oId`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `uID` (`uID`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `cartorders`
--
ALTER TABLE `cartorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orderproducts`
--
ALTER TABLE `orderproducts`
  MODIFY `opId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `oId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_cart` FOREIGN KEY (`uId`) REFERENCES `user` (`ID`);

--
-- Constraints for table `cartorders`
--
ALTER TABLE `cartorders`
  ADD CONSTRAINT `cartorders_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`),
  ADD CONSTRAINT `cartorders_ibfk_2` FOREIGN KEY (`pID`) REFERENCES `product` (`pId`);

--
-- Constraints for table `orderproducts`
--
ALTER TABLE `orderproducts`
  ADD CONSTRAINT `orderProducts_ibfk_1` FOREIGN KEY (`oId`) REFERENCES `orders` (`oId`),
  ADD CONSTRAINT `orderProducts_ibfk_2` FOREIGN KEY (`pId`) REFERENCES `product` (`pId`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`uID`) REFERENCES `userlogin` (`uId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
