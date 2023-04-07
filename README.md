<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/php%20version-8.1-blue" alt="language"></a>
<img src="https://img.shields.io/badge/laravel%20version-10.0-red" alt="framework"></a>
<img src="https://img.shields.io/badge/authentication-passportOAuth2-red" alt="authentication"></a>
</p>


## Mulai

1. Klon repositori ini
2. Lakukan instalasi pustaka php dengan `composer install`
3. Salin berkas `.env.example` ke `.env` dan sesuaikan konfigurasimu
4. Buat kunci aplikasi dengan `php artisan key:generate`
5. Lakukan migrasi dan isi database dengan `php artisan migrate:fresh --seed`
6. Genrate Client key dengan menjalankan `php artisan passport:install`
7. Generate Dokumentasi laravel swagger dengan menjalankan `php artisan l5-swagger:generate   `
8. Jalankan aplikasi dengan `php artisan serve`
9. Buka peramban dan kunjungi `http://localhost:8000`
10. Buka dockumentasi laravel swaggger di `http://localhost:8000/api/documentation`

## Tes

Jalankan `php artisan test` untuk melakukan unit testing dengan PHPUnit
