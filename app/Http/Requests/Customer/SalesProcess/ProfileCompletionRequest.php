<?php

namespace App\Http\Requests\Customer\SalesProcess;

use App\Rules\NationalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileCompletionRequest extends FormRequest
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
        return [
            'first_name' => ['sometimes', 'required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
            'last_name' => ['sometimes', 'required', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
            'mobile' => ['sometimes', 'regex:/^(\+98|98|0)9\d{9}$/u', 'unique:users'],
            'email' => ['sometimes', 'string', 'email', 'unique:users'],
            'national_code' => ['sometimes', 'required', new NationalCodeRule, 'unique:users'],
        ];
    }
}
