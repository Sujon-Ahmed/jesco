<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubcategoryController;

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

// frontend
Route::get('/', function () {
    return view('frontend.index');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    // users
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'profileUpdate']);
    Route::post('/change/password', [UserController::class, 'changePassword']);
    // color
    Route::get('/color', [ColorController::class, 'color'])->name('color');
    Route::post('/color/insert', [ColorController::class, 'colorInsert']);
    Route::get('/color/edit/{id}', [ColorController::class, 'colorEdit'])->name('color.edit');
    Route::put('/color/update', [ColorController::class, 'colorUpdate'])->name('color.update');
    Route::delete('/color/delete', [ColorController::class, 'colorDelete'])->name('color.delete');
    // size
    Route::get('/size', [SizeController::class, 'size'])->name('size');
    Route::post('/size/insert', [SizeController::class, 'sizeInsert']);
    Route::get('/size/edit/{id}', [SizeController::class, 'edit'])->name('edit');
    Route::put('/size/update', [SizeController::class, 'update'])->name('size.update');
    Route::delete('/size/delete', [SizeController::class, 'sizeDestroy'])->name('size.delete');
    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/insert', [CategoryController::class, 'add']);
    Route::delete('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update']);
    // subcategory
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
    Route::post('/subcategory/insert', [SubcategoryController::class, 'store']);
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');
    Route::put('/subcategory/update', [SubcategoryController::class, 'update'])->name('update');
    Route::delete('/subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');
});
