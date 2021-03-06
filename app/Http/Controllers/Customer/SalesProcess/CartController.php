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
        $cartItems = CartItem::where('user_id', auth()->user()->id)->get();

        // TODO : get related products with lazy loading
        $relatedProducts = Product::all();
        return view('customer.sales-process.cart', compact('cartItems', 'relatedProducts'));
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
            if ($cartItem->color_id === (int)$request->color_id && $cartItem->guarantee_id === (int)$request->guarantee_id) {
                if ($cartItem->number !== (int)$request->number) {
                    $cartItem->update([
                        'number' => (int)$request->number
                    ]);
                    return back()->with('swal-success', '?????? ?????????? ???? ?????? ?????????? ???? ?????? ???? ?????? ???????? ?????? ???????? ???????? ???? ?????????? ???? ?????????????????? ????');
                }
                return back()->with('swal-error', '?????? ?????????? ???? ?????? ?????????? ???? ?????? ???? ?????? ???????? ?????? ???????? ????????');
            }
        }
        $inputs = $request->all();
        $cartItem = auth()->user()->cartItems()->make($inputs);
        $cartItem->product()->associate($product);
        $cartItem->save();
        return back()->with('swal-success', '?????????? ???????? ?????? ???? ???????????? ???? ?????? ???????? ?????????? ????');
    }

    public function removeFromCart(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('swal-success', '?????????? ???? ?????? ???????? ?????? ????');
    }
}
