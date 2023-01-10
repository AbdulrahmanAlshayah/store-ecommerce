<?php

use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ProductController;
use App\Http\Controllers\Site\VerificationCodeController;
use App\Http\Controllers\Site\WishlistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['middleware' => 'guest'], function () {
        Route::get('/', [HomeController::class, 'home'])->name('home')->middleware('VerifiedUser');
        Route::get('category/{slug}', [CategoryController::class,'productsBySlug'])->name('category');
        Route::get('product/{slug}', [ProductController::class,'productsBySlug'])->name('product.details');
});


    Route::group(['namespace' => 'Site', 'middleware' => ['auth', 'VerifiedUser']], function () {
        // must be authenticated user and verified

        Route::get('profile', function () {
            return 'You Are Authenticated ';
        });
    });


    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user
        Route::post('verify-user/', [VerificationCodeController::class, 'verify'])->name('verify-user');
        Route::get('verify', [VerificationCodeController::class, 'getVerifyPage'])->name('get.verification.form');
    });


});

Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
    Route::post('wishlist', [WishlistController::class,'store'])->name('wishlist.store');
    Route::delete('wishlist', [WishlistController::class,'destroy'])->name('wishlist.destroy');
    Route::get('wishlist/products', [WishlistController::class,'index'])->name('wishlist.products.index');
});

