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
        'proof', // ketinggalan kolom ini pada pembuatan awal migration
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',  
    ];

    /**
     * alasan di method tour() harus di define name foreign_key nya adalah 
     * karena cara laravel menebak foreign_key secara otomatis tidak sesuai dengan method name nya!!!
     * 
     * Di tabel package_bookings kolom yang di pakai adalah: package_tour_id bukan tour_id !!!
     * Jadi ketika Laravel menjalankan: $packageBooking->tour -> Laravel mencari: tour_id di database.
     * 
     * alternatif solusi, ubah name methodnya:
     * 
     * public function packageTour()
     *   {
     *       return $this->belongsTo(PackageTour::class);
     *   }
     * 
     * Karena sekarang: method = packageTour -> Laravel otomatis mencari: package_tour_id 
     * yang sesuai dengan kolom database
     */
    public function tour(){
        return $this->belongsTo(PackageTour::class, 'package_tour_id');
    }

    // relasi ini juga sama penjelasanya dengan diatas
    public function bank(){
        return $this->belongsTo(PackageBank::class, 'package_bank_id');
    }

    public function customer(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
