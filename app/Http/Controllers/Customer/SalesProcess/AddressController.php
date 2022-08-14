<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\AddressRequest;
use App\Http\Requests\Customer\SalesProcess\ChooseAddressAndDeliveryRequest;
use App\Models\Market\Address;
use App\Models\Market\CartItem;
use App\Models\Market\CommonDiscount;
use App\Models\Market\Delivery;
use App\Models\Market\IranProvince;

class AddressController extends Controller
{
    public function addressAndDelivery()
    {
        $user = auth()->user();
        if (empty(CartItem::where('user_id', $user->id)->count())) {
            return redirect()->route('customer.sales-process.cart');
        }
        $addresses = $user->addresses;
        $provinces = IranProvince::getAllActive();
        $deliveryMethods = Delivery::where('status', 1)->get();
        return view('customer.sales-process.address-and-delivery', compact('addresses', 'provinces', 'deliveryMethods'));
    }

    public function getCities(IranProvince $province)
    {
        $cities = $province->getActiveCities();
        if (!empty($cities)) {
            return response()->json([
                'status' => true,
                'cities' => $cities,
            ]);
        }
        return response()->json([
            'status' => false,
            'cities' => null,
        ]);
    }

    public function addAddress(AddressRequest $request)
    {
        $inputs = $request->validated();
        $inputs['postal_code'] = convertPersianToEnglish($request->input('postal_code'));
        $inputs['no'] = convertPersianToEnglish($request->input('no'));
        $inputs['unit'] = convertPersianToEnglish($request->input('unit'));
        $inputs['mobile'] = convertPersianToEnglish($request->input('mobile'));
        auth()->user()->addresses()->create($inputs);
        return redirect()->back();
    }

    public function updateAddress(AddressRequest $request, Address $address)
    {
        $inputs = $request->validated();
        $inputs['postal_code'] = convertPersianToEnglish($request->input('postal_code'));
        $inputs['no'] = convertPersianToEnglish($request->input('no'));
        $inputs['unit'] = convertPersianToEnglish($request->input('unit'));
        $inputs['mobile'] = convertPersianToEnglish($request->input('mobile'));
        $address->update($inputs);
        return redirect()->back();
    }

    public function chooseAddressAndDelivery(ChooseAddressAndDeliveryRequest $request)
    {
        $user = auth()->user();
        $inputs = $request->validated();

        //calc price
        $deliveryAmount = Delivery::find($inputs['delivery_id'])->amount;
        $cartItems = CartItem::where('user_id', $user->id)->get();
        $totalProductPrice = 0;
        $totalDiscount = 0;
        $totalFinalPrice = $deliveryAmount;
        $totalFinalDiscountPriceWithNumber = 0;
        foreach ($cartItems as $cartItem) {
            $totalProductPrice += $cartItem->product_price;
            $totalDiscount += $cartItem->product_discount;
            $totalFinalPrice += $cartItem->final_price;
            $totalFinalDiscountPriceWithNumber += $cartItem->final_discount;
        }
        $commonDiscount = CommonDiscount::validCommonDiscounts()->first();
        if (isset($commonDiscount) && $totalFinalPrice >= $commonDiscount->minimal_order_amount) {
            $commonDiscountAmount = min($totalFinalPrice * ($commonDiscount->percentage / 100), $commonDiscount->discount_ceiling);
            $totalFinalPrice = $totalFinalPrice - $commonDiscountAmount;
        }

        // create order
        $order = $user->orders()->updateOrCreate(['user_id' => $user->id, 'order_status' => 0], array_merge($inputs, [
            'delivery_amount' => $deliveryAmount,
            'order_final_amount' => $totalFinalPrice, // TODO : must refactor because coupon and common discounts aren't affected
            'order_discount_amount' => $totalFinalDiscountPriceWithNumber,
            'order_common_discount_amount' => $commonDiscountAmount ?? null,
            'order_total_products_discount_amount' => $totalFinalDiscountPriceWithNumber + ($commonDiscountAmount ?? null),
        ]));
        return redirect()->route('customer.sales-process.payment');
    }
}
