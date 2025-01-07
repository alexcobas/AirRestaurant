-- --------------------------------------------------------
-- Host:                         localhost
-- Versión del servidor:         9.1.0 - MySQL Community Server - GPL
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para AirRestaurant
CREATE DATABASE IF NOT EXISTS `AirRestaurant` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `AirRestaurant`;

-- Volcando estructura para tabla AirRestaurant.addresses
CREATE TABLE IF NOT EXISTS `addresses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `codPostal` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addresses_ibfk_1` (`user_id`),
  CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.addresses: ~35 rows (aproximadamente)
DELETE FROM `addresses`;
INSERT INTO `addresses` (`id`, `user_id`, `address`, `city`, `codPostal`) VALUES
	(1, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(2, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(3, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(4, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(5, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(6, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(7, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(8, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(9, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(10, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(11, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(12, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(13, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(14, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(15, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(16, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(17, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(18, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(19, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(20, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(21, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(22, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(23, 5, 'Calle Carmen Galceran, nº 34, 2º2ª', 'Molins De Rei', '08750'),
	(24, 5, 'Calle Carmen Galceran, nº 34, 2º2ª', 'Molins De Rei', '08750'),
	(25, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(26, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(27, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(28, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(29, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(30, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(31, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(32, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(33, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(34, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(35, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(36, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(37, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(38, 2, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(39, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(40, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(41, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(42, NULL, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(43, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(44, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(45, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(46, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(47, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(48, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(49, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(50, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(51, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750'),
	(52, 5, 'Calle Carmen Gqlceran', 'Molins De Rei', '08750');

-- Volcando estructura para tabla AirRestaurant.cards
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `cardNumber` varchar(16) NOT NULL,
  `cvv` varchar(4) NOT NULL,
  `codPostal` varchar(10) NOT NULL,
  `country` varchar(50) NOT NULL,
  `expirationDate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `isPrimary` tinyint DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cards_ibfk_1` (`user_id`),
  CONSTRAINT `cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.cards: ~49 rows (aproximadamente)
DELETE FROM `cards`;
INSERT INTO `cards` (`id`, `user_id`, `cardNumber`, `cvv`, `codPostal`, `country`, `expirationDate`, `isPrimary`) VALUES
	(16, 2, '6456456456456456', '645', '56456', 'España', '64/56', 0),
	(25, 2, '4444555511112222', '232', '12321', 'España', '23/23', NULL),
	(26, 2, '4444555511112222', '232', '12321', 'España', '23/23', NULL),
	(27, 2, '4444555511112222', '232', '12321', 'España', '23/23', NULL),
	(28, 5, '6456456456456456', '645', '64564', 'España', '45/64', 1),
	(29, 5, '4564564565464564', '456', '64564', 'España', '56/45', 0),
	(33, 5, '3423423423423423', '', '', 'España', '', NULL),
	(34, 5, '4234234234234234', '234', '23423', 'España', '23/42', NULL),
	(35, 5, '2342342342342342', '423', '23423', 'España', '42/34', NULL),
	(36, 5, '4645645645646545', '654', '64565', 'España', '54/64', NULL),
	(37, 5, '4645645645646545', '654', '64565', 'España', '54/64', NULL),
	(40, NULL, '4645645645645645', '544', '45654', 'España', '64/56', NULL),
	(41, NULL, '4645645645645645', '544', '45654', 'España', '64/56', NULL),
	(42, NULL, '4564554545545454', '445', '45465', 'España', '44/45', NULL),
	(43, NULL, '9964665564656464', '646', '64646', 'España', '46/46', NULL),
	(44, NULL, '4564456564465456', '646', '46464', 'España', '45/64', NULL),
	(45, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(46, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(47, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(48, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(49, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(50, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(51, NULL, '6456456456456456', '564', '56456', 'España', '45/64', NULL),
	(52, NULL, '6456456456456456', '654', '64564', 'España', '65/46', NULL),
	(53, NULL, '6456456456456456', '654', '64564', 'España', '65/46', NULL),
	(54, NULL, '6456456456456456', '654', '64564', 'España', '65/46', NULL),
	(55, NULL, '6645456645645645', '645', '45664', 'España', '54/64', NULL),
	(56, NULL, '4545451254215455', '456', '45645', 'España', '46/54', NULL),
	(57, NULL, '4564564565464564', '645', '64564', 'España', '64/56', NULL),
	(58, NULL, '4564564565464564', '645', '64564', 'España', '64/56', NULL),
	(59, NULL, '4564564565464564', '645', '64564', 'España', '64/56', NULL),
	(60, NULL, '4564565465465464', '456', '64564', 'España', '45/64', NULL),
	(61, NULL, '4564565465465464', '456', '64564', 'España', '45/64', NULL),
	(62, NULL, '5464564564564564', '645', '64564', 'España', '56/45', NULL),
	(63, NULL, '5464564564564564', '645', '64564', 'España', '56/45', NULL),
	(64, NULL, '5464564564564564', '645', '64564', 'España', '56/45', NULL),
	(65, NULL, '5464564564564564', '645', '64564', 'España', '56/45', NULL),
	(66, NULL, '5464564564564564', '645', '64564', 'España', '56/45', NULL),
	(67, NULL, '5645654645645645', '456', '64564', 'España', '45/64', NULL),
	(68, NULL, '6456456456456456', '456', '65464', 'España', '64/56', NULL),
	(69, NULL, '4353454354354354', '354', '35435', 'España', '43/54', NULL),
	(70, NULL, '4242424242424242', '424', '24242', 'España', '24/24', NULL),
	(71, NULL, '4564564564564564', '645', '64564', 'España', '56/46', NULL),
	(72, NULL, '4564565464564564', '645', '64564', 'España', '45/64', NULL),
	(73, NULL, '4564565464564564', '645', '64564', 'España', '45/64', NULL),
	(74, NULL, '4564565464564564', '645', '64564', 'España', '45/64', NULL),
	(75, NULL, '4564564564564564', '645', '64564', 'España', '56/46', NULL),
	(76, NULL, '5645238989008756', '879', '80707', 'España', '78/90', NULL),
	(77, 5, '0000000000000000', '000', '00000', 'España', '00/00', 0),
	(78, NULL, '', '', '', 'España', '', NULL),
	(79, NULL, '', '', '', 'España', '', NULL),
	(80, NULL, '4234234234242424', '234', '42342', 'España', '42/34', NULL),
	(81, 7, '4535345435435454', '354', '43545', 'España', '54/35', 1);

-- Volcando estructura para tabla AirRestaurant.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.categories: ~5 rows (aproximadamente)
DELETE FROM `categories`;
INSERT INTO `categories` (`id`, `title`, `name`, `icon`, `img`) VALUES
	(1, 'Hamburguesas', 'Hamburguesa', 'iHamburguer.svg', 'hamburguesa.webp'),
	(2, 'Bebidas', 'Bebida', 'iWater.svg', 'bebidas.webp'),
	(3, 'Pizzas', 'Pizza', 'iPizza.svg', 'pizza.webp'),
	(4, 'Complementos', 'Complemento', 'iComplements.png', 'patatas-fritas.webp'),
	(5, 'Menus', 'Menu', 'iFastFood.svg', 'menuCategory.jpg');

-- Volcando estructura para tabla AirRestaurant.ingredients
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `extra_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.ingredients: ~5 rows (aproximadamente)
DELETE FROM `ingredients`;
INSERT INTO `ingredients` (`id`, `name`, `extra_price`) VALUES
	(1, 'Tomate', 0.50),
	(2, 'Pan', 0.00),
	(3, 'Carne', 2.00),
	(4, 'Lechuga', 0.25),
	(5, 'Cebolla', 0.10);

-- Volcando estructura para tabla AirRestaurant.offers
CREATE TABLE IF NOT EXISTS `offers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.offers: ~2 rows (aproximadamente)
DELETE FROM `offers`;
INSERT INTO `offers` (`id`, `name`, `discount_percentage`, `start_date`, `end_date`) VALUES
	(1, 'Airbnb', 5.00, '2025-01-03', '2025-01-05'),
	(2, 'Bernat el ferrer', 10.00, '2025-01-07', '2025-01-22');

-- Volcando estructura para tabla AirRestaurant.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `card_id` int DEFAULT NULL,
  `address_id` int DEFAULT NULL,
  `order_price` float DEFAULT NULL,
  `offer_id` int DEFAULT NULL,
  `order_price_total` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `address_id` (`address_id`) USING BTREE,
  KEY `card_id` (`card_id`) USING BTREE,
  KEY `orders_ibfk_4` (`offer_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`card_id`) REFERENCES `cards` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orders_ibfk_4` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.orders: ~44 rows (aproximadamente)
DELETE FROM `orders`;
INSERT INTO `orders` (`id`, `user_id`, `card_id`, `address_id`, `order_price`, `offer_id`, `order_price_total`, `created_at`) VALUES
	(1, 5, 28, NULL, 19.45, NULL, NULL, '2025-01-02 11:31:58'),
	(2, 5, 28, NULL, 47.85, NULL, NULL, '2025-01-02 11:44:05'),
	(3, 5, 28, NULL, 47.85, NULL, NULL, '2025-01-02 11:44:52'),
	(4, 5, 28, NULL, 47.85, NULL, NULL, '2025-01-02 11:45:28'),
	(6, NULL, 41, NULL, 49.45, NULL, NULL, '2025-01-02 11:49:44'),
	(7, NULL, 42, NULL, 106.6, NULL, NULL, '2025-01-02 12:23:33'),
	(8, NULL, 43, NULL, 106.6, NULL, NULL, '2025-01-02 12:26:21'),
	(9, NULL, 44, NULL, 168.5, NULL, NULL, '2025-01-02 12:29:26'),
	(10, NULL, 45, NULL, 168.5, NULL, NULL, '2025-01-02 12:42:41'),
	(11, NULL, 46, NULL, 168.5, NULL, NULL, '2025-01-02 12:43:29'),
	(12, NULL, 47, NULL, 168.5, NULL, NULL, '2025-01-02 12:43:48'),
	(13, NULL, 48, NULL, 168.5, NULL, NULL, '2025-01-02 12:44:16'),
	(14, NULL, 49, NULL, 168.5, NULL, NULL, '2025-01-02 12:44:47'),
	(15, NULL, 50, NULL, 168.5, NULL, NULL, '2025-01-02 12:45:31'),
	(16, NULL, 51, NULL, 168.5, NULL, NULL, '2025-01-02 12:46:52'),
	(17, NULL, 52, NULL, 168.5, NULL, NULL, '2025-01-02 12:47:18'),
	(18, NULL, 53, NULL, 168.5, NULL, NULL, '2025-01-02 12:47:27'),
	(19, NULL, 54, NULL, 168.5, NULL, NULL, '2025-01-02 12:47:45'),
	(20, NULL, 55, NULL, 168.5, NULL, NULL, '2025-01-02 12:48:12'),
	(21, 5, 28, NULL, 47.85, NULL, NULL, '2025-01-02 13:02:20'),
	(22, NULL, 56, NULL, 35.4, NULL, NULL, '2025-01-02 15:08:31'),
	(23, NULL, 66, 1, 51.35, NULL, NULL, '2025-01-02 15:40:25'),
	(24, NULL, 67, 3, 19.45, NULL, NULL, '2025-01-03 13:07:40'),
	(25, NULL, 68, 5, 19.45, NULL, NULL, '2025-01-03 13:09:43'),
	(26, NULL, 69, 7, 19.45, 1, NULL, '2025-01-03 13:10:15'),
	(27, NULL, 70, 9, 19.45, 1, NULL, '2025-01-03 13:11:28'),
	(28, NULL, 71, 11, 19.45, 1, NULL, '2025-01-03 13:37:11'),
	(29, NULL, 73, 15, 175.45, 1, 172, '2025-01-03 13:42:02'),
	(30, NULL, 74, 17, 83.25, 1, 82, '2025-01-03 13:43:23'),
	(31, NULL, 75, 19, 44.35, 1, 43.6, '2025-01-03 13:44:27'),
	(32, NULL, 76, 21, 56.8, NULL, 56.8, '2025-01-03 13:45:10'),
	(33, 5, 28, 23, 51.35, 1, 50.46, '2025-01-03 17:37:38'),
	(34, 5, 28, 25, 122.85, NULL, 122.85, '2025-01-03 17:57:57'),
	(35, 5, 28, 27, 35.4, NULL, 35.4, '2025-01-03 20:58:32'),
	(36, NULL, NULL, 29, 35.4, 1, 34.83, '2025-01-06 11:00:03'),
	(37, NULL, 78, 31, 54.85, NULL, 54.85, '2025-01-06 11:12:44'),
	(38, 2, 25, 33, 54.85, NULL, 54.85, '2025-01-06 11:16:01'),
	(39, 2, 16, 35, 51.35, NULL, 51.35, '2025-01-06 11:20:01'),
	(40, 2, 16, 37, 19.45, NULL, 19.45, '2025-01-06 11:21:25'),
	(41, NULL, 79, 39, 31.9, NULL, 31.9, '2025-01-06 11:22:17'),
	(42, NULL, 80, 41, 44.35, NULL, 44.35, '2025-01-06 18:01:39'),
	(43, 5, 28, 47, 38.9, NULL, 38.9, '2025-01-07 11:58:37'),
	(44, 5, 28, 49, 38.9, NULL, 38.9, '2025-01-07 11:58:59'),
	(45, 5, 28, 51, 51.35, NULL, 51.35, '2025-01-07 15:56:50');

-- Volcando estructura para tabla AirRestaurant.order_product
CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `custom_price` decimal(10,2) DEFAULT NULL,
  `quantity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.order_product: ~80 rows (aproximadamente)
DELETE FROM `order_product`;
INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `custom_price`, `quantity`) VALUES
	(1, 3, 9, 12.45, 1),
	(2, 3, 8, 15.95, 1),
	(3, 4, 9, 12.45, 2),
	(4, 4, 8, 15.95, 1),
	(7, 6, 9, 12.45, 1),
	(8, 6, 1, 15.00, 2),
	(9, 7, 9, 12.45, 8),
	(10, 8, 9, 12.45, 8),
	(11, 9, 9, 12.45, 8),
	(12, 9, 8, 15.95, 2),
	(13, 9, 1, 15.00, 2),
	(14, 10, 9, 12.45, 8),
	(15, 10, 8, 15.95, 2),
	(16, 10, 1, 15.00, 2),
	(17, 11, 9, 12.45, 8),
	(18, 11, 8, 15.95, 2),
	(19, 11, 1, 15.00, 2),
	(20, 12, 9, 12.45, 8),
	(21, 12, 8, 15.95, 2),
	(22, 12, 1, 15.00, 2),
	(23, 13, 9, 12.45, 8),
	(24, 13, 8, 15.95, 2),
	(25, 13, 1, 15.00, 2),
	(26, 14, 9, 12.45, 8),
	(27, 14, 8, 15.95, 2),
	(28, 14, 1, 15.00, 2),
	(29, 15, 9, 12.45, 8),
	(30, 15, 8, 15.95, 2),
	(31, 15, 1, 15.00, 2),
	(32, 16, 9, 12.45, 8),
	(33, 16, 8, 15.95, 2),
	(34, 16, 1, 15.00, 2),
	(35, 17, 9, 12.45, 8),
	(36, 17, 8, 15.95, 2),
	(37, 17, 1, 15.00, 2),
	(38, 18, 9, 12.45, 8),
	(39, 18, 8, 15.95, 2),
	(40, 18, 1, 15.00, 2),
	(41, 19, 9, 12.45, 8),
	(42, 19, 8, 15.95, 2),
	(43, 19, 1, 15.00, 2),
	(44, 20, 9, 12.45, 8),
	(45, 20, 8, 15.95, 2),
	(46, 20, 1, 15.00, 2),
	(47, 21, 8, 15.95, 1),
	(48, 21, 9, 12.45, 2),
	(49, 22, 8, 15.95, 1),
	(50, 22, 9, 12.45, 1),
	(51, 23, 9, 12.45, 1),
	(52, 23, 8, 15.95, 2),
	(53, 24, 9, 12.45, 1),
	(54, 25, 9, 12.45, 1),
	(55, 26, 9, 12.45, 1),
	(56, 27, 9, 12.45, 1),
	(57, 28, 9, 12.45, 1),
	(58, 29, 9, 12.45, 2),
	(59, 29, 8, 15.95, 9),
	(60, 30, 9, 12.45, 1),
	(61, 30, 8, 15.95, 4),
	(62, 31, 9, 12.45, 3),
	(63, 32, 9, 12.45, 4),
	(64, 33, 9, 12.45, 1),
	(65, 33, 8, 15.95, 1),
	(66, 34, 9, 12.45, 1),
	(67, 34, 8, 15.95, 1),
	(68, 34, 1, 15.00, 1),
	(69, 35, 9, 12.45, 1),
	(70, 35, 8, 15.95, 1),
	(71, 36, 9, 12.45, 1),
	(72, 36, 8, 15.95, 1),
	(73, 37, 8, 15.95, 1),
	(74, 38, 8, 15.95, 1),
	(75, 39, 9, 12.45, 1),
	(76, 39, 8, 15.95, 1),
	(77, 40, 9, 12.45, 1),
	(78, 41, 9, 12.45, 1),
	(79, 42, 9, 12.45, 1),
	(80, 44, 8, 15.95, 2),
	(81, 45, 8, 15.95, 2),
	(82, 45, 9, 12.45, 1);

-- Volcando estructura para tabla AirRestaurant.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `base_price` float NOT NULL DEFAULT (0),
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.products: ~12 rows (aproximadamente)
DELETE FROM `products`;
INSERT INTO `products` (`id`, `name`, `description`, `base_price`, `created_at`, `category_id`) VALUES
	(1, 'Hamburgesa completa', 'Hamburguesa basica', 15, '2024-11-09 13:28:55', 1),
	(8, 'Hamburguesa pulled pork', 'Una hamburguesa con una riquisima carne de cerdo ahumada.', 16.95, '2024-11-16 10:09:44', 1),
	(9, 'Pizza barbacoa', 'Una deliciosa pizza barbacoa.', 12.45, '2024-11-16 09:41:51', 3),
	(10, 'Pizza de jamon y queso', 'La pizza que le gusta a todos!', 11.55, '2025-01-07 20:06:24', 3),
	(11, 'CocaCola', 'CocaCola.', 2, '2025-01-07 20:07:10', 2),
	(12, 'Agua pequeña', 'Agua pequeña (330ml).', 1, '2025-01-07 20:09:32', 2),
	(13, 'Fanta', 'Fanta.', 1.5, '2025-01-07 21:10:07', 2),
	(14, 'Cerveza', 'Cerveza.', 2.25, '2025-01-07 20:10:46', 2),
	(15, 'Bolitas de pollo', 'Bolas de pollo rebozado.(6 unidades)', 7, '2025-01-07 20:11:38', 4),
	(16, 'Hamburguesa picante', 'Una hamburguesa con un toque picanton.', 14.55, '2025-01-07 20:12:33', 1),
	(17, 'Patatas fritas', 'Patatas fritas.', 3, '2025-01-07 20:34:07', 4),
	(18, 'Menu AirHamburguer', 'Un menu completo con hamburgesa patatas y bebida.', 18.55, '2025-01-07 20:38:48', 5);

-- Volcando estructura para tabla AirRestaurant.products_images
CREATE TABLE IF NOT EXISTS `products_images` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `photo_archive_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product` (`product_id`),
  CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.products_images: ~16 rows (aproximadamente)
DELETE FROM `products_images`;
INSERT INTO `products_images` (`id`, `product_id`, `photo_archive_name`) VALUES
	(1, 1, 'HamburguesaClasica1.jpg'),
	(8, 8, 'hamburguesaPulledPork3.webp'),
	(9, 8, 'hamburguesaPulledPork2.webp'),
	(10, 8, 'hamburguesaPulledPork1.webp'),
	(11, 9, 'pizzaBarbacoa1.webp'),
	(12, 9, 'pizzaBarbacoa2.jpg'),
	(13, 9, 'pizzaBarbacoa3.jpg'),
	(14, 12, 'agua330ml.jpg'),
	(15, 13, 'fanta.jpg'),
	(16, 14, 'cerveza.png'),
	(17, 11, 'cocacola.jpg'),
	(18, 16, 'hamburguesa-picante.jpg'),
	(19, 15, 'bolitas-de-pollo.png'),
	(20, 10, 'pizza-jamon-y-queso.jpg'),
	(21, 17, 'patatas-fritas-c.jpg'),
	(22, 18, 'menu_AirMenu.png');

-- Volcando estructura para tabla AirRestaurant.product_ingredients
CREATE TABLE IF NOT EXISTS `product_ingredients` (
  `product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantity` int NOT NULL,
  `is_optional` tinyint(1) DEFAULT '0',
  `is_charged_extra` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`product_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`),
  CONSTRAINT `product_ingredients_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_ingredients_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.product_ingredients: ~0 rows (aproximadamente)
DELETE FROM `product_ingredients`;

-- Volcando estructura para tabla AirRestaurant.product_ingredients_defaults
CREATE TABLE IF NOT EXISTS `product_ingredients_defaults` (
  `order_product_id` int NOT NULL,
  `ingredient_id` int NOT NULL,
  `quantity` int NOT NULL,
  `extra_cost` decimal(10,2) NOT NULL,
  PRIMARY KEY (`order_product_id`,`ingredient_id`),
  KEY `ingredient_id` (`ingredient_id`),
  CONSTRAINT `product_ingredients_defaults_ibfk_1` FOREIGN KEY (`order_product_id`) REFERENCES `order_product` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_ingredients_defaults_ibfk_2` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.product_ingredients_defaults: ~0 rows (aproximadamente)
DELETE FROM `product_ingredients_defaults`;

-- Volcando estructura para tabla AirRestaurant.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `surnames` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `img_profile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla AirRestaurant.users: ~5 rows (aproximadamente)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `name`, `surnames`, `email`, `password_hash`, `role`, `img_profile`, `created_at`) VALUES
	(2, 'Lolozaca', 'Dolores', 'Zarate Castillo', 'lolozaca@gmail.com', '$2y$10$1jtbyfV2oLeQKcDKzxjPFeb6CGbhckT6y0orMpef1zTzgyW8bSha2', 'user', NULL, '2024-12-10 19:51:59'),
	(5, 'alex', 'Alex', 'Cobas', 'alesazorro@gmail.com', '$2y$10$8XRMrAatLnfyxpNK47x8eujw54Qky6u7HN4WtUt0ury5GttSkQ4DG', 'user', NULL, '2025-01-02 10:44:15'),
	(7, 'admin', 'admin', 'admin', 'admin@gmail.com', '$2y$10$.1j3zVe5.aztQ157DZ4Lw.Dx1UTKvjdW1z2IwUfCbN0zygoclRd1q', 'admin', NULL, '2025-01-05 08:42:24');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
