<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVendorRequest extends FormRequest
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
            'name' => 'required_without:id|string|min:3|max:200',
            'slug' => 'string|min:3|max:300',
            'category' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('is_main', true)
            ],
            'categories[]' => [
                Rule::exists('categories', 'id')
                    ->where('is_main', false)
            ],

            'staff[]' => [
                Rule::exists('users', 'id')
                    ->where('role_id', 2)
            ],
            'user' =>  [
                'required',
                Rule::exists('users', 'id')
                    ->where('role_id', 2)
            ],
            'description' => 'string',
            'status' => 'string',
            'active' => 'in:0,1|nullable',
            'featured' => 'string',
            'profile' => 'image|mimes:png,jpg,jpeg',
            'banner' => 'image|mimes:png,jpg,jpeg',
        ];
    }
}
