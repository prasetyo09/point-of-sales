<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SearchController;
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

    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
