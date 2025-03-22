<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntryController::class, 'index'])->name('entry');

Route::get('admin/', [LoginController::class, 'admin_login'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'admin_login']);
Route::prefix('admin')->name('admin.')->middleware([AdminAuth::class])->group(function () {
    Route::get('/home', [AdminController::class, 'home'])->name('home');
    Route::get('/stores', [AdminController::class, 'getStores'])->name('stores.list');
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::prefix('user')->name('vendor.')->group(function () {
    Route::get('/', [LoginController::class, 'user_login']);
});