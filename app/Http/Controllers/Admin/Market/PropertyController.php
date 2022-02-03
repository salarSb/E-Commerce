<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryAttributeRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\ProductCategory;

class PropertyController extends Controller
{
    public function index()
    {
        $category_attributes = CategoryAttribute::all();
        return view('admin.market.property.index', compact('category_attributes'));
    }

    public function create()
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.create', compact('productCategories'));
    }

    public function store(CategoryAttributeRequest $request)
    {
        $inputs = $request->all();
        CategoryAttribute::create($inputs);
        return redirect()->route('admin.market.property.index')
            ->with('swal-success', 'فرم جدید با موفقیت ثبت شد');
    }

    public function edit(CategoryAttribute $categoryAttribute)
    {
        $productCategories = ProductCategory::all();
        return view('admin.market.property.edit',
            compact('categoryAttribute', 'productCategories'));
    }

    public function update(CategoryAttributeRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->all();
        $categoryAttribute->update($inputs);
        return redirect()->route('admin.market.property.index')
            ->with('swal-success', 'فرم با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $categoryAttribute)
    {
        $categoryAttribute->delete();
        return redirect(route('admin.market.property.index'))
            ->with('swal-success', 'فرم با موفقیت حذف شد');
    }
}
