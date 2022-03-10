<?php

namespace App\Http\View\Composers;

use App\Models\Content\Comment;

class CommentComposer
{
    public function compose($view)
    {
        $view->with('unseenComments', Comment::where('seen', 0)->get());
    }
}
