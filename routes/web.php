<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::prefix("/customer")...

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix("/products")->group(function () {
    Route::get("/cart", "CartController@showCart")->name("product.showCard");
    Route::get('/', "ProductController@showlist")->name("product.list");
    Route::get('/create', "ProductController@create")->name("product.create");
    Route::post('/create', "ProductController@createSuccess")->name("product.create");
    Route::post("/search","ProductController@search")->name("product.search");

    Route::get('/{id}/delete', "ProductController@destroy")->name("product.destroy");
    Route::get('/{id}/edit', "ProductController@edit")->name("product.edit");
    Route::post('/{id}/update', "ProductController@update")->name("product.update");

    Route::get("/cart/{id}", "CartController@addToCart")->name("product.addToCart");

    Route::get("/cart/{id}/remove_product", "CartController@removeProductIntoCart")->name("cart.deleteProduct");
    Route::get('/plus-to-cart/{id}', 'CartController@plusProductIntoCart')->name('cart.plusProductIntoCart');
    Route::get('/sub-to-cart/{id}', 'CartController@subProductIntoCart')->name('cart.subProductIntoCart');

});
Route::prefix("/users")->group(function () {
    Route::post("/{id}/edit", "UserController@edit")->name('users.edit');
});
