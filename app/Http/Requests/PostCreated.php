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
            'address' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'title is required!',
            'description.required' => 'description is required!',
            'price.required' => 'price is required!',
            'address.required' =>'Address is required!'
        ];
    }
}
