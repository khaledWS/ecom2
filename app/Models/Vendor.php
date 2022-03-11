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
        'categories',
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


    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'categories' => 'collection',
        'staff' => 'collection',
    ];

    /**
     * the list of possible values for the Featured Attribute.
     *
     * @var array
     */
    protected static $FeaturedList = [
        'main-page',
        'category-page',
        'sub-category-page',
        'mail-feed',
    ];


    /**
     * the list of possible values for the Status Attribute.
     *
     * @var array
     */
    protected static $StatusList = [
        'out-of-stock',
        'not-working',
        'stopped-working',
    ];

    public static function getFeaturedList()
    {
        return self::$FeaturedList;
    }

    public static function getStatusList()
    {
        return self::$StatusList;
    }

    public function getBanner()
    {
        return getPhotoPath($this->banner, 'vendors');
    }

    public function getProfile()
    {
        return getPhotoPath($this->profile, 'vendors');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getStaff()
    {
        return User::find($this->staff);
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function getCategories()
    {
        return Category::find($this->categories);
    }

    // public function getCategoriesAttribute($val)
    // {
    //     return collect($val);
    // }


}
