<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Content\Banner;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(): Factory|View|Application
    {
        $slideShowImages = Banner::where('position', 0)->where('status', 1)->get();
        $topBanners = Banner::where('position', 1)->where('status', 1)->take(2)->get();
        $middleBanners = Banner::where('position', 2)->where('status', 1)->take(2)->get();
        $bottomBanner = Banner::where('position', 3)->where('status', 1)->first();

        //TODO : get special brands. taking last 10 for now
        $brands = Brand::status(1)->limit(10)->get();

        //TODO : get most visited products and show them with lazy loading
        $mostVisitedProducts = Product::latest()->take(10)->get();

        //TODO : we can take most commented products or most sold products we take last 10 for now
        $offeredProducts = Product::latest()->take(10)->get();
        return view('customer.home', compact('slideShowImages', 'topBanners', 'middleBanners',
            'bottomBanner', 'brands', 'mostVisitedProducts', 'offeredProducts'));
    }

    public function products(Request $request, ?ProductCategory $category = null): Factory|View|Application
    {
//        TODO : when a product sold make sold number increase by one
//        TODO : when a user or an ip sees a product it view must increase
//        TODO : if a category has no products and is parent of other categories build a page to show its children categories that has products
        $brands = Brand::status(1)->get();
        $categories = ProductCategory::active()->whereNull('parent_id')->get();
        [$column, $direction] = match ((int)$request->query('sort')) {
            1 => ['created_at', 'DESC'],
            2 => ['price', 'DESC'],
            3 => ['price', 'ASC'],
            4 => ['view', 'DESC'],
            5 => ['sold_number', 'DESC'],
            default => ['created_at', 'ASC'],
        };
        $productModel = $category ? $category->products() : Product::query();
        if ($request->query('search')) {
            $productModel = $productModel->search($request->query('search'));
        }
        $builder = $request->query('min_price') && $request->query('max_price') ? $productModel->whereBetween(
            'price',
            [
                $request->query('min_price'),
                $request->query('max_price')
            ]
        ) : $productModel->when($request->query('min_price'), function ($query) use ($request) {
            $query->where('price', '>=', $request->query('min_price'));
        })->when($request->query('max_price'), function ($query) use ($request) {
            $query->where('price', '<=', $request->query('max_price'));
        });
        $builder->when($request->query('brands'), function ($query) use ($request) {
            $query->whereIn('brand_id', $request->query('brands'));
        });
        $products = $builder->status(1)->orderBy($column, $direction)->paginate(12)->withQueryString();
        $selectedBrands = $request->query('brands') ? $brands->whereIn('id', $request->query('brands'))->pluck('original_name')->toArray() : [];
        return view('customer.market.products', compact('products', 'brands', 'selectedBrands', 'categories', 'category'));
    }

    public function getBrands(Request $request): JsonResponse
    {
        $brands = Brand::status(1)->search($request->query('brand_search'))->get();
        if ($brands->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'brands' => $brands,
            ]);
        }
        return response()->json([
            'status' => false,
            'brands' => null,
        ]);
    }
}
