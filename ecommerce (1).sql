-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 20, 2021 at 04:23 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aId` int(11) NOT NULL,
  `aName` varchar(200) NOT NULL,
  `aDate` datetime NOT NULL,
  `aEmail` varchar(100) NOT NULL,
  `aPassword` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aId`, `aName`, `aDate`, `aEmail`, `aPassword`) VALUES
(1, 'Priya', '2021-06-09 12:52:02', 'kumpriya1010@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cId` int(11) NOT NULL,
  `cName` varchar(100) NOT NULL,
  `cStatus` int(11) NOT NULL DEFAULT 1,
  `cDate` datetime NOT NULL,
  `cDp` varchar(200) NOT NULL,
  `adminId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cId`, `cName`, `cStatus`, `cDate`, `cDp`, `adminId`) VALUES
(18, 'Mobile', 1, '2021-06-25 04:26:26', 'mobile1.jpeg', 1),
(19, 'Computer', 1, '2021-06-25 04:26:44', 'pexels-pixabay-38568.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `mId` int(11) NOT NULL,
  `mName` varchar(200) NOT NULL,
  `mDate` datetime NOT NULL,
  `mStatus` int(11) NOT NULL DEFAULT 1,
  `productId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `mDp` varchar(200) NOT NULL,
  `mDescription` varchar(200) NOT NULL,
  `mPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`mId`, `mName`, `mDate`, `mStatus`, `productId`, `adminId`, `mDp`, `mDescription`, `mPrice`) VALUES
(13, 'iphone 5s ', '2021-07-13 12:12:14', 1, 18, 1, 'mobile1.jpeg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officiis animi, veritatis quae repudiandae quod nulla porro quidem, itaque quis quaerat!', 120);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pId` int(11) NOT NULL,
  `pName` varchar(200) NOT NULL,
  `pStatus` int(11) NOT NULL DEFAULT 1,
  `pDate` datetime NOT NULL,
  `categoryId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `pDp` varchar(200) NOT NULL,
  `pCompany` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pId`, `pName`, `pStatus`, `pDate`, `categoryId`, `adminId`, `pDp`, `pCompany`) VALUES
(18, 'Iphone ', 1, '2021-06-30 11:39:27', 18, 1, 'f13.jpg', 'Apple'),
(19, 'lumia', 1, '2021-06-30 11:40:23', 18, 1, 'f7.jpg', 'Nokia');

-- --------------------------------------------------------

--
-- Table structure for table `specs`
--

CREATE TABLE `specs` (
  `spId` int(11) NOT NULL,
  `spName` varchar(100) NOT NULL,
  `spDate` datetime NOT NULL,
  `spStatus` int(11) NOT NULL DEFAULT 1,
  `adminId` int(11) NOT NULL,
  `modelId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specs`
--

INSERT INTO `specs` (`spId`, `spName`, `spDate`, `spStatus`, `adminId`, `modelId`) VALUES
(9, 'color', '2021-07-13 19:44:26', 1, 1, 13),
(10, 'RAM', '2021-07-14 11:02:54', 1, 1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `spec_values`
--

CREATE TABLE `spec_values` (
  `spvId` int(11) NOT NULL,
  `spvName` varchar(100) NOT NULL,
  `specId` int(11) NOT NULL,
  `adminId` int(11) NOT NULL,
  `spvStatus` int(11) NOT NULL DEFAULT 1,
  `spvDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `spec_values`
--

