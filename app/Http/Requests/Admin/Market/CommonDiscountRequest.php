<?php

namespace App\Http\Requests\Admin\Market;

use App\Rules\DateRule;
use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountRequest extends FormRequest
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
            'title' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'percentage' => ['required', 'max:100', 'min:1', 'numeric'],
            'discount_ceiling' => ['nullable', 'max:100000000000000', 'min:1', 'numeric'],
            'minimal_order_amount' => ['nullable', 'max:100000000000000', 'min:1', 'numeric'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'start_date' => ['required', 'numeric', 'lt:end_date', new DateRule()],
            'end_date' => ['required', 'numeric',],
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'عنوان مناسبت'
        ];
    }

    public function messages()
    {
        return [
            'start_date.lt' => 'تاریخ شروع باید کمتر از تاریخ پایان باشد.'
        ];
    }
}
