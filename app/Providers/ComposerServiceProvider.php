<?php

namespace App\Providers;

use App\Http\View\Composers\CommentComposer;
use App\Http\View\Composers\NotificationComposer;
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
    }
}
