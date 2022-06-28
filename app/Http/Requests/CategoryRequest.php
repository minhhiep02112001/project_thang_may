<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class CategoryRequest extends FormRequest
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
        
        switch($this->method())
        {
            case 'PUT':
            {
                return [
                    'name' =>[
                        'required',
                        Rule::unique('categories','name')->ignore($this->id),
                    ],
                        
                    'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',

                ];
                break;
            }
            default:
                return [
                    'name' =>'required|unique:categories,name',
                    'image' => 'mimes:jpg,png,jpeg,gif,svg|max:2048',

                ];
                break;
        }    
       
    }
    public function messages()
    {
        // code...
        return[
            'name.required'=>':attribute không được để trống !!!',
            'name.unique'=>':attribute đã tồn tại !!!',
            'name.max' => ':attribute không được quá :max ký tự !!!',
            'image.mimes' => ':attribute không hợp lệ [ jpg,png,jpeg,gif,svg ] !!!',
            'image.max' => ':attribute max size :max !!!'
        ];
    }
    public function attributes(){
        return [
            'name'=>'Tên danh mục',
            'image'=>'Image',
        ];
    }
}
