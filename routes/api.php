<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Reģistrēšana un pieteikšanās
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Šie maršruti būs pieejami tikai autentificētiem lietotājiem
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('tasks', TaskController::class); // Šis ir nepieciešams
    Route::post('/logout', [AuthController::class, 'logout']);
});
