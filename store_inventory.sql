-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 06:25 PM
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
-- Database: `store_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Electronics', 'Electronic Devices and Accessories'),
(2, 'Clothing', 'Apparel and Fashion Accessories'),
(3, 'Home and Garden', 'Home Decor and Gardening Supplies'),
(4, 'Books', 'Books and Literature'),
(5, 'Sports', 'Sporting Goods and Equipment'),
(6, 'Toys', 'Toys and Games'),
(7, 'Food and Beverages', 'Groceries and General Edibles');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `payment_id` int(20) NOT NULL,
  `payment_bank` varchar(255) NOT NULL,
  `payment_account` varchar(255) NOT NULL,
  `spr_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`payment_id`, `payment_bank`, `payment_account`, `spr_id`) VALUES
(1, 'First Bank', '12345678901', 1),
(2, 'GTBank', '23456789012', 2),
(3, 'Zenith Bank', '34567890123', 3),
(4, 'Access Bank', '45678901234', 4),
(5, 'UBA', '56789012345', 5),
(6, 'Fidelity Bank', '67890123456', 6),
(7, 'First Bank', '78901234567', 1),
(8, 'GTBank', '89012345678', 2),
(9, 'Zenith Bank', '90123456789', 3),
(10, 'Access Bank', '12345678901', 4),
(11, 'GTBank', '2254354365', 2);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(20) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `cost_price` int(20) NOT NULL,
  `selling_price` int(20) NOT NULL,
  `cty_id` int(20) NOT NULL,
  `spr_id` int(20) NOT NULL,
  `reorder_quantity` int(20) NOT NULL,
  `quantity` int(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `cost_price`, `selling_price`, `cty_id`, `spr_id`, `reorder_quantity`, `quantity`) VALUES
(1, 'Dell XPS 13 Laptop', 120000, 155000, 1, 1, 15, 55),
(2, 'MacBook Pro 15\" 512GB', 200000, 250000, 1, 2, 20, 26),
(3, 'HP Spectre x360', 130000, 160000, 1, 3, 12, 47),
(4, 'Nike Air Max Sneakers', 8500, 12000, 2, 4, 15, 0),
(5, 'Adidas Ultraboost Running Shoes', 12000, 16000, 2, 5, 18, 0),
(6, 'Levi\'s 501 Original Fit Jeans', 4000, 6000, 2, 6, 10, 0),
(7, 'Mid-Century Modern Coffee Table', 30000, 45000, 3, 1, 12, 0),
(8, 'Velvet Accent Chair', 25000, 35000, 3, 2, 15, 0),
(9, 'Smart LED Bulb', 800, 1200, 3, 3, 10, 0),
(10, 'Educated by Tara Westover (Paperback)', 2000, 3000, 4, 4, 15, 0),
(11, 'The Silent Patient by Alex Michaelides', 2500, 3500, 3, 5, 20, 0),
(12, 'Sapiens A Brief History of Humankind', 3000, 4500, 4, 6, 18, 0),
(13, 'Wilson Pro Staff Tennis Racket', 10000, 15000, 5, 1, 20, 0),
(14, 'Nike Premier Team Soccer Ball', 3000, 5000, 5, 2, 15, 0),
(15, 'Fitbit Charge 4 Fitness Tracker', 12000, 18000, 5, 3, 12, 0),
(16, 'LEGO Star Wars Millennium Falcon', 12000, 18000, 6, 4, 18, 0),
(17, 'Barbie Dreamhouse', 15000, 22000, 6, 5, 15, 0),
(18, 'Nintendo Switch Console', 40000, 55000, 6, 6, 20, 0),
(19, 'Samsung 55\" 4K UHD Smart TV', 60000, 75000, 1, 1, 15, 0),
(20, 'Sony WH-1000XM4 Wireless Headphones', 25000, 30000, 2, 2, 18, 0),
(21, 'Nespresso VertuoPlus Coffee Maker', 15000, 20000, 3, 3, 12, 0),
(22, 'Instant Pot Duo 6-Quart', 18000, 25000, 4, 4, 15, 0),
(23, 'Canon EOS Rebel T7 DSLR Camera', 30000, 40000, 5, 5, 18, 0),
(24, 'KitchenAid Stand Mixer', 35000, 45000, 6, 6, 20, 0),
(25, 'Samsung Galaxy Watch Active 2', 15000, 20000, 1, 1, 15, 0),
(26, 'Samsung Galaxy S21 Ultra', 200000, 250000, 1, 1, 15, 0),
(27, 'Agege Bread', 500, 550, 7, 3, 15, 6);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_details`
--

CREATE TABLE `purchase_details` (
  `por_id` int(20) NOT NULL,
  `pdt_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_details`
--

INSERT INTO `purchase_details` (`por_id`, `pdt_id`, `quantity`) VALUES
(1, 2, 5),
(2, 2, 5),
(5, 1, 5),
(6, 27, 6),
(9, 3, 3),
(10, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_orders`
--

