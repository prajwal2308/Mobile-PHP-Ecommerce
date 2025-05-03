# 📱 Mobile PHP E-commerce

A mobile-optimized e-commerce web application built using PHP, HTML, CSS, JavaScript, and MySQL. This project demonstrates a complete online shopping experience including user authentication, product listings, cart functionality, and a checkout process.

> ⚠️ **Note**: This project is in development and may contain incomplete features or inconsistencies.

---

## 🚀 Features

- User authentication (Login / Logout)
- Product listing and detail view
- Add to Cart and Cart management
- Checkout process
- Admin dashboard for managing products
- Responsive layout for mobile devices

---

## 🛠️ Technologies Used

- PHP
- MySQL
- HTML, CSS, JavaScript
- Bootstrap (for responsive UI)
- Docker (optional, for containerized setup)

---

## 📁 Project Structure

Mobile-PHP-Ecommerce/
├── assets/             # Images and media files
├── css/                # Stylesheets
├── js/                 # JavaScript functionality
├── database/           # SQL scripts for database setup
├── index.php           # Main entry point
├── functions.php       # Helper functions and DB connections
└── docker-compose.yml  # Docker configuration

---

## 🐳 Getting Started with Docker

### 1. Clone the repository

```bash
git clone https://github.com/prajwal2308/Mobile-PHP-Ecommerce.git
cd Mobile-PHP-Ecommerce

docker-compose up --build
docker ps
```

1. Create the database:
Import the SQL file found in /database into your MySQL server.

	2.	Configure DB connection:
Edit database credentials in functions.php or any configuration file used.

	3.	Run the app:
Visit http://localhost/Mobile-PHP-Ecommerce in your browser.

Default Credentials
	•	Username: user
	•	Password: pass


