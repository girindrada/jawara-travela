<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePhoto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'package_tour_id',
        'photo',
    ];

    public function tour(){
        return $this->belongsTo(PackageTour::class);
    }
}
