<?php

use App\Http\Controllers\Admin\AminDashboardController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
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

    //market
    Route::prefix('/market')->namespace('Market')->name('market.')->group(function () {

        //category
        Route::prefix('/category')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/store', [CategoryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CategoryController::class, 'destroy'])->name('destroy');
        });

        //brand
        Route::prefix('/brand')->name('brand.')->group(function () {
            Route::get('/', [BrandController::class, 'index'])->name('index');
            Route::get('/create', [BrandController::class, 'create'])->name('create');
            Route::post('/store', [BrandController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [BrandController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [BrandController::class, 'destroy'])->name('destroy');
        });

        //comment
        Route::prefix('/comment')->name('comment.')->group(function () {
            Route::get('/', [CommentController::class, 'index'])->name('index');
            Route::get('/show', [CommentController::class, 'show'])->name('show');
            Route::post('/store', [CommentController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [CommentController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('destroy');
        });

        //delivery
        Route::prefix('/delivery')->name('delivery.')->group(function () {
            Route::get('/', [DeliveryController::class, 'index'])->name('index');
            Route::get('/create', [DeliveryController::class, 'create'])->name('create');
            Route::post('/store', [DeliveryController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [DeliveryController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [DeliveryController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [DeliveryController::class, 'destroy'])->name('destroy');
        });

        //discount
        Route::prefix('/discount')->name('discount.')->group(function () {
            Route::get('/coupon', [DiscountController::class, 'coupon'])->name('coupon');
            Route::get('/coupon/create', [DiscountController::class, 'couponCreate'])->name('coupon.create');
            Route::get('/common-discount', [DiscountController::class, 'commonDiscount'])->name('commonDiscount');
            Route::get('/common-discount/create', [DiscountController::class, 'commonDiscountCreate'])->name('commonDiscount.create');
            Route::get('/edit/{id}', [DiscountController::class, 'edit'])->name('edit');
            Route::get('/amazing-sale', [DiscountController::class, 'amazingSale'])->name('amazingSale');
            Route::get('/amazing-sale/create', [DiscountController::class, 'amazingSaleCreate'])->name('amazingSale.create');
        });

        //order
        Route::prefix('/order')->name('order.')->group(function () {
            Route::get('/', [OrderController::class, 'all'])->name('all');
            Route::get('/new-order', [OrderController::class, 'newOrders'])->name('newOrders');
            Route::get('/sending', [OrderController::class, 'sending'])->name('sending');
            Route::get('/unpaid', [OrderController::class, 'unpaid'])->name('unpaid');
            Route::get('/canceled', [OrderController::class, 'canceled'])->name('canceled');
            Route::get('/returned', [OrderController::class, 'returned'])->name('returned');
            Route::get('/show', [OrderController::class, 'show'])->name('show');
            Route::get('/change-send-status', [OrderController::class, 'changeSendStatus'])->name('changeSendStatus');
            Route::get('/change-order-status', [OrderController::class, 'changeOrderStatus'])->name('changeOrderStatus');
            Route::get('/cancel-order', [OrderController::class, 'cancelOrder'])->name('cancelOrder');
        });

        //payment
        Route::prefix('/payment')->name('payment.')->group(function () {
            Route::get('/', [PaymentController::class, 'index'])->name('index');
            Route::get('/online', [PaymentController::class, 'online'])->name('online');
            Route::get('/offline', [PaymentController::class, 'offline'])->name('offline');
            Route::get('/attendance', [PaymentController::class, 'attendance'])->name('attendance');
            Route::get('/confirm', [PaymentController::class, 'confirm'])->name('confirm');
        });

        //product
        Route::prefix('/product')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/store', [ProductController::class, 'store'])->name('product.store');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
            Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

            //gallery
            Route::get('/gallery/', [GalleryController::class, 'index'])->name('gallery.index');
            Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
            Route::delete('/gallery/destroy/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
        });
    });
});
