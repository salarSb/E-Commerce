<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;
use App\Models\Market\Product;
use App\Models\Market\ProductCategory;
use App\Models\Market\ProductMeta;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->simplePaginate(15);
        return view('admin.market.product.index', compact('products'));
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.create', compact(['productCategories', 'brands']));
    }

    public function store(ProductRequest $request, ImageService $imageService)
    {
        $inputs = $request->except('meta_key', 'meta_value');
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.product.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        DB::transaction(function () use ($request, $inputs) {
            $product = Product::create($inputs);
            $metas = array_combine($request->meta_key, $request->meta_value);
            foreach ($metas as $key => $value) {
                $product->metas()->create([
                    'meta_key' => $key,
                    'meta_value' => $value
                ]);
            }
        });
        return redirect()->route('admin.market.product.index')
            ->with('swal-success', 'کالای جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Product $product)
    {
        $productCategories = ProductCategory::all();
        $brands = Brand::all();
        return view('admin.market.product.edit', compact(['product', 'productCategories', 'brands']));
    }

    public function update(ProductRequest $request, Product $product, ImageService $imageService)
    {
        $inputs = $request->except('meta_key', 'meta_value');
        $realTimeStampStart = substr($request->published_at, 0, 10);
        $inputs['published_at'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        if ($request->hasFile('image')) {
            if (!empty($product->image)) {
                $imageService->deleteDirectoryAndFiles($product->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.product.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($product->image)) {
                $image = $product->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $product->update($inputs);
        $meta_keys = $request->meta_key;
        $meta_values = $request->meta_value;
        $meta_ids = array_keys($request->meta_key);
        $metas = array_map(function ($meta_id, $meta_key, $meta_value) {
            return array_combine(
                ['meta_id', 'meta_key', 'meta_value'],
                [$meta_id, $meta_key, $meta_value]
            );
        }, $meta_ids, $meta_keys, $meta_values);
        foreach ($metas as $meta) {
            ProductMeta::where('id', $meta['meta_id'])->update([
                'meta_key' => $meta['meta_key'],
                'meta_value' => $meta['meta_value'],
            ]);
        }
        return redirect()->route('admin.market.product.index')
            ->with('swal-success', 'کالا با موفقیت ویرایش شد');
    }

    public function destroy(Product $product)
    {
        //we wont delete image in destroy method because we use soft delete
        $product->delete();
        return redirect(route('admin.market.product.index'))
            ->with('swal-success', 'کالا با موفقیت حذف شد');
    }

    public function status(Product $product)
    {
        $product->status = $product->status == 0 ? 1 : 0;
        $result = $product->save();
        if ($result) {
            if ($product->status == 0) {
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

    public function marketable(Product $product)
    {
        $product->marketable = $product->marketable == 0 ? 1 : 0;
        $result = $product->save();
        if ($result) {
            if ($product->marketable == 0) {
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
