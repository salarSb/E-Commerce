<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function cart()
    {
        // TODO : get related products with multi select options that selects products you want to show if user adds this product to cart
        $relatedProducts = Product::all();
        return view('customer.sales-process.cart', compact( 'relatedProducts'));
    }

    public function updateCart(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'number.*' => ['required', 'integer', 'min:1', 'max:5']
        ]);
        if ($validate->fails()) {
            return back()->with('swal-error', $validate->errors());
        }
        $inputs = $request->all();
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();
        foreach ($cartItems as $cartItem) {
            if (isset($inputs['number'][$cartItem->id])) {
                $cartItem->update([
                    'number' => $inputs['number'][$cartItem->id],
                ]);
            }
        }
        return redirect()->route('customer.sales-process.address-and-delivery');
    }

    public function addToCart(Product $product, Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->user()->id)->where('product_id', $product->id)->get();
        if (!isset($request->color)) {
            $request->color = null;
        }
        if (!isset($request->guarantee)) {
            $request->guarantee = null;
        }
        foreach ($cartItems as $cartItem) {
            if ($cartItem->color_id == $request->color_id && $cartItem->guarantee_id == $request->guarantee_id) {
                if ($cartItem->number != $request->number) {
                    $cartItem->update([
                        'number' => (int)$request->number
                    ]);
                    return back()->with('swal-success', 'این محصول با این تعداد از قبل در سبد خرید شما قرار داشت که تعداد آن بروزرسانی شد');
                }
                return back()->with('swal-error', 'این محصول با این تعداد از قبل در سبد خرید شما قرار دارد');
            }
        }
        $inputs = $request->all();
        $cartItem = auth()->user()->cartItems()->make($inputs);
        $cartItem->product()->associate($product);
        $cartItem->save();
        return back()->with('swal-success', 'محصول مورد نظر با موفقیت به سبد خرید اضافه شد');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('swal-success', 'محصول از سبد خرید حذف شد');
    }
}
