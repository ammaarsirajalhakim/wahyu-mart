<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AuthController;

// Redirect root URL to login page
Route::get('/', function() {
    return redirect()->route('login');
});

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('sales', SaleController::class);
    Route::post('/sales/reset', [SaleController::class, 'reset'])->name('sales.reset');
    Route::get('print', [PrintController::class, 'show'])->name('print.invoice');
    Route::post('sales/saveTransaction', [TransactionController::class, 'saveTransaction'])->name('sales.saveTransaction');
    Route::get('transactions', [TransactionController::class, 'index'])->name('transaction.index');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::delete('transactions/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
});
