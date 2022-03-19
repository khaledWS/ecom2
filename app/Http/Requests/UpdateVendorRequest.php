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
            'vendor' =>  [
                'required',
                Rule::exists('vendors', 'id')
            ],
            'product_id' =>  [
                'required',
                Rule::exists('products', 'id')
                    ->where('product_id', null)
            ],
            'discount_id' =>  [
                'required',
                Rule::exists('discounts', 'id')
            ],
            'description' => 'string',
            'info' => 'string',
            'details' => 'string',
            'base_price' => 'numeric',
            'base_tax' => 'numeric',
            'quantity' => 'numeric',
            'tag' => 'string',
            'active' => 'in:0,1|nullable',
            'in_stock' => 'in:0,1|nullable',
            'featured' => 'string',
            'image' => 'image|mimes:png,jpg,jpeg',
            'images[]' => 'image|mimes:png,jpg,jpeg',
        ];
    }
}
