<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/default', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');;
});



// Pages Blade
Route::view('/login', 'auth.login')->name('login');
Route::view('/register', 'auth.register')->name('register');
Route::view('/cart', 'cart')->name('cart');
Route::view('/about', 'about')->name('about');
Route::view('/account', 'account')->name('account');
Route::view('/blog', 'blog')->name('blog');
Route::view('/home','home')->name('home');
Route::view('/blog/article1', 'articles.article1')->name('article1');
Route::view('/blog/article2', 'articles.article2')->name('article2');
Route::view('/blog/article3', 'articles.article3')->name('article3');
Route::view('/blog/article4', 'articles.article4')->name('article4');
Route::view('/blog/article5', 'articles.article5')->name('article5');
Route::view('/blog/article6', 'articles.article6')->name('article6');
Route::view('/products_ordi','pages.products_ordi')->name('ordi');
Route::view('/products_tel','pages.products_tel')->name('tel');
Route::view('/product_casque','pages.product_casque')->name('casque');
Route::view('/product_catalogue','pages.product_catalogue')->name('catalogue');
Route::view('/products_disk','pages.products_disk')->name('disk');
Route::view('/products_manettes','pages.products_manettes')->name('manettes');
Route::view('/products_cam','pages.products_cam')->name('cam');
Route::view('/security','security')->name('security');
Route::view('/conditions','conditions')->name('conditions');
Route::view('/cookies','cookies')->name('cookies');
Route::view('/panier','panier')->name('panier');
Route::view('/orderDetails','orderDetails')->name('orderDetails');
Route::view('/product_casqueDetail', 'pages.product_casqueDetail')->name('casque_details');
Route::view('/product_manetteDetail', 'pages.product_manetteDetail')->name('manette_details');
Route::view('/product_ordi-detail', 'pages.product_ordi-detail')->name('ordi_details');
Route::view('/product_disk-detail', 'pages.product_disk-detail')->name('disk_details');
Route::view('/product_cam_details', 'pages.product_cam_details')->name('cam_details');
Route::view('/product_tel_details', 'pages.product_tel_details')->name('tel_details');

// routes/web.php
Route::view('/product_casqueDetail/{id}','pages.product_casqueDetail')->name('product.detail');
// routes/web.php
Route::get('/products/{id}', function ($id) {
    return view('pages.product_casqueDetail', ['productId' => $id]);
})->name('product.detail');