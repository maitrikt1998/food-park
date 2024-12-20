<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProfileController;
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

/** Admin Auth Routes */
Route::group(['middleware'=>'guest'],function(){
    Route::get('admin/login',[AdminAuthController::class, 'index'])->name('admin.login');
    Route::get('admin/forgot-password',[AdminAuthController::class,'forgotpassword'])->name('admin.forget-password');
});

Route::group(['middleware' => 'auth'], function () {
   Route::get('/dashboard' ,[DashboardController::class , 'index'])->name('dashboard');
   Route::put('/profile',[ProfileController::class,'updateProfile'])->name('profile.update');
   Route::put('/profile/password',[ProfileController::class,'updatePassword'])->name('profile.password.update');
   Route::post('/profile/avatar',[ProfileController::class,'updateAvatar'])->name('profile.avatar.update');
});

require __DIR__.'/auth.php';
/** Show Home page */
Route::get('/', [FrontendController::class, 'index'])->name('home');

/** Show Product detail page */
Route::get('/product/{slug}', [FrontendController::class, 'showProduct'])->name('product.show');

