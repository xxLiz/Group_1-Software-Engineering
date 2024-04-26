--
-- Database: `the-food-depot`
--
CREATE DATABASE IF NOT EXISTS `the-food-depot` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `the-food-depot`;

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--
CREATE TABLE IF NOT EXISTS `Address` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `addressline1` varchar(255) NOT NULL,
  `addressline2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobilenumber` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    payment_method VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- --------------------------------------------------------

--
-- Table structure for table `credit card method`
--
CREATE TABLE credit_cards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    card VARCHAR(16) NOT NULL,
    expiry VARCHAR(5) NOT NULL, -- Format: MM/YY
    cvv VARCHAR(4) NOT NULL,
    billing VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- --------------------------------------------------------

--
-- Table structure for table `cash on delivery method`
--
CREATE TABLE cash_on_delivery (

    name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL
    
);
