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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', 'ProductController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('export', 'ProductController@export')->name('export');
Route::get('importExportView', 'ProductController@importExportView');
Route::post('import', 'ProductController@import')->name('import');

Route::get('/', function () {
    return view('layouts.app');
});
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/dashboard', 'AdminController@index')->name('admin.home');
});
