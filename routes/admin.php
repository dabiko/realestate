<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Backend\AllUserController;
use App\Http\Controllers\Backend\AmenityController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PropertyController;
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

Route::put('user/change-status', [AllUserController::class, 'updateStatus'])->name('user.change-status');
Route::resource('users', AllUserController::class);

Route::get('profile', [AdminProfileController::class, 'index'])->name('profile');
Route::put('profile-update', [AdminProfileController::class, 'update'])->name('profile.update');
Route::get('password', [AdminProfileController::class, 'index'])->name('password');
Route::put('password-update', [AdminProfileController::class, 'passwordUpdate'])->name('password.update');


Route::put('category/change-status', [CategoryController::class, 'updateStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

Route::put('amenity/change-status', [AmenityController::class, 'updateStatus'])->name('amenity.change-status');
Route::resource('amenity', AmenityController::class);


Route::put('property/change-status', [PropertyController::class, 'updateStatus'])->name('property.change-status');
Route::resource('property', PropertyController::class);









