<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
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


Route::get('/', [UserController::class, 'index'])->name('home');

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

});
