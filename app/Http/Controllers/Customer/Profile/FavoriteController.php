<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;

class FavoriteController extends Controller
{
    public function index()
    {
        $products = auth()->user()->products;
        return view('customer.profile.my-favorites', compact('products'));
    }

    public function delete(Product $product)
    {
        auth()->user()->products()->detach($product->id);
        return redirect()->route('profile.my-favorites.index')->with('swal-success', 'محصول از لیست علاقه مندی های شما پاک شد');
    }
}
