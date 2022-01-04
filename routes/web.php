<?php

use App\Http\Controllers\Admin\AminDashboardController;
use App\Http\Controllers\Admin\Content\CategoryController as ContentCategoryController;
use App\Http\Controllers\Admin\Content\CommentController as ContentCommentController;
use App\Http\Controllers\Admin\Content\FAQController;
use App\Http\Controllers\Admin\Content\MenuController;
use App\Http\Controllers\Admin\Content\PageController;
use App\Http\Controllers\Admin\Content\PostController;
use App\Http\Controllers\Admin\Market\BrandController;
use App\Http\Controllers\Admin\Market\CategoryController;
use App\Http\Controllers\Admin\Market\CommentController;
use App\Http\Controllers\Admin\Market\DeliveryController;
use App\Http\Controllers\Admin\Market\DiscountController;
use App\Http\Controllers\Admin\Market\GalleryController;
use App\Http\Controllers\Admin\Market\OrderController;
use App\Http\Controllers\Admin\Market\PaymentController;
use App\Http\Controllers\Admin\Market\ProductController;
use App\Http\Controllers\Admin\Market\PropertyController;
use App\Http\Controllers\Admin\Market\StoreController;
use App\Http\Controllers\Admin\Notify\EmailController;
use App\Http\Controllers\Admin\Notify\EmailFileController;
use App\Http\Controllers\Admin\Notify\SMSController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Ticket\TicketController;
use App\Http\Controllers\Admin\User\AdminUserController;
use App\Http\Controllers\Admin\User\CustomerController;
use App\Http\Controllers\Admin\User\PermissionController;
use App\Http\Controllers\Admin\User\RoleController;
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

        //property
        Route::prefix('/property')->name('property.')->group(function () {
            Route::get('/', [PropertyController::class, 'index'])->name('index');
            Route::get('/create', [PropertyController::class, 'create'])->name('create');
            Route::post('/store', [PropertyController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PropertyController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PropertyController::class, 'destroy'])->name('destroy');
        });

        //store
        Route::prefix('/store')->name('store.')->group(function () {
            Route::get('/', [StoreController::class, 'index'])->name('index');
            Route::get('/add-to-store', [StoreController::class, 'addToStore'])->name('addToStore');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [StoreController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [StoreController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [StoreController::class, 'destroy'])->name('destroy');
        });
    });

    //content
    Route::prefix('/content')->namespace('Content')->name('content.')->group(function () {

        //category
        Route::prefix('/category')->name('category.')->group(function () {
            Route::get('/', [ContentCategoryController::class, 'index'])->name('index');
            Route::get('/create', [ContentCategoryController::class, 'create'])->name('create');
            Route::post('/store', [ContentCategoryController::class, 'store'])->name('store');
            Route::get('/edit/{postCategory}', [ContentCategoryController::class, 'edit'])->name('edit');
            Route::put('/update/{postCategory}', [ContentCategoryController::class, 'update'])->name('update');
            Route::delete('/destroy/{postCategory}', [ContentCategoryController::class, 'destroy'])->name('destroy');
            Route::get('/status/{postCategory}', [ContentCategoryController::class, 'status'])->name('status');
        });

        //comment
        Route::prefix('/comment')->name('comment.')->group(function () {
            Route::get('/', [ContentCommentController::class, 'index'])->name('index');
            Route::get('/show/{comment}', [ContentCommentController::class, 'show'])->name('show');
            Route::delete('/destroy/{comment}', [ContentCommentController::class, 'destroy'])->name('destroy');
            Route::get('/approved/{comment}', [ContentCommentController::class, 'approved'])->name('approved');
            Route::get('/status/{comment}', [ContentCommentController::class, 'status'])->name('status');
            Route::post('/answer/{comment}', [ContentCommentController::class, 'answer'])->name('answer');
        });

        //faq
        Route::prefix('/faq')->name('faq.')->group(function () {
            Route::get('/', [FAQController::class, 'index'])->name('index');
            Route::get('/create', [FAQController::class, 'create'])->name('create');
            Route::post('/store', [FAQController::class, 'store'])->name('store');
            Route::get('/edit/{faq}', [FAQController::class, 'edit'])->name('edit');
            Route::put('/update/{faq}', [FAQController::class, 'update'])->name('update');
            Route::delete('/destroy/{faq}', [FAQController::class, 'destroy'])->name('destroy');
            Route::get('/status/{faq}', [FAQController::class, 'status'])->name('status');

        });

        //menu
        Route::prefix('/menu')->name('menu.')->group(function () {
            Route::get('/', [MenuController::class, 'index'])->name('index');
            Route::get('/create', [MenuController::class, 'create'])->name('create');
            Route::post('/store', [MenuController::class, 'store'])->name('store');
            Route::get('/edit/{menu}', [MenuController::class, 'edit'])->name('edit');
            Route::put('/update/{menu}', [MenuController::class, 'update'])->name('update');
            Route::delete('/destroy/{menu}', [MenuController::class, 'destroy'])->name('destroy');
            Route::get('/status/{menu}', [MenuController::class, 'status'])->name('status');
        });

        //page
        Route::prefix('/page')->name('page.')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::get('/create', [PageController::class, 'create'])->name('create');
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/edit/{page}', [PageController::class, 'edit'])->name('edit');
            Route::put('/update/{page}', [PageController::class, 'update'])->name('update');
            Route::delete('/destroy/{page}', [PageController::class, 'destroy'])->name('destroy');
            Route::get('/status/{page}', [PageController::class, 'status'])->name('status');
        });

        //post
        Route::prefix('/post')->name('post.')->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::post('/store', [PostController::class, 'store'])->name('store');
            Route::get('/edit/{post}', [PostController::class, 'edit'])->name('edit');
            Route::put('/update/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('/destroy/{post}', [PostController::class, 'destroy'])->name('destroy');
            Route::get('/status/{post}', [PostController::class, 'status'])->name('status');
            Route::get('/commentable/{post}', [PostController::class, 'commentable'])->name('commentable');
        });
    });

    //user
    Route::prefix('/user')->namespace('User')->name('user.')->group(function () {

        //admin-user
        Route::prefix('/admin-user')->name('adminUser.')->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('index');
            Route::get('/create', [AdminUserController::class, 'create'])->name('create');
            Route::post('/store', [AdminUserController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [AdminUserController::class, 'edit'])->name('edit');
            Route::put('/update/{user}', [AdminUserController::class, 'update'])->name('update');
            Route::delete('/destroy/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
            Route::get('/activation/{user}', [AdminUserController::class, 'activation'])->name('activation');
            Route::get('/status/{user}', [AdminUserController::class, 'status'])->name('status');
        });

        //customer
        Route::prefix('/customer')->name('customer.')->group(function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/create', [CustomerController::class, 'create'])->name('create');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
            Route::get('/edit/{user}', [CustomerController::class, 'edit'])->name('edit');
            Route::put('/update/{user}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/destroy/{user}', [CustomerController::class, 'destroy'])->name('destroy');
            Route::get('/activation/{user}', [CustomerController::class, 'activation'])->name('activation');
            Route::get('/status/{user}', [CustomerController::class, 'status'])->name('status');
        });

        //role
        Route::prefix('/role')->name('role.')->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::get('/create', [RoleController::class, 'create'])->name('create');
            Route::post('/store', [RoleController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
        });

        //permission
        Route::prefix('/permission')->name('permission.')->group(function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::get('/create', [PermissionController::class, 'create'])->name('create');
            Route::post('/store', [PermissionController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [PermissionController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [PermissionController::class, 'update'])->name('update');
            Route::delete('/destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
        });
    });

    //notify
    Route::prefix('/notify')->namespace('Notify')->name('notify.')->group(function () {

        //email
        Route::prefix('/email')->name('email.')->group(function () {
            Route::get('/', [EmailController::class, 'index'])->name('index');
            Route::get('/create', [EmailController::class, 'create'])->name('create');
            Route::post('/store', [EmailController::class, 'store'])->name('store');
            Route::get('/edit/{email}', [EmailController::class, 'edit'])->name('edit');
            Route::put('/update/{email}', [EmailController::class, 'update'])->name('update');
            Route::delete('/destroy/{email}', [EmailController::class, 'destroy'])->name('destroy');
            Route::get('/status/{email}', [EmailController::class, 'status'])->name('status');
        });

        //email-file
        Route::prefix('/email-file')->name('email-file.')->group(function () {
            Route::get('/{email}', [EmailFileController::class, 'index'])->name('index');
            Route::get('/{email}/create', [EmailFileController::class, 'create'])->name('create');
            Route::post('/{email}/store', [EmailFileController::class, 'store'])->name('store');
            Route::get('/edit/{file}', [EmailFileController::class, 'edit'])->name('edit');
            Route::put('/update/{file}', [EmailFileController::class, 'update'])->name('update');
            Route::delete('/destroy/{file}', [EmailFileController::class, 'destroy'])->name('destroy');
            Route::get('/status/{file}', [EmailFileController::class, 'status'])->name('status');
        });

        //sms
        Route::prefix('/sms')->name('sms.')->group(function () {
            Route::get('/', [SMSController::class, 'index'])->name('index');
            Route::get('/create', [SMSController::class, 'create'])->name('create');
            Route::post('/store', [SMSController::class, 'store'])->name('store');
            Route::get('/edit/{sms}', [SMSController::class, 'edit'])->name('edit');
            Route::put('/update/{sms}', [SMSController::class, 'update'])->name('update');
            Route::delete('/destroy/{sms}', [SMSController::class, 'destroy'])->name('destroy');
            Route::get('/status/{sms}', [SMSController::class, 'status'])->name('status');
        });
    });

    //ticket
    Route::prefix('/ticket')->namespace('Ticket')->name('ticket.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/show', [TicketController::class, 'show'])->name('show');
        Route::post('/store', [TicketController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [TicketController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [TicketController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [TicketController::class, 'destroy'])->name('destroy');
        Route::get('/new-tickets', [TicketController::class, 'newTickets'])->name('newTickets');
        Route::get('/open-tickets', [TicketController::class, 'openTickets'])->name('openTickets');
        Route::get('/close-tickets', [TicketController::class, 'closeTickets'])->name('closeTickets');
    });

    //setting
    Route::prefix('/setting')->namespace('Setting')->name('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/edit/{setting}', [SettingController::class, 'edit'])->name('edit');
        Route::put('/update/{setting}', [SettingController::class, 'update'])->name('update');
        Route::delete('/destroy/{setting}', [SettingController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
