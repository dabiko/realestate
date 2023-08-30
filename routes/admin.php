<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Backend\AllUserController;
use App\Http\Controllers\Backend\AmenityController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DetailController;
use App\Http\Controllers\Backend\FacilityController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyFacilityController;
use App\Http\Controllers\Backend\PropertyGalleryController;
use App\Http\Controllers\Backend\PropertyStatsController;
use App\Http\Controllers\Backend\PropertyVariantController;
use App\Http\Controllers\Backend\PropertyVariantItemController;
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

Route::get('property/check-approved', [PropertyController::class, 'checkIsApproved'])->name('property.check-approved');
Route::put('property/change-status', [PropertyController::class, 'updateStatus'])->name('property.change-status');
Route::resource('property', PropertyController::class);


Route::get('property-gallery-index/{property}', [PropertyGalleryController::class, 'index'])->name('property-gallery-index');
Route::resource('property-gallery', PropertyGalleryController::class);

Route::put('facility-change-status', [FacilityController::class, 'updateStatus'])->name('facility.change-status');
Route::resource('facility', FacilityController::class);

Route::put('detail-change-status', [DetailController::class, 'updateStatus'])->name('detail.change-status');
Route::resource('detail', DetailController::class);

Route::get('property-stats-index/{property}', [PropertyStatsController::class, 'index'])->name('property-stats-index');
Route::resource('property-stats', PropertyStatsController::class);


Route::put('property-facility-change-status', [PropertyFacilityController::class, 'updateStatus'])->name('property-facility.change-status');
Route::resource('property-facility', PropertyFacilityController::class);

Route::put('property-variant/change-status', [PropertyVariantController::class, 'updateStatus'])->name('property-variant.change-status');
Route::get('property-variant-index/{property}', [PropertyVariantController::class, 'index'])->name('property-variant-index');
Route::resource('property-variant', PropertyVariantController::class);


Route::get('variant-item/{propertyId}/{variantId}', [PropertyVariantItemController::class, 'index'])->name('variant-item.index');
Route::get('variant-item/create/{propertyId}/{variantId}', [PropertyVariantItemController::class, 'create'])->name('variant-item.create');
Route::put('variant-item/status', [PropertyVariantItemController::class, 'updateStatus'])->name('variant-item.change-status');

Route::get('variant-item-edit/{variantItemId}', [PropertyVariantItemController::class, 'edit'])->name('variant-item.edit');
Route::put('variant-item-update/{variantItemId}', [PropertyVariantItemController::class, 'update'])->name('variant-item.update');
Route::delete('variant-item-delete/{variantItemId}', [PropertyVariantItemController::class, 'destroy'])->name('variant-item.destroy');
Route::post('variant-item', [PropertyVariantItemController::class, 'store'])->name('variant-item.store');











