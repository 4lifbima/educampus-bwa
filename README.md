<h1 align="center">🎓 EduCampus</h1>

<p align="center">
  <strong>Platform Manajemen Pendidikan Modern untuk Era Digital</strong>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Laravel-12.0-FF2D20?style=flat&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/TailwindCSS-4.0-38B2AC?style=flat&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Status-Active%20Development-brightgreen?style=for-the-badge" alt="Status">
</p>

---

## 📖 Deskripsi Proyek

**EduCampus** adalah platform manajemen pendidikan modern yang dirancang khusus untuk institusi pendidikan tinggi. Dibangun dengan teknologi terkini, EduCampus menghadirkan solusi terintegrasi untuk mengelola aktivitas akademik mahasiswa, dosen, dan administrator dalam satu ekosistem yang efisien dan user-friendly.

Platform ini memungkinkan transformasi digital kampus dengan fitur-fitur seperti manajemen kelas, sistem enrollment, tracking kehadiran, dan dashboard analytics yang komprehensif.

---

## ✨ Fitur Utama

<table>
  <tr>
    <td width="50%">
      <h3>👥 Manajemen Mahasiswa</h3>
      <ul>
        <li>Kelola data mahasiswa secara terpusat</li>
        <li>Pendaftaran kelas dengan approval workflow</li>
        <li>Monitoring progress akademik real-time</li>
        <li>Tracking kehadiran otomatis</li>
      </ul>
    </td>
    <td width="50%">
      <h3>👨‍🏫 Portal Dosen</h3>
      <ul>
        <li>Dashboard kelas yang diampu</li>
        <li>Approve/reject enrollment mahasiswa</li>
        <li>Manajemen kehadiran kelas</li>
        <li>Input nilai dan penilaian</li>
      </ul>
    </td>
  </tr>
  <tr>
    <td width="50%">
      <h3>📅 Jadwal & Timetable</h3>
      <ul>
        <li>Tampilan kalender mingguan intuitif</li>
        <li>Sinkronisasi jadwal real-time</li>
        <li>Notifikasi perubahan jadwal</li>
        <li>Export jadwal ke berbagai format</li>
      </ul>
    </td>
    <td width="50%">
      <h3>📊 Dashboard Analytics</h3>
      <ul>
        <li>Statistik kampus komprehensif</li>
        <li>Visualisasi data interaktif</li>
        <li>Laporan kehadiran dan nilai</li>
        <li>Insights untuk pengambilan keputusan</li>
      </ul>
    </td>
  </tr>
</table>

---

## 🛡️ Role-Based Access Control

EduCampus menerapkan sistem akses berbasis peran yang ketat untuk memastikan keamanan dan privasi data:

| Role | Akses |
|------|-------|
| **🔐 Admin** | Kelola seluruh data kampus, CRUD mahasiswa & dosen, manajemen kelas, dashboard statistics |
| **👨‍🏫 Dosen** | Lihat kelas yang diampu, approve enrollment, kelola kehadiran, input nilai |
| **👨‍🎓 Mahasiswa** | Daftar ke kelas, lihat jadwal mingguan, tracking kehadiran, lihat nilai |

---

## 🛠️ Tech Stack

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Laravel-12.0-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/Laravel_Breeze-2.3-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel Breeze">
  <img src="https://img.shields.io/badge/TailwindCSS-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-Latest-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
</p>

### Backend
- **PHP 8.2+** - Modern PHP dengan fitur terbaru
- **Laravel 12** - Framework PHP paling populer
- **Laravel Breeze** - Authentication scaffolding yang ringan
- **Eloquent ORM** - Object-Relational Mapping yang powerful

### Frontend
- **Blade Templates** - Laravel's templating engine
- **Tailwind CSS 4** - Utility-first CSS framework
- **Lucide Icons** - Beautiful & consistent icon set
- **Vite** - Next generation frontend tooling

### Database & Storage
- **MySQL/SQLite** - Relational database management
- **Laravel Migrations** - Version control untuk database

---

## 📁 Struktur Proyek

```
educampus-bwa/
├── 📂 app/
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/     # Logic controller aplikasi
│   │   ├── 📂 Middleware/      # Custom middleware (RoleMiddleware)
│   │   └── 📂 Requests/        # Form request validation
│   ├── 📂 Models/              # Eloquent models
│   │   ├── User.php
│   │   ├── Student.php
│   │   ├── Lecturer.php
│   │   ├── ClassRoom.php
│   │   ├── Faculty.php
│   │   ├── Major.php
│   │   └── Attendance.php
│   └── 📂 View/Components/     # Blade components
├── 📂 database/
│   ├── 📂 migrations/          # Database migrations
│   ├── 📂 factories/           # Model factories
│   └── 📂 seeders/             # Database seeders
├── 📂 resources/
│   ├── 📂 views/               # Blade templates
│   ├── 📂 css/                 # Stylesheets
│   └── 📂 js/                  # JavaScript files
├── 📂 routes/
│   └── web.php                 # Web routes
├── 📂 public/                  # Public assets
├── 📂 config/                  # Configuration files
└── 📂 tests/                   # Application tests
```

