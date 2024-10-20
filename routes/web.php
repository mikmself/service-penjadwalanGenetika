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

// Route untuk menjalankan algoritma genetika pada penjadwalan
Route::post('/api/generate-schedule', [\App\Http\Controllers\ScheduleController::class, 'generateSchedule']);
Route::apiResource('users', \App\Http\Controllers\Api\UserController::class);
Route::apiResource('schedules', \App\Http\Controllers\Api\ScheduleController::class);
Route::apiResource('entity-types', \App\Http\Controllers\Api\EntityTypeController::class);
Route::apiResource('entities', \App\Http\Controllers\Api\EntityController::class);
Route::apiResource('attributes', \App\Http\Controllers\Api\AttributeController::class);
