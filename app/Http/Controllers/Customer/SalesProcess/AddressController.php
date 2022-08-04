<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\AddressRequest;
use App\Models\Market\Address;
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
}
