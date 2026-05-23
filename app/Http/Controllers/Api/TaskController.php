<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Models\Task;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        $tasks = Task::with('subtasks')
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Список навчальних завдань отримано',
            'data' => $tasks,
        ]);
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Навчальне завдання успішно додано до планувальника',
            'data' => $task,
        ], 201);
    }

    public function show(Task $task): JsonResponse
    {
        $task->load('subtasks');

        return response()->json([
            'success' => true,
            'message' => 'Завдання знайдено',
            'data' => $task,
        ]);
    }

    public function update(StoreTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Навчальне завдання успішно оновлено',
            'data' => $task->fresh('subtasks'),
        ]);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Навчальне завдання видалено з планувальника',
            'data' => null,
        ]);
    }
}
