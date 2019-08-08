-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2019 at 03:18 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `v_brand`
--

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_billing_detail`
--

CREATE TABLE `vijayelectrical_billing_detail` (
  `id_detail` int(11) NOT NULL,
  `number_bill` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_price` int(11) NOT NULL,
  `discount` varchar(200) NOT NULL,
  `advance` varchar(200) NOT NULL,
  `price_total_r` double NOT NULL,
  `total_tax` int(100) NOT NULL,
  `status` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_client`
--

CREATE TABLE `vijayelectrical_client` (
  `id_client` int(11) NOT NULL,
  `name_client` varchar(255) NOT NULL,
  `phone_client` char(30) NOT NULL,
  `email_client` varchar(64) NOT NULL,
  `address_client` varchar(255) NOT NULL,
  `status_client` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_currencies`
--

CREATE TABLE `vijayelectrical_currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `precision` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `thousand_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `decimal_separator` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vijayelectrical_currencies`
--

INSERT INTO `vijayelectrical_currencies` (`id`, `name`, `symbol`, `precision`, `thousand_separator`, `decimal_separator`, `code`) VALUES
(1, 'US Dollar', '$', '2', ',', '.', 'USD'),
(2, 'Libra Esterlina', '&pound;', '2', ',', '.', 'GBP'),
(3, 'Euro', 'Ã¢â€šÂ¬', '2', '.', ',', 'EUR'),
(4, 'South African Rand', 'R', '2', '.', ',', 'ZAR'),
(5, 'Danish Krone', 'kr ', '2', '.', ',', 'DKK'),
(6, 'Israeli Shekel', 'NIS ', '2', ',', '.', 'ILS'),
(7, 'Swedish Krona', 'kr ', '2', '.', ',', 'SEK'),
(8, 'Kenyan Shilling', 'KSh ', '2', ',', '.', 'KES'),
(9, 'Canadian Dollar', 'C$', '2', ',', '.', 'CAD'),
(10, 'Philippine Peso', 'P ', '2', ',', '.', 'PHP'),
(11, 'Indian Rupee', 'Rs. ', '2', ',', '.', 'INR'),
(12, 'Australian Dollar', '$', '2', ',', '.', 'AUD'),
(13, 'Singapore Dollar', 'SGD ', '2', ',', '.', 'SGD'),
(14, 'Norske Kroner', 'kr ', '2', '.', ',', 'NOK'),
(15, 'New Zealand Dollar', '$', '2', ',', '.', 'NZD'),
(16, 'Vietnamese Dong', 'VND ', '0', '.', ',', 'VND'),
(17, 'Swiss Franc', 'CHF ', '2', '\'', '.', 'CHF'),
(18, 'Quetzal Guatemalteco', 'Q', '2', ',', '.', 'GTQ'),
(19, 'Malaysian Ringgit', 'RM', '2', ',', '.', 'MYR'),
(20, 'Real Brasile&ntilde;o', 'R$', '2', '.', ',', 'BRL'),
(21, 'Thai Baht', 'THB ', '2', ',', '.', 'THB'),
(22, 'Nigerian Naira', 'NGN ', '2', ',', '.', 'NGN'),
(23, 'Peso Argentino', '$', '2', '.', ',', 'ARS'),
(24, 'Bangladeshi Taka', 'Tk', '2', ',', '.', 'BDT'),
(25, 'United Arab Emirates Dirham', 'DH ', '2', ',', '.', 'AED'),
(26, 'Hong Kong Dollar', '$', '2', ',', '.', 'HKD'),
(27, 'Indonesian Rupiah', 'Rp', '2', ',', '.', 'IDR'),
(28, 'Peso Mexicano', '$', '2', ',', '.', 'MXN'),
(29, 'Egyptian Pound', '&pound;', '2', ',', '.', 'EGP'),
(30, 'Peso Colombiano', '$', '2', '.', ',', 'COP'),
(31, 'West African Franc', 'CFA ', '2', ',', '.', 'XOF'),
(32, 'Chinese Renminbi', 'RMB ', '2', ',', '.', 'CNY');

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_invoices`
--

