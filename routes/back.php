<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
/*
|--------------------------------------------------------------------------
| back Routes
|--------------------------------------------------------------------------
|
| Here is where you can register back routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web////////" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->get('/', App\http\Livewire\Back\DashboardComponent::class);


Route::get('register', [Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'create']);
Route::get('login', [Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'create']);
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', App\http\Livewire\Back\DashboardComponent::class)->name('admin.dashboard');


    //main_Categories Routes
    Route::prefix('main_categories')->group(function () {
        Route::get('/', App\http\Livewire\Back\MainCategoriesComponent::class)->name('categories');
        //Create new
        Route::get('/create', App\http\Livewire\CreateMainCategory::class)->name('admin.categories.create');
        Route::post('/store', [MainCategoriesController::class, 'storeCategory'])->name('admin.categories.store');
        //Edit
        Route::get('/edit/{id}', [MainCategoriesController::class, 'editCategory'])->name('admin.categories.edit');
        Route::post('/update/{id}', [MainCategoriesController::class, 'updateCategory'])->name('admin.categories.update');
        //Delete
        Route::get('/delete/{id}', [MainCategoriesController::class, 'deleteCategory'])->name('admin.categories.delete');

        //redirects
    });
});
