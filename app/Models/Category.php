<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'banner',
        'active',
        'info',
        'is_main',
        'parent_category_id',

    ];

    public function getImage()
    {
        return getPhotoPath($this->image, 'categories');
    }

    public function scopeMain($query)
    {
        $query->where('is_main', true);
    }

    public function parentCategory()
    {
        return $this->hasOne(self::class,'id', 'parent_category_id');
    }

    public function childCategories()
    {
        return $this->hasMany(Category::class,'parent_category_id','id');
    }
}
