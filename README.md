# Laravel Shop

## Features

* **Product Management:** Add, edit, and delete products, including images, descriptions, and prices.
* **Shopping Cart:** Allow customers to add products to their cart, adjust quantities, and proceed to checkout.
* **Checkout Process:** Notification via email to confirm order
* **Order Management:** Track and manage customer orders, including status updates and order history.
* **User Authentication:** Secure user login system.
* **Role-Based Authorization:** Assign roles (admin, customer) with different permissions to control access to features.
* **Admin Dashboard:** A comprehensive dashboard for administrators to manage products, orders, users, and website settings.

## Technical Stack

* **Backend:** Laravel 9
* **Frontend:** Blade templating, Bootstrap 5 (with optional integration for Vue.js or React)
* **Database:** MySQL
* **Package Management:** Composer (PHP), NPM (JavaScript)

## Installation

**Prerequisites:**

* **PHP >= 8.3:** Ensure you have a compatible PHP version installed.
* **Composer:**  A dependency manager for PHP. Install it from [https://getcomposer.org/](https://getcomposer.org/)
* **Node.js and NPM:** Required for frontend asset management. Install them from [https://nodejs.org/](https://nodejs.org/)
* **MySQL:** A database server. Install and create a new database for the project.

**Steps:**
1. **Clone the Repository:**
    git clone https://github.com/vietcoderx/laravel-shop
2. **Install Dependencies:**
    composer install
    composer dump-autoload
    npm install
3. **Install Dependencies:**
    Copy the .env.example file to .env.
    Update the .env file with your database credentials and other necessary configurations.
    composer dump-autoload
4. **Generate Application Key:**
    php artisan key:generate
5. **Run Migrations and Seeders:**
    php artisan migrate
    php artisan migrate --seed
6. **Start the Server:**
php artisan serve

**Accounts:**
1. User:
	Email: admin@gmail.com
	Password: admin  
2. Role:
```sh
name : admin,
displaname : Admin
```
--
```sh
name : guest,
displaname : Khách hàng
```
--
```sh
name : dev, 
displaname : Phát triển hệ thống
```
--
```sh
name : content, 
displaname : Chỉnh sửa nội dung
```
