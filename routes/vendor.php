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


Route::get('register', [Laravel\Fortify\Http\Controllers\RegisteredUserController::class,'create']);
Route::get('login', [Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class,'create']);
// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');
