<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\BrandRequest;
use App\Http\Services\Image\ImageService;
use App\Models\Market\Brand;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.market.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.market.brand.create');
    }

    public function store(BrandRequest $request, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if ($result === false) {
                return redirect()->route('admin.market.brand.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        }
        Brand::create($inputs);
        return redirect()->route('admin.market.brand.index')
            ->with('swal-success', 'برند جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Brand $brand)
    {
        return view('admin.market.brand.edit', compact('brand'));
    }

    public function update(BrandRequest $request, Brand $brand, ImageService $imageService)
    {
        $inputs = $request->all();
        if ($request->hasFile('logo')) {
            if (!empty($brand->logo)) {
                $imageService->deleteDirectoryAndFiles($brand->logo['directory']);
            }
            $imageService->setExclusiveDirectory('images' . DIRECTORY_SEPARATOR . 'brand');
            $result = $imageService->createIndexAndSave($request->file('logo'));
            if ($result === false) {
                return redirect()->route('admin.market.brand.index')
                    ->with('swal-error', 'آپلود تصویر با خطا مواجه شد');
            }
            $inputs['logo'] = $result;
        } else {
            if (isset($inputs['currentImage']) && !empty($brand->logo)) {
                $logo = $brand->logo;
                $logo['currentImage'] = $inputs['currentImage'];
                $inputs['logo'] = $logo;
            }
        }
        $brand->update($inputs);
        return redirect()->route('admin.market.brand.index')
            ->with('swal-success', 'برند با موفقیت ویرایش شد');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect(route('admin.market.brand.index'))
            ->with('swal-success', 'برند با موفقیت حذف شد');
    }

    public function status(Brand $brand)
    {
        $brand->status = $brand->status == 0 ? 1 : 0;
        $result = $brand->save();
        if ($result) {
            if ($brand->status == 0) {
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
