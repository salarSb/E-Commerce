<?php

namespace App\Http\Requests\Admin\Market;

use App\Rules\DateRule;
use Illuminate\Foundation\Http\FormRequest;

class AmazingSaleRequest extends FormRequest
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
            'product_id' => ['required', 'max:100000000', 'min:1', 'regex:/^[0-9]+$/u', 'exists:products,id'],
            'percentage' => ['required', 'max:100', 'min:1', 'numeric'],
            'status' => ['required', 'numeric', 'in:0,1'],
            'start_date' => ['required', 'numeric', 'lt:end_date', new DateRule()],
            'end_date' => ['required', 'numeric',],
        ];
    }

    public function attributes()
    {
        return [
            'product_id' => 'انتخاب محصول',
        ];
    }

    public function messages()
    {
        return [
            'start_date.lt' => 'تاریخ شروع باید کمتر از تاریخ پایان باشد.'
        ];
    }
}
