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

Route::get('test',function (){
    $category = \App\Models\Category::first();

    $category -> makeVisible(['translations']);
    $parent_id =  \App\Models\Category::select('id')->whereNull('parent_id')->inRandomOrder()->first();
    $parent_id->makeHidden('name');
    return $parent_id;
});
