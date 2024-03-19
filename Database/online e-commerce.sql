-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2024 at 12:27 PM
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
-- Database: `online e-commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `adm_email` varchar(50) NOT NULL,
  `adm_pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `adm_email`, `adm_pass`) VALUES
(1, 'admin123@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `count` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `subtotal` decimal(7,2) NOT NULL,
  `date-added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`id`, `customer_id`, `order_id`, `email`, `count`, `address`, `city`, `state`, `pincode`, `subtotal`, `date-added`) VALUES
(1, 'CUS17077429743289', 'ORDER17079262182322', 'nivask457@gmail.com', '2', 'Erikarai Street', 'Madurai', 'Tamil Nadu', '625016', 0.00, '2024-02-14'),
(2, 'CUS17077429743289', 'ORDER17079270684253', 'nivask457@gmail.com', '2', 'Erikarai Street', 'Madurai', 'Tamil Nadu', '625016', 125.00, '2024-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `order_id` varchar(50) NOT NULL,
  `products` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `price` decimal(7,2) NOT NULL,
  `total` varchar(50) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_id`, `products`, `qty`, `price`, `total`, `date_added`) VALUES
(1, 'CUS17077429743289', 'ORDER17079262182322', 'Britannia Marie Gold Biscuit', '2', 10.00, '20', '2024-02-14'),
(2, 'CUS17077429743289', 'ORDER17079262182322', 'Aashirvaad Atta (500g)', '1', 35.00, '35', '2024-02-14'),
(3, 'CUS17077429743289', 'ORDER17079270684253', 'Britannia Marie Gold Biscuit', '2', 10.00, '20', '2024-02-14'),
(4, 'CUS17077429743289', 'ORDER17079270684253', 'Aashirvaad Atta (500g)', '3', 35.00, '105', '2024-02-14');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `qty` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `qty`, `img`, `date_added`) VALUES
(1, 'Britannia Marie Gold Biscuit', '10.00', '100', 'mariegold.png', '2024-01-24'),
(2, 'Aashirvaad Atta (500g)', '35.00', '100', 'ashirvaad.png', '2024-01-24'),
(3, 'Coriander Powder (50g)', '10.00', '100', 'coriander.png', '2024-01-24'),
(4, 'Pepper Powder (50g)', '10.00', '100', 'pepper.png', '2024-01-24'),
(5, 'Britannia Milk Bikis Biscuit', '10.00', '100', 'milkbikis.png', '2024-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_added` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customer_id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `date_added`) VALUES
(1, 'CUS17077429743289', 'Nivas Kumar', '', 'S', 'nivask457@gmail.com', 'test', '2024-02-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
