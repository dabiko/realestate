<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Frontend\BlogPostController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\PropertyMessageController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('admin/login', [AdminController::class, 'AdminLogin'])
    ->name('admin.login')
    ->middleware(RedirectIfAuthenticated::class);

Route::get('user/login', [UserController::class, 'login'])
    ->name('user.login')
    ->middleware(RedirectIfAuthenticated::class);

Route::get('agent/login', [AgentController::class, 'AgentLogin'])
    ->name('agent.login')
    ->middleware(RedirectIfAuthenticated::class);

Route::get('agent/register', [AgentController::class, 'AgentRegister'])
    ->name('agent.register')
    ->middleware(RedirectIfAuthenticated::class);
Route::post('agent/process-registration', [AgentController::class, 'processRegistration'])->name('agent-process-registration');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('property/search', [HomeController::class, 'searchProperty'])->name('search.property');


Route::get('categories', [PagesController::class, 'categories'])->name('categories');
Route::get('property/category', [PagesController::class, 'propertyCategory'])->name('property.category');


Route::get('properties', [PagesController::class, 'properties'])->name('properties');
Route::get('property/listing', [PagesController::class, 'propertyListing'])->name('property.listing');
Route::get('property/details/{id}', [PagesController::class, 'property'])->name('property.details');
Route::get('property/state', [PagesController::class, 'propertyStates'])->name('property.state');
Route::post('property/filter', [PagesController::class, 'filterProperty'])->name('filter.property');

Route::get('states/listing', [PagesController::class, 'stateListing'])->name('state.listing');


Route::get('agent/details/{id}', [PagesController::class, 'agentDetails'])->name('agent.details');
Route::get('agent/listing', [PagesController::class, 'agentListing'])->name('agent.listing');



Route::get('wishlist', [WishlistController::class, 'property'])->name('wishlist');
Route::post('wishlist-add/{id}', [WishlistController::class, 'addWishlist'])->name('wishlist-add');

Route::get('compare', [CompareController::class, 'property'])->name('compare');
Route::post('compare-add/{id}', [CompareController::class, 'addCompare'])->name('compare-add');

Route::get('blog-post', [BlogPostController::class, 'index'])->name('blog-post.all');
Route::get('blog-post-detail/{id}', [BlogPostController::class, 'blogPostDetail'])->name('blog-post-detail');
Route::get('blog-post-filter', [BlogPostController::class, 'filterBlogPostCategory'])->name('blog-post-filter-category');
Route::get('blog-post-tags', [BlogPostController::class, 'filterBlogPostTags'])->name('blog-post-filter-tags');



//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

require __DIR__.'/auth.php';


Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function (){

    Route::get('logout', [ UserController::class, 'logout'])->name('logout');

    Route::get('dashboard', [ UserController::class, 'dashboard'])->name('dashboard');

    Route::get('profile', [UserController::class, 'dashboard'])->name('profile.edit');

    Route::get('password', [UserController::class, 'dashboard'])->name('password.change');

    Route::patch('profile', [UserController::class, 'updateProfile'])->name('profile.update');

    Route::patch('password', [UserController::class, 'updatePassword'])->name('password.update');


    Route::get('user-wishlist', [WishlistController::class, 'userWishList'])->name('wishlist');

    Route::get('get-wishlist', [WishlistController::class, 'getUserWishList'])->name('get-wishlist');

    Route::delete('delete-wishlist/{id}', [WishlistController::class, 'deleteUserWishList'])->name('delete-wishlist');


    Route::get('user-compare', [CompareController::class, 'userCompare'])->name('compare');

    Route::get('get-compare', [CompareController::class, 'getUserCompare'])->name('get-compare');

    Route::delete('delete-compare/{id}', [CompareController::class, 'deleteUserCompare'])->name('delete-compare');


    Route::post('property-message', [PropertyMessageController::class, 'propertyMessage'])->name('property.message');

});
