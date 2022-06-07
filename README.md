# Masakin :bento: | Aplikasi Laravel Restoran

> Sistem Informasi Website Berbasis Laravel untuk Restoran | Final Project PBKK Kelas B - Kelompok 7

|                                                                                                                              _Masakin_                                                                                                                              |
| :-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------: |
| <a href="https://drive.google.com/uc?export=view&id=115YxBvLzkQT4k506232yoFRu-7GULMNL"><img src="https://drive.google.com/uc?export=view&id=115YxBvLzkQT4k506232yoFRu-7GULMNL" alt="Thumbnail" style='width:40%'></a><br /><sup><a href="#">PBKK B - Kelompok 7</a> |

## Anggota

| NRP            | Nama                   | Job Desk                                                                                 |
| :------------- | :--------------------- | :--------------------------------------------------------------------------------------- |
| 05111940000029 | Dewangga Dharmawan     | Model, Eloquent, Query, Session, and Caching                                             |
| 05111940000161 | Timotius Wirawan       | Front-End View Blade, Authentication-Authorization, and Command-Scheduling               |
| 5025201076     | Raul Ilma Rajasa       | Logo Design, Middleware, Request, Validation, Response, Localization, and Event-Listener |
| 5025201017     | Muhammad Rolanov Wowor | Route, Controller, View-Blade, File Storage, and Feature-Unit Testing                    |

## Required

-   [x] Laravel route, controller and middleware
-   [x] Laravel request, validation and response
-   [x] Laravel model, eloquent and query builder
-   [x] Laravel authentication and authorization
-   [x] Laravel localization and file storage
-   [x] Laravel view and blade component
-   [x] Laravel session and caching
-   [x] Laravel feature testing and unit testing

## Laravel Route, Controller, and Middleware\*\*

**Laravel Route**

Untuk routing, konfigurasi yang digunakan adalah seperti project Laravel umumnya, yaitu dengan menggunakan path `routes\web.php`. Di sini, kami memiliki klasifikasi routing yang berbeda jenis untuk beberapa view, seperti untuk Newsletter, Category, dan Food akan memanfaatkan penggunaan routing resource dari controller yang sudah digenerate dengan resource serta menggunakan middleware untuk `auth` untuk mengizinkan akses pada user yang sudah login saja seperti berikut:

```
Route::resource('newsletter','NewsletterController')->middleware('auth');
Route::resource('category','CategoryController')->middleware('auth');
Route::resource('food','FoodController')->middleware('auth');
```

Sedangkan, untuk routing Guest's Form sebagai pengaplikasian `localization`, kami menggunakan standard routing `get-post`, yaitu:

```
Route::get('/form','FormController@index');
Route::get('/forms','FormController@store')->name('form.store');
Route::post('/forms','FormController@store')->name('form.store');
Route::get('/form/{locale}', 'App\Http\Controllers\LocalizationController@index');
...
Route::get('/newsletter','NewsletterController@index');
Route::post('/subscribe','NewsletterController@subscribe');
...
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'FoodController@listFood');
Route::get('/foods/{id}', 'FoodController@detailFood')->name('detail');
```

Agar register hanya bisa melalui admin sehingga user lain hanya bisa melihat saja, kami mengubah konfigurasi routing `auth`-nya menjadi seperti berikut:
`Auth::routes(['register',false]);`

**Laravel Controller**