---

## ⚡ Instalasi & Setup

### Prasyarat

Pastikan sistem Anda memiliki:
- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.0
- **NPM** >= 9.0
- **MySQL** atau **SQLite**

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/4lifbima/educampus-bwa.git
   cd educampus-bwa
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database**
   
   Edit file `.env` dan sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=educampus
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Jalankan migrasi**
   ```bash
   php artisan migrate
   ```

6. **Seed database (opsional)**
   ```bash
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

### Menjalankan Aplikasi

**Development mode (recommended):**
```bash
composer dev
```
> Perintah ini akan menjalankan server, queue, logs, dan vite secara bersamaan.

**Atau secara manual:**
```bash
# Terminal 1 - Laravel server
php artisan serve

# Terminal 2 - Vite development
npm run dev
```

Akses aplikasi di: **http://localhost:8000**

## 👤 Akun Kredensial (Demo)

| Nama | Email | Password |
|--------|------------|------------|
| `admin` | admin@gmail.com | password |
| `lecturer` | lecturer@gmail.com | password |
| `student` | student@gmail.com | password |

---

## 📜 Scripts Tersedia

| Script | Keterangan |
|--------|------------|
| `composer setup` | Setup awal aplikasi (install deps, migrate, build) |
| `composer dev` | Jalankan development server dengan hot reload |
| `composer test` | Jalankan test suite |
| `npm run dev` | Kompilasi assets dengan hot reload |
| `npm run build` | Kompilasi assets untuk production |

---

## 🗄️ Database Schema

### Entity Relationship

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   Faculty   │────<│    Major    │────<│   Student   │
└─────────────┘     └─────────────┘     └──────┬──────┘
                                                │
                                                │ N:M
                                                │
┌─────────────┐     ┌─────────────┐     ┌──────┴──────┐
│   Lecturer  │────<│  ClassRoom  │>────│ Attendance  │
└─────────────┘     └─────────────┘     └─────────────┘
```

### Tabel Utama

| Tabel | Deskripsi |
|-------|-----------|
| `users` | Data user dengan role (admin/dosen/mahasiswa) |
| `students` | Data spesifik mahasiswa |
| `lecturers` | Data spesifik dosen |
| `faculties` | Data fakultas |
| `majors` | Data program studi |
| `class_rooms` | Data kelas/mata kuliah |
| `class_student` | Pivot table enrollment |
| `attendances` | Data kehadiran |

---

## 🧪 Testing

Jalankan test suite dengan perintah:

```bash
# Jalankan semua test
php artisan test

# Atau gunakan composer script
composer test

# Jalankan dengan coverage
php artisan test --coverage
```

---

## 🤝 Kontribusi

Kontribusi sangat dihargai! Berikut langkah-langkahnya:

1. **Fork** repository ini
2. **Clone** fork Anda ke lokal
3. Buat **branch** fitur baru (`git checkout -b feature/AmazingFeature`)
4. **Commit** perubahan Anda (`git commit -m 'Add some AmazingFeature'`)
5. **Push** ke branch (`git push origin feature/AmazingFeature`)
6. Buat **Pull Request**

### Coding Standards

- Ikuti [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standard
- Gunakan Laravel Pint untuk formatting: `./vendor/bin/pint`
- Tulis test untuk fitur baru
- Dokumentasikan perubahan di CHANGELOG

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

```
MIT License

Copyright (c) 2024 EduCampus

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
```

---

## 🙏 Acknowledgements

- [Laravel](https://laravel.com) - The PHP Framework for Web Artisans
- [Laravel Breeze](https://laravel.com/docs/breeze) - Authentication Starter Kit
- [Tailwind CSS](https://tailwindcss.com) - A utility-first CSS framework
- [Lucide Icons](https://lucide.dev) - Beautiful & consistent icons
- [Vite](https://vitejs.dev) - Next Generation Frontend Tooling

---

<h2 align="center">👨‍💻 Developer</h2>

<p align="center">
  <a href="https://github.com/4lifbima">
    <img src="https://avatars.githubusercontent.com/u/152723454?v=4" width="150" height="150" style="border-radius: 50%;" alt="Developer Avatar">
  </a>
</p>

<h3 align="center">
  <a href="https://github.com/4lifbima">@4lifbima</a>
</h3>

<p align="center">
  <a href="https://github.com/4lifbima">
    <img src="https://img.shields.io/badge/GitHub-4lifbima-181717?style=for-the-badge&logo=github&logoColor=white" alt="GitHub">
  </a>
</p>

---

<p align="center">
  <strong>⭐ Jika proyek ini bermanfaat, berikan bintang di repository ini! ⭐</strong>
</p>

<p align="center">
  Made with ❤️ by <a href="https://github.com/4lifbima">4lifbima</a>
</p>
