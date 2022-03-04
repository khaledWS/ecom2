<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
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
        'photo',
        'active'
    ];

    public function scopeActive($query)
    {
        return $query->where('active', True);
    }

    public function scopeSelection($query)
    {
        return $query->select('id', 'name', 'description'  ,'slug', 'photo', 'active');
    }


    public function getPhoto()
    {

        $val = $this->mc_photo;
        return ($val !== null) ? asset('store/'.$val)  : "";
    }

    public function vendors()
    {
        return $this->hasMany(\App\Models\Vendor::class, 'main_category_id', 'id');
    }

}
