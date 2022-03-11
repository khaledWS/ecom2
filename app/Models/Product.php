<?php

namespace App\Models;

use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
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

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'tags' => 'collection',
        'image_list' => 'collection',
        'history' => 'collection',
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
    protected static $tagsList = [
        'out-of-stock',
        'not-working',
        'stopped-working',
    ];

    /**
     * getFeaturedList
     *
     * @return array
     */
    public static function getFeaturedList()
    {
        return self::$FeaturedList;
    }

    /**
     * getTagsList
     *
     * @return array
     */
    public static function getTagsList()
    {
        return self::$tagsList;
    }


    /**
     * getProper Image URI
     *
     * @return string
     */
    public function getImage()
    {
        return getPhotoPath($this->image, 'products');
    }

    /**
     * getImageList
     *
     * @return Collection
     */
    public function getImageList()
    {
        $images = collect();
        foreach ($this->image_list as $image) {
            $images->push(getPhotoPath($this->image, 'products'));
        }
        return $images;
    }

    /**
     * vendor belongs to relationship
     *
     * @return void
     */
    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'id', 'vendor_id');
    }

    /**
     * category belongs to relationship
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }


    /**
     * Discount relationship
     *
     * @return void
     */
    public function discount()
    {
    }

    /**
     * calculates the new Rating based on the old value and the new entry
     *
     * @return void
     */
    public function calculateRating()
    {
    }

    /**
     * returns true if the product is in stock
     *
     * @return void
     */
    public function scopeIn_stock()
    {
    }

    /**
     * Calculates the price based on the base price base tax and any discount
     *
     * @return void
     */
    public function getPrice()
    {
    }
}
