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

Route::get('/news','newController@index');
Route::get('/newsearch','newController@search');
Route::get('/searched/{word}','newController@searchable');
Route::get('/newtag', function () {
    return view('news');
});

//test
 Route::get('/dd','HomeController@inner');
// Route::get('/dd/{category}','ProductController@towards');
// Route::get('/c', function () {return view('carts.checkout');});
Route::get('/test','CartController@test');
//products
Route::get('/exist/{product}','ProductController@checkCard');
Route::get('/offer/{product}','ProductController@price_offer');
Route::get('/per/offer/{product}','ProductController@precent_offer');
Route::get('/check/heart/{product}','ProductController@check_heart');
Route::get('/text/heart/{product}','ProductController@text_heart');
Route::get('/products/{product}','ProductController@show');
Route::get('/rankproduct','ProductController@storerank');
Route::get('/fetch/best/{category}','ProductController@towards');
Route::get('/fetch/seller/{seller}','ProductController@favourites');
//offer
// Route::get('/offer', function () {
//     return view('offers');
// });
Route::get('/offer','ProductController@indexOffer');
Route::get('/heart/{seller}','ProductController@favourites');

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

//profile
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/myaccount', function () {
    return view('myaccount');
});


//user
Route::put('/update/user/{id}','USerController@update');
Route::get('/myorders/{id}','OrderController@myOrders');
Route::get('/myorders', function () {
    return view('myorders');
});
Route::get('/myfavourites/{user}','FavouriteController@myfavourites');
Route::get('/myfavourites', function () {
    return view('myfavourites');
});


//admin panel

Route::get('/admin', 'ChartsController@index');//->middleware('role:Admin');

//charts for admin panal

Route::get('/chartData', 'ChartsController@chart');//->middleware('role:Admin');
Route::get('/chartData1', 'ChartsController@chart1');//->middleware('role:Admin');
Route::get('/chartData2', 'ChartsController@chart2');//->middleware('role:Admin');

//admin users

Route::get('/admin/panel/userstable', 'UserController@adminUsers');//->middleware('role:Admin');
Route::get('/user/{id}', 'UserController@showUser');//->middleware('role:Admin');
Route::get('user/edit/{id}', 'UserController@editUser');//->middleware('role:Admin');
Route::put('user/update/{id}', 'UserController@updateUser')->name('user.update');//->middleware('role:Admin');
Route::delete('user/{id}', 'UserController@destroyUser');//->middleware('role:Admin');;


//admin category

Route::get('/category/admin', 'categoryController@indexCategory')->name('category.indexCategory');//->middleware('role:Admin');
Route::get('/category/create/admin', 'categoryController@createCategory');//->middleware('role:Admin')->name('category.create22Admin');
Route::post('/create/category/admin', 'categoryController@addCategoryAdmin');//->middleware('role:Admin');;
//Route::post('/create/product/admin', 'categoryController@addCategoryProductAdmin');//->middleware('role:Admin');;
Route::get('/category/editAdmin/{category}', 'categoryController@editCategory');//->middleware('role:Admin')->name('category.edit22Admin');
//Route::get('/welcome/product', 'categoryController@productindex');//->middleware('role:Admin')->name('category.edit22Admin');
Route::put('/category/updateAdmin/{category}', 'categoryController@updateCategory');//->middleware('role:Admin')->name('category.update22Admin');



