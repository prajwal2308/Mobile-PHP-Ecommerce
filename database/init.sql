-- Create database if not exists
CREATE DATABASE IF NOT EXISTS mydb;
USE mydb;

-- Create tables
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `register_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `product` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_brand` varchar(200) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_price` double(10,2) NOT NULL,
  `item_image` varchar(255) NOT NULL,
  `item_register` datetime DEFAULT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `wishlist` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert products
INSERT INTO `product` (`item_brand`, `item_name`, `item_price`, `item_image`, `item_register`) VALUES
('Samsung', 'Samsung Galaxy Z flip ', 1199.99, './assets/products/sfold.png', NOW()),
('Samsung', 'Samsung Galaxy Z Fold 3', 1799.99, './assets/products/sfold3.png', NOW()),
('Samsung', 'Samsung Galaxy A53', 449.99, './assets/products/a22.png', NOW()),
('Apple', 'iPhone 14 Pro Max', 1099.99, './assets/products/iphone14pro.jpg', NOW()),
('Apple', 'iPhone 13 Pro', 799.99, './assets/products/iphone13pro.jpg', NOW()),
('Xiaomi', 'OnePlus 13', 899.99, './assets/products/oneplus13.webp', NOW()),
('Xiaomi', 'Oneplus 12', 299.99, './assets/products/oneplus12.jpg', NOW()),
('Motorola', 'Moto Edge 40 Pro', 899.99, './assets/products/15.png', NOW());

-- Insert default users
INSERT INTO `users` (`email`, `password`, `first_name`, `last_name`) VALUES
('a@b.com', '', 'test', 'test');