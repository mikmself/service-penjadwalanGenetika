<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route default untuk menguji API
Route::get('/test', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'API is working!',
    ]);
});

Route::prefix('api')->group(function () {
    Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
    Route::post('/forgot-password', [\App\Http\Controllers\Api\AuthController::class, 'forgotPassword']);
    Route::post('/reset-password', [\App\Http\Controllers\Api\AuthController::class, 'resetPassword']);

    // Protected routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [\App\Http\Controllers\Api\AuthController::class, 'profile']);
        Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    });
});

Route::prefix('api')->group(function () {
    Route::post('generate-schedule', [\App\Http\Controllers\Api\ScheduleController::class, 'generateSchedule']);

    // Crud API
    Route::apiResource('users', \App\Http\Controllers\Api\Crud\UserController::class);
    Route::apiResource('schedules', \App\Http\Controllers\Api\Crud\ScheduleController::class);
    Route::apiResource('entity-types', \App\Http\Controllers\Api\Crud\EntityTypeController::class);
    Route::apiResource('entities', \App\Http\Controllers\Api\Crud\EntityController::class);
    Route::apiResource('attributes', \App\Http\Controllers\Api\Crud\AttributeController::class);
    Route::apiResource('attribute-values', \App\Http\Controllers\Api\Crud\AttributeValueController::class);
    Route::apiResource('entity-relationships', \App\Http\Controllers\Api\Crud\EntityRelationshipController::class);
});
