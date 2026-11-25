<?php

use App\Http\Controllers\Rag\ChatController;
use App\Http\Controllers\Rag\TtsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['throttle:30,1'])->post('/rag/chat', [ChatController::class, 'stream']);
Route::middleware(['throttle:30,1'])->post('/rag/tts', [TtsController::class, 'synthesize']);
