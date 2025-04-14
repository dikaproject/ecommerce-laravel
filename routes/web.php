<?php

use Illuminate\Support\Facades\Route;

// Auth Controllers
use App\Http\Controllers\AuthController;

// Admin Controllers
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PortofolioController as AdminPortofolioController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\DiscountController as AdminDiscountController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

// User Controllers
use App\Http\Controllers\User\ServiceController;
use App\Http\Controllers\User\PortofolioController;
use App\Http\Controllers\User\OrderController;

// Guest/Public Routes
Route::get('/', function () {
    return view('user.home');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public Service Routes
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

// Public Portfolio Routes
Route::get('/portfolios', [PortofolioController::class, 'index'])->name('portfolios.index');
Route::get('/portfolios/{portofolio}', [PortofolioController::class, 'show'])->name('portfolios.show');
Route::get('/services/{service}/portfolios', [PortofolioController::class, 'byService'])->name('portfolios.by-service');

// Midtrans Callback
Route::post('/payments/midtrans-callback', [OrderController::class, 'callback'])->name('payments.callback');

// User Routes (Authentication Required)
Route::middleware('auth')->name('user.')->group(function () {
    // Order Routes
    Route::get('/my-orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/order/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/order/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order/{order}/payment', [OrderController::class, 'payment'])->name('orders.payment');
    
    // Discount validation ajax endpoint
    Route::post('/discount/validate', [OrderController::class, 'validateDiscount'])->name('discount.validate');
});

// Admin Routes (Authentication & Admin Role Required)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Services Management
    Route::resource('services', AdminServiceController::class);
    
    // Portfolio Management
    Route::resource('portofolios', AdminPortofolioController::class);
    
    // Orders Management
    Route::resource('orders', AdminOrderController::class);
    
    // Discounts Management
    Route::resource('discounts', AdminDiscountController::class);
    
    // Users Management
    Route::resource('users', AdminUserController::class);
});