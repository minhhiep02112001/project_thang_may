<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostOrderClient extends FormRequest
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
            'fullname' => 'required|max:255',
            'address' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|max:12',

        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Tên không được để trống !!!',
            'address.required' => 'Địa chỉ nhận không được để trống !!!',
            'email.required' => 'Email không được để trống !!!',
            'phone.required' => 'Số điện thoại không được để trống !!!',
            'fullname.max' => 'Tên tối đa 255 ký tự',
            'address.max' => 'Địa chỉ tối đa 255 ký tự',
            'email.max' => 'Email tối đa 255 ký tự',
            'phone.max' => 'Số điện thoại tối đa 12 ký tự',
        ];
    }
}
