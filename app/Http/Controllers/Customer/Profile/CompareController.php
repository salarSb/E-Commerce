<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;

class CompareController extends Controller
{
    public function index()
    {
        $products = auth()->user()->compare->products;
        return view('customer.profile.compares', compact('products'));
    }

    public function delete(Product $product)
    {
        $compare = auth()->user()->compare;
        $compare->products()->detach($product->id);
        return back();
    }
}
