-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2024 at 12:28 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xtreamify`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_duration` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `added_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `product_id` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_method_origin` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  `special_id` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `updated_by` varchar(255) NOT NULL DEFAULT '',
  `whatsapp_number` varchar(255) NOT NULL,
  `payment_method_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_duration`, `price`, `status`, `added_at`, `product_id`, `transaction_id`, `payment_method_origin`, `updated_at`, `special_id`, `full_name`, `email`, `quantity`, `updated_by`, `whatsapp_number`, `payment_method_name`) VALUES
(89, '1 mounth', '163.8', 'pending', '2024-01-25 22:08:35', 'xtreamify_8961bef0948d771858e18fe40236a2d789db0b5d46c25874a39e4a5585d2d7788961bef0948d771858e18fe40236a2d7_xtreamify', '8f9aaea84fa800771c0c4740988649964', 'bank_transfer', '', 'xtreamify_f43da00b2c0b9cd87a0b91d266c9bc9ce03595636d926b07823b117758b0d3e4ba9cddc041f8f9aaea84fa800771c0c4_xtreamify', 'ayoub farahi', 'boy.doss2002@gmail.com', '4', '', '55785858', 'cih'),
(90, '1 mounth', '40.95', 'pending', '2024-01-25 22:09:32', 'xtreamify_8961bef0948d771858e18fe40236a2d789db0b5d46c25874a39e4a5585d2d7788961bef0948d771858e18fe40236a2d7_xtreamify', 'f90a527c983eddb7e7aa2309049938362', 'agencies', '', 'xtreamify_bb43cddad81a6b56e5250fb66c118b26253a2947cecc393fc81ce3e4344c34ac2d8c3b58e4ef90a527c983eddb7e7aa2_xtreamify', 'ayoub farahi', 'boy.doss2002@gmail.com', '1', '', '55785858', 'western_union');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