Untuk Laravel controller memiliki lokasi yang sama dengan konfigurasi standar, yaitu di `app\Http\Controllers`. Untuk controller sendiri, kami mengimplementasikan 6 controller, yaitu: 
1. CategoryController `app\Http\Controllers\CategoryController` yang memiliki konfigurasi resource bawaan laravel untuk CRUD. Seperti namanya, controller ini berfungsi untuk mengelola data dari kategori makanan yang ada di Masakin. 
2. FoodController `app\Http\Controllers\FoodController` memiliki resource CRUD bawaan laravel juga yang mana controller ini berfungsi untuk mengelola data dari selurh makanan yang ada. 
3. FormController `app\Http\Controllers\FormController` berfungsi untuk mengelola data dari Guest's Form. FormController hanya kami isi di indexing dan juga store, karena pengguna hanya bisa mengirimkan suatu feedback saja, tidak bisa mengedit maupun menghapus data feedback tersebut. 
4. HomeControler `app\Http\Controllers\HomeController` berfungsi untuk mengelola status autentikasi dari pengguna yang mengakses web Masakin. Di sini, kami hanya memanfaatkan construct untuk middleware auth dan juga indexing. 
5. LocalizationController `app\Http\Controllers\LocalizationController` berfungsi untuk mengelola localization bahasa dari Guest's Form untuk pengalihan bahasa dari bahasa Inggris-Indonesia dan sebaliknya. Di bagian ini, kami hanya melakukan session pendeteksi konfigurasi `locale` dari aplikasi untuk membaca status bahasa yang digunakan. 
6. NewsletterController `app\Http\Controllers\NewsletterController` berfungsi untuk mengelola kegiatan subscribe/langganan berita dari Masakin ke email yang disertakan di formulirnya. Di bagian ini, kami mengimplementasikan indexing dan juga custom resource, yaitu subscribe - untuk melakukan penyetoran data langganan dari pengguna ke email yang disertakan.

**Laravel Middleware**

Untuk middleware, kami mengimplementasikan di berbagai tahapan, yaitu:

1. Autentikasi `app\Http\Middleware\Authenticate` yang berfungsi sebagai redirection ketika pengguna belum terautentikasi (login).
2. Localization `app\Http\Middleware\Localization` yang berfungsi untuk mengelola session `locale` bahasa yang dipilih oleh pengguna.

## Laravel Request, Validation and Response

**Laravel Request**

Untuk pengimplementasian dari Laravel Request, kami mengimplementasikannya pada controller Food, yaitu untuk menyetor gambar dari makanan yang dimasukkan oleh admin. Implementasi utama dari bagian ini adalah di `app\Http\Controllers\FoodController`, yaitu dengan potongan kode utama:

```
public function store(Request $request)
{
    $this->validate($request, [
        'name'=>'required',
        'description'=>'required',
        'price'=>'required|integer',
        'category'=>'required',
        'image'=>'required|mimes:png,jpeg,jpg'
    ]);
    $image = $request->file('image');
    $name = time().'.'.$image->getClientOriginalExtension();
    $destinationPath = public_path('image');
    $image->move($destinationPath,$name);
    Food::create([
        'name'=>$request->get('name'),
        'description'=>$request->get('description'),
        'price'=>$request->get('price'),
        'category_id'=>$request->get('category'),
        'image'=>$name
    ]);
    return redirect()->back()->with('message','Food berhasil ditambahkan');
}
```

**Laravel Validation**

Untuk pengimplementasian dari Laravel Validation, kami mengimplementasikannya pada setiap penginputan data formulir yang dimasukkan oleh pengguna, sehingga peletakan implementasi validation ini utamanya terletak di `app\Http\Controllers`. Berikut merupakan salah satu implementasinya untuk memvalidasi data request berupa nama, deskripsi, harga, kategori, dan juga gambar di FoodController@update `app\Http\Controllers\FoodController`:

    ```
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'=>'required',
            'description' => 'required',
            'price' => 'required|integer',
            'category' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg'
        ]);

        $food = Food::find($id);
        $name = $food->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/image');
            $image->move($destinationPath, $name);
        }

        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request->get('category');
        $food->image = $name;
        $food->save();

        return redirect()->route('food.index')->with('message', 'Food information updated');
    }
    ```

**Laravel Response**

