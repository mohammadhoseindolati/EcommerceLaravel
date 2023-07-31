<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;

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

Route::get('/admin-panel/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::prefix('admin-panel/management')->name('admin.')->group(function (){

    Route::resource('brands' , BrandController::class) ;
    Route::resource('attributes' , AttributeController::class) ;
    Route::resource('categories' , CategoryController::class) ;
    Route::resource('tags' , \App\Http\Controllers\Admin\TagController::class) ;
    Route::resource('products' , \App\Http\Controllers\Admin\ProductController::class) ;

    Route::get('/category-attribute/{category}' , [CategoryController::class , 'categoryAttributes']) ;
});