CREATE TABLE `vijayelectrical_invoices` (
  `id_bill` int(11) NOT NULL,
  `number_bill` int(11) NOT NULL,
  `date_bill` datetime NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_salesman` int(11) NOT NULL,
  `terms` varchar(30) NOT NULL,
  `total_sale` varchar(20) NOT NULL,
  `round_total` int(11) NOT NULL,
  `state_bill` tinyint(1) NOT NULL,
  `bank_details` varchar(250) NOT NULL,
  `goods_service_id` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_products`
--

CREATE TABLE `vijayelectrical_products` (
  `id_product` int(11) NOT NULL,
  `code_product` char(20) NOT NULL,
  `name_product` char(255) NOT NULL,
  `status_product` tinyint(4) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `price_product` double NOT NULL,
  `stack` int(100) NOT NULL,
  `goods_service` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_profile`
--

CREATE TABLE `vijayelectrical_profile` (
  `id_profile` int(11) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(64) NOT NULL,
  `tax` int(2) NOT NULL,
  `cgst` int(200) NOT NULL,
  `currency` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `gst_no` varchar(200) NOT NULL,
  `product_type` int(255) NOT NULL,
  `client_prefix` varchar(255) NOT NULL,
  `igst` varchar(255) NOT NULL,
  `logo_url` varchar(500) NOT NULL,
  `subject` varchar(500) NOT NULL,
  `status` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vijayelectrical_profile`
--

INSERT INTO `vijayelectrical_profile` (`id_profile`, `company_name`, `phone`, `email`, `tax`, `cgst`, `currency`, `address`, `city`, `state`, `postal_code`, `gst_no`, `product_type`, `client_prefix`, `igst`, `logo_url`, `subject`, `status`) VALUES
(1, 'vijayelectrical', '7200283766', 'bsmca2014@gmail.com', 30, 10, 'Rs', 'Chennai', 'Velachery', 'Tamil Nadu', '605702', 'G4515SGDHD451', 2, 'Rc', '10', 'img/1561006490_image1.jpg', 'Hi vijayelectrical', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_tmp`
--

CREATE TABLE `vijayelectrical_tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity_tmp` int(11) NOT NULL,
  `discount_tmp` int(200) NOT NULL,
  `advance_tmp` int(200) NOT NULL,
  `price_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vijayelectrical_users`
--

CREATE TABLE `vijayelectrical_users` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `user_name` varchar(64) NOT NULL,
  `user_password_hash` varchar(255) NOT NULL,
  `user_email` varchar(25) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vijayelectrical_users`
--

INSERT INTO `vijayelectrical_users` (`user_id`, `firstname`, `lastname`, `user_name`, `user_password_hash`, `user_email`, `date_added`) VALUES
(1, 'darshan', '.c', 'darshan', '$2y$10$0PUpXxn/yzkRMJNrGnnvWOJGyKZqgpvUneJmE0B7iMkBxkK0G7EwW', 'darshan.c@virrantech.com', '2019-06-27 13:51:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vijayelectrical_billing_detail`
--
ALTER TABLE `vijayelectrical_billing_detail`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `vijayelectrical_client`
--
ALTER TABLE `vijayelectrical_client`
  ADD PRIMARY KEY (`id_client`);

--
-- Indexes for table `vijayelectrical_invoices`
--
ALTER TABLE `vijayelectrical_invoices`
  ADD PRIMARY KEY (`id_bill`);

--
-- Indexes for table `vijayelectrical_products`
--
ALTER TABLE `vijayelectrical_products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indexes for table `vijayelectrical_profile`
--
ALTER TABLE `vijayelectrical_profile`
  ADD PRIMARY KEY (`id_profile`);

--
-- Indexes for table `vijayelectrical_tmp`
--
ALTER TABLE `vijayelectrical_tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indexes for table `vijayelectrical_users`
--
ALTER TABLE `vijayelectrical_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vijayelectrical_billing_detail`
--
ALTER TABLE `vijayelectrical_billing_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vijayelectrical_client`
--
ALTER TABLE `vijayelectrical_client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vijayelectrical_invoices`
--
ALTER TABLE `vijayelectrical_invoices`
  MODIFY `id_bill` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vijayelectrical_products`
--
ALTER TABLE `vijayelectrical_products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vijayelectrical_profile`
--
ALTER TABLE `vijayelectrical_profile`
  MODIFY `id_profile` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vijayelectrical_tmp`
--
ALTER TABLE `vijayelectrical_tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vijayelectrical_users`
--
ALTER TABLE `vijayelectrical_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
