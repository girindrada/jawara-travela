<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackageBank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'logo',
    ];
}
