<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): Factory|View|Application
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

    public function products(Request $request): Factory|View|Application
    {
//        TODO : when a product sold make sold number increase by one
//        TODO : when a user or an ip sees a product it view must increase
        $brands = Brand::status(1)->get();
        [$column, $direction] = match ((int)$request->query('sort')) {
            1 => ['created_at', 'DESC'],
            2 => ['price', 'DESC'],
            3 => ['price', 'ASC'],
            4 => ['view', 'DESC'],
            5 => ['sold_number', 'DESC'],
            default => ['created_at', 'ASC'],
        };
        if ($request->query('search')) {
            $query = Product::search($request->query('search'));
        } else {
            $query = Product::query();
        }
        $builder = $request->query('min_price') && $request->query('max_price') ? $query->whereBetween(
            'price',
            [
                $request->query('min_price'),
                $request->query('max_price')
            ]
        ) : $query->when($request->query('min_price'), function ($query) use ($request) {
            $query->where('price', '>=', $request->query('min_price'));
        })->when($request->query('max_price'), function ($query) use ($request) {
            $query->where('price', '<=', $request->query('max_price'));
        });
        $builder->when($request->query('brands'), function ($query) use ($request) {
            $query->whereIn('brand_id', $request->query('brands'));
        });
        $products = $builder->status(1)->orderBy($column, $direction)->paginate()->withQueryString();
        $selectedBrands = $request->query('brands') ? $brands->whereIn('id', $request->query('brands'))->pluck('original_name')->toArray() : [];
        return view('customer.market.products', compact('products', 'brands', 'selectedBrands'));
    }

    public function getBrands(Request $request)
    {
        $brands = Brand::status(1)->search($request->query('brand_search'))->get();
        if (!empty($brands)) {
            return response()->json([
                'status' => true,
                'brands' => $brands,
            ]);
        }
        return response()->json([
            'status' => false,
            'cities' => null,
        ]);
    }
}
