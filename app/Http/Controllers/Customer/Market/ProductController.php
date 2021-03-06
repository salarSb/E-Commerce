<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Models\Market\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['addComment']);
    }

    public function product(Product $product)
    {
        // TODO : get related products correctly and with lazy loading
        $relatedProducts = Product::all();

        return view('customer.market.product.product', compact('product', 'relatedProducts'));
    }

    public function addComment(Request $request, Product $product)
    {
        $request->validate([
            'body' => ['required', 'max:3000'],
        ]);
        $inputs['body'] = str_replace(PHP_EOL, '<br/>', $request->input('body'));
        $comment = auth()->user()->comments()->make([
            'body' => $inputs['body'],
        ]);
        $comment->commentable()->associate($product);
        $comment->save();
        return redirect()->route('customer.market.product', $product->slug)
            ->with('swal-success', 'نظر شما ثبت شد و پس از تایید برای مشاهده قرار می گیرد');
    }

    public function addToFavorite(Product $product)
    {
        if (Auth::check()) {
            $product->users()->toggle([Auth::user()->id]);
            if ($product->users->contains('id', Auth::user()->id)) {
                return response()->json([
                    'status' => 1,
                ]);
            } else {
                return response()->json([
                    'status' => 2,
                ]);
            }
        } else {
            return response()->json([
                'status' => 3,
            ]);
        }
    }
}
