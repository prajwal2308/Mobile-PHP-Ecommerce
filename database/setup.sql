-- Create product table
CREATE TABLE IF NOT EXISTS product (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_brand VARCHAR(200),
    item_name VARCHAR(255),
    item_price DECIMAL(10,2),
    item_image VARCHAR(255),
    item_register DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Create cart table
CREATE TABLE IF NOT EXISTS cart (
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    item_id INT
);

-- Insert sample products
INSERT INTO product (item_brand, item_name, item_price, item_image) VALUES
('Samsung', 'Samsung Galaxy S21', 999.99, './assets/products/1.png'),
('Apple', 'iPhone 13', 1099.99, './assets/products/2.png'),
('Redmi', 'Redmi Note 10', 299.99, './assets/products/3.png'); 