<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name' => ['required', 'max:120', 'min:2', 'regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي., ]+$/u'],
            'url' => ['required', 'max:120', 'min:1', 'regex:/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/u'],
            'parent_id' => ['nullable', 'max:100000000', 'min:1', 'regex:/^[0-9]+$/u', 'exists:menus,id'],
            'status' => ['required', 'numeric', 'in:0,1'],
        ];
    }
}
