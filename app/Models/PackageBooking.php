<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBooking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'package_tour_id',
        'package_bank_id',
        'quantity',
        'total_amount',
        'insurance',
        'tax',
        'sub_total',
        'is_paid',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date,'  
    ];

    public function tour(){
        return $this->belongsTo(PackageTour::class);
    }

    public function bank(){
        return $this->belongsTo(PackageBank::class);
    }

    public function customer(){
        return $this->belongsTo(User::class);
    }
}
