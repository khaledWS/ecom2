<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

       /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'info',
        'details',
        'description',
        'in_stock',
        'quantity',
        'tag',
        'tags',
        'Featured',
        'history',
        'base_price',
        'discount_id',
        'category_id',
        'vendor_id',
        'product_id',
        'image',
        'image_list',
    ];
}
