<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;
use JetBrains\PhpStorm\ArrayShape;

class LoginRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $route = Route::current();
        if ($route->getName() == 'auth.customer.login-register') {
            return [
                'id' => ['required', 'min:11', 'max:64', 'regex:/^[a-zA-Z0-9_.@\+]*$/']
            ];
        } else {
            return [
                'otp' => ['required', 'min:6', 'max:6', 'exists:otps,code']
            ];
        }
    }

    #[ArrayShape(['id' => "string"])] public function attributes(): array
    {
        return [
            'id' => 'ایمیل یا شماره موبایل'
        ];
    }
}
