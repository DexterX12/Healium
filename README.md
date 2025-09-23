# Healium - Laravel Project

## Description
**Healium** is a web application that functions as an online pharmacy.  
The system allows users to browse a catalog of drugs, add them to a shopping cart, purchase orders, and manage purchases using different payment methods (cash or card).

---

## Prerequisites
Before running the project, make sure you have installed:
- [PHP 8.2](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [MySQL or MariaDB](https://www.mysql.com/)
- [Node.js and NPM](https://nodejs.org/)
- [Laravel 12](https://laravel.com/)

---

## Installation & Setup

Clone the repository and install dependencies:

```bash
git clone https://github.com/DexterX12/Healium.git
cd healium
composer install
npm install && npm run dev
```

### Set up your enviroment file

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=healium
DB_USERNAME=root
DB_PASSWORD=
```
### Generate the application key
```bash
php artisan key:generate
```
### Run migrations and sedd the database
```bash
php artisan migrate --seed
```
### Make sure your Apache server and MySQL (via XAMPP or similar) are running, then start the Laravel server
```bash
php artisan serve
```
Access the application at: http://127.0.0.1:8000

### User Workflow

- Product browsing → View available medicines without registering.

- **User management** → Register and log in (required for making purchases).

- **Shopping cart** → Add or delet products, specify quantity, and proceed to checkout.

- **Payment options** → Pay using cash or credit card.

- **Order history** → Review past purchases via the Orders tab.

- **New arrivals** → Recently added products are displayed on the homepage.

- **Product comments** → View and leave comments on items.

### Admin Workflow

Access the admin panel at: http://127.0.0.1:8000/admin/index

- **Drug management** → Create and manage new drug entries to be published on the site.

- **Data analytics**→ Access tables with insights on best-selling products and registered users.

- **Supplier management** → Add, edit, or remove suppliers associated with products.