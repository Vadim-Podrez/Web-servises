<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    public function __construct(
        private readonly TaskService $taskService
    ) {}

    private function successResponse(
        mixed $data = null,
        string $message = '',
        int $status = 200
    ): JsonResponse {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $status, [], JSON_UNESCAPED_UNICODE);
    }

    private function errorResponse(
        string $message,
        int $status = 400
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status, [], JSON_UNESCAPED_UNICODE);
    }

    public function index(): JsonResponse
    {
        $tasks = $this->taskService->getAll();

        return $this->successResponse(
            $tasks,
            'Список навчальних завдань отримано'
        );
    }

    public function store(StoreTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->create($request->validated());

        return $this->successResponse(
            $task,
            'Навчальне завдання успішно додано до планувальника',
            201
        );
    }

    public function show(int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Завдання не знайдено', 404);
        }

        return $this->successResponse(
            $task,
            'Завдання знайдено'
        );
    }

    public function update(StoreTaskRequest $request, int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Завдання не знайдено', 404);
        }

        $task = $this->taskService->update($task, $request->validated());

        return $this->successResponse(
            $task,
            'Навчальне завдання успішно оновлено'
        );
    }

    public function destroy(int $id): JsonResponse
    {
        $task = $this->taskService->find($id);

        if (!$task) {
            return $this->errorResponse('Завдання не знайдено', 404);
        }

        $this->taskService->delete($task);

        return $this->successResponse(
            null,
            'Навчальне завдання видалено з планувальника'
        );
    }
}