CREATE TABLE `purchase_orders` (
  `order_id` int(20) NOT NULL,
  `order_date` date DEFAULT NULL,
  `total_value` int(20) DEFAULT NULL,
  `spr_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_orders`
--

INSERT INTO `purchase_orders` (`order_id`, `order_date`, `total_value`, `spr_id`) VALUES
(1, '2023-11-15', 1000000, 1),
(2, '2023-11-15', 1000000, 1),
(5, '2023-11-15', 600000, 1),
(6, '2023-11-15', 3000, 3),
(9, '2023-11-16', 390000, 4),
(10, '2023-11-16', 240000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sor_id` int(20) NOT NULL,
  `pdt_id` int(20) NOT NULL,
  `quantity` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sor_id`, `pdt_id`, `quantity`) VALUES
(1, 1, 22),
(2, 1, 22),
(2, 2, 5),
(2, 3, 2),
(3, 1, 2),
(3, 3, 1),
(4, 1, 4),
(4, 3, 2),
(5, 1, 2),
(6, 2, 2),
(6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `order_id` int(20) NOT NULL,
  `order_date` date NOT NULL,
  `total_value` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`order_id`, `order_date`, `total_value`) VALUES
(1, '2023-11-15', 3410000),
(2, '2023-11-15', 4980000),
(3, '2023-11-15', 470000),
(4, '2023-11-15', 940000),
(5, '2023-11-15', 310000),
(6, '2023-11-16', 660000);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(20) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `supplier_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_email`) VALUES
(1, 'TechGadgets Inc.', 'info@techgadgets.com'),
(2, 'FashionTrends Ltd.', 'sales@fashiontrends.com'),
(3, 'FreshProduce Co.', 'contact@freshproduceco.com'),
(4, 'OfficeEssentials Corp.', 'support@officeessentials.com'),
(5, 'HomeDecor Solutions', 'info@homedecorsolutions.com'),
(6, 'Erudite Global Resources Ltd.', 'egrltd@gmail.com'),
(7, 'Okenwa and Sons Merchandise', 'okey64@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `spr_id` (`spr_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `spr_id` (`spr_id`),
  ADD KEY `cty_id` (`cty_id`);

--
-- Indexes for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD PRIMARY KEY (`por_id`,`pdt_id`),
  ADD KEY `pdt_id` (`pdt_id`);

--
-- Indexes for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `spr_id` (`spr_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sor_id`,`pdt_id`),
  ADD KEY `pdt_id` (`pdt_id`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `payment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `order_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`spr_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`spr_id`) REFERENCES `suppliers` (`supplier_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`cty_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `purchase_details`
--
ALTER TABLE `purchase_details`
  ADD CONSTRAINT `purchase_details_ibfk_1` FOREIGN KEY (`por_id`) REFERENCES `purchase_orders` (`order_id`),
  ADD CONSTRAINT `purchase_details_ibfk_2` FOREIGN KEY (`pdt_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `purchase_orders`
--
ALTER TABLE `purchase_orders`
  ADD CONSTRAINT `purchase_orders_ibfk_1` FOREIGN KEY (`spr_id`) REFERENCES `suppliers` (`supplier_id`);

--
-- Constraints for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD CONSTRAINT `sales_details_ibfk_1` FOREIGN KEY (`sor_id`) REFERENCES `sales_orders` (`order_id`),
  ADD CONSTRAINT `sales_details_ibfk_2` FOREIGN KEY (`pdt_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
