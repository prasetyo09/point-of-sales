<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\MidtransWebhookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    Route::get("/", [LoginController::class, 'login']);
    Route::get("/login", [LoginController::class, 'login']);
    Route::post('/action-login', [LoginController::class, 'actionLogin'])->name('action-login');
});

Route::middleware('auth')->group(function(){
    Route::resource('dashboard', DashboardController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::get('/orders/data', [OrderController::class, 'data'])->name('orders.data');
    Route::get('/receipt/print/{id}', [ReceiptController::class, 'printReceipt'])->name('receipt.print');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Route::post('/midtrans-webhook', [MidtransWebhookController::class, 'handle']);
    
    Route::post('/orders/{id}/pay-success', [OrderController::class, 'updatePaymentStatus'])->name('order.pay-success');
    
    Route::get('/instruction/admin', [InstructionController::class, 'indexAdmin'])->name('instruction.admin');
    Route::get('/instruction/cashier', [InstructionController::class, 'indexCashier'])->name('instruction.cashier');
    Route::get('/instruction/leader', [InstructionController::class, 'indexLeader'])->name('instruction.leader');

    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
