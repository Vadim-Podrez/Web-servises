<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\SubtaskController;
// =========================================================
// ВІДКРИТІ МАРШРУТИ (Не потребують токена)
// =========================================================
// Перевірка працездатності API
Route::get('/health', [HealthController::class, 'index']);
// Вхід у систему для отримання токена
Route::post('/login', [AuthController::class, 'login']);
// =========================================================
// ЗАХИЩЕНІ МАРШРУТИ (Доступні ТІЛЬКИ з токеном)
// =========================================================
Route::middleware('auth:sanctum')->group(function () {
    // ----- CRUD для основних завдань (Tasks) -----
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
    // ----- CRUD для підзадач (Subtasks) -----
    Route::get('/subtasks', [SubtaskController::class, 'index']);
    Route::post('/subtasks', [SubtaskController::class, 'store']);
    Route::get('/subtasks/{subtask}', [SubtaskController::class, 'show']);
    Route::put('/subtasks/{subtask}', [SubtaskController::class, 'update']);
    Route::delete('/subtasks/{subtask}', [SubtaskController::class, 'destroy']);

});
