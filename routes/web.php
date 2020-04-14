<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/fetch/products/{category}','CategoryController@home');
//newspage
// Route::get('/newtag')
Route::get('/news','newController@index');
Route::get('/newsearch','newController@search');
Route::get('/searched/{word}','newController@searchable');
Route::get('/newtag', function () {
    return view('news');
});

//test
// Route::get('/dd','ProductController@best');
// Route::get('/dd/{category}','ProductController@towards');
Route::get('/test','CartController@test');
//products
Route::get('/products/{product}','ProductController@show');
Route::get('/rankproduct','ProductController@storerank');
Route::get('/fetch/best/{category}','ProductController@towards');
 //cart
Route::get('/fetch/cart/{prodID}','CartController@store');




