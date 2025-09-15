# 🛒 Project CRUD - Sistem E-Commerce Laravel

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-11-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.4-38B2AC.svg)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1.svg)
![License](https://img.shields.io/badge/License-MIT-green.svg)

**Sistem Manajemen E-Commerce Modern dibuat dengan Laravel**

[📖 Dokumentasi](#-dokumentasi) • [🚀 Instalasi](#-instalasi) • [🎯 Fitur](#-fitur) • [📸 Tangkapan Layar](#-tangkapan-layar)

</div>

---

## 📋 Daftar Isi

- [✨ Tentang](#-tentang)
- [🎯 Fitur](#-fitur)
- [🛠️ Teknologi](#%EF%B8%8F-teknologi)
- [📦 Instalasi](#-instalasi)
- [⚙️ Konfigurasi](#%EF%B8%8F-konfigurasi)
- [🚀 Penggunaan](#-penggunaan)
- [📊 Skema Database](#-skema-database)
- [🔐 Otentikasi](#-otentikasi)
- [📸 Tangkapan Layar](#-tangkapan-layar)
- [🤝 Kontribusi](#-kontribusi)
- [📝 Lisensi](#-lisensi)

---

## ✨ Tentang

**Project CRUD** adalah sistem manajemen E-Commerce yang komprehensif dibuat dengan Laravel 11, dirancang untuk menangani inventori produk, pemrosesan pesanan, manajemen pembayaran, dan administrasi pengguna. Aplikasi ini menyediakan solusi lengkap untuk mengelola toko online dengan UI modern dan fungsionalitas backend yang kuat.

### 🎯 Sorotan Utama

- **Arsitektur Modern**: Dibuat dengan Laravel 11 dan PHP 8.1+
- **Desain Responsif**: UI yang indah dengan Tailwind CSS
- **Akses Berbasis Peran**: Peran Admin dan User dengan izin berbeda
- **Fitur Real-time**: Keranjang belanja dan manajemen pesanan dinamis
- **Kemampuan Ekspor**: Fungsi ekspor Excel dan PDF
- **Otentikasi Aman**: Laravel Sanctum untuk otentikasi API

---

## 🎯 Fitur

### 👨‍💼 Fitur Admin
- ✅ **Dashboard Analitik** - Ringkasan penjualan, produk, dan pengguna
- ✅ **Manajemen Produk** - Operasi CRUD untuk produk
- ✅ **Manajemen Pesanan** - Melihat dan mengelola semua pesanan
- ✅ **Manajemen Pengguna** - Mengelola pengguna dan peran
- ✅ **Manajemen Karyawan** - Administrasi staf
- ✅ **Pelacakan Pembayaran** - Memantau status pembayaran
- ✅ **Ekspor Data** - Ekspor Excel untuk pesanan dan laporan
- ✅ **Generasi PDF** - Membuat faktur dan laporan

### 👤 Fitur Pengguna
- ✅ **Penjelajahan Produk** - Melihat semua produk yang tersedia
- ✅ **Keranjang Belanja** - Menambah/menghapus item dengan kontrol kuantitas
- ✅ **Pemesanan** - Proses checkout lengkap
- ✅ **Riwayat Pesanan** - Melacak pesanan sebelumnya
- ✅ **Manajemen Profil** - Memperbarui informasi pribadi
- ✅ **Integrasi Pembayaran** - Pemrosesan pembayaran yang aman

### 🔧 Fitur Teknis
- ✅ **API RESTful** - Endpoint API yang terstruktur dengan baik
- ✅ **Migrasi Database** - Skema database dengan kontrol versi
- ✅ **Seeder** - Data sampel untuk pengembangan
- ✅ **Validasi Form** - Validasi input yang komprehensif
- ✅ **Penanganan Error** - Respons error yang tepat
- ✅ **Keamanan** - Perlindungan CSRF, pencegahan SQL injection

---

## 🛠️ Teknologi

### Backend
- **Laravel 11** - Framework PHP
- **PHP 8.1+** - Scripting sisi server
- **MySQL 8.0** - Manajemen database

### Frontend
- **Tailwind CSS** - Framework CSS utility-first
- **Blade Templates** - Engine templating Laravel
- **Vite** - Alat build cepat dan server dev
- **Alpine.js** - Framework JavaScript ringan

### Library & Tools
- **Laravel Sanctum** - Otentikasi API
- **DomPDF** - Generasi PDF
- **Maatwebsite Excel** - Penanganan file Excel
- **Intervention Image** - Pemrosesan gambar
- **Carbon** - Manipulasi tanggal/waktu

---

## � Instalasi

### Prasyarat
- PHP 8.1 atau lebih tinggi
- Composer
- Node.js & NPM
- MySQL 8.0
- Git

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/M-Bayu-Aji/Project-CRUD.git
   cd Project-CRUD
   ```

2. **Install dependensi PHP**
   ```bash
   composer install
   ```

3. **Install dependensi Node.js**
   ```bash
   npm install
   ```

4. **Konfigurasi Environment**
   ```bash
   cp .env.example .env
   ```

   Perbarui file `.env` dengan kredensial database Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_crud
   DB_USERNAME=username_anda
   DB_PASSWORD=password_anda
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Setup Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build Assets**
   ```bash
   npm run build
   # atau untuk development
   npm run dev
   ```

8. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```

   Kunjungi `http://localhost:8000` di browser Anda.

---

## ⚙️ Konfigurasi

### Variabel Environment
```env
# Aplikasi
APP_NAME="Project CRUD"
APP_ENV=local
APP_KEY=base64:app_key_anda
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_crud
DB_USERNAME=root
DB_PASSWORD=

# Konfigurasi Email (opsional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email_anda@gmail.com
MAIL_PASSWORD=password_app_anda
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=email_anda@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Izin File
```bash
# Set izin yang tepat untuk Laravel
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 🚀 Penggunaan

### Akses Admin
- **URL**: `/admin/dashboard`
- **Akun Admin Default**:
  - Email: `admin@gmail.com`
  - Password: `admin123`

### Registrasi Pengguna
- Kunjungi `/register` untuk membuat akun pengguna baru
- Atau gunakan data seeder untuk testing

### Endpoint API
```bash
# Otentikasi
POST   /api/login
POST   /api/register
POST   /api/logout

# Produk
GET    /api/products
POST   /api/products
GET    /api/products/{id}
PUT    /api/products/{id}
DELETE /api/products/{id}

# Pesanan
GET    /api/orders
POST   /api/orders
GET    /api/orders/{id}
```

---

## 📊 Skema Database

### Tabel Utama
- **users** - Akun pengguna dan otentikasi
- **products** - Katalog produk
- **orders** - Pesanan pelanggan
- **payments** - Catatan pembayaran
- **karyawans** - Data karyawan
- **categories** - Kategori produk

### Relasi
```
User (1) ──── (N) Order
Order (1) ──── (N) Payment
Product (N) ──── (N) Order
User (1) ──── (N) Karyawan
```

---

## 🔐 Otentikasi

Aplikasi menggunakan **Laravel Sanctum** untuk otentikasi API dan otentikasi berbasis sesi tradisional untuk route web.

### Peran Pengguna
- **Admin**: Akses penuh ke semua fitur
- **User**: Terbatas pada belanja dan manajemen profil

### Reset Password
- Pengguna dapat meminta reset password via email
- Sistem reset password berbasis token yang aman

---

## 📸 Tangkapan Layar

### Dashboard Admin
![Dashboard Admin](https://via.placeholder.com/800x400/4F46E5/FFFFFF?text=Dashboard+Admin)

### Manajemen Produk
![Manajemen Produk](https://via.placeholder.com/800x400/10B981/FFFFFF?text=Manajemen+Produk)

### Keranjang Belanja
![Keranjang Belanja](https://via.placeholder.com/800x400/F59E0B/FFFFFF?text=Keranjang+Belanja)

### Riwayat Pesanan
![Riwayat Pesanan](https://via.placeholder.com/800x400/EF4444/FFFFFF?text=Riwayat+Pesanan)

---

## 🤝 Kontribusi

Kami menerima kontribusi! Ikuti langkah-langkah berikut:

1. Fork repository
2. Buat branch fitur (`git checkout -b feature/fitur-hebat`)
3. Commit perubahan Anda (`git commit -m 'Tambah fitur hebat'`)
4. Push ke branch (`git push origin feature/fitur-hebat`)
5. Buka Pull Request

### Panduan Pengembangan
- Ikuti standar coding PSR-12
- Tulis pesan commit yang bermakna
- Tambahkan test untuk fitur baru
- Perbarui dokumentasi jika diperlukan

---

## 📝 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail.

---

## 🙏 Ucapan Terima Kasih

- [Laravel](https://laravel.com/) - Framework PHP
- [Tailwind CSS](https://tailwindcss.com/) - CSS utility-first
- [Maatwebsite Excel](https://laravel-excel.com/) - Penanganan Excel
- [DomPDF](https://dompdf.github.io/) - Generasi PDF
- [Font Awesome](https://fontawesome.com/) - Ikon

---

<div align="center">

**Dibuat dengan ❤️ oleh Muhammad Bayu Aji**

⭐ Beri bintang repo ini jika Anda merasa terbantu!

[⬆️ Kembali ke Atas](#-project-crud---sistem-e-commerce-laravel)

</div>

## 📋 Table of Contents

- [✨ About](#-about)
- [🎯 Features](#-features)
- [🛠️ Tech Stack](#%EF%B8%8F-tech-stack)
- [📦 Installation](#-installation)
- [⚙️ Configuration](#%EF%B8%8F-configuration)
- [🚀 Usage](#-usage)
- [📊 Database Schema](#-database-schema)
- [🔐 Authentication](#-authentication)
- [📸 Screenshots](#-screenshots)
- [🤝 Contributing](#-contributing)
- [📝 License](#-license)

---

## ✨ About

**Project CRUD** is a comprehensive E-Commerce management system built with Laravel 11, designed to handle product inventory, order processing, payment management, and user administration. This application provides a complete solution for managing an online store with modern UI and robust backend functionality.

### 🎯 Key Highlights

- **Modern Architecture**: Built with Laravel 11 and PHP 8.1+
- **Responsive Design**: Beautiful UI with Tailwind CSS
- **Role-Based Access**: Admin and User roles with different permissions
- **Real-time Features**: Dynamic cart and order management
- **Export Capabilities**: Excel and PDF export functionality
- **Secure Authentication**: Laravel Sanctum for API authentication

---

## 🎯 Features

### 👨‍💼 Admin Features
- ✅ **Dashboard Analytics** - Overview of sales, products, and users
- ✅ **Product Management** - CRUD operations for products
- ✅ **Order Management** - View and manage all orders
- ✅ **User Management** - Manage users and roles
- ✅ **Employee Management** - Staff administration
- ✅ **Payment Tracking** - Monitor payment status
- ✅ **Data Export** - Excel export for orders and reports
- ✅ **PDF Generation** - Generate invoices and reports

### 👤 User Features
- ✅ **Product Browsing** - View all available products
- ✅ **Shopping Cart** - Add/remove items with quantity control
- ✅ **Order Placement** - Complete checkout process
- ✅ **Order History** - Track previous orders
- ✅ **Profile Management** - Update personal information
- ✅ **Payment Integration** - Secure payment processing

### 🔧 Technical Features
- ✅ **RESTful API** - Well-structured API endpoints
- ✅ **Database Migrations** - Version-controlled database schema
- ✅ **Seeders** - Sample data for development
- ✅ **Form Validation** - Comprehensive input validation
- ✅ **Error Handling** - Proper error responses
- ✅ **Security** - CSRF protection, SQL injection prevention

---

## 🛠️ Tech Stack

### Backend
- **Laravel 11** - PHP Framework
- **PHP 8.1+** - Server-side scripting
- **MySQL 8.0** - Database management

### Frontend
- **Tailwind CSS** - Utility-first CSS framework
- **Blade Templates** - Laravel templating engine
- **Vite** - Fast build tool and dev server
- **Alpine.js** - Lightweight JavaScript framework

### Libraries & Tools
- **Laravel Sanctum** - API authentication
- **DomPDF** - PDF generation
- **Maatwebsite Excel** - Excel file handling
- **Intervention Image** - Image processing
- **Carbon** - Date/time manipulation

---

## 📦 Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL 8.0
- Git

### Step-by-Step Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/M-Bayu-Aji/Project-CRUD.git
   cd Project-CRUD
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   ```

   Update `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=project_crud
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build Assets**
   ```bash
   npm run build
   # or for development
   npm run dev
   ```

8. **Start the Application**
   ```bash
   php artisan serve
   ```

   Visit `http://localhost:8000` in your browser.

---

## ⚙️ Configuration

### Environment Variables
```env
# Application
APP_NAME="Project CRUD"
APP_ENV=local
APP_KEY=base64:your_app_key
APP_DEBUG=true
APP_URL=http://localhost

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_crud
DB_USERNAME=root
DB_PASSWORD=

# Mail Configuration (optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

### File Permissions
```bash
# Set proper permissions for Laravel
sudo chown -R www-data:www-data storage/
sudo chown -R www-data:www-data bootstrap/cache/
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

---

## 🚀 Usage

### Admin Access
- **URL**: `/admin/dashboard`
- **Default Admin Account**:
  - Email: `admin@gmail.com`
  - Password: `admin123`

### User Registration
- Visit `/register` to create a new user account
- Or use seeder data for testing

### API Endpoints
```bash
# Authentication
POST   /api/login
POST   /api/register
POST   /api/logout

# Products
GET    /api/products
POST   /api/products
GET    /api/products/{id}
PUT    /api/products/{id}
DELETE /api/products/{id}

# Orders
GET    /api/orders
POST   /api/orders
GET    /api/orders/{id}
```

---

## 📊 Database Schema

### Core Tables
- **users** - User accounts and authentication
- **products** - Product catalog
- **orders** - Customer orders
- **payments** - Payment records
- **karyawans** - Employee data
- **categories** - Product categories

### Relationships
```
User (1) ──── (N) Order
Order (1) ──── (N) Payment
Product (N) ──── (N) Order
User (1) ──── (N) Karyawan
```

---

## 🔐 Authentication

The application uses **Laravel Sanctum** for API authentication and traditional session-based authentication for web routes.

### User Roles
- **Admin**: Full access to all features
- **User**: Limited to shopping and profile management

### Password Reset
- Users can request password reset via email
- Secure token-based password reset system

---

## 📸 Screenshots

### Admin Dashboard
![Admin Dashboard](https://via.placeholder.com/800x400/4F46E5/FFFFFF?text=Admin+Dashboard)

### Product Management
![Product Management](https://via.placeholder.com/800x400/10B981/FFFFFF?text=Product+Management)

### Shopping Cart
![Shopping Cart](https://via.placeholder.com/800x400/F59E0B/FFFFFF?text=Shopping+Cart)

### Order History
![Order History](https://via.placeholder.com/800x400/EF4444/FFFFFF?text=Order+History)

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Guidelines
- Follow PSR-12 coding standards
- Write meaningful commit messages
- Add tests for new features
- Update documentation as needed

---

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com/) - The PHP framework
- [Tailwind CSS](https://tailwindcss.com/) - Utility-first CSS
- [Maatwebsite Excel](https://laravel-excel.com/) - Excel handling
- [DomPDF](https://dompdf.github.io/) - PDF generation
- [Font Awesome](https://fontawesome.com/) - Icons

---

<div align="center">

**Made with ❤️ by Muhammad Bayu Aji**

⭐ Star this repo if you find it helpful!

[⬆️ Back to Top](#-project-crud---laravel-e-commerce-system)

</div>

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
