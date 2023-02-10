<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => ['required', 'unique:permissions,name', 'max:120', 'min:2'],
            'description' => ['required', 'max:200', 'min:2'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'عنوان دسترسی',
            'description' => 'توضیحات دسترسی',
        ];
    }
}
