<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CarPostRequest extends FormRequest
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
           'brand' => 'required|max:20',
           'model' => 'required|max:20',
           'engine_capacity' => 'required|numeric',
           'mileage' => 'required|numeric',
           'href' => 'required|URL',
           'price' => 'required|numeric',
	   'image' => 'max:2000',
        ];
    }
    
    public function messages()
{
    return [
        'brand.required' => 'Required: brand!',
        'model.required' => 'Required: model!',
        'brand.max' => 'Brand can have up to 10 characters',
        'model.max' => 'Model can have up to 10 characters!',
        'mileage.numeric' => 'Mileage must be a number!',
        'mileage.required' => 'Required: mileage',
        'engine_capacity.numeric' => 'Engine capacity must be a number!',
        'engine_capacity.required' => 'Required: engine capacity!',
        'href.required' => 'Required: link!',
        'href.URL' => 'Incorrect link!',
        'price.numeric' => 'Price must be a number!',
        'price.required' => 'Required: price!',
	'image.max' => 'File size too large. Max file size: 2MB',
    ];
}
}
