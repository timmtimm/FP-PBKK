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
-   [x] Laravel command and scheduling
-   [x] Laravel event and listener
-   [ ] Laravel contracts and facade
-   [ ] Laravel broadcasting
-   [ ] Laravel composer package

## Localization and File Storage

Implementasi dari localization terlihat pada halaman `Guest's Form` yang mana merupakan halaman yang berfungsi untuk memberikan feedback Masakin yang bisa diberikan pengguna maupun non-pengguna (pengunjung).
Nama dan lokasi file atribut untuk localization:

-   Kernel.php Setup: `app\Http`
-   FormController.php Controller: `app\Http\Controllers`
-   LocalizationController.php Controller: `app\Http\Controllers`
-   Localization.php Middleware: `app\Http\Middleware`
-   Form.php Model: `app\Models`
-   Config > app.php: `config\app.php`
-   Migration Table untuk Form: `database\migrations\2022_06_05_151405_create_forms_table.php`
-   Icon Bahasa Inggris: `public\img\en.png`
-   Icon Bahasa Indonesia: `public\img\id.png`
-   Form.php untuk bahasa Inggris: `resources\lang\en`
-   Form.php untuk bahasa Indonesia: `resources\lang\id`
-   View blade form: `resources\views\form.blade.php`
-   Penambahan navbar list Guest's Form dan import jQuery di main app layout: `resources\views\layout\app.blade.php`

Sedangkan, untuk file storage terletak di sistem ketika kita ingin memasukkan makanan (food) baru ke dalam database. Dalam formulir makanan baru akan dimintakan file input berupa gambar, maka nanti file gambar makanan yang dimasukkan akan dimasukkan ke dalam `public > image > time.ekstensi-gambar`.
Nama dan lokasi file atribut untuk file storage:

-   Controller Food di fungsi store+update: `app/Http/Controllers/FoodController.php` @store @update
-   Table Migration - Food (image): `database/migrations/2022_05_29_140628_create_food_table.php` @image

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
