<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\UserAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntryController::class, 'index'])->name('entry');

Route::get('admin/', [LoginController::class, 'admin_login'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'admin_login']);
Route::prefix('admin')->name('admin.')->middleware([AdminAuth::class])->group(function () {
    Route::get('/home', [AdminController::class, 'home'])->name('home');
    Route::get('/stores', [AdminController::class, 'getStores'])->name('stores.list');
    Route::get('/store/new', [AdminController::class, 'newStore'])->name('stores.new');
    Route::get('/store/edit/{id}', [AdminController::class, 'editStore'])->name('stores.new');
    Route::post('/store', [AdminController::class, 'saveStore']);
    Route::put('/store', [AdminController::class, 'updateStore']);
    Route::delete('/store', [AdminController::class, 'deleteStore']);
});

Route::get('user/', [LoginController::class, 'user_login'])->name('user.login');
Route::post('user/login', [LoginController::class, 'user_login']);
Route::prefix('user')->name('user.')->middleware([UserAuth::class])->group(function () {
    Route::get('/home', [AdminController::class, 'user_home'])->name('home');
    Route::get('/stores', [AdminController::class, 'getStoresSorted'])->name('stores.list');
});

Route::post('admin/logout', [LoginController::class, 'logout']);
Route::post('user/logout', [LoginController::class, 'logout']);