<?php

namespace App\Http\Requests\Customer\Profile;

use App\Rules\NationalCodeRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'first_name' => ['nullable', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
            'last_name' => ['nullable', 'max:120', 'min:1', 'regex:/^[ا-یa-zA-Zء-ي. ]+$/u'],
            'national_code' => [
                'nullable',
                new NationalCodeRule,
                Rule::unique('users')->ignore($this->user()->national_code, 'national_code')],
        ];
    }
}
