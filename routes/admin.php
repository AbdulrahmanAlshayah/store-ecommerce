<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\SettingsController;
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


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); // the first page admin visits if authenticated
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [Settingscontroller::class, 'editShippingMethods'])->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', [Settingscontroller::class, 'updateShippingMethods'])->name('update.shippings.methods');
        });
    });

    Route::group(['prefix' => 'admin','middleware' => 'guest:admin'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'postLogin'])->name('admin.post.login');

    });
});
