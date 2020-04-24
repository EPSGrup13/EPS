-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 24, 2020 at 04:21 PM
-- Server version: 5.6.47-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eparkdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthLog`
--

CREATE TABLE `AuthLog` (
  `auth_id` int(11) NOT NULL,
  `userName` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `firstName` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `lastName` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `authDate` varchar(40) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `City`
--

CREATE TABLE `City` (
  `city_id` int(2) NOT NULL,
  `city_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `slug_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `comment_id` int(11) NOT NULL,
  `topic` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci DEFAULT NULL,
  `comment` tinytext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `point` decimal(2,1) NOT NULL DEFAULT '0.0',
  `comment_date` date NOT NULL,
  `comment_time` time NOT NULL,
  `person_id` int(11) NOT NULL,
  `park_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contactForm`
--

CREATE TABLE `contactForm` (
  `contact_id` int(11) NOT NULL,
  `firstName` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `lastName` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNo` varchar(14) NOT NULL,
  `city` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `message` tinytext CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dbFeedback`
--

CREATE TABLE `dbFeedback` (
  `feedback_id` int(11) NOT NULL,
  `fbDate` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ErrorLog`
--

CREATE TABLE `ErrorLog` (
  `error_id` int(11) NOT NULL,
  `message` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL,
  `code` int(6) NOT NULL,
  `errorDate` varchar(40) NOT NULL,
  `ip` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Park`
--

CREATE TABLE `Park` (
  `park_id` int(11) NOT NULL,
  `parkName` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `maxNumCars` int(11) NOT NULL,
  `currentNumCars` int(11) NOT NULL,
  `province_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `slug_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkFee`
--

CREATE TABLE `parkFee` (
  `parkFee_id` int(11) NOT NULL,
  `1hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `2hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `3hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `4hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `5hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `6hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `7hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `8hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `9hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `10hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `11hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `12hr` decimal(5,2) NOT NULL DEFAULT '0.00',
  `12h_plus` decimal(5,2) NOT NULL DEFAULT '0.00',
  `park_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkForm`
--

CREATE TABLE `parkForm` (
  `pform_id` int(11) NOT NULL,
  `park_name` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_no` int(14) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parkStatus`
--

CREATE TABLE `parkStatus` (
  `parkStatus_id` int(11) NOT NULL,
  `recDate` date NOT NULL,
  `h12` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h13` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h14` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h15` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h16` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h17` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h18` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h19` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h20` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h21` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h22` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h23` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h00` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h01` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h02` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h03` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h04` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h05` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h06` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h07` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h08` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h09` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h10` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `h11` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_turkish_ci NOT NULL DEFAULT 'BOŞ',
  `park_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Person`
--

CREATE TABLE `Person` (
  `person_id` int(11) NOT NULL,
  `firstName` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `lastName` varchar(60) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `phoneNo` varchar(14) DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `city_id` int(2) NOT NULL DEFAULT '82'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Province`
--

CREATE TABLE `Province` (
  `province_id` int(2) NOT NULL,
  `province_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `city_id` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Reservation`
--

CREATE TABLE `Reservation` (
  `reservation_id` int(11) NOT NULL,
  `reservation_hour` varchar(5) NOT NULL,
  `reservation_date` date NOT NULL,
  `full_plate` varchar(9) NOT NULL,
  `person_id` int(11) NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `parkStatus_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Settings`
--

CREATE TABLE `Settings` (
  `setting_id` int(11) NOT NULL,
  `setting_name` varchar(32) NOT NULL,
  `setting_value` varchar(128) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Slug`
--

CREATE TABLE `Slug` (
  `slug_id` int(11) NOT NULL,
  `slug_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL,
  `slug_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_turkish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tokens`
--

CREATE TABLE `Tokens` (
  `token_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `token` varchar(60) NOT NULL,
  `tokenDate` date NOT NULL,
  `tokenTime` time NOT NULL,
  `is_valid` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `user_id` int(11) NOT NULL,
  `userName` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userPassword` varchar(60) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `userType` int(1) NOT NULL DEFAULT '0',
  `userStatus` int(1) NOT NULL DEFAULT '0',
  `balance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `person_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Wehicle`
--

CREATE TABLE `Wehicle` (
  `wehicle_id` int(11) NOT NULL,
  `full_plate` varchar(9) NOT NULL,
  `raw_plate` varchar(7) NOT NULL,
  `brand` varchar(30) DEFAULT NULL,
  `model` varchar(30) DEFAULT NULL,
  `is_main` int(1) NOT NULL DEFAULT '0',
  `city_id` int(2) NOT NULL,
  `person_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AuthLog`
--
ALTER TABLE `AuthLog`
  ADD PRIMARY KEY (`auth_id`);

--
-- Indexes for table `City`
--
ALTER TABLE `City`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `slug_id` (`slug_id`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `park_id` (`park_id`);

--
-- Indexes for table `contactForm`
--
ALTER TABLE `contactForm`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `dbFeedback`
--
ALTER TABLE `dbFeedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `ErrorLog`
--
ALTER TABLE `ErrorLog`
  ADD PRIMARY KEY (`error_id`);

--
-- Indexes for table `Park`
--
ALTER TABLE `Park`
  ADD PRIMARY KEY (`park_id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `person_id` (`person_id`),
  ADD KEY `slug_id` (`slug_id`);

--
-- Indexes for table `parkFee`
--
ALTER TABLE `parkFee`
  ADD PRIMARY KEY (`parkFee_id`),
  ADD KEY `park_id` (`park_id`);

--
-- Indexes for table `parkForm`
--
ALTER TABLE `parkForm`
  ADD PRIMARY KEY (`pform_id`);

--
-- Indexes for table `parkStatus`
--
ALTER TABLE `parkStatus`
  ADD PRIMARY KEY (`parkStatus_id`);

--
-- Indexes for table `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`person_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `Province`
--
ALTER TABLE `Province`
  ADD PRIMARY KEY (`province_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`reservation_id`),
  ADD KEY `parkStatus_id` (`parkStatus_id`);

--
-- Indexes for table `Settings`
--
ALTER TABLE `Settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `Slug`
--
ALTER TABLE `Slug`
  ADD PRIMARY KEY (`slug_id`),
  ADD UNIQUE KEY `slug_url` (`slug_url`);

--
-- Indexes for table `Tokens`
--
ALTER TABLE `Tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD UNIQUE KEY `tokenid` (`token`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `userName` (`userName`),
  ADD KEY `person_id` (`person_id`);

--
-- Indexes for table `Wehicle`
--
ALTER TABLE `Wehicle`
  ADD PRIMARY KEY (`wehicle_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `person_id` (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AuthLog`
--
ALTER TABLE `AuthLog`
  MODIFY `auth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `City`
--
ALTER TABLE `City`
  MODIFY `city_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contactForm`
--
ALTER TABLE `contactForm`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dbFeedback`
--
ALTER TABLE `dbFeedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ErrorLog`
--
ALTER TABLE `ErrorLog`
  MODIFY `error_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Park`
--
ALTER TABLE `Park`
  MODIFY `park_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parkFee`
--
ALTER TABLE `parkFee`
  MODIFY `parkFee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parkForm`
--
ALTER TABLE `parkForm`
  MODIFY `pform_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parkStatus`
--
ALTER TABLE `parkStatus`
  MODIFY `parkStatus_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Person`
--
ALTER TABLE `Person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Province`
--
ALTER TABLE `Province`
  MODIFY `province_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Settings`
--
ALTER TABLE `Settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Slug`
--
ALTER TABLE `Slug`
  MODIFY `slug_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tokens`
--
ALTER TABLE `Tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Wehicle`
--
ALTER TABLE `Wehicle`
  MODIFY `wehicle_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
