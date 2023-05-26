<?php

namespace App\Http\Controllers\Customer\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\AddRateRequest;
use App\Models\Market\Compare;
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
        $compare = Auth::user()->compare;
        return view('customer.market.product.product', compact('product', 'relatedProducts', 'compare'));
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

    public function addRate(AddRateRequest $request, Product $product)
    {
        $user = auth()->user();
        if ($user->isPurchasedProduct($product->id)) {
            auth()->user()->rate($product, $request->input('rating'));
            return back()->with('swal-success', 'امتیاز شما با موفقیت ثبت گردید');
        }
        return back()->with('swal-error', 'برای ثبت امتیاز باید محصول را خریده باشید');
    }

    public function addToCompare(Product $product)
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $compare = Compare::firstOrCreate(['user_id' => $userId]);
            $product->compares()->toggle([$compare->id]);
            if ($product->compares->contains('id', $compare->id)) {
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
