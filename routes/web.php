<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes(['register'=>false]);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::resource('/reservations', ReservationController::class)->names('reservations');
Route::resource('/pays', PayController::class)->names('pays');
