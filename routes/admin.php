<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
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

    Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard'); // the first page admin visits if authenticated
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [Settingscontroller::class, 'editShippingMethods'])->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', [Settingscontroller::class, 'updateShippingMethods'])->name('update.shippings.methods');
        });

        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', [ProfileController::class, 'editProfile'])->name('edit.profile');
            Route::put('update', [ProfileController::class, 'updateProfile'])->name('update.profile');
        });

        ################################## categories routes ######################################
        Route::group(['prefix' => 'main_categories'], function () {
            Route::get('/', [MainCategoriesController::class, 'index'])->name('admin.maincategories');
            Route::get('create', [MainCategoriesController::class, 'create'])->name('admin.maincategories.create');
            Route::post('store', [MainCategoriesController::class, 'store'])->name('admin.maincategories.store');
            Route::get('edit/{id}', [MainCategoriesController::class, 'edit'])->name('admin.maincategories.edit');
            Route::post('update/{id}', [MainCategoriesController::class, 'update'])->name('admin.maincategories.update');
            Route::get('delete/{id}', [MainCategoriesController::class, 'destroy'])->name('admin.maincategories.delete');
        });

        ################################## end categories    #######################################

        ################################## sub categories routes ######################################
        Route::group(['prefix' => 'sub_categories'], function () {
            Route::get('/',[SubCategoriesController::class, 'index'])->name('admin.subcategories');
            Route::get('create',[SubCategoriesController::class, 'create'])->name('admin.subcategories.create');
            Route::post('store',[SubCategoriesController::class, 'store'])->name('admin.subcategories.store');
            Route::get('edit/{id}',[SubCategoriesController::class, 'edit'])->name('admin.subcategories.edit');
            Route::post('update/{id}',[SubCategoriesController::class, 'update'])->name('admin.subcategories.update');
            Route::get('delete/{id}',[SubCategoriesController::class, 'destroy'])->name('admin.subcategories.delete');
        });

        ################################## end categories    #######################################

    });

    Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'postLogin'])->name('admin.post.login');

    });
});
