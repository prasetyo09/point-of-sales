<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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
});
