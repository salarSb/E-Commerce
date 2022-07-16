<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\DeiveryRequest;
use App\Models\Market\Delivery;

class DeliveryController extends Controller
{
    public function index()
    {
        $delivery_methods = Delivery::all();
        return view('admin.market.delivery.index', compact('delivery_methods'));
    }

    public function create()
    {
        return view('admin.market.delivery.create');
    }

    public function store(DeiveryRequest $request)
    {
        $inputs = $request->all();
        Delivery::create($inputs);
        return redirect()->route('admin.market.delivery.index')
            ->with('swal-success', 'روش ارسال جدید با موفقیت ثبت شد');
    }

    public function show($id)
    {
        //
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.market.delivery.edit', compact('delivery'));
    }

    public function update(DeiveryRequest $request, Delivery $delivery)
    {
        $inputs = $request->all();
        $delivery->update($inputs);
        return redirect()->route('admin.market.delivery.index')
            ->with('swal-success', 'روش ارسال با موفقیت ویرایش شد');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        return redirect()->route('admin.market.delivery.index')
            ->with('swal-success', 'روش ارسال با موفقیت حذف شد');
    }

    public function status(Delivery $delivery)
    {
        $delivery->status = $delivery->status == 0 ? 1 : 0;
        $result = $delivery->save();
        if ($result) {
            if ($delivery->status == 0) {
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
