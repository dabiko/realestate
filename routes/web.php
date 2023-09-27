<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\PropertyMessageController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\ProfileController;
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
Route::get('categories', [PagesController::class, 'categories'])->name('categories');
Route::get('property/details/{id}', [PagesController::class, 'property'])->name('property.details');

Route::get('wishlist', [WishlistController::class, 'property'])->name('wishlist');
Route::post('wishlist-add/{id}', [WishlistController::class, 'addWishlist'])->name('wishlist-add');

Route::get('compare', [CompareController::class, 'property'])->name('compare');
Route::post('compare-add/{id}', [CompareController::class, 'addCompare'])->name('compare-add');

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
