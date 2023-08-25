<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('dashboard');
Route::post('logout', [AdminController::class, 'AdminLogout'])->name('logout');

Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
Route::put('profile-update', [AdminProfileController::class, 'update'])->name('profile.update');
Route::get('password', [AdminProfileController::class, 'index'])->name('password');
Route::put('password-update', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');








