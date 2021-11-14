<?php

use App\Http\Controllers\Admin\AminDashboardController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CategoryController;
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

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::prefix('/admin')->namespace('Admin')->name('admin.')->group(function () {
    Route::get('/', [AminDashboardController::class, 'index'])->name('home');
    Route::prefix('/market')->namespace('Market')->name('market.')->group(function () {

        //category
        Route::prefix('/category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        //brand
        Route::prefix('/brand')->name('brand.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [BrandController::class, 'destroy'])->name('destroy');
        });
    });
});
