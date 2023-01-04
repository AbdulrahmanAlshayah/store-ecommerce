<?php

use App\Http\Controllers\Dashboard\AttributesController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
use App\Http\Controllers\Dashboard\TagController;
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
            Route::get('/', [SubCategoriesController::class, 'index'])->name('admin.subcategories');
            Route::get('create', [SubCategoriesController::class, 'create'])->name('admin.subcategories.create');
            Route::post('store', [SubCategoriesController::class, 'store'])->name('admin.subcategories.store');
            Route::get('edit/{id}', [SubCategoriesController::class, 'edit'])->name('admin.subcategories.edit');
            Route::post('update/{id}', [SubCategoriesController::class, 'update'])->name('admin.subcategories.update');
            Route::get('delete/{id}', [SubCategoriesController::class, 'destroy'])->name('admin.subcategories.delete');
        });

        ################################## end categories    #######################################

        ################################## brands routes ######################################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/', [BrandController::class, 'index'])->name('admin.brands');
            Route::get('create', [BrandController::class, 'create'])->name('admin.brands.create');
            Route::post('store', [BrandController::class, 'store'])->name('admin.brands.store');
            Route::get('edit/{id}', [BrandController::class, 'edit'])->name('admin.brands.edit');
            Route::post('update/{id}', [BrandController::class, 'update'])->name('admin.brands.update');
            Route::get('delete/{id}', [BrandController::class, 'destroy'])->name('admin.brands.delete');
        });

        ################################## end brands    #######################################

        ################################## brands routes ######################################
        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', [TagController::class, 'index'])->name('admin.tags');
            Route::get('create', [TagController::class, 'create'])->name('admin.tags.create');
            Route::post('store', [TagController::class, 'store'])->name('admin.tags.store');
            Route::get('edit/{id}', [TagController::class, 'edit'])->name('admin.tags.edit');
            Route::post('update/{id}', [TagController::class, 'update'])->name('admin.tags.update');
            Route::get('delete/{id}', [TagController::class, 'destroy'])->name('admin.tags.delete');
        });

        ################################## end brands    #######################################

        ################################## products routes ######################################
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductsController::class, 'index'])->name('admin.products');
            Route::get('general-information', [ProductsController::class, 'create'])->name('admin.products.general.create');
            Route::post('store-general-information', [ProductsController::class, 'store'])->name('admin.products.general.store');

            Route::get('price/{id}', [ProductsController::class, 'getPrice'])->name('admin.products.price');
            Route::post('price', [ProductsController::class, 'saveProductPrice'])->name('admin.products.price.store');

            Route::get('stock/{id}',[ProductsController::class,'getStock'])->name('admin.products.stock');
            Route::post('stock', [ProductsController::class,'saveProductStock'])->name('admin.products.stock.store');

            Route::get('images/{id}',[ProductsController::class,'addImages'])->name('admin.products.images');
            Route::post('images', [ProductsController::class,'saveProductImages'])->name('admin.products.images.store');
            Route::post('images/db',[ProductsController::class, 'saveProductImagesDB'])->name('admin.products.images.store.db');
        });

        ################################## end products    #######################################

        ################################## attrributes routes ######################################
        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', [AttributesController::class,'index'])->name('admin.attributes');
            Route::get('create', [AttributesController::class,'create'])->name('admin.attributes.create');
            Route::post('store', [AttributesController::class,'store'])->name('admin.attributes.store');
            Route::get('delete/{id}', [AttributesController::class,'destroy'])->name('admin.attributes.delete');
            Route::get('edit/{id}', [AttributesController::class,'edit'])->name('admin.attributes.edit');
            Route::post('update/{id}', [AttributesController::class,'update'])->name('admin.attributes.update');
        });
        ################################## end attributes    #######################################

        ################################## brands options ######################################
        Route::group(['prefix' => 'options'], function () {
            Route::get('/', [OptionsController::class,'index'])->name('admin.options');
            Route::get('create', [OptionsController::class,'create'])->name('admin.options.create');
            Route::post('store', [OptionsController::class,'store'])->name('admin.options.store');
            //Route::get('delete/{id}',[OptionsController::class,'destroy']) -> name('admin.options.delete');
            Route::get('edit/{id}', [OptionsController::class,'edit'])->name('admin.options.edit');
            Route::post('update/{id}', [OptionsController::class,'update'])->name('admin.options.update');
        });
        ################################## end options    #######################################


    });


    Route::group(['prefix' => 'admin', 'middleware' => 'guest:admin'], function () {
        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'postLogin'])->name('admin.post.login');

    });
});


//Route::resources([
//    'photos' => PhotoController::class,
//    'posts' => PostController::class,
//]);
