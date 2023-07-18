<?php

namespace App\Providers;

use App\Http\View\Composers\CommentComposer;
use App\Http\View\Composers\Customer\CartComposer;
use App\Http\View\Composers\NotificationComposer;
use App\Http\View\Composers\OfferedProductsComposer;
use App\Http\View\Composers\UserEmailComposer;
use App\Http\View\Composers\UserSmsComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layouts.header', CommentComposer::class);
        View::composer('admin.layouts.header', NotificationComposer::class);
        View::composer([
            'customer.layouts.header',
            'customer.sales-process.cart',
            'customer.sales-process.address-and-delivery',
            'customer.sales-process.payment'
        ], CartComposer::class);
        View::composer(['customer.home', 'customer.market.product.product'], OfferedProductsComposer::class);
        View::composer(['admin.notify.email.create', 'admin.notify.email.edit'], UserEmailComposer::class);
        View::composer(['admin.notify.sms.create', 'admin.notify.sms.edit'], UserSmsComposer::class);
    }
}
