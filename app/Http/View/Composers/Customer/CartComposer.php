<?php

namespace App\Http\View\Composers\Customer;

use App\Models\Market\CartItem;
use Illuminate\Support\Facades\Auth;

class CartComposer
{
    public function compose($view)
    {
        if (Auth::check()) {
            $view->with('cartItems', CartItem::where('user_id', auth()->user()->id)->get());
        }
    }
}
