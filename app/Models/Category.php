<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon',
        'slug'
    ];

    public function tours()
    {
        return $this->hasMany(PackageTour::class);
    }

}
