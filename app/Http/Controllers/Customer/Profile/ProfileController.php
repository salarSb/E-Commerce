<?php

namespace App\Http\Controllers\Customer\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\Profile\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('customer.profile.profile', compact('user'));
    }

    public function update(UpdateProfileRequest $request)
    {
        Auth::user()->update($request->validated());
        return redirect()->route('profile.index')->with('swal-success', 'پروفایل شما با موفقیت ویرایش شد');
    }
}
