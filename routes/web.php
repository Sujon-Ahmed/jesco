<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;

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
    return view('frontend.layouts.master');
});

Auth::routes();

// frontend
// Route::get('/', [HomeController::class, 'index'])->name('home');

// dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
// users
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/profile/update', [UserController::class, 'profileUpdate']);
Route::post('/change/password', [UserController::class, 'changePassword']);


// color
Route::get('/color', [ColorController::class, 'color'])->name('color');
Route::post('/color/insert', [ColorController::class, 'colorInsert']);
Route::get('/color/edit/{id}', [ColorController::class, 'colorEdit'])->name('color.edit');
Route::post('/color/update', [ColorController::class, 'colorUpdate']);
Route::get('/color/delete/{id}', [ColorController::class, 'colorDelete'])->name('color.delete');

// size
Route::get('/size', [SizeController::class, 'size'])->name('size');
Route::post('/size/insert', [SizeController::class, 'sizeInsert']);