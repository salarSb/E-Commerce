<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $slideShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();

        $brands = Brand::where('status', 1)->get();

        //TODO : get most visited products and show them with lazy loading
        $mostVisitedProducts = Product::latest()->take(10)->get();

        //we can take most commented products or most sold products we take last 10 for now
        $offeredProducts = Product::latest()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'middleBanners',
            'bottomBanner', 'brands', 'mostVisitedProducts', 'offeredProducts'));
    }

    public function products(Request $request)
    {
        if ($request->query('search')) {
            $products = Product::search($request->query('search'))->latest()->get();
        } else {
            $products = Product::all();
        }
        return view('customer.market.products', compact('products'));
    }
}
