# SmartStock Inventory Management System

A Laravel-based Inventory Management system featuring a dashboard with real-time analytics, category management, and product CRUD functionality.

## 🚀 Features
- **Role-Based Access:** Secure Admin and User roles.
- **Inventory Tracking:** Real-time stock levels and low-stock alerts.
- **Reporting:** Visual charts for inventory distribution.
- **Category Management:** Organizes products into searchable groups.

## 🛠️ Tech Stack
- **Framework:** Laravel 11
- **Database:** SQLite
- **Frontend:** Tailwind CSS / Blade Templates
- **Icons/Charts:** Heroicons & Chart.js

## 🔑 Login Credentials (For Grading)
- **Admin Email:** `admin@gmail.com`
- **Password:** `password123`

## ⚙️ Setup Instructions
1. **Clone the repo:** `git clone https://github.com/Asutilla/Laravel-FinalProject_Asutilla.git`
2. **Install Dependencies:** `composer install` and `npm install`
3. **Environment Setup:** Copy `.env.example` to `.env` and set `DB_CONNECTION=sqlite`.
4. **Database Setup:** - Ensure the file `database/database.sqlite` exists.
   - Run `php artisan migrate --seed` to initialize tables and the admin account.
5. **Start Server:** `php artisan serve`
