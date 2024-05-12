-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 02:27 PM
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
-- Database: `jfkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
  `log_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `action_type` enum('Add','Update','Remove') NOT NULL,
  `date` datetime NOT NULL,
  `previous_state` text NOT NULL,
  `new_state` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_log`
--

INSERT INTO `inventory_log` (`log_id`, `product_id`, `action_type`, `date`, `previous_state`, `new_state`) VALUES
(1, 1, 'Update', '2024-05-12 06:59:51', 'Stock: 40', 'Stock: 50'),
(2, 1, 'Update', '2024-05-10 03:59:37', 'Stock: 40\n', 'Stock: 45\n'),
(3, 1, 'Update', '2024-05-10 03:59:49', 'Net Weight: 150g\nStock: 45\n', 'Net Weight: NULL\nStock: 40\n'),
(4, 1, 'Update', '2024-05-10 03:59:57', 'Net Weight: NULL\n', 'Net Weight: 150g\n'),
(5, 548, 'Add', '2024-05-10 04:00:12', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Pack\nCategory: Dairy Products\nUnit Price: 43\nRetail Price: 48\nStock: 3\nUrl: Halls Fresh me123 140g.png'),
(6, 548, 'Remove', '2024-05-10 04:00:23', 'Product ID: 548\nProduct Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Pack\nCategory: Dairy Products\nUnit Price: 43.00\nRetail Price: 48.00\nStock: 3\nUrl: Halls Fresh me123 140g.png', 'Removed from the inventory.'),
(7, 549, 'Add', '2024-05-11 20:38:27', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Candies & Chocolates\nUnit Price: 43\nRetail Price: 48\nStock: 3\nUrl: Halls Fresh me123 140g.png'),
(8, 549, 'Remove', '2024-05-11 20:41:19', 'Product ID: 549\nProduct Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Candies & Chocolates\nUnit Price: 43.00\nRetail Price: 48.00\nStock: 3\nUrl: Halls Fresh me123 140g.png', 'Removed from the inventory.'),
(9, 1, 'Update', '2024-05-12 05:05:53', 'Stock: 40\n', 'Stock: 45\n'),
(10, 550, 'Add', '2024-05-12 05:06:52', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 3\nUrl: Halls Fresh me123 140g.png'),
(11, 1, 'Update', '2024-05-12 05:08:23', 'Stock: 45\n', 'Stock: 41\n'),
(12, 1, 'Update', '2024-05-12 05:10:30', 'Stock: 41\n', 'Stock: 42\n'),
(13, 1, 'Update', '2024-05-12 05:11:07', 'Stock: 42\n', 'Stock: 43\n'),
(14, 550, 'Remove', '2024-05-12 05:15:41', 'Product ID: 550\nProduct Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43.00\nRetail Price: 48.00\nStock: 3\nUrl: Halls Fresh me123 140g.png', 'Removed from the inventory.'),
(15, 551, 'Add', '2024-05-12 05:17:01', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 31\nUrl: Halls Fresh me123 140g.png'),
(16, 551, 'Remove', '2024-05-12 05:17:11', 'Product ID: 551\nProduct Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43.00\nRetail Price: 48.00\nStock: 31\nUrl: Halls Fresh me123 140g.png', 'Removed from the inventory.'),
(17, 1, 'Update', '2024-05-12 05:23:55', 'Stock: 43\n', 'Stock: 44\n'),
(18, 1, 'Update', '2024-05-12 05:24:15', 'Stock: 44\n', 'Stock: 45\n'),
(19, 1, 'Update', '2024-05-12 05:24:22', 'Stock: 45\n', 'Stock: 46\n'),
(20, 552, 'Add', '2024-05-12 05:31:46', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 31\nUrl: Halls Fresh me123 140g.png'),
(21, 553, 'Add', '2024-05-12 05:32:49', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 1\nUrl: Halls Fresh me123 140g.png'),
(22, 554, 'Add', '2024-05-12 05:33:47', 'No previous state', 'Product Name: Halls Fresh me123\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 1\nUrl: Halls Fresh me123 140g.png'),
(23, 555, 'Add', '2024-05-12 05:33:59', 'No previous state', 'Product Name: Halls Fresh me12345\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 1\nUrl: Halls Fresh me12345 140g.png'),
(24, 556, 'Add', '2024-05-12 05:35:22', 'No previous state', 'Product Name: Halls Fresh me12345\nNet Weight: 140g\nUnit: Piece\nCategory: Canned Goods\nUnit Price: 43\nRetail Price: 48\nStock: 1\nUrl: Halls Fresh me12345 140g.png'),
(25, 1, 'Update', '2024-05-12 05:39:39', 'Stock: 46\n', 'Stock: 47\n'),
(26, 557, 'Add', '2024-05-12 05:46:41', 'No previous state', 'Product Name: Halls Fresh me12345\nNet Weight: 20g\nUnit: Piece\nCategory: Candies & Chocolates\nUnit Price: 23.5\nRetail Price: 25\nStock: 1\nUrl: Halls Fresh me12345 20g.png'),
(27, 558, 'Add', '2024-05-12 05:51:18', 'No previous state', 'Product Name: Halls Fresh me123450\nNet Weight: 20g\nUnit: Piece\nCategory: Dairy Products\nUnit Price: 23.5\nRetail Price: 25\nStock: 1\nUrl: Halls Fresh me123450 20g.png'),
(28, 559, 'Add', '2024-05-12 05:52:06', 'No previous state', 'Product Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Cooking Ingredients & Seasonings\nUnit Price: 23.5\nRetail Price: 25\nStock: 1\nUrl: Halls Fresh me1234500 20g.png'),
(29, 560, 'Add', '2024-05-12 05:52:35', 'No previous state', 'Product Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Condiments & Sauces\nUnit Price: 23.5\nRetail Price: 25\nStock: 1\nUrl: Halls Fresh me1234500 20g.png'),
(30, 560, 'Remove', '2024-05-12 05:59:33', 'Product ID: 560\nProduct Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Condiments & Sauces\nUnit Price: 23.50\nRetail Price: 25.00\nStock: 1\nUrl: Halls Fresh me1234500 20g.png', 'Removed from the inventory.'),
(31, 559, 'Remove', '2024-05-12 06:00:50', 'Product ID: 559\nProduct Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Cooking Ingredients & Seasonings\nUnit Price: 23.50\nRetail Price: 25.00\nStock: 1\nUrl: Halls Fresh me1234500 20g.png', 'Removed from the inventory.'),
(32, 1, 'Update', '2024-05-12 06:01:04', 'Stock: 47\n', 'Stock: 48\n'),
(33, 558, 'Remove', '2024-05-12 06:11:58', 'Product ID: 558\nProduct Name: Halls Fresh me123450\nNet Weight: 20g\nUnit: Piece\nCategory: Dairy Products\nUnit Price: 23.50\nRetail Price: 25.00\nStock: 1\nUrl: Halls Fresh me123450 20g.png', 'Removed from the inventory.'),
(34, 1, 'Update', '2024-05-12 06:12:13', 'Stock: 48\n', 'Stock: 49\n'),
(35, 561, 'Add', '2024-05-12 06:12:22', 'No previous state', 'Product Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Bread\nUnit Price: 23.5\nRetail Price: 25\nStock: 1\nUrl: Halls Fresh me1234500 20g.png'),
(36, 561, 'Remove', '2024-05-12 06:24:25', 'Product ID: 561\nProduct Name: Halls Fresh me1234500\nNet Weight: 20g\nUnit: Piece\nCategory: Bread\nUnit Price: 23.50\nRetail Price: 25.00\nStock: 1\nUrl: Halls Fresh me1234500 20g.png', 'Removed from the inventory.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`log_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
