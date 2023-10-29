<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RoomController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::apiResource('hotels', HotelController::class)
    ->only(['index']);
Route::apiResource('rooms', RoomController::class)
    ->only(['index']);

Route::middleware('auth')->group(function () {
    Route::apiResource('hotels', HotelController::class)
        ->except(['index', 'create', 'edit']);
    Route::apiResource('rooms', RoomController::class)
        ->except(['index', 'create', 'edit']);
    Route::apiResource('prices', PriceController::class)
        ->except(['index', 'create', 'edit']);
});

require __DIR__.'/auth.php';

Route::get(
    '{any}',
    function () {
        if (Auth::check()) {
            return view('app');
        }

        return view('welcome');
    }
)->where('any', '.*');
