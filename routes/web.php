<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PointController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/merchant/{id}/validate', [AdminController::class, 'validateMerchant'])->name('validateMerchant');
    Route::get('/categories', [AdminController::class, 'manageWasteCategories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeWasteCategory'])->name('storeCategory');
    Route::get('/report', [AdminController::class, 'viewReport'])->name('report');
});

// Merchant Routes
Route::middleware(['auth', 'role:merchant'])->prefix('merchant')->name('merchant.')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'merchantDashboard'])->name('dashboard');
    Route::post('/pickup/{id}/accept', [TransactionController::class, 'acceptPickup'])->name('acceptPickup');
    Route::get('/pickup/{id}/weighing', [TransactionController::class, 'showWeighingForm'])->name('weighing');
    Route::post('/pickup/{id}/weighing', [TransactionController::class, 'storeWeighing'])->name('storeWeighing');
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [TransactionController::class, 'customerDashboard'])->name('dashboard');
    Route::post('/pickup/request', [TransactionController::class, 'requestPickup'])->name('requestPickup');
    Route::get('/points/history', [PointController::class, 'viewHistory'])->name('pointHistory');
    Route::post('/points/redeem', [PointController::class, 'redeemPoints'])->name('redeemPoints');
});
