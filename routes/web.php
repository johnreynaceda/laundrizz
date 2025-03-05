<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckApprove;
use App\Http\Middleware\ShopSetup;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/waiting-for-approval', function () {
    if (auth()->user()->is_approved) {
        return redirect()->route('dashboard');
    } else {
        return view('pages.wait');
    }
})->name('waiting')->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    switch (auth()->user()->user_type) {
        case 'superadmin':
            return redirect()->route('superadmin.index');
        case 'admin':
            return redirect()->route('admin.index');
        case 'staff':
            return redirect()->route('staff.index');

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
        Route::get('/shops', function () {
            return view('superadmin.shops');
        })->name('superadmin.shops');
    });

Route::prefix('admin')->middleware(['auth', 'verified', ShopSetup::class])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin.index');

        Route::get('/catalog', function () {
            return view('admin.catalog');
        })->name('admin.catalog');
        Route::get('/staff', function () {
            return view('admin.staff');
        })->name('admin.staff');

    });
Route::get('/admin/account-setup', function () {
    return view('admin.setup');
})->name('admin.setup');

Route::prefix('customer')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('customer.index');
        })->name('customer.index');
        Route::get('/set-location', function () {
            return view('customer.location');
        })->name('customer.location');
        Route::get('/transactions', function () {
            return view('customer.transaction');
        })->name('customer.transaction');
        
        Route::get('/status', function () {
            return view('customer.order-status');
        })->name('customer.status');
    });


Route::prefix('staff')->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', function () {
            return view('staff.index');
        })->name('staff.index');
        Route::get('/services-transaction/{id}', function () {
            return view('staff.transaction');
        })->name('staff.transaction');
        Route::get('/order-form/{id}', function () {
            return view('staff.order-form');
        })->name('staff.order-form');
        Route::get('/order-detail/{id}', function () {
            return view('staff.order-detail');
        })->name('staff.order-detail');
       
    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
