-- First, clear existing products
TRUNCATE TABLE product;

-- Insert a diverse range of smartphone products
INSERT INTO `product` (`item_brand`, `item_name`, `item_price`, `item_image`, `item_register`) VALUES
('Samsung', 'Samsung Galaxy S23 Ultra', 1199.99, './assets/products/samsung-s23-ultra.png', NOW()),
('Samsung', 'Samsung Galaxy Z Fold 4', 1799.99, './assets/products/samsung-fold.png', NOW()),
('Samsung', 'Samsung Galaxy A53', 449.99, './assets/products/samsung-a53.png', NOW()),
('Apple', 'iPhone 14 Pro Max', 1099.99, './assets/products/iphone-14-pro.png', NOW()),
('Apple', 'iPhone 14', 799.99, './assets/products/iphone-14.png', NOW()),
('Apple', 'iPhone 13 Mini', 599.99, './assets/products/iphone-13-mini.png', NOW()),
('Google', 'Pixel 7 Pro', 899.99, './assets/products/pixel-7-pro.png', NOW()),
('Google', 'Pixel 7a', 499.99, './assets/products/pixel-7a.png', NOW()),
('OnePlus', 'OnePlus 11', 699.99, './assets/products/oneplus-11.png', NOW()),
('OnePlus', 'OnePlus Nord N20', 299.99, './assets/products/oneplus-nord.png', NOW()),
('Xiaomi', 'Xiaomi 13 Pro', 899.99, './assets/products/xiaomi-13-pro.png', NOW()),
('Xiaomi', 'Redmi Note 12', 299.99, './assets/products/redmi-note-12.png', NOW()),
('Nothing', 'Nothing Phone (1)', 449.99, './assets/products/nothing-phone.png', NOW()),
('ASUS', 'ROG Phone 7', 999.99, './assets/products/rog-phone.png', NOW()),
('Motorola', 'Moto Edge 40 Pro', 899.99, './assets/products/moto-edge.png', NOW()); 