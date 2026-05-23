<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\SubtaskController;

Route::get('/health', [HealthController::class, 'index']);

Route::prefix('tasks')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/', [TaskController::class, 'store']);
    Route::get('/{task}', [TaskController::class, 'show']);
    Route::put('/{task}', [TaskController::class, 'update']);
    Route::delete('/{task}', [TaskController::class, 'destroy']);
});

Route::prefix('subtasks')->group(function () {
    Route::get('/', [SubtaskController::class, 'index']);
    Route::post('/', [SubtaskController::class, 'store']);
    Route::get('/{subtask}', [SubtaskController::class, 'show']);
    Route::put('/{subtask}', [SubtaskController::class, 'update']);
    Route::delete('/{subtask}', [SubtaskController::class, 'destroy']);
});
