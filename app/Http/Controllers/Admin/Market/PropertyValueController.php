<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CategoryValueRequest;
use App\Models\Market\CategoryAttribute;
use App\Models\Market\CategoryValue;

class PropertyValueController extends Controller
{
    public function index(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.index', compact('categoryAttribute'));
    }

    public function create(CategoryAttribute $categoryAttribute)
    {
        return view('admin.market.property.value.create', compact('categoryAttribute'));
    }

    public function store(CategoryValueRequest $request, CategoryAttribute $categoryAttribute)
    {
        $inputs = $request->except('value', 'price_increase');
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase,
        ]);
        $categoryAttribute->values()->create($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)
            ->with('swal-success', 'مقدار جدید با موفقیت ساخته شد');
    }

    public function edit(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        return view('admin.market.property.value.edit', compact('categoryAttribute', 'value'));
    }

    public function update(CategoryValueRequest $request, CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $inputs = $request->except('value', 'price_increase');
        $inputs['value'] = json_encode([
            'value' => $request->value,
            'price_increase' => $request->price_increase,
        ]);
        $value->update($inputs);
        return redirect()->route('admin.market.property.value.index', $categoryAttribute->id)
            ->with('swal-success', 'مقدار جدید با موفقیت ویرایش شد');
    }

    public function destroy(CategoryAttribute $categoryAttribute, CategoryValue $value)
    {
        $value->delete();
        return redirect(route('admin.market.property.value.index', $categoryAttribute->id))
            ->with('swal-success', 'مقدار فرم کالا با موفقیت حذف شد');
    }
}
