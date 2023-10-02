<?php

use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentProfileController;
use App\Http\Controllers\Agent\AgentPropertyAmenityController;
use App\Http\Controllers\Agent\AgentPropertyBookTourController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Agent\AgentPropertyDetailController;
use App\Http\Controllers\Agent\AgentPropertyFacilityController;
use App\Http\Controllers\Agent\AgentPropertyFacilityItemController;
use App\Http\Controllers\Agent\AgentPropertyGalleryController;
use App\Http\Controllers\Agent\AgentPropertyLocationController;
use App\Http\Controllers\Agent\AgentPropertyMapController;
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

Route::get('property-message', [AgentPropertyController::class, 'messages'])->name('property.message');
Route::get('message/details/{id}', [AgentPropertyController::class, 'messageDetails'])->name('message.details');


Route::resource('property', AgentPropertyController::class);

Route::get('property-gallery-index/{property}', [AgentPropertyGalleryController::class, 'index'])->name('property-gallery-index');
Route::resource('property-gallery', AgentPropertyGalleryController::class);

Route::put('property-detail-change-status', [AgentPropertyDetailController::class, 'updateStatus'])->name('property-detail.change-status');
Route::resource('property-detail', AgentPropertyDetailController::class);

Route::put('property-plan-change-status', [AgentPropertyPlanController::class, 'updateStatus'])->name('property-plan.change-status');
Route::put('property-plan-change-default', [AgentPropertyPlanController::class, 'updateDefault'])->name('property-plan.change-default');
Route::resource('property-plan', AgentPropertyPlanController::class);

Route::put('property-location-change-status', [AgentPropertyLocationController::class, 'updateStatus'])->name('property-location.change-status');
Route::resource('property-location', AgentPropertyLocationController::class);

Route::resource('property-map', AgentPropertyMapController::class);


Route::put('property-facility-change-status', [AgentPropertyFacilityController::class, 'updateStatus'])->name('property-facility.change-status');
Route::resource('property-facility', AgentPropertyFacilityController::class);


Route::get('facility-item/{propertyId}/{facilityId}', [AgentPropertyFacilityItemController::class, 'index'])->name('facility-item.index');
Route::get('property-facility-item/create/{propertyId}/{facilityId}', [AgentPropertyFacilityItemController::class, 'create'])->name('property-facility-item.create');
Route::put('property-facility-item/status', [AgentPropertyFacilityItemController::class, 'updateStatus'])->name('property-facility-item.change-status');


Route::get('facility-item-edit/{facilityItemId}', [AgentPropertyFacilityItemController::class, 'edit'])->name('property-facility-item.edit');
Route::put('facility-item-update/{facilityItemId}', [AgentPropertyFacilityItemController::class, 'update'])->name('property-facility-item.update');
Route::delete('facility-item-delete/{facilityItemId}', [AgentPropertyFacilityItemController::class, 'destroy'])->name('property-facility-item.destroy');
Route::post('facility-item', [AgentPropertyFacilityItemController::class, 'store'])->name('property-facility-item.store');


Route::put('property-amenity-change-status', [AgentPropertyAmenityController::class, 'updateStatus'])->name('property-amenity.change-status');
Route::resource('property-amenity', AgentPropertyAmenityController::class);


Route::get('property-stats-index/{property}', [AgentPropertyStatsController::class, 'index'])->name('property-stats-index');
Route::resource('property-stats', AgentPropertyStatsController::class);

Route::get('property/check-approved', [AgentPropertyBookTourController::class, 'checkIsApproved'])->name('property-scheduled-tour.check-approved');
Route::put('property/change-status', [AgentPropertyBookTourController::class, 'updateStatus'])->name('property-scheduled-tour.change-status');

Route::get('property-schedules', [AgentPropertyBookTourController::class, 'propertySchedules'])->name('property-schedules.messages');
Route::get('property-scheduled-details/{id}', [AgentPropertyBookTourController::class, 'propertyScheduledDetails'])->name('property-schedules.details');
Route::resource('property-scheduled-tour', AgentPropertyBookTourController::class);


