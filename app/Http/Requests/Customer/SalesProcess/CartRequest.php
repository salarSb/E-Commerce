<?php

namespace App\Http\Requests\Customer\SalesProcess;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'product_id' => ['required', 'exists:products,id'],
            'color_id' => ['nullable', 'exists:product_colors,id'],
            'guarantee_id' => ['nullable', 'exists:guarantees,id'],
            'number' => ['numeric', 'min:1', 'max:5'],
        ];
    }
}
