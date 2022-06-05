<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('newsletter','NewsletterController')->middleware('auth');
Route::resource('category','CategoryController')->middleware('auth');
Route::resource('food','FoodController')->middleware('auth');
Route::get('/form','FormController@index');
Route::get('/forms','FormController@store')->name('form.store');
Route::post('/forms','FormController@store')->name('form.store');
Route::get('/form/{locale}', 'App\Http\Controllers\LocalizationController@index');


// event & listener: newsletter route
Route::get('/newsletter','NewsletterController@index');
Route::post('/subscribe','NewsletterController@subscribe');

// Auth::routes(['register'=>false]);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', 'FoodController@listFood');
Route::get('/foods/{id}', 'FoodController@detailFood')->name('detail');