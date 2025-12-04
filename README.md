# 💰 GrowCash - Personal Finance Management System

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/Vite-7.0-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

<p align="center">
  <strong>GrowCash</strong> adalah aplikasi manajemen keuangan pribadi yang membantu Anda mengelola transaksi, budgeting, dan mencapai tujuan finansial dengan mudah dan efisien.
</p>

---

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Konfigurasi](#-konfigurasi)
- [Menjalankan Aplikasi](#-menjalankan-aplikasi)
- [Fitur Detail](#-fitur-detail)
- [Struktur Database](#-struktur-database)
- [Screenshots](#-screenshots)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### 🔐 Autentikasi & Keamanan
- **Registrasi & Login** dengan validasi email
- **Verifikasi OTP** via email untuk keamanan tambahan
- **Password Encryption** menggunakan bcrypt
- **Session Management** yang aman

### 💳 Manajemen Transaksi
- **Pencatatan Transaksi** (Pemasukan & Pengeluaran)
- **Kategorisasi Otomatis** menggunakan AI
- **Filter & Pencarian** transaksi berdasarkan tanggal, kategori, dan tipe
- **Laporan Keuangan** dengan visualisasi data

### 📊 Budgeting & Perencanaan
- **Budget Planning** bulanan dan tahunan
- **Tracking Pengeluaran** real-time
- **Notifikasi** saat budget mendekati limit (80% & 100%)
- **Analisis Pengeluaran** per kategori

### 🎯 Tujuan Keuangan
- **Finance Goals** dengan target dan deadline
- **Progress Tracking** otomatis
- **Rekomendasi Tabungan** berdasarkan pola pengeluaran
- **Status Management** (Active, Completed, Cancelled)

### 🔔 Sistem Notifikasi
- **Real-time Notifications** untuk aktivitas penting
- **Budget Alerts** saat mendekati atau melebihi limit
- **Goal Reminders** untuk tujuan finansial
- **Mark as Read** functionality

### 📱 User Experience
- **Responsive Design** - Mobile, Tablet, Desktop friendly
- **Modern UI/UX** dengan Tailwind CSS 4.0
- **Dark Mode Support** (optional)
- **Onboarding Flow** untuk pengguna baru
- **Dashboard Interaktif** dengan statistik real-time

### 🤖 AI & Automation
- **AI Categorization** untuk transaksi otomatis
- **Financial Literacy Tips** berdasarkan pola pengeluaran
- **Smart Recommendations** untuk budgeting

---

## 🛠 Teknologi

### Backend
- **Laravel 12.0** - PHP Framework
- **PHP 8.2** - Programming Language
- **MySQL/SQLite** - Database
- **Laravel Tinker** - REPL untuk debugging

### Frontend
- **Blade Templates** - Templating Engine
- **Tailwind CSS 4.0** - Utility-first CSS Framework
- **Vite 7.0** - Build Tool & Dev Server
- **Axios** - HTTP Client

### Development Tools
- **Laravel Pint** - Code Style Fixer
- **Laravel Sail** - Docker Development Environment
- **PHPUnit** - Testing Framework
- **Faker** - Test Data Generator

---

## 📦 Persyaratan Sistem

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **NPM** >= 9.0
- **MySQL** >= 8.0 atau **SQLite**
- **XAMPP/WAMP/MAMP** (untuk development lokal)

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/growcash.git
cd growcash
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file .env.example ke .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=growcash
DB_USERNAME=root
DB_PASSWORD=
```

**Atau gunakan SQLite:**

```env
DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite
```

### 5. Jalankan Migration

```bash
# Buat database tables
php artisan migrate

# (Optional) Seed data dummy
php artisan db:seed
```

---

## ⚙️ Konfigurasi

### Email Configuration (untuk OTP)

Edit file `.env` untuk konfigurasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

📖 **Panduan lengkap:** Lihat file `EMAIL_SETUP.md`

### Vite Configuration

Konfigurasi Vite sudah tersedia di `vite.config.js`. Untuk detail lebih lanjut, lihat `SETUP_VITE.md`.

---

## 🏃 Menjalankan Aplikasi

### Development Mode

#### Opsi 1: Manual (Recommended untuk XAMPP)

```bash
# Terminal 1 - Start Laravel development server
php artisan serve

# Terminal 2 - Start Vite dev server
npm run dev
```

Aplikasi akan berjalan di:
- **Laravel:** http://localhost:8000
- **Vite:** http://localhost:5173

#### Opsi 2: Menggunakan Composer Script

```bash
composer run dev
```

Script ini akan menjalankan:
- PHP Artisan Serve
- Queue Listener
- Laravel Pail (Logs)
- Vite Dev Server

### Production Build

```bash
# Build assets untuk production
npm run build

# Optimize Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🎨 Fitur Detail

### 1. Dashboard
- **Total Balance** - Saldo keseluruhan
- **Monthly Income/Expense** - Pemasukan & pengeluaran bulan ini
- **Budget Overview** - Status budget aktif
- **Recent Transactions** - Transaksi terbaru
- **Finance Goals Progress** - Progress tujuan keuangan
- **Financial Literacy Tips** - Tips keuangan personal

### 2. Transaksi Management
- **Create Transaction** - Tambah pemasukan/pengeluaran
- **Auto Categorization** - AI menentukan kategori otomatis
- **Edit/Delete** - Kelola transaksi existing
- **Filter by Date Range** - Filter berdasarkan periode
- **Export Report** - Export laporan ke PDF/Excel

### 3. Budgeting System
- **Set Monthly/Yearly Budget** - Tentukan budget per kategori
- **Real-time Tracking** - Monitor pengeluaran vs budget
- **Alert System** - Notifikasi saat mendekati limit
- **Budget Analysis** - Analisis pola pengeluaran

### 4. Finance Goals
- **Set Financial Goals** - Target tabungan dengan deadline
- **Auto Calculate** - Hitung kebutuhan tabungan per bulan
- **Progress Tracking** - Monitor progress secara visual
- **Goal Recommendations** - Saran berdasarkan income

### 5. Profile Management
- **Update Profile** - Edit informasi personal
- **Change Password** - Ubah password dengan validasi
- **View Statistics** - Statistik penggunaan aplikasi

---

## 🗄 Struktur Database

### Users
- `id`, `name`, `email`, `password`
- `tanggal_lahir`, `nomor_telepon`
- `is_onboarded`, `email_verified_at`

### Transaksis
- `id`, `user_id`, `kategori`, `jumlah`
- `tipe` (pemasukan/pengeluaran)
- `tanggal`, `deskripsi`

### Budgets
- `id`, `user_id`, `kategori`, `jumlah`
- `periode` (bulanan/tahunan)
- `tanggal_mulai`, `tanggal_selesai`

### Finance Goals
- `id`, `user_id`, `nama_tujuan`, `target_jumlah`
- `jumlah_terkumpul`, `tenggat_waktu`
- `status` (active/completed/cancelled)
- `prioritas`, `catatan`

### Notifications
- `id`, `user_id`, `type`, `title`, `message`
- `is_read`, `read_at`

### OTP Codes
- `id`, `email`, `otp`, `expires_at`

---

## 📸 Screenshots

> **Note:** Tambahkan screenshots aplikasi Anda di sini

```markdown
### Dashboard
![Dashboard](screenshots/dashboard.png)

### Transactions
![Transactions](screenshots/transactions.png)

### Budgeting
![Budgeting](screenshots/budgeting.png)

### Finance Goals
![Finance Goals](screenshots/finance-goals.png)
```

---

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter=TransactionTest

# Run with coverage
php artisan test --coverage
```

---

## 📝 API Documentation

GrowCash menggunakan web routes untuk semua endpoint. Berikut adalah route utama:

### Authentication
- `GET /login` - Show login form
- `POST /login` - Process login
- `GET /register` - Show registration form
- `POST /register` - Process registration
- `GET /verify-otp` - Show OTP verification
- `POST /verify-otp` - Verify OTP
- `POST /logout` - Logout user

### Dashboard
- `GET /dashboard` - Main dashboard

### Transactions
- `GET /transaksi` - List all transactions
- `POST /transaksi` - Create transaction
- `PUT /transaksi/{id}` - Update transaction
- `DELETE /transaksi/{id}` - Delete transaction
- `GET /transaksi/laporan` - Transaction report

### Budgeting
- `GET /budgeting` - List budgets
- `POST /budgeting` - Create budget
- `PUT /budgeting/{id}` - Update budget
- `DELETE /budgeting/{id}` - Delete budget

### Finance Goals
- `GET /finance-goals` - List goals
- `POST /finance-goals` - Create goal
- `PUT /finance-goals/{id}` - Update goal
- `DELETE /finance-goals/{id}` - Delete goal

---

## 🤝 Kontribusi

Kontribusi selalu diterima! Berikut cara berkontribusi:

1. **Fork** repository ini
2. **Create** branch baru (`git checkout -b feature/AmazingFeature`)
3. **Commit** perubahan (`git commit -m 'Add some AmazingFeature'`)
4. **Push** ke branch (`git push origin feature/AmazingFeature`)
5. **Open** Pull Request

### Coding Standards
- Ikuti **PSR-12** untuk PHP code
- Gunakan **Laravel Pint** untuk formatting
- Tulis **tests** untuk fitur baru
- Update **documentation** jika diperlukan

---

## 🐛 Bug Reports & Feature Requests

Jika menemukan bug atau ingin request fitur baru:

1. Cek [Issues](https://github.com/username/growcash/issues) yang sudah ada
2. Jika belum ada, buat [New Issue](https://github.com/username/growcash/issues/new)
3. Berikan deskripsi yang jelas dan detail

---

## 📄 Lisensi

Project ini dilisensikan under **MIT License** - lihat file [LICENSE](LICENSE) untuk detail.

---

## 👨‍💻 Author

**Arya Kusum**
- GitHub: [@aryakusum](https://github.com/aryakusum)
- Email: your-email@example.com

---

## 🙏 Acknowledgments

- [Laravel](https://laravel.com) - The PHP Framework
- [Tailwind CSS](https://tailwindcss.com) - CSS Framework
- [Vite](https://vitejs.dev) - Build Tool
- Semua kontributor yang telah membantu project ini

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Vite Documentation](https://vitejs.dev/guide)
- [PHP Documentation](https://www.php.net/docs.php)

---

<p align="center">
  Made with ❤️ by <a href="https://github.com/aryakusum">Arya Kusum</a>
</p>

<p align="center">
  <sub>⭐ Star this repository if you find it helpful!</sub>
</p>
