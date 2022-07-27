<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageSliderController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

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

Route::get('/', [FrontendController::class, 'index'])->name('index.frontend');
Route::get('/single/product/{id}', [FrontendController::class, 'singleProduct'])->name('single.product');
Route::get('/filter/category/product/{id}', [ShopController::class, 'filterCategoryProduct'])->name('filter.category.product');

// shop page
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// about controller
Route::get('/about', [AboutController::class, 'index'])->name('about');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('auth', 'isAdmin')->group(function () {
    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // home page slider
    Route::get('/slider', [HomepageSliderController::class, 'index'])->name('slider');
    Route::post('/slider/store', [HomepageSliderController::class, 'store'])->name('slider.store');


    // users
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'profileUpdate']);
    Route::post('/change/password', [UserController::class, 'changePassword']);

    // product
    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/getCategory', [ProductController::class, 'getCategory']);
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');

    // color
    Route::get('/color', [ColorController::class, 'color'])->name('color');
    Route::post('/color/insert', [ColorController::class, 'colorInsert'])->name('color.insert');
    Route::get('/color/edit/{id}', [ColorController::class, 'colorEdit'])->name('color.edit');
    Route::put('/color/update', [ColorController::class, 'colorUpdate'])->name('color.update');
    Route::delete('/color/delete', [ColorController::class, 'colorDelete'])->name('color.delete');

    // size
    Route::get('/size', [SizeController::class, 'size'])->name('size');
    Route::post('/size/insert', [SizeController::class, 'sizeInsert'])->name('size.insert');
    Route::get('/size/edit/{id}', [SizeController::class, 'edit'])->name('edit');
    Route::put('/size/update', [SizeController::class, 'update'])->name('size.update');
    Route::delete('/size/delete', [SizeController::class, 'sizeDestroy'])->name('size.delete');

    // category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/category/insert', [CategoryController::class, 'add'])->name('category.insert');
    Route::delete('/category/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('/edit/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/category/status/update', [CategoryController::class, 'status_update'])->name('category.change-status');

    // subcategory
    Route::get('/subcategory', [SubcategoryController::class, 'index'])->name('subcategory');
    Route::post('/subcategory/insert', [SubcategoryController::class, 'store'])->name('subcategory.insert');
    Route::get('/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('edit');
    Route::put('/subcategory/update', [SubcategoryController::class, 'update'])->name('update');
    Route::delete('/subcategory/destroy', [SubcategoryController::class, 'destroy'])->name('subcategory.destroy');

    // brands
    Route::get('/brands', [BrandController::class, 'index'])->name('brands');
    Route::post('/brand/insert', [BrandController::class, 'store'])->name('brand.store');
    Route::delete('/brand/delete', [BrandController::class, 'delete'])->name('brand.delete');
    Route::get('/get-brand-info/{id}', [BrandController::class, 'getBrandInformation']);
    Route::post('/brand/update', [BrandController::class, 'update'])->name('brand.update');
    Route::post('/brand/status', [BrandController::class, 'statusUpdate'])->name('brand.change-status');
});