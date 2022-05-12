<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use App\Models\Market\ProductColor;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    public function index(Product $product)
    {
        return view('admin.market.product.color.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.color.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'color' => ['required', 'max:120'],
            'price_increase' => ['required', 'numeric'],
            'status' => ['required', 'numeric', 'in:0,1'],
        ]);
        $inputs = $request->all();
        $product->colors()->create($inputs);
        return redirect()->route('admin.market.product.color.index', $product->slug)
            ->with('swal-success', 'رنگ جدید با موفقیت ساخته شد');
    }

    public function destroy(Product $product, ProductColor $color)
    {
        $color->delete();
        return redirect(route('admin.market.product.color.index', $product->slug))
            ->with('swal-success', 'رنگ کالا با موفقیت حذف شد');
    }

    public function status(ProductColor $color)
    {
        $color->status = $color->status == 0 ? 1 : 0;
        $result = $color->save();
        if ($result) {
            if ($color->status == 0) {
                return response()->json([
                    'status' => true,
                    'checked' => false
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'checked' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }
}
