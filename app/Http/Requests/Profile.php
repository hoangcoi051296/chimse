<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'name' => "required| string",
            'address' => 'required',
            'phone' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên đề là trường bắt buộc!',
            'address.required' => 'Không được để trống!',
            'phone.required' =>'Không được để trống!'
        ];
    }
}
