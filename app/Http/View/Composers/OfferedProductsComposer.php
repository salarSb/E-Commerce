<?php

namespace App\Http\View\Composers;

use App\Models\Market\Product;

class OfferedProductsComposer
{
    public function compose($view)
    {
        $view->with('offeredProducts', Product::status(1)->orderBy('sold_number', 'DESC')->take(10)->get());
    }
}
