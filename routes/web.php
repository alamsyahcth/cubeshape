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
Auth::routes();

Route::group(['as' => 'frontend.'], function() {
    include __DIR__.'/web/frontend.php';
});

Route::group(['middleware' => ['admin']], function() {
    include __DIR__.'/web/admin.php';
});

Route::group(['middleware' => ['superAdmin']], function() {
    include __DIR__.'/web/super-admin.php';
});