Implementasi dari laravel response ini terletak pada beberapa file view blade yang sudah kami buat. Sebagai contohnya: `resources\views\food\index.blade.php` yang mengimplementasikan response untuk memberi respon terhadap proses yang dilakukan pada FoodController `app\Http\Controllers\FoodController`:

    ````
    <div class="col-md-8">
            @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">All Food</div>
                <span class="float-right">
                    <a href="{{ route('food.create') }}">
                        <button class="btn btn-outline-secondary">Tambah Makanan</button>
                    </a>
                </span>
                <div class="card-body">
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($foods) > 0)
                            @foreach($foods as $key=>$food)
                            <tr>
                                <td><img src = "{{ asset('image') }}/{{ $food->image }}" width="100"></td>
                                <td>{{ $food->name }}</td>
                                <td>{{ $food->description }}</td>
                                <td>{{ $food->price }}</td>
                                <td>{{ $food->category->name }}</td>
                                <td>
                                    <a href="{{ route('food.edit',[$food->id]) }}">
                                    <button class="btn btn-outline-success">Edit</button></a>
                                </td>
                                <td>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $food->id }}">
                                        Delete
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $food->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form action="{{ route('food.destroy',[$food->id]) }}" method="post">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">Apakah Anda Yakin?</div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                                <td>Tidak ada food yang dapat ditampilkan</td>
                            @endif
                        </tbody>
                    </table>
                    {{ $foods->links() }}
                </div>
            </div>
        </div>
        ```
    ````

## Laravel View and Blade

**Laravel View**

Pengimplementasian dari laravel view berada pada `resource\views` yang terdiri dari beberapa folder, yaitu auth (sebagai sistem autentikasi dari Masakin), category, food, layouts (template utama dari web), mail (untuk template pesan email terkirim), dan juga newsletter (formulir pengisian newsletter).

**Laravel Blade Component**

Untuk laravel blade juga serupa dengan laravel view, akan tetapi lebih spesifik untuk file blade.php. Untuk pengimplementasiannya, kami menaruhnya di setiap folder views `resource\views` yang mana terbagi menjadi 7 bagian, yaitu:

1. Main Folder `resource\views` yang berisikan file blade: detail, form, home, index, dan welcome.
2. Auth `resource\views\auth` yang berisikan file blade yang otomatis terbuat saat instalasi bootstrap auth.
3. Category `resource\views\category` yang berisikan file blade CRUD, yaitu index (menampilkan data-data kategori), edit (untuk mengedit data kategori yang dipilih), dan create (untuk membuat data kategori baru).
4. Food `resource\views\food` yang berisikan file blade CRUD, dengan struktur dan fungsi yang serupa dengan kategori.
5. Layouts `resource\views\layouts` yang berisikan file blade layout app yang berfungsi untuk menghindari penulisan kode boilerplate dan untuk menghemat space coding sebagai bentuk efisiensi.
6. Mail `resource\views\mail` yang berisikan 1 file blade subscribed yang menampilkan desain pesan ketika pengguna mendaftarkan di newsletter Masakin.
7. Newsletter `resource\views\newsletter` yang berisikan 1 file blade index yang menampilkan bentuk desain dari formulir newsletter Masakin.

## Model, Eloquent, Query

Model yang digunakan dalam aplikasi ini adalah Category, Food, Form, dan User yang terletak di `app\Models`
    
`Category.php` memiliki atribut nama kategori dan akan mengembalikan ke makanan untuk menunjukan kategori makanan
`Food.php` memiliki atribut nama makanan, deskripsi makanan, harga, jenis kategori dengan id-nya, dan gambarnya. Ini akan dikembalikan ke Category berdasarkan kategori
`Form.php` memiliki atribut nama, alamat, umur, email, dan pesan
`User.php` akan mengatur atribut mana yang muncul dan mana yang tidak
    
Hubungan antara Food dan Category adalah many to one, dengan satu kategori bisa berisi berbagai makanan
 
## Authentication and authorization

Untuk implementasi pada authentikasi, kami menggunakan package `laravel/ui` dikarenakan kami ingin menggunakan bootstrap sebagai framework css.

Untuk langkah instalasinya:

1. Install package `laravel/ui` dengan command `composer require laravel/ui`
2. Jalankan command `php artisan ui boostrap`
3. Jika mengalami error saat menjalankan perintah sebelumnya, jalankan command `npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps`. Lalu jalankan kembali command `php artisan ui boostrap`
4. Jalankan command `npm install && npm run dev`
5. Untuk instalasi authentikasi, jalankan command `php artisan ui bootstrap --auth`

Setelahnya authentikasi telah siap digunakan.

## Laravel Localization and File Storage

**Laravel Localization**

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

**Laravel File Storage**

Sedangkan, untuk file storage terletak di sistem ketika kita ingin memasukkan makanan (food) baru ke dalam database. Dalam formulir makanan baru akan dimintakan file input berupa gambar, maka nanti file gambar makanan yang dimasukkan akan dimasukkan ke dalam `public > image > time.ekstensi-gambar`.
Nama dan lokasi file atribut untuk file storage:

-   Controller Food di fungsi store+update: `app/Http/Controllers/FoodController.php` @store @update
-   Table Migration - Food (image): `database/migrations/2022_05_29_140628_create_food_table.php` @image
    
## Laravel Session dan Caching
    
Cache diimplementasikan di file `/app/Http/Controllers/CategoryController.php` dan `/app/Http/Controllers/FoodController.php` untuk mempercepat pengambilan data sewaktu-waktu dibuka kembali
    
`/app/Http/Controllers/CategoryController.php`
    
````
     public function index()
    {
        $cache_categ = 'key-category';
        $categories = Cache::get($cache_categ);

        $categories = Category::latest()->get();

        Cache::put($cache_categ, $categories, 60);

        return view('category.index',compact('categories'));
        // $foods = Food::latest()->paginate(1);
        // return view('food.index', compact('foods'));
    }
````
`/app/Http/Controllers/FoodController.php`
    
````
     public function index()
    {
        $cache_foods = 'key-foods';
        $foods = Cache::get($cache_foods);

        $foods = Food::latest()->paginate(1);

        Cache::put($cache_foods, $foods, 60);

        // $foods = Food::latest()->get();
        return view('food.index', compact('foods'));
    }
````

## Laravel Unit Testing and Feature Testing
**Unit Testing** diimplemementasikan pada CategoryController dimana melakukan pengetesan untuk menyimpan data user, dan user yang ingin membuat kategori.
Nama dan lokasi file atribut untuk unit testing: `tests\Unit\CategoryControllerTest`.
    
**Feature Testing** diimplementasikan pada model food untuk pengetesan untuk membuat model food, serta redirect ke halaman `/food` serta testing session/authentication. Nama dan lokasi file atribut untuk feature testing: `tests\Feature\FoodTest` .

Hasil testing:
<br>
    ![tesresult](https://user-images.githubusercontent.com/99122278/172218924-18fff388-9b55-4dfb-b162-647523233c27.png)
</br>

## Optional (min 2)

-   [ ] Laravel jobs and queue
-   [x] Laravel command and scheduling
-   [x] Laravel event and listener
-   [ ] Laravel contracts and facade
-   [ ] Laravel broadcasting
-   [ ] Laravel composer package

## Event and Listener

Kami menambahkan sistem newsletter yang menggunakan integrasi Mail dari Mailtrap untuk mengirimkan pesan bahwa user telah berlayanan dengan berita terbaru mengenai Masakin.

Kami menambahkan sistem newsletter yang menggunakan integrasi Mail dari Mailtrap untuk mengirimkan pesan bahwa user telah berlayanan dengan berita terbaru mengenai Masakin. Untuk event sendiri kami integrasikan pada lokasi `app\Events\UserSubscribed.php`, yaitu:

```
<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserSubscribed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
```

Sedangkan untuk listener, kami mengimplementasikannya pada `app\Listeners\EmailOwnerAboutSubscription.php`, yaitu dengan kode sebagai berikut:

```
<?php

namespace App\Listeners;
use App\Events\UserSubscribed;
use App\Mail\UserSubscribedMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailOwnerAboutSubscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserSubscribed $event)
    {
        DB::table('newsletter')->insert([
            'email' => $event->email
        ]);
        Mail::to($event->email)->send(new UserSubscribedMessage());
    }
}
```

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

## Command and scheduling

Kami menambahkan command untuk menghapus table Newsletter setiap menit untuk mempercepat demo. Perintah tersebut bisa dijalankan menggunakan command `newsletter:delete`. Untuk code command bisa dilihat pada `app/console/Commands/DeleteNewsletter.php`. Untuk implementasi pada Scheduling bisa dilihat pada `app/console/Kernel.php` dimana akan menjalankan command `newsletter:delete` setiap menit.
