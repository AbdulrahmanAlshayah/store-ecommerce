<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/
//note that the prefix is admin for all fill route
Route::group(['namespace' => 'Dashboard','middleware' => 'auth:admin'],function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); // the first page admin visits if authenticated
});

Route::group(['namespace' => 'Dashboard','middleware' => 'guest:admin'],function (){
    Route::get('login',[LoginController::class,'login'])->name('admin.login');
    Route::post('login',[LoginController::class,'postLogin'])->name('admin.post.login');

});
