<?php

namespace App\Http\Controllers;

use App\Models\PackageBooking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function my_bookings()
    {
        return view('dashboard.my_bookings');
    }

    public function detail_bookings(PackageBooking $packageBooking)
    {
        return view('dashboard.detail_bookings', compact('packageBooking'));
    }
}
