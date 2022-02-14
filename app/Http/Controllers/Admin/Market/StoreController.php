<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\StoreRequest;
use App\Models\Market\Product;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::latest()->simplePaginate(15);
        return view('admin.market.store.index', compact('products'));
    }

    public function addToStore(Product $product)
    {
        return view('admin.market.store.add-to-store', compact('product'));
    }

    public function store(StoreRequest $request, Product $product)
    {
        $product->marketable_number += $request->marketable_number;
        $product->save();
        Log::info("receiver => {$request->receiver}, deliverer => {$request->deliverer}, description => {$request->description}, add => {$request->marketable_number}");
        return redirect()->route('admin.market.store.index')->with('swal-success', "به تعداد {$request->marketable_number} عدد به موجودی کالای {$product->name} اضافه شد");
    }

    public function edit(Product $product)
    {
        return view('admin.market.store.edit', compact('product'));
    }

    public function update(StoreRequest $request, Product $product)
    {
        $inputs = $request->all();
        $product->update($inputs);
        return redirect()->route('admin.market.store.index')->with('swal-success', 'موجودی با موفقیت ویرایش شد');
    }
}
