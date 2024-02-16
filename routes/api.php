<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Load Controllers
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

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

// Register Route
Route::post('/register', [AuthController::class, 'register']);

// Login Route
Route::post('/login', [AuthController::class, 'login']);

// Middleware to protect the routes from unauthorized access
Route::middleware('auth:sanctum')->group(function () {
    // Task Routes
    Route::apiResource('tasks', TaskController::class);

    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout']);
});
