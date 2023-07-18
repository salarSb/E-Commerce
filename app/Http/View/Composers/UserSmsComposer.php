<?php

namespace App\Http\View\Composers;

use App\Models\User;

class UserSmsComposer
{
    public function compose($view)
    {
        $view->with('users', User::whereNotNull('mobile')->whereNotNull('mobile_verified_at')->get());
    }
}
