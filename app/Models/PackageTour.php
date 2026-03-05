<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageTour extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'thumbnail',
        'slug',
        'location',
        'about',
        'price',
        'days',
    ];

    public function package_photos(){
        return $this->hasMany(PackagePhoto::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
