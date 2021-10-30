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
//login logout & register routes
//Auth::routes();

//home route
Route::get('/', 'HomeController@index')->name('home');
//activate user account routes
Route::get('/activate/{code}', 'ActivationController@activateUserAccount')->name('user.activate');
Route::get('/resend/{email}', 'ActivationController@resendActivationCode')->name('code.resend');
//products routes
Route::resource('products', 'ProductController');
Route::get('products/category/{category}', 'HomeController@getProductByCategory')->name("category.products");
//cart routes
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/add/cart/{product}', 'CartController@addProductToCart')->name('add.cart');
Route::delete('/remove/{product}/cart', 'CartController@removeProductFromCart')->name('remove.cart');
Route::put('/update/{product}/cart', 'CartController@updateProductOnCart')->name('update.cart');
//payment routes
Route::get('/handle-payment', 'PaypalPaymentController@handlePayment')->name('make.payment');
Route::get('/cancel-payment', 'PaypalPaymentController@paymentCancel')->name('cancel.payment');
Route::get('/payment-success', 'PaypalPaymentController@paymentSuccess')->name('success.payment');
//admin routes
Route::post('/admin/product', 'ProductController@store')->name('products.store');
Route::post('/admin/category', 'CategoryController@store')->name('categories.store');

Route::get('/admin', 'AdminController@index')->name('admin.index');
Route::get('/admin/login', 'AdminController@showAdminLoginForm')->name('admin.login');
Route::post('/admin/login', 'AdminController@adminLogin')->name('admin.login');
Route::get('/admin/logout', 'AdminController@adminLogout')->name('admin.logout');
Route::get('/admin/products', 'AdminController@getProducts')->name('admin.products');
Route::get('/admin/orders', 'AdminController@getOrders')->name('admin.orders');
Route::get('/admin/categories', 'AdminController@getCategories')->name('admin.categories');

//orders routes
Route::resource('orders', 'OrderController');
