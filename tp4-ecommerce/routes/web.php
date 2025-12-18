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
Route::view('/casques-audio','pages.product_casque')->name('casque');
Route::view('/appareils-photo-pro','pages.product_cam')->name('cam');
Route::view('/electronique','pages.product_ordi')->name('ordi');
Route::view('/maison','home')->name('maison');
Route::view('/sport','home')->name('sport');
Route::view('/appareils-photo','pages.product_cam')->name('cam');
Route::view('/disques-durs','pages.product_disk')->name('disk');
Route::view('/manettes','pages.product_manette')->name('manettes');
Route::view('/telephones-portables','pages.product_tel')->name('tel');

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