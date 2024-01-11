<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('main');
Route::get('/product/{slug}', [\App\Http\Controllers\ProductController::class, 'show'])->name('productpage');
Route::get('/category', [\App\Http\Controllers\CategoryController::class, 'index'])->name('all_category');
Route::get('/category/{slug}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('list_category');
Route::get('/producatori', [\App\Http\Controllers\ProducatoriController::class, 'index'])->name('all_producatori');
Route::get('/producatori/{slug}', [\App\Http\Controllers\ProducatoriController::class, 'show'])->name('list_producatori');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admincp', [\App\Http\Controllers\Admin\MainController::class, 'index'])->name('admin');

Route::resource('/admincp/categories', \App\Http\Controllers\Admin\CategoryController::class);
Route::resource('/admincp/products', \App\Http\Controllers\Admin\ProductController::class);
Route::resource('/admincp/tags', \App\Http\Controllers\Admin\TagController::class);
Route::resource('/admincp/producatori', \App\Http\Controllers\Admin\ProducatorsController::class);
