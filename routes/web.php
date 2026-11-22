<?php

use App\Http\Controllers\ContactController;
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

// Primary Production Route: Portfolio V2 Continuous Chassis
Route::get('/', function () {
    return view('v2.index');
})->name('home');

// Alias & Permanent 301 Redirect for previous /v2 route
Route::redirect('/v2', '/', 301)->name('v2.home');

// Dedicated Videogame Chamber
Route::get('/videogame', function () {
    return view('v2.videogame');
})->name('videogame');

Route::redirect('/v2/videogame', '/videogame', 301)->name('v2.videogame');

// Legacy V1 Showcase Archive
Route::get('/v1', function () {
    return view('home');
})->name('v1.home');

Route::post('/contact/submit', [ContactController::class, 'submit']);

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['es', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');
