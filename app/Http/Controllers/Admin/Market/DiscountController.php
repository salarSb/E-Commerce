<?php

namespace App\Http\Controllers\Admin\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Market\AmazingSaleRequest;
use App\Http\Requests\Admin\Market\CommonDiscountRequest;
use App\Http\Requests\Admin\Market\CouponRequest;
use App\Models\Market\AmazingSale;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Coupon;
use App\Models\Market\Product;
use App\Models\User;

class DiscountController extends Controller
{
    public function coupon()
    {
        $coupons = Coupon::all();
        return view('admin.market.discount.coupon', compact('coupons'));
    }

    public function couponCreate()
    {
        $users = User::all();
        return view('admin.market.discount.coupon-create', compact('users'));
    }

    public function couponStore(CouponRequest $request)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        if ($inputs['type'] == 0) {
            $inputs['user_id'] = null;
        }
        Coupon::create($inputs);
        return redirect()->route('admin.market.discount.coupon.index')
            ->with('swal-success', 'کوپن تخفیف با موفقیت ثبت شد');
    }

    public function couponEdit(Coupon $coupon)
    {
        $users = User::all();
        return view('admin.market.discount.coupon-edit', compact('coupon', 'users'));
    }

    public function couponUpdate(CouponRequest $request, Coupon $coupon)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        $coupon->update($inputs);
        return redirect()->route('admin.market.discount.coupon.index')
            ->with('swal-success', 'کوپن تخفیف با موفقیت ویرایش شد');
    }

    public function couponDestroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('admin.market.discount.coupon.index')
            ->with('swal-success', 'کوپن تخفیف با موفقیت حذف شد');
    }

    public function couponStatus(Coupon $coupon)
    {
        $coupon->status = $coupon->status == 0 ? 1 : 0;
        $result = $coupon->save();
        if ($result) {
            if ($coupon->status == 0) {
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

    public function commonDiscount()
    {
        $commonDiscounts = CommonDiscount::latest()->get();
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

    public function commonDiscountUpdate(CommonDiscountRequest $request, CommonDiscount $commonDiscount)
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
        $amazingSales = AmazingSale::all();
        return view('admin.market.discount.amazing-sale', compact('amazingSales'));
    }

    public function amazingSaleCreate()
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-sale-create', compact('products'));
    }

    public function amazingSaleStore(AmazingSaleRequest $request)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        AmazingSale::create($inputs);
        return redirect()->route('admin.market.discount.amazingSale.index')
            ->with('swal-success', 'فروش شگفت انگیز با موفقیت ثبت شد');
    }

    public function amazingSaleEdit(AmazingSale $amazingSale)
    {
        $products = Product::all();
        return view('admin.market.discount.amazing-sale-edit', compact('amazingSale', 'products'));
    }

    public function amazingSaleUpdate(AmazingSaleRequest $request, AmazingSale $amazingSale)
    {
        $inputs = $request->all();
        $realTimeStampStart = substr($request->start_date, 0, 10);
        $inputs['start_date'] = date('Y-m-d H:m:s', (int)$realTimeStampStart);
        $realTimeStampEnd = substr($request->end_date, 0, 10);
        $inputs['end_date'] = date('Y-m-d H:m:s', (int)$realTimeStampEnd);
        $amazingSale->update($inputs);
        return redirect()->route('admin.market.discount.amazingSale.index')
            ->with('swal-success', 'فروش شگفت انگیز با موفقیت ویرایش شد');
    }

    public function amazingSaleDestroy(AmazingSale $amazingSale)
    {
        $amazingSale->delete();
        return redirect()->route('admin.market.discount.amazingSale.index')
            ->with('swal-success', 'فروش شگفت انگیز با موفقیت حذف شد');
    }

    public function amazingSaleStatus(AmazingSale $amazingSale)
    {
        $amazingSale->status = $amazingSale->status == 0 ? 1 : 0;
        $result = $amazingSale->save();
        if ($result) {
            if ($amazingSale->status == 0) {
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
