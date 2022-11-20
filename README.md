<h1 align="center"> Laravel e-commerce </h1> <br>

## Introduction

A complete online store developed by Laravel 5.4
<p align="center">
  
![1234](https://user-images.githubusercontent.com/20874565/202761828-5ffa0afb-8066-48ba-b287-9c361a0d1e11.png)
  
</p>

## Features

Some of the facilities and features of the system are as follows:

- Two responsive layout templates, one developed with Blade another with [VueJS(SPA)](https://github.com/mohaphez/vuejs-ecommerce)
- Shopping Cart, Wishlist, Product Reviews
- Product attributes: cost price, promotion price, stock, size
- Blog: category, content, web page
- Coupons & Discounts
- Upload manager
- Newsletter management
- Notifications: Ticket , Comment, SMS
- Related Products, Recommendations for you in our categories
- A Product search form and filter
- Payment integration(IRANIAN GATEWAY: zarinpal,melat,pasargard,...)
- Admin roles, permission
- Product manager
- Wdiget manager: Baner,Slides,Pages, Custom widget , Brands
- Order management
- Category management
- Menu management
- User Management
- System setting Management
- Coupon Management
- Line Chart
- Blog & Category manager
- Have API for mobile application
- Have API for SPA application
- Many more....

## How to start

**Manually**

Its requirements:

- php <= 72
- mysql <= 5.7

1. Clone the project

```
git clone https://github.com/mohaphez/laravel-ecommerce.git
```

2. In your terminal enter `composer install`

3. Rename or copy .env.example file to .env

4. `php artisan key:generate`

5. Set your database credentials in your .env file

6. Set your gateway credentials in config/gateway.php file

7. Set your sms credentials in config/smsir.php if you want to use sms.ir

8. Import db file(docker-compose/mysql/init_db.sql) into your database (mysql,sql)

9. Fill sms-gateway-Golang/sms-service/config.js parameters for which provider you want to use.

10. Edit .env file :- remove APP_URL

11. php artisan serve or use virtual host

12. Visit localhost:8000 in your browser

13. login with `username: admin@example.com` and `password: password`

---

**Docker solution**

1. Clone the project

```
git clone https://github.com/mohaphez/laravel-ecommerce.git
```
2. Set your gateway credentials in config/gateway.php file

3. Set your sms credentials in config/smsir.php if you want to use sms.ir

4. docker-compose up -d

5. docker-compose exec app composer install

6. docker-compose exec app php artisan key:generate

7. Visit localhost:8000 in your browser

8. login with `username: admin@example.com` and `password: password`

Thank You so much for your time !!!

### :exclamation: Security

If you discover any security-related issues, please email mohaphez@gmail.com instead of using the issue tracker.
