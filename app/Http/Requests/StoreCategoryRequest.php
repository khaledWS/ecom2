<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if (Auth::user()->role == "1") {
        //     return true;
        // } else
        //     return false;
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|min:3|max:200',
            'slug' => 'required|string|min:3|max:300',
            'is_main' => 'in:0,1|nullable',
            'active' => 'in:0,1|nullable',
            'parent_category_id' => 'exists:categories,id',
            'image' => 'image|mimes:png,jpg,jpeg',
            'banner' => 'image|mimes:png,jpg,jpeg',
            'info' =>'string|max:300',
            'description' =>'string',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'mimes:png,jpg,jpeg' => 'Invalid Input',
        ];
    }
}
