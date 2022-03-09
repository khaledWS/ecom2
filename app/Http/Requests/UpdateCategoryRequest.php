<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
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
            'name' => 'string|min:3|max:200',
            'slug' => 'string|min:3|max:300',
            'is_main' => 'in:0,1|nullable',
            'active' => 'in:0,1|nullable',
            'parent_category_id' => 'exists:categories,id',
            'image' => 'image|mimes:png,jpg,jpeg',
            'banner' => 'image|mimes:png,jpg,jpeg',
            'info' =>'string|max:300',
            'description' =>'string',
        ];
    }

    public function messages()
    {
        return [
            'mimes:png,jpg,jpeg' => 'Invalid Input',
        ];
    }
}
