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
//  Route::get('/dd/{product}','ProductController@test');
// Route::get('/dd/{category}','ProductController@towards');
// Route::get('/c', function () {return view('carts.checkout');});
Route::get('/test','CartController@test');
//products
Route::get('/exist/{product}','ProductController@checkCard');
Route::get('/offer/{product}','ProductController@price_offer');
Route::get('/products/{product}','ProductController@show');
Route::get('/rankproduct','ProductController@storerank');
Route::get('/fetch/best/{category}','ProductController@towards');
Route::get('/fetch/seller/{seller}','ProductController@favourites');
// Route::get('/heart/{product}','ProductController@heartCheck');
 //cart
Route::get('/fetch/cart/{prodID}','CartController@store');
Route::get('/cart','CartController@index');
Route::get('/quantity','CartController@quantity');
Route::get('/remove','CartController@remove');
//checkout
Route::get('/checkout','CheckoutController@index');
Route::get('/discount/{voucher}','CheckoutController@discount');
Route::post('/order/store','CheckoutController@store');

//contact
Route::get('/contact', function () {
    return view('contacts.contact');
});
Route::post('/contact/store','ContactController@store');





