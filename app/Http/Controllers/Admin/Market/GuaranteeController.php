<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Guarantee;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{

    public function index(Product $product)
    {
        return view('admin.market.product.guarantee.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.guarantee.create', compact('product'));
    }

    public function store(Request $request,Product $product)
    {
        $inputs = $request->all();
        $request->validate([
            'name' => 'required',
            'price_increase' => ['required', 'numeric'],
        ]);
        $product->guarantees()->create($inputs);
        return redirect()->route('admin.market.product.guarantee.index', $product->slug)
            ->with('swal-success', 'گارانتی جدید با موفقیت ثبت شد');
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Product $product, Guarantee $guarantee)
    {
        $guarantee->delete();
        return redirect(route('admin.market.product.guarantee.index', $product->slug))
            ->with('swal-success', 'گارانتی کالا با موفقیت حذف شد');
    }

    public function status(Guarantee $guarantee)
    {
        $guarantee->status = $guarantee->status == 0 ? 1 : 0;
        $result = $guarantee->save();
        if ($result) {
            if ($guarantee->status == 0) {
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
