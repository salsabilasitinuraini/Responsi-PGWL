# 🌐 Jejak Temanggung – WebGIS Wisata Interaktif

Jejak Temanggung adalah platform WebGIS interaktif yang dikembangkan untuk menyajikan informasi destinasi wisata di Kabupaten Temanggung dalam bentuk peta digital. Aplikasi ini memanfaatkan teknologi geospasial berbasis web dan bertujuan untuk memudahkan wisatawan maupun masyarakat umum dalam mengenali, mengeksplorasi, dan mengakses informasi pariwisata secara efisien dan menarik.

Proyek ini dikembangkan sebagai bagian dari **Responsi Praktikum Pemrograman Geospasial Web Lanjut**.

---

## 🎯 Tujuan Pengembangan

- ✅ **Digitalisasi Peta Wisata**: Menyediakan peta interaktif wisata berbasis web.
- ✅ **Informasi Lengkap & Visual**: Menampilkan deskripsi dan dokumentasi visual untuk setiap titik wisata.
- ✅ **Aksesibilitas**: Mempermudah publik menjelajah wisata secara online kapan saja dan di mana saja.
- ✅ **Pendukung Promosi & Perencanaan**: Membantu pemerintah daerah dan pelaku wisata dalam promosi dan monitoring berbasis spasial.

---

## 🧩 Fitur Utama

- 🗺️ **Peta Interaktif**: Menampilkan titik-titik wisata di Kabupaten Temanggung.
- 📍 **Lokasi Saya**: Menampilkan posisi pengguna saat ini di peta.
- ➡️ **Navigasi Rute**: Menunjukkan rute tercepat dari lokasi pengguna ke destinasi wisata.
- ➕ **Input Lokasi Baru**: Pengguna dapat menambahkan lokasi wisata beserta detail dan foto.
- 📋 **Tabel Data**: Menyediakan data destinasi dalam bentuk tabel interaktif dengan pencarian dan filter.
- 📊 **Dashboard Statistik**: Menyajikan data kunjungan dan statistik wisata secara visual (grafik & tabel).
- 📤 **Ekspor Data**: Unduh data ke dalam format CSV atau Excel.
- 🔗 **API GeoJSON**: Tersedia untuk integrasi data spasial ke aplikasi lain.

---

## 🛠️ Teknologi yang Digunakan

| Komponen      | Teknologi                          |
|---------------|-------------------------------------|
| Backend       | Laravel (PHP)                      |
| Frontend      | HTML, CSS, JavaScript, Leaflet.js  |
| Database      | PostgreSQL + PostGIS               |
| Statistik     | Chart.js                           |
| Tabel Data    | DataTables                         |
| API Format    | GeoJSON                            |

---

## 🚀 Cara Instalasi & Menjalankan Proyek

> Pastikan kamu sudah menginstall **PHP**, **Composer**, dan **PostgreSQL + PostGIS**

1. **Clone repository**
   ```bash
   git clone https://github.com/salsabilasitinuraini/Responsi-PGWL.git
   cd Responsi-PGWL
   
2. **Install dependency Laravel**
   ```bash
   composer install
      
3. **Copy dan konfigurasi file .env**
   ```bash
   cp .env.example .env

4. **Edit file .env untuk koneksi database**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=jejak_temanggung
   DB_USERNAME=postgres
   DB_PASSWORD=yourpassword

5. **Generate application key**
   ```bash
   php artisan key:generate

6. **Migrate database**
   ```bash
   php artisan migrate

7. **Jalankan server lokal**
   ```bash
   php artisan serve

7. **Akses aplikasi di browser**
   ```url
   http://127.0.0.1:8000
     

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
