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

Route::get('/', function () {
    return view('home');
});

Route::get('/v2', function () {
    return view('v2.index');
})->name('v2.home');

Route::get('/v2/videogame', function () {
    return view('v2.videogame');
})->name('v2.videogame');

Route::post('/contact/submit', [ContactController::class, 'submit']);

Route::get('/lang/{locale}', function (string $locale) {
    if (in_array($locale, ['es', 'en'])) {
        session(['locale' => $locale]);
    }

    return redirect()->back();
})->name('lang.switch');
