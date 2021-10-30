<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/activate/{code}', 'ActivationController@activateUserAccount')->name('user.activate');
Route::get('/resend/{email}', 'ActivationController@resendActivationCode')->name('code.resend');
Route::post('login', 'ApiAuthController@login');
//Route::get('user', 'App\Http\Controllers\UserController@current');
Route::get('products', 'ProductController@index');
Route::post('register', 'ApiAuthController@register');
Route::get('products/{key}', 'ProductController@search');
//category
Route::get('categories', 'CategoryController@index');
Route::get('products/categories/{id}', 'CategoryController@products');

Route::get('resend/verify', 'ApiAuthController@resend')->name('verification.resend');

Route::post('password/forgot-password', 'ApiAuthController@forgotPassword');
Route::post('password/reset', 'ApiAuthController@passwordReset');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('logout', 'ApiAuthController@logout');
    Route::post('cart', 'CartController@addProductToCart');
    Route::get('cart', 'CartController@index');
    Route::get('user', 'ApiAuthController@current');
    Route::post('order', 'OrderController@addOrder');
    Route::get('order', 'OrderController@index');

});
