<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AdminRewardController;
use App\Http\Controllers\Staff\PointsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\RedemptionController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /* ---------------- Dashboard ---------------- */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /* ---------------- User Profile ---------------- */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ---------------- Rewards ---------------- */
    Route::get('/rewards', [RewardController::class, 'index'])->name('rewards.index');
    Route::get('/rewards/{reward}/redeem', [RewardController::class, 'redeemForm'])->name('rewards.redeem');
    Route::post('/rewards/{reward}/redeem', [RewardController::class, 'redeem'])->name('rewards.redeem.submit');
    Route::get('/redemption-history', [RewardController::class, 'history'])->name('rewards.history');

    /* ---------------- Role-based: Staff & Admin ---------------- */
    Route::middleware('role:staff,admin')->group(function () {
        Route::post('/users/{user}/points', [PointController::class, 'store'])->name('points.store');
    });

    /* ---------------- Role-based: Admin Only ---------------- */
    Route::middleware('role:admin')->group(function () {
        Route::post('/redemptions/{redemption}/approve', [RedemptionController::class, 'approve'])->name('redemptions.approve');
        Route::post('/redemptions/{redemption}/reject', [RedemptionController::class, 'reject'])->name('redemptions.reject');
    });

    /* ---------------- Customers CRUD ---------------- */
    Route::resource('customers', CustomerController::class);

    /*
    |--------------------------------------------------------------------------
    | Orders System
    |--------------------------------------------------------------------------
    */

    // Checkout page
    Route::get('/checkout', function () {
        return view('orders.checkout');
    })->name('checkout');

    // Customer places order
    Route::post('/orders/place', [OrderController::class, 'placeOrder'])->name('orders.place');

    // Customer order history
    Route::get('/my-orders', [OrderController::class, 'customerOrders'])->name('orders.customer-orders');

    // Order cancellation
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Staff/Admin: View all orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Admin: Update order status
    Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])
        ->middleware('role:admin')
        ->name('orders.updateStatus');

    // Admin: Manage all orders
    Route::get('/admin/orders', [OrderController::class, 'admin'])
        ->middleware('role:admin')
        ->name('admin.orders.index');

    /*
    |--------------------------------------------------------------------------
    | Shop + Products
    |--------------------------------------------------------------------------
    */

    // Shop page
    Route::get('/shop', function () {
        return view('shop.index', [
            'products' => \App\Models\Product::all()
        ]);
    })->name('shop');

    // Order a product (Customer)
    Route::post('/shop/{product}/order', [OrderController::class, 'placeOrder'])->name('shop.order');

    // Product CRUD (Admin + Staff)
    Route::middleware('role:admin,staff')->group(function () {
        Route::resource('products', ProductController::class);
    });

    // Buy product (Customer)
    Route::post('/products/{product}/buy', [ProductController::class, 'buy'])
        ->middleware(['auth'])
        ->name('products.buy');
});

/*
|--------------------------------------------------------------------------
| Admin Panel
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth','role:admin'])->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', AdminUserController::class)->except(['show']);

    // Admin rewards
    Route::get('/rewards', [AdminRewardController::class, 'index'])->name('rewards');
    Route::get('/rewards/create', [AdminRewardController::class, 'create'])->name('rewards.create');
    Route::post('/rewards', [AdminRewardController::class, 'store'])->name('rewards.store');
    Route::get('/rewards/{reward}/edit', [AdminRewardController::class, 'edit'])->name('rewards.edit');
    Route::put('/rewards/{reward}', [AdminRewardController::class, 'update'])->name('rewards.update');
    Route::delete('/rewards/{reward}', [AdminRewardController::class, 'destroy'])->name('rewards.destroy');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
});

/*
|--------------------------------------------------------------------------
| Staff Panel
|--------------------------------------------------------------------------
*/
Route::prefix('staff')->middleware(['auth','role:staff'])->name('staff.')->group(function () {

    Route::get('/dashboard', function () {
        return view('staff.dashboard');
    })->name('dashboard');

    Route::post('/points/add', [PointsController::class, 'store'])->name('points.add');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
