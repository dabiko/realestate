<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Agent\AgentPropertyDetailController;
use App\Http\Controllers\Agent\AgentPropertyFacilityController;
use App\Http\Controllers\Agent\AgentPropertyGalleryController;
use App\Http\Controllers\Agent\AgentPropertyLocationController;
use App\Http\Controllers\Agent\AgentPropertyPlanController;
use App\Http\Controllers\Agent\AgentPropertyStatsController;
use App\Http\Controllers\Agent\AgentPropertyVariantController;
use App\Http\Controllers\Agent\AgentPropertyVariantItemController;
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

Route::get('dashboard', [AgentController::class, 'AgentDashboard'])->name('dashboard');
Route::post('logout', [AgentController::class, 'AgentLogout'])->name('logout');

Route::get('profile', [AgentProfileController::class, 'index'])->name('profile');
Route::put('profile-update', [AgentProfileController::class, 'update'])->name('profile.update');
Route::get('password', [AgentProfileController::class, 'index'])->name('password');
Route::put('password-update', [AgentProfileController::class, 'passwordUpdate'])->name('password.update');


Route::get('package', [AgentPropertyController::class, 'package'])->name('packages');
Route::get('package/history', [AgentPropertyController::class, 'history'])->name('package.history');
Route::get('package/business', [AgentPropertyController::class, 'business'])->name('buy.business');
Route::get('package/process-business', [AgentPropertyController::class, 'processBusiness'])->name('process.business');
Route::get('package/process-professional', [AgentPropertyController::class, 'processProfessional'])->name('process.professional');
Route::get('package/professional', [AgentPropertyController::class, 'professional'])->name('buy.professional');

Route::get('package/invoice-print/{id}', [AgentPropertyController::class, 'invoice'])->name('package.invoice-print');

Route::get('property/check-approved', [AgentPropertyController::class, 'checkIsApproved'])->name('property.check-approved');
Route::put('property/change-status', [AgentPropertyController::class, 'updateStatus'])->name('property.change-status');

Route::resource('property', AgentPropertyController::class);

Route::get('property-gallery-index/{property}', [AgentPropertyGalleryController::class, 'index'])->name('property-gallery-index');
Route::resource('property-gallery', AgentPropertyGalleryController::class);

Route::put('property-detail-change-status', [AgentPropertyDetailController::class, 'updateStatus'])->name('property-detail.change-status');
Route::resource('property-detail', AgentPropertyDetailController::class);

Route::put('property-plan-change-status', [AgentPropertyPlanController::class, 'updateStatus'])->name('property-plan.change-status');
Route::resource('property-plan', AgentPropertyPlanController::class);

Route::put('property-location-change-status', [AgentPropertyLocationController::class, 'updateStatus'])->name('property-location.change-status');
Route::resource('property-location', AgentPropertyLocationController::class);

Route::put('property-facility-change-status', [AgentPropertyFacilityController::class, 'updateStatus'])->name('property-facility.change-status');
Route::resource('property-facility', AgentPropertyFacilityController::class);

Route::get('property-stats-index/{property}', [AgentPropertyStatsController::class, 'index'])->name('property-stats-index');
Route::resource('property-stats', AgentPropertyStatsController::class);

Route::put('property-variant/change-status', [AgentPropertyVariantController::class, 'updateStatus'])->name('property-variant.change-status');
Route::get('property-variant-index/{property}', [AgentPropertyVariantController::class, 'index'])->name('property-variant-index');
Route::resource('property-variant', AgentPropertyVariantController::class);


Route::get('variant-item/{propertyId}/{variantId}', [AgentPropertyVariantItemController::class, 'index'])->name('variant-item.index');
Route::get('variant-item/create/{propertyId}/{variantId}', [AgentPropertyVariantItemController::class, 'create'])->name('variant-item.create');
Route::put('variant-item/status', [AgentPropertyVariantItemController::class, 'updateStatus'])->name('variant-item.change-status');

Route::get('variant-item-edit/{variantItemId}', [AgentPropertyVariantItemController::class, 'edit'])->name('variant-item.edit');
Route::put('variant-item-update/{variantItemId}', [AgentPropertyVariantItemController::class, 'update'])->name('variant-item.update');
Route::delete('variant-item-delete/{variantItemId}', [AgentPropertyVariantItemController::class, 'destroy'])->name('variant-item.destroy');
Route::post('variant-item', [AgentPropertyVariantItemController::class, 'store'])->name('variant-item.store');





