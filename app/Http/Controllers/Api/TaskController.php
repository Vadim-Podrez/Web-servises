<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreTaskRequest;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Task::all());
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json($task);
    }

    public function update(StoreTaskRequest $request, Task $task): JsonResponse
    {
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task): JsonResponse
    {
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully'
        ]);
    }
}
