<?php

use App\Http\Controllers\CategoryController;
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

Route::get('register', [Laravel\Fortify\Http\Controllers\RegisteredUserController::class,'create']);
Route::get('login', [Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class,'create']);

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard',function(){
        return "dashboard";
    })->name('admin.dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('admin.dashboard');


 //main_Categories Routes
 Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories');
    //Create new
    Route::get('/create', [CategoryController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/store', [CategoryController::class, 'storeCategory'])->name('admin.categories.store');
    //Edit
    Route::get('/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.categories.edit');
    Route::post('/update/{id}', [CategoryController::class, 'updateCategory'])->name('admin.categories.update');
    //Delete
    Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.categories.delete');

     });    //redirects
});

