<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Models\Market\CartItem;
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
        return view('customer.sales-process.address-and-delivery', compact('addresses', 'provinces'));
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

    public function addAddress()
    {

    }
}
