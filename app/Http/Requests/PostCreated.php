<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreated extends FormRequest
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
            'title' => "required| string",
            'description' => "required",
            'price' => 'required',
            "province_id" => "required",
            "district_id" => "required",
            "commune_id" => "required",
            "category_id" => "required"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Tiêu đề là trường bắt buộc!',
            'description.required' => 'Không được để trống!',
            'price.required' => 'Không được để trống!',
        ];
    }
}
