<?php

namespace App\Http\Controllers\Customer\Salesprocess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\CouponDiscountRequest;
use App\Http\Requests\Customer\SalesProcess\PaymentSubmitRequest;
use App\Models\Market\CashPayment;
use App\Models\Market\Coupon;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function payment()
    {
        $user = auth()->user();
        $order = $user->orders()->where('order_status', 0)->firstOrFail();
        return view('customer.sales-process.payment', compact('order'));
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
        $order = Order::userOpenOrder()->whereNull('coupon_id')->first();
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

    public function paymentSubmit(PaymentSubmitRequest $request)
    {
        $user = auth()->user();
        $order = Order::userOpenOrder()->first();
        $cartItems = $user->cartItems;
        switch ($request->input('payment_type')) {
            case '1':
                $targetModel = OnlinePayment::class;
                $type = 0;
                break;
            case '2':
                $targetModel = OfflinePayment::class;
                $type = 1;
                break;
            case '3':
                $targetModel = CashPayment::class;
                $type = 2;
                break;
            default:
                return back()->withErrors('payment_type', 'نحوه ی پرداخت معتبر نیست');
        }
        DB::beginTransaction();

        // TODO : when order approved the order_status mast take value=3
        $order->update([
            'order_status' => 1,
        ]);

        // TODO : in offline and cash payments after the payment has been paid the pay_date has to take value
        // TODO : in offline payments transaction_id had to take value
        // TODO : in cash payments cash_receiver must take value
        $paymented = $targetModel::create([
            'amount' => $order->order_final_amount,
            'user_id' => $user->id,
            'status' => 1,
        ]);

        // TODO : in offline and cash payments after the payment has been paid the status has to take value=1(paid)
        $paymented->payments()->create([
            'amount' => $paymented->amount,
            'user_id' => $paymented->user_id,
            'status' => 0,
            'type' => $type,
        ]);
        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }
        DB::commit();
        return redirect()->route('customer.home')->with('swal-success', 'سفارش شما با موفقیت ثبت شد');
    }
}
