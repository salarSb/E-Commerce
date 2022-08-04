<?php

namespace App\Http\Requests\Customer\SalesProcess;

use App\Rules\PostalCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAddressRequest extends FormRequest
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
            'city_id' => ['required', 'exists:iran_cities,id'],
            'address' => ['required', 'min:1', 'max:300'],
            'postal_code' => ['required', new PostalCodeRule],
            'no' => 'required',
            'unit' => 'required',
            'receiver' => 'sometimes',
            'recipient_first_name' => 'required_with:receiver,on',
            'recipient_last_name' => 'required_with:receiver,on',
            'mobile' => 'required_with:receiver,on',
        ];
    }

    public function attributes()
    {
        return [
            'unit' => 'واحد',
            'mobile' => 'موبایل گیرنده',
        ];
    }

    public function messages()
    {
        return [
            'recipient_first_name.required_with' => 'نام گیرنده الزامی است هنگامی که گیرنده سفارش خودتان نیستید',
            'recipient_last_name.required_with' => 'نام خانوادگی گیرنده الزامی است هنگامی که گیرنده سفارش خودتان نیستید',
            'mobile.required_with' => 'موبایل گیرنده الزامی است هنگامی که گیرنده سفارش خودتان نیستید',
        ];
    }
}
