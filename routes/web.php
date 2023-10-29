<?php

use App\Http\Controllers\HotelController;
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

Route::middleware('auth')->group(function () {
    Route::apiResource('hotels', HotelController::class)
        ->except(['create', 'edit']);
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
