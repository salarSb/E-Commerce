<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\NationalCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'first_name' => ['required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
                'last_name' => ['required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
                'mobile' => ['required', 'regex:/^09[\d]{9}$/u', 'unique:users'],
                'email' => ['required', 'string', 'email', 'unique:users'],
//            'password' => ['required', Password::min(8)
//                ->letters()->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed', 'unique:users'],
                'password' => ['required', Password::min(8)
                    ->letters(), 'confirmed', 'unique:users'],
                'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
                'national_code' => ['required', new NationalCodeRule, 'unique:users'],
            ];
        } else {
            return [
                'first_name' => ['required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
                'last_name' => ['required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
                'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif'],
                'national_code' => ['required', new NationalCodeRule, Rule::unique('users')->ignore($this->route('user')->id)],
            ];
        }
    }
}
