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
            'title.required' => 'Must not be left blank',
            'description.required' => 'Must not be left blank',
            'price.required' => 'Must not be left blank',
            'province_id' => 'Must not be left blank',
            'district_id' => 'Must not be left blank',
            'commune_id' => 'Must not be left blank',
            'category_id' => 'Must not be left blank'
        ];
    }
}
