<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;


     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
        'category',
        'category_id',
        'user_id',
        'staff',
        'description',
        'active',
        'profile',
        'banner',
        'status',
        'featured'
    ];

    //The List of what could be on the Featured
    public $FeaturedList = [
        'main-page',
        'category-page',
        'sub-category-page',
        'mail-feed',
    ];

    //The List of what could be on the Status
    public $StatusList = [
        'out-of-stock',
        'not-working',
        'stopped-working',
    ];



}
