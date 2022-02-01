<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Gallery;
use App\Models\Market\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Product $product)
    {
        return view('admin.market.product.gallery.index', compact('product'));
    }

    public function create(Product $product)
    {
        return view('admin.market.product.gallery.create', compact('product'));
    }

    public function store(Request $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->all();
        $request->validate([
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg,gif'],
        ]);
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-gallery');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.product.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        $product->images()->create($inputs);
        return redirect()->route('admin.market.product.gallery.index', $product->slug)
            ->with('swal-success', 'عکس جدید با موفقیت ثبت شد');
    }

    public function destroy(Product $product, Gallery $gallery)
    {
        $gallery->delete();
        return redirect(route('admin.market.product.gallery.index', $product->slug))
            ->with('swal-success', 'عکس کالا با موفقیت حذف شد');
    }
}
