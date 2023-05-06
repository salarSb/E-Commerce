<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\ProductCategoryRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\ProductCategory;

class CategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.category.index', compact('productCategories'));
    }

    public function create()
    {
        $productCategories = ProductCategory::active()->get();
        return view('admin.market.category.create', compact('productCategories'));
    }

    public function store(ProductCategoryRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-categories');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.category.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        }
        ProductCategory::create($inputs);
        return redirect()->route('admin.market.category.index')
            ->with('swal-success', 'دسته بندی جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(ProductCategory $productCategory)
    {
        $parent_categories = ProductCategory::active()->get()->except($productCategory->id);
        return view('admin.market.category.edit', compact('productCategory', 'parent_categories'));
    }

    public function update(ProductCategoryRequest $request, ProductCategory $productCategory, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('image')) {
            if (!empty($productCategory->image)) {
                $imageService->deleteDirectoryAndFiles($productCategory->image['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'product-categories');
            $result = $imageService->createIndexAndSave($request->file('image'));
            if ($result === false) {
                return redirect()->route('admin.market.category.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['image'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($productCategory->image)) {
                $image = $productCategory->image;
                $image['currentImage'] = $inputs['currentImage'];
                $inputs['image'] = $image;
            }
        }
        $productCategory->update($inputs);
        return redirect()->route('admin.market.category.index')
            ->with('swal-success', 'دسته بندی با موفقیت ویرایش شد');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return redirect(route('admin.market.category.index'))
            ->with('swal-success', 'دسته بندی با موفقیت حذف شد');
    }

    public function status(ProductCategory $productCategory)
    {
        $productCategory->status = $productCategory->status == 0 ? 1 : 0;
        $result = $productCategory->save();
        if ($result) {
            if ($productCategory->status == 0) {
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

    public function showInMenu(ProductCategory $productCategory)
    {
        $productCategory->show_in_menu = $productCategory->show_in_menu == 0 ? 1 : 0;
        $result = $productCategory->save();
        if ($result) {
            if ($productCategory->show_in_menu == 0) {
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
