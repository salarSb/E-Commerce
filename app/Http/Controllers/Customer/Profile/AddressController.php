<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Models\Market\IranProvince;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Auth::user()->addresses;
        $provinces = IranProvince::getAllActive();
        return view('customer.profile.my-addresses', compact('provinces', 'addresses'));
    }
}