INSERT INTO `spec_values` (`spvId`, `spvName`, `specId`, `adminId`, `spvStatus`, `spvDate`) VALUES
(12, 'Red', 9, 1, 1, '2021-07-13 19:44:26'),
(13, '4GB', 10, 1, 1, '2021-07-14 11:02:54'),
(14, '6GB', 10, 1, 1, '2021-07-14 11:02:54'),
(15, '8GB', 10, 1, 1, '2021-07-14 11:02:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(11) NOT NULL,
  `uFirstName` varchar(100) NOT NULL,
  `uLastName` varchar(100) NOT NULL,
  `uEmail` varchar(100) NOT NULL,
  `uPassword` varchar(200) NOT NULL,
  `uLink` varchar(200) NOT NULL,
  `uDate` datetime NOT NULL,
  `uStatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `uFirstName`, `uLastName`, `uEmail`, `uPassword`, `uLink`, `uDate`, `uStatus`) VALUES
(1, 'Priya', 'v', 'priyhwa18@gmail.com', '46d045ff5190f6ea93739da6c0aa19bc', 'iLShNZ94age5f8TmlCnV', '2021-07-10 11:44:39', 0),
(2, 'Alex', 'j', 'alex@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'PUrK0GJ87kw5xpeDgvMn', '2021-07-10 12:31:21', 0),
(3, 'abc', 'def', 'def@gmail.com', '0f98df87c7440c045496f705c7295344', 'Px6E14UsWg9AOcH5t3Ff', '2021-07-10 06:50:07', 0),
(4, 'Riya', 'vish', 'riya@gmail.com', '161fd33f67dbfd29138ce3f165d5e5dd', 'H6VOTLQAPmzWqa1GeN7K', '2021-07-11 11:44:14', 0),
(5, 'hjk', 'lop', 'kiu@gmail.com', '04d01238008a19fecbae06ef0d659f72', 'yorHwu6Xhvfms3ingaqU', '2021-07-11 12:08:04', 0),
(6, 'jkl', 'mnb', 'bvcx@gmail.com', 'a8959dcbecec13c9234100ca5cac8a27', 'Cq76VZcX4wQKNt8uYgm3', '2021-07-11 12:08:50', 0),
(7, 'nm', 'lk', 'lkj@gmail.com', '9e1e0d137c4dcec30e092c678a9f737c', 'fZVHiCrhaO0UNL1gDsFJ', '2021-07-12 08:49:37', 0),
(8, 'mjkl', 'opu', 'tyr@gmail.com', '674f3c2c1a8a6f90461e8a66fb5550ba', 'lYqRamt098T6eSpzLoC3', '2021-07-12 09:00:38', 0),
(9, 'Priya', 'v', 'priya@gmail.com', '818f9c45cfa30eeff277ef38bcbe9910', '1pgxzrJS2XqowMYRTEB0', '2021-07-12 11:47:17', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cId`),
  ADD KEY `categories_admin_fk` (`adminId`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`mId`),
  ADD KEY `models_admin_aId_fk` (`adminId`),
  ADD KEY `models_products_pId_fk` (`productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pId`),
  ADD KEY `products_categories_cId_fk` (`categoryId`),
  ADD KEY `products_admin_aId_fk` (`adminId`);

--
-- Indexes for table `specs`
--
ALTER TABLE `specs`
  ADD PRIMARY KEY (`spId`),
  ADD KEY `specs_admin_aId_fk` (`adminId`),
  ADD KEY `specs_models_mId_fk` (`modelId`);

--
-- Indexes for table `spec_values`
--
ALTER TABLE `spec_values`
  ADD PRIMARY KEY (`spvId`),
  ADD KEY `spec_values_admin_aId_fk` (`adminId`),
  ADD KEY `spec_values_specs_spId_fk` (`specId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `mId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `specs`
--
ALTER TABLE `specs`
  MODIFY `spId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `spec_values`
--
ALTER TABLE `spec_values`
  MODIFY `spvId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_admin_fk` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_admin_aId_fk` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `models_products_pId_fk` FOREIGN KEY (`productId`) REFERENCES `products` (`pId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_admin_aId_fk` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_categories_cId_fk` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`cId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specs`
--
ALTER TABLE `specs`
  ADD CONSTRAINT `specs_admin_aId_fk` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specs_models_mId_fk` FOREIGN KEY (`modelId`) REFERENCES `models` (`mId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spec_values`
--
ALTER TABLE `spec_values`
  ADD CONSTRAINT `spec_values_admin_aId_fk` FOREIGN KEY (`adminId`) REFERENCES `admin` (`aId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `spec_values_specs_spId_fk` FOREIGN KEY (`specId`) REFERENCES `specs` (`spId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
