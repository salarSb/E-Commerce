<?php

namespace App\Http\View\Composers;

use App\Models\Notification;

class NotificationComposer
{
    public function compose($view)
    {
        $view->with('notifications', Notification::where('read_at', null)->get());
    }
}
