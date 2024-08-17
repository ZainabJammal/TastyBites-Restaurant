-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: March 20, 2024 at 07:14 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tastybites`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS`tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, 
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'Steeve Moore', 'steeve', 'E10ADC3949BA59ABBE56E057F20F883E'),
(9, 'Liam Johnson', 'liam', 'E10ADC3949BA59ABBE56E057F20F883E'),
(10, 'Ramsey', 'ramsey', 'E10ADC3949BA59ABBE56E057F20F883E'),
(12, 'Administrator', 'admin', 'E10ADC3949BA59ABBE56E057F20F883E'),
(25, 'admin2', 'admin2', '2513');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `full_name`, `username`, `password`, `phone`, `email`, `address`) VALUES
(1, 'Kelly Dillard', 'Kelly D', 'KellyD','7896547800', 'kelly@gmail.com', '308 Post Avenue'),
(2, 'Thomas Gilchrist', 'Thomas G','ThomasG', '7410001450', 'thom@gmail.com', '1277 Sunburst Drive'),
(3, 'Martha Woods', 'Martha W','MarthaW', '78540001200', 'martha@gmail.com', '478 Avenue Street'),
(4, 'Charlie', 'Charlie','Charlie', '7458965550', 'charlie@gmail.com', '3140 Bartlett Avenue'),
(5, 'Claudia Hedley', 'Claudia H','ClaudiaH', '7451114400', 'hedley@gmail.com', '1119 Kinney Street'),
(6, 'Vernon Vargas', 'Vernon V','VernonV', '7414744440', 'venno@gmail.com', '1234 Hazelwood Avenue'),
(7, 'Carlos Grayson', 'Carlos G','CarlosG',  '7401456980', 'carlos@gmail.com', '2969 Hartland Avenue'),
(8, 'Jonathan Caudill', 'Jonathan C','JonathanC', '7410256996', 'jonathan@gmail.com', '1959 Limer Street');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscriber`
--

CREATE TABLE IF NOT EXISTS `tbl_subscriber` (
  `email` varchar(150) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_subscriber`
--

INSERT INTO `tbl_subscriber` (`full_name`, `email`) VALUES
('Kelly Dillard', 'kelly@gmail.com'),
('Thomas Gilchrist', 'thom@gmail.com'),
('Martha Woods', 'martha@gmail.com'),
('Charlie', 'charlie@gmail.com'); 

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category`(
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Pizza', 'Food_Category_790.jpg', 'Yes', 'Yes'),
(5, 'Burger', 'Food_Category_344.jpg', 'Yes', 'Yes'),
(9, 'Wraps', 'Food_Category_374.jpg', 'Yes', 'Yes'),
(10, 'Pasta', 'Food_Category_948.jpg', 'Yes', 'Yes'),
(11, 'Sandwich', 'Food_Category_536.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE IF NOT EXISTS `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(4, 'Ham Burger', 'Burger with Ham, Pineapple and lots of Cheese.', '4.00', 'Food-Name-6340.jpg', 5, 'Yes', 'Yes'),
(5, 'Smoky BBQ Pizza', 'Best Firewood Pizza in Town.', '9.00', 'Food-Name-8298.jpg', 4, 'No', 'Yes'),
(9, 'Chicken Wrap', 'Crispy flour tortilla loaded with juicy chicken, bacon, lettuce, avocado and cheese drizzled with a delicious spicy Ranch dressing.', '5.00', 'Food-Name-3461.jpg', 9, 'Yes', 'Yes'),
(10, 'Cheeseburger', 'A cheeseburger is a hamburger topped with cheese. Traditionally, the slice of cheese is placed on top of the meat patty.', '4.00', 'Food-Name-433.jpeg', 5, 'Yes', 'Yes'),
(11, 'Grilled Cheese Sandwich', 'Assembled by creating a cheese filling, often cheddar or American between two slices of bread and is then heated until the bread browns and cheese melts.', '3.00', 'Food-Name-3631.jpg', 11, 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offer`
--

CREATE TABLE IF NOT EXISTS `tbl_offer` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `to_date` date NOT NULL,
  `active` varchar(10) NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_offer`
--

INSERT INTO `tbl_offer` (`id`, `title`, `new_price`, `to_date`, `active`, `food_id`) VALUES
(1, 'Special Deal', '2.75', '2024-07-20', 'Yes', 4),
(2, 'Special Deal', '7.75', '2024-07-20', 'Yes', 5),
(3, 'Special Deal', '3.75', '2024-07-20', 'Yes', 9);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`customer_id`) REFERENCES `tbl_customer` (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_address`, `customer_id`) VALUES
(2, 'Best Burger', '4.00', 4, '16.00', '2024-05-25 03:52:43', 'Delivered', '308 Post Avenue', '1'),
(3, 'Mixed Pizza', '10.00', 2, '20.00', '2024-05-30 04:07:17', 'Delivered', '1277 Sunburst Drive', '2'),
(4, 'Mixed Pizza', '10.00', 1, '10.00', '2024-05-04 01:35:34', 'Delivered', '478 Avenue Street', '3'),
(6, 'Chicken Wrap', '7.00', 1, '7.00', '2024-04-20 06:10:37', 'Delivered', '3140 Bartlett Avenue', '4'),
(7, 'Cheeseburger', '4.00', 2, '8.00', '2024-04-20 06:40:21', 'On Delivery', '1119 Kinney Street', '5'),
(8, 'Smoky BBQ Pizza', '6.00', 1, '6.00', '2024-05-20 06:40:57', 'Ordered', '1234 Hazelwood Avenue', '6'),
(9, 'Chicken Wrap', '5.00', 4, '20.00', '2024-05-20 07:06:06', 'Cancelled', '2969 Hartland Avenue', '7'),
(10, 'Grilled Cheese Sandwich', '3.00', 4, '12.00', '2024-05-10 07:11:06', 'Delivered', '1959 Limer Street', '8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_supplier`
--

CREATE TABLE IF NOT EXISTS `tbl_supplier` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `food` varchar(150) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_supplier`
--

INSERT INTO `tbl_supplier` (`id`, `company_name`, `phone`, `email`, `address`, `food`, `qty`, `price`) VALUES
(1, 'Chicken Shop', '7896547800', 'chicken@gmail.com', '308 Post Avenue', 'Chicken', '8', '15'),
(2, 'Meat Shop', '7410001450', 'meat@gmail.com', '1277 Sunburst Drive', 'Meat', '8', '18'),
(3, 'Vegetable Shop', '78540001200', 'vegetable@gmail.com', '478 Avenue Street', 'Vegetables', '5', '10'),
(4, 'Bread Shop', '7458965550', 'bread@gmail.com', '3140 Bartlett Avenue', 'Bread', '5', '9');
-- --------------------------------------------------------



--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;