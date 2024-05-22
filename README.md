Environment required:

1. Composer
2. PHP 8.3 >
3. NodeJs 12.x.x
4. Mysql
5. Git (optional)
   Build project:

6. git clone https://github.com/vietcoderx/laravel-shop
7. Composer install
8. Composer dump-autoload
9. npm install
10. npm run dev
11. php artisan serve
12. Open browser and connect to localhost:8000
    Run migration:

13. php artisan migrate --seed
    Re-run migration:

14. php artisan migrate:fresh --seed

1. User:
	Email: admin@gmail.com
	Password: admin  
2. Role:
name : admin,
displaname : Admin
--
name : guest,
displaname : Khách hàng
--
name : dev, 
displaname : Phát triển hệ thống
--
name : content, 
displaname : Chỉnh sửa nội dung
