<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'Dashboard','middleware' => 'auth:admin'],function (){
    Route::get('users',function (){
        return "in admin";
    });
});

Route::group(['namespace' => 'Dashboard'],function (){
    Route::get('login',function (){
        return "please login";
    })->name('admin.login');
});
