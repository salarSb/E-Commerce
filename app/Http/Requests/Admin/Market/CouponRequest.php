<?php

namespace App\Http\Requests\Admin\Market;

use App\Rules\DateRule;
use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'code' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'amount_type' => ['required', 'numeric', 'in:0,1'],
            'amount' => ['required', request()->amount_type == 0 ? 'max:100' : 'max:100000000000', 'min:1', 'numeric'],
            'discount_ceiling' => ['nullable', 'max:100000000000000', 'min:1', 'numeric'],
            'type' => ['required', 'numeric', 'in:0,1'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'start_date' => ['required', 'numeric', 'lt:end_date', new DateRule()],
            'end_date' => ['required', 'numeric',],
            'user_id' => ['required_if:type,1', 'min:1', 'regex:/^[0-9]+$/u', 'exists:users,id'],
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'نوع کوپن',
            'amount_type' => 'نوع تخفیف',
            'amount' => 'میزان تخفیف'
        ];
    }

    public function messages()
    {
        return [
            'start_date.lt' => 'تاریخ شروع باید کمتر از تاریخ پایان باشد.',
            'user_id.required_if' => 'فیلد انتخاب کاربر هنگامی که نوع کوپن برابر خصوصی است الزامی است.',
        ];
    }
}
