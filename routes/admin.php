<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Backend\AllUserController;
use App\Http\Controllers\Backend\AmenityController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\DetailController;
use App\Http\Controllers\Backend\FacilityController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PropertyAmenityController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyDetailController;
use App\Http\Controllers\Backend\PropertyFacilityController;
use App\Http\Controllers\Backend\PropertyFacilityItemController;
use App\Http\Controllers\Backend\PropertyGalleryController;
use App\Http\Controllers\Backend\PropertyLocationController;
use App\Http\Controllers\Backend\PropertyMapController;
use App\Http\Controllers\Backend\PropertyPlanController;
use App\Http\Controllers\Backend\PropertyStatsController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\TestimonialController;
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

Route::put('facility-change-status', [FacilityController::class, 'updateStatus'])->name('facility.change-status');
Route::resource('facility', FacilityController::class);

Route::put('detail-change-status', [DetailController::class, 'updateStatus'])->name('detail.change-status');
Route::resource('detail', DetailController::class);

Route::put('state-change-status', [StateController::class, 'updateStatus'])->name('state.change-status');
Route::resource('state', StateController::class);

Route::get('property/check-approved', [PropertyController::class, 'checkIsApproved'])->name('property.check-approved');
Route::put('property/change-status', [PropertyController::class, 'updateStatus'])->name('property.change-status');

Route::get('property-message', [PropertyController::class, 'messages'])->name('property.message');
Route::get('message/details/{id}', [PropertyController::class, 'messageDetails'])->name('message.details');

Route::resource('property', PropertyController::class);


Route::get('property-gallery-index/{property}', [PropertyGalleryController::class, 'index'])->name('property-gallery-index');
Route::resource('property-gallery', PropertyGalleryController::class);

Route::put('property-detail-change-status', [PropertyDetailController::class, 'updateStatus'])->name('property-detail.change-status');
Route::resource('property-detail', PropertyDetailController::class);

Route::put('property-plan-change-status', [PropertyPlanController::class, 'updateStatus'])->name('property-plan.change-status');
Route::put('property-plan-change-default', [PropertyPlanController::class, 'updateDefault'])->name('property-plan.change-default');

Route::resource('property-plan', PropertyPlanController::class);

Route::put('property-location-change-status', [PropertyLocationController::class, 'updateStatus'])->name('property-location.change-status');
Route::resource('property-location', PropertyLocationController::class);

Route::resource('property-map', PropertyMapController::class);

Route::put('property-facility-change-status', [PropertyFacilityController::class, 'updateStatus'])->name('property-facility.change-status');
Route::resource('property-facility', PropertyFacilityController::class);


Route::get('facility-item/{propertyId}/{facilityId}', [PropertyFacilityItemController::class, 'index'])->name('facility-item.index');
Route::get('property-facility-item/create/{propertyId}/{facilityId}', [PropertyFacilityItemController::class, 'create'])->name('property-facility-item.create');
Route::put('property-facility-item/status', [PropertyFacilityItemController::class, 'updateStatus'])->name('property-facility-item.change-status');


Route::get('facility-item-edit/{facilityItemId}', [PropertyFacilityItemController::class, 'edit'])->name('property-facility-item.edit');
Route::put('facility-item-update/{facilityItemId}', [PropertyFacilityItemController::class, 'update'])->name('property-facility-item.update');
Route::delete('facility-item-delete/{facilityItemId}', [PropertyFacilityItemController::class, 'destroy'])->name('property-facility-item.destroy');
Route::post('facility-item', [PropertyFacilityItemController::class, 'store'])->name('property-facility-item.store');


Route::put('property-amenity-change-status', [PropertyAmenityController::class, 'updateStatus'])->name('property-amenity.change-status');
Route::resource('property-amenity', PropertyAmenityController::class);

Route::get('property-stats-index/{property}', [PropertyStatsController::class, 'index'])->name('property-stats-index');
Route::resource('property-stats', PropertyStatsController::class);

Route::get('packages', [PackageController::class, 'index'])->name('package.history.index');
Route::get('package/invoice-print/{id}', [PackageController::class, 'invoice'])->name('package.invoice-print');


Route::put('testimonial-change-status', [TestimonialController::class, 'updateTestimonial'])->name('testimonial.change-status');
Route::resource('testimonials', TestimonialController::class);


Route::put('blog_category-change-status', [BlogCategoryController::class, 'updateBlogCategory'])->name('blog_category.change-status');
Route::resource('blog-category', BlogCategoryController::class);
