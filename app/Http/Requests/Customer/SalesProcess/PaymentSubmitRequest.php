<?php

namespace App\Http\Requests\Customer\SalesProcess;

use Illuminate\Foundation\Http\FormRequest;

class PaymentSubmitRequest extends FormRequest
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
            'payment_type' => ['required', 'int'],
        ];
    }
}
