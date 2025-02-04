<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckApprove;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/waiting-for-approval', function () {
    if (auth()->user()->is_approved) {
       return redirect()->route('dashboard');
    }else{
        return view('pages.wait');
    }
})->name('waiting');




Route::get('/pay/{id}', function () {
    return view('pages.cart');
})->middleware(['auth', 'verified'])->name('cart');

Route::get('/dashboard', function () {
   switch (auth()->user()->user_type) {
    case 'superadmin':
        return redirect()->route('superadmin.index');
    case 'admin':
       return redirect()->route('admin.index');
    case 'staff':
        dd('staff');
    
    default:
    return redirect()->route('customer.index');
   }
})->middleware(['auth', 'verified', CheckApprove::class])->name('dashboard');





Route::prefix('superadmin')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('superadmin.index');
        })->name('superadmin.index');
        Route::get('/subscription', function () {
            return view('superadmin.subscription');
        })->name('superadmin.subscription');
        Route::get('/user-request', function () {
            return view('superadmin.user');
        })->name('superadmin.user');
});

Route::prefix('admin')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.index');
     
});

Route::prefix('customer')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('customer.index');
        })->name('customer.index');
});
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
