<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BusinessAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\InfluencerAuthController;
use App\Http\Controllers\BusinessDashboardController;
use App\Http\Controllers\InfluencerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->middleware('auth')->name('admin.dashboard');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout'); 
    Route::get('/testing', [HomeController::class, 'index'])->name('testing')->middleware('auth');
    Route::get('/pelanggan', [HomeController::class, 'pelanggan'])->name('pelanggan')->middleware('auth');
});

// Influencer Routes
Route::prefix('influencer')->group(function () {
    Route::get('/login', [InfluencerAuthController::class, 'showLoginForm'])->name('influencer.login');
    Route::post('/login', [InfluencerAuthController::class, 'login']);
    Route::get('/register', [InfluencerAuthController::class, 'showRegisterForm'])->name('influencer.register');
    Route::post('/register', [InfluencerAuthController::class, 'register']);
    Route::get('/dashboard', [InfluencerDashboardController::class, 'index'])->middleware('auth','role:influencer')->name('influencer.dashboard');
    Route::post('/logout', [InfluencerAuthController::class, 'logout'])->name('influencer.logout'); 

});

// Business Routes
Route::prefix('business')->group(function () {
    Route::get('/login', [BusinessAuthController::class, 'showLoginForm'])->name('business.login');
    Route::post('/login', [BusinessAuthController::class, 'login']);
    Route::get('/register', [BusinessAuthController::class, 'showRegisterForm'])->name('business.register');
    Route::post('/register', [BusinessAuthController::class, 'register']);
    Route::get('/dashboard', [BusinessDashboardController::class, 'index'])->middleware('auth')->name('business.dashboard');
    Route::post('/logout', [BusinessAuthController::class, 'logout'])->name('business.logout'); 
});

