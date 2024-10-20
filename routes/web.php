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
Route::post('/api/generate-schedule', [\App\Http\Controllers\Api\ScheduleController::class, 'generateSchedule']);
Route::apiResource('users', \App\Http\Controllers\Api\Crud\UserController::class);
Route::apiResource('schedules', \App\Http\Controllers\Api\Crud\ScheduleController::class);
Route::apiResource('entity-types', \App\Http\Controllers\Api\Crud\EntityTypeController::class);
Route::apiResource('entities', \App\Http\Controllers\Api\Crud\EntityController::class);
Route::apiResource('attributes', \App\Http\Controllers\Api\Crud\AttributeController::class);
Route::apiResource('attribute-values', \App\Http\Controllers\Api\Crud\AttributeValueController::class);
Route::apiResource('entity-relationships', \App\Http\Controllers\Api\Crud\EntityRelationshipController::class);
