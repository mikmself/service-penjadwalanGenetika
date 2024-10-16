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
