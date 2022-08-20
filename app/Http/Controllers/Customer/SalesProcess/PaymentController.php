<?php

namespace App\Http\Controllers\Customer\Salesprocess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\CouponDiscountRequest;
use App\Models\Market\Coupon;

class PaymentController extends Controller
{
    public function payment()
    {
        return view('customer.sales-process.payment');
    }

    public function couponDiscount(CouponDiscountRequest $request)
    {
        $coupon = Coupon::validCoupons()->where('code', $request->input('code'))->first();
        if (is_null($coupon)) {
            return back()->withErrors([
                'code' => 'کد معتبر نمی باشد',
            ]);
        }
        if (!is_null($coupon->user_id)) {
            $coupon = Coupon::validUserCoupons()->where('code', $request->input('code'))->first();
            if (is_null($coupon)) {
                return back()->withErrors([
                    'code' => 'کد معتبر نمی باشد',
                ]);
            }
        }
        $order = auth()->user()->orders()->where('order_status', 0)->whereNull('coupon_id')->first();
        if (!is_null($order)) {
            $couponDiscountAmount = $coupon->amount_type === 0 ? $order->order_final_amount * ($coupon->amount / 100) : $coupon->amount;
            $couponDiscountAmount = min($couponDiscountAmount, $coupon->discount_ceiling);
            $order->update([
                'coupon_id' => $coupon->id,
                'order_final_amount' => $order->order_final_amount - $couponDiscountAmount,
                'order_coupon_discount_amount' => $couponDiscountAmount,
                'order_total_products_discount_amount' => $order->order_total_products_discount_amount + $couponDiscountAmount,
            ]);
            return back()->with('swal-success', 'کد تخفیف اعمال شد');
        }
        return back()->with('swal-error', 'برای این سفارش قبلا کد تخفیف اعمال شده است');
    }
}
