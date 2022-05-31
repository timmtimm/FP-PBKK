# Final Project PBKK Kelas B - Kelompok 7

Tema Project: Aplikasi Website Berbasis Laravel untuk Restoran

## Anggota

| NRP            | Nama                   |
| :------------- | :--------------------- |
| 05111940000029 | Dewangga Dharmawan     |
| 05111940000161 | Timotius Wirawan       |
| 5025201076     | Raul Ilma Rajasa       |
| 5025201017     | Muhammad Rolanov Wowor |

## Required

-   [x] Laravel route, controller and middleware
-   [x] Laravel request, validation and response
-   [x] Laravel model, eloquent and query builder
-   [x] Laravel authentication and authorization
-   [x] Laravel localization and file storage
-   [x] Laravel view and blade component
-   [x] Laravel session and caching
-   [ ] Laravel feature testing and unit testing

## Optional (min 2)

-   [ ] Laravel jobs and queue
-   [ ] Laravel command and scheduling
-   [x] Laravel event and listener
-   [ ] Laravel contracts and facade
-   [ ] Laravel broadcasting
-   [ ] Laravel composer package

## Localization and File Storage

Implementasi dari localization dan file storage terletak di sistem ketika kita ingin memasukkan makanan (food) baru ke dalam database. Dalam formulir makanan baru akan dimintakan file input berupa gambar, maka nanti file gambar makanan yang dimasukkan akan dimasukkan ke dalam `public > image > time.ekstensi-gambar`.
Nama dan lokasi file atribut:

-   Controller Food di fungsi store: `app/Http/Controllers/NewsletterController.php` @store
-   Table Migration - Food (image): `database/migrations/2022_05_29_140628_create_food_table.php`

## Event and Listener

Kami menambahkan sistem newsletter yang menggunakan integrasi Mail dari Mailtrap untuk mengirimkan pesan bahwa user telah berlayanan dengan berita terbaru mengenai Masakin.
Nama dan lokasi file atribut:

-   Event UserSubscribed: `app/Events/UserSubscribed.php`
-   Controller Newsletter: `app/Http/Controllers/NewsletterController.php`
-   Listener EmailOwnerAboutSubscription: `app/Listeners/EmailOwnerAboutSubscription.php`
-   Mail UserSubscribedMessage: `app/Mail/UserSubscribedMessage.php`
-   Table Migration - Newsletter: `database/migrations/2022_05_30_093506_newsletter.php`
-   Masakin Icon (Resized): `public/img/icon.png`
-   Full Logo Masakin: `public/img/masakin.png`
-   View Blade Mail>Subscribed: `resources/views/mail/subscribed.blade.php`
-   View Blade Newsletter>Index: `resources/views/newsletter/index.blade.php`
