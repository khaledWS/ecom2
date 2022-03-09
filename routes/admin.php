<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('register', [Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create']);
Route::get('login', [Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'create']);

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return "dashboard";
    })->name('admin.dashboard');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');


    //Categories Routes
    Route::prefix('category')->group(function () {
        //index
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
        //Show
        Route::get('/{category}', [CategoryController::class, 'show'])->name('admin.categories.show');
        //new
        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        //Edit
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        //Delete
        Route::get('/delete/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    });

    //    //Product routes
    //    Route::prefix('product')->group(function () {
    //     //index
    //     Route::get('/', [ProductController::class, 'index'])->name('admin.products');
    //     //Show
    //     Route::get('/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    //     //new
    //     Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
    //     Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
    //     //Edit
    //     Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    //     Route::post('/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    //     //Delete
    //     Route::get('/delete/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    // });


    //Product routes
    Route::prefix('vendor')->group(function () {
        //index
        Route::get('/', [VendorController::class, 'index'])->name('admin.vendors');
        //Show
        // Route::get('/{vendor}', [VendorController::class, 'show'])->name('admin.vendors.show');
        //new
        Route::get('/create', [VendorController::class, 'create'])->name('admin.vendors.create');
        Route::post('/store', [VendorController::class, 'store'])->name('admin.vendors.store');
        //Edit
        Route::get('/edit/{Vendor}', [VendorController::class, 'edit'])->name('admin.vendors.edit');
        Route::post('/update/{Vendor}', [VendorController::class, 'update'])->name('admin.vendors.update');
        //Delete
        Route::get('/delete/{Vendors}', [VendorController::class, 'destroy'])->name('admin.vendors.destroy');
    });
});
