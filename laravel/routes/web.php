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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/salam', function(){
    return "Salam STTNF, selamat datang di laravel";
});

Route::get('/admin', function(){
    return "ini halaman admin";
});

Route::get('/mahasiswa', function(){
    return view('mahasiswa');
});