<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Models\Market\CommonDiscount;

class DiscountController extends Controller
{
    public function coupon()
    {
        return view('admin.market.discount.coupon');
    }

    public function couponCreate()
    {
        return view('admin.market.discount.coupon-create');
    }

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::all();
        return view('admin.market.discount.common-discount', compact('commonDiscounts'));
    }

    public function commonDiscountCreate()
    {
        return view('admin.market.discount.common-discount-create');
    }

    public function commonDiscountStore(CommonDiscountRequest $request)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        CommonDiscount::create($inputs);
        return redirect()->route('admin.market.discount.commonDiscount.index')
            ->with('swal-success', 'تخفیف عمومی با موفقیت ثبت شد');
    }

    public function commonDiscountEdit(CommonDiscount $commonDiscount)
    {
        return view('admin.market.discount.common-discount-edit', compact('commonDiscount'));
    }

    public function commonDiscountupdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        $commonDiscount->update($inputs);
        return redirect()->route('admin.market.discount.commonDiscount.index')
            ->with('swal-success', 'تخفیف عمومی با موفقیت ویرایش شد');
    }

    public function commonDiscountDestroy(CommonDiscount $commonDiscount)
    {
        $commonDiscount->delete();
        return redirect()->route('admin.market.discount.commonDiscount.index')
            ->with('swal-success', 'تخفیف عمومی با موفقیت حذف شد');
    }

    public function commonDiscountStatus(CommonDiscount $commonDiscount)
    {
        $commonDiscount->status = $commonDiscount->status == 0 ? 1 : 0;
        $result = $commonDiscount->save();
        if ($result) {
            if ($commonDiscount->status == 0) {
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

    public function amazingSale()
    {
        return view('admin.market.discount.amazing-sale');
    }

    public function amazingSaleCreate()
    {
        return view('admin.market.discount.amazing-sale-create');
    }
}
