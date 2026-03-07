<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PackageBankController;
use App\Http\Controllers\PackageBookingController;
use App\Http\Controllers\PackageTourController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// halaman catalog awal yang ditampilkan di user interface tanpa login
Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/category/{category:slug}', [FrontController::class, 'category'])->name('front.category');
Route::get('/details/{packageTour:slug}', [FrontController::class, 'details'])->name('front.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * Notes terkait route model binding!
     * kunci agar route model binding {packageTour:slug} bisa mencari ke model PackageTour ada di Controller!
     * jadi nama parameter di route dan controller bagian parameter harus sama.
     * jika di route {packageTour}, maka di controller juga harus $packageTour
     * jadi gini flow nya: 
     * -> {packageTour:slug} di parameter route 
     * -> FrontController: bagian parameter method-nya (PackageTour $packageTour)
     * -> cara bacanya variable $packageTour type object nya based-on model PackageTour
     * -> Laravel tahu model PackageTour 
     * -> Eloquent tahu tabel package_tours 
     */
    Route::middleware('can:checkout package')->group(function(){
        Route::get('book/{packageTour:slug}', [FrontController::class, 'book'])->name('front.book');
        
        Route::post('book/{packageTour:slug}', [FrontController::class, 'book_store'])->name('front.book.store');

        Route::get('book/choose-bank/{packageBooking}', [FrontController::class, 'choose_bank'])->name('front.choose_bank');

        Route::patch('book/choose-bank/{packageBooking}', [FrontController::class, 'choose_bank_store'])->name('front.choose_bank.store');

        Route::get('book/payment/{packageBooking}', [FrontController::class, 'book_payment'])->name('front.book_payment');

        Route::patch('book/payment/{packageBooking}', [FrontController::class, 'book_payment_store'])->name('front.book_payment.store');
        
        Route::get('book-finish', [FrontController::class, 'book_finish'])->name('front.book_finish');
    });

    Route::prefix('dashboard')->name('dashboard.')->group(function(){
        Route::middleware('can:view orders')->group(function(){
            Route::get('/my-bookings', [DashboardController::class, 'my_bookings'])->name('bookings');
            Route::get('/my-bookings/details/{packageBooking}', [DashboardController::class, 'detail_bookings'])->name('booking.details');
        });
    });

    // admin routes with their permissions
    Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware('can:manage categories')->group(function(){
            Route::resource('categories', CategoryController::class);
        });

        Route::middleware('can:manage package banks')->group(function(){
            Route::resource('package_banks', PackageBankController::class);
        });

        Route::middleware('can:manage packages')->group(function(){
            Route::resource('package_tours', PackageTourController::class);
        });

        Route::middleware('can:manage transactions')->group(function(){
            Route::resource('package_bookings', PackageBookingController::class);
        });
    });
});

require __DIR__.'/auth.php';
