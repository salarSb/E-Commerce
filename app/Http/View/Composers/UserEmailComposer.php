<?php

namespace App\Http\View\Composers;

use App\Models\User;

class UserEmailComposer
{
    public function compose($view)
    {
        $view->with('users', User::whereNotNull('email')->whereNotNull('email_verified_at')->get());
    }
}
