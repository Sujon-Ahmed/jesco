<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'category_name' => 'required | unique:categories| string | max:255',
            'category_thumbnail' => 'required | image | mimes:jpeg,png,jpg | max:1024',
        ];
    }
    public function messages()
    {
        return [
            'category_name.required' => 'Enter Category name',
            'category_name.unique' => 'This Category Already Exist!',
            'category_thumbnail.required' => 'Enter Category Image',
        ];
    }
}
