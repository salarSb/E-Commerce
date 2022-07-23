<?php

namespace App\Http\Controllers\Customer\SalesProcess;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\SalesProcess\ProfileCompletionRequest;
use App\Models\Market\CartItem;

class ProfileCompletionController extends Controller
{
    public function profileCompletion()
    {
        $user = auth()->user();
        $cartItems = CartItem::where('user_id', $user->id)->get();
        return view('customer.sales-process.profile-completion', compact('user', 'cartItems'));
    }

    public function update(ProfileCompletionRequest $request)
    {
        $user = auth()->user();
        $nationalCode = convertPersianToEnglish($request->input('national_code'));
        $inputs = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'national_code' => $nationalCode,
        ];
        if (isset($request->mobile) && empty($user->mobile)) {
            $mobile = convertPersianToEnglish($request->input('mobile'));
            $type = 0; // 0 => mobile TODO: send mobile verification sms

            // all mobile numbers in one format (9********)
            $mobile = ltrim($mobile, '0');
            $mobile = str_starts_with($mobile, '98') ? substr($mobile, 2) : $mobile;
            $mobile = str_replace('+98', '', $mobile);
            $inputs['mobile'] = $mobile;
        }
        if (isset($request->email) && empty($user->email)) {
            $type = 1; // 0 => email TODO: send email verification mail
            $email = convertPersianToEnglish($request->input('email'));
            $inputs['email'] = $email;
        }
        $inputs = array_filter($inputs);
        if (!empty($inputs)) {
            $user->update($inputs);
        }
        return redirect()->route('customer.sales-process.address-and-delivery');
    }
}
