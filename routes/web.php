<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Auth Route
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register-merchant', [AuthController::class, 'showRegisterFormMerchant'])->name('register.merchant');
Route::get('/register-customer', [AuthController::class, 'showRegisterFormCustomer'])->name('register.customer');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Merchant dan Customer Routes
Route::middleware(['auth'])->group(function () {
    // Profile Routes
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    // Merchant Routes
    Route::middleware(['role:Merchant'])->group(function () {
        Route::get('menu', [MenuController::class, 'index'])->name('menu');
        Route::get('menu-create', [MenuController::class, 'create'])->name('menu.create');
        Route::post('menu-store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('menu/{menu}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('menu/{menu}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('menu/{menu}', [MenuController::class, 'destroy'])->name('menu.destroy');
    });

    // Customer Routes
    Route::middleware(['role:Customer'])->group(function () {
        Route::get('order', [OrderController::class, 'indexOrder'])->name('order');
    });
});


