<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\CouponDiscountRequest;
use App\Http\Requests\Customer\SalesProcess\PaymentSubmitRequest;
use App\Http\Services\Payment\PaymentService;
use App\Models\Market\CartItem;
use App\Models\Market\CashPayment;
use App\Models\Market\Coupon;
use App\Models\Market\OfflinePayment;
use App\Models\Market\OnlinePayment;
use App\Models\Market\Order;
use Illuminate\Support\Facades\DB;
use PharIo\Version\Exception;

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

    public function paymentSubmit(PaymentSubmitRequest $request, PaymentService $paymentService)
    {
        $user = auth()->user();
        $order = Order::userOpenOrder()->first();
        $cartItems = $user->cartItems;
        $cashReceiver = null;
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
                $cashReceiver = $request->input('cash_receiver') ?? null;
                break;
            default:
                return back()->withErrors('payment_type', 'نحوه ی پرداخت معتبر نیست');
        }
        DB::beginTransaction();
        try {
            // ToDo: stock update
            $paymented = $targetModel::create([
                'amount' => $order->order_final_amount,
                'user_id' => $user->id,
                'cash_receiver' => $cashReceiver,
                'status' => 1,
            ]);

            $paymented->payments()->create([
                'amount' => $paymented->amount,
                'user_id' => $paymented->user_id,
                'status' => 1,
                'type' => $type,
                'pay_date' => now()
            ]);

            if ($request->input('payment_type') == 1) {
                $paymentService->zarinpal($paymented->amount, $order, $paymented);
            }

            $order->update([
                'order_status' => 3,
            ]);
            foreach ($cartItems as $cartItem) {
                $this->fillOrderItems($order, $cartItem);
                $cartItem->delete();
            }
            DB::commit();
            return redirect()->route('customer.home')->with('swal-success', 'سفارش شما با موفقیت ثبت شد');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('customer.home')->with('swal-error', 'سفارش شما با خطا مواجه شد');
        }
    }

    public function paymentCallback(Order $order, OnlinePayment $onlinePayment, PaymentService $paymentService)
    {
        // ToDo: stock update
        $amount = $onlinePayment->amount * 10;
        $result = $paymentService->zarinpalVerify($amount, $onlinePayment);
        $cartItems = auth()->user()->cartItems;
        DB::beginTransaction();
        try {
            foreach ($cartItems as $cartItem) {
                $this->fillOrderItems($order, $cartItem);
                $cartItem->delete();
            }
            if ($result['success']) {
                $order->update([
                    'order_status' => 3,
                ]);
                return redirect()->route('customer.home')->with('swal-success', 'پرداخت شما با موفقیت انجام شد');
            }
            DB::commit();
            return redirect()->route('customer.home')->with('swal-error', 'پرداخت شما ناموفق بود');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('customer.home')->with('swal-error', 'پرداخت شما ناموفق بود');
        }
    }

    private function fillOrderItems(Order $order, CartItem $cartItem)
    {
        $order->orderItems()->create([
            'product_id' => $cartItem->product_id,
            'product' => $cartItem->product,
            'amazing_sale_id' => $cartItem->product->amazingSales()->validAmazingSales()->first()->id ?? null,
            'amazing_sale_object' => $cartItem->product->amazingSales()->validAmazingSales()->first() ?? null,
            'amazing_sale_discount_amount' => $cartItem->final_discount,
            'number' => $cartItem->number,
            'final_product_price' => $cartItem->final_product_price,
            'final_total_price' => $cartItem->final_price,
            'color_id' => $cartItem->color_id,
            'guarantee_id' => $cartItem->guarantee_id,
        ]);
    }
}
